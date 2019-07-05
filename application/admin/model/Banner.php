<?php
namespace app\admin\model;
use think\Model;
class Banner extends Model{
    protected $table = "banner";
    // // 定义自动完成的属性
    // protected $auto = ['static'];
    // //status属性读取器
    // protected function getStatusAttr($value)
    // {
    //     $static=[0=>'不显示',1=>'已显示'];
    //     return $static[$value];
    // }
}