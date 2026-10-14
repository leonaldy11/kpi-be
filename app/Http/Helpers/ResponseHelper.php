<?php
namespace App\Http\Helpers;
use Illuminate\Support\Facades\Response;

class ResponseHelper
{
    public function pagination($paginator,$item){
        $response = [
            'data' => array_values($item),
            'page' => [
                'total' => $paginator->total(),
                'pageCount' => $paginator->lastPage(),
                'currentPage' => $paginator->currentPage(),
                'perPage' => $paginator->perPage(),
            ],
        ];
        return Response::json($response,200);
    }

    public function successResponse($message){
        $response = [
           'status' => 200,
           'message' => $message
        ];
        return Response::json($response,200);
    }

    public function errorResponse($message){
         $response = [
           'status' => 400,
           'message' => $message
        ];
        return Response::json($response,400);
    }
}

?>
