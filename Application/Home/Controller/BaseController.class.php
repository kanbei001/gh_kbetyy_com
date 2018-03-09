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
class BaseController extends Controller {
    public function _initialize() {
        if (!isset($_SESSION['username']) && !isset($_SESSION['uid'])) {
            $this->redirect('Login/index');
        } else {
            $m_id = session('m_id');
            $groupinfo = M('Group')->where(array(
                'm_id' => $m_id
            ))->find();
            $qx_group_id = $groupinfo['qx_group_id'];
            $qx_id = $groupinfo['qx_id'];
            $cat_id = explode(',', $qx_id);
            $son_id = explode(',', $qx_group_id);
            $where = array(
                'qx_id' => array(
                    'IN',
                    $cat_id
                )
            );
            $menu = M('Qx')->where($where)->select();
        //    dump($menu);
            foreach ($menu as $key => $v) {
                $menu[$key]['children'] = M('Qxgroup')->where(array('qx_id' => $v['qx_id'],array('id' => array('IN',$son_id)),'state'=>1))->order('id asc')->select();
            }
            $this->assign('menu', $menu);
        }
    }
	
	/**
	   * 公共部分
	   */
	    public function __construct(){ 
            parent::__construct(); 
            $zxylist = M('User')->where(array('m_id' => array('IN',array(1,2,3,5))))->select();
                $huifanglist           = M('Callback')->select();
                $keshilist             = M('Section')->select();
                $arealist              = M('Area')->select();
                $consultlist           = M('Consult')->select();
                $qudaoinfolist         = M('Qudaoinfo')->select();
                $yingxiaolist          = M('Yingxiao')->select();
                $weblist               = M('Web')->select();
                $doctorsectionlist     = M('Doctorsection')->select();
                $BZlist     = M('bingzhong')->select();
                $SEX = array('1'=>'男','2'=>'女');
                $ORDER = array('0'=>'登记','1'=>'预约');

                $this->assign( 'quanxian', session( 'm_id') );
                $this->assign( 'zxylist', $zxylist );
                $this->assign( 'huifanglist', $huifanglist );
                $this->assign( 'keshilist', $keshilist );
                $this->assign( 'arealist', $arealist );
                $this->assign( 'consultlist', $consultlist );
                $this->assign( 'qudaoinfolist', $qudaoinfolist );
                $this->assign( 'yingxiaolist', $yingxiaolist );
                $this->assign( 'weblist', $weblist );
                $this->assign( 'SEX', $SEX);
                $this->assign( 'ORDER', $ORDER);
                $this->assign( 'BZlist', $BZlist);
                $this->assign( 'doctorsectionlist', $doctorsectionlist );

            $this->assign( 'User', M('User')->getField('id,name'));  //用户【录入员】
        }  
	
	 public function _empty(){
        //$this->redirect('Index/index','',2, '模块或者方法不存在，页面正在跳转中...');
		 $this->redirect('Index/index');
    }
 public function userex() {
	   $this->redirect('Manage/user_edit/id/'.$_SESSION['uid']);
	   exit();
    }
    public function logout() {
        $data['actions'] = '退出登录';
        $data['ip_id'] = $_SERVER['REMOTE_ADDR'];
        $data['times'] = time();
        $data['action_name'] = session('username');
        M('Operation')->add($data);
        session_unset();
        session_destroy();
        redirect(__APP__);
    }

    function searchform(){
       $this->display('Public:searchform');
    }
}
?>
