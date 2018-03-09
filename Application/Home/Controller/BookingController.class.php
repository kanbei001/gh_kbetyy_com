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
class BookingController extends BaseController {
    //首页
    public function info_list() {
        $date_str = date("Y-m-d", mktime(0, 0, 0, date("m") , 1, date("Y")));
        $time_name = strtotime($date_str);
        $Qudao_groupinfo = M('Qudaogroup')->find();
        $v['qudao_id'] = $Qudao_groupinfo['id'];
        $v['start_date'] = $time_name;
        $v['en_date'] = time();
        if ($_POST) {
            if ($_POST['en_date'] == '') {
                $v['qudao_id'] = $_POST['qudao'];
                $v['en_date'] = time();
                $v['start_date'] = strtotime($_POST['start_date']);
            } else {
                $v['qudao_id'] = $_POST['qudao'];
                $v['start_date'] = strtotime($_POST['start_date']);
                $v['en_date'] = strtotime($_POST['en_date']);
            }
        }
        $posts = M('Consult')->where(array('qudao_group_name' => $v['qudao_id'] ))->select();
        $this->assign('posts', $posts);
        $this->assign('riqi', $v);
		$this->main_menu='预约统计';
        $this->son_menu='预约信息统计';
        $this->display();
    }
    public function area_list() {
        $date_str = date("Y-m-d", mktime(0, 0, 0, date("m") , 1, date("Y")));
        $time_name = strtotime($date_str);
        $Qudao_groupinfo = M('Qudaogroup')->find();
        $v['qudao_id'] = $Qudao_groupinfo['id'];
        $v['start_date'] = $time_name;
        $v['en_date'] = time();
        if ($_POST) {
            if ($_POST['en_date'] == '') {
                $v['qudao_id'] = $_POST['qudao'];
                $v['en_date'] = time();
                $v['start_date'] = strtotime($_POST['start_date']);
            } else {
                $v['qudao_id'] = $_POST['qudao'];
                $v['start_date'] = strtotime($_POST['start_date']);
                $v['en_date'] = strtotime($_POST['en_date']);
            }
        }
        $posts = M('Area')->select();
        $this->assign('posts', $posts);
        $this->assign('riqi', $v);
		$this->main_menu='预约统计';
        $this->son_menu='预约地区统计';

        $this->display();
    }
    public function keshi_list() {
        $date_str = date("Y-m-d", mktime(0, 0, 0, date("m") , 1, date("Y")));
        $time_name = strtotime($date_str);
        $Qudao_groupinfo = M('Qudaogroup')->find();
        $v['qudao_id'] = $Qudao_groupinfo['id'];
        $v['start_date'] = $time_name;
        $v['en_date'] = time();
        if ($_POST) {
            if ($_POST['en_date'] == '') {
                $v['qudao_id'] = $_POST['qudao'];
                $v['en_date'] = time();
                $v['start_date'] = strtotime($_POST['start_date']);
            } else {
                $v['qudao_id'] = $_POST['qudao'];
                $v['start_date'] = strtotime($_POST['start_date']);
                $v['en_date'] = strtotime($_POST['en_date']);
            }
        }
        $posts = M('Section')->select();
        $this->assign('posts', $posts);
        $this->assign('riqi', $v);
		$this->main_menu='预约统计';
        $this->son_menu='预约科室统计';

        $this->display();
    }
    public function zixun_list() {
        $date_str = date("Y-m-d", mktime(0, 0, 0, date("m") , 1, date("Y")));
        $time_name = strtotime($date_str);
        $Qudao_groupinfo = M('Qudaogroup')->find();
        $v['qudao_id'] = $Qudao_groupinfo['id'];
        $v['start_date'] = $time_name;
        $v['en_date'] = time();
        if ($_POST) {
            if ($_POST['en_date'] == '') {
                $v['qudao_id'] = $_POST['qudao'];
                $v['en_date'] = time();
                $v['start_date'] = strtotime($_POST['start_date']);
            } else {
                $v['qudao_id'] = $_POST['qudao'];
                $v['start_date'] = strtotime($_POST['start_date']);
                $v['en_date'] = strtotime($_POST['en_date']);
            }
        }
        $posts = M('User')->where(array(
            'm_id' => array(
                'IN',
                array(2,3,5)
            )
        ))->select();
        $other= "('杨馨蕊','毛俊会','周玉慧')";
        $this->assign('other', $other);  
        $this->assign('posts', $posts);
        $this->assign('riqi', $v);
		$this->main_menu='预约统计';
        $this->son_menu='预约咨询统计';
        $this->display();
    }
    public function keywords_list() {
        $date_str = date("Y-m-d", mktime(0, 0, 0, date("m") , 1, date("Y")));
        $time_name = strtotime($date_str);
        $Qudao_groupinfo = M('Qudaogroup')->find();
        $v['qudao_id'] = $Qudao_groupinfo['id'];
        $v['start_date'] = $time_name;
        $v['en_date'] = time();
        if ($_POST) {
            if ($_POST['en_date'] == '') {
                $v['qudao_id'] = $_POST['qudao'];
                $v['en_date'] = time();
                $v['start_date'] = strtotime($_POST['start_date']);
            } else {
                $v['qudao_id'] = $_POST['qudao'];
                $v['start_date'] = strtotime($_POST['start_date']);
                $v['en_date'] = strtotime($_POST['en_date']);
            }
        }
        $v['end_date'] = $v['en_date'] + 86399;
        $post_start_date = $v['start_date'];
        $post_en_dates = $v['end_date'];
        $qudao_id = $v['qudao_id'];
        $sqlyytotals = "SELECT keyword FROM bk_kefuinfo WHERE isorder=1 and keyword !='' and in_time>='$post_start_date' and in_time<='$post_en_dates'";
        $sqldytotals = "SELECT keyword FROM bk_kefuinfo WHERE isorder=1 and keyword !='' and laiyuan_time>='$post_start_date' and laiyuan_time<='$post_en_dates'";
        $yynums = count(M()->query($sqlyytotals));
        $dynums = count(M()->query($sqldytotals));
        if ($yynums == 0) {
            $dyl = '0%';
        } else {
            $str = $dynums / $yynums;
            $a = round($str, 2) * 100;
            $dyl = $a . "%";
        }
        $strs['yynums'] = $yynums;
        $strs['dynums'] = $dynums;
        $strs['dyl'] = $dyl;
        $list = M('Kefuinfo')->field('keyword')->where("isorder=1 and keyword !='' and  in_time>='$post_start_date' and in_time<='$post_en_dates'  and qudao_group_id='$qudao_id' ")->group('keyword')->select();
        foreach ($list as $_v) {
            $keyword = $_v['keyword'];
            $sqlss = "SELECT *  FROM bk_kefuinfo WHERE isorder=1 and keyword='$keyword' and in_time>='$post_start_date' and in_time<='$post_en_dates'  and qudao_group_id='$qudao_id'";
            $sqlsss = "SELECT * FROM bk_kefuinfo WHERE isorder=1 and keyword='$keyword' and laiyuan_time>='$post_start_date' and laiyuan_time<='$post_en_dates'  and qudao_group_id='$qudao_id'";
            $gjctotal = count(M()->query($sqlss));
            $gjctotals = count(M()->query($sqlsss));
            if ($gjctotal == 0) {
                $a_bfb = '0%';
            } else {
                $str = $gjctotals / $gjctotal;
                $a = round($str, 2) * 100;
                $a_bfb = $a . "%";
            }
            $arr[] = array(
                'keyword' => $keyword,
                'gjctotal' => $gjctotal,
                'gjctotals' => $gjctotals,
                'a_bfb' => $a_bfb,
            );
        }
        $this->assign('arr', $arr);
        $this->assign('strs', $strs);
		$this->main_menu='预约统计';
        $this->son_menu='预约关键词统计';
        $this->display();
    }
}

