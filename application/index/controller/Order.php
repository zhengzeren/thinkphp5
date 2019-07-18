<?php
    namespace app\index\controller;
    use think\Controller;
    class Order extends Controller
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

        	$list=db('order')->where('state'>=0)->order('id desc')->select();
        	// dump($list);
        	foreach ($list as $key=>$val) {
        		foreach ($val as $k=>&$value) {
        		// dump($value);
            		//如果返回的数据中有',' 
            		if(substr_count($value,',')>0){
            			//以逗号拆分并去除两边的','
            			$list[$key][$k]=explode(',',trim($value,','));
            		}
            	}
            }
            //dump($list);
            //待支付
            $list1=db('order')->where('state',0)->order('id desc')->select();
            $unpay=db('order')->where('state',0)->count();
            // dump($list);
            foreach ($list1 as $key=>$val) {
                foreach ($val as $k=>&$value) {
                // dump($value);
                    //如果返回的数据中有',' 
                    if(substr_count($value,',')>0){
                        //以逗号拆分并去除两边的','
                        $list1[$key][$k]=explode(',',trim($value,','));
                    }
                }
            }
            //待发货
            $list2=db('order')->where('state',1)->order('id desc')->select();
            //待发货数量
            $tobe=db('order')->where('state',1)->count();
            // dump($list);
            foreach ($list2 as $key=>$val) {
                foreach ($val as $k=>&$value) {
                // dump($value);
                    //如果返回的数据中有',' 
                    if(substr_count($value,',')>0){
                        //以逗号拆分并去除两边的','
                        $list2[$key][$k]=explode(',',trim($value,','));
                    }
                }
            }
            //待收货
            $list3=db('order')->where('state',2)->order('id desc')->select();
            //待收货数量
            $received=db('order')->where('state',2)->count();
            foreach ($list3 as $key=>$val) {
                foreach ($val as $k=>&$value) {
                // dump($value);
                    //如果返回的数据中有',' 
                    if(substr_count($value,',')>0){
                        //以逗号拆分并去除两边的','
                        $list3[$key][$k]=explode(',',trim($value,','));
                    }
                }
            }

            //待评价
            $list4=db('order')->where('state',3)->order('id desc')->select();
            //待收货数量
            $evaluated=db('order')->where('state',3)->count();
            foreach ($list4 as $key=>$val) {
                foreach ($val as $k=>&$value) {
                // dump($value);
                    //如果返回的数据中有',' 
                    if(substr_count($value,',')>0){
                        //以逗号拆分并去除两边的','
                        $list4[$key][$k]=explode(',',trim($value,','));
                    }
                }
            }
            
            return view('',['list'=>$list,'unpay'=>$unpay,'list1'=>$list1,'tobe'=>$tobe,'list2'=>$list2,'received'=>$received,'list3'=>$list3,'evaluated'=>$evaluated,'list4'=>$list4,'user'=>$phone,'username'=>$username]);
        }

        //确认收货的方法
        public function edit(){
            $id=input('post.id');
            $res=db('order')->where('id',$id)->update(['state'=>3]);
            return $res;
        }

        public function pingjia($id){
            $list=db('order')->where('id',$id)->find();
            $sid=$list['sid'];
            $vid=$list['vid'];
            $tin=$list['tin'];
            $arr='';
            $arr=explode(',',trim($sid,','));
            $array='';
            for ($i=0; $i < count($arr); $i++) { 
                $array[$i]=db('shop')->where('id',$arr[$i])->find();
            }
            //查询评价表判断订单中的商品是否已评价
            $comment=db('comment')->where('tin',$tin)->select();
            $sidarr=[];
            foreach ($comment as $key => $value) {
               $sidarr[]=$value['sid'];
            }
            //dump($sidarr);
            return view('',['array'=>$array,'vid'=>$vid,'tin'=>$tin,'sidarr'=>$sidarr]);
        }

        public function pjadd(){
            //dump(input('post.'));
            $res=db('comment')->insert(input('post.'));
            return $res;
        }
    }
 ?>