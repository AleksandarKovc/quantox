<?php

namespace App\Models;

class SchoolBoard extends BaseModel
{

    private $id;
    private $name;

    /**
     * @param $id
     *
     * @return array|null
     */
    public function get($id)
    {
        $schoolBoard = $this->dbService->findOne('SELECT * FROM test.school_boards WHERE id = ' . $id . ';');

        if ($schoolBoard) {
            $this->id = $schoolBoard['id'];
            $this->name = $schoolBoard['name'];

            return $schoolBoard;
        }

        return ['message' => 'There is no school board with given id.'];
    }

    /**
     * @param array $data Data for inserting to database.
     *
     * @return string
     */
    public function set($data)
    {
        return $this->dbService->set('INSERT INTO test.school_boards (`name`) VALUES ("' . $data['name'] . '");');
    }
}
