<?php
    namespace app\admin\controller;
    use app\admin\model\Banner as BannerModel;
    use think\Controller;

    class Banner extends Base
    {
        public function index(){
            $list=BannerModel::order('id desc')->paginate(5);
            // dump($list);
            //$img=trim($list['picname'],',');
            //以逗号拆分字符串
            //$arr=explode(',',$img);
            return view('index',['list'=>$list]);
        }

        public function stateupdate(){
            //dump(input('post.'));
            $result = new BannerModel;
            $id = input('post.id');
            $state = input('post.state');
            if($state == 1){
                 $state = 0;
                 $res = BannerModel::where('id',$id)->update(['state'=>$state]);
                 //dump($res);
                 return "已禁止显示";
             }else{
                 $state = 1;
                 $res = BannerModel::where('id',$id)->update(['state'=>$state]);
                 //dump($res);
                 return "显示成功";
             }
        }

        public function del(){
            $id = input('post.id');
            $user = BannerModel::get($id);
            if($user){
                $user->delete();
                return 1;
            }else{
                return 0;
            }
        }

        public function add(){
        	
            return view('');
        }

        public function insert(){
            $banner = new BannerModel;
            $img=input('post.img');
            preg_match_all("/title=\"(\d+\.\w+)\"/",$img,$arr);
            $arr1='';
            for ($i=0; $i < count($arr[1]); $i++) { 
                $arr1.=$arr[1][$i].',';
            }
            $banner->picname = $arr1;
            $banner->descr = input('post.descr');
            if ($banner->save()) {
            return '新增成功';
            } else {
            return $banner->getError();
            }

        }

        //brief introduction 简介
        public function bi(){
            $id=input('get.id');
            //dump($id);
            $list = BannerModel::where('id',$id)->find();
            $descr=$list['descr'];
          return view('',['descr'=>$descr]);
        }
        //Picture management 图片管理
        public function pm(){
            $id=input('get.id');
            //dump($id);
            $list = ShopModel::where('id',$id)->find();
            //去除两边的分界符
            $img=trim($list['img'],',');
            //以逗号拆分字符串
            $arr3=explode(',',$img);
            return view('',['arr'=>$arr3,'list'=>$list]);
        }

    }
 ?>