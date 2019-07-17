<?php
    namespace app\admin\controller;
    use app\admin\model\Order as OrderModel;
    use think\Controller;

    class Order extends Base
    {
        public function index(){
        	$list=OrderModel::where('state'>=0)->order('id desc')->paginate(4);
            $this->assign('list',$list);
            return $this->fetch();
        }

        public function ss(){
          $tin=input('post.tin');
          $state=input('post.contrller');
          // dump($tin);
          // dump($state);
          // $list=AdminModel::where('adminname','like',"%{$name}%")->order('id desc')->paginate(1,false,['query'=>request()->param()]);
          $list=OrderModel::where('tin',$tin)->where('state',$state)->paginate();
          return view('index',['list'=>$list]);
        }

        public function stateupdate(){
        	$id=input('post.id');
        	dump($id);
        	$res=OrderModel::where('id',$id)->update(['state'=>2]);
        	if($res){
        		return $res;
        	}
        }
    }
 ?>