<?php

namespace App\Repositories;

use App\Models\Register;

class RegisterRepository {


    public function __construct() {
        $this->model = app(Register::class);
    }

    public function getAll() {

        $collection = $this->model->select('id', 'name', 'email', 'celphone', 'valid')
        ->with(['registerKnowledge.knowledge'])->get();


        foreach($collection as $register) {
            $know = [];
            foreach($register->registerKnowledge as $relationship) {
                array_push($know, $relationship->knowledge);
            }
            $register->knowledge = $know;
            unset($register->registerKnowledge);
        }

        return $collection;
    }

    public function getOne(){}

    public function create(){}

    public function update(){}

    public function delete(){}
}
