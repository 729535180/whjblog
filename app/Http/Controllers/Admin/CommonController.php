<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    //

    function objectToArray($object) {
        //先编码成json字符串，再解码成数组
        return json_decode(json_encode($object), true);
    }


    //输出数据
    public function toJson($data){
        header('Content-type: application/json');
        echo json_encode($data);die();
    }
}
