<?php
    namespace app\admin\controller;
    use app\admin\model\Type as TypeModel;
    use think\Controller;
    class Sort extends Base
    {
        public function index(){
            //$arr=db('type')->field(['id','name','pid','path','state','concat(path,id)'=>'paixu'])->order('paixu')->select();
            //$arrpid=db('type')->field('pid')->select();
            //return view('',['arr'=>$arr,'newarr'=>$newarr]);
            $list=TypeModel::field(['id','name','pid','path','state','concat(path,id)'=>'paixu'])->order('paixu')->select();
            $list1=TypeModel::field('pid')->select();
            $list2=TypeModel::where('pid','eq',0)->order('id desc')->paginate(4);
            foreach ($list1 as $v) {
                $newarr[]=$v['pid'];
            }
            //dump($newarr);
            $this->assign(['list'=>$list,'newarr'=>$newarr,'list2'=>$list2]);
            return $this->fetch();
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