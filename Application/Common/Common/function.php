<?php

function roles($m_id){
	  switch ($m_id)
	  {
	  case 1:
	  return "管理员";
	  break;
	  case 2:
	  return "咨询主管";
	  break;
	  case 3:
	  return "咨询员";
	  break;
	  
	  
	  case 4:
	  return "导医";
	  break;
	  
	  case 5:
	  return "回访组";
	  break;
	  
	  case 8:
      return "经营部";
      break;
      
      case 9:
      return "竞价";
      break;
	  
	  default:
	  return "不存在";
	  }
}




//处理方法
function rmdirr($dirname) {
    if (!file_exists($dirname)) {
        return false;
    }
    if (is_file($dirname) || is_link($dirname)) {
        return unlink($dirname);
    }
    $dir = dir($dirname);
    if ($dir) {
        while (false !== $entry = $dir->read()) {
            if ($entry == '.' || $entry == '..') {
                continue;
            }
            //递归
            rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
        }
    }
}

//公共函数
//获取文件修改时间
function getfiletime($file, $DataDir) {
    $a = filemtime($DataDir . $file);
    $time = date("Y-m-d H:i:s", $a);
    return $time;
}

//获取文件的大小
function getfilesize($file, $DataDir) {
    $perms = stat($DataDir . $file);
    $size = $perms['size'];
    // 单位自动转换函数
    $kb = 1024;         // Kilobyte
    $mb = 1024 * $kb;   // Megabyte
    $gb = 1024 * $mb;   // Gigabyte
    $tb = 1024 * $gb;   // Terabyte

    if ($size < $kb) {
        return $size . " B";
    } else if ($size < $mb) {
        return round($size / $kb, 2) . " KB";
    } else if ($size < $gb) {
        return round($size / $mb, 2) . " MB";
    } else if ($size < $tb) {
        return round($size / $gb, 2) . " GB";
    } else {
        return round($size / $tb, 2) . " TB";
    }
}


 function last_month_today($time){
    $last_month_time = mktime(date("G", $time), date("i", $time),date("s", $time), date("n", $time), 0, date("Y", $time));
    $last_month_t =  date("t", $last_month_time);
    if ($last_month_t < date("j", $time)) {
        return date("Y-m-t", $last_month_time);
    }
    return date(date("Y-m", $last_month_time) . "-d", $time);
}


function ismobile() {
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
        return true;
    
    //此条摘自TPM智能切换模板引擎，适合TPM开发
    if(isset ($_SERVER['HTTP_CLIENT']) &&'PhoneClient'==$_SERVER['HTTP_CLIENT'])
        return true;
    //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
        //找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], 'wap') ? true : false;
    //判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array(
            'nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile'
        );
        //从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
    }
    //协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT'])) {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return true;
        }
    }
    return false;
 }
 
function hidtel($phone){
    $IsWhat = preg_match('/(0[0-9]{2,3}[-]?[2-9][0-9]{6,7}[-]?[0-9]?)/i',$phone); //固定电话
    if($IsWhat == 1){
        return preg_replace('/(0[0-9]{2,3}[-]?[2-9])([0-9]{3}[-]?[0-9]?)[0-9]{4,4}/i','$1$2****',$phone);
    }else{
       return  preg_replace('/(1[023456789]{1}[0-9])([0-9]{4})[0-9]{4}/i','$1$2****',$phone);
    }
}


function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) {
    if(function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        $slice = iconv_substr($str,$start,$length,$charset);
        if(false === $slice) {
            $slice = '';
        }
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    return $suffix ? $slice.'' : $slice;
}


function check_ip($ips){  
  //  $ALLOWED_IP=array('117.34.13.*');  
 //   dump($ALLOWED_IP);
    $ALLOWED_IP=M('Config')->where("parent_id=1")->getField('id,name'); 
    $check_ip_arr= explode('.',$ips);//要检测的ip拆分成数组  
    #限制IP  
    if(in_array($ips,$ALLOWED_IP)) {  
        foreach ($ALLOWED_IP as $val){   
            if(strpos($val,'*')!==false){           //发现有*号替代符  
                 $arr=array();//  
                 $arr=explode('.', $val);  
                 $bl=true;//用于记录循环检测中是否有匹配成功的  
                 for($i=0;$i<5;$i++){  
                    if($arr[$i]!='*'){//不等于*  就要进来检测，如果为*符号替代符就不检查  
                        if($arr[$i]!=$check_ip_arr[$i]){  
                            $bl=false;  
                            break;//终止检查本个ip 继续检查下一个ip  
                        }  
                    }  
                 }//end for   
                 if($bl){//如果是true则找到有一个匹配成功的就返回  
                    return $bl;  
                    die;
                 }  
            }else{
                return true;
            }  
        }
        
    }  
}  	
?>