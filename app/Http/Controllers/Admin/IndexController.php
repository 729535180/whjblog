<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Menu;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class IndexController extends CommonController
{
    //
    public function index(){

        $TopNav = $this->getTopNav();
        if($TopNav['status']){
            $nav = $TopNav['data']['rows'];

            return view('admin.index',compact('nav'));
        }else {
            return view('admin.index');
        }
    }


    public function menu(Request $request){
        $url = $request->url();
        $url_ar = explode('_',$url);
        $url_arr = explode('.',$url_ar[1]);
        $pid = $url_arr[0];
        $TopNav = $this->getNav($pid);
        $list = [];
        foreach($TopNav['data']['rows'] as $v){
            $list[] = [
                "id"=>$v['menu_id'],
                "pid"=>$v['pid'],
                "state"=>"open",
                "iconCls"=>"",
                "text"=>$v['menu_name'],
                "url"=>$v['url'].'?'.$v['param'],
            ];
        }
        $this->toJson($list);
        //$data = $request->input();
        //var_dump($data);
        //echo 'ssss';die();
    }



    public function getTopNav(){
        $data = $this->getNav(0);
        if($data['status']){
            $data['data']['rows'][0]['selected'] = 'selected';
            return $data;
        }else{
            //return $this->erro('没有找到顶部菜单');
        }
    }


    public function getNav($pid,$status=1,$page_info=[]){
        $limit = '';
        $where = ['pid'=>$pid,'status'=>$status];
        if(!empty($page_info) && is_array($page_info)){
            $page = (int)$page_info['page'];
            $rows = (int)$page_info['rows'];
            if($page<=0){
                $page = 1;
            }
            $offset = ($page-1)*$rows;
            $limit = "{$offset},{$rows}";
        }else{
            $limit = 1000;
        }

        $total = DB::table("lar_menu")->where($where)->count();

        $list = DB::table("lar_menu")->where($where)->orderBy('menu_sort','desc')->limit($limit)->get();
        $list = $this->objectToArray($list);

        if($list){



            foreach($list as &$v){
                $v['selected'] = '';
                if($v['domain']){
                    $domain = $v['domain'];
                }else{
                    $domain = $_SERVER['SERVER_NAME'];
                }
                if($v['is_ssl']==1){
                    $arg = 'https://';
                }else{
                    $arg = 'http://';
                }
                if($v['menu_module'] && $v['menu_controller'] && $v['menu_action']){
                    $v['url'] = "{$arg}{$domain}/{$v['menu_module']}/{$v['menu_controller']}/{$v['menu_action']}.html";
                }else{
                    $v['url'] = '';
                }
            }

            return $this->succ(['rows'=>$list,'total'=>$total]);
        }else{
            return $this->erro('没有找到菜单');
        }
    }


    public function succ($data=[],$msg='ok'){
        return [
            'status'=>true,
            'msg'=>$msg,
            'data'=>(array)$data,
            'code'=>'',
        ];
    }
}
