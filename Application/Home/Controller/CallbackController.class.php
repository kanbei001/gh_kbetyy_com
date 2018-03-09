<?php
namespace Home\Controller;
use Think\Controller;
class CallbackController extends BaseController {
	public function callback_add(){
	
	if (IS_POST){
	$area=I('post.callback');
	$data['callback_name']=$area;
	$count=M('Callback')->where(array('callback_name'=>$area))->count();
	
	if($count){
	 $state = 0;
	}else if(M('Callback')->add($data)){
		
	 $state = 1;
	}else{
		
	 $state = 2;
	
	}	

	$result = array('state' => $state);
	echo json_encode($result);		
	}else{
		$this->main_menu='回访设置';
        $this->son_menu='添加回访';	
		
	$this->display();
		
		}
	

	}
	
  public function callback_list(){
	  
	  
	  
$info = M('Callback');
$count= $info->count();
        $Page = new \Think\Page($count,C('PAGENUM'));
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->rollPage =C('ROLLPAGE');
$show= $Page->show();
$list = $info->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
$this->assign('count',$count);
$this->assign('callbacklist',$list);
$this->assign('page',$show);
		$this->main_menu='回访设置';
        $this->son_menu='回访管理';	
$this->display();

	
	}
	
	

	
	
	
	
	
	public function callback_edit(){
			
	if (IS_POST){
			$ids=I('post.callbackid');
	
	$where= array('id' =>$ids);
    $area=I('post.callback');
	
	
	$data['callback_name']=$area;
	

	$areainfo=M('Callback')->where($where)->save($data);
	
	if($areainfo){	
	 $state = 1;
	}else{
	 $state =0;
		}
		
		
		
		
	$result = array('state' => $state);
	echo json_encode($result);
		}else{
			
			
			$ids=I('get.id');
	
	$where= array('id' =>$ids);
	
	$callbackinfo=M('Callback')->where($where)->find();
	
  $this->assign('callbackinfo',$callbackinfo);
  $this->assign('callback_id',$ids);
  		$this->main_menu='回访设置';
        $this->son_menu='编辑回访';	
  $this->display();	
			
			
			
			
			}
	

	}
	
	public function callback_del(){

	$ids=I('get.id');
	$where= array('id' =>$ids);
	$areainfo=M('Callback')->where($where)->delete();
	
	if($areainfo){	
	$this->success('修改成功！',U('Callback/callback_list'));
	}else{
		
	$this->error('删除失败！');
		}
	}
	
	
	//批量删除
	
	public function delall_ajax(){
	$ids=I('post.delid');
	$areaid=explode(',',$ids);
	$where= array('id' => array('IN', $areaid));
	
	if(M('Callback')->where($where)->delete()){
	
	$result=1;
	
	}else{
	
	$result=0;
	
	};
	
	$data=array('result'=>$result);
	echo json_encode($data);
	}
	
	
	
	
	public function hfsearch_list(){
		
	$huifanglist=M('Callback')->select();
	$zxylist = M('User')->where(array('m_id' => array('IN',array(2,3))))->select();
	$this->assign('zxylist',$zxylist);
    $this->assign('huifanglist',$huifanglist);
  	$this->main_menu='回访设置';
    $this->son_menu='咨询回访查询';

    		
$zxylist =  M('User')->where(array('m_id' => array('IN',array(2,3))))->select();
      foreach($zxylist as $vs){
		$zxyname.="'".$vs['name']."'".",";
		   } 
		   
$zxy = substr($zxyname,0,strlen($zxyname)-1);


$sqls1="select * from bk_kefuinfo where  time>='".date('Y-m-d',C('LASTMONTH_START'))."'"."&& time<='".date('Y-m-d',C('LASTMONTH_END'))."'"." && type_in in ($zxy) && huifang_time<".C('LASTMONTH_START')." && laiyuan='否'";

$sqls2="select * from bk_kefuinfo where  time>='".date('Y-m-d',C('MONTH_START'))."'"."&& time<='".date('Y-m-d',C('MONTH_END'))."'"." && type_in in ($zxy) && huifang_time<".C('MONTH_START')." && laiyuan='否'";


$sqls3="select * from bk_kefuinfo where  time>='".date('Y-m-d',C('WEEK_START'))."'"."&& time<='".date('Y-m-d',C('WEEK_END'))."'"." && type_in in ($zxy) && huifang_time<".C('WEEK_START')." && laiyuan='否'";

$sqls4="select * from bk_kefuinfo where  time='".date('Y-m-d',C('YESTERDAY_START'))."'"."&& type_in in ($zxy) && huifang_time<".C('YESTERDAY_START')." && laiyuan='否'";

$sqls5="select * from bk_kefuinfo where  time='".date('Y-m-d',C('TODAY_START'))."'"."&& type_in in ($zxy) && huifang_time<".C('TODAY_START')." && laiyuan='否'";

$sqls6="select * from bk_kefuinfo where  time='".date('Y-m-d',C('TOMORROW_START'))."'"."&& type_in in ($zxy) && huifang_time<".C('TOMORROW_START')." && laiyuan='否'";

$szdata['wd_s1']= count(M()->query($sqls1));
$szdata['wd_s2']= count(M()->query($sqls2));
$szdata['wd_s3']= count(M()->query($sqls3));
$szdata['wd_s4']= count(M()->query($sqls4));
$szdata['wd_s5']= count(M()->query($sqls5));
$szdata['wd_s6']= count(M()->query($sqls6));
$this->szdata=$szdata;

	$this->display();	
	}
	
	



