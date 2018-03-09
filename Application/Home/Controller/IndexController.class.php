<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
	  
	/******************************************************************【】  首页   【】***********************************************************/
    public function index(){
		//print_r("m_id:".session('m_id'));
		
		if(session('m_id')==1){
		$info_count=array();
		$arr=array();
				$info_count = D('Index')->getIndexArr(C('DAYLIST'),C('DAYACT'));//信息统计
		
	//	dump($info_count);
		
		
		$where_ssyyy=array('isorder'=>1,'in_time' => array(array('EGT',C('PRELASTMONTH_START')),array('ELT',C('PRELASTMONTH_END'))));//上上月预约
		$where_ssysd=array('isorder'=>1,'laiyuan_time' =>array(array('EGT',C('PRELASTMONTH_START')),array('ELT',C('PRELASTMONTH_END'))),'laiyuan'=>'是');//上上月到院
		
		$arr['prelastmonth_yy']=M('Kefuinfo')->where($where_ssyyy)->count();
		
		$arr['prelastmonth_dy']=M('Kefuinfo')->where($where_ssysd)->count();
		
		$ssyinfo=M('Monthgoal')->where(array('yuefen'=>date('Y-m',C('PRELASTMONTH_START'))))->find();
		
		$syinfo=M('Monthgoal')->where(array('yuefen'=>date('Y-m',C('LASTMONTH_START'))))->find();
		
		$byinfo=M('Monthgoal')->where(array('yuefen'=>date('Y-m',C('MONTH_START'))))->find();
		$arr['prelastmonth_goal']=$ssyinfo['goalnum'];
		$arr['lastmonth_goal']=$syinfo['goalnum'];
		$arr['month_goal']=$byinfo['goalnum'];
		$arr['prelastmonth']=$ssyinfo['yuefen'];
		$arr['lastmonth']=$syinfo['yuefen'];
		$arr['month']=$byinfo['yuefen'];
		
    $bystartcuo=strtotime(date('Y-m-01'));
    $bynowcuo=strtotime(date('Y-m-d'))+86399;
    $bystartcuo1=strtotime(date('Y-m-01'));
    $bynowcuo1=strtotime(date('Y-m-d'));
    $systartcuo=strtotime(last_month_today($bystartcuo1));
    $synowcuo=strtotime(last_month_today( $bynowcuo1))+86399;
    
    $where_tqbyyy=array('isorder'=>1,'in_time' => array(array('EGT',$bystartcuo),array('ELT',$bynowcuo)));//截止本月目前日期预约
    
    $where_tqbyyd=array('isorder'=>1,'time' => array(array('EGT',date('Y-m-01')),array('ELT',date('Y-m-d'))));//截止本月目前日期预到
    
    $where_tqbysd=array('isorder'=>1,'laiyuan_time' =>array(array('EGT',$bystartcuo),array('ELT',$bynowcuo)),'laiyuan'=>'是');//截止本月目前日期已到
    
    $where_tqbywd=array('isorder'=>1,'time' => array(array('EGT',date('Y-m-01')),array('ELT',date('Y-m-d'))),'laiyuan'=>'否');//截止本月目前日期未到
    
    $where_tqbydz=array('isorder'=>1,'time' => array(array('EGT',date('Y-m-01')),array('ELT',date('Y-m-d'))),'laiyuan'=>'否','huifang'=>array('EQ','待诊'));//截止本月目前日期待诊
    
    $arr['tqbyyysl']=M('Kefuinfo')->where($where_tqbyyy)->count();
    
    $arr['tqbyydsl']=M('Kefuinfo')->where($where_tqbyyd)->count();
    
    $arr['tqbysdsl']=M('Kefuinfo')->where($where_tqbysd)->count();
    
    $arr['tqbywdsl']=M('Kefuinfo')->where($where_tqbywd)->count();
    $arr['tqbydzsl']=M('Kefuinfo')->where($where_tqbydz)->count();
    
    
    $where_tqsyyy=array('isorder'=>1,'in_time' => array(array('EGT',$systartcuo),array('ELT',$synowcuo)));//截止上月目前日期预约
    
    $where_tqsyyd=array('isorder'=>1,'time' => array(array('EGT',date('Y-m-d',$systartcuo)),array('ELT',date('Y-m-d',$synowcuo))));//截止上月目前日期预到
    
    $where_tqsysd=array('isorder'=>1,'laiyuan_time' =>array(array('EGT',$systartcuo),array('ELT',$synowcuo)),'laiyuan'=>'是');//截止上月目前日期已到
    
    $where_tqsywd=array('isorder'=>1,'time' => array(array('EGT',date('Y-m-d',$systartcuo)),array('ELT',date('Y-m-d',$synowcuo))),'laiyuan'=>'否');//截止上月目前日期未到
    
    $where_tqsydz=array('isorder'=>1,'time' => array(array('EGT',date('Y-m-d',$systartcuo)),array('ELT',date('Y-m-d',$synowcuo))),'laiyuan'=>'否','huifang'=>array('EQ','待诊'));//截止上月目前日期待诊
    
    $arr['tqsyyysl']=M('Kefuinfo')->where($where_tqsyyy)->count();
    
    $arr['tqsyydsl']=M('Kefuinfo')->where($where_tqsyyd)->count();
    
    $arr['tqsysdsl']=M('Kefuinfo')->where($where_tqsysd)->count();
    
    $arr['tqsywdsl']=M('Kefuinfo')->where($where_tqsywd)->count();
    
    $arr['tqsydzsl']=M('Kefuinfo')->where($where_tqsydz)->count();
    
    
    
    $byzxl=$arr['tqbysdsl']/$arr['tqbyydsl']; 
    $bya= round($byzxl,2)*100;
    
    
    
    $syzxl=$arr['tqsysdsl']/$arr['tqsyydsl']; 
    $sya= round($syzxl,2)*100;
    $arr['tqyycz']=$arr['tqbyyysl']-$arr['tqsyyysl'];
    $arr['tqydcz']=$arr['tqbyydsl']-$arr['tqsyydsl'];
    $arr['tqsdcz']=$arr['tqbysdsl']-$arr['tqsysdsl'];
    $arr['tqwdcz']=$arr['tqbywdsl']-$arr['tqsywdsl'];
    $arr['tqdzcz']=$arr['tqbydzsl']-$arr['tqsydzsl'];
    $arr['tqbfbcz'] =($bya-$sya)."%";
		
		$this->main_menu='欢迎界面';
		$this->son_menu='';
	//dump($info_count);	
		$this->assign('info_count',$info_count);
		$this->assign('arr',$arr);
		$this->display();
		
		}
		
		
		if(session('m_id')==2 || session('m_id')==3){
		$this->redirect('Index/right');
		}	
		if(session('m_id')==4){
		$this->redirect('Index/daoyi_list');
		
		}


		if(session('m_id') >= 5){
		$this->redirect('Index/calls');
		
		}
		}
		
	/******************************************************************************【】  简报页面  【】***************************************************************************/	
		
	/**
	 * 欢迎页面简报详情
	 */
	public function jianbao(){
		if(IS_GET){ 
			$sql = getJianSqls(I('get.info'),'sql');  //获取相关sql
			$count =M('Kefuinfo')->where($sql)->count();//总记录数 
			$Page = new \Think\Page($count,C('PAGENUM'));
			$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
			$Page->rollPage =C('ROLLPAGE');
			$show= $Page->show();		
			
			$queryinfo =M('Kefuinfo')->where($sql)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select(); 
	    $str = D('Index')->getDatas($queryinfo);  //处理数组
           
      $this->assign('info',I('get.info'));
			$this->assign('xqlist',$str);
			$this->assign('mess',getJianSqls(I('get.info'),'text'));
			$this->assign('count',$count);
			$this->assign('page',$show);
			$this->main_menu='登记预约';
			$this->son_menu='简报详情';
            if(session('m_id')!=4){
	             $this->display();
	        }else{
			   echo "<script type='text/javascript'>alert('你无权查看查看此页面！');history.go(-1);</script>";
			}
		}else{
	         echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
		}
	}
	
 /**
	 * 简报信息ajax搜索
	 */
		public function jianbao_search_ajax(){ 
				if(IS_POST){
						$quanxian     = session( 'm_id');
						$page         = intval(I('post.pageNum')); //当前页       
						$pageSize     =C('PAGESIZE'); //每页显示数 
						$str          = 1;
						$str_1        = $str;
						$data = SetData(I('post.data'));
						
						$data['diqu']    = $_POST['diqu']; //地区
						$data['web']     = $_POST['web']; //来源网站
						$data['zixun']   = $_POST['zixun']; //咨询方式
						$data['yingxiao']= $_POST['yingxiao']; //营销方式   
						$data['qudaos']  = $_POST['qudaos']; //渠道信息
				    
				    $str .= D('Index')->GetSql($data); //根据搜索参数条件，获取sql语句
            $str .= getJianSqls($data['info'],'sql2');   // 预约时间time
						$total= intval(M('Kefuinfo')->where($str)->count()); //记录总数
				    $arr['total']     = $total;
						if($total>0){
								$totalPage          = ceil($total / $pageSize ); //总页数 
								$startPage          = $page * $pageSize; //开始记录 
						
								$arr['pageSize']  = $pageSize;
								$arr['totalPage'] = $totalPage;
								$arr['quanxian']  = $quanxian;
								$arr['success']=1; 
						    $query = M('Kefuinfo')->where($str)->order($data['orderby']." ".$data['orderway'])->limit($startPage . ',' . $pageSize)->select();
				        $arr['list'] = D('Index')->getDatas($query);
		        }else{
				      	$arr['success']=0; 
					  }
	          echo json_encode($arr);
				}else{
				    echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
				}
    }		
		
		public function ajax_monthgoal_charts(){
		
		if(IS_POST){
		//计算出3个月月份
		$benyuedate=date('Y-m',C('MONTH_START'));
		$shangyuedate=date('Y-m',C('LASTMONTH_START'));
		$sshangyuedate=date('Y-m',C('PRELASTMONTH_START'));
		
		//计算出3个月的目标值	
		$byinfo=M('Monthgoal')->where(array('yuefen'=>date('Y-m',C('MONTH_START'))))->find();
		$syinfo=M('Monthgoal')->where(array('yuefen'=>date('Y-m',C('LASTMONTH_START'))))->find();
		$ssyinfo=M('Monthgoal')->where(array('yuefen'=>date('Y-m',C('PRELASTMONTH_START'))))->find();
		
		$goalby=intval($byinfo['goalnum']);
		$goalsy=intval($syinfo['goalnum']);
		$goalssy=intval($ssyinfo['goalnum']);
		
		//计算出3个月已经到院数量值
		
		$where_bysd=array('isorder'=>1,'laiyuan_time' =>array(array('EGT',C('MONTH_START')),array('ELT',C('MONTH_END'))),'laiyuan'=>'是');//本月到院
		$where_sysd=array('isorder'=>1,'laiyuan_time' =>array(array('EGT',C('LASTMONTH_START')),array('ELT',C('LASTMONTH_END'))),'laiyuan'=>'是');//本月到院
		$where_ssysd=array('isorder'=>1,'laiyuan_time' =>array(array('EGT',C('PRELASTMONTH_START')),array('ELT',C('PRELASTMONTH_END'))),'laiyuan'=>'是');//本月到院
		
		$byydnum=intval(M('Kefuinfo')->where($where_bysd)->count());	
		$syydnum=intval(M('Kefuinfo')->where($where_sysd)->count());	
		$ssyydnum=intval(M('Kefuinfo')->where($where_ssysd)->count());	

		//计算出3个月预约数量值
		
		$where_byyy=array('isorder'=>1,'in_time' =>array(array('EGT',C('MONTH_START')),array('ELT',C('MONTH_END'))));//本月到院
		$where_syyy=array('isorder'=>1,'in_time' =>array(array('EGT',C('LASTMONTH_START')),array('ELT',C('LASTMONTH_END'))));//本月到院
		$where_ssyyy=array('isorder'=>1,'in_time' =>array(array('EGT',C('PRELASTMONTH_START')),array('ELT',C('PRELASTMONTH_END'))));//本月到院
		
		
		$bywdnum=intval(M('Kefuinfo')->where($where_byyy)->count());
		$sywdnum=intval(M('Kefuinfo')->where($where_syyy)->count());		
		$ssywdnum=intval(M('Kefuinfo')->where($where_ssyyy)->count());
		$result =array('benyuedate'=>$benyuedate,'shangyuedate'=> $shangyuedate,'sshangyuedate'=>$sshangyuedate,'bywdnum'=>$bywdnum,'byydnum'=>$byydnum,'sywdnum'=>$sywdnum,'syydnum'=>$syydnum,'ssywdnum'=>$ssywdnum,'ssyydnum'=>$ssyydnum,'goalby'=>$goalby,'goalsy'=>$goalsy,'goalssy'=>$goalssy);
		echo json_encode($result);	
		
		}else{
				
				
		echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
				
				
				}
		}
        //欢迎页面咨询到院排行榜
		
		public function zxdy_ajaxlist(){
			
			if(IS_POST){
		
		$zxdyrq=I('post.riqi');
		
		if($zxdyrq==''){
		$zxdyrq='zxdy_zt';
		}
		
		if($zxdyrq=='zxdy_zt'){
		
		$zxdywhere1=array('isorder'=>1,'in_time'=>array(array('EGT',C('YESTERDAY_START')),array('ELT',C('YESTERDAY_END'))));
		
		$zxdywhere2=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('YESTERDAY_START')),array('ELT',C('YESTERDAY_END'))));
		
		$zxdywhere3=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('YESTERDAY_START')),array('ELT',C('YESTERDAY_END'))));
		
		
		}
		
		
		
		if($zxdyrq=='zxdy_ssy'){
		
		$zxdywhere1=array('isorder'=>1,'in_time'=>array(array('EGT',C('PRELASTMONTH_START')),array('ELT',C('PRELASTMONTH_END'))));
		
		$zxdywhere2=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('PRELASTMONTH_START')),array('ELT',C('PRELASTMONTH_END'))));
		
		$zxdywhere3=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('PRELASTMONTH_START')),array('ELT',C('PRELASTMONTH_END'))));
		
		
		}
		
		if($zxdyrq=='zxdy_sy'){
		
		$zxdywhere1=array('isorder'=>1,'in_time'=>array(array('EGT',C('LASTMONTH_START')),array('ELT',C('LASTMONTH_END'))));
		
		$zxdywhere2=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('LASTMONTH_START')),array('ELT',C('LASTMONTH_END'))));
		
		$zxdywhere3=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('LASTMONTH_START')),array('ELT',C('LASTMONTH_END'))));
		
		
		}
		
		
		if($zxdyrq=='zxdy_by'){
		
		$zxdywhere1=array('isorder'=>1,'in_time'=>array(array('EGT',C('MONTH_START')),array('ELT',C('MONTH_END'))));
		
		$zxdywhere2=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('MONTH_START')),array('ELT',C('MONTH_END'))));
		
		$zxdywhere3=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('MONTH_START')),array('ELT',C('MONTH_END'))));
		
		
		}
		
		
		
		if($zxdyrq=='zxdy_sz'){
		
		$zxdywhere1=array('isorder'=>1,'in_time'=>array(array('EGT',C('LASTWEEK_START')),array('ELT',C('LASTWEEK_END'))));
		
		$zxdywhere2=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('LASTWEEK_START')),array('ELT',C('LASTWEEK_END'))));
		
		$zxdywhere3=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('LASTWEEK_START')),array('ELT',C('LASTWEEK_END'))));
		
		
		}
		
		
		
		
		if($zxdyrq=='zxdy_jt'){
		
		$zxdywhere1=array('isorder'=>1,'in_time'=>array(array('EGT',C('TODAY_START')),array('ELT',C('TODAY_END'))));
		$zxdywhere2=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('TODAY_START')),array('ELT',C('TODAY_END'))));
		$zxdywhere3=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('TODAY_START')),array('ELT',C('TODAY_END'))));
		
		
		}	
		
		
		$posts=M('User')->where(array('m_id'=>array('IN',array(2,3,5))))->select();
		
		foreach($posts as $key=>$_v){
		$zxdywhere1['type_in']=$_v['name'];
		$zxdywhere2['type_in']=$_v['name'];
		$yuyuenum=M('Kefuinfo')->where($zxdywhere1)->count();	
		$laiyuannum=M('Kefuinfo')->where($zxdywhere2)->count();
		$total=M('Kefuinfo')->where($zxdywhere3)->count();
		$zxl=$laiyuannum/$total; 
		$a= round($zxl,2)*100;
		$bfbs= $a ."%";
		
		$zxdyarrs['list'][] =array(
		'id'=>$_v['id'],
		'name'=>$_v['name'],
		'yynum'=>$yuyuenum,
		'lynum'=>$laiyuannum,
		'totals'=>$total,
		'bfb'=>$bfbs,
		);
		
		}
		echo json_encode($zxdyarrs);
		
		}else{
				
				
		echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
				
				
				}
	
	}
		
		
		//欢迎页面渠道信息排行榜
		
		public function qdxx_ajaxlist(){
			
			if(IS_POST){
		
		$qdphrq=I('post.riqi');
		
		
		if($qdphrq==''){
		$qdphrq='qdxx_zt';
		}
		
		if($qdphrq=='qdxx_zt'){
		
		$qdphwhere1=array('isorder'=>1,'in_time'=>array(array('EGT',C('YESTERDAY_START')),array('ELT',C('YESTERDAY_END'))));
		
		$qdphwhere2=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('YESTERDAY_START')),array('ELT',C('YESTERDAY_END'))));
		
		$qdphwhere3=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('YESTERDAY_START')),array('ELT',C('YESTERDAY_END'))));
		
		
		}
		
		
		if($qdphrq=='qdxx_ssy'){
		
		$qdphwhere1=array('isorder'=>1,'in_time'=>array(array('EGT',C('PRELASTMONTH_START')),array('ELT',C('PRELASTMONTH_END'))));
		
		$qdphwhere2=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('PRELASTMONTH_START')),array('ELT',C('PRELASTMONTH_END'))));
		
		$qdphwhere3=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('PRELASTMONTH_START')),array('ELT',C('PRELASTMONTH_END'))));
		
		
		}
		
		
		
		if($qdphrq=='qdxx_sy'){
		
		$qdphwhere1=array('isorder'=>1,'in_time'=>array(array('EGT',C('LASTMONTH_START')),array('ELT',C('LASTMONTH_END'))));
		
		$qdphwhere2=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('LASTMONTH_START')),array('ELT',C('LASTMONTH_END'))));
		
		$qdphwhere3=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('LASTMONTH_START')),array('ELT',C('LASTMONTH_END'))));
		
		
		}
		
		
		if($qdphrq=='qdxx_by'){
		
		$qdphwhere1=array('isorder'=>1,'in_time'=>array(array('EGT',C('MONTH_START')),array('ELT',C('MONTH_END'))));
		
		$qdphwhere2=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('MONTH_START')),array('ELT',C('MONTH_END'))));
		
		$qdphwhere3=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('MONTH_START')),array('ELT',C('MONTH_END'))));
		
		
		}
		
		
		
		if($qdphrq=='qdxx_sz'){
		
		$qdphwhere1=array('isorder'=>1,'in_time'=>array(array('EGT',C('LASTWEEK_START')),array('ELT',C('LASTWEEK_END'))));
		
		$qdphwhere2=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('LASTWEEK_START')),array('ELT',C('LASTWEEK_END'))));
		
		$qdphwhere3=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('LASTWEEK_START')),array('ELT',C('LASTWEEK_END'))));
		
		
		}
		
		
		
		
		if($qdphrq=='qdxx_jt'){
		
		$qdphwhere1=array('isorder'=>1,'in_time'=>array(array('EGT',C('TODAY_START')),array('ELT',C('TODAY_END'))));
        
		$qdphwhere2=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('TODAY_START')),array('ELT',C('TODAY_END'))));
		
		$qdphwhere3=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('TODAY_START')),array('ELT',C('TODAY_END'))));
		
		
		}	
		
		
		$posts=M('Qudaoinfo')->select();
		
		foreach($posts as $key=>$_v){
		
		
		$qdphwhere1['info_channel']=$_v['id'];
		
		$qdphwhere2['info_channel']=$_v['id'];
		
		$yuyuenum=M('Kefuinfo')->where($qdphwhere1)->count();	
		$laiyuannum=M('Kefuinfo')->where($qdphwhere2)->count();
		$total=M('Kefuinfo')->where($qdphwhere3)->count();
		
		$zxl=$laiyuannum/$total; 
		$a= round($zxl,2)*100;
		$bfbs= $a ."%";
		
		$qdpharrs['list'][] =array(
		'id'=>$_v['id'],
		'name'=>$_v['info_name'],
		'yynum'=>$yuyuenum,
		'lynum'=>$laiyuannum,
		'totals'=>$total,
		'bfb'=>$bfbs,
		);
		
		}
		echo json_encode($qdpharrs);
		
		}else{
				
				
		echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
				
				
				}
		
		
		
	}	
		
		//欢迎页面来源网站排行榜
		
		public function lywz_ajaxlist(){
			
			if(IS_POST){
		
		$lywzphrq=I('post.riqi');
		
		
		if($lywzphrq==''){
		$lywzphrq='lywz_zt';
		}
		
		if($lywzphrq=='lywz_zt'){
		
		$lywzphwhere1=array('isorder'=>1,'in_time'=>array(array('EGT',C('YESTERDAY_START')),array('ELT',C('YESTERDAY_END'))));
		
		$lywzphwhere2=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('YESTERDAY_START')),array('ELT',C('YESTERDAY_END'))));
		
		$lywzphwhere3=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('YESTERDAY_START')),array('ELT',C('YESTERDAY_END'))));
		
		
		}
		
		
		if($lywzphrq=='lywz_ssy'){
		
		$lywzphwhere1=array('isorder'=>1,'in_time'=>array(array('EGT',C('PRELASTMONTH_START')),array('ELT',C('PRELASTMONTH_END'))));
		
		$lywzphwhere2=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('PRELASTMONTH_START')),array('ELT',C('PRELASTMONTH_END'))));
		
		$lywzphwhere3=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('PRELASTMONTH_START')),array('ELT',C('PRELASTMONTH_END'))));
		
		
		}
		
		
		if($lywzphrq=='lywz_sy'){
		
		$lywzphwhere1=array('isorder'=>1,'in_time'=>array(array('EGT',C('LASTMONTH_START')),array('ELT',C('LASTMONTH_END'))));
		
		$lywzphwhere2=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('LASTMONTH_START')),array('ELT',C('LASTMONTH_END'))));
		
		$lywzphwhere3=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('LASTMONTH_START')),array('ELT',C('LASTMONTH_END'))));
		
		
		}
		
		
		if($lywzphrq=='lywz_by'){
		
		$lywzphwhere1=array('isorder'=>1,'in_time'=>array(array('EGT',C('MONTH_START')),array('ELT',C('MONTH_END'))));
		
		$lywzphwhere2=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('MONTH_START')),array('ELT',C('MONTH_END'))));
		
		$lywzphwhere3=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('MONTH_START')),array('ELT',C('MONTH_END'))));
		
		
		}
		
		
		
		if($lywzphrq=='lywz_sz'){
		
		$lywzphwhere1=array('isorder'=>1,'in_time'=>array(array('EGT',C('LASTWEEK_START')),array('ELT',C('LASTWEEK_END'))));
		
		$lywzphwhere2=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('LASTWEEK_START')),array('ELT',C('LASTWEEK_END'))));
		
		$lywzphwhere3=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('LASTWEEK_START')),array('ELT',C('LASTWEEK_END'))));
		
		
		}
		
		
		
		
		if($lywzphrq=='lywz_jt'){
		
		$lywzphwhere1=array('isorder'=>1,'in_time'=>array(array('EGT',C('TODAY_START')),array('ELT',C('TODAY_END'))));
		$lywzphwhere2=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('TODAY_START')),array('ELT',C('TODAY_END'))));
		
		$lywzphwhere3=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',C('TODAY_START')),array('ELT',C('TODAY_END'))));
		
		
		}	
		
		
		$posts=M('Web')->select();
		
		foreach($posts as $key=>$_v){
		
		
		$lywzphwhere1['source_web']=$_v['id'];
		$lywzphwhere2['source_web']=$_v['id'];
		$yuyuenum=M('Kefuinfo')->where($lywzphwhere1)->count();	
		$laiyuannum=M('Kefuinfo')->where($lywzphwhere2)->count();
		$total=M('Kefuinfo')->where($lywzphwhere3)->count();
		
		$zxl=$laiyuannum/$total; 
		$a= round($zxl,2)*100;
		$bfbs= $a ."%";
		
		$lywzpharrs['list'][] =array(
		'id'=>$_v['id'],
		'name'=>$_v['web_name'],
		'yynum'=>$yuyuenum,
		'lynum'=>$laiyuannum,
		'totals'=>$total,
		'bfb'=>$bfbs,
		);
		
		}
		echo json_encode($lywzpharrs);
		
		}else{
				
				
		echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
				
				
				}
				
				}
		
		
		
		//欢迎页面季度曲线图
		public function ajax_jiduchart(){
			
			if(IS_POST){
		
		$jdrq=I('post.riqi');
		
		
		if($jdrq==''){
		$jdrq='jd_by';
		}
		
		if($jdrq=='jd_ssy'){        
		$dystart=C('PRELASTMONTH_START');	  
		$dyend=C('PRELASTMONTH_END')-86399;
		
		}
		
		if($jdrq=='jd_sy'){        
		$dystart=C('LASTMONTH_START');	  
		$dyend=C('LASTMONTH_END')-86399;
		
		}
		
		if($jdrq=='jd_by'){        
		$dystart=C('MONTH_START');	  
		$dyend=C('MONTH_END')-86399;
		
		}
		
		for($i=$dystart;$i<=$dyend;$i+=(24*3600)){	
		
		
		$riqi[]=date('d',$i);
		
		$time_date = date('Y-m-d',$i);
		
		$time_date_start=strtotime($time_date);
		
		$time_date_end=strtotime($time_date)+86399;
		
		$sql1=array('isorder'=>1,'time'=>$time_date);
		
		$sql2=array('isorder'=>1,'laiyuan'=>'是','laiyuan_time'=>array(array('EGT',$time_date_start),array('ELT',$time_date_end)));
		
		$sql3=array('isorder'=>1,'in_time'=>array(array('EGT',$time_date_start),array('ELT',$time_date_end)));
		
		$jhdynums[]=intval(M('Kefuinfo')->where($sql1)->count());
		
		$sjdynums[]=intval(M('Kefuinfo')->where($sql2)->count());
		
		$sjyynums[]=intval(M('Kefuinfo')->where($sql3)->count());
		
		
		}
		$dydate=$riqi;
		$datess=date('Y-m',$dystart);
		$results =array('datess'=>$datess,'dydate'=>$dydate,'jhdynums'=>$jhdynums,'sjdynums'=>$sjdynums,'sjyynums'=>$sjyynums);
		echo json_encode($results);	
		
		}else{
				
				
		echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
				
				
				}
				
				}
		
		//验证手机号是否重复
		
		public function yzphone_ajax(){
			if(IS_POST){
		$phone=I('post.phone');	
		
		$where=array('phone'=>$phone);
		
		$statesresult=M('Kefuinfo')->where($where)->select();
		
		
		if($statesresult){
		
		$states=1;
		
		
		}else{
		
		$states=0;	
		}
		
		
		$results =array('states'=>$states);	
		echo json_encode($results);	
		
		}else{
				
				
		echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
				
				
				}
				
				}
		
		
		//预约科室病种加载
		public function kssection_ajax(){
		if(IS_POST){
		$keshi=I('post.keshi_val');		
		$bzinfo=M('Bingzhong')->where(array('keshi_id'=>$keshi))->select();	
		
		$bzlist =array('list'=>$bzinfo);
		
		echo json_encode($bzlist);	
		
		
		}else{
				
				
		echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
				
				
				}
				
				}	
		


		
		//预约信息添加
		
	public function add(){
            $keshilist=M('Section')->select();
            $arealist=M('Area')->select();
            $consultlist=M('Consult')->select();
            $qudaoinfolist=M('Qudaoinfo')->select();
            $yingxiaolist=M('Yingxiao')->select();
            $weblist=M('Web')->select();
            $this->assign('keshilist',$keshilist);
            $this->assign('arealist',$arealist);
            $this->assign('consultlist',$consultlist);
            $this->assign('qudaoinfolist',$qudaoinfolist);
            $this->assign('yingxiaolist',$yingxiaolist);
            $this->assign('weblist',$weblist);
            $this->assign('m_id',session('m_id'));
            $this->main_menu='登记预约';
            $this->son_menu='添加信息';
            if(session('m_id')!=4){	
            $this->display();
            }else{
                echo "<script type='text/javascript'>alert('你无权查看查看此页面！');history.go(-1);</script>";
            }
        }
		
		
		
	public function add_ajax(){
            if(IS_POST){
		$keshi=M('Section')->where(array('id'=>I('post.keshi')))->find();
		
		$area=M('Area')->where(array('id'=>I('post.area')))->find();
		
		$bingzhong=M('Bingzhong')->where(array('id'=>I('post.bingzhong')))->find();
		
		$consult=M('Consult')->where(array('id'=>I('post.consult')))->find();
		
		$yingxiao=M('Yingxiao')->where(array('id'=>I('post.marketing')))->find();
		
		$data['username']=I('post.username');
		
		$data['phone']=I('post.phone');
		
		$data['sex']=I('post.sex');
		$data['age']=I('post.age');
		$data['qq']=I('post.qq');
		
		$data['keshi']=$keshi['section_name'];
		
		$data['bingzhong']=$bingzhong['bingzhong_name'];
		
		$data['area']=$area['area_name'];
		
		$data['consult']=$consult['consult_name'];
		
		$data['remark']=I('post.remark');
		
		
		$data['bingzheng']=I('post.bingzheng');
		
		$data['info_channel']=I('post.info_channel');
		$data['marketing']=$yingxiao['yingxiao_name'];
		
		$data['keyword'] =I('post.keyword');
		$data['type_in'] =I('post.type_in');
		$data['source_web'] =I('post.source_web');
		$data['isorder'] =I('post.isorder');

		$data['in_time'] =time();
		
		$data['time'] =I('post.time');
		
		$data['source_url']=I('post.source_url');
		
		$data['identitys']=I('post.identitys');
		
		$data['qudao_group_id'] =$consult['qudao_group_name'];
		$data['laiyuan'] = "否";
		
		$data['huifang'] = "否";
		
		$data['doctor']= "--";
		$lastidinfo= M('Kefuinfo')->order('id desc')->limit(1)->find();
		
		$lastid=intval($lastidinfo['id']);
		
		$con= intval(M('Kefuinfo')->count());
		
		$nums=519948;
		
		if($lastid<=$nums)
		{
		if($con==0)
		{
		$b="";
		$num=1;
		$tag=floor(($num-1)/9999);
		$part1=65+$tag;
		$part2=$num-9999*$tag;
		$a=strlen($part2);
		for($i=0;$i<(4-$a);$i++)
		{
		$b.=0;
		}
		$str=chr($part1).$b.$part2;
		
		}else{
		$b="";
		$num=$lastid+1;
		$tag=floor(($num-1)/9999);
		$part1=69+$tag;
		$part2=$num-9999*$tag;
		$a=strlen($part2);
		for($i=0;$i<(4-$a);$i++)
		{
		$b.=0;
		}
		$str=chr($part1).$b.$part2;
		
		}
		}elseif($nums<$lastid){
		$num=$lastid-$nums+1;
		$tag=floor(($num-1)/9999);
		$part1=97+$tag;
		$part2=$num-9999*$tag;
		$a=strlen($part2);
		for($i=0;$i<(4-$a);$i++)
		{
		$b.=0;
		}
		$str=chr($part1).$b.$part2;
		
		}
		
		$data['yuyue'] =$str;
		
		
		if(M('Kefuinfo')->add($data)){
	    $user = A("Home/Api");
        $result = $user->message($data['username'],$data['yuyue'],$data['time'],$data['phone']);//发送短信	
		$sj['actions']="添加预约信息-预约号：[".$str."]成功！"; 
		$sj['ip_id']=$_SERVER['REMOTE_ADDR'];
		$sj['times']=time();
		$sj['action_name']=session('username');
		M('Operation')->add($sj);	
		
		
		$state=1;
		
		if(session('m_id')==5){
		$dumpurl='calls';
		}else{
			
			$dumpurl='dengji';
			
			
			}
		
		}else{
		
		$state=0;
		};
		
            $result = array('state' => $state,'dumpurl'=>$dumpurl);  
              echo json_encode($result);
            }else{
		echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
            }
        }	
		/**
		 * 预约信息删除
		 */
		public function del(){
				 if(session('m_id')<4){
						  $id = I('post.id')?I('post.id'):$_GET['id'];
						  $data=M('Kefuinfo')->where(array('id'=>$id))->find();
					    $delinfo=M('Kefuinfo')->where(array('id'=>$id))->delete();
							if($delinfo){
					        $posts = M('Deleteinfo')->add($data);
									$sjss['actions']="删除客户信息-预约号：[".$data['yuyue']."]到回收站成功！";
									$sjss['ip_id']=$_SERVER['REMOTE_ADDR'];
									$sjss['times']=time();
									$sjss['action_name']=session('username');
									M('Operation')->add($sjss);	
									$this->success('删除成功');
					    }else{
								  $this->error('修改失败');
							}
				}else{
				    echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
				}
	  }	
		

		
