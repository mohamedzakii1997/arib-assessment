<?php

namespace App\Traits;


trait ApiResponses {




    protected function ok($message,$data = [],$pagination = null)
    {

        return $this->success($message,$data,$pagination,200);

    }

    protected function success($message,$data = [] ,$pagination = null ,$statusCode = 200)
    {

        return response()->json([
            'message'=>$message,
            'status'=>$statusCode,
            'data'=> $data ,
            'pagination'=>$pagination,

        ],$statusCode);

    }



    protected function error($message, $statusCode)
    {

        return response()->json([
            'message'=>$message,
            'status'=>$statusCode
        ],$statusCode);

    }

}
