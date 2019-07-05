<?php
    namespace app\admin\controller;
    use app\admin\model\Shop as ShopModel;
    use think\Controller;

    class Shop extends Base
    {
        public function index(){
            $list=ShopModel::order('id desc')->paginate(5);
            return view('',['list'=>$list]);
        }

        public function stateupdate(){
            $result = new ShopModel;
            $id = input('post.id');
            $state = input('post.state');
            if($state == 1){
                 $state = 0;
                 $res = ShopModel::where('id',$id)->update(['state'=>$state]);
                 //dump($res);
                 return "成功下架";
             }else{
                 $state = 1;
                 $res = ShopModel::where('id',$id)->update(['state'=>$state]);
                 //dump($res);
                 return "上架成功";
             }
        }

        public function del(){
            $id = input('post.id');
            $user = ShopModel::get($id);
            if($user){
                $user->delete();
                return "删除成功";
            }else{
                return "删除的商品不存在";
            }
        }

        public function shopadd(){
            $list1=db('type')->select();
            // dump($list1);
            $arr=[];
            for ($i=0; $i <count($list1) ; $i++) { 
                //判断Path以','(逗号)分隔有几位 substr_count()
                if (substr_count($list1[$i]['path'],',')>2) {
                    $arr[$i]['name']=$list1[$i]['name'];
                    $arr[$i]['id']=$list1[$i]['id'];
                }
            }
            //dump($arr);
            return view('',['arr'=>$arr]);
        }
        //brief introduction 简介
        public function bi(){
            $id=input('get.id');
            //dump($id);
            $list = ShopModel::where('id',$id)->find();
            $desc=$list['desc'];
        	return view('',['desc'=>$desc]);
        }
        //Picture management 图片管理
        public function pm(){
        	return view();
        }

    }
 ?>