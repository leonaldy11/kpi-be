<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Hash;

class LoginControllers extends Controller
{
    protected $ResponseHelper;

    public function __construct(ResponseHelper $ResponseHelper)
    {
        $this->ResponseHelper = $ResponseHelper;
    }

    public function auth(Request $request)
    {
        $data =  User::where("email",$request->email)->first();
        if ($data) {
            if (Hash::check($request->password,$data->password)) {
                return $this->ResponseHelper->successResponse("Berhasil login");
            }else{
                return $this->ResponseHelper->errorResponse("Data login salah !");
            }
        }
        return $this->ResponseHelper->errorResponse("Email tidak ditemukan !");
    }
    
}
