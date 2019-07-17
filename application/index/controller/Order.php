<?php
    namespace app\index\controller;
    use think\Controller;
    class Order extends Controller
    {
        public function index(){
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
            return view('',['list'=>$list]);
        }

    }
 ?>