<?php
namespace Home\Controller;
use Think\Controller;
class ConsultController extends BaseauthController {
	
	public function consult_add(){
		
	if(IS_POST){
	$area=I('post.consult');
	$data['consult_name']=$area;
	$data['qudao_group_name']=I('post.qudaogroup');
	
	$count=M('Consult')->where(array('consult_name'=>$area))->count();
	
	if($count){
	$state=0;
	}else if(M('Consult')->add($data)){
	
	$state=1;
	}else{
	
	$state=2;
	
	}
	$result=array('state'=>$state);
	echo json_encode($result);	
	}else{
	
	$qudaogrouplist=M('Qudaogroup')->select();	
	
	$this->assign('qudaogrouplist',$qudaogrouplist);	
	  		$this->main_menu='渠道设置';
        $this->son_menu='添加渠道';		
	$this->display();	
	
	}
	
	}

	
	
  public function consult_list(){
	  
	  
	  
$info = M('Consult');
$count= $info->count();
        $Page = new \Think\Page($count,C('PAGENUM'));
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->rollPage =C('ROLLPAGE');
$show= $Page->show();
$list = $info->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
$this->assign('count',$count);
$this->assign('consultlist',$list);
$this->assign('page',$show);
	  		$this->main_menu='渠道设置';
        $this->son_menu='渠道管理';	
$this->display();

	
	}
	
	

	public function consult_edit(){
		
				
	if (IS_POST){
	$ids=I('post.qdgroupid');
	
	$where= array('id' =>$ids);
	$data['consult_name']=I('post.consult');
	$data['qudao_group_name']=I('post.qudaogroup');
	$areainfo=M('Consult')->where($where)->save($data);
	
	if($areainfo){	
	$state=1;
	}else{
		
	$state=0;
		}	
		
	$result=array('state'=>$state);
	echo json_encode($result);	
	}else{
		
		
			$ids=I('get.id');
	$where= array('id' =>$ids);
	
	$consultinfo=M('Consult')->where($where)->find();
	
  $this->assign('consultinfo',$consultinfo);
  $this->assign('consult_id',$ids);
  	$qudaogrouplist=M('Qudaogroup')->select();	
	$this->assign('qudaogrouplist',$qudaogrouplist);	
	  		$this->main_menu='渠道设置';
        $this->son_menu='编辑渠道';	
  $this->display();
		
		}

	}

	public function consult_del(){

	$ids=I('get.id');
	$where= array('id' =>$ids);
	$areainfo=M('Consult')->where($where)->delete();
	
	if($areainfo){	
	$this->success('修改成功！',U('Consult/consult_list'));
	}else{
		
	$this->error('删除失败！');
		}
	}
	
	
	//批量删除地区
	
	public function delall_ajax(){
	$ids=I('post.delid');
	$areaid=explode(',',$ids);
	$where= array('id' => array('IN', $areaid));
	
	if(M('Consult')->where($where)->delete()){
	
	$result=1;
	
	}else{
	
	$result=0;
	
	};
	
	$data=array('result'=>$result);
	echo json_encode($data);
	}	
			
}