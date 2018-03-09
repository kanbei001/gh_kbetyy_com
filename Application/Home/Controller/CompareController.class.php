<?php
namespace Home\Controller;
use Think\Controller;
class CompareController extends BaseauthController {
	
   //信息对比
	public function infoduibi(){
		
	$date_str = date("Y-m-d",mktime(0, 0 , 0,date("m"),1,date("Y"))) ;
	$time_name = strtotime($date_str);
	$Qudao_groupinfo=M('Qudaogroup')->find();
	$v['qudao_id']=1;
	$v['start_date']= $time_name;
	$v['en_date']=time();
	
	if($_POST){
	if($_POST['en_date']==''){
	$v['qudao_id'] = $_POST['qudao'];
	$v['en_date']=time();
	$v['start_date'] =strtotime($_POST['start_date']);
	}else{
	$v['qudao_id'] =$_POST['qudao'];
	$v['start_date'] =strtotime($_POST['start_date']);
	$v['en_date'] =strtotime($_POST['en_date'])+86399;
	}
	}

	$v['start_date1']=strtotime($_POST['start_date_1']);
	$v['en_date1']=strtotime($_POST['en_date_1'])+86399;
	
	$posts=M('Qudaoinfo')->select();
	foreach($posts as $vo){
	$dycount=M('Kefuinfo')->where(array('isorder'=>1,'info_channel'=>$vo['id'],'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',$v['start_date']),array('ELT',$v['en_date']))))->count();
	$dycount2=M('Kefuinfo')->where(array('isorder'=>1,'info_channel'=>$vo['id'],'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',$v['start_date1']),array('ELT',$v['en_date1']))))->count();
	$dynumbers[]=$dycount;
	$dynumbers2[]=$dycount2;
	$dychazhi[]=$dycount2-$dycount;
	$yycount=M('Kefuinfo')->where(array('isorder'=>1,'info_channel'=>$vo['id'],'in_time'=>array(array('EGT',$v['start_date']),array('ELT',$v['en_date']))))->count();
	$yycount2=M('Kefuinfo')->where(array('isorder'=>1,'info_channel'=>$vo['id'],'in_time'=>array(array('EGT',$v['start_date1']),array('ELT',$v['en_date1']))))->count();
	$yynumbers[]=$yycount;
	$yynumbers2[]=$yycount2;
	$dychazhi2[]=$yycount2-$yycount;

	}
	
	
	
	$dytotal=M('Kefuinfo')->where(array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',$v['start_date']),array('ELT',$v['en_date']))))->count();
	$dytotal2=M('Kefuinfo')->where(array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',$v['start_date1']),array('ELT',$v['en_date1']))))->count();
	$dynumbers[]=$dytotal;
	$dynumbers2[]=$dytotal2;
	$dychazhi[]=$dytotal2-$dytotal;
	$yytotal=M('Kefuinfo')->where(array('isorder'=>1,'in_time'=>array(array('EGT',$v['start_date']),array('ELT',$v['en_date']))))->count();
	$yytotal2=M('Kefuinfo')->where(array('isorder'=>1,'in_time'=>array(array('EGT',$v['start_date1']),array('ELT',$v['en_date1']))))->count();
	$yynumbers[]=$yytotal;
	$yynumbers2[]=$yytotal2;
	$dychazhi2[]=$yytotal2-$yytotal;
	$this->assign('dynumbers',$dynumbers);	
	$this->assign('yynumbers',$yynumbers);
	$this->assign('dychazhi',$dychazhi);	
	$this->assign('dynumbers2',$dynumbers2);	
	$this->assign('yynumbers2',$yynumbers2);
	$this->assign('dychazhi2',$dychazhi2);					
	$this->assign('posts',$posts);	
	$this->assign('riqi',$v);	
	
	$this->main_menu='来诊对比';
	$this->son_menu='信息对比';	
	$this->display();	
	
	}
	
	
	//科室对比
	
	public function ksduibi(){
		
	$date_str = date("Y-m-d",mktime(0, 0 , 0,date("m"),1,date("Y"))) ;
	$time_name = strtotime($date_str);
	$Qudao_groupinfo=M('Qudaogroup')->find();
	$v['qudao_id']= $Qudao_groupinfo['id'];
	$v['start_date']= $time_name;
	$v['en_date']=time();
	if($_POST){
	if($_POST['en_date']==''){
	$v['qudao_id'] = $_POST['qudao'];
	$v['en_date']=time();
	$v['start_date'] =strtotime($_POST['start_date']);
	}else{
	$v['qudao_id'] =$_POST['qudao'];
	$v['start_date'] =strtotime($_POST['start_date']);
	$v['en_date'] =strtotime($_POST['en_date'])+86399;
	}
	}
	
	$v['start_date1']=strtotime($_POST['start_date_1']);
	$v['en_date1']=strtotime($_POST['en_date_1'])+86399;
	
	
	$posts=M('Section')->select();
	foreach($posts as $vo){
	$dycount=M('Kefuinfo')->where(array('isorder'=>1,'keshi'=>$vo['section_name'],'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',$v['start_date']),array('ELT',$v['en_date']))))->count();
	$dycount2=M('Kefuinfo')->where(array('isorder'=>1,'keshi'=>$vo['section_name'],'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',$v['start_date1']),array('ELT',$v['en_date1']))))->count();
	$dynumbers[]=$dycount;
	$dynumbers2[]=$dycount2;
	$dychazhi[]=$dycount2-$dycount;
	$yycount=M('Kefuinfo')->where(array('isorder'=>1,'keshi'=>$vo['section_name'],'in_time'=>array(array('EGT',$v['start_date']),array('ELT',$v['en_date']))))->count();
	$yycount2=M('Kefuinfo')->where(array('isorder'=>1,'keshi'=>$vo['section_name'],'in_time'=>array(array('EGT',$v['start_date1']),array('ELT',$v['en_date1']))))->count();
	$yynumbers[]=$yycount;
	$yynumbers2[]=$yycount2;
	$dychazhi2[]=$yycount2-$yycount;
	}
	
	$dytotal=M('Kefuinfo')->where(array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',$v['start_date']),array('ELT',$v['en_date']))))->count();
	$dytotal2=M('Kefuinfo')->where(array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',$v['start_date1']),array('ELT',$v['en_date1']))))->count();
	$dynumbers[]=$dytotal;
	$dynumbers2[]=$dytotal2;
	$dychazhi[]=$dytotal2-$dytotal;
	$yytotal=M('Kefuinfo')->where(array('isorder'=>1,'in_time'=>array(array('EGT',$v['start_date']),array('ELT',$v['en_date']))))->count();
	$yytotal2=M('Kefuinfo')->where(array('isorder'=>1,'in_time'=>array(array('EGT',$v['start_date1']),array('ELT',$v['en_date1']))))->count();
	$yynumbers[]=$yytotal;
	$yynumbers2[]=$yytotal2;
	$dychazhi2[]=$yytotal2-$yytotal;
	$this->assign('dynumbers',$dynumbers);	
	$this->assign('yynumbers',$yynumbers);
	$this->assign('dychazhi',$dychazhi);	
	$this->assign('dynumbers2',$dynumbers2);	
	$this->assign('yynumbers2',$yynumbers2);
	$this->assign('dychazhi2',$dychazhi2);					
	$this->assign('posts',$posts);	
	$this->assign('riqi',$v);	
		$this->main_menu='来诊对比';
	$this->son_menu='科室对比';	
	$this->display();
	
	}
	
	
	
	
	
	//渠道对比
	public function consultduibi(){
		
	$date_str = date("Y-m-d",mktime(0, 0 , 0,date("m"),1,date("Y"))) ;
	$time_name = strtotime($date_str);
	$Qudao_groupinfo=M('Qudaogroup')->find();
	$v['qudao_id']= $Qudao_groupinfo['id'];
	$v['start_date']= $time_name;
	$v['en_date']=time();
	if($_POST){
	if($_POST['en_date']==''){
	$v['qudao_id'] = $_POST['qudao'];
	$v['en_date']=time();
	$v['start_date'] =strtotime($_POST['start_date']);
	}else{
	$v['qudao_id'] =$_POST['qudao'];
	$v['start_date'] =strtotime($_POST['start_date']);
	$v['en_date'] =strtotime($_POST['en_date'])+86399;
	}
	}
	
	$v['start_date1']=strtotime($_POST['start_date_1']);
	$v['en_date1']=strtotime($_POST['en_date_1'])+86399;
	
	$posts=M('Consult')->select();
	foreach($posts as $vo){
	
	
	$dycount=M('Kefuinfo')->where(array('isorder'=>1,'consult'=>$vo['consult_name'],'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',$v['start_date']),array('ELT',$v['en_date']))))->count();
	$dycount2=M('Kefuinfo')->where(array('isorder'=>1,'consult'=>$vo['consult_name'],'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',$v['start_date1']),array('ELT',$v['en_date1']))))->count();
