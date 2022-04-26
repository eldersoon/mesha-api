<?php

namespace App\Http\Controllers;

use App\Models\Register;
use App\Repositories\RegisterRepository;
use Illuminate\Http\Request;

class RegistersController extends Controller
{

    public function get(RegisterRepository $model) {
        return response()->json([
            'registers' => $model->getAll()
        ]);
    }
}
