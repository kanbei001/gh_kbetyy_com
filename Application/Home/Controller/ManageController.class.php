<?php
namespace Home\Controller;
use Think\Controller;
class ManageController extends BaseauthController {
	
	public function usergroup_list(){
	
	$info = M('Group');
$count= $info->count();
        $Page = new \Think\Page($count,C('PAGENUM'));
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->rollPage =C('ROLLPAGE');
$show= $Page->show();
$list = $info->limit($Page->firstRow.','.$Page->listRows)->select();
$this->assign('count',$count);
$this->assign('usergrouplist',$list);
$this->assign('page',$show);
$this->main_menu='用户管理';
$this->son_menu='用户组管理';

$this->display();
	
	}
	
	
	
	public function usergroup_edit(){
		
	if (IS_POST){
	$ids=I('post.groupid');
	$where= array('m_id' =>$ids);
    $area=I('post.group');
	
	
	$data['group_name']=$area;
	

	$areainfo=M('Group')->where($where)->save($data);
	
	if($areainfo){	
	 $state = 1;
	}else{
		
	 $state =0;
		}
		
		  $result = array(
                'state' => $state
            );
            echo json_encode($result);
	
	}else{
		
		
	$ids=I('get.m_id');
	
	$where= array('m_id' =>$ids);
	
	$groupinfo=M('Group')->where($where)->find();
	
  $this->assign('groupinfo',$groupinfo);
  $this->assign('group_id',$ids);
  $this->main_menu='用户管理';
$this->son_menu='编辑用户组';

  $this->display();	
		
		
		}
	
	
		
		
	
	
	
	
	}
	
	
	
	public function usergroup_del(){

	$ids=I('get.m_id');
	$where= array('m_id' =>$ids);
	$areainfo=M('Group')->where($where)->delete();
	
	if($areainfo){	
	$this->success('删除成功！');
	}else{
		
	$this->error('删除失败！');
		}
	
	
	
	}
	


	
	public function user_add(){
		
    if (IS_POST){
	$username=I('post.username');
	$password=I('post.password');	
	$data['name']=$username;
	$data['m_id']=I('post.group');	
	$data['password']=md5($password);
	$data['time']=time();
	$count=M('User')->where(array('name'=>$username))->count();
	
	if($count){
	$state = 0;
	}else if(M('User')->add($data)){
		
	$state =1;
	}else{
		
	$state = 2;
	
	}
	 $result = array(
                'state' => $state
            );
            echo json_encode($result);
	
	}else{
		
		$grouplist=M('Group')->select();
	
	$this->assign('grouplist',$grouplist);
	$this->main_menu='用户管理';
$this->son_menu='添加用户';

	
	$this->display();	
		
		
		}
	


	}
	
	

	public function user_list(){
	$ids=I('get.m_id');
	if($ids){
		$where=array('m_id'=>$ids);	
		$uinfo=M('User')->where($where);
		}else{
			
		$uinfo=M('User');
			
			}
	
	
	$count= $uinfo->count();

        $Page = new \Think\Page($count,C('PAGENUM'));
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->rollPage =C('ROLLPAGE');
	$show= $Page->show();
	
	
	if($ids){
		$where=array('m_id'=>$ids);	
		$query =M('User')->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		}else{
			
		$query =M('User')->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			
			}
	
	

	foreach ($query as $v){		
	
	$keshiinfo=M('Group')->where(array('m_id'=>$v['m_id']))->find();
	$group_name=$keshiinfo['group_name'];
	$arr[] = array(
	'id'=>$v['id'],
	'm_id'=>$v['m_id'],
	'name'=>$v['name'],
	'group_name'=>$group_name   
			);
	}
	
	$this->assign('count',$count);
	$this->assign('userlist',$arr);
	$this->assign('page',$show);
	$this->main_menu='用户管理';
$this->son_menu='用户管理';

	$this->display();
	}
	

	
	
	public function user_edit(){  
	     if (IS_POST){
			 $ids=I('post.u_id');
		     $username=I('post.username');
		     $password=md5(I('post.password'));
			 $group=I('post.group');
			 
			 $data['password']=$password;
			 $data['m_id']=$group;
			 $where= array('id' =>$ids,'name'=>$username);
			 $areainfo=M('User')->where($where)->save($data);
			if($areainfo){	
				$state =1;
			}else{
				$state =0;
			}
			$result = array(
		                'state' => $state
		            );
			if (session('m_id')!=1) { 
				$_SESSION['cjaction'] = '';
				$this->redirect($_SESSION['backurl']);
			} else {
				 echo json_encode($result);	
			}
		}else{
			$ids=I('get.id');		  
			$info = M('User');
			$yonghuinfo= $info->where(array('id'=>$ids))->find();
		     $grouplist=M('Group')->select();
			$m_id=$yonghuinfo['m_id'];
			$this->assign('u_id',$ids);	
			$this->assign('m_id',$m_id);
			$this->assign('grouplist',$grouplist);
			$this->assign('yonghuinfo',$yonghuinfo);
			$this->main_menu='用户管理';
		    $this->son_menu='编辑用户';
			$this->display();	
		}
    }

