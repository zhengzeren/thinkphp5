<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Login extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return view();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function dologin(){
        $arr=input('get.');
        $admin=db('admin')->where('adminname',$arr['name'])->find();
        // return $admin;
        if($admin['state']==0){
            return json(['pass'=>'0','info'=>"账号禁止登录"]);
        }else{
        if ($admin==null) {
            return json(['pass'=>'0','info'=>"账号不存在"]);
        }
        if ($admin['pass']!=$arr['pass']) {
            return json(['pass'=>'0','info'=>"密码错误"]);
        }else{
            session('admin',$admin);
            return json(['pass'=>'1','info'=>"登录成功"]);
        }
        }
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function loginout()
    {
        session(null,'think');
        $this->redirect('login/index');
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
