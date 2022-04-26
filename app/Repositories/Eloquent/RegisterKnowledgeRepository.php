<?php

namespace App\Repositories\Eloquent;

use App\Models\RegisterKnowledge;
use App\Repositories\Contracts\RegisterKnowledgeRepositoryInterface;

class RegisterKnowledgeRepository implements RegisterKnowledgeRepositoryInterface{


    public function __construct() {
        $this->model = app(RegisterKnowledge::class);
    }

    public function getAll($select) {

        $knowledges = $this->model->select($select)->get();

        return $knowledges;
    }

    public function create($request){
        $register = $this->model::create([
            "register_id" => $request->register_id,
            "knowledge_id" => $request->knowledge_id
        ]);

        return $register;
    }
}
