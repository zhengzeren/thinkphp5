<?php
    namespace app\admin\controller;
    use app\admin\model\Admin as AdminModel;
    use think\Controller;
    use think\Request;
    class Admin extends Base
    {
        // public function index(){
        //     $list=Db::table('admin')->order('id','desc')->paginate(2);
        //     // dump($list);
        //     $this->assign('list',$list);
        //     return $this->fetch();
        // }

        public function index(){
            $list=AdminModel::where('state'>=0)->order('id desc')->paginate(2);
            $this->assign('list',$list);
            return $this->fetch();
        }
        public function stateupdate(){
            $result = new AdminModel;
            $id = input('post.id');
            $state = input('post.state');
            if($state == 1){
                 $state = 0;
                 $res = AdminModel::where('id',$id)->update(['state'=>$state]);
                 //dump($res);
                 return "禁用成功";
             }else{
                 $state = 1;
                 $res = AdminModel::where('id',$id)->update(['state'=>$state]);
                 //dump($res);
                 return "启用成功";
             }
        }

        public function del(){
            $id = input('post.id');
            $user = AdminModel::get($id);
            if($user){
                $user->delete();
                return "删除成功";
            }else{
                return "删除的用户不存在";
            }
        }
        public function adminadd(){
            return view();
        }
        public function insert(){
            //dump(input('post.'));
            $res=AdminModel::create(input('post.'));
            if($res){
              return "新增成功";
            }else{
              return "新增失败";

            }
        }
        public function update(){
          $id=input('id');
          //dump($id);
          $user=AdminModel::where('id',$id)->find();
            $this->assign('user',$user);
            return $this->fetch();
        }

        public function edit(){
          $id=input('post.id');
          dump(input('post.'));
          $res=AdminModel::update(input('post.'));
          if($res){
             return "修改成功";
          }else{
             return "修改失败";
          }
        }
    }


 ?>