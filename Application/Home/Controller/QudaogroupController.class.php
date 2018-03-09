<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP version 5                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2004 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 3.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.php.net/license/3_0.txt.                                  |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Original Author <author@example.com>                        |
// |          Your Name <you@example.com>                                 |
// +----------------------------------------------------------------------+
//
// $Id:$

namespace Home\Controller;
use Think\Controller;
class QudaogroupController extends BaseauthController {
     /**
     * 渠道组列表
     * @return [type] [description]
     */
    public function qdgroup_list() {
        $info = M('Qudaogroup');
        $count = $info->count();
        $Page = new \Think\Page($count,C('PAGENUM'));
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->rollPage =C('ROLLPAGE');
        $show = $Page->show();
        $list = $info->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('count', $count);
        $this->assign('qdgrouplist', $list);
        $this->assign('page', $show);
        $this->main_menu='渠道分组';
        $this->son_menu='分组管理';
        $this->display();
    }
    
    /**
     * 添加渠道组
     */
    public function add() {
        if (IS_POST){
            $data['qudao_group_name']=I('post.qudao_group_name');
            $count=M('Qudaogroup')->where(array('qudao_group_name'=>I('post.qudao_group_name')))->count();
            if($count==0){
                if(M('Qudaogroup')->add($data)){
                    $this->success('添加成功！');
                }else{
                    $this->error('添加失败！');
                }   
            }else{
                $this->error('该渠道组已经存在！');
            }
        }else{
            $this->assign('do',"添加");
            $this->display('edit');
        }
    }
   
    /**
     * 修改渠道组
     * @return [type] [description]
     */
    public function edit() {
        if (IS_POST){
            $where= array('id' =>I('post.id')); 
            $data= array('id' =>I('post.id'),'qudao_group_name'=>I('post.qudao_group_name'));  
            if(M('Qudaogroup')->where($where)->save($data)){
                $this->success('修改成功！');
            }else{
                $this->error('修改失败！');
            }   
        }else{
            $qdgroupinfo=M('Qudaogroup')->find(I('get.id'));
            $this->assign($qdgroupinfo);
            $this->assign('do',"修改");
            $this->display('edit');
        }
    }
    
    /**
     * [批量]删除
     * @return [type] [description]
     */
    public function del(){
        $ids=I('get.id'); 
        $id=explode(',',$ids);
        $where= array('id' => array('IN', $id));
        $qdgroupinfo=M('Qudaogroup')->where($where)->delete();
        if($qdgroupinfo){  
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！');
        }
    }
}

