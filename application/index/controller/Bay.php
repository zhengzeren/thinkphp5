<?php
    namespace app\index\controller;
    use think\Controller;
    class Bay extends Controller
    {
        public function index(){
            //判断是否登录
            $phone=session('phone');
            $name=db('vip')->where('phone',$phone)->find();
            if($name==null){
              $username="默认名，请在个人中心设置！";
            }else{
              $username=$name['username'];
            }

            //遍历购物车表
            $list=db('shopcart')->where('vip_phone',$phone)->select();
            $listshop=db('shopcart')->field('shop_id')->where('vip_phone',$phone)->select();
            dump($listshop);
            foreach ($listshop as $v) {
                $shop[]=$v["shop_id"];
            }
            $arr=db('shop')->where('id',"in",$shop)->select();
            dump($arr);
            return view('',['user'=>$phone,'username'=>$username,'arr'=>$arr]);
        }
        public function add_car(){
            $phone=session('phone');
            $num=input('post.num');
            $id=input('post.id');
            $arr=db('shop')->find($id);
            $price=$arr['yuanjia'];
            $total=$price*$num;
            $res=db('shopcart')->insert(['vip_phone'=>$phone,'shop_id'=>$id,'num'=>$num,'total_prices'=>$total]);
            return $res;
        }

    }
 ?>