<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Hash;

class UserControllers extends Controller
{
    protected $ResponseHelper;

    public function __construct(ResponseHelper $ResponseHelper)
    {
        $this->ResponseHelper = $ResponseHelper;
    }

    public function store(Request $request)
    {
        $password =  Hash::make($request->password);

        $data = [
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => $password
        ];

        User::create($data);

        return $this->ResponseHelper->successResponse("Berhasil Simpan Data");
    }

}
