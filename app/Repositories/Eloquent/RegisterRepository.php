<?php

namespace App\Repositories\Eloquent;

use App\Models\Register;
use App\Repositories\Contracts\RegisterRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class RegisterRepository implements RegisterRepositoryInterface{


    public function __construct() {
        $this->model = app(Register::class);
    }

    public function getAll($select) {

        $registers = $this->model->select($select)
        ->with(['registerKnowledge.knowledge'])->get();


        foreach($registers as $register) {
            $know = [];
            foreach($register->registerKnowledge as $relationship) {
                array_push($know, $relationship->knowledge);
            }
            $register->knowledge = $know;
            unset($register->registerKnowledge);
        }

        return $registers;
    }

    public function getOne($select, $id){
        $register = $this->model->select($select)
            ->with(['registerKnowledge.knowledge'])
            ->where('id', $id)
            ->first();

        $know = [];
        foreach($register->registerKnowledge as $relationship) {
            array_push($know, $relationship->knowledge);
        }
        $register->knowledge = $know;
        unset($register->registerKnowledge);

        return $register;
    }

    public function create($model, $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:100',
            'email' => 'required|unique:registers,email|max:100',
            'cpf'=> 'required|unique:registers,cpf|max:14',
            'celphone' => 'nullable',
            'knowledges' => 'required'
        ],[
            'required' => 'Campo obrigatório',
            'unique' => 'O :attribute já existe.'
        ]);

        if($validator->fails()) {
            return response()->json([
                'response' => [],
                'message' => 'Erro ao efetuar operação.',
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        try {
            $register = $this->model::create([
                "name" => $request->name,
                "email" => $request->email,
                "cpf" => $request->cpf,
                "celphone" => $request->celphone,
            ]);

            if($register) {
                foreach($request->knowledges as $knowledge) {
                    $model->create([
                        "register_id" => $register->id,
                        "knowledge_id" => $knowledge
                    ]);
                }
            }
        } catch (\PDOException $err) {
            $errors = [];
            foreach($err as $e){
                array_push($errors, $e);
            }
            return response()->json([
                'response' => [],
                'message' => 'Erro ao efetuar operação.',
                'status' => 400,
                'errors' => $errors
            ]);
        }

        return response()->json([
            'response' => [],
            'message' => 'Operação efetuada com sucesso.',
            'status' => 200,
            'errors' => []
        ]);
    }

    public function update($request){}

    public function delete($id){
       try {
            $register = $this->model::find($id);
            $register->active = 0;
            $register->save();
       } catch (\PDOException $err) {
            $errors = [];
            foreach($err as $e){
                array_push($errors, $e);
            }
            return response()->json([
                'response' => [],
                'message' => 'Erro ao efetuar operação.',
                'status' => 400,
                'errors' => $errors
            ]);
       }

        return response()->json([
            'response' => [],
            'message' => 'Operação efetuada com sucesso.',
            'status' => 200,
            'errors' => []
        ]);
    }

    public function valid($id){

        try {
            $register = $this->model::find($id);

            if($register->valid == 1) {
                $register->valid = 0;
                $register->save();
            } else {
                $register->valid = 1;
                $register->save();

            }
        } catch (\PDOException $err) {
            $errors = [];
            foreach($err as $e){
                array_push($errors, $e);
            }
            return response()->json([
                'response' => [],
                'message' => 'Erro ao efetuar operação.',
                'status' => 400,
                'errors' => $errors
            ]);
       }

        return response()->json([
            'response' => [],
            'message' => 'Operação efetuada com sucesso.',
            'status' => 200,
            'errors' => []
        ]);

    }
}
