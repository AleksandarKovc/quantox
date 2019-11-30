<?php

namespace App\Services;

class SchoolBoardService
{

    /**
     * Calculates average student grade and decides final student status for CSM school board.
     *
     * @param array $grades Student grades.
     *
     * @return array
     */
    public function calculateCSM($grades)
    {
        if (!empty($grades)){
            $gradesTotal = 0;

            foreach ($grades as $grade) {
                $gradesTotal += $grade['grade'];
            }

            $gradesCount = count($grades);
            $gradesAverage = $gradesTotal / $gradesCount;

            if ($gradesAverage >= 7) {
                return ['final' => 'Pass', 'average' => $gradesAverage];
            }

            return ['final' => 'Fail', 'average' => $gradesAverage];
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
    public function calculateCSMB($grades)
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

            foreach ($grades as $grade) {
                $gradesTotal += $grade['grade'];
            }

            $gradesAverage = $gradesTotal / $gradesCount;

            if (max($grades) > 8) {
                return ['final' => 'Pass', 'average' => $gradesAverage];
            }

            return ['final' => 'Fail', 'average' => $gradesAverage];
        }

        return ['message' => 'There are no grades'];
    }
}
