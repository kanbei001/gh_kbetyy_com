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
class WebController extends BaseauthController {
    public function web_add() {
        if (IS_POST) {
            $area = I('post.web');
            $data['web_name'] = $area;
            $count = M('Web')->where(array(
                'web_name' => $area
            ))->count();
            if ($count) {
                $state = 0;
            } else if (M('Web')->add($data)) {
                $state = 1;
            } else {
                $state = 2;
            }
            $result = array(
                'state' => $state
            );
            echo json_encode($result);
        } else {
		$this->main_menu='渠道设置';
        $this->son_menu='添加来源网站';
            $this->display();
        }
    }
    public function web_list() {
        $info = M('Web');
        $count = $info->count();
        $Page = new \Think\Page($count,C('PAGENUM'));
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->rollPage =C('ROLLPAGE');
        $show = $Page->show();
        $list = $info->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('count', $count);
        $this->assign('weblist', $list);
        $this->assign('page', $show);
		$this->main_menu='渠道设置';
        $this->son_menu='来源网站管理';
        $this->display();
    }
    public function web_edit() {
        if (IS_POST) {
            $ids = I('post.webid');
            $where = array(
                'id' => $ids
            );
            $area = I('post.web');
            $data['web_name'] = $area;
            $areainfo = M('Web')->where($where)->save($data);
            if ($areainfo) {
                $state = 1;
            } else {
                $state = 0;
            }
            $result = array(
                'state' => $state
            );
            echo json_encode($result);
        } else {
            $ids = I('get.id');
            $where = array(
                'id' => $ids
            );
            $webinfo = M('Web')->where($where)->find();
            $this->assign('webinfo', $webinfo);
            $this->assign('web_id', $ids);
					$this->main_menu='渠道设置';
        $this->son_menu='编辑来源网站';
            $this->display();
        }
    }
    public function web_del() {
        $ids = I('get.id');
        $where = array(
            'id' => $ids
        );
        $areainfo = M('Web')->where($where)->delete();
        if ($areainfo) {
            $this->success('修改成功！', U('Web/web_list'));
        } else {
            $this->error('删除失败！');
        }
    }
    //批量删除地区
    public function delall_ajax() {
        $ids = I('post.delid');
        $areaid = explode(',', $ids);
        $where = array(
            'id' => array(
                'IN',
                $areaid
            )
        );
        if (M('Web')->where($where)->delete()) {
            $result = 1;
        } else {
            $result = 0;
        };
        $data = array(
            'result' => $result
        );
        echo json_encode($data);
    }
}