	public function user_del(){

	$ids=I('get.id');
	$where= array('id' =>$ids);
	$areainfo=M('User')->where($where)->delete();
	
	if($areainfo){	
	$this->success('删除成功！');
	}else{
		
	$this->error('删除失败！');
		}
	}
	
	public function usergroupqx_add(){

		$menu=M('Qx')->select();
		
		foreach($menu as $key=>$v){
		
		$menu[$key]['children']=M('Qxgroup')->where(array('qx_id'=>$v['qx_id']))->select();
		
		}	
		$this->assign('menus',$menu);
				$this->main_menu='用户管理';
       $this->son_menu='添加用户组权限';
		
		$this->display();
		
		
	
	}
	

public function usergroupqx_add_submit(){
		
	          if (!IS_POST){
	           E('非法提交！');
	           }
             $post_qx_id = $_POST['checkboxall'];
             $post_group_id = $_POST['checkbox'];
             $post_group_name =$_POST['group_name'];
			 $post_qx_ids = implode(',',$post_qx_id);
			 $post_group_ids = implode(',',$post_group_id);
			 $data['group_name']=$post_group_name;
			 $data['qx_id']=$post_qx_ids;
			 $data['qx_group_id']=$post_group_ids;
			 
	
			 
			 if(M('Group')->add($data)){
				  $this->redirect('Manage/usergroup_list');
				 }else{
					 
					 
					$this->error('添加用户组失败！');	 
					 
					 }

	}
	
	
	
	
	public function usergroupqx_edit(){
	
	    $m_id=I('get.m_id');
		
		$groupinfo = M('Group')->where(array('m_id'=>$m_id))->find();
		
		$qx_group_id=$groupinfo['qx_group_id'];
		
		$group_name=$groupinfo['group_name'];
		
		$qx_id=$groupinfo['qx_id'];
		
		$cat_id=explode(',',$qx_id);
		
		$son_id=explode(',',$qx_group_id);
		
		
		$menu=M('Qx')->select();
		
		foreach($menu as $key=>$v){
		
		$menu[$key]['children']=M('Qxgroup')->where(array('qx_id'=>$v['qx_id']))->select();
		
		}

		$this->assign('m_id',$m_id);
		$this->assign('group_name',$group_name);
		$this->assign('cat_id',$cat_id);
		$this->assign('son_id',$son_id);		
		$this->assign('menus',$menu);
		$this->main_menu='用户管理';
       $this->son_menu='编辑用户组权限';
		$this->display();
		
		
	
	}
	
		public function usergroupqx_edit_submit(){
		
	 if (!IS_POST){
	E('非法提交！');
	}
	
	         $m_id=I('post.m_id');
             $post_qx_id = $_POST['checkboxall'];
             $post_group_id = $_POST['checkbox'];
             $post_group_name =$_POST['group_name'];
			 $post_qx_ids = implode(',',$post_qx_id);
			 $post_group_ids = implode(',',$post_group_id);
			 $data['qx_id']=$post_qx_ids;
			 $data['qx_group_id']=$post_group_ids;
			 if(M('Group')->where(array('m_id'=>$m_id))->save($data)){
				  $this->redirect('Manage/usergroup_list');
				 }else{
					 
					 
					$this->error('修改权限失败！');	 
					 
					 }

	}
	
	
	
	
	
	
	
	
	public function mainmenu_add(){
		
    if (IS_POST){
	$qx_name=I('post.qx_name');
	$menuicon=I('post.menuicon');	
	$data['qx_name']=$qx_name;
	$data['icon']=$menuicon;
	$count=M('Qx')->where(array('qx_name'=>$qx_name))->count();
	
	if($count){
	$state = 0;
	}else if(M('Qx')->add($data)){
		
	$state =1;
	}else{
		
	$state = 2;
	
	}
	 $result = array(
                'state' => $state
            );
            echo json_encode($result);
	
	}else{
	
			$this->main_menu='用户管理';
       $this->son_menu='添加主菜单';
	$this->display();	
		
		
		}
	


	}
	
	

