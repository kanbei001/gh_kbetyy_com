<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
namespace Org\Util;
use Think\Db;

class Tree {
	
     static public $treeList = array();
     function create($data,$pid = 0) {
        foreach ($data as $key => $value){
            if($value['pid']==$pid){
                self::$treeList[]=$value;
                unset($data[$key]);
                self::create($data,$value['id']);
            } 
        }
        return self::$treeList ;
    }

}