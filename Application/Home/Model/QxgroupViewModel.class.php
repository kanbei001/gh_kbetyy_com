<?php
namespace Home\Model;
use Think\Model\ViewModel;
class QxgroupViewModel extends ViewModel {

	 protected $trueTableName  = 'bk_qx';

     public $viewFields = array(
        'Qxgroup'=>array('id','qx_name_1','qx_id','url'),
        'Qx'=>array('qx_name', '_on'=>'Qxgroup.qx_id=Qx.qx_id'),
      );

 
   


	 function checkData($data){
	 	if($data['u_id']==0)     return "请选择用户！";
	 	switch ($data['parent_id']) {
	 		case 1:
	 			return $this->checkLoginIp($data['name']);
	 			break;
	 		case 2:
	 			return $this->checkLoginMac($data['name']);
	 			break;
	 	}
	 }

      // ip管理验证
	 function checkLoginIp($name){
	 	if($name==''){   
	 		return "请输入Ip值！";
	 	}else{
	 		$ip =str_replace('*', 1, $name);
	 		if(!filter_var($ip,FILTER_VALIDATE_IP)){
		 		return "Ip 格式不正确！";
		 	}
	 	} 
	 }
     // ip管理验证
	 function checkLoginMac($name){
	    $preg_string = "/[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]". "[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]". "[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f]/i";
	 	if($name==''){   
	 		return "请输入Mac值！";
	 	}else{
	 		$ip =str_replace('*', 1, $name);
	 		if(!preg_match($preg_string, $name, $temp_array )){
		 		return "Mac 格式不正确！";
		 	}
	 	} 
	 }
	  function getTitle($p){
	 	switch ($p) {
	 		case 1:
	 			return "Ip";
	 			break;
	 		case 2:
	 			return "Mac";
	 			break;
	 	}
	 }
  }
 ?>