		//简报详情
		public function jianbao(){
			$zxylist =  M('User')->where(array('m_id' => array('IN',array(2,3))))->select();
      foreach($zxylist as $vs){
		$zxyname.="'".$vs['name']."'".",";
		   } 
		   
$zxy = substr($zxyname,0,strlen($zxyname)-1);

					
if(I('get.info')=='sywhf_weidao'){

$sql="select * from bk_kefuinfo where  time>='".date('Y-m-d',C('LASTMONTH_START'))."'"."&& time<='".date('Y-m-d',C('LASTMONTH_END'))."'"." && type_in in ($zxy) && huifang_time<".C('LASTMONTH_START')." && laiyuan='否'";

}

if(I('get.info')=='bywhf_weidao'){
$sql="select * from bk_kefuinfo where  time>='".date('Y-m-d',C('MONTH_START'))."'"."&& time<='".date('Y-m-d',C('MONTH_END'))."'"." && type_in in ($zxy) && huifang_time<".C('MONTH_START')." && laiyuan='否'";

}

if(I('get.info')=='yzwhf_weidao'){

$sql="select * from bk_kefuinfo where  time>='".date('Y-m-d',C('WEEK_START'))."'"."&& time<='".date('Y-m-d',C('WEEK_END'))."'"." && type_in in ($zxy) && huifang_time<".C('WEEK_START')." && laiyuan='否'";

}

if(I('get.info')=='ztwhf_weidao'){
$sql="select * from bk_kefuinfo where  time='".date('Y-m-d',C('YESTERDAY_START'))."'"."&& type_in in ($zxy) && huifang_time<".C('YESTERDAY_START')." && laiyuan='否'";

}

if(I('get.info')=='jtwhf_weidao'){
$sql="select * from bk_kefuinfo where  time='".date('Y-m-d',C('TODAY_START'))."'"."&& type_in in ($zxy) && huifang_time<".C('TODAY_START')." && laiyuan='否'";
}

if(I('get.info')=='mtwhf_weidao'){

$sql="select * from bk_kefuinfo where  time='".date('Y-m-d',C('TOMORROW_START'))."'"."&& type_in in ($zxy) && huifang_time<".C('TOMORROW_START')." && laiyuan='否'";

}

		 $count =count(M()->query($sql));//总记录数

		 
		$Page = new \Think\Page($count,C('PAGENUM'));
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->rollPage =C('ROLLPAGE');
	    $show= $Page->show();
		 
		 $cc=$Page->firstRow;
		 $dd=$Page->listRows;

	   $sqlss=$sql." order by id desc limit $cc,$dd";
	   
     $queryinfo=M()->query($sqlss);
		 
       foreach ($queryinfo as $v) 
		{
		
		if($v['sex'] == '1') {
		$sex = '男';
		} else if($v['sex'] == '2') {
		$sex = '女';
		} else {
		$sex = '';
		}
		if($v['laiyuan'] =='是') {
		$comed ="<span  style='color:green;'>√</span>";
		} else{
		$comed ="<span  style='color:red;'>×</span>";
		}
		
		
		if($v['isorder'] ==1) {
		$order = "<span rel='1' style='color:green;'>√</span>";
		} else{
		$order = "<span rel='0' style='color:red;cursor:pointer;'>×</span>";
		}
		
		$Qdinfo=M('Qudaoinfo')->where(array('id'=>$v['info_channel']))->find();
		$info_channel=$Qdinfo['info_name'];
		
		
		$Webinfo=M('Web')->where(array('id'=>$v['source_web']))->find();
		$source_web=$Webinfo['web_name'];
		
		
		$in_time=date('Y-m-d',$v['in_time']); 
		
		$laiyuan_time=date('Y-m-d H:i:s',$v['laiyuan_time']);
		$str[]= array
		( 
		
		'id' => $v['id'], 
		'yuyue' => $v['yuyue'],
		'username'=>$v['username'],
		'sex' => $sex, 
		'area' => $v['area'],
		'age' => $v['age'],
		'phone'=>$v['phone'],
		'qq'=>$v['qq'],
		'keshi'=>$v['keshi'],
		'bingzhong'=> $v['bingzhong'],
		'bingzheng'=> $v['bingzheng'],
		'remark'=> $v['remark'],
		'consult'=>$v['consult'],
		'info_channel'=>$info_channel,
		'marketing'=>$v['marketing'],
		'source_web'=>$source_web,
		'source_url'=>$v['source_url'],
		'keyword'=>$v['keyword'],
		'type_in'=>$v['type_in'],
		'isorder'=>$order,
		'comed'=>$comed,
		'isordernum'=>$v['isorder'],
		'time'=>$v['time'],
		'in_time'=>$in_time,
		'doctor'=>$v['doctor'],
		'laiyuan'=>$v['laiyuan'],
		'huifang'=>$v['huifang'],
		'laiyuan_time'=>$laiyuan_time,
		'qudao_group_id'=>$v['qudao_group_id'],
		
		
		);
		
		}

$huifanglist=M('Callback')->select();
$zxylist = M('User')->where(array('m_id' => array('IN',array(2,3))))->select();
$this->assign('xqlist',$str);
$this->assign('page',$show);
$this->assign('zxylist',$zxylist);
$this->assign('huifanglist',$huifanglist);
$this->main_menu='回访设置';
$this->son_menu='咨询简报详情';
	
	

$this->display();
		}
		


public function hflist_ajax(){

		$page = intval(I('post.pageNum')); 
		$pageSize =C('PAGESIZE');	
		$quanxian= session( 'm_id');
		$str = 1;
		$str_1= $str;
		$str2 = 1;
		$str_2= $str2;
  	    $str_2 = $str2 .= "&& time ='". date("Y-m-d")."'";
        $total = intval(M('Kefuinfo')->where($str_2)->count()); //预约记录总数
        $arr['total']     = $total;
        $arr['hfshi']= intval(M('Visit')->where(array('senddate'=>time()))->count()); //已经回访总数
		$arr['hffou']= $arr['total'] - $arr['hfshi'];//未回访记录总数
		$arr['hffou_link']= '/index.php/Callback/jianbao/info/jtwhf_weidao.html';  //未回访记录链接
        if($total>0){
			$totalPage          = ceil($total / $pageSize );
			$startPage          = $page * $pageSize;
			$arr['pageSize']  = $pageSize;
			$arr['totalPage'] = $totalPage;
			$arr['quanxian']  = $quanxian;		
			$query= M('Kefuinfo')->where($str_2)->order('in_time desc')->limit($startPage,$pageSize)->select();
			foreach($query as $v ) {
				$descone=M('Visit')->where(array('aid' =>$v['id']))->order('id desc')->find();	
				$visitdesc=$descone['description'];
				if(empty($visitdesc)){
					if(empty($v['remark'])){
					    $description='';
					}else{
						$description=msubstr($v['remark'],0,C('TIPSONUM'));
					}
				}else{
				    $description=msubstr($visitdesc,0,C('TIPSONUM'));
				}

				$description2='';
		        $desclist=M('Visit')->where(array('aid' =>$v['id']))->order('id desc')->select();
				foreach($desclist as $vs){
					$time=date('Y-m-d H:i',$vs['senddate']);
					$description2.=$vs['writer'].":".$time."&nbsp;>>&nbsp;".$vs['description']."<br/>";
				}
			
				if(empty($description2)){
					if(empty($v['remark'])){
						$description2='无回复记录';
					}else{
					    $description2=$v['remark'];	
					}
				}
				
			    if($v['sex'] == '1') {
				    $sex = '男';
				} else if($v['sex'] == '2') {
				    $sex = '女';
				} else {
				    $sex = '';
				}
			
				if($v['laiyuan'] =='是') {
				    $comed ="<span  style='color:green;'>√</span>";
				} else{
				    $comed ="<span  style='color:red;'>×</span>";
				}
			
				if($v['isorder'] ==1) {
				     $order = "<span rel='1' style='color:green;'>√</span>";
				} else{
				     $order = "<span rel='0' style='color:red;cursor:pointer;'>×</span>";
				}
			
				$Qdinfo           = M('Qudaoinfo')->where(array('id' => $v['info_channel']))->find();
				$info_channel     = $Qdinfo['info_name'];
				$Webinfo          = M('Web')->where(array('id' => $v['source_web']))->find();
				$source_web       = $Webinfo['web_name'];
				$Yxinfo           = M('Yingxiao')->where(array('id' => $v['marketing']))->find();
				$marketing        = $Yxinfo['yingxiao_name'];
				$in_time          = date( 'Y-m-d', $v['in_time'] );
				$laiyuan_time     = date( 'Y-m-d H:i:s', $v['laiyuan_time'] );
				$arr['success']=1;
				$arr['list'][ ] = array(
					'id' => $v['id'],
					'yuyue' => $v['yuyue'],
					'username' => $v['username'],
					'sex' => $sex,
					'area' => $v['area'],
					'age' => $v['age'],
					'phone' =>$v['phone'],
					'qq' => $v['qq'],
					'keshi' => $v['keshi'],
					'bingzhong' => $v['bingzhong'],
					'bingzheng' => $v['bingzheng'],
					'remark' => $v['remark'],
					'consult' => $v['consult'],
					'info_channel' => $info_channel,
					'marketing' => $v['marketing'],
					'source_web' => $source_web,
					'source_url' => $v['source_url'],
					'keyword' => $v['keyword'],
					'type_in' => $v['type_in'],
					'time' => $v['time'],
					'in_time' => $in_time,
					'doctor' => $v['doctor'],
					'order' => $order,
					'laiyuan' => $v['laiyuan'],
					'comed' => $comed,
					'huifang' => $v['huifang'],
					'laiyuan_time' => $laiyuan_time,
					'isorder' =>$v['isorder'],
					'description' =>$description,
					'description2' =>$description2,
					'qudao_group_id' => $v['qudao_group_id']
				);
	         }
		}else{
		     $arr['success']=0;	
		}
	    echo json_encode($arr);
	}



