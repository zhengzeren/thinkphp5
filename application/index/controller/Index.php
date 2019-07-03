<?php
    namespace app\index\controller;
    use think\Controller;
    use think\Session;
    class Index extends Controller
    {
        public function index(){
            $arr=db('type')->where('pid',0)->select();
              // dump($arr);
              // echo "<hr>";
             foreach ($arr as $k => $v) {
             $arr[$k]['zi']=db('type')->where('pid',$v['id'])->select();
              // dump($arr);
              //       die();
       }
       // dump($arr);
       foreach ($arr as $k=> $v) {
                   foreach ($arr[$k]['zi'] as $key => $value) {
                       $arr[$k]['zi'][$key]['zi']=db('type')->where('pid',$value['id'])->select();
                   }
               }
               echo "<hr>";
                // dump($arr);
               $this->assign('arr',$arr);
               $phone=session('phone');
                  $this->assign('phone',$phone);
               // if (session('phone','index')!=null) {
               //    $phone=session('phone','index');
               //    $this->assign('phone',$phone);
               // }
               return $this->fetch();
            // return view('',['arr'=>$arr]);
        }

    }
 ?>



