	public function mainmenu_list(){
	$ids=I('get.qx_id');
	if($ids){
		$where=array('qx_id'=>$ids);	
		$uinfo=M('Qx')->where($where);
		}else{
			
		$uinfo=M('Qx');
			
			}
	
	
	$count= $uinfo->count();

	
        $Page = new \Think\Page($count,C('PAGENUM'));
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->rollPage =C('ROLLPAGE');
	$show= $Page->show();
	
	
	if($ids){
		$where=array('qx_id'=>$ids);	
		$query =M('Qx')->where($where)->order('qx_id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
		}else{
			
		$query =M('Qx')->order('qx_id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
			
			}
	
	
	
	$this->assign('count',$count);
	$this->assign('mainmenulist',$query);
	$this->assign('page',$show);
			$this->main_menu='用户管理';
       $this->son_menu='管理主菜单';

	$this->display();
	}
	

	
	
	public function mainmenu_edit(){
	


     if (IS_POST){
	$ids=I('post.qx_id');
	
     $qx_name=I('post.qx_name');
     $icon=I('post.menuicon');
	 $data['qx_name']=$qx_name;
	 $data['icon']=$icon;
	 
	 $where= array('qx_id' =>$ids);

	$areainfo=M('Qx')->where($where)->save($data);
	
	if($areainfo){	
		$state =1;
	}else{
		
		$state =0;
		}
		
		 $result = array(
                'state' => $state
            );
            echo json_encode($result);	
	}else{
		
		
		
	$ids=I('get.qx_id');		
	$info = M('Qx');

	$qxdesc= $info->where(array('qx_id'=>$ids))->find();
	
	$this->assign('qxdesc',$qxdesc);
					$this->main_menu='用户管理';
       $this->son_menu='编辑主菜单';
	
	$this->display();	
		
		
		}

       }

	public function mainmenu_del(){

	$ids=I('get.qx_id');
	$where= array('qx_id' =>$ids);
	$areainfo=M('Qx')->where($where)->delete();
	
	if($areainfo){	
	$this->success('删除成功！');
	}else{
		
	$this->error('删除失败！');
		}
	}
	
	
	
	
	
	
	public function sonmenu_add(){
		
    if (IS_POST){
	$qx_name_1=I('post.qx_name_1');
	$url=I('post.url');	
	$data['qx_name_1']=$qx_name_1;
	$data['url']=$url;
    $data['qx_id']=I('post.qx_id');
    
    
	$count=M('Qxgroup')->where(array('qx_name_1'=>$qx_name_1,'url'=>$url))->count();
	
	if($count){
	$state = 0;
	}else if(M('Qxgroup')->add($data)){
		
	$state =1;
	}else{
		
	$state = 2;
	
	}
	 $result = array(
                'state' => $state
            );
            echo json_encode($result);
	
	}else{
    
    
    $qxlist =M('Qx')->order('qx_id asc')->select();
    
    $this->assign('qxlist',$qxlist);
$this->main_menu='用户管理';
$this->son_menu='添加子菜单';
	
	$this->display();	
		
		
		}
	


	}
	
	

	public function sonmenu_list(){
	$ids=I('get.qx_id');
	if($ids){
		$where=array('qx_id'=>$ids);	
		$uinfo=M('Qxgroup')->where($where);
		}else{
			
		$uinfo=M('Qxgroup');
			
			}
	
	
	$count= $uinfo->count();

        $Page = new \Think\Page($count,C('PAGENUM'));
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->rollPage =C('ROLLPAGE');
	$show= $Page->show();
	
	
	if($ids){
		$where=array('qx_id'=>$ids);	
		$query =M('Qxgroup')->where($where)->order('id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
		}else{
			
		$query =M('Qxgroup')->order('id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
			
			}
            
       foreach ($query as $v){		
	
	$qxdescinfo=M('Qx')->where(array('qx_id'=>$v['qx_id']))->find();
	$qx_name=$qxdescinfo['qx_name'];
	$arr[] = array(
	'id'=>$v['id'],
	'qx_id'=>$v['qx_id'],
    'qx_name_1'=>$v['qx_name_1'],
	'qx_name'=>$qx_name,
    'url'=>$v['url']
			);
	}   
	$this->assign('count',$count);
	$this->assign('sonmenulist',$arr);
	$this->assign('page',$show);
	$this->main_menu='用户管理';
$this->son_menu='管理子菜单';

	$this->display();
	}
	

	
	
	public function sonmenu_edit(){
	


     if (IS_POST){
	 $ids=I('post.id'); 
	 $data['qx_name_1']=I('post.qx_name_1');
	 $data['qx_id']=I('post.qx_id');
     $data['url']=I('post.url');
	 $where= array('id' =>$ids);

	 $areainfo=M('Qxgroup')->where($where)->save($data);
	
	if($areainfo){	
		$state =1;
	}else{
		
		$state =0;
		}
		
		 $result = array(
                'state' => $state
            );
            echo json_encode($result);	
	}else{
		
		
		
	$ids=I('get.id');
	$soninfo=M('Qxgroup')->where(array('id'=>$ids))->find();

     $qxlist =M('Qx')->order('qx_id asc')->select();
     	
	$this->assign('soninfo',$soninfo);
    $this->assign('qxlist',$qxlist);
	
	$this->main_menu='用户管理';
$this->son_menu='编辑子菜单';

	
	$this->display();
		
		
		}

       }

	public function sonmenu_del(){

	$ids=I('get.id');
	$where= array('id' =>$ids);
	$areainfo=M('Qxgroup')->where($where)->delete();
	
	if($areainfo){	
	$this->success('删除成功！');
	}else{
		
	$this->error('删除失败！');
		}
	}
	

}