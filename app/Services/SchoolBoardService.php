<?php

namespace App\Services;

use App\Models\SchoolBoard;
use SimpleXMLElement;

class SchoolBoardService
{

    /**
     * Calculates average student grade and decides final student status for CSM school board.
     *
     * @param array $grades Student grades.
     *
     * @return array
     */
    private function calculateCSM($grades)
    {
        if (!empty($grades)){
            $gradesTotal = 0;
            $gradesArray = [];

            foreach ($grades as $grade) {
                $gradesTotal += $grade['grade'];
                array_push($gradesArray, $grade['grade']);
            }

            $gradesCount = count($grades);
            $gradesAverage = $gradesTotal / $gradesCount;

            if ($gradesAverage >= 7) {
                return ['final' => 'Pass', 'average' => $gradesAverage, 'grades' => $gradesArray];
            }

            return ['final' => 'Fail', 'average' => $gradesAverage, 'grades' => $gradesArray];
        }

        return ['message' => 'There are no grades'];
    }

    /**
     * Calculates average student grade and decides final student status for CSMB school board.
     *
     * @param array $grades Student grades.
     *
     * @return array
     */
    private function calculateCSMB($grades)
    {
        if (!empty($grades)) {
            $gradesCount = count($grades);
            $gradesTotal = 0;

            if ($gradesCount > 2) {
                $minValue = min($grades);
                $minKey = array_search($minValue, $grades);
                unset($grades[$minKey]);

                $gradesCount -= 1;
            }

            $gradesArray = [];

            foreach ($grades as $grade) {
                $gradesTotal += $grade['grade'];
                array_push($gradesArray, $grade['grade']);
            }

            $gradesAverage = $gradesTotal / $gradesCount;

            if (max($grades) > 8) {
                return ['final' => 'Pass', 'average' => $gradesAverage, 'grades' => $gradesArray];
            }

            return ['final' => 'Fail', 'average' => $gradesAverage, 'grades' => $gradesArray];
        }

        return ['message' => 'There are no grades'];
    }

    /**
     * Formats JSON response.
     *
     * @param array $student Student data.
     * @param array $grades Student grades.
     *
     * @return false|string
     */
    private function prepareJson($student, $grades)
    {
        $successCalc = $this->calculateCSM($grades);

        return json_encode([
            'id' => $student['id'],
            'name' => $student['name'],
            'grades' => $successCalc['grades'],
            'final' => $successCalc['final'],
            'average' => $successCalc['average'],
        ], JSON_PRETTY_PRINT);
    }

    /**
     * Formats XML response data.
     *
     * @param array $student Student data.
     * @param array $grades Student grades.
     *
     * @return mixed
     */
    private function prepareXml($student, $grades)
    {
        $successCalc = $this->calculateCSMB($grades);

        $xml = new SimpleXMLElement('<xml/>');

        $track = $xml->addChild('student');
        $track->addChild('id', $student['id']);
        $track->addChild('name', $student['name']);
        $track->addChild('average',  $successCalc['average']);
        $track->addChild('final', $successCalc['final']);

        foreach ($grades as $key => $grade) {
            $track->addChild('grade' . $key, $grade['grade']);
        }

        Header('Content-type: text/xml');

        return $xml->asXML();
    }

    /**
     * Returns response about student status in desired format.
     *
     * @param array $student Student data.
     * @param array $grades Student grades.
     *
     * @return false|string|void
     */
    public function getResponse($student, $grades)
    {
        $schoolBoard = new SchoolBoard();
        $schoolBoardData = $schoolBoard->get($student['school_board_id']);

        if ($schoolBoardData['name'] === 'CSM') {
            return $this->prepareJson($student, $grades);
        }

        return $this->prepareXml($student, $grades);
    }
}
