<?php
namespace Home\Controller;
use Think\Controller;
class TelController extends BaseauthController {
	
	public function tel_add(){
	
	if (IS_POST){
			$phone=I('post.phone');
	$data['phone']=$phone;
	$data['name']=I('post.username');
	$data['addtime']=time();
	
	$count=M('user')->where(array('phone'=>$phone))->count();
	
	if($count){
	$state=0;
	}else if(M('Tel')->add($data)){
		
	$state=1;
	}else{
		
	$state=2;
	
	}
	 $result = array(
                'state' => $state
            );
            echo json_encode($result);	
	
	}else{
		
		
  $this->main_menu='手机设置';
  $this->son_menu='手机号添加';	
	$this->display();	
		
		
		
		}
	

	}
	
  public function tel_list(){
	  	  
$info = M('user');
$count= $info->count();
        $Page = new \Think\Page($count,C('PAGENUM'));
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->rollPage =C('ROLLPAGE');
$show= $Page->show();
$list = $info->order('id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
$this->assign('count',$count);
$this->assign('tellist',$list);
$this->assign('page',$show);
  $this->main_menu='手机设置';
  $this->son_menu='手机号管理';	
$this->display();

	
	}

	
	public function tel_edit(){
			
	if (IS_POST){
		$ids=I('post.telid');
	
	$where= array('id' =>$ids);
    $phone=I('post.phone');
	$username=I('post.username');
	
	
	$data['phone']=$phone;
	
	$data['name']=$username;

	$phoneinfo=M('user')->where($where)->save($data);
	
	if($phoneinfo){	
	$state=1;
	}else{
		
	$state=0;
		}
		
		$result = array(
                'state' => $state
            );
            echo json_encode($result);	
		
	}else{
		
			
	$ids=I('get.id');
	
	$where= array('id' =>$ids);
	
	$telinfo=M('user')->where($where)->find();
	
  $this->assign('telinfo',$telinfo);
  $this->assign('tel_id',$ids);
    $this->main_menu='手机设置';
  $this->son_menu='修改手机号';	
  $this->display();
		
		
		}
	
	
	}
	
	
	
	public function tel_del(){

	$ids=I('get.id');
	$where= array('id' =>$ids);
	$phoneinfo=M('Tel')->where($where)->delete();
	
	if($phoneinfo){
	$this->success('删除成功！',Cookie('__forward__'));
	}else{
		
	$this->error('删除失败！');
		}
	}
	
	//批量删除手机号码
	
	public function delall_ajax(){
	$ids=I('post.delid');
	$phoneid=explode(',',$ids);
	$where= array('id' => array('IN', $phoneid));
	
	if(M('Tel')->where($where)->delete()){
	
	$result=1;
	
	}else{
	
	$result=0;
	
	};
	
	$data=array('result'=>$result);
	echo json_encode($data);
	}
	
	
	
	
	
	
			
}