<?php

namespace App\Repositories\Eloquent;

use App\Models\Register;
use App\Repositories\Contracts\RegisterRepositoryInterface;

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

        return $register;
    }

    public function update($request){}

    public function delete($id){
        $register = $this->model::find($id);
        $register->active = 0;
        $register->save();

        $message = "Registro desativado";

        return  $message;
    }

    public function valid($id){
        $register = $this->model::find($id);


        if($register->valid == 1) {
            $register->valid = 0;
            $register->save();

            $message = "Registro não válido";

            return  $message;
        }

        $register->valid = 1;
        $register->save();

        $message = "Registro válido";

        return  $message;
    }
}
