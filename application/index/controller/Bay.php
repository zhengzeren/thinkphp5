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
            $list=db('shop')->alias('a')->join('shopcart s','s.shop_id=a.id')->where('s.vip_phone',$phone)->select();
            // dump($list);
            return view('',['user'=>$phone,'username'=>$username,'list'=>$list]);
        }
        public function add_car(){
            //获取账号
            $phone=session('phone');
            $num=input('post.num');
            $id=input('post.id');
            //判断购物车表中是否新添加的商品
            $list=db('shopcart')->where('shop_id',$id)->where('vip_phone',$phone)->find();
            if($list['id']!==null){
                //如果有就加上新添加的数量
                $nums=$list['num']+$num;
                $res=db('shopcart')->where('id',$list['id'])->update(["num"=>$nums]);
                return $res;
            }
            //没有就新添加商品
            $res=db('shopcart')->insert(['vip_phone'=>$phone,'shop_id'=>$id,'num'=>$num]);
            return $res;
        }
        public function edit(){
            $res=db('shopcart')->where('id',input('post.id'))->update(input('post.'));
            var_dump($res);
            //return $res;
        }

        public function del(){
            $res=db('shopcart')->where('id',input('post.id'))->delete();
            return $res;
        }

        public function pay(){
        	$phone=session('phone');
        	$list=db('vip')->where('phone',$phone)->find();
        	$id=$list['id'];
            $array=input('post.');
            for ($i=0; $i < count($array['cart']); $i++) { 
            	$arr[$i]=explode('+',$array['cart'][$i]);
            }
            dump($arr);
            $order_id=date("ymdHis").str_pad($id,6,"0",STR_PAD_LEFT);

            //return view();
        }
    }
 ?>