//		//预约信息删除
//		public function yydel_ajax(){
//		
//		 if(IS_POST && session('m_id')<4){
//		$id = I('post.rel');
//		$ljinfo=M('Kefuinfo')->where(array('id'=>$id))->find();
//		$data['id']=$ljinfo['id'];
//		$data['yuyue']= $ljinfo['yuyue'];//预约号
//		$data['laiyuan']= $ljinfo['laiyuan'];//来院
//		$data['huifang']= $ljinfo['huifang'];//回访
//		$data['doctor']= $ljinfo['doctor'];//医生
//		$data['area']= $ljinfo['area'];//地区
//		$data['username']=$ljinfo['username'];//客户
//		$data['sex']=$ljinfo['sex'];//性别
//		$data['age']=$ljinfo['age'];//年龄
//		$data['phone']=$ljinfo['phone'];//电话
//		$data['qq']=$ljinfo['qq'];//QQ
//		$data['keshi']=$ljinfo['keshi'];//科室      
//		$data['bingzhong']=$ljinfo['bingzhong'];//病种
//		$data['bingzheng']=$ljinfo['bingzheng'];//病症
//		$data['remark']=$ljinfo['remark'];//备注
//		$data['consult']=$ljinfo['consult'];//咨询方式   
//		$data['qudao_group_id']=$ljinfo['qudao_group_id'];
//		$data['info_channel']=$ljinfo['info_channel'];//渠道信息
//		$data['marketing']=$ljinfo['marketing'];//营销方式
//		$data['source_web']=$ljinfo['source_web'];//来源网站
//		$data['source_url']=$ljinfo['source_url'];//来源网址
//		$data['keyword']=$ljinfo['keyword'];//关键词
//		$data['type_in']=$ljinfo['type_in'];//录入者
//		$data['time']=$ljinfo['time'];//预约时间
//		$data['in_time']= $ljinfo['in_time'];
//		$data['laiyuan_time']= $ljinfo['laiyuan_time'];
//		$data['qudao_group_id']= $ljinfo['qudao_group_id'];
//		$data['isorder']= $ljinfo['isorder'];
//		$data['identitys']= $ljinfo['identitys'];
//		$data['huifang_time']= $ljinfo['huifang_time'];
//	    $delinfo=M('Kefuinfo')->where(array('id'=>$id))->delete();
//		if($delinfo){
//		$state = 1;
//      $posts = M('Deleteinfo')->add($data);
//		$sjss['actions']="删除客户信息-预约号：[".$ljinfo['yuyue']."]到回收站成功！";
//		$sjss['ip_id']=$_SERVER['REMOTE_ADDR'];
//		$sjss['times']=time();
//		$sjss['action_name']=session('username');
//		M('Operation')->add($sjss);	
//          }else{
//				
//			$state =0;	
//			
//				}
//				
//		 $result = array('state' =>$state);
//        echo json_encode($result);
//
//
//		
//		}else{
//				
//				
//		echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
//				
//				
//				}
//				
//				}	
//		
		
		//登记信息列表（搜索部分代码居多）
		public function dengji()
		{
			$this->redirect('Index/right');
		// $zxylist = M('User')->where(array('m_id' => array('IN',array(2,3))))->select();
		// $huifanglist           = M('Callback')->select();
		// $keshilist             = M('Section')->select();
		// $arealist              = M('Area')->select();
		// $consultlist           = M('Consult')->select();
		// $qudaoinfolist         = M('Qudaoinfo')->select();
		// $yingxiaolist          = M('Yingxiao')->select();
		// $weblist               = M('Web')->select();
		// $doctorsectionlist     = M('Doctorsection')->select();
		// $where_mrdz            = array('time' => array('EQ',date( 'Y-m-d', C('TOMORROW_START'))),'laiyuan' =>'否'); //明日待诊
		// $arr['tomorrow_dz']  = M('Kefuinfo')->where($where_mrdz )->count();
		// $where_jryy            = array('in_time' => array(array('EGT',C('TODAY_START')),array('ELT',C('TODAY_END')))); //今日预约
		// $where_jrsd            = array('laiyuan_time' => array(array('EGT',C('TODAY_START')), array('ELT',C('TODAY_END'))),'laiyuan' =>'是'); //今日到院
		// $where_jrwd            = array('time' => array('EQ',date( 'Y-m-d', C('TODAY_START'))),'laiyuan' => '否'); //今日未到
		// $arr['today_yy']     = M('Kefuinfo')->where($where_jryy )->count();
		// $arr['today_dy']     = M('Kefuinfo')->where($where_jrsd )->count();
		// $arr['today_wd']     = M('Kefuinfo')->where($where_jrwd )->count();
		// $where_zryy            = array('in_time' => array(array('EGT',C('YESTERDAY_START')),array('ELT',C('YESTERDAY_END')))); //昨日预约
		// $where_zrsd            = array('laiyuan_time' => array(array('EGT',C('YESTERDAY_START')), array('ELT',C('YESTERDAY_END'))),'laiyuan' =>'是'); //昨日到院
		// $where_zrwd            = array('time' => array('EQ',date( 'Y-m-d', C('YESTERDAY_START'))),'laiyuan' => '否'); //昨日未到
		// $arr['yesterday_yy'] = M('Kefuinfo')->where($where_zryy )->count();
		// $arr['yesterday_dy'] = M('Kefuinfo')->where($where_zrsd )->count();
		// $arr['yesterday_wd'] = M('Kefuinfo')->where($where_zrwd )->count();
		// $where_byyy            = array('in_time' => array(array('EGT',C('MONTH_START')),array('ELT',C('MONTH_END')))); //本月预约
		// $where_bysd            = array('laiyuan_time' => array(array('EGT',C('MONTH_START')),array('ELT', C('MONTH_END'))),'laiyuan' =>'是'); //本月到院
		// $where_bywd            = array('time' => array(array('EGT',date( 'Y-m-d', C('MONTH_START'))),array('ELT',date( 'Y-m-d', C('MONTH_END')))),'laiyuan' =>'否'); //本月未到
		// $arr['month_yy']     = M('Kefuinfo')->where($where_byyy )->count();
		// $arr['month_dy']     = M('Kefuinfo')->where($where_bysd )->count();
		// $arr['month_wd']     = M('Kefuinfo')->where($where_bywd )->count();
		// $where_szyy            = array('in_time' => array(array('EGT',C('WEEK_START')),array('ELT',C('WEEK_END'))));
		// $where_szsd            = array('laiyuan' => '是','laiyuan_time' => array(array('EGT', C('WEEK_START')),array('ELT',C('WEEK_END'))));
		// $where_szwd           = array('time' => array(array('EGT',date( 'Y-m-d', C('WEEK_START'))),array('ELT',date( 'Y-m-d', C('WEEK_END')))),'laiyuan' =>'否');

		
		// $arr['week_yy']      = M('Kefuinfo')->where($where_szyy )->count();
		// $arr['week_dy']      = M('Kefuinfo')->where($where_szsd )->count();
		// $arr['week_wd']      = M('Kefuinfo')->where($where_szwd )->count();
		// $this->assign( 'zxylist', $zxylist );
		// $this->assign( 'huifanglist', $huifanglist );
		// $this->assign( 'keshilist', $keshilist );
		// $this->assign( 'arealist', $arealist );
		// $this->assign( 'consultlist', $consultlist );
		// $this->assign( 'qudaoinfolist', $qudaoinfolist );
		// $this->assign( 'yingxiaolist', $yingxiaolist );
		// $this->assign( 'weblist', $weblist );
		// $this->assign( 'doctorsectionlist', $doctorsectionlist );
		// $this->assign( 'arr', $arr );
		// $this->main_menu='登记预约';
  //       $this->son_menu='登记信息管理';
		
		// $this->display();
		}
		
		/**
		 * 预约信息管理列表（搜索部分代码居多）
		 */
		public function right(){
			//dump($_GET['date']);exit;
		if($_GET['date']){
            $this->assign( 'tjdate', $_GET['date']);
		}
		    $this->main_menu='登记预约';
			$this->son_menu='信息管理';
		    $this->display();
		}
		/**
		 * 信息登记管理列表ajax表格列表
		 */
		public function dengji_ajax()
		{
			if(IS_POST){
					$tjdate = I('post.tjdate');
					$hfgroup = M('User')->where(array('m_id' => array('IN',array(1,2,3))))->select();
					foreach($hfgroup as $hfv){
						 $hfname.=$hfv['name'].',';
					}
					$hfstr=substr($hfname, 0, -1);
					$strrs= explode(',', $hfstr);
					
			    if($tjdate!=''){   
						$pageSize =I('post.pageSize'); //每页显示数 
						$end = sprintf($tjdate+24*3600-1);
						$wher = array('type_in' => array('IN',$strrs),'in_time' => array(array('EGT',$tjdate),array('ELT',$end)),'isorder'=>1);
					}else{
						$pageSize =C('PAGESIZE'); //每页显示数 
						$wher = array('type_in' => array('IN',$strrs),'time' => date("Y-m-d"));
						$wh = array('type_in' => array('IN',$strrs),'in_time' => array(array('EGT',C('TODAY_START')),array('ELT',C('TODAY_END'))),'isorder'=>1);
					}
					$page= intval(I('post.pageNum')); //当前页
					$total= intval(M('Kefuinfo')->where($wher)->count()); //记录总数
					$arr = D('Index')->getClickLink(3); 
					$arr['yy']= intval(M('Kefuinfo')->where(array_merge($wher,array('isorder'=>1)))->count()); //预约记录总数
					$arr['luru']= intval(M('Kefuinfo')->where($wh)->count()); //录入记录总数
					$arr['yyshi']= intval(M('Kefuinfo')->where(array_merge($wher,array('laiyuan'=>'是','isorder'=>1)))->count()); //来院记录总数
					$arr['yyfou']= intval(M('Kefuinfo')->where(array_merge($wher,array('laiyuan'=>'否','isorder'=>1)))->count()); //未到记录总数
		
					$arr['total']     = $total;
					if($total>0){
						$totalPage          = ceil($total / $pageSize );
						$startPage          = $page * $pageSize;
						$arr['pageSize']  = $pageSize;
						$arr['totalPage'] = $totalPage;
						$arr['quanxian']  = session( 'm_id');
						$arr['success']=1;
		        if($tjdate!=''){
		        	$arr['tjdate']= date('Y-m-d',$tjdate);
		        	$map = array('type_in' =>array('in',$strrs),'isorder'=>1,'in_time' => array(array('EGT',$tjdate),array('ELT',$end)));
						}else{
							$map = array('type_in' =>array('in',$strrs),'time'=>date("Y-m-d"));
						}	
						$query=M('Kefuinfo')->where($map)->order('in_time desc')->limit($startPage.",".$pageSize)->select();
		        $arr['list']= D('Index')->getDatas($query); 
					}else{
						$arr['success']=0; 
					}
				//	dump($arr);
				  echo json_encode($arr);
			}else{
			     echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
			}
		}	
		
			
	  /**
	     * 导医列表[预约信息]*详情
	     */
		public function view(){
			$id = I('post.id')?I('post.id'):$_GET['id'];
			$v  = M('Kefuinfo')->where(array( 'id' => $id))->find();
			$str = D('Index')->getDatas(array($v));  //处理数组
			$hfhistory=$str[0]['remark']."\r\n";
	        $visitlist=M('Visit')->where(array('aid' =>$id))->order('id desc')->select();
		    foreach($visitlist as $vi){
				$time=$vi['writer'].":".date('Y-m-d H:i:s',$vi['senddate']);
				$hfhistory.=$time."&nbsp;>>&nbsp;".$vi['description']."\r\n";
			}
			$str[0]['remark'] = $hfhistory;
			$this->assign( 'quanxian', session('m_id'));
			$this->assign($str[0]);
			$this->display();
    }
    	
	/**
	 * 导医列表[预约信息]修改
	 * @return [type] [description]
	 */
	public function edit(){
		if (IS_POST){
			$data= SetData(I('post.data')); 
			//保存新添加的回访
			if(!empty($data['description']) && isset($data['description'])){
				$vdata['aid']=$data['id'];
				$res     = M('Callback')->field('id')->where(array('callback_name'=>$data['huifang']))->find(); 
				$vdata['cid']=$res['id'];
				$vdata['description']=$data['description'];
				$vdata['senddate']=time();
				$vdata['writer']=session('username');
				$data['huifang_time']=time();
				$addvisit=M('Visit')->add($vdata);
			}else{
				$addvisit=false;	
			}
			//保存修改数据
			$editkefuinfo=M('Kefuinfo')->where(array('id'=>$data['id']))->save($data);
			//将操作存入日志
			if($editkefuinfo || $addvisit){
				$state=1;
				$sjs['actions']="修改客户信息-预约号：[".$data['yuyue']."]成功！";
				$sjs['ip_id']=$_SERVER['REMOTE_ADDR'];
				$sjs['times']=time();
				$sjs['action_name']=session('username');
				M('Operation')->add($sjs);
			}else{
				   $state=0;
			}
      $result = array('state' => $state);
      echo json_encode($result);
		}else{
			$id = I('post.id')?I('post.id'):$_GET['id'];
			$v  = M('Kefuinfo')->where(array( 'id' => $id))->find();
			$str = D('Index')->getDatas(array($v));  //处理数组

			$hfhistory=$str[0]['remark']."\r\n";
	        $visitlist=M('Visit')->where(array('aid' =>$id))->order('id desc')->select();
		    foreach($visitlist as $vi){
				$time=$vi['writer'].":".date('Y-m-d H:i:s',$vi['senddate']);
				$hfhistory.=$time."&nbsp;>>&nbsp;".$vi['description']."\r\n";
			}
			$st     = M('Section')->field('id')->where(array('section_name'=>$str[0]['keshi']))->find(); 
			$bzlist     = M('bingzhong')->where('keshi_id='.$st['id'])->select(); 
			$str[0]['remark'] = $hfhistory;
			$this->assign($str[0]);
			$this->assign( 'quanxian', session('m_id'));
			$this->assign( 'bzlist', $bzlist);
			$this->display();
		}
	}
	
	

		
		
		
	
		
		
		// 预约信息ajax搜索
		public function dengji_search_ajax()
		{ 
		if(IS_POST){
			$page         = intval(I('post.pageNum')); //当前页       
			$pageSize     =C('PAGESIZE'); //每页显示数 
			$str          = 1;
			$str_1        = $str;
			$formtype = I( 'post.formtype');  //搜索类型
			$data= D('Index')->SetData(I('post.data'));//  dump($formtype);  dump($data);  die;
			if ($formtype=='short') {
			   $str_1 = $str .= D('Index')->getmohuSql($data);  //处理数组
			   	if($data['tjdate'] !=''){
			   		$rq = date('Y-m-d',$data['tjdate']);
			   		$start = strtotime($rq." 00:00:00");
			   		$end = strtotime($rq." 23:59:59");
					$str_1 = $str .= " && in_time >= '".$start."' && in_time <= '".$end."'";
				}
			} else if($formtype=='long'){
				 $str_1 = $str .= D('Index')->GetSqls($data);  //处理数组
			} else if($formtype=='click'){
				$TimeSql= D('Index')->GetTimeSql($data['date']);  //dump($TimeSql);  
				$str_1 = $str .=$TimeSql['sql'];
				$str2 =$str_1.$TimeSql['sql2'];
				$arr = D('Index')->getClickLink($data['date']);
				$arr2 = D('Index')->getClickNum($str_1,$str2);
				$arr = array_merge($arr,$arr2);
			}
			$data['orderby'] = $data['orderby']? $data['orderby']:I( 'post.orderby');
			$data['orderway'] = $data['orderway']? $data['orderway']:I( 'post.orderway');
//dump($str_1);
		$total= intval(M('Kefuinfo')->where($str_1)->count()); //记录总数
	// 	dump($total);
 // dump(M('Kefuinfo')->where($str_1)->fetchSql(true)->count());
        $arr['total']     = $total;
		
		//dump($arr);
		if($total>0){
				$totalPage          = ceil($total / $pageSize ); //总页数 
				$startPage          = $page * $pageSize; //开始记录 
		
				$arr['pageSize']  = $pageSize;
				$arr['totalPage'] = $totalPage;
				$arr['quanxian']  = $quanxian;
				$arr['success']=1; 
				$query = M('Kefuinfo')->where($str_1)->order($data['orderby']." ".$data['orderway'])->limit($startPage . ',' . $pageSize)->select();
        $arr['list']= D('Index')->getDatas($query);  //处理数组
     //   dump($arr);
        if($tjdate !=''){
         	$arr['tjdate']  = date('Y-m-d',$tjdate);

        }
    }else{
			$arr['success']=0; 
		}
	//	dump($arr);
	  echo json_encode($arr);
		}else{
		echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
	  }
		
		
		
		
		
}		
		

		

		
		public function isorder_ajax(){
			
			if(IS_POST){
			$isorder=I('post.isorder');
			$isorderid=I('post.isorderid');
			$data['isorder'] =1;
			
			if($isorder==0){
				$result=M('Kefuinfo')->where(array('id'=>$isorderid))->save($data);
				if($result){
					$states=1;
				}else{
				    $states=0;	
				}
				$results =array('states'=>$states);	
				echo json_encode($results);		
				}else{
	            	echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
				}
			}
	}	
		
		

		public function kfeditsubmit_ajax()
		{
		  
		  if(IS_POST){
		$keshi=M('Section')->where(array('id'=>I('post.keshi')))->find();
		$area=M('Area')->where(array('id'=>I('post.area')))->find();
		$bingzhong=M('Bingzhong')->where(array('id'=>I('post.bingzhong')))->find();
		$consultid=M('Consult')->where(array('id'=>I('post.consult')))->find();
		$marketingid=M('Yingxiao')->where(array('id'=>I('post.marketing')))->find();
		$callbackid=M('Callback')->where(array('id'=>I('post.huifang')))->find();
		if($m_id==4){
			
			$data['username']=I('post.username');
			
			}else{
		$data['yuyue']=I('post.yuyue');
		$data['username']=I('post.username');
		$data['phone']=I('post.phone');
		$data['sex']=I('post.sex');
		$data['age']=I('post.age',0);
		$data['qq']=I('post.qq');
	    $data['keshi']=$keshi['section_name'];
		$data['bingzhong']=$bingzhong['bingzhong_name'];
		$data['area']=$area['area_name'];
		$data['consult']=$consultid['consult_name'];
		$data['marketing']=$marketingid['yingxiao_name'];
		$data['bingzheng']=I('post.bingzheng');
		$data['huifang'] =$callbackid['callback_name'];
		$data['info_channel']=I('post.info_channel');
		$data['keyword'] =I('post.keyword');
		$data['type_in'] =I('post.type_in');
		$data['source_web'] =I('post.source_web');
		$data['time'] =I('post.time');
		$data['isorder'] =I('post.isorder');
	    $data['identitys']=I('post.identitys');
		$data['source_url']=I('post.source_url');
		$vdata['aid']=I('post.yyid');
		$vdata['cid']=I('post.huifang');
		$vdata['description']=I('post.description');
		$vdata['senddate']=time();
		$vdata['writer']=session('username');
			}
			
		if(!empty($vdata['description']) && isset($vdata['description'])){
			$data['huifang_time']=time();
			$addvisit=M('Visit')->add($vdata);
			}else{
			$addvisit=false;	
				
				}

		$editkefuinfo=M('Kefuinfo')->where(array('id'=>I('post.yyid')))->save($data);
		if($editkefuinfo || $addvisit){
		$state=1;
		$sjs['actions']="修改客户信息-预约号：[".I('post.yuyue')."]成功！";
		$sjs['ip_id']=$_SERVER['REMOTE_ADDR'];
		$sjs['times']=time();
		$sjs['action_name']=session('username');
		M('Operation')->add($sjs);
			}else{
			   $state=0;
				
				}

         $result = array('state' => $state);
         echo json_encode($result);
    




}else{
				
				
		echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
				
				
				}
                
                }

	
		//预约信息导出界面
		public function export(){

		$zxylist=M('User')->where(array('m_id'=>array('IN',array(2,3))))->select();

		$huifanglist=M('Callback')->select();
		
		$keshilist=M('Section')->select();
		
		$arealist=M('Area')->select();
		
		$consultlist=M('Consult')->select();
		
		$qudaoinfolist=M('Qudaoinfo')->select();
		$yingxiaolist=M('Yingxiao')->select();
		$weblist=M('Web')->select();
		$doctorsectionlist=M('Doctorsection')->select();
		$this->assign('zxylist',$zxylist);
		$this->assign('huifanglist',$huifanglist);
		$this->assign('keshilist',$keshilist);
		$this->assign('arealist',$arealist);
		
		$this->assign('consultlist',$consultlist);
		
		$this->assign('qudaoinfolist',$qudaoinfolist);
		$this->assign('yingxiaolist',$yingxiaolist);
		$this->assign('weblist',$weblist);
		
		$this->assign('doctorsectionlist',$doctorsectionlist);
		
		
		$this->main_menu='登记预约';
        $this->son_menu='导出报表';
		if(session('m_id')==1 || session('m_id')==2){
		$this->display();
		}else{
			
			
			
			echo "<script type='text/javascript'>alert('你无权查看查看此页面！');history.go(-1);</script>";
			
			
			}
		
		}
		//验证下载密码
		
		public function downpwd_ajax(){
			if(IS_POST){
		$downpwdinfo=M('Downpwd')->where(array('downpwd'=>I('post.downcode')))->select();
		if($downpwdinfo){
		$state=1;
			}else{
			   $state=0;
				
				}

         $result = array('state' => $state);
         echo json_encode($result);

		}else{
				
				
		echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
				
				
				}
                
                }
		
		
		
		//预约信息导出
		
		public function daochu(){
			
			if(IS_POST){
		
		$yuyue = I('post.yuyue');//预约号
		$username =I('post.username') ;//姓名
		$phone = I('post.phone');//电话
		$keshi = I('post.keshi');//科室
		$isorder = I('post.isorder');//是否预约
		$laiyuan = I('post.laiyuan');//来院与否
		$chakan =I('post.zxylist') ;//查看
		$qq = I('post.qq');//qq
		$huifang =I('post.huifang') ;//回访
		$in_time = I('post.type_in_strat');//录入时间
		$end_time = I('post.type_in_end');//结束录入时间
		$laiyuan_star = I('post.laiyuan_strat');//来院时间
		$laiyuan_end = I('post.laiyuan_end');//结束来院时间
		$yuyue_time = I('post.yuyue_strat');//预约时间
		$end_yuyue =I('post.yuyue_end') ;//结束预约时间
		$diqumultiple =I('post.selectLocation_1') ;//地区多选
		$zixunmultiple =I('post.selectInformationChannel_1') ;//咨询方式多选
		$qudaosmultiple =I('post.selectConsultMethod_1') ;//渠道多选
		$yingxiaomultiple =I('post.selectMarketingMethod_1') ;//营销多选
		$webmultiple =I('post.selectWebSite_1') ;//来源网站多选
		
		$str = 1;
		$str_1 = $str;
		//判断预约号是否为空
		if($yuyue!='')
		$str_1 = $str.="&&yuyue like'%$yuyue%'";
		//判断用户名是否为空
		if($username!='')
		$str_1 = $str.="&&username like'%$username%'";
		//判断电话是否为空
		if($phone!='')
		$str_1 = $str.="&&phone like '%$phone%'";
		//判断录入时间是否为空
		if($in_time!=''||$end_time!='')
		{         
		if($in_time!=''&& $end_time!='')
		{
		date_default_timezone_set("PRC");  
		$date=strtotime($end_time);
		$time_in = date('Y-m-d',$date + 1*24*60*60); 
		$str_1 = $str.="&&in_time>=UNIX_TIMESTAMP('$in_time')&&in_time<=UNIX_TIMESTAMP('$time_in')"; 
		}elseif($in_time!='')
		{
		date_default_timezone_set("PRC");   
		$date_end =   date("Y-m-d H:i:s");
		$date=strtotime($in_time);
		$time_in = date('Y-m-d',$date + 1*24*60*60); 
		$str_1 = $str.="&&in_time>=UNIX_TIMESTAMP('$in_time')&&in_time<=UNIX_TIMESTAMP('$date_end')"; 
		}
		}
		//判断预约时间是否为空
		if($yuyue_time!=''||$end_yuyue!='')
		{
		if($yuyue_time!=''&&$end_yuyue!='')
		{
		date_default_timezone_set("PRC");  
		$date=strtotime($end_yuyue);
		$time_in = date('Y-m-d',$date + 1*24*60*60); 
		$str_1 = $str.="&&time>='$yuyue_time'&&time<='$end_yuyue'";
		}
		else if($yuyue_time!='')
		{
		date_default_timezone_set("PRC");   
		$date_end =   date("Y-m-d ");
		$str_1 = $str.="&&time>='$yuyue_time'";
		}
		
		}
		//判断来院时间
		if($laiyuan_star!=''||$laiyuan_end!='')
		{         
		if($laiyuan_star!=''&&$laiyuan_end!='')
		{
		date_default_timezone_set("PRC");  
		$date=strtotime($laiyuan_end);
		$time_in = date('Y-m-d',$date + 1*24*60*60); 
		$str_1 = $str.="&&laiyuan_time>=UNIX_TIMESTAMP('$laiyuan_star')&&laiyuan_time<=UNIX_TIMESTAMP('$time_in')"; 
		}elseif($laiyuan_star!='')
		{
		date_default_timezone_set("PRC");   
		$date_end =   date("Y-m-d H:i:s");
		$date=strtotime($laiyuan_star);
		$time_in = date('Y-m-d',$date + 1*24*60*60); 
		$str_1 = $str.="&&laiyuan_time>=UNIX_TIMESTAMP('$laiyuan_star')&&laiyuan_time<=UNIX_TIMESTAMP('$date_end')"; 
		}
		}
		//判断科室是否为空
		if($keshi!=0)
		{
		$Sectioninfo= M('Section')->where(array('id'=>$keshi))->find();
		$keshi_name ="keshi='".$Sectioninfo['section_name']."'";
		
		$str_1 = $str.="&&($keshi_name)";
		}

		//判断来院是否为空
		if($laiyuan !='-请选择-')
		$str_1 = $str.="&&laiyuan='$laiyuan'";
		//判断咨询员是否为空
		if($chakan!=0)
		{
		$Userinfo= M('User')->where(array('id'=>$chakan))->find();
		$type_in_name ="type_in='".$Userinfo['name']."'";
		$str_1 = $str.="&&($type_in_name)"; 
		}
		//判断qq是否为空
		if($qq!='')
		$str_1 = $str.="&&qq like '%$qq%'";
		
		//判断回访是否为空
		if($huifang!=0)
		{
		$Callbackinfo= M('Callback')->where(array('id'=>$huifang))->find();
		$huifang_name ="huifang='".$Callbackinfo['callback_name']."'";
		
		$str_1 = $str.="&&($huifang_name)";
		
		}
		
		//判断预约情况是否为空
		if($isorder !=9999) {
         $str_1 = $str .= "&& isorder='$isorder'";
		}

		//判断地区是否为空
		if($diqumultiple){
		
		$Areainfo=M('Area')->field('area_name')->where(array('id'=>array('in',$diqumultiple)))->select();
		
		foreach($Areainfo as $v){
		
		$areaname[]="'".$v['area_name']."'";
		
		}
		$areastr=implode(',',$areaname);
		
		$str_1 = $str.="&& area in ($areastr)";  
		
		}
		
		//判断咨询方式是否为空		  
		if($zixunmultiple){
		$zixunmultiples=implode(",",$zixunmultiple);
		$str_1 = $str.="&& info_channel in ($zixunmultiples)";  
		
		}	
		//判断渠道是否为空		  
		if($qudaosmultiple){
		
		
		$Qudaoinfo=M('Consult')->field('consult_name')->where(array('id'=>array('in',$qudaosmultiple)))->select();
		
		foreach($Qudaoinfo as $vo){
		
		$qudaoinfoname[]="'".$vo['consult_name']."'";
		
		}
		$qudaoinfostr=implode(',',$qudaoinfoname);
		
		$str_1 = $str.="&& consult in ($qudaoinfostr)";  
		
		}
		
		
		//判断营销方式是否为空		  
		if($yingxiaomultiple){
		
		
		
		$Yingxiaoinfo=M('Yingxiao')->field('yingxiao_name')->where(array('id'=>array('in',$yingxiaomultiple)))->select();
		
		foreach($Yingxiaoinfo as $voo){
		
		$yingxiaoname[]="'".$voo['yingxiao_name']."'";
		
		}
		$yingxiaostr=implode(',',$yingxiaoname);
		
		$str_1 = $str.="&& marketing in ($yingxiaostr)";  
		
		}		  
		
		
		//判断来源网站否为空		  	  
		if($webmultiple){
		$webmultiples=implode(",",$webmultiple);
		
		$str_1 = $str.="&& source_web in ($webmultiples)";  
		
		} 
		
		
		
		$OrdersData = M()->query("select * from bk_kefuinfo where $str_1");
		
		
		
		Vendor('PhpExcel.PHPExcel');
		//$cacheMethod = \PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;  
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
	   $OrdersData[$i]['source_url']=trim(htmlspecialchars_decode($OrdersData[$i]['source_url']));
	   

 $OrdersData[$i]['source_url']=preg_replace('/^=/',"",$OrdersData[$i]['source_url']);
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
/*		header('Content-Type: application/vnd.ms-excel');  
		header('Content-Disposition: attachment;filename="__NAMEYY__预约信息汇总表('.date('Ymd-His').').xls"'); 
		header('Cache-Control: max-age=0');*/
		
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
		
		}else{
				
				
		echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
				
				
				}
                
                }
		
		
		
		
				
