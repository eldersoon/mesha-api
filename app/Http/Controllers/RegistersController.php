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

        return response()->json([
            'registers' => $model->getAll($select)
        ]);
    }

    public function getOne(RegisterRepository $model, $id) {
        $select = ['id', 'name', 'email', 'celphone', 'valid'];

        return response()->json([
            'register' => $model->getOne($select, $id)
        ]);
    }

    public function create(RegisterRepository $model, Request $request) {
        return response()->json([
            'register' => $model->create($this->registerKnowledgeModel, $request)
        ]);
    }

    public function delete(RegisterRepository $model, $id) {
        return response()->json([
            'register' => $model->delete($id)
        ]);
    }

    public function valid(RegisterRepository $model, $id) {
        return response()->json([
            $model->valid($id)
        ]);
    }




}
