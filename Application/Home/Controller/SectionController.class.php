<?php
namespace Home\Controller;
use Think\Controller;
class SectionController extends BaseauthController {
    
      function __construct(){ 
			parent::__construct(); 
			//科室、病种列表
			$Secinfos=M('Section')->select(); 
			foreach ($Secinfos as $val) {
				$Secinfo[] = $val;
				$bz=M('Bingzhong')->where(array('keshi_id'=>$val['id']))->select(); 
				$Secinfo = array_merge($Secinfo,$bz);
			}
			$this->assign('Secinfos',$Secinfos);
		}

	
	
	
	/**
	 * 科室列表
	 * @return [type] [description]
	 */
	public function section_list(){
		$info = M('Section');
		$count= $info->count();
	    $Page = new \Think\Page($count,C('PAGENUM'));
	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
	    $Page->rollPage =C('ROLLPAGE');
		$show= $Page->show();
		$list = $info->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('count',$count);
		$this->assign('sectionlist',$list);
		$this->assign('page',$show);
		$this->main_menu='科室设置';
		$this->son_menu='科室管理';
		$this->display();
	}
	/**
	 * 科室添加
	 * @return [type] [description]
	 */
	public function ks_add(){ 
		if (IS_POST){
			$data['section_name']=I('post.section_name');
			$count=M('Section')->where($data)->count();
			if($count==0){
			    if(M('Section')->add($data)){
	                $this->success('添加成功！');
	            }else{
	                $this->error('添加失败！');
	            }	
			}else{
			    $this->error('该科室已经存在！');
			}
		}else{
			$this->assign('do',"添加");
			$this->display('edit');
		}


	}
	
	/**
	 * 科室修改
	 * @return [type] [description]
	 */
	public function ks_edit(){
		if (IS_POST){
			$where= array('id' =>I('post.id')); 
			$data= array('id' =>I('post.id'),'section_name'=>I('post.section_name'));  
			if(M('Section')->where($where)->save($data)){
                $this->success('修改成功！');
            }else{
                $this->error('修改失败！');
            }	
		}else{
			$sectioninfo=M('Section')->find(I('get.id'));
			$this->assign($sectioninfo);
			$this->assign('do',"修改");
			$this->display('edit');
		}
	}

/****************************************************************************病种操作*********************************************************************/	
	
	/**
	 * 病种列表
	 * @return [type] [description]
	 */
	public function bingzhong_list(){
		$wh = array();
		if(I('get.id')){
			$wh['keshi_id']=I('get.id');
		}
		$info = M('Bingzhong');
		$count= $info->where($wh)->count();  
        $Page = new \Think\Page($count,C('PAGENUM'));
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->rollPage =C('ROLLPAGE');
		$show= $Page->show();
		$query = $info->where($wh)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		
		foreach ($query as $v){		
			$keshiinfo=M('Section')->find($v['keshi_id']);  
			$section_name=$keshiinfo['section_name'];
			$arr[] = array(
					'id'=>$v['id'],
					'keshi_id'=>I('get.id'),   
					'bingzhong_name'=>$v['bingzhong_name'],
					'section_name'=>$section_name   
			);
		}
		$this->assign('count',$count);
		$this->assign('bingzhonglist',$arr);
		$this->assign('page',$show);
		$this->main_menu='科室设置';
        $this->son_menu='病种管理';
		$this->display();
	}

	/**
	 * 病种添加
	 * @return [type] [description]
	 */
	public function bz_add(){
		if (IS_POST){
			$data['bingzhong_name']=I('post.bingzhong_name');
			$data['keshi_id']=I('post.keshi_id');
			$count=M('Bingzhong')->where(array('bingzhong_name'=>I('post.bingzhong_name'),'keshi_id'=>I('post.keshi_id')))->count();
			if($count==0){
			    if(M('Bingzhong')->add($data)){
	                $this->success('添加成功！','/index.php/Section/bingzhong_list.html');
	            }else{
	                $this->error('添加失败！');
	            }	
			}else{
			    $this->error('该病种已经存在！');
			}
		}else{
			$this->assign('do',"添加");
			$this->display('edit2');
		}
	}
	/**
	 * 病种修改
	 * @return [type] [description]
	 */
	public function bz_edit(){
		if (IS_POST){
			$id=I('post.id');
			$where= array('id' =>$id);
			$data['bingzhong_name']=I('post.bingzhong_name');
			$data['keshi_id']=I('post.keshi_id');
            if(M('Bingzhong')->where($where)->save($data)){
                $this->success('修改成功！');
            }else{
                $this->error('修改失败！');
            }	
		}else{
			$bingzhonginfo=M('Bingzhong')->find(I('get.id')); 
			$this->assign($bingzhonginfo);
			$this->assign('do',"修改");
			$this->display('edit2');
		}
	}
	
	/**
	 * [批量]删除
	 * @return [type] [description]
	 */
	public function del(){
		$ids=I('get.id'); 
		$table=I('get.t'); 
		$id=explode(',',$ids);
		$where= array('id' => array('IN', $id));
		$areainfo=M($table)->where($where)->delete();
		if($areainfo){	
		    $this->success('删除成功！');
		}else{
		    $this->error('删除失败！');
		}
	}
	
}