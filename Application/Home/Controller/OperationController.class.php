<?php
namespace Home\Controller;
use Think\Controller;
class OperationController extends BaseauthController {
	
	public function operation_list(){
	
$info = M('Operation');
$count= $info->count();
        $Page = new \Think\Page($count,C('PAGENUM'));
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->rollPage =C('ROLLPAGE');
$show= $Page->show();
$list = $info->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
$this->assign('count',$count);
$this->assign('operationlist',$list);
$this->assign('page',$show);
  	  	  		$this->main_menu='操作日志';
        $this->son_menu='查看日志';
$this->display();
	
	}
	
	
	
//批量删除日志
	
	public function delall_ajax(){
	$ids=I('post.delid');
	$areaid=explode(',',$ids);
	$where= array('id' => array('IN', $areaid));
	
	if(M('Operation')->where($where)->delete()){
	
	$result=1;
	
	}else{
	
	$result=0;
	
	};
	
	$data=array('result'=>$result);
	echo json_encode($data);
	}
	
	
}