<?php

namespace App\Repositories\Contracts;

interface RegisterKnowledgeRepositoryInterface {

    public function getAll($select);

    public function create($request);
}
