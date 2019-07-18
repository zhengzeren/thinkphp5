<?php
    namespace app\index\controller;
    use think\Controller;
    class Shop extends Controller
    {
        public function shop_list(){
        	//判断是否登录
            $phone=session('phone');
            $name=db('vip')->where('phone',$phone)->find();
            if($name==null){
              $username="默认名，请在个人中心设置！";
            }else{
              $username=$name['username'];
            }

            $typeid=input('get.id');
            $list=db('shop')->where('type',$typeid)->select();
            $list1=db('shop')->where('state',1)->limit(4)->select();
            return view('shop_list',['user'=>$phone,'username'=>$username,'list'=>$list,'list1'=>$list1]);
        }

        public function shop_show(){
        	//判断是否登录
            $phone=session('phone');
            $name=db('vip')->where('phone',$phone)->find();
            if($name==null){
              $username="默认名，请在个人中心设置！";
            }else{
              $username=$name['username'];
            }

            // dump(input('id'));
            //查询商品
            $id=input('id');
            $shop=db('shop')->where('id',$id)->where('state',1)->select();

            $commentnum=db('comment')->where('sid',$id)->count();
            $comment=db('comment')->alias('a')->join('vip s','s.id=a.vid')->where('a.sid',$id)->select();

            return view('shop_show',['user'=>$phone,'username'=>$username,'shop'=>$shop,'commentnum'=>$commentnum,'comment'=>$comment]);
        }

    }
 ?>