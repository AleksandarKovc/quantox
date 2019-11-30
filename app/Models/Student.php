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
     * @return array
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

        die('There is no student with given id.');
    }

    /**
     * @param array $data Data for inserting to database.
     *
     * @return string
     */
    public function set($data)
    {
        return $this->dbService->set('INSERT INTO test.students (`name`, `school_board_id`) VALUES ("' . $data['name'] . '", ' . $data['school_board_id'] . ');');
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
