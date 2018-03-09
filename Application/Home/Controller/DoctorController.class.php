<?php
namespace Home\Controller;
use Think\Controller;
class DoctorController extends BaseauthController {

	 public function __construct() 
    { 
        parent::__construct(); 
        $doctorsectionlist=M('Doctorsection')->select();
	    $this->assign('doctorsectionlist',$doctorsectionlist);	
    }  
    /**
     * 添加医生
     */
	public function add(){
	    if (IS_POST){
            $data['doctor_name']=I('post.doctor_name');
            $data['u_id']=I('post.u_id');
            $count=M('Doctor')->where(array('doctor_name'=>I('post.doctor_name')))->count();
            if($count==0){
                if(M('Doctor')->add($data)){
                    $this->success('添加成功！');
                }else{
                    $this->error('添加失败！');
                }   
            }else{
                $this->error('该医生已经存在！');
            }
        }else{
            $this->assign('do',"添加");
            $this->display('edit');
        }
	
	}
	
  public function doctor_list(){
	  
	  
	  
$info = M('Doctor');
$count= $info->count();
        $Page = new \Think\Page($count,C('PAGENUM'));
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->rollPage =C('ROLLPAGE');
$show= $Page->show();
$list = $info->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
foreach($list as $v){
	
	 $doconeinfo=M('Doctorsection')->where(array('id'=>$v['u_id']))->find();

	 $docstr[]=array(
	 
	 'id'=>$v['id'],
	 'doctor_name'=>$v['doctor_name'],
	 'ksname'=>$doconeinfo['name']
	 );

	}
	

$this->assign('count',$count);
$this->assign('doctorlist',$docstr);
$this->assign('page',$show);
	  		$this->main_menu='医生设置';
        $this->son_menu='医生管理';	
$this->display();

	
	}
	
	
	
	
	public function edit(){
			
	// if (IS_POST){
	// $ids=I('post.doctorid');
	// $where= array('id' =>$ids);
	// $data['doctor_name']=I('post.doctor');
	// $data['u_id']=I('post.doctorsection');
	

	// $areainfo=M('Doctor')->where($where)->save($data);
	
	// if($areainfo){	
	// $state=1;
	// }else{
		
	// $state=0;
	// 	}
	// $result=array('state'=>$state);
	// echo json_encode($result);	
	// }else{
		
	// $ids=I('get.id');
	
	// $where= array('id' =>$ids);
	
	// $doctorinfo=M('Doctor')->where($where)->find();
	// $doctorsectionlist=M('Doctorsection')->select();
		
		
	// $this->assign('doctorsectionlist',$doctorsectionlist);	
	
 //  $this->assign('doctorinfo',$doctorinfo);
 //  $this->assign('doctor_id',$ids);
 //  	  		$this->main_menu='医生设置';
 //        $this->son_menu='编辑医生';	
 //  $this->display();
		
	// }
    if (IS_POST){
            $where= array('id' =>I('post.id')); 
            $data= array('id' =>I('post.id'),'doctor_name'=>I('post.doctor_name'),'u_id'=>I('post.u_id'));  
            if(M('Doctor')->where($where)->save($data)){
                $this->success('修改成功！');
            }else{
                $this->error('修改失败！');
            }   
        }else{
            $doctorinfo=M('Doctor')->find(I('get.id'));
            $this->assign($doctorinfo);
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
        $qdgroupinfo=M('Doctor')->where($where)->delete();
        if($qdgroupinfo){  
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！');
        }
    }
	
	
	
	
	
	
	
	
	
			
}