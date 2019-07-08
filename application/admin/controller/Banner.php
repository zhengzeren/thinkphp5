<?php
    namespace app\admin\controller;
    use app\admin\model\Banner as BannerModel;
    use think\Controller;

    class Banner extends Base
    {
        public function index(){
            $list=BannerModel::order('id desc')->paginate(5);
            //dump($list);
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

        public function add(){
        	
            return view('');
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