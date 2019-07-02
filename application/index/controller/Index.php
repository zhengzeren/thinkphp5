<?php
    namespace app\index\controller;
    use think\Controller;
    class Index extends Controller
    {
    public function index(){
            return view();
        }


























    public function panduan(){
        echo(Session::get('id','index'));
    }
    public function aa(Request $request){
        $id=$request->post('id');
        // echo $id;
         $list = Db::table('vip')
        ->find($id);
        // dump($list);
        if ($list['username']==null) {
            echo $list['phone'];
        }else{
            echo $list['username'];
        }
    }
    public function banner(Request $request){

    }
    public function tc(){
        Session::clear('index');
    }
    public function setting(){
        Session::clear('paypwd');
        return $this->fetch();
    }
    }
 ?>