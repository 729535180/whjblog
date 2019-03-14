<?php
/**
 * Created by PhpStorm.
 * User: zuopeng
 * Date: 2018/2/4
 * Time: 下午5:09
 */
namespace App\Http\Server;

use App\Http\Controllers\Controller;

class Server extends Controller {

    protected function succ($data=[],$msg='ok'){
        return [
            'status'=>true,
            'msg'=>$msg,
            'data'=>(array)$data,
            'code'=>'',
        ];
    }

    protected function erro($msg,$data=[]){
        return [
            'status'=>false,
            'msg'=>$msg,
            'data'=>(array)$data,
            'code'=>'',
        ];
    }

    protected function erro_($code,$msg='',$data=[]){
        return [
            'status'=>false,
            'msg'=>$msg,
            'data'=>(array)$data,
            'code'=>$code,
        ];
    }

}