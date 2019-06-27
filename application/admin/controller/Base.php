<?php
 namespace app\admin\controller;
 use think\Controller;
 use think\Request;
 class Base extends Controller
 {
    public function _initialize(){
        $a=session('user');
        if (empty($a)) {
            $this->redirect('admin/login/index');
        }
    }
 }
 ?>