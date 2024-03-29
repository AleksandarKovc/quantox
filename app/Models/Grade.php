<?php

namespace App\Models;

class Grade extends BaseModel
{

    private $id;
    private $grade;
    private $student_id;

    /**
     * @param $id
     *
     * @return array|null
     */
    public function get($id)
    {
        $grade = $this->dbService->findOne('SELECT * FROM test.grades WHERE id = ' . $id . ';');

        if ($grade) {
            $this->id = $grade['id'];
            $this->grade = $grade['grade'];
            $this->student_id = $grade['student_id'];

            return $grade;
        }

        return ['message' => 'There is no grade with given id.'];
    }

    /**
     * @param array $data Data for inserting to database.
     *
     * @return string
     */
    public function set($data)
    {
        return $this->dbService->set('INSERT INTO test.grades (`grade`, `student_id`) VALUES ("' . $data['grade'] . '", ' . $data['student_id'] . ');');
    }
}
