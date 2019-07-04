<?php
namespace app\admin\controller;
use app\admin\model\Banner as BannerModel;
use think\Controller;
use think\Db;
use think\Request;
use think\Image;
use think\Session;

class Banner extends Controller{
    public function bannerlist(){
        $list = BannerModel::paginate(3);
        $this->assign('list',$list);
        $count=DB::name('banner')
        ->count();
        $this->assign('num',$count);

        return $this->fetch("banner/bannerlist");
    }
    //添加
    public function add(Request $request){
       //接受值
       $descr = $request->param("descr");
       $link = $request->param("link");
       // $static = $request->param("static");
       // $addtime = date("Y/m/d H:i:s",time());
      //获取表单上传文件
       $file = $request->file("image");
       if(true!==$this->validate(['image'=>$file],['image'=>'require|image'])){
        $this->error('请选择图像文件');
       }else{
        //读取图片
        $image = Image::open($file);
       }
     //保存图片
     $saveName = $request->time() . '.png';
     $image->save(ROOT_PATH . 'public/uploads/banner/' . $saveName);
     $picname =$saveName;
     $banner['picname'] = "{$picname}";
     $banner['descr'] = "{$descr}";
     // $banner['addtime'] = $addtime;
     $banner['link'] = $link;
     if($result = BannerModel::create($banner)){
      $this->success("添加成功","banner/bannerlist","",2);
     }else{
        $this->error("添加失败","banner/bannerlist","",2);
     }
    }

    //单个删除
    public function del(request $request){
     $id = $request->post("id");
     //删除文件
     $picname = Db::query("select picname from banner where id = ".$id);
     $picname1 = $picname[0]['picname'];
     $path = ROOT_PATH . 'public' . DS . 'uploads' . DS . 'banner' . DS .$picname1;
     if(file_exists($path)){
        unlink($path);
     }
     //删除数据库
     $result = Db::execute('delete from banner where id = '.$id);
     dump($result);
    }
    //批量删除
    //批量删除
  //select * from stu where id in(3,5,7);
  public function dels(Request $request){
    $id = $request->post("id");
    //删除文件
    $picname = Db::query("select picname from banner where id in ($id)");
     $picname1 = $picname[0]['picname'];
     $path = ROOT_PATH . 'public' . DS . 'uploads' . DS . 'banner' . DS . $picname1;
     if(file_exists($path)){
        unlink($path);
     }
    $result = DB::table("banner")
    ->where("id in ($id)")
    ->delete();
    if($result){
       return 1;
    }else{
      return 2;
    }
  }


  //修改操作
  public function find(Request $request){
      $id = $request->post("id");
      //存进session
      // // echo $list;
      Session::set('id',$id,'banner');
      //获取该id的内容
      $result = Db::query("select * from banner where id=".$id);
      echo json_encode($result);
  }



  public function edit(Request $request){
            //获取表单上传文件
          $file = $request->file("image");
          if(true!==$this->validate(['image'=>$file],['image'=>'require|image'])){
              $this->error('请选择图像文件');
          }else{
              //读取图片
              $image = Image::open($file);
          }
          //保存图片
          $saveName = $request->time() . '.png';
          $image->save(ROOT_PATH . 'public/uploads/banner/' . $saveName);

          //取session
          $id1=Session::get('id','banner');
          Session::clear();
          $id=(int)$id1;
          $find=Db::table("banner")
          ->where("id",$id)
          ->find();
          $oldname=$find['picname'];
          $path = ROOT_PATH . 'public' . DS . 'uploads' . DS . 'banner' . DS . $oldname;
          unlink($path);

            $picname =$saveName;

            $result=Db::table('banner')
            ->where("id",$id)
            ->update(['picname'=>$picname]);
            if($result){
            echo "<script>alert('修改成功');location='bannerlist'</script>";
         }else{
            echo "<script>alert('修改失败');location='bannerlist'</script>";
         }
      }

    //修改描述
    public function editdescr(Request $request){
      $data=$request->post("data");
      parse_str($data,$arr);
      $descr=$arr['descr'];
      $id1=Session::get('id','banner');
      Session::clear();
      $id=(int)$id1;
      $data=Db::table("banner")
      ->where("id",$id)
      ->update(['descr'=>$descr]);
      if ($data) {
        echo 1;
      }else{
        echo 2;
      }
    }

    //状态转换
    public function state(Request $request){
        $id1 = $request->post('id');
        $id=(int)$id1;
        $old=Db::table('banner')
        ->find($id);
        if ($old['state']==1) {
            $old['state']=0;
        }else{
            $old['state']=1;
        }
        $up=Db::table('banner')
            ->where('id',$id)
            ->update(['state'=>$old['state']]);
        if ($up) {
            echo 1;
        }else{
            echo 2;
        }
    }


}

 ?>