/*******************************************************************【】  导医列表  【】*******************************************************************/
		
		/**
		 * 导医列表【PC端】
		 */
		public function daoyi_list(){
				if(ismobile()){
					$this->redirect('Index/daoyi_mlist');
					exit();
				}
		    $this->main_menu='登记预约';
        $this->son_menu='导医资源列表';
		    $this->display();
		}
		
		/**
		 * 导医列表【移动端】
		 */
		public function daoyi_mlist(){
			if(!(ismobile())){
				$this->redirect('Index/daoyi_list');
				exit();
			}
			$date = array();
			$date['jin'] = date("m/d");
			$date['min'] = date("m/d",strtotime("+1 day"));
			$date['hou'] = date("m/d",strtotime("+2 day"));
			$this->assign('date',$date);
			$this->display();
	  	exit();
		}
		
		/**
		 * 获取分页数据
		 */
		public function daoyi_ajax(){ 
			if(IS_POST){
			//构造数组 
				$date=date("Y-m-d",time());
				$date1=strtotime($date);
				$time_in = date('Y-m-d',$date1 - 2*24*60*60);   
				$page = intval(I('post.pageNum'));
				if(!ismobile()){ 
				     $total=intval(M('Kefuinfo')->where(array('isorder'=>1,'time'=>array(array('EGT',$time_in),array('ELT',$date))))->count());
				}else{
		         $total=intval(M('Kefuinfo')->where(array('isorder'=>1,'time'=>$date))->count());
				}   
				$pageSize     =C('PAGESIZE'); //每页显示数 
				$totalPage = ceil($total/$pageSize); 
				$startPage = $page*$pageSize;
				$arr['total'] = $total; 
				$arr['pageSize'] = $pageSize; 
				$arr['totalPage'] = $totalPage; 
				$arr['quanxian'] = session('m_id');
				if(!ismobile()){ 
				     $sql = "SELECT * FROM bk_kefuinfo  where isorder=1 and time>='$time_in' and time<='$date' limit  $startPage,$pageSize";
				}else{
		         $sql = "SELECT * FROM bk_kefuinfo  where isorder=1 and time ='$date' limit  $startPage,$pageSize";
				}
				$query =M()->query($sql);
				$arr['list'] = D('Index')->getDatas($query);  //处理数组
			   echo json_encode($arr); 
			}else{
			   echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
			}
   }
		
		/**
		 * 导医ajax搜索列表
		 */
		public function daoyisearch_ajax(){ 
				if(IS_POST){	
						$quanxian     = session( 'm_id');
						$page         = intval(I('post.pageNum')); //当前页       
						$pageSize     =C('PAGESIZE'); //每页显示数 
						
						$data= SetData(I('post.data')); 
				    $str_1= D('Index')->getDySearchSql($data); 
						$total=intval(M('Kefuinfo')->where($str_1)->count());  //记录总数
						$totalPage          = ceil($total / $pageSize ); //总页数 
						$startPage          = $page * $pageSize; //开始记录 
						$arr['total']     = $total;
						$arr['pageSize']  = $pageSize;
						$arr['totalPage'] = $totalPage;
						$arr['quanxian']  = $quanxian;
						if(ismobile()){
							$query = M('Kefuinfo')->where($str_1)->order('id DESC')->limit($startPage . ',' . $pageSize)->select();
						}else{
							$query = M('Kefuinfo')->where($str_1)->order($data['orderby']." ".$data['orderway'])->limit($startPage . ',' . $pageSize)->select();
						}
						
				    $arr['list']= D('Index')->getDatas($query); 
						echo json_encode($arr );
				}else{
				    echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
				}
    }
		
		/**
	 * 导医列表修改
	 * @return [type] [description]
	 */
	public function dy_edit(){
		if (IS_POST){
			$data= SetData(I('post.data')); 
			//保存新添加的回访
			if(!empty($data['description']) && isset($data['description'])){
				$vdata['aid']=$data['id'];
				$res     = M('Callback')->field('id')->where(array('callback_name'=>$data['huifang']))->find(); 
				$vdata['cid']=$res['id'];
				$vdata['description']=$data['description'];
				$vdata['senddate']=time();
				$vdata['writer']=session('username');
				$data['huifang_time']=time();
				$addvisit=M('Visit')->add($vdata);
			}else{
				$addvisit=false;	
			}
			//保存修改数据
			$editkefuinfo=M('Kefuinfo')->where(array('id'=>$data['id']))->save($data);
			//将操作存入日志
			if($editkefuinfo || $addvisit){
				$state=1;
				$sjs['actions']="修改客户信息-预约号：[".$data['yuyue']."]成功！";
				$sjs['ip_id']=$_SERVER['REMOTE_ADDR'];
				$sjs['times']=time();
				$sjs['action_name']=session('username');
				M('Operation')->add($sjs);
			}else{
				   $state=0;
			}
      $result = array('state' => $state);
      echo json_encode($result);
		}else{
			$id = I('post.id')?I('post.id'):$_GET['id'];
			$v  = M('Kefuinfo')->where(array( 'id' => $id))->find();
			$str = D('Index')->getDatas(array($v));  //处理数组
			$hfhistory=$str[0]['remark']."\r\n";
	        $visitlist=M('Visit')->where(array('aid' =>$id))->order('id desc')->select();
		    foreach($visitlist as $vi){
				$time=$vi['writer'].":".date('Y-m-d H:i:s',$vi['senddate']);
				$hfhistory.=$time."&nbsp;>>&nbsp;".$vi['description']."\r\n";
			}
			$st     = M('Section')->field('id')->where(array('section_name'=>$str[0]['keshi']))->find(); 
			$bzlist     = M('bingzhong')->where('keshi_id='.$st['id'])->select(); 
			$str[0]['remark'] = $hfhistory;
			$this->assign($str[0]);
			$this->assign( 'quanxian', session('m_id'));
			$this->assign( 'bzlist', $bzlist);
			$this->display();
		}
	}
	/**
	 * 导医列表修改*病种联动
	 * @return [type] [description]
	 */
	public function ks_ajax(){ 
		if(IS_POST){
			$keshi = I('post.keshi');
			$st     = M('Section')->field('id')->where(array('section_name'=>$keshi))->find(); 
			$arr['list']     = M('bingzhong')->where('keshi_id='.$st['id'])->select();  
			echo json_encode($arr);
		}else{
		    echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
		}
    }
		
	
	/**
	 * 分诊弹框与保存
	 */
	public function fenzhen(){
			if(IS_POST){  
				$id                   = I('post.id');
				$docname              = I('post.docval');
				$lytime               = time();
				$data['doctor']       = $docname;
				$data['laiyuan_time'] = $lytime;
				$data['laiyuan']      = '是';
				M('Kefuinfo')->where(array( 'id' => $id))->save($data);  
			}else{
				$id = I('post.id')?I('post.id'):$_GET['id'];
				$this->assign('id',$id);
			  $this->display();
			}
  }
    /**
     * 分诊医生联动
     */
	public function fenzhen_ajax(){ 
		if(IS_POST){
			$section_val = I('post.section_val');
			$query       = M('Doctor')->where(array( 'u_id' => $section_val))->select();
			foreach ($query as $v) {
			   $arr['list'][] = array( 'id' => $v['id'],'doctor_name' => $v['doctor_name']);
			}
			echo json_encode($arr);
		}else{
		    echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
		}
  }
	
	
	/*************************************************************************【】  回访列表  【】************************************************************************************/
		
		public function calls(){
		
		 $hfgroup=M('User')->where(array('m_id'=>5))->select();
		 
		 
		 foreach($hfgroup as $hfv){
			 
			 $hfname.=$hfv['name'].',';
			 
			 }
		$hfstr=substr($hfname, 0, -1);
		
		
		$hfstrname = explode(',', $hfstr);
		
     
    $zxylist = M('User')->where(array('m_id' =>5))->select();
		$huifanglist           = M('Callback')->select();
		$keshilist             = M('Section')->select();
		$arealist              = M('Area')->select();
		$consultlist           = M('Consult')->select();
		$qudaoinfolist         = M('Qudaoinfo')->select();
		$yingxiaolist          = M('Yingxiao')->select();
		$weblist               = M('Web')->select();
		$doctorsectionlist     = M('Doctorsection')->select();
		$where_mrdz            = array('time' => array('EQ',date( 'Y-m-d', C('TOMORROW_START'))),'laiyuan' => '否','type_in'=>array('IN',$hfstrname)); //明日待诊
		
		
		$arr['tomorrow_dz']  = M('Kefuinfo')->where($where_mrdz )->count();
		
		$where_jryy            = array('in_time' => array(array('EGT',C('TODAY_START')),array('ELT',C('TODAY_END'))),'type_in'=>array('IN',$hfstrname)); //今日预约
		$where_jrsd            = array('laiyuan_time' => array(array('EGT',C('TODAY_START')), array('ELT',C('TODAY_END'))),'laiyuan' => '是','type_in'=>array('IN',$hfstrname)); //今日到院
		$where_jrwd            = array('time' => array('EQ',date( 'Y-m-d', C('TODAY_START'))),'laiyuan' => '否','type_in'=>array('IN',$hfstrname)); //今日未到
		$arr['today_yy']     = M('Kefuinfo')->where($where_jryy )->count();
		$arr['today_dy']     = M('Kefuinfo')->where($where_jrsd )->count();
		$arr['today_wd']     = M('Kefuinfo')->where($where_jrwd )->count();
		$where_zryy            = array('in_time' => array(array('EGT',C('YESTERDAY_START')),array('ELT',C('YESTERDAY_END'))),'type_in'=>array('IN',$hfstrname)); //昨日预约
		$where_zrsd            = array('laiyuan_time' => array(array('EGT',C('YESTERDAY_START')), array('ELT',C('YESTERDAY_END'))),'laiyuan' => '是','type_in'=>array('IN',$hfstrname)); //昨日到院
		$where_zrwd            = array('time' => array('EQ',date( 'Y-m-d', C('YESTERDAY_START'))),'laiyuan' => '否','type_in'=>array('IN',$hfstrname)); //昨日未到
		$arr['yesterday_yy'] = M('Kefuinfo')->where($where_zryy )->count();
		$arr['yesterday_dy'] = M('Kefuinfo')->where($where_zrsd )->count();
		$arr['yesterday_wd'] = M('Kefuinfo')->where($where_zrwd )->count();
		$where_byyy            = array('in_time' => array(array('EGT',C('MONTH_START')),array('ELT',C('MONTH_END'))),'type_in'=>array('IN',$hfstrname)); //本月预约
		$where_bysd            = array('laiyuan_time' => array(array('EGT',C('MONTH_START')),array('ELT', C('MONTH_END'))),'laiyuan' => '是','type_in'=>array('IN',$hfstrname)); //本月到院
		$where_bywd            = array('time' => array(array('EGT',date( 'Y-m-d', C('MONTH_START'))),array('ELT',date( 'Y-m-d', C('MONTH_END')))),'laiyuan' => '否','type_in'=>array('IN',$hfstrname)); //本月未到
		$arr['month_yy']     = M('Kefuinfo')->where($where_byyy )->count();
		$arr['month_dy']     = M('Kefuinfo')->where($where_bysd )->count();
		$arr['month_wd']     = M('Kefuinfo')->where($where_bywd )->count();
		$where_szyy            = array('in_time' => array(array('EGT',C('WEEK_START')),array('ELT',C('WEEK_END'))),'type_in'=>array('IN',$hfstrname));
		$where_szsd            = array('laiyuan' => '是','laiyuan_time' => array(array('EGT', C('WEEK_START')),array('ELT',C('WEEK_END'))),'type_in'=>array('IN',$hfstrname));
		$where_szwd           = array('time' => array(array('EGT',date( 'Y-m-d', C('WEEK_START'))),array('ELT',date( 'Y-m-d', C('WEEK_END')))),'laiyuan' =>'否','type_in'=>array('IN',$hfstrname));
		$arr['week_yy']      = M('Kefuinfo')->where($where_szyy )->count();
		$arr['week_dy']      = M('Kefuinfo')->where($where_szsd )->count();
		$arr['week_wd']      = M('Kefuinfo')->where($where_szwd )->count();
		$this->assign( 'zxylist', $zxylist );
		$this->assign( 'huifanglist', $huifanglist );
		$this->assign( 'keshilist', $keshilist );
		$this->assign( 'arealist', $arealist );
		$this->assign( 'consultlist', $consultlist );
		$this->assign( 'qudaoinfolist', $qudaoinfolist );
		$this->assign( 'yingxiaolist', $yingxiaolist );
		$this->assign( 'weblist', $weblist );
		$this->assign( 'doctorsectionlist', $doctorsectionlist );
		$this->assign( 'arr', $arr );
		$this->main_menu='登记预约';
        $this->son_menu='回访信息管理';

		//if(session('m_id')!=3 && session('m_id')!=4){
		$this->display();
		// }else{
			
			
			
		// 	echo "<script type='text/javascript'>alert('你无权查看查看此页面！');history.go(-1);</script>";
			
			
		// 	}

		}
		
		
		//登记信息列表ajax表格列表
		
		public function calls_ajax()
		{
			if(IS_POST){
		 $hfgroup=M('User')->where(array('m_id'=>5))->select();
		 
		 
		 foreach($hfgroup as $hfv){
			 
			 $hfname.=$hfv['name'].',';
			 
			  $hfnames.="'".$hfv['name']."'".',';
			 
			 }
		$hfstr=substr($hfname, 0, -1);
		
		$hfstrs=substr($hfnames, 0, -1);
		
		 $strrs= explode(',', $hfstr);
		
		
         $wher = array('type_in' => array('IN',$strrs));
			
		$page= intval(I('post.pageNum')); //当前页

		$total= intval(M('Kefuinfo')->where($wher)->count()); //记录总数


		if($total>0){
		$pageSize     =C('PAGESIZE'); //每页显示数 
		$totalPage          = ceil($total / $pageSize );
		$startPage          = $page * $pageSize;
		$arr['total']     = $total;
		$arr['pageSize']  = $pageSize;
		$arr['totalPage'] = $totalPage;
		$arr['quanxian']  = session( 'm_id');
		$arr['success']=1;
		
		$hfgroup=M('User')->where(array('m_id'=>5))->select();
		 
	    $sql = "select * from bk_kefuinfo where type_in in($hfstrs) order by in_time desc limit  $startPage,$pageSize";
		$query = M()->query($sql);

		foreach($query as $v){
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
			$description2.=$vs['writer']."：" . $time."&nbsp;>>&nbsp;".$vs['description']."<br/>";
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
		
		if($v['age'] ==0) {
		$age = '';
		}else {
		$age = $v['age'];
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
		$in_time          = date( 'Y-m-d', $v['in_time'] );
		$laiyuan_time     = date( 'Y-m-d H:i:s', $v['laiyuan_time']);
				if($v['huifang'] =='待诊') {
		$huifang= "<span style='color:#337ab7;'>".$v['huifang']."</span>";
		} else{
		$huifang=$v['huifang'];
		}
		
		
		$arr['list'][] = array(
		'id' => $v['id'],
		'yuyue' => $v['yuyue'],
		'username' => $v['username'],
		'sex' => $sex,
		'area' => $v['area'],
		'age' => $age,
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
		'huifang' => $huifang,
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
	  
		}else{
				
				
		echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
				
				
				}
                
                }
		// 预约信息ajax搜索
		public function calls_search_ajax()
		{
			if(IS_POST){
		$quanxian     = session( 'm_id');
		$yuyue        = I( 'post.yuyue'); //预约号
		$username     = I( 'post.username'); //姓名
		$phone        = I( 'post.phone'); //电话
		$in_time      = I( 'post.in_time'); //录入时间
		$end_time     = I( 'post.end_time'); //结束录入时间
		$laiyuan_star = I( 'post.laiyuan_star'); //来院时间
		$laiyuan_end  = I( 'post.laiyuan_end'); //结束来院时间
		$keshi        = I( 'post.keshi'); //科室
		$laiyuan      = I( 'post.laiyuan'); //来院与否
		$chakan       = I( 'post.chakan'); //查看
		$yuyue_time   = I( 'post.yuyue_time'); //预约时间
		$end_yuyue    = I( 'post.end_yuyue'); //结束预约时间
		$qq           = I( 'post.qq'); //关键词
		$huifang      = I( 'post.huifang'); //回访
		$isorder      = I( 'post.isorder'); //预约情况
		$diqu         = $_POST['diqu']; //地区
		$web          = $_POST['web']; //来源网站
		$zixun        = $_POST['zixun']; //咨询方式
		$yingxiao     = $_POST['yingxiao']; //营销方式   
		$qudaos       = $_POST['qudao']; //渠道信息
		$page         = intval(I('post.pageNum')); //当前页       
		$pageSize     =C('PAGESIZE'); //每页显示数 
		$str          = 1;
		$str_1        = $str;
		//判断预约号是否为空
		if($yuyue != '')
		$str_1 = $str .= "&&yuyue like'%$yuyue%'";
		//判断用户名是否为空
		if($username != '')
		$str_1 = $str .= "&&username like'%$username%'";
		//判断电话是否为空
		if($phone != '')
		$str_1 = $str .= "&&phone like '%$phone%'";
		//1.判断录入时间是否为空
		if($_POST['in_time'] != '' || $_POST['end_time'] != '') {
		if($_POST['in_time'] != '' && $_POST['end_time'] != '') {
		date_default_timezone_set( "PRC" );
		$date    = strtotime($end_time );
		$time_in = date( 'Y-m-d', $date + 1 * 24 * 60 * 60);
		$str_1   = $str .= "&&in_time>=UNIX_TIMESTAMP('$in_time')&&in_time<=UNIX_TIMESTAMP('$time_in')";
		} elseif($_POST['in_time'] != '') {
		date_default_timezone_set( "PRC" );
		$date_end = date( "Y-m-d H:i:s" );
		$date     = strtotime($in_time );
		$time_in  = date( 'Y-m-d', $date + 1 * 24 * 60 * 60);
		$str_1    = $str .= "&&in_time>=UNIX_TIMESTAMP('$in_time')&&in_time<=UNIX_TIMESTAMP('$date_end')";
		}
		}
		//1.判断预约时间是否为空
		if($yuyue_time != '' || $end_yuyue != '') {
		if($yuyue_time != '' && $end_yuyue != '') {
		date_default_timezone_set( "PRC" );
		$date    = strtotime($end_yuyue );
		$time_in = date( 'Y-m-d', $date + 1 * 24 * 60 * 60);
		$str_1   = $str .= "&&time>='$yuyue_time'&&time<='$end_yuyue'";
		} else if($yuyue_time != '') {
		date_default_timezone_set( "PRC" );
		$date_end = date( "Y-m-d " );
		$str_1    = $str .= "&&time>='$yuyue_time'";
		}
		}
		//判断来院时间
		if($_POST['laiyuan_star'] != '' || $_POST['laiyuan_end'] != '') {
		if($_POST['laiyuan_star'] != '' && $_POST['laiyuan_end'] != '') {
		date_default_timezone_set( "PRC" );
		$date    = strtotime($laiyuan_end );
		$time_in = date( 'Y-m-d', $date + 1 * 24 * 60 * 60);
		$str_1   = $str .= "&&laiyuan_time>=UNIX_TIMESTAMP('$laiyuan_star')&&laiyuan_time<=UNIX_TIMESTAMP('$time_in')";
		} elseif($_POST['laiyuan_star'] != '') {
		date_default_timezone_set( "PRC" );
		$date_end = date( "Y-m-d H:i:s" );
		$date     = strtotime($laiyuan_star );
		$time_in  = date( 'Y-m-d', $date + 1 * 24 * 60 * 60);
		$str_1    = $str .= "&&laiyuan_time>=UNIX_TIMESTAMP('$laiyuan_star')&&laiyuan_time<=UNIX_TIMESTAMP('$date_end')";
		}
		}
		//判断科室是否为空
		if($keshi !=0) {
		$Sectioninfo = M('Section')->where(array('id' => $keshi))->find();
		$keshi_name  = "keshi='" . $Sectioninfo['section_name'] . "'";
		$str_1       = $str .= "&&($keshi_name)";
		}

		//1.判断来院是否为空
		if($laiyuan !='-请选择-')
		$str_1 = $str .= "&&laiyuan='$laiyuan'";
		//判断咨询员是否为空
		if($chakan !=0) {
		$Userinfo     = M('User')->where(array('id' => $chakan))->find();
		$type_in_name = "type_in='" . $Userinfo['name'] . "'";
		$str_1        = $str .= "&&($type_in_name)";
		}else{
			
			
		 $hfgroup=M('User')->where(array('m_id'=>5))->select();
		 
		 
		 foreach($hfgroup as $hfv){
			 
			 $hfname.="'".$hfv['name']."'".',';
			 
			 }
		$hfstr=substr($hfname, 0, -1);
		
	    $str_1 = $str .= "&& type_in in($hfstr)";

			}
		//判断qq是否为空
		if($qq != '')
		$str_1 = $str .= "&&qq like '%$qq%'";
		
		//判断回访是否为空
		if($huifang !=0) {
		$Callbackinfo = M('Callback')->where(array('id' => $huifang))->find();
		$huifang_name = "huifang='" . $Callbackinfo['callback_name'] . "'";
		$str_1        = $str .= "&&($huifang_name)";
		}
		//判断预约情况是否为空
		if($isorder !=9999) {
        $str_1 = $str .= "&&isorder='$isorder'";
		}
		//判断地区是否为空
		if($diqu !=0) {
		$str_diqu    = "," . $diqu;
		$arr_diqu[ ] = explode( ",", $str_diqu );
		$diqu_id     = $arr_diqu[ 0 ][ 1 ];
		$Areainfo    = M('Area')->where(array('id' => $diqu_id))->find();
		$diqu_name   = "area='" . $Areainfo['area_name'] . "'";
		foreach($arr_diqu as $key => $val ) {
		for($i = 1; $i < count($val ) - 1; $i++ ) {
		$Areainfos = M('Area')->where(array('id' => $val[ $i + 1 ]))->find();
		$diqu_name .= "  or area= '" . $Areainfos['area_name'] . "'";
		}
		}
		$str_1 = $str .= "&&($diqu_name)";
		}
		//判断渠道是否为空
		if($qudaos !=0) {
		$str_qudao    = "," . $qudaos;
		$arr_qudao[ ] = explode( ",", $str_qudao );
		$qudao_id     = $arr_qudao[ 0 ][ 1 ];
		$qudao_name   = "info_channel=" . $qudao_id;
		foreach($arr_qudao as $key => $val ) {
		for($i = 1; $i < count($val ) - 1; $i++ ) {
		$qudao_name .= "  or info_channel= " . $val[ $i + 1 ];
		}
		}
		$str_1 = $str .= "&&($qudao_name)";
		}
		//判断营销是否为空
		if($yingxiao !=0) {
		$str_yingxiao    = "," . $yingxiao;
		$arr_yingxiao[ ] = explode( ",", $str_yingxiao );
		$yingxiao_id     = $arr_yingxiao[ 0 ][ 1 ];
		$Yingxiaoinfo    = M('Yingxiao')->where(array('id' => $yingxiao_id))->find();
		$yingxiao_name   = "marketing='" . $Yingxiaoinfo['yingxiao_name'] . "'";
		foreach($arr_yingxiao as $key => $val ) {
		for($i = 1; $i < count($val ) - 1; $i++ ) {
		$YingxiaoinfoS = M('Yingxiao')->where(array('id' => $val[ $i + 1 ]))->find();
		$yingxiao_name .= "  or marketing= '" . $Yingxiaoinfos['yingxiao_name'] . "'";
		}
		}
		$str_1 = $str .= "&&($yingxiao_name)";
		}
		//判断咨询是否为空
		if($zixun !=0) {
		$str_zixun      = "," . $zixun;
		$arr_consult[ ] = explode( ",", $str_zixun );
		$consult_id     = $arr_consult[ 0 ][ 1 ];
		$Consult        = M('Consult')->where(array('id' => $consult_id))->find();
		$consult_name   = "consult='" . $Consult['consult_name'] . "'";
		foreach($arr_consult as $key => $val ) {
		for($i = 1; $i < count($val ) - 1; $i++ ) {
		$Consults = M('Consult')->where(array('id' => $val[ $i + 1 ]))->find();
		$consult_name .= "  or consult= '" . $Consults['consult_name'] . "'";
		}
		}
		$str_1 = $str .= "&&($consult_name)";
		}
		//判断来源网站是否为空
		if($web !=0) {
		$str_web    = "," . $web;
		$arr_web[ ] = explode( ",", $str_web );
		$web_id     = $arr_web[ 0 ][ 1 ];
		$web_name   = "source_web=" . $web_id;
		foreach($arr_web as $key => $val ) {
		for($i = 1; $i < count($val ) - 1; $i++ ) {
		$web_name .= "  or source_web= " . $val[ $i + 1 ];
		}
		}
		$str_1 = $str .= "&&($web_name)";
		}
		
		
		
		$posts              = M()->query( "select * from bk_kefuinfo where $str_1" );
		$total              = count($posts); //记录总数
		if($total>0){
		$totalPage          = ceil($total / $pageSize ); //总页数 
		$startPage          = $page * $pageSize; //开始记录 
		$sql                = "select * from bk_kefuinfo where $str_1 order by in_time desc limit  $startPage,$pageSize";
		$arr['total']     = $total;
		$arr['pageSize']  = $pageSize;
		$arr['totalPage'] = $totalPage;
		$arr['quanxian']  = $quanxian;
		$arr['success']=1; 
		$query= M()->query($sql );
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
			$description2.=$vs['writer']."：" . $time."&nbsp;>>&nbsp;".$vs['description']."<br/>";
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
		
		if($v['huifang'] =='待诊') {
		$huifang= "<span style='color:#337ab7;'>".$v['huifang']."</span>";
		} else{
		$huifang=$v['huifang'];
		}
		
		$Qdinfo           = M('Qudaoinfo')->where(array('id' => $v['info_channel']))->find();
		$info_channel     = $Qdinfo['info_name'];
		$Webinfo          = M('Web')->where(array('id' => $v['source_web']))->find();
		$source_web       = $Webinfo['web_name'];
		$Yxinfo           = M('Yingxiao')->where(array('id' => $v['marketing']))->find();
		$marketing        = $Yxinfo['yingxiao_name'];
		$in_time          = date( 'Y-m-d', $v['in_time'] );
		$laiyuan_time     = date( 'Y-m-d H:i:s', $v['laiyuan_time'] );
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
		'huifang' => $huifang,
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
	  
		}else{
				
				
		echo "<script type='text/javascript'>alert('非法操作！');history.go(-1);</script>";		
				
				
				}
                
                }
		
		
		

		

}
?>
