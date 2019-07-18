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
                 return $res;
             }else{
                 $state = 1;
                 $res = ShopModel::where('id',$id)->update(['state'=>$state]);
                 //dump($res);
                 return $res;
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

        public function edit(){
        	//dump(input('get.id'));
        	$id=input('get.id');
        	$list=ShopModel::where('id',$id)->select();

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
        	return view('',['list'=>$list,'arr'=>$arr,'editid'=>$id]);
        }

        public function editadd(){
        	//dump(input('post.'));
        	$id=input('post.id');
        	$res = ShopModel::where('id',$id)->update(input('post.'));
        	return $res;
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

        public function insert(){
            $shop = new ShopModel;
            $shop->goods = input('post.goods');
            $shop->type = input('post.type');
            $shop->changjia = input('post.type');
            $shop->desc = input('post.desc');
            $shop->nums = input('post.nums');
            $shop->yuanjia = input('post.yuanjia');
            $img=input('post.img');
            preg_match_all("/title=\"(\d+\.\w+)\"/",$img,$arr);
            $arr1='';
            for ($i=0; $i < count($arr[1]); $i++) { 
                $arr1.=$arr[1][$i].',';
            }
            $shop->img = $arr1;
            if ($shop->save()) {
            return '新增成功';
            } else {
            return $shop->getError();
            }

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
            $id=input('get.id');
            //dump($id);
            $list = ShopModel::where('id',$id)->find();
            //去除两边的分界符
            $img=trim($list['img'],',');
            //以逗号拆分字符串
            $arr3=explode(',',$img);
            return view('',['arr'=>$arr3,'list'=>$list]);
        }

    }
 ?>