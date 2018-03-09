<?php
namespace Home\Controller;
use Think\Controller;
class MonthgoalController extends BaseauthController {

	public function monthgoal_add(){
	
	if (IS_POST){
		$area=I('post.yuefen');
	$data['yuefen']=$area;
	$data['goalnum']=I('post.goalnum');
	
	
	$count=M('Monthgoal')->where(array('yuefen'=>$area))->count();
	
	if($count){
	 $state = 0;
	}else if(M('Monthgoal')->add($data)){
		
	 $state = 1;
	}else{
		
	 $state =2;
	
	}
	
	 $result = array(
                'state' => $state
            );
            echo json_encode($result);
	
	}else{
		
	  	  		$this->main_menu='目标设置';
        $this->son_menu='添加目标';		
	$this->display();	
		
		
		
		}
	
	
	}
	
  public function monthgoal_list(){
	  	  
		$info = M('Monthgoal');
		$count= $info->count();
		$Page = new \Think\Page($count,C('PAGENUM'));
		$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$Page->rollPage =C('ROLLPAGE');
		$show= $Page->show();
		$list = $info->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach ($list as $key => $val) {
			$yt = explode('-',$val['yuefen']);
			$start = $val['yuefen']."-01";
			$end =  $val['yuefen']."-".cal_days_in_month(CAL_GREGORIAN, $yt[1], $yt[0]); 
			$map = "laiyuan_time <='".strtotime($end)."' && laiyuan_time >='".strtotime($start)."'";
			$listc = intval(M('Kefuinfo')->where($map)->count());
            $done = $listc/$val['goalnum'];
			$list[$key]['wcl'] = round($done,4)*100;
		}
		$this->assign('count',$count);
		$this->assign('monthgoallist',$list);
		$this->assign('page',$show);
		$this->main_menu='登记预约';
		$this->son_menu='目标管理';
		$this->display();
	}
	

	
	public function monthgoal_edit(){
			
	if (IS_POST){
		$ids=I('post.monthgoalid');
	$where= array('id' =>$ids);
    $yuefen=I('post.yuefen');
	$goalnum=I('post.goalnum');
	
	
	$data['yuefen']=$yuefen;
	
	$data['goalnum']=$goalnum;
	
	
	
	$areainfo=M('Monthgoal')->where($where)->save($data);
	
	if($areainfo){	
	
 $state = 1;
	
	
	}else{
		
 $state = 0;
		}
		
		
	 $result = array(
                'state' => $state
            );
            echo json_encode($result);		
		
	}else{
		
		
		
			
	$ids=I('get.id');
	
	$where= array('id' =>$ids);
	
	$monthgoalinfo=M('Monthgoal')->where($where)->find();
	
  $this->assign('monthgoalinfo',$monthgoalinfo);
  $this->assign('monthgoal_id',$ids);
  	  	  		$this->main_menu='目标设置';
        $this->son_menu='编辑目标';
  $this->display();
		
		
		
		
		}
	
	
	}
	
	public function monthgoal_del(){

	$ids=I('get.id');
	$where= array('id' =>$ids);
	$areainfo=M('Monthgoal')->where($where)->delete();
	
	if($areainfo){	
	//$this->success('删除成功！',U('Monthgoal/monthgoal_list'));
	
	$this->success('删除成功！',Cookie('__forward__'));
	}else{
		
	$this->error('删除失败！');
		}
	}
	
	//批量删除地区
	
	public function delall_ajax(){
	$ids=I('post.delid');
	$areaid=explode(',',$ids);
	$where= array('id' => array('IN', $areaid));
	
	if(M('Monthgoal')->where($where)->delete()){
	
	$result=1;
	
	}else{
	
	$result=0;
	
	};
	
	$data=array('result'=>$result);
	echo json_encode($data);
	}
	
	
	
	
	
	
			
}