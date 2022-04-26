<?php

namespace App\Http\Controllers;

use App\Models\RegisterKnowledge;
use App\Repositories\Eloquent\RegisterKnowledgeRepository;
use App\Repositories\Eloquent\RegisterRepository;
use Illuminate\Http\Request;

class RegistersController extends Controller
{
    public function __construct()
    {
        $this->registerKnowledgeModel = app(RegisterKnowledge::class);
    }

    public function getAll(RegisterRepository $model) {
        $select = ['id', 'name', 'email', 'celphone', 'valid'];

        return $model->getAll($select);
    }

    public function getOne(RegisterRepository $model, $id) {
        $select = ['id', 'name', 'email', 'celphone', 'valid'];

        return $model->getOne($select, $id);
    }

    public function create(RegisterRepository $model, Request $request) {
        return $model->create($this->registerKnowledgeModel, $request);
    }

    public function delete(RegisterRepository $model, $id) {
        return $model->delete($id);
    }

    public function valid(RegisterRepository $model, $id) {
        return $model->valid($id);
    }
}
