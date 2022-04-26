<?php

namespace App\Repositories\Contracts;

interface RegisterRepositoryInterface {

    public function getAll($select);

    public function getOne($select, $id);

    public function create($model, $request);

    public function update($request);

    public function delete($id);
}
