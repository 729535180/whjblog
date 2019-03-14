<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

    //调用公共头尾
    public function index(){
        return view('home/index');
    }

    //模板，定义布局与使用
    public function layouts(){
        return view('home/layouts');
    }

    public function mysql(){

        //$pdo = DB::connection()->getPdo();
        //dd($pdo);

        //$user = DB::table('users')->where("user_id",1)->get();
        //dd($user);

        $us_t = User::find(1);
        dd($us_t);

        echo 'ssssss';
        return view('home/index');
    }

    //
    public function indexa(){
        $name = 'home_index';
        $age = 22;
        return view('Home/my_laravel')->with('name',$name)->with('age',$age);
    }

    public function index_two(){
        $data = [
            'name'=>'名称',
            'age'=>19
        ];
        return view('home/my_laravel',$data);
    }
    public function index_the(){
        $data = [
            'name'=>'名称',
            'age'=>19
        ];
        $title='btll';
        return view('Home/my_laravel_two',compact('data','title'));
    }
}
