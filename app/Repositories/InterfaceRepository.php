<?php

namespace App\Repositories;

interface InterfaceRepository {

    public function getAll();

    public function getOne();

    public function create();

    public function update();

    public function delete();
}
