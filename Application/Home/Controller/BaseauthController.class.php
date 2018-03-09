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
class BaseauthController extends Controller {
    public function _initialize() {
		header("Content-type: text/html; charset=utf-8");
		// if(session('m_id')!=1 && session('cjaction')!='user_edit'){
		// echo "<script type='text/javascript'>alert('你无权查看查看此页面！');history.go(-1);</script>";
		// die;
		// }
		
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
            foreach ($menu as $key => $v) {
                $menu[$key]['children'] = M('Qxgroup')->where(array('qx_id' => $v['qx_id'],array('id' => array('IN',$son_id))))->order('id asc')->select();
            }
            $this->assign('menu', $menu);
        }
    }
	
	
	
	 public function _empty(){
		 
		 $this->redirect('Index/index');
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
}
?>