	public function hfsearch_ajax(){
		foreach(I( 'post.data') as $val){
			$data[$val['name']] = $val['value'];
		}
		$page = intval(I('post.pageNum')); 
		$data['date'] = intval(I('post.date'));
		$data['btn'] = intval(I('post.btn'));

		$pageSize =C('PAGESIZE');	
		$quanxian= session( 'm_id');

		
		$where = D('Callback')->getWhere($data);
		$total= intval(M('Kefuinfo')->where($where[0])->count()); //记录总数

        $arr['total']     = $total;
		$arr['hfshi']= intval(M('Visit')->where($where[1])->count()); //已经回访总数
		$arr['hffou']= $arr['total'] - $arr['hfshi'];//未回访记录总数
		$arr['hffou_link']= D('Callback')->getHflink($data['date']);  //未回访记录链接

		if($total>0){
		$yyid = substr($aid,0,strlen($aid)-1);
		$str_2 = $str2 .= "&& id in ($yyid)";
		$total              = count($posts);
		$totalPage          = ceil($total / $pageSize );
		$startPage          = $page * $pageSize;
		$arr['pageSize']  = $pageSize;
		$arr['totalPage'] = $totalPage;
		$arr['quanxian']  = $quanxian;		
        $query= M('Kefuinfo')->where($where[0])->order('in_time desc')->limit($startPage,$pageSize)->select();
        
		foreach($query as $v ) {
			
		$descone=M('Visit')->where(array('aid' =>$v['id']))->order('id desc')->find();	
		$visitdesc=$descone['description'];
		if(empty($visitdesc)){
			if(empty($v['remark'])){
			
			$description='';
			
			}else{
				$description=msubstr($v['remark'],0,C('TIPSONUM'));
				
				}
			
			}else{
				
			$description=msubstr($visitdesc,0,C('TIPSONUM'));
				
				}

		$description2='';
       $desclist=M('Visit')->where(array('aid' =>$v['id']))->order('id desc')->select();
		foreach($desclist as $vs){
			$time=date('Y-m-d H:i',$vs['senddate']);
			$description2.=$time."&nbsp;>>&nbsp;".$vs['description']."<br/>";
			}
		
		if(empty($description2)){
			
			if(empty($v['remark'])){
				$description2='无回复记录';
				}else{
				$description2=$v['remark'];	
					}
		}
			
	   if($v['sex'] == '1') {
		$sex = '男';
		} else if($v['sex'] == '2') {
		$sex = '女';
		} else {
		$sex = '';
		}
		
		if($v['laiyuan'] =='是') {
		$comed ="<span  style='color:green;'>√</span>";
		} else{
		$comed ="<span  style='color:red;'>×</span>";
		}
		
		if($v['isorder'] ==1) {
		$order = "<span rel='1' style='color:green;'>√</span>";
		} else{
		$order = "<span rel='0' style='color:red;cursor:pointer;'>×</span>";
		}
		
		$Qdinfo           = M('Qudaoinfo')->where(array('id' => $v['info_channel']))->find();
		$info_channel     = $Qdinfo['info_name'];
		$Webinfo          = M('Web')->where(array('id' => $v['source_web']))->find();
		$source_web       = $Webinfo['web_name'];
		$Yxinfo           = M('Yingxiao')->where(array('id' => $v['marketing']))->find();
		$marketing        = $Yxinfo['yingxiao_name'];
		$in_time          = date( 'Y-m-d', $v['in_time'] );
		$laiyuan_time     = date( 'Y-m-d H:i:s', $v['laiyuan_time'] );
		$arr['success']=1;
		$arr['list'][ ] = array(
		'id' => $v['id'],
		'yuyue' => $v['yuyue'],
		'username' => $v['username'],
		'sex' => $sex,
		'area' => $v['area'],
		'age' => $v['age'],
		'phone' =>$v['phone'],
		'qq' => $v['qq'],
		'keshi' => $v['keshi'],
		'bingzhong' => $v['bingzhong'],
		'bingzheng' => $v['bingzheng'],
		'remark' => $v['remark'],
		'consult' => $v['consult'],
		'info_channel' => $info_channel,
		'marketing' => $v['marketing'],
		'source_web' => $source_web,
		'source_url' => $v['source_url'],
		'keyword' => $v['keyword'],
		'type_in' => $v['type_in'],
		'time' => $v['time'],
		'in_time' => $in_time,
		'doctor' => $v['doctor'],
		'order' => $order,
		'laiyuan' => $v['laiyuan'],
		'comed' => $comed,
		'huifang' => $v['huifang'],
		'laiyuan_time' => $laiyuan_time,
		'isorder' =>$v['isorder'],
		'description' =>$description,
		'description2' =>$description2,
		'qudao_group_id' => $v['qudao_group_id']
		);

         }
		 

		
	}else{
		
	$arr['success']=0;	
		}
		
		
echo json_encode($arr);
	
}






