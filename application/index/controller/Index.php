<?php
    namespace app\index\controller;
    use think\Controller;
    use think\Session;
    class Index extends Controller
    {
        public function index(){
            //查询根分类
            $arr=db('type')->where('pid',0)->select();
            // dump($arr);
            //查询二级分类
            foreach ($arr as $k => $v) {
            $arr[$k]['zi']=db('type')->where('pid',$v['id'])->select();
            // dump($arr);
            }
            //查询三级分类
            foreach ($arr as $k=> $v) {
               foreach ($arr[$k]['zi'] as $key => $value) {
                   $arr[$k]['zi'][$key]['zi']=db('type')->where('pid',$value['id'])->select();
               }
            }
            //判断是否登录
            $phone=session('phone');
            $name=db('vip')->where('phone',$phone)->find();
            if($name==null){
              $username="默认名，请在个人中心设置！";
            }else{
              $username=$name['username'];
            }

            //轮播图
            $images=db('banner')->where('state',1)->select();

            //楼层内容 -- 沙发查询最新的6条
            $sofa=db('shop')->where('type',143)->where('state',1)->limit(6)->select();

            //购物车数量
            $baynum=db('shopcart')->count();
            //dump($baynum);
            return view('',['user'=>$phone,'username'=>$username,'arr'=>$arr,'images'=>$images,'sofa'=>$sofa,'baynum'=>$baynum]);
        }
    }
 ?>



















