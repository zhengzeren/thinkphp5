<?php
    namespace app\index\controller;
    use think\Controller;
    require_once dirname(dirname(dirname(dirname(__FILE__)))).'/extend/alipay/pagepay/service/AlipayTradeService.php';
	require_once dirname(dirname(dirname(dirname(__FILE__)))).'/extend/alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php';
    class Bay extends Controller
    {
    	public $config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016100200644780",

		//商户私钥
		'merchant_private_key' => "MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCSGsHod75GQ5Pw7kfPm+DNfjGeAsscdzsj127XxQ423tPTl7yxbaxUZBUU0DQIGPm4QIOafIWxwkXhmykBr04yBA4BYnDFhG4uAwmCBv7MGqOrJW1aZWE8ORpP6FqJZ0I0K6bYV6aqmmp70jSzLUQsiubmp4BieQbDerczVOmx7DO+OK+ADCkau42NhEWJGixxAVGIJWSUY8vifpLkOljRZEox4utQajDO0d6bSP3/3UsXwsdK5Kq0smMrruWgJ3kWdxJWuQI9g0nWza2z4zLGRDpB0jwJ31cmzXCqV5coeKuk2sX9rCwqckPPdau7411I56FY3KvNlqlBsJK1gQXfAgMBAAECggEAA2SfsDhnsNYM74F5JXcnR15w5IyIDwct1m1AY75t0BRosvdJKI21fNg+LReQvcdmtUK6S7IsoK40VUL3NtTNahfyA1I38D5dGLB1XhGvhSnxNx5NZdYI5g8lb0mkIKDHRtLksw2GD1w6sNl249pfRPGM3zpwntjUsWF+M7D7JGigrZ7QHp1OFDqPS+jg1JA8BGtKrbkB3zrvt0C4HjLPMUfM+5h84Yr6ZQpiR5rAJXQV8K2uhPTSS4nU7nHcaKZikM2+rf//NmvScP4+UhSdVzHEUuVo9vi9kEdQ9b3EwAWzBJClcXW9lXbD+XTCfpsLQfIHZpXyIyAjcijt2kCOoQKBgQDx31fgAqDHyy2dl9kKaFbyi0XvX4FR21LilLDRLPdV2jz7E7vkcURYe3nQGSszyDIEo3A0S6+7FeKNBBOtEDI12aU6SkQKTSInZGwnGqYk+TKqykxyx1oY15AjpZDIGO/LecDL127y+LVzD8FqdSESNH7IJZ/8lnHO/4SkK9wAuQKBgQCao2vJh/HSwXyGQFH17HEMCYGsqzd7+drtpTHF70jVMzO2KFVeqrF2GAG3YfwxHxKm31x29+q3t68gc9XygVv/Fb7BjYU/hZEYN7t1uWAjBr424d6eeREYdh0idFa0hTLrOZ+GvxoP83HkjyOcjCKGyturrs45S54yWE+Wiel/VwKBgQCu/qBdeolJBD9kndByLzt5EDrxDXBLARvewyWKsbXhb5xfK8/tX+XK/ssLPKp9NIK7yGQN8hSajyLyU9jIhcdOHsHkgobnzRbA2W9Ge4lphsKZvvPAt2sAPjYTFF7D5wbXeKd808l6EWd2cBfIJiZfPYvc0xwFa/O7iDM3dGQgQQKBgGzUdGhaB4PG7kdhfw0vgQPysNN/kEXtOvmjGBtwYvbA2TTqv+InCUvOa27PQ/iiILNWYTHNGuB/In4ZZ8oK5l7ow95eJhflfY7oskKQ2yrrdPUVE2K+W5y2i5yS+e6EC6jmXfIsDkCJmW88mdhz+1yX6e+yz6odINHXuvN8TdtzAoGAGdL4/a4r8nrhCJnmwQu3/fGThcVfTRozGMS625y1f7iv0sUj9nlWMNvgWVWHERnvYf+2xySNoSiCyOikQgRISfK2LaStF3VP+J2LSlbJoN+8fDq8ruXMCvPPLsI2R/GvIwGVWptfVSIfId5/gr5VcYkW6HD1spC1XCp/rKPgU3w=",
		
		//异步通知地址
		'notify_url' => "http://www.zzz.com/index/bay/notify_url",
		
		//同步跳转
		'return_url' => "http://www.zzz.com/index/bay/return_url",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApffHTnArse+6iiKu0bRt/vGD7OyOcR+mJeuDxxoyZ6wkmOR5cQS8AoMuJDQrI/xAQNg+hRFCK68ygTU0EC8mFy6Emex1RCCS8vLD84ao/hwHOe0qMGQpDm4DtzKCtAB77PIveqoW7z/hddiQKiael3Pu9p+o66g6au21jE5uFYj6kgbz9ndzl38RbcH3zQjaHgCOSFsri09KiiO61ambzBVZpwRycBn1+K7xrNWQT6XsA1/KKwMEPdG0vhQFwDjLRqyQNLJ3tMwkAhGERJsTtSSjtJw6C4CDlx1n4r+o9RfTE5dLwzAjMhsFoJ2lEdRPPs3qFncy3zIGbfdI09qWxQIDAQAB",
);

        public function index(){
            //判断是否登录
            $phone=session('phone');
            $name=db('vip')->where('phone',$phone)->find();
            if($name==null){
              $username="默认名，请在个人中心设置！";
            }else{
              $username=$name['username'];
            }

            //遍历购物车表
            $list=db('shop')->alias('a')->join('shopcart s','s.shop_id=a.id')->where('s.vip_phone',$phone)->select();
            // dump($list);
            return view('',['user'=>$phone,'username'=>$username,'list'=>$list]);
        }

        public function add_car(){
            //获取账号
            $phone=session('phone');
            $num=input('post.num');
            $id=input('post.id');
            //判断购物车表中是否新添加的商品
            $list1=db('shop')->where('id',$id)->find();
            $list=db('shopcart')->where('shop_id',$id)->where('vip_phone',$phone)->find();
            if($list['id']!==null){
                //如果有就加上新添加的数量
                $nums=$list['num']+$num;
                $total=$num*$list1['yuanjia'];
                $res=db('shopcart')->where('id',$list['id'])->update(["num"=>$nums,"total"=>$total]);
                return $res;
            }
            //没有就新添加商品
            echo $total=$num*$list1['yuanjia'];
            $res=db('shopcart')->insert(['vip_phone'=>$phone,'shop_id'=>$id,'num'=>$num,"total"=>$total]);
            return $res;
        }

        public function edit(){
            $res=db('shopcart')->where('id',input('post.id'))->update(input('post.'));
            var_dump($res);
            //return $res;
        }

        public function del(){
            $res=db('shopcart')->where('id',input('post.id'))->delete();
            return $res;
        }

        public function pay(){
        	//判断是否登录
            $phone=session('phone');
            $name=db('vip')->where('phone',$phone)->find();
            if($name==null){
              $username="默认名，请在个人中心设置！";
            }else{
              $username=$name['username'];
            }

            //获取购物车页面传过来的商品ID和购物车ID赋给array数组
            $array=input('post.');
            if (count($array)>1) {
            	//商品ID
            	$sid=$array['shopid'].',';
            	//购买数量
            	$num=$array['num'];
            	//商品名称
            	$sname=db('shop')->where('id',$sid)->find();
            	$shopname=$sname['goods'].',';
            	//图片名
            	$picname=$sname['img'].',';
            	//单价
            	$danjia=$sname['yuanjia'];
            	//小计
            	$xianjia=$danjia*$num.',';
              	//图片的上传时间
             	$stime=$sname['create_time'];

        	    //生成订单时间 
        	    $date=time();
        	    // dump($list9);
        	    
          	  //查询用户ID
          		$list=db('vip')->where('phone',$phone)->find();
          		$id=$list['id'];
          		//生成订单号
        	    $order_id=date("ymdHis").str_pad($id,6,"0",STR_PAD_LEFT);

        	    //添加订单未支付状态
        	    $res=db('order')->insert(['vid'=>$id,'sid'=>$sid,'sname'=>$shopname,'tin'=>$order_id,'quantity'=>$num,'s_img_time'=>$stime,'picname'=>$picname,'xianjia'=>$xianjia,'danjia'=>$danjia,'create_time'=>$date,'total'=>$xianjia,'state'=>0]);

        	    if($res>0){
        	    	//在订单表查询新添加的订单信息
        	    	$orders=db('order')->where('state',0)->where('tin',$order_id)->find();
        	    	//dump($orders);

        	    	foreach ($orders as &$value) {
        	    		//如果返回的数据中有',' 
        	    		if(substr_count($value,',')>0){
        	    			//以逗号拆分并去除两边的','
        	    			$value=explode(',',trim($value,','));
        	    		}
        	    	}
        	    	// dump($orders);
        	    	return view('',['orders'=>$orders,'user'=>$phone,'username'=>$username]);
        	    }


            }else{


            for ($i=0; $i < count($array['cart']); $i++) { 
            	//用+号拆分赋给$arr
            	$arr[$i]=explode('+',$array['cart'][$i]);
            }
            // dump($arr);
            
            //获取$arr所有的商品ID
            $list1='';
            for ($i=0; $i < count($arr); $i++) { 
            	$list1.=$arr[$i]['0'].",";
            }

            //通过传过来的ID查询购物车表的小计
            $list3=[];
            //获取所有商品的小计用逗号拼接
            $list4='';
            //获取总价
            $list7='';
            for ($i=0; $i < count($arr); $i++) { 
                $list3[$i]=db('shopcart')->where('id',$arr[$i]['1'])->find();
            	$list4.=$list3[$i]['total'].",";
            	$list7+=$list3[$i]['total'];
            }

            //获取购买数量
            $list2='';
            for ($i=0; $i < count($arr); $i++) {
            	$list2.=$list3[$i]['num'].",";
            }

            //获取shop表的商品数据
            $list5=[];
            //获取图片名
            $list6='';
            for ($i=0; $i < count($arr); $i++) { 
                $list5[$i]=db('shop')->where('id',$arr[$i]['0'])->find();
            	$list6.=$list5[$i]['img'];
            }

            //获取商品名称
            $list8='';
            for ($i=0; $i < count($arr); $i++) { 
            	$list8.=$list5[$i]['goods'].",";
            }

            //获取商品单价
            $list9='';
            for ($i=0; $i < count($arr); $i++) { 
            	$list9.=$list5[$i]['yuanjia'].",";
            }

            //查询shop表图片上传的时间戳
            $list10='';
            for ($i=0; $i < count($arr); $i++) { 
            	$list10.=$list5[$i]['create_time'].",";
            }

            //生成订单时间 
            $date=time();
            // dump($list9);
            
            //查询用户ID
        	$list=db('vip')->where('phone',$phone)->find();
        	$id=$list['id'];
        	//生成订单号
            $order_id=date("ymdHis").str_pad($id,6,"0",STR_PAD_LEFT);

            //添加订单未支付状态
            $res=db('order')->insert(['vid'=>$id,'sid'=>$list1,'sname'=>$list8,'tin'=>$order_id,'quantity'=>$list2,'s_img_time'=>$list10,'picname'=>$list6,'xianjia'=>$list4,'danjia'=>$list9,'create_time'=>$date,'total'=>$list7,'state'=>0]);
            // dump($res);
            
            //如果添加成功
            if($res>0){
            	//在订单表查询新添加的订单信息
            	$orders=db('order')->where('state',0)->where('tin',$order_id)->find();
            	foreach ($orders as &$value) {
            		//如果返回的数据中有',' 
            		if(substr_count($value,',')>0){
            			//以逗号拆分并去除两边的','
            			$value=explode(',',trim($value,','));
            		}
            	}

            	//图片文件需要，查询图片的添加时间并添加到返回的数据中
            	//$orders['s_create_time']=explode(',',trim($list10,','));
            	// dump($orders);
            	
            	//添加至订单表后删除购物车表的已经下单的数据
            	foreach ($list3 as $value) {
            		$res=db('shopcart')->delete($value['id']);
            	}
            	return view('',['orders'=>$orders,'user'=>$phone,'username'=>$username]);
            }
        }
        }

        public function succ(){
        	
        	//判断是否登录
            $phone=session('phone');
            $name=db('vip')->where('phone',$phone)->find();
            if($name==null){
              $username="默认名，请在个人中心设置！";
            }else{
              $username=$name['username'];
            }

            //订单信息
			$tin=input('get.tin');
        	$list=db('order')->where('tin',$tin)->find();
        	//dump($list);
        	$vid=$list['vid'];
        	$vname=db('vip')->where('id',$vid)->find();
        	//dump($vname['username']);
        	$sjr=$vname['username'];
        	$pho=$list['phone'];
        	$address=$list['address'];
            return view('',['user'=>$phone,'username'=>$username,'phone'=>$pho,'sjr'=>$sjr,'address'=>$address]);
        }

        public function pagepay(){
        	    //商户订单号，商户网站订单系统中唯一订单号，必填
        	    $out_trade_no = trim($_POST['WIDout_trade_no']);

        	    //订单名称，必填
        	    $subject = trim($_POST['WIDsubject']);

        	    //付款金额，必填
        	    $total_amount = trim($_POST['WIDtotal_amount']);

        	    //商品描述，可空
        	    $body = trim($_POST['WIDbody']);

        		//构造参数
        		$payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        		$payRequestBuilder->setBody($body);
        		$payRequestBuilder->setSubject($subject);
        		$payRequestBuilder->setTotalAmount($total_amount);
        		$payRequestBuilder->setOutTradeNo($out_trade_no);

        		$aop = new \AlipayTradeService($this->config);

        		/**
        		 * pagePay 电脑网站支付请求
        		 * @param $builder 业务参数，使用buildmodel中的对象生成。
        		 * @param $return_url 同步跳转地址，公网可以访问
        		 * @param $notify_url 异步通知地址，公网可以访问
        		 * @return $response 支付宝返回的信息
        	 	*/
        		$response = $aop->pagePay($payRequestBuilder,$this->config['return_url'],$this->config['notify_url']);

        		//输出表单
        		var_dump($response);
        }

    	public function notify_url(){
           $arr=$_POST;
           $alipaySevice = new \AlipayTradeService($this->config);
           $alipaySevice->writeLog(var_export($_POST,true));
           $result = $alipaySevice->check($arr);

           /* 实际验证过程建议商户添加以下校验。
           1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
           2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
           3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
           4、验证app_id是否为该商户本身。
           */
           if($result) {//验证成功
               /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
               //请在这里加上商户的业务逻辑程序代


               //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——

               //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表

               //商户订单号

               $out_trade_no = $_POST['out_trade_no'];

               //支付宝交易号

               $trade_no = $_POST['trade_no'];

               //交易状态
               $trade_status = $_POST['trade_status'];


               if($_POST['trade_status'] == 'TRADE_FINISHED') {

                   //判断该笔订单是否在商户网站中已经做过处理
                   //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                   //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                   //如果有做过处理，不执行商户的业务程序

                   //注意：
                   //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
               }
               else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                   //判断该笔订单是否在商户网站中已经做过处理
                   //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                   //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                   //如果有做过处理，不执行商户的业务程序
                   //注意：
                   //付款完成后，支付宝系统发送该交易状态通知
               }
               //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
               echo "success";    //请不要修改或删除

           }else {
               //验证失败
               echo "fail";

           }
       }

       public function return_url(){
           $arr=$_GET;
           $alipaySevice = new \AlipayTradeService($this->config);
           $result = $alipaySevice->check($arr);
           if($result) {//验证成功
               /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
               //请在这里加上商户的业务逻辑程序代码

               //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
               //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

               //商户订单号
               $out_trade_no = htmlspecialchars($_GET['out_trade_no']);

               //支付宝交易号
               $trade_no = htmlspecialchars($_GET['trade_no']);

               //将订单表中的支付状态更改为已支付，并将支付宝交易号写入数据表中***********
               db('order')->where('tin',$out_trade_no)->update(['state'=>1,'zfb'=>$trade_no]);

               $this->success('支付成功，跳转中...','/index/bay/succ?tin='.$out_trade_no);

               //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

               /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
           }
           else {
               //验证失败
               echo "验证失败";
           }
       }

    }
 ?>