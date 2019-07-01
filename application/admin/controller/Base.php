<?php
 namespace app\admin\controller;
 use think\Controller;
 use think\Request;
 class Base extends controller
 {
    public function _initialize(){
        $a=session('admin');
        if (empty($a)) {
            $this->redirect('admin/login/index');
        }
    }
 }
 ?>