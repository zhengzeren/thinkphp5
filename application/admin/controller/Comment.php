<?php
	namespace app\admin\controller;
	use think\Controller;

	class Comment extends Base
	{
		public function index(){
			$list=db('comment')->alias('a')->join('shop s','s.id=a.sid')->where('a.state','>=',0)->paginate(5);
			//dump($list);
			return view('',['list'=>$list]);
		}

		public function sc(){
			$id=input('get.sid');
			$list=db('comment')->alias('a')->join('vip s','s.id=a.vid')->where('a.sid',$id)->select();
			//dump($list);
			return view('',['list'=>$list]);
		}
	}
 ?>