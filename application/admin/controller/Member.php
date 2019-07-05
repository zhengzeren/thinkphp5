<?php
    namespace app\admin\controller;
    use app\admin\model\Member as MemberModel;
    use think\Controller;
    class Member extends Base
    {
    	public function index(){
            $list=MemberModel::where('state'>=0)->order('id desc')->paginate(4);
            $this->assign('list',$list);
            return $this->fetch();
        }

        public function stateupdate(){
            $result = new MemberModel;
            $id = input('post.id');
            $state = input('post.state');
            if($state == 1){
                 $state = 0;
                 $res = MemberModel::where('id',$id)->update(['state'=>$state]);
                 //dump($res);
                 return "禁用成功";
             }else{
                 $state = 1;
                 $res = MemberModel::where('id',$id)->update(['state'=>$state]);
                 //dump($res);
                 return "启用成功";
             }
        }

        public function ss(){
          $phone=input('post.phone');
          //dump($phone);
          $list=MemberModel::where('phone','like',"%{$phone}%")->order('id desc')->paginate(5,false,['query'=>request()->param()]);
          
          return view('index',['list'=>$list]);
        }
    }
 ?>