		public function telsearch_list(){
		
		$huifanglist=M('Callback')->select();
	$zxylist = M('User')->where(array('m_id' =>5))->select();

      if(!empty($zxylist) && isset($zxylist)){
      foreach($zxylist as $vs){
		$zxyname.="'".$vs['name']."'".",";
		   } 
		   
$zxy = substr($zxyname,0,strlen($zxyname)-1);
$sqls1="select * from bk_kefuinfo where  time>='".date('Y-m-d',C('LASTMONTH_START'))."'"."&& time<='".date('Y-m-d',C('LASTMONTH_END'))."'"." && type_in in ($zxy) && huifang_time<".C('LASTMONTH_START')." && laiyuan='否'";
$sqls2="select * from bk_kefuinfo where  time>='".date('Y-m-d',C('MONTH_START'))."'"."&& time<='".date('Y-m-d',C('MONTH_END'))."'"." && type_in in ($zxy) && huifang_time<".C('MONTH_START')." && laiyuan='否'";
$sqls3="select * from bk_kefuinfo where  time>='".date('Y-m-d',C('WEEK_START'))."'"."&& time<='".date('Y-m-d',C('WEEK_END'))."'"." && type_in in ($zxy) && huifang_time<".C('WEEK_START')." && laiyuan='否'";
$sqls4="select * from bk_kefuinfo where  time='".date('Y-m-d',C('YESTERDAY_START'))."'"."&& type_in in ($zxy) && huifang_time<".C('YESTERDAY_START')." && laiyuan='否'";
$sqls5="select * from bk_kefuinfo where  time='".date('Y-m-d',C('TODAY_START'))."'"."&& type_in in ($zxy) && huifang_time<".C('TODAY_START')." && laiyuan='否'";
$sqls6="select * from bk_kefuinfo where  time='".date('Y-m-d',C('TOMORROW_START'))."'"."&& type_in in ($zxy) && huifang_time<".C('TOMORROW_START')." && laiyuan='否'";

$szdata['wd_s1']= count(M()->query($sqls1));
$szdata['wd_s2']= count(M()->query($sqls2));
$szdata['wd_s3']= count(M()->query($sqls3));
$szdata['wd_s4']= count(M()->query($sqls4));
$szdata['wd_s5']= count(M()->query($sqls5));
$szdata['wd_s6']= count(M()->query($sqls6));
 }else{
$szdata['wd_s1']=0;
$szdata['wd_s2']=0;
$szdata['wd_s3']=0;
$szdata['wd_s4']=0;
$szdata['wd_s5']=0;
$szdata['wd_s6']=0; 
	
	 }

$this->szdata=$szdata;	
$this->assign('zxylist',$zxylist);
$this->assign('huifanglist',$huifanglist);
$this->main_menu='回访设置';
$this->son_menu='电话回访查询';
$this->display();	
	}
		
	


public function tellist_ajax(){

		$page = intval(I('post.pageNum')); 
		$pageSize =C('PAGESIZE');	
		$quanxian= session( 'm_id');
		$str = 1;
		$str_1= $str;
		$str2 = 1;
		$str_2= $str2;
		 $zxylist =  M('User')->where(array('m_id' =>5))->select();
		
		foreach($zxylist as $vs){
		$zxyname.="'".$vs['name']."'".",";
		   } 
		$telinfo= M()->query("select * from bk_visit group by aid");
		foreach($telinfo as $v){
		$aid.=$v['aid'].",";
		   }
        
		if($aid && $aid!=''){
		$yyid = substr($aid,0,strlen($aid)-1);
		$zxname.=substr($zxyname,0,strlen($zxyname)-1);
		$str_2 = $str2 .= "&& id in ($yyid) &&  type_in in($zxname)";
		$posts              = M()->query( "select * from bk_kefuinfo where $str_2" );
		$total              = count($posts);
		$totalPage          = ceil($total / $pageSize );
		$startPage          = $page * $pageSize;
		$arr['total']     = $total;
		$arr['pageSize']  = $pageSize;
		$arr['totalPage'] = $totalPage;
		$arr['quanxian']  = $quanxian;		
		$sql = "select * from bk_kefuinfo where $str_2 order by in_time desc limit  $startPage,$pageSize";
		$query= M()->query($sql);

		foreach($query as $v ) {
			
		$descone=M('Visit')->where(array('aid' =>$v['id']))->order('id desc')->find();	
		$visitdesc=$descone['description'];
		if(empty($visitdesc)){
			if(empty($v['remark'])){
			
			$description='';
			
			}else{
				$description=msubstr($v['remark'],0,C('TIPSONUM'));
				
				}
			
			}else{
				
			$description=msubstr($visitdesc,0,C('TIPSONUM'));
				
				}

		$description2='';
       $desclist=M('Visit')->where(array('aid' =>$v['id']))->order('id desc')->select();
		foreach($desclist as $vs){
			$time=date('Y-m-d H:i',$vs['senddate']);
			$description2.=$vs['writer'].":".$time."&nbsp;>>&nbsp;".$vs['description']."<br/>";
			}
		
		if(empty($description2)){
			
			if(empty($v['remark'])){
				$description2='无回复记录';
				}else{
				$description2=$v['remark'];	
					}
		}
			
	   if($v['sex'] == '1') {
		$sex = '男';
		} else if($v['sex'] == '2') {
		$sex = '女';
		} else {
		$sex = '';
		}
		
		if($v['laiyuan'] =='是') {
		$comed ="<span  style='color:green;'>√</span>";
		} else{
		$comed ="<span  style='color:red;'>×</span>";
		}
		
		if($v['isorder'] ==1) {
		$order = "<span rel='1' style='color:green;'>√</span>";
		} else{
		$order = "<span rel='0' style='color:red;cursor:pointer;'>×</span>";
		}
		
		$Qdinfo           = M('Qudaoinfo')->where(array('id' => $v['info_channel']))->find();
		$info_channel     = $Qdinfo['info_name'];
		$Webinfo          = M('Web')->where(array('id' => $v['source_web']))->find();
		$source_web       = $Webinfo['web_name'];
		$Yxinfo           = M('Yingxiao')->where(array('id' => $v['marketing']))->find();
		$marketing        = $Yxinfo['yingxiao_name'];
		$in_time          = date( 'Y-m-d', $v['in_time'] );
		$laiyuan_time     = date( 'Y-m-d H:i:s', $v['laiyuan_time'] );
		$arr['success']=1;
		$arr['list'][ ] = array(
		'id' => $v['id'],
		'yuyue' => $v['yuyue'],
		'username' => $v['username'],
		'sex' => $sex,
		'area' => $v['area'],
		'age' => $v['age'],
		'phone' =>$v['phone'],
		'qq' => $v['qq'],
		'keshi' => $v['keshi'],
		'bingzhong' => $v['bingzhong'],
		'bingzheng' => $v['bingzheng'],
		'remark' => $v['remark'],
		'consult' => $v['consult'],
		'info_channel' => $info_channel,
		'marketing' => $v['marketing'],
		'source_web' => $source_web,
		'source_url' => $v['source_url'],
		'keyword' => $v['keyword'],
		'type_in' => $v['type_in'],
		'time' => $v['time'],
		'in_time' => $in_time,
		'doctor' => $v['doctor'],
		'order' => $order,
		'laiyuan' => $v['laiyuan'],
		'comed' => $comed,
		'huifang' => $v['huifang'],
		'laiyuan_time' => $laiyuan_time,
		'isorder' =>$v['isorder'],
		'description' =>$description,
		'description2' =>$description2,
		'qudao_group_id' => $v['qudao_group_id']
		);

         }
		 

		
	}else{
		
	$arr['success']=0;	
		}
		
		
echo json_encode($arr);
	
}



