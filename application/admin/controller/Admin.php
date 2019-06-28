<?php
    namespace app\admin\controller;
    use think\Controller;
    use think\Db;
    class Admin extends Controller
    {
        public function index(){
            $list=Db::table('admin')->order('id','desc')->paginate(2);
            // dump($list);
            $this->assign('list',$list);
            return $this->fetch();
        }
        public function adminadd(){
            return view();
        }
        public function insert(){
            dump(input('get.'));
        }


        public function adminedit(){
            return view();
        }
    }
 ?>