$dynumbers[]=$dycount;
$dynumbers2[]=$dycount2;
$dychazhi[]=$dycount2-$dycount;
$yycount=M('Kefuinfo')->where(array('isorder'=>1,'consult'=>$vo['consult_name'],'in_time'=>array(array('EGT',$v['start_date']),array('ELT',$v['en_date']))))->count();
$yycount2=M('Kefuinfo')->where(array('isorder'=>1,'consult'=>$vo['consult_name'],'in_time'=>array(array('EGT',$v['start_date1']),array('ELT',$v['en_date1']))))->count();
	$yynumbers[]=$yycount;
	$yynumbers2[]=$yycount2;
	$dychazhi2[]=$yycount2-$yycount;
	
	
	}
	
	$dytotal=M('Kefuinfo')->where(array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',$v['start_date']),array('ELT',$v['en_date']))))->count();
	$dytotal2=M('Kefuinfo')->where(array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',$v['start_date1']),array('ELT',$v['en_date1']))))->count();
	$dynumbers[]=$dytotal;
	$dynumbers2[]=$dytotal2;
	$dychazhi[]=$dytotal2-$dytotal;
	$yytotal=M('Kefuinfo')->where(array('isorder'=>1,'in_time'=>array(array('EGT',$v['start_date']),array('ELT',$v['en_date']))))->count();
	$yytotal2=M('Kefuinfo')->where(array('isorder'=>1,'in_time'=>array(array('EGT',$v['start_date1']),array('ELT',$v['en_date1']))))->count();
	$yynumbers[]=$yytotal;
	$yynumbers2[]=$yytotal2;
	$dychazhi2[]=$yytotal2-$yytotal;
	$this->assign('dynumbers',$dynumbers);	
	$this->assign('yynumbers',$yynumbers);
	$this->assign('dychazhi',$dychazhi);	
	$this->assign('dynumbers2',$dynumbers2);	
	$this->assign('yynumbers2',$yynumbers2);
	$this->assign('dychazhi2',$dychazhi2);					
	$this->assign('posts',$posts);	
	$this->assign('riqi',$v);	
	$this->main_menu='来诊对比';
	$this->son_menu='渠道对比';	
	$this->display();	
	
	}
	
	
    //地区对比
	public function areaduibi(){
		
	$date_str = date("Y-m-d",mktime(0, 0 , 0,date("m"),1,date("Y"))) ;
	$time_name = strtotime($date_str);
	$Qudao_groupinfo=M('Qudaogroup')->find();
	$v['qudao_id']= $Qudao_groupinfo['id'];
	$v['start_date']= $time_name;
	$v['en_date']=time();
	if($_POST){
	if($_POST['en_date']==''){
	$v['qudao_id'] = $_POST['qudao'];
	$v['en_date']=time();
	$v['start_date'] =strtotime($_POST['start_date']);
	}else{
	$v['qudao_id'] =$_POST['qudao'];
	$v['start_date'] =strtotime($_POST['start_date']);
	$v['en_date'] =strtotime($_POST['en_date'])+86399;
	}
	}
	
	$v['start_date1']=strtotime($_POST['start_date_1']);
	$v['en_date1']=strtotime($_POST['en_date_1'])+86399;
	
	$posts=M('Area')->select();
	foreach($posts as $vo){
	
	
	$dycount=M('Kefuinfo')->where(array('isorder'=>1,'area'=>$vo['area_name'],'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',$v['start_date']),array('ELT',$v['en_date']))))->count();
	$dycount2=M('Kefuinfo')->where(array('isorder'=>1,'area'=>$vo['area_name'],'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',$v['start_date1']),array('ELT',$v['en_date1']))))->count();
	$dynumbers[]=$dycount;
	$dynumbers2[]=$dycount2;
	$dychazhi[]=$dycount2-$dycount;
	$yycount=M('Kefuinfo')->where(array('isorder'=>1,'area'=>$vo['area_name'],'in_time'=>array(array('EGT',$v['start_date']),array('ELT',$v['en_date']))))->count();
	$yycount2=M('Kefuinfo')->where(array('isorder'=>1,'area'=>$vo['area_name'],'in_time'=>array(array('EGT',$v['start_date1']),array('ELT',$v['en_date1']))))->count();
	$yynumbers[]=$yycount;
	$yynumbers2[]=$yycount2;
	$dychazhi2[]=$yycount2-$yycount;

	}
	$dytotal=M('Kefuinfo')->where(array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',$v['start_date']),array('ELT',$v['en_date']))))->count();
	$dytotal2=M('Kefuinfo')->where(array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',$v['start_date1']),array('ELT',$v['en_date1']))))->count();
	$dynumbers[]=$dytotal;
	$dynumbers2[]=$dytotal2;
	$dychazhi[]=$dytotal2-$dytotal;
	$yytotal=M('Kefuinfo')->where(array('isorder'=>1,'in_time'=>array(array('EGT',$v['start_date']),array('ELT',$v['en_date']))))->count();
	$yytotal2=M('Kefuinfo')->where(array('isorder'=>1,'in_time'=>array(array('EGT',$v['start_date1']),array('ELT',$v['en_date1']))))->count();
	$yynumbers[]=$yytotal;
	$yynumbers2[]=$yytotal2;
	$dychazhi2[]=$yytotal2-$yytotal;
	
	$this->assign('dynumbers',$dynumbers);	
	$this->assign('yynumbers',$yynumbers);
	$this->assign('dychazhi',$dychazhi);	
	$this->assign('dynumbers2',$dynumbers2);	
	$this->assign('yynumbers2',$yynumbers2);
	$this->assign('dychazhi2',$dychazhi2);					
	$this->assign('posts',$posts);	
	$this->assign('riqi',$v);
	$this->main_menu='来诊对比';
	$this->son_menu='地区对比';	
	$this->display();	
	}
	
	
	
	//网站对比
	
	public function webduibi(){
		
	$date_str = date("Y-m-d",mktime(0, 0 , 0,date("m"),1,date("Y"))) ;
	$time_name = strtotime($date_str);
	$Qudao_groupinfo=M('Qudaogroup')->find();
	$v['qudao_id']= $Qudao_groupinfo['id'];
	$v['start_date']= $time_name;
	$v['en_date']=time();
	if($_POST){
	if($_POST['en_date']==''){
	$v['qudao_id'] = $_POST['qudao'];
	$v['en_date']=time();
	$v['start_date'] =strtotime($_POST['start_date']);
	}else{
	$v['qudao_id'] =$_POST['qudao'];
	$v['start_date'] =strtotime($_POST['start_date']);
	$v['en_date'] =strtotime($_POST['en_date'])+86399;
	}
	}
	
	$v['start_date1']=strtotime($_POST['start_date_1']);
	$v['en_date1']=strtotime($_POST['en_date_1'])+86399;
	
	$posts=M('Web')->select();
	foreach($posts as $vo){
	$dycount=M('Kefuinfo')->where(array('isorder'=>1,'source_web'=>$vo['id'],'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',$v['start_date']),array('ELT',$v['en_date']))))->count();
	$dycount2=M('Kefuinfo')->where(array('isorder'=>1,'source_web'=>$vo['id'],'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',$v['start_date1']),array('ELT',$v['en_date1']))))->count();
	$dynumbers[]=$dycount;
	$dynumbers2[]=$dycount2;
	$dychazhi[]=$dycount2-$dycount;
	$yycount=M('Kefuinfo')->where(array('isorder'=>1,'source_web'=>$vo['id'],'in_time'=>array(array('EGT',$v['start_date']),array('ELT',$v['en_date']))))->count();
	$yycount2=M('Kefuinfo')->where(array('isorder'=>1,'source_web'=>$vo['id'],'in_time'=>array(array('EGT',$v['start_date1']),array('ELT',$v['en_date1']))))->count();
	$yynumbers[]=$yycount;
	$yynumbers2[]=$yycount2;
	$dychazhi2[]=$yycount2-$yycount;
	
	}
	$dytotal=M('Kefuinfo')->where(array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',$v['start_date']),array('ELT',$v['en_date']))))->count();
	$dytotal2=M('Kefuinfo')->where(array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',$v['start_date1']),array('ELT',$v['en_date1']))))->count();
	$dynumbers[]=$dytotal;
	$dynumbers2[]=$dytotal2;
	$dychazhi[]=$dytotal2-$dytotal;
	$yytotal=M('Kefuinfo')->where(array('isorder'=>1,'in_time'=>array(array('EGT',$v['start_date']),array('ELT',$v['en_date']))))->count();
	$yytotal2=M('Kefuinfo')->where(array('isorder'=>1,'in_time'=>array(array('EGT',$v['start_date1']),array('ELT',$v['en_date1']))))->count();
	$yynumbers[]=$yytotal;
	$yynumbers2[]=$yytotal2;
	$dychazhi2[]=$yytotal2-$yytotal;
	$this->assign('dynumbers',$dynumbers);	
	$this->assign('yynumbers',$yynumbers);
	$this->assign('dychazhi',$dychazhi);	
	$this->assign('dynumbers2',$dynumbers2);	
	$this->assign('yynumbers2',$yynumbers2);
	$this->assign('dychazhi2',$dychazhi2);					
	$this->assign('posts',$posts);	
	$this->assign('riqi',$v);
	$this->main_menu='来诊对比';
	$this->son_menu='网站对比';		
	$this->display();	
	
	}
	
	
}