	public function telsearch_ajax(){

		
		$huifang     = I( 'post.huifang');
        $in_time      = I( 'post.in_time');
		$end_time     = I( 'post.end_time');
		$chakan     = I( 'post.chakan');
		$laiyuan     = I( 'post.laiyuan');
		$page = intval(I('post.pageNum')); 
		

		$pageSize =C('PAGESIZE');	
		$quanxian= session( 'm_id');
		$str = 1;
		$str_1= $str;
		$str2 = 1;
		$str_2= $str2;
		
		if($in_time != '' || $end_time!= '') {
		if($in_time != '' && $end_time!= '') {
		$date    = strtotime($end_time );
		$time_in = date( 'Y-m-d', $date + 1 * 24 * 60 * 60);
		
		$start_time=strtotime($in_time);
		
		$end_time= strtotime($end_time )+86399;
		
		$str_1   = $str .= " && senddate>=$start_time && senddate<=$end_time";
		$str_2   = $str2 .= " && huifang_time>=$start_time && huifang_time<=$end_time";
		} elseif($in_time!= '') {
		$date_end =time();
		$str_1    = $str .= " && senddate>=$start_time && senddate<=$date_end";
	    $str_2    = $str2 .= " && huifang_time>=$start_time && huifang_time<=$date_end";
		}
		}
		
		if($huifang !=0) {
		$callbackid  ="cid='".$huifang."'";
		$str_1       = $str .= "&&($callbackid)";
		$Callbackinfo = M('Callback')->where(array('id' => $huifang))->find();
		$huifang_name = "huifang='" . $Callbackinfo['callback_name'] . "'";
		$str_2        = $str2 .= " && ($huifang_name)";
		}
		
				
		if($laiyuan!='-请选择-'){
		$str_2 = $str2 .= "&&laiyuan='$laiyuan'";
			}
			
		if($chakan!=0) {
		$Userinfo     = M('User')->where(array('id' => $chakan))->find();
		$type_in_name = "type_in='" . $Userinfo['name'] . "'";
		$str_2        = $str2 .= "&&($type_in_name)";
		}else{
			
		$zxylist = M('User')->where(array('m_id' =>5))->select();
    		foreach($zxylist as $vs){
		$zxyname.="'".$vs['name']."'".",";
		   }     
             $zxname.=substr($zxyname,0,strlen($zxyname)-1);
		     $str_2        = $str2 .= "&& type_in in ($zxname)";
			}
		$telinfo= M()->query("select * from bk_visit where $str_1 group by aid");
		foreach($telinfo as $v){
		$aid.=$v['aid'].",";
		   }
        
		if($aid && $aid!=''){
		$yyid = substr($aid,0,strlen($aid)-1);
		$str_2 = $str2 .= "&& id in ($yyid)";
		$posts              = M()->query( "select * from bk_kefuinfo where $str_2" );
		$total              = count($posts);
		$totalPage          = ceil($total / $pageSize );
		$startPage          = $page * $pageSize;
		$arr['total']     = $total;
		$arr['pageSize']  = $pageSize;
		$arr['totalPage'] = $totalPage;
		$arr['quanxian']  = $quanxian;		
		$sql = "select * from bk_kefuinfo where $str_2 order by in_time desc limit  $startPage,$pageSize";
		$query= M()->query($sql);

		foreach($query as $v ) {
			
		$descone=M('Visit')->where(array('aid' =>$v['id']))->order('id desc')->find();	
		$visitdesc=$descone['description'];
		if(empty($visitdesc)){
			if(empty($v['remark'])){
			
			$description='';
			
			}else{
				$description=msubstr($v['remark'],0,C('TIPSONUM'));
				
				}
			
			}else{
				
			$description=msubstr($visitdesc,0,C('TIPSONUM'));
				
				}

		$description2='';
       $desclist=M('Visit')->where(array('aid' =>$v['id']))->order('id desc')->select();
		foreach($desclist as $vs){
			$time=date('Y-m-d H:i',$vs['senddate']);
			$description2.=$time."&nbsp;>>&nbsp;".$vs['description']."<br/>";
			}
		
		if(empty($description2)){
			
			if(empty($v['remark'])){
				$description2='无回复记录';
				}else{
				$description2=$v['remark'];	
					}
		}
			
	   if($v['sex'] == '1') {
		$sex = '男';
		} else if($v['sex'] == '2') {
		$sex = '女';
		} else {
		$sex = '';
		}
		
		if($v['laiyuan'] =='是') {
		$comed ="<span  style='color:green;'>√</span>";
		} else{
		$comed ="<span  style='color:red;'>×</span>";
		}
		
		if($v['isorder'] ==1) {
		$order = "<span rel='1' style='color:green;'>√</span>";
		} else{
		$order = "<span rel='0' style='color:red;cursor:pointer;'>×</span>";
		}
		
		$Qdinfo           = M('Qudaoinfo')->where(array('id' => $v['info_channel']))->find();
		$info_channel     = $Qdinfo['info_name'];
		$Webinfo          = M('Web')->where(array('id' => $v['source_web']))->find();
		$source_web       = $Webinfo['web_name'];
		$Yxinfo           = M('Yingxiao')->where(array('id' => $v['marketing']))->find();
		$marketing        = $Yxinfo['yingxiao_name'];
		$in_time          = date( 'Y-m-d', $v['in_time'] );
		$laiyuan_time     = date( 'Y-m-d H:i:s', $v['laiyuan_time'] );
		$arr['success']=1;
		$arr['list'][ ] = array(
		'id' => $v['id'],
		'yuyue' => $v['yuyue'],
		'username' => $v['username'],
		'sex' => $sex,
		'area' => $v['area'],
		'age' => $v['age'],
		'phone' =>$v['phone'],
		'qq' => $v['qq'],
		'keshi' => $v['keshi'],
		'bingzhong' => $v['bingzhong'],
		'bingzheng' => $v['bingzheng'],
		'remark' => $v['remark'],
		'consult' => $v['consult'],
		'info_channel' => $info_channel,
		'marketing' => $v['marketing'],
		'source_web' => $source_web,
		'source_url' => $v['source_url'],
		'keyword' => $v['keyword'],
		'type_in' => $v['type_in'],
		'time' => $v['time'],
		'in_time' => $in_time,
		'doctor' => $v['doctor'],
		'order' => $order,
		'laiyuan' => $v['laiyuan'],
		'comed' => $comed,
		'huifang' => $v['huifang'],
		'laiyuan_time' => $laiyuan_time,
		'isorder' =>$v['isorder'],
		'description' =>$description,
		'description2' =>$description2,
		'qudao_group_id' => $v['qudao_group_id']
		);

         }
		 

		
	}else{
		
	$arr['success']=0;	
		}
		
		
echo json_encode($arr);
	
}




//简报详情
		public function kfjianbao(){
			$zxylist =  M('User')->where(array('m_id' =>5))->select();
      foreach($zxylist as $vs){
		$zxyname.="'".$vs['name']."'".",";
		   } 
		   
$zxy = substr($zxyname,0,strlen($zxyname)-1);

					
if(I('get.info')=='sywhf_weidao'){

$sql="select * from bk_kefuinfo where  time>='".date('Y-m-d',C('LASTMONTH_START'))."'"."&& time<='".date('Y-m-d',C('LASTMONTH_END'))."'"." && type_in in ($zxy) && huifang_time<".C('LASTMONTH_START')." && laiyuan='否'";

}

if(I('get.info')=='bywhf_weidao'){
$sql="select * from bk_kefuinfo where  time>='".date('Y-m-d',C('MONTH_START'))."'"."&& time<='".date('Y-m-d',C('MONTH_END'))."'"." && type_in in ($zxy) && huifang_time<".C('MONTH_START')." && laiyuan='否'";

}

if(I('get.info')=='yzwhf_weidao'){

$sql="select * from bk_kefuinfo where  time>='".date('Y-m-d',C('WEEK_START'))."'"."&& time<='".date('Y-m-d',C('WEEK_END'))."'"." && type_in in ($zxy) && huifang_time<".C('WEEK_START')." && laiyuan='否'";

}

if(I('get.info')=='ztwhf_weidao'){
$sql="select * from bk_kefuinfo where  time='".date('Y-m-d',C('YESTERDAY_START'))."'"."&& type_in in ($zxy) && huifang_time<".C('YESTERDAY_START')." && laiyuan='否'";

}

if(I('get.info')=='jtwhf_weidao'){
$sql="select * from bk_kefuinfo where  time='".date('Y-m-d',C('TODAY_START'))."'"."&& type_in in ($zxy) && huifang_time<".C('TODAY_START')." && laiyuan='否'";
}

if(I('get.info')=='mtwhf_weidao'){

$sql="select * from bk_kefuinfo where  time='".date('Y-m-d',C('TOMORROW_START'))."'"."&& type_in in ($zxy) && huifang_time<".C('TOMORROW_START')." && laiyuan='否'";

}

		 $count =count(M()->query($sql));//总记录数

		 
		$Page = new \Think\Page($count,C('PAGENUM'));
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->rollPage =C('ROLLPAGE');
	    $show= $Page->show();
		 
		 $cc=$Page->firstRow;
		 $dd=$Page->listRows;

	   $sqlss=$sql." order by id desc limit $cc,$dd";
	   
     $queryinfo=M()->query($sqlss);
		 
       foreach ($queryinfo as $v) 
		{
		
		if($v['sex'] == '1') {
		$sex = '男';
		} else if($v['sex'] == '2') {
		$sex = '女';
		} else {
		$sex = '';
		}
		if($v['laiyuan'] =='是') {
		$comed ="<span  style='color:green;'>√</span>";
		} else{
		$comed ="<span  style='color:red;'>×</span>";
		}
		
		
		if($v['isorder'] ==1) {
		$order = "<span rel='1' style='color:green;'>√</span>";
		} else{
		$order = "<span rel='0' style='color:red;cursor:pointer;'>×</span>";
		}
		
		$Qdinfo=M('Qudaoinfo')->where(array('id'=>$v['info_channel']))->find();
		$info_channel=$Qdinfo['info_name'];
		
		
		$Webinfo=M('Web')->where(array('id'=>$v['source_web']))->find();
		$source_web=$Webinfo['web_name'];
		
		
		$in_time=date('Y-m-d',$v['in_time']); 
		
		$laiyuan_time=date('Y-m-d H:i:s',$v['laiyuan_time']);
		$str[]= array
		( 
		
		'id' => $v['id'], 
		'yuyue' => $v['yuyue'],
		'username'=>$v['username'],
		'sex' => $sex, 
		'area' => $v['area'],
		'age' => $v['age'],
		'phone'=>$v['phone'],
		'qq'=>$v['qq'],
		'keshi'=>$v['keshi'],
		'bingzhong'=> $v['bingzhong'],
		'bingzheng'=> $v['bingzheng'],
		'remark'=> $v['remark'],
		'consult'=>$v['consult'],
		'info_channel'=>$info_channel,
		'marketing'=>$v['marketing'],
		'source_web'=>$source_web,
		'source_url'=>$v['source_url'],
		'keyword'=>$v['keyword'],
		'type_in'=>$v['type_in'],
		'isorder'=>$order,
		'comed'=>$comed,
		'isordernum'=>$v['isorder'],
		'time'=>$v['time'],
		'in_time'=>$in_time,
		'doctor'=>$v['doctor'],
		'laiyuan'=>$v['laiyuan'],
		'huifang'=>$v['huifang'],
		'laiyuan_time'=>$laiyuan_time,
		'qudao_group_id'=>$v['qudao_group_id'],
		
		
		);
		
		}

$huifanglist=M('Callback')->select();
$zxylist = M('User')->where(array('m_id' =>5))->select();
$this->assign('xqlist',$str);
$this->assign('page',$show);
$this->assign('zxylist',$zxylist);
$this->assign('huifanglist',$huifanglist);
$this->main_menu='回访设置';
$this->son_menu='回访简报详情';
	
	

$this->display();
		}




