<?php

namespace App\Models;

class Student extends BaseModel
{

    private $id;
    private $name;
    private $school_board_id;

    /**
     * @param $id
     *
     * @return array|null
     */
    public function get($id)
    {
        $student = $this->dbService->findOne('SELECT * FROM test.students WHERE id = ' . $id . ';');

        if ($student) {
            $this->id = $student['id'];
            $this->name = $student['name'];
            $this->school_board_id = $student['school_board_id'];

            return $student;
        }

        return ['message' => 'There is no student with given id.'];
    }

    public function set($data)
    {

    }

    /**
     * Returns student grades.
     *
     * @return array|null
     */
    public function getStudentGrades()
    {
        return $this->dbService->get('SELECT grade FROM test.grades WHERE student_id = ' . $this->id . ';');
    }
}