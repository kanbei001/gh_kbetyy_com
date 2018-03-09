function get_mobile_code() {
	  // return true;
    var mobile = jQuery.trim($('#mobile').val());
    var name = jQuery.trim($('#username').val());
    if (name == '') {
        alert('请输入用户名！');
        $('#username').focus();
        return false;
    }
	if (mobile == '') {
        alert('请输入手机号！');
        $('#mobile').focus();
        return false;
    }
	if(!IsPhone(mobile)){
		alert("请输入正确的手机号码!");
        $('#mobile').focus();
        return false;
		}

    check_phone(mobile,name)
}


function IsPhone(phone){
	
var reNum=/^\d{11}$/;
return(reNum.test(phone));
}


function check_phone(mobile,name) {
	// return true;
    $.ajax({
        type: 'POST',
        url: ckphone_ajax,
        data: {
            'mobile': mobile,
            'name':name
        },
        dataType: 'json',
        success: function(json) {
            if (json.success == 1) {
                $.post(smsurl, {
                    mobile: jQuery.trim($('#mobile').val()),
                    send_code: send_code
                },
                function(msg) {
                    alert(jQuery.trim(unescape(msg)));
                    if (msg == '提交成功') {
                        RemainTime()
                    }
                })
            } else {
                alert('请选择指定的手机号码！');
                $('#mobile').attr("value", "");
                $('#mobile').focus();
                return false;
            }
        },
    })
}
var iTime = 59;
var Account;
function RemainTime() {
	// return true;
    document.getElementById('zphone').disabled = true;
    var iSecond, sSecond = "",
    sTime = "";
    if (iTime >= 0) {
        iSecond = parseInt(iTime % 60);
        iMinute = parseInt(iTime / 60);
        if (iSecond >= 0) {
            if (iMinute > 0) {
                sSecond = iMinute + "分" + iSecond + "秒"
            } else {
                sSecond = iSecond + "秒"
            }
        }
        sTime = sSecond;
        if (iTime == 0) {
            clearTimeout(Account);
            sTime = '获取手机验证码';
            iTime = 59;
            document.getElementById('zphone').disabled = false
        } else {
            Account = setTimeout("RemainTime()", 1000);
            iTime = iTime - 1
        }
    } else {
        sTime = '没有倒计时'
    }
    document.getElementById('zphone').value = sTime
}




$(function() {
// 手机号码验证  
jQuery.validator.addMethod("isMobile", function(value, element) {  
    var length = value.length;  
    var mobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;  
    return this.optional(element) || (length == 11 && mobile.test(value));  
}, "手机格式不正确");  

    $("#LoginForm").validate({
        rules: {
            username: "required",
            password: "required",
           /* mobile_code: "required",
			mobile:{  
            required : true,  
            isMobile : true  
        },  */
			
        },
        messages: {
            username: "用户名必填！",
            password: "密码必填！",
           /* mobile_code: "验证码必填！",
            mobile:{ 
            required : "手机号不能为空",
            isMobile : "手机格式不正确"  
        }, */ 
        },
submitHandler: function(form) {  
     var username = $("#username").val();
	 var password = $("#password").val();    
	//var mobile = $("#mobile").val();  
	//var mobile_code = $("#mobile_code").val();    
     $.ajax({  
            url : login_ajax,  
            type : "post",  
            dataType : "json",  
            data: {'username':username,'password':password,/*'mobile':mobile,'mobile_code':mobile_code,*/},
            success : function(data) {   
            if(data.varone==0) {
            	alert('用户名或密码错误！');
            	return false;
            }

            /*if(data.vartwo==0){
            	alert('动态码错误！');
            	return false;
            }*/

            if(data.vartthree==0){
            	alert('非法登录！请联系技术');
                alert('你的ip：'+data.vartthrees);
            	return false;
            }

            if(data.varfour==1){
            	location.href=shouye;
            	}

              }
     });  
         },  
         invalidHandler: function(form, validator) {
       return false;  
          }, 
    })
});