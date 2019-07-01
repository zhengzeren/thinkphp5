<?php
    namespace app\admin\controller;
    use think\Controller;

    class Sort extends Controller
    {
        public function index(){
            $arr=db('type')->field(['id','name','pid','path','state','concat(path,id)'=>'paixu'])->order('paixu')->select();
            $arrpid=db('type')->field('pid')->select();
            foreach ($arrpid as $v) {
                $newarr[]=$v['pid'];
            }
            return view('',['arr'=>$arr,'newarr'=>$newarr]);
        }
        public function update(){
            $arr['id']=input('get.id');
            $arr['state']=input('get.state');
            // print_r($arr);
            $m=db('type')->update($arr);
            return $m;

        }
    }
 ?>