	public function export(){
		
		$huifanglist=M('Callback')->select();
	$zxylist = M('User')->where(array('m_id' => array('IN',array(2,3))))->select();
	  $this->assign('zxylist',$zxylist);
	
  $this->assign('huifanglist',$huifanglist);
  		$this->main_menu='回访设置';
        $this->son_menu='导出回访';		
		
	
	$this->display();	
	}
	

public function daochu(){
      	$huifang     = I( 'post.huifang');
        $in_time      = I( 'post.huifang_in_strat');
		$end_time     = I( 'post.huifang_end_strat');
		$chakan     = I( 'post.chakan');
		$laiyuan     = I( 'post.laiyuan');
		
		$str = 1;
		$str_1= $str;
		$str2 = 1;
		$str_2= $str2;
		
		if($in_time != '' || $end_time!= '') {
		if($in_time != '' && $end_time!= '') {
		$date    = strtotime($end_time );
		$time_in = date( 'Y-m-d', $date + 1 * 24 * 60 * 60);
		
		$start_time=strtotime($in_time);
		
		$end_time= strtotime($end_time )+86399;
		
		$str_1   = $str .= " && senddate>=$start_time && senddate<=$end_time";
		$str_2   = $str2 .= " && huifang_time>=$start_time && huifang_time<=$end_time";
		
		} elseif($in_time!= '') {
		$date_end =time();
		$str_1    = $str .= " && senddate>=$start_time && senddate<=$date_end";
		$str_2    = $str2 .= " && huifang_time>=$start_time && huifang_time<=$date_end";
		}
		}
		
		if($huifang !=0) {
		$callbackid  ="cid='".$huifang."'";
		$str_1       = $str .= "&&($callbackid)";
		$Callbackinfo = M('Callback')->where(array('id' => $huifang))->find();
		$huifang_name = "huifang='" . $Callbackinfo['callback_name'] . "'";
		$str_2        = $str2 .= " && ($huifang_name)";
		}
		
				
		if($laiyuan!='-请选择-'){
		$str_2 = $str2 .= "&&laiyuan='$laiyuan'";
			}
			
		if($chakan!=0) {
		$Userinfo     = M('User')->where(array('id' => $chakan))->find();
		$type_in_name = "type_in='" . $Userinfo['name'] . "'";
		$str_2        = $str2 .= "&&($type_in_name)";
		}else{
			
		$zxylist = M('User')->where(array('m_id' => array('IN',array(2,3))))->select();
    		foreach($zxylist as $vs){
		$zxyname.="'".$vs['name']."'".",";
		   }     
             $zxname.=substr($zxyname,0,strlen($zxyname)-1);
		     $str_2        = $str2 .= "&& type_in in ($zxname)";
			}
		$hfinfo= M()->query("select * from bk_visit where $str_1 group by aid");
		foreach($hfinfo as $v){
		$aid.=$v['aid'].",";
		   }
		   

        
		if($aid && $aid!=''){
		$yyid = substr($aid,0,strlen($aid)-1);
		$str_2 = $str2 .= "&& id in ($yyid)";
		$OrdersData= M()->query( "select * from bk_kefuinfo where $str_2" );
		Vendor('PhpExcel.PHPExcel');
		$cacheMethod =\PHPExcel_CachedObjectStorageFactory::cache_in_memory_serialized; 
         $cacheSettings = array();  
         \PHPExcel_Settings::setCacheStorageMethod($cacheMethod,$cacheSettings);  
		$objPHPExcel = new \PHPExcel();
		$objPHPExcel->getProperties()->setCreator("ctos")  
		->setLastModifiedBy("ctos")  
		->setTitle("Office 2007 XLSX Test Document")  
		->setSubject("Office 2007 XLSX Test Document")  
		->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")  
		->setKeywords("office 2007 openxml php")  
		->setCategory("Test result file");
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(8);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(8);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(60);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(60);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22);
		$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);  
		$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);  
		$objPHPExcel->getActiveSheet()->getStyle('A2:Y2')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A2:Y2')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);  
		$objPHPExcel->getActiveSheet()->getStyle('A2:Y2')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);  
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('E2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('F2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('H2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('I2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('K2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('M2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('O2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('P2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('Q2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('R2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('S2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('T2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('U2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('V2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('W2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('X2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('Y2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
		$objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$objPHPExcel->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$objPHPExcel->getActiveSheet()->getStyle('J')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);    
		$objPHPExcel->getActiveSheet()->getStyle('K')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
		$objPHPExcel->getActiveSheet()->getStyle('L')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
		$objPHPExcel->getActiveSheet()->getStyle('M')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$objPHPExcel->getActiveSheet()->getStyle('N')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$objPHPExcel->getActiveSheet()->getStyle('O')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
		$objPHPExcel->getActiveSheet()->getStyle('P')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$objPHPExcel->getActiveSheet()->getStyle('Q')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$objPHPExcel->getActiveSheet()->getStyle('R')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$objPHPExcel->getActiveSheet()->getStyle('S')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
		$objPHPExcel->getActiveSheet()->getStyle('T')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$objPHPExcel->getActiveSheet()->getStyle('U')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('V')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$objPHPExcel->getActiveSheet()->getStyle('W')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('X')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('Y')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
	    $objPHPExcel->getActiveSheet()->getStyle('L')->getAlignment()->setWrapText(true);//自动换行
		
		$objPHPExcel->getActiveSheet()->getStyle('K')->getAlignment()->setWrapText(true);//自动换行
		
		$objPHPExcel->getActiveSheet()->mergeCells('A1:Y1');  
		$objPHPExcel->setActiveSheetIndex(0)  
		->setCellValue('A1', '订单数据汇总  时间:'.date('Y-m-d H:i:s'))
		->setCellValue('A2', '预约号')  
		->setCellValue('B2', '姓名')  
		->setCellValue('C2', '性别')  
		->setCellValue('D2', '地址')  
		->setCellValue('E2', '年龄')  
		->setCellValue('F2', '电话')  
		->setCellValue('G2', '科室') 
		->setCellValue('H2', '医生') 
		->setCellValue('I2', '预约时间') 
		->setCellValue('J2', '病种')  
		->setCellValue('K2', '病症')
		->setCellValue('L2', '备注')  
		->setCellValue('M2', '渠道') 
		->setCellValue('N2', 'qq')
		->setCellValue('O2', '来源网站')
		->setCellValue('P2', '来源网址')
		->setCellValue('Q2', '信息渠道')
		->setCellValue('R2', '营销方式')  
		->setCellValue('S2', '关键词')
		->setCellValue('T2', '回访')  
		->setCellValue('U2', '来院')
		->setCellValue('V2', '录入员')  
		->setCellValue('W2', '录入时间')
		->setCellValue('X2', '来院时间')
		->setCellValue('Y2', '永久身份');
		
		for($i=0;$i<count($OrdersData);$i++){
		$objPHPExcel->getActiveSheet(0)->setCellValue('A'.($i+3), $OrdersData[$i]['yuyue']);  
		$objPHPExcel->getActiveSheet(0)->setCellValue('B'.($i+3), $OrdersData[$i]['username']);
		
		if($OrdersData[$i]['sex']==1){
		$sex="男";
		}elseif($OrdersData[$i]['sex']==2){
		$sex="女";
		}else{
		$sex="";
		}
		
		$objPHPExcel->getActiveSheet(0)->setCellValue('C'.($i+3),$sex);  
		
		$objPHPExcel->getActiveSheet(0)->setCellValue('D'.($i+3), $OrdersData[$i]['area']);  
		
		if($OrdersData[$i]['age']==0){
		$age="";
		}else{
		$age=$OrdersData[$i]['age'];
		}
		
		$objPHPExcel->getActiveSheet(0)->setCellValue('E'.($i+3),$age); 
		$objPHPExcel->getActiveSheet(0)->setCellValue('F'.($i+3), $OrdersData[$i]['phone']);  
		$objPHPExcel->getActiveSheet(0)->setCellValue('G'.($i+3), $OrdersData[$i]['keshi']);
		$objPHPExcel->getActiveSheet(0)->setCellValue('H'.($i+3), $OrdersData[$i]['doctor']);  
		$objPHPExcel->getActiveSheet(0)->setCellValue('I'.($i+3), $OrdersData[$i]['time']);  
		$objPHPExcel->getActiveSheet(0)->setCellValue('J'.($i+3), $OrdersData[$i]['bingzhong']);  
		$objPHPExcel->getActiveSheet(0)->setCellValue('K'.($i+3), $OrdersData[$i]['bingzheng']);
		
		$description='';
		$visitlist=M('Visit')->where(array('aid'=>$OrdersData[$i]['id']))->order('id desc')->select();
		foreach($visitlist as $cc){
			$time=date('Y-m-d',$cc['senddate']);
			
			$description.=$cc['writer'].":".$time."  ".$cc['description']."\r\n";	
			}
			
			
			if(!empty($OrdersData[$i]['remark'])){
				$remark=$OrdersData[$i]['remark']."\r\n".$description;
				}else{
				$remark=$description;
					
					}
		$objPHPExcel->getActiveSheet(0)->setCellValue('L'.($i+3),$remark); 
		$objPHPExcel->getActiveSheet(0)->setCellValue('M'.($i+3), $OrdersData[$i]['consult']); 
		$objPHPExcel->getActiveSheet(0)->setCellValue('N'.($i+3), $OrdersData[$i]['qq']);
		$web_nameinfo = M('Web')->where(array('id'=>$OrdersData[$i]['source_web']))->find();
		$web_name = $web_nameinfo['web_name'];
		
		$objPHPExcel->getActiveSheet(0)->setCellValue('O'.($i+3), $web_name);
		if(!empty($OrdersData[$i]['source_url'])){
		$OrdersData[$i]['source_url']=htmlspecialchars_decode($OrdersData[$i]['source_url']);
		}else{
		$OrdersData[$i]['source_url']='';
		}
		$objPHPExcel->getActiveSheet(0)->setCellValue('P'.($i+3), $OrdersData[$i]['source_url']);
		$channelnameinfo= M('Qudaoinfo')->where(array('id'=>$OrdersData[$i]['info_channel']))->find();
		$channelname =$channelnameinfo['info_name'];
		$objPHPExcel->getActiveSheet(0)->setCellValue('Q'.($i+3),$channelname);
		$objPHPExcel->getActiveSheet(0)->setCellValue('R'.($i+3), $OrdersData[$i]['marketing']);
		$objPHPExcel->getActiveSheet(0)->setCellValue('S'.($i+3), $OrdersData[$i]['keyword']);
		$objPHPExcel->getActiveSheet(0)->setCellValue('T'.($i+3), $OrdersData[$i]['huifang']);
		$objPHPExcel->getActiveSheet(0)->setCellValue('U'.($i+3), $OrdersData[$i]['laiyuan']);
		$objPHPExcel->getActiveSheet(0)->setCellValue('V'.($i+3), $OrdersData[$i]['type_in']);
		$OrdersData[$i]['in_time']=date("Y-m-d H:i:s",$OrdersData[$i]['in_time']);
		$objPHPExcel->getActiveSheet(0)->setCellValue('W'.($i+3), $OrdersData[$i]['in_time']);
		if(empty($OrdersData[$i]['laiyuan_time'])){
		
		$laiyuantime="";
		}else{
		
		$laiyuantime=date("Y-m-d",$OrdersData[$i]['laiyuan_time']);
		}
		
		$objPHPExcel->getActiveSheet(0)->setCellValue('X'.($i+3),$laiyuantime);
		
		if(empty($OrdersData[$i]['identitys'])){
		
		$identitys="";
		}else{
		
		$identitys="'".$OrdersData[$i]['identitys'];
		}
		
		
		
		$objPHPExcel->getActiveSheet(0)->setCellValue('Y'.($i+3),$identitys);

		$objPHPExcel->getActiveSheet()->getStyle('A'.($i+3).':Y'.($i+3))->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);  
		$objPHPExcel->getActiveSheet()->getStyle('A'.($i+3).':Y'.($i+3))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getRowDimension($i+3)->setRowHeight(16);  
		}  
		$objPHPExcel->getActiveSheet()->setTitle('订单汇总表');  
		$objPHPExcel->setActiveSheetIndex(0);
		ob_end_clean();  //清空缓存  
		
		header("Pragma: public");
		
		header("Expires: 0");
		
		header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
		
		header("Content-Type:application/force-download");
		
		header("Content-Type:application/vnd.ms-execl");
		
		header("Content-Type:application/octet-stream");
		
		header("Content-Type:application/download");
		
		header('Content-Disposition: attachment;filename="__NAMEYY__预约信息汇总表('.date('Ymd-His').').xls"'); 
		
		header("Content-Transfer-Encoding:binary");  
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');  
		
		
}

	
}





			
}