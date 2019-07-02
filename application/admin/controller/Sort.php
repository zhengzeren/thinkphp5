<?php
    namespace app\admin\controller;
    use app\admin\model\Type as TypeModel;
    use think\Controller;
    class Sort extends Base
    {
        public function index(){
            $list=TypeModel::field(['id','name','pid','path','state','concat(path,id)'=>'paixu'])->order('paixu')->paginate(10);
            $list1=TypeModel::field('pid')->select();
            foreach ($list1 as $v) {
                $newarr[]=$v['pid'];
            }
            $this->assign(['list'=>$list,'newarr'=>$newarr]);
            return $this->fetch();
        }
        // public function update(){
        //     $arr['id']=input('get.id');
        //     $arr['state']=input('get.state');
        //     // print_r($arr);
        //     $m=db('type')->update($arr);
        //     return $m;
        // }
        public function stateupdate(){
            $result = new TypeModel;
            $id = input('post.id');
            $state = input('post.state');
            // dump($state);
            if($state == 1){
                 $state = 0;
                 $res = TypeModel::where('id',$id)->update(['state'=>$state]);
                 //dump($res);
                 return "停用成功";
             }else{
                 $state = 1;
                 $res = TypeModel::where('id',$id)->update(['state'=>$state]);
                 //dump($res);
                 return "开启成功";
             }
        }

        public function update(){
            $id=input('id');
            //dump($id);
            $list=TypeModel::where('id',$id)->find();
            // $pids=TypeModel::where('pid',$id)->select();
            // $fids=TypeModel::where('id',$list['pid'])->select();
            // $this->assign(['list'=>$list,'pids'=>$pids,'fids'=>$fids]);
            $this->assign('list',$list);
            return $this->fetch();
        }
        
        public function edit(){
            $id=input('post.id');
            //dump($id);
            $res=TypeModel::update(input('post.'));
            if($res){
             return "修改成功";
            }else{
             return "修改失败";
            }
        }

        public function addchild(){
            $id=input('id');
            $this->assign('id',$id);
            return $this->fetch();
        }

        public function add1(){
            $pid=input('post.id');
            $list=TypeModel::where('id',$pid)->find();
            $path=$list['path'].$pid.',';
            //dump($pid);
            $name=input('post.name');
            //dump($name);
            //dump($id);
            $type = new TypeModel([
                'name'  =>  $name,
                'pid' =>  $pid,
                'path' => $path
            ]);
            $type->save();
            // 获取自增ID
            return "新增子栏目成功,ID:".$type->id;

        }

        public function addfid(){
            return view();
        }

        public function add2(){
            $name=input('post.name');
            $type = new TypeModel([
                'name'  =>  $name,
                'pid' =>  0,
                'path' => '0,'
            ]);
            $type->save();
            // 获取自增ID
            return "新增子栏目成功,ID:".$type->id;
        }

        public function del(){
            $id=input('post.id');
            //dump($id);
            $list1=TypeModel::field('pid')->select();
            foreach ($list1 as $v) {
                $newarr[]=$v['pid'];
            }
            //dump(in_array($id,$newarr));
            if(in_array($id,$newarr)==true){
                return 0;
            }else{
                $res=TypeModel::where('id',$id)->delete();
                return 1;
            }
        }
    }
 ?>