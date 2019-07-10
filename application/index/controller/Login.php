<?php
namespace app\index\controller;
use think\Request;
use think\Controller;
use think\Db;

use think\Session;
class Login extends Controller{
    //跳转登录界面
    public function index(){
        Session::clear('index');
        // Session::clear('yanzheng');
        return $this->fetch();

    }
    //跳转注册界面
    public function register(){
        //Session::clear('yanzheng');
        Session::clear('index');
        return $this->fetch();
    }
    //跳转注册界面
    public function ftp(){
        // Session::clear('yanzheng');
        Session::clear('index');
        return $this->fetch();
    }
    //登录条件判断
    public function loginif(Request $request){
        //获取登录页面传来的值
        $data = $request->post('formdata');
        parse_str($data,$arr);
        //给传过来的密码加密
        $pass=md5($arr['pass']);
        //已手机号查出这条信息
        $list = Db::table('vip')
        ->where('phone',$arr['phone'])
        ->find();
        //如果没有查出证明这个手机号没注册
        if ($list==null) {
            echo "null";
        }else{
            //查出来后判断密码是否正确
            if ($list['pass']==$pass) {
                //判断状态是否启用
                if ($list['state']==0) {
                    echo 2;
                }else{
                    //账号启用将id存入session
                    Session::set('id',$list['id'],'index');
                    Session::set('phone',$list['phone']);
                    echo $list['phone'];
                }
            }else{
                //密码不正确返回1
                echo 1;
            }
        }
    }
    public function tc(){
         Session::clear();
         return 1;
    }
    public function add(Request $request){
        $data = $request->post('formdata');
        parse_str($data,$arr);
        $pass=md5($arr['pass']);
        $addtime = date('Y-m-d H:i:s');
        $code=Session::get('code','yanzheng');
        if ($code!=$arr['code']) {
            echo 3;
        }else{
            $list = Db::table('vip')
            ->where('phone',$arr['phone'])
            ->find();
            if ($list==null) {
                $add = Db::table('vip')
                ->insert(["phone"=>$arr['phone'],"pass"=>$pass,"date"=>$addtime]);
                if ($add==1) {
                    Session::set('phone',$arr['phone'],'zhuce');
                    echo 1;
                }else{
                    echo 0;
                }
            }else{
                echo 2;
            }
        }

    }
    public function xin(){
        echo(Session::get('phone','zhuce'));
        Session::delete('phone','zhuce');
    }
    public function yanzheng(Request $request){
        // Session::clear('yanzheng');
        $phone = $request->post('phone');
        // echo $phone;
        $list = Db::table('vip')
        ->where('phone',$phone)
        ->find();
        if ($list!=null) {
            return 1;
        }else{
            //短信验证
                $host = "https://cdcxdxjk.market.alicloudapi.com";
                $path = "/chuangxin/dxjk";
                $method = "POST";
                $appcode = "5e1e3844fb584a2eaac4e602d14ac82f";
                $headers = array();
                $code=mt_rand(0000,9999);
                array_push($headers, "Authorization:APPCODE " . $appcode);
                $querys = "content=【创信】你的验证码是：{$code}，3分钟内有效！&mobile={$phone}";
                $bodys = "";
                $url = $host . $path . "?" . $querys;

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_FAILONERROR, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_HEADER, true);
                if (1 == strpos("$".$host, "https://"))
                {
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                }
                 $out_put = curl_exec($curl);
                  $arr = json_decode($out_put,true);
                  if ($arr['Message'] !== "ok") {
                    Session::set("code",$code,"yanzheng");
                    echo 2;
                  }else{
                    echo 3;
                  }
        }

    }
    public function qingchu(){
            // Session::clear('yanzheng');
    }



    //----------->忘记密码验证
    public function ftpyanzheng(Request $request){
        // Session::clear('yanzheng');
        $phone = $request->post('phone');
        // echo $phone;
        $list = Db::table('vip')
        ->where('phone',$phone)
        ->find();
        if ($list==null) {
            return 1;
        }else{
            //短信验证
                $host = "https://cdcxdxjk.market.alicloudapi.com";
                $path = "/chuangxin/dxjk";
                $method = "POST";
                $appcode = "5e1e3844fb584a2eaac4e602d14ac82f";
                $headers = array();
                $code=mt_rand(0000,9999);
                array_push($headers, "Authorization:APPCODE " . $appcode);
                $querys = "content=【创信】你的验证码是：{$code}，3分钟内有效！&mobile={$phone}";
                $bodys = "";
                $url = $host . $path . "?" . $querys;

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_FAILONERROR, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_HEADER, true);
                if (1 == strpos("$".$host, "https://"))
                {
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                }
                 $out_put = curl_exec($curl);
                  $arr = json_decode($out_put,true);
                  if ($arr['Message'] !== "ok") {
                    Session::set("code",$code,"yanzheng");
                    echo 2;
                  }else{
                    echo 3;
                  }
        }

    }
    public function editpass(Request $request){
        $data = $request->post('formdata');
        parse_str($data,$arr);
        $up=Db::table('vip')
        ->where('phone',$arr['phone'])
        ->update(['pass'=>""]);
        $code=Session::get('code','yanzheng');
        if ($code==null) {
           echo 4;
        }else{
            if ($code!=$arr['code']) {
                echo 3;
            }else{
                $up=Db::table('vip')
                ->where('phone',$arr['phone'])
                ->update(['pass'=>md5($arr['pass'])]);
                Session::set('phone',$arr['phone'],'zhuce');
                echo $up;
            }
        }

    }
}
