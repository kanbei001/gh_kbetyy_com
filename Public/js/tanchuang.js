$(function() {	
$(document).on("click", ".editicon",function() {
 var rel = $(this).attr('rel');
	var ids = $(this).attr('rel');
	var isyy = $(this).attr('data-rel');
	$.ajax({
		type: 'POST',
		url: kfediton_ajax,
		data: {
			'ids': ids,'isyy': isyy,
		},
		dataType: 'json',
		success: function(json) {
			var html = "";
			var kfid = json.id;
			var yuyue = json.yuyue;
			var username = json.username;
			var phone = json.phone;
			var area = json.area;
			var qq = json.qq;
			var sex = json.sex;
			var age = json.age;
			var keshi = json.keshi;
			var bingzhong = json.bingzhong;
			var time = json.time;
			var huifang = json.huifang;
			var type_in = json.type_in;
			var consult = json.consult;
			var bingzheng = json.bingzheng;
			var remark = json.remark;
			var huifang = json.huifang;
			var isorder = json.isorder;
			var info_channel = json.info_channel;
			var source_url = json.source_url;
			var marketing = json.marketing;
			var keyword = json.keyword;
			var source_web = json.source_web;
			var identitys = json.identitys;
			var m_id = json.m_id;
		 $("#kfedit-modal-data").empty();
		if(m_id==2){					
html +="<div class='modal-dialog bgdialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button><h4 class='modal-title'>编辑登记预约信息</h4></div><div class='modal-body'><form class='form-horizontal' role='form' id='EditkfForm'><input type='hidden' id='yyid' name='yyid' value='"+kfid+"'><div class='form-group'><label class='col-md-2 control-label' for='yuyue1'>预约号：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='yuyue1' name='yuyue1' readonly='readonly' value='" + yuyue + "' ></div><label class='control-label' for='username1'>姓名：</label><div class='input-text col-md-4'><input type='text' name='username1' class='form-control input-sm' id='username1' value='" + username + "' placeholder='必填'></div></div><div class='form-group'><label class='col-md-2 control-label' for='phone1'>电话：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='phone1' name='phone1' value='" + phone + "'></div><label class='control-label'>Q&nbsp;&nbsp;Q：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='qq1' name='qq1' value='" + qq + "'></div></div><div class='form-group'><label class='col-md-2 control-label'>年龄：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='age1' name='age1' value='" + age + "'></div><label class='control-label' for='sex1'>性别：</label><div class='input-text col-md-4'>"+ sex +"</div></div><div class='form-group'><label class='col-md-2 control-label' for='keshi1'>科室：</label><div class='input-text col-md-4'><select name='keshi1' id='keshi1' class='form-control input-sm'>"+ keshi +"</select></div><label class='control-label' for='bingzhong1'>病种：</label><div class='input-text col-md-4'><select name='bingzhong1' id='bingzhong1' class='form-control input-sm'>"+ bingzhong +"</select></div></div><div class='form-group'><label class='col-md-2 control-label' for='area1'>地区：</label><div class='input-text col-md-4'><select name='area1' id='area1' class='form-control input-sm'>" + area + "</select></div><label class='control-label' for='isorder1'>预约：</label><div class='input-text col-md-4'><select name='isorder1' id='isorder1' class='form-control input-sm'>"+ isorder +"</select></div></div><div class='form-group'><label class='col-md-2 control-label' for='consult1'>咨询方式：</label><div class='input-text col-md-4'><select name='consult1' id='consult1' class='form-control input-sm'>" + consult + "</select></div><label class='control-label' for='type_in1'>录入者：</label><div class='input-text col-md-4'>" + type_in + "</div></div><div class='form-group'><label class='col-md-2 control-label' for='bingzheng1'>病症：</label><div class='input-text col-md-9'><textarea name='bingzheng1' id='bingzheng1' class='form-control input-sm' rows='4'>" + bingzheng + "</textarea></div></div><div class='form-group'><label class='col-md-2 control-label' for='remark1'>回访记录：</label><div class='input-text col-md-9'><textarea name='remark1' id='remark1' class='form-control input-sm' rows='4' disabled='disabled' style='background:#fff;'>" + remark + "</textarea></div></div><div class='form-group'><label class='col-md-2 control-label' for='description'>新增回访：</label><div class='input-text col-md-9'><textarea name='description' id='description' class='form-control input-sm' rows='2'></textarea></div></div><div class='form-group'><label class='col-md-2 control-label' for='callback1'>回访：</label><div class='input-text col-md-4'><select name='callback1' id='callback1' class='form-control input-sm'>" + huifang + "</select></div><label class='control-label' for='time1'>时间：</label><div class='input-text col-md-4'><input type='text' name='time1' id='time1' class='form-control input-sm' value='" + time + "'></div></div><div class='form-group' style='display:none;'><label class='col-md-2 control-label' for='info_channel1' >信息渠道：</label><div class='input-text col-md-4'><select name='info_channel1' id='info_channel1' class='form-control input-sm'>" + info_channel + "</select></div><label class='control-label' for='source_url1'>来源网址：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='source_url1' name='source_url1' value='" + source_url + "'></div></div><div class='form-group' style='display:none;'><label class='col-md-2 control-label' for='identitys1'>永久身份：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='identitys1' name='identitys1' value='" + identitys + "'></div><label class='control-label' for='marketing1'>营销方式：</label><div class='input-text col-md-4'><select name='marketing1' id='marketing1' class='form-control input-sm'>" + marketing + "</select></div></div><div class='form-group' style='display:none;'><label class='col-md-2 control-label' for='keyword1'>关键词：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='keyword1' name='keyword1' value='" + keyword + "'></div><label class='control-label' for='source_web1'>来源网站：</label><div class='input-text col-md-4'><select name='source_web1' id='source_web1' class='form-control input-sm'>" + source_web + "</select></div></div></form></div><div class='modal-footer'><button type='button' id='buttons_kfedit' class='btn btn-primary'>确定</button><button type='button' class='btn btn-default'data-dismiss='modal'>关闭</button></div></div></div>";
 }else if(m_id==3 || m_id==5){	 
html +="<div class='modal-dialog bgdialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button><h4 class='modal-title'>编辑登记预约信息</h4></div><div class='modal-body'><form class='form-horizontal' role='form' id='EditkfForm'><input type='hidden' id='yyid' name='yyid' value='"+kfid+"'><div class='form-group'><label class='col-md-2 control-label' for='yuyue1'>预约号：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='yuyue1' name='yuyue1' readonly='readonly' value='" + yuyue + "' ></div><label class='control-label' for='username1'>姓名：</label><div class='input-text col-md-4'><input type='text' readonly='readonly'  name='username1' class='form-control input-sm' id='username1' value='" + username + "' placeholder='必填'></div></div><div class='form-group'><label class='col-md-2 control-label' for='phone1'>电话：</label><div class='input-text col-md-4'><input type='text'  readonly='readonly' class='form-control input-sm' id='phone1' name='phone1' value='" + phone + "'></div><label class='control-label'>Q&nbsp;&nbsp;Q：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='qq1' name='qq1' value='" + qq + "'></div></div><div class='form-group'><label class='col-md-2 control-label'>年龄：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='age1' name='age1' value='" + age + "'></div><label class='control-label' for='sex1'>性别：</label><div class='input-text col-md-4'>"+ sex +"</div></div><div class='form-group'><label class='col-md-2 control-label' for='keshi1'>科室：</label><div class='input-text col-md-4'><select name='keshi1' id='keshi1' class='form-control input-sm'>"+ keshi +"</select></div><label class='control-label' for='bingzhong1'>病种：</label><div class='input-text col-md-4'><select name='bingzhong1' id='bingzhong1' class='form-control input-sm'>"+ bingzhong +"</select></div></div><div class='form-group'><label class='col-md-2 control-label' for='area1'>地区：</label><div class='input-text col-md-4'><select name='area1' id='area1' class='form-control input-sm'>" + area + "</select></div><label class='control-label' for='isorder1'>预约：</label><div class='input-text col-md-4'><select name='isorder1' id='isorder1' class='form-control input-sm'>"+ isorder +"</select></div></div><div class='form-group'><label class='col-md-2 control-label' for='consult1'>咨询方式：</label><div class='input-text col-md-4'><select name='consult1' id='consult1' class='form-control input-sm'>" + consult + "</select></div><label class='control-label' for='type_in1'>录入者：</label><div class='input-text col-md-4'>" + type_in + "</div></div><div class='form-group'><label class='col-md-2 control-label' for='bingzheng1'>病症：</label><div class='input-text col-md-9'><textarea name='bingzheng1' id='bingzheng1' class='form-control input-sm' rows='4'>" + bingzheng + "</textarea></div></div><div class='form-group'><label class='col-md-2 control-label' for='remark1'>回访记录：</label><div class='input-text col-md-9'><textarea name='remark1' id='remark1' class='form-control input-sm' rows='4' disabled='disabled' style='background:#fff;'>" + remark + "</textarea></div></div><div class='form-group'><label class='col-md-2 control-label' for='description'>新增回访：</label><div class='input-text col-md-9'><textarea name='description' id='description' class='form-control input-sm' rows='2'></textarea></div></div><div class='form-group'><label class='col-md-2 control-label' for='callback1'>回访：</label><div class='input-text col-md-4'><select name='callback1' id='callback1' class='form-control input-sm'>" + huifang + "</select></div><label class='col-md-2 control-label' for='time1'>时间：</label><div class='input-text col-md-4'><input type='text' name='time1' id='time1' class='form-control input-sm' value='" + time + "'></div></div><div class='form-group' style='display:none;'><label class='col-md-2 control-label' for='info_channel1' >信息渠道：</label><div class='input-text col-md-4'><select name='info_channel1' id='info_channel1' class='form-control input-sm'>" + info_channel + "</select></div><label class='control-label' for='source_url1'>来源网址：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='source_url1' name='source_url1' value='" + source_url + "'></div></div><div class='form-group' style='display:none;'><label class='col-md-2 control-label' for='identitys1'>永久身份：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='identitys1' name='identitys1' value='" + identitys + "'></div><label class='control-label' for='marketing1'>营销方式：</label><div class='input-text col-md-4'><select name='marketing1' id='marketing1' class='form-control input-sm'>" + marketing + "</select></div></div><div class='form-group' style='display:none;'><label class='col-md-2 control-label' for='keyword1'>关键词：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='keyword1' name='keyword1' value='" + keyword + "'></div><label class='control-label' for='source_web1'>来源网站：</label><div class='input-text col-md-4'><select name='source_web1' id='source_web1' class='form-control input-sm'>" + source_web + "</select></div></div></form></div><div class='modal-footer'><button type='button' id='buttons_kfedit' class='btn btn-primary'>确定</button><button type='button' class='btn btn-default'data-dismiss='modal'>关闭</button></div></div></div>";	 
}else if(m_id==1){	 
html +="<div class='modal-dialog bgdialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button><h4 class='modal-title'>编辑登记预约信息</h4></div><div class='modal-body'><form class='form-horizontal' role='form' id='EditkfForm'><input type='hidden' id='yyid' name='yyid' value='"+kfid+"'><div class='form-group'><label class='col-md-2 control-label' for='yuyue1'>预约号：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='yuyue1' name='yuyue1' readonly='readonly' value='" + yuyue + "'></div><label class='control-label' for='username1'>姓名：</label><div class='input-text col-md-4'><input type='text' name='username1' class='form-control input-sm' id='username1' value='" + username + "' placeholder='必填'></div></div><div class='form-group'><label class='col-md-2 control-label' for='phone1'>电话：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='phone1' name='phone1' value='" + phone + "'></div><label class='control-label'>Q&nbsp;&nbsp;Q：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='qq1' name='qq1' value='" + qq + "'></div></div><div class='form-group'><label class='col-md-2 control-label'>年龄：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='age1' name='age1' value='" + age + "'></div><label class='control-label' for='sex1'>性别：</label><div class='input-text col-md-4'>"+ sex +"</div></div><div class='form-group'><label class='col-md-2 control-label' for='keshi1'>科室：</label><div class='input-text col-md-4'><select name='keshi1' id='keshi1' class='form-control input-sm'>"+ keshi +"</select></div><label class='control-label' for='bingzhong1'>病种：</label><div class='input-text col-md-4'><select name='bingzhong1' id='bingzhong1' class='form-control input-sm'>"+ bingzhong +"</select></div></div><div class='form-group'><label class='col-md-2 control-label' for='area1'>地区：</label><div class='input-text col-md-4'><select name='area1' id='area1' class='form-control input-sm'>" + area + "</select></div><label class='control-label' for='isorder1'>预约：</label><div class='input-text col-md-4'><select name='isorder1' id='isorder1' class='form-control input-sm'>"+ isorder +"</select></div></div><div class='form-group'><label class='col-md-2 control-label' for='time1'>时间：</label><div class='input-text col-md-4'><input type='text' name='time1' id='time1' class='form-control input-sm' value='" + time + "'></div><label class='control-label' for='callback1'>回访：</label><div class='input-text col-md-4'><select name='callback1' id='callback1' class='form-control input-sm'>" + huifang + "</select></div></div><div class='form-group'><label class='col-md-2 control-label' for='bingzheng1'>病症：</label><div class='input-text col-md-9'><textarea name='bingzheng1' id='bingzheng1' class='form-control input-sm' rows='3'>" + bingzheng + "</textarea></div></div><div class='form-group'><label class='col-md-2 control-label' for='remark1'>回访记录：</label><div class='input-text col-md-9'><textarea name='remark1' id='remark1' class='form-control input-sm' rows='3' disabled='disabled' style='background:#fff;'>" + remark + "</textarea></div></div><div class='form-group' style='display:none;'><label class='col-md-2 control-label' for='description'>新增回访：</label><div class='input-text col-md-9'><textarea name='description' id='description' class='form-control input-sm' rows='2'></textarea></div></div><div class='form-group'><label class='col-md-2 control-label' for='consult1'>咨询方式：</label><div class='input-text col-md-4'><select name='consult1' id='consult1' class='form-control input-sm'>" + consult + "</select></div><label class='control-label' for='info_channel1' >信息渠道：</label><div class='input-text col-md-4'><select name='info_channel1' id='info_channel1' class='form-control input-sm'>" + info_channel + "</select></div></div><div class='form-group'><label class='col-md-2 control-label' for='source_url1'>来源网址：</label><div class='input-text col-md-9'><input type='text' class='form-control input-sm' id='source_url1' name='source_url1' value='" + source_url + "'></div></div><div class='form-group'><label class='col-md-2 control-label' for='identitys1'>永久身份：</label><div class='input-text col-md-9'><input type='text' class='form-control input-sm' id='identitys1' name='identitys1' value='" + identitys + "'></div></div><div class='form-group'><label class='col-md-2 control-label' for='marketing1'>营销方式：</label><div class='input-text col-md-4'><select name='marketing1' id='marketing1' class='form-control input-sm'>" + marketing + "</select></div><label class='control-label' for='keyword1'>关键词：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='keyword1' name='keyword1' value='" +keyword + "'></div></div><div class='form-group'><label class='col-md-2 control-label' for='source_web1'>来源网站：</label><div class='input-text col-md-4'><select name='source_web1' id='source_web1' class='form-control input-sm'>" + source_web + "</select></div><label class='control-label' for='type_in1'>录入者：</label><div class='input-text col-md-4'>" + type_in + "</div></div></form></div><div class='modal-footer'><button type='button' id='buttons_kfedit' class='btn btn-primary'>确定</button><button type='button' class='btn btn-default'data-dismiss='modal'>关闭</button></div></div></div>";
}else{

 html+="<div class='modal-dialog bgdialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button><h4 class='modal-title'>编辑登记预约信息</h4></div><div class='modal-body'><form class='form-horizontal' role='form' id='EditkfForm'><input type='hidden' id='yyid' name='yyid' value='"+kfid+"'><div class='form-group'><label class='col-md-2 control-label' for='yuyue1'>预约号：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='yuyue1' name='yuyue1' disabled='disabled' value='"+yuyue+"' ></div><label class='control-label' for='username1'>姓名：</label><div class='input-text col-md-4'><input type='text'   name='username1' class='form-control input-sm' id='username1' value='"+username+"' placeholder='必填'></div></div><div class='form-group'><label class='col-md-2 control-label' for='phone1'>电话：</label><div class='input-text col-md-4'><input type='text'  disabled='disabled' class='form-control input-sm' id='phone1' name='phone1' value='"+phone+"'></div><label class='control-label'>Q&nbsp;&nbsp;Q：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' disabled='disabled' id='qq1' name='qq1' value='"+qq+"'></div></div><div class='form-group'><label class='col-md-2 control-label'>年龄：</label><div class='input-text col-md-4'><input type='text' disabled='disabled' class='form-control input-sm' id='age1' name='age1' disabled='disabled' value='"+age+"'></div><label class='control-label' for='sex1'>性别：</label><div class='input-text col-md-4'>"+sex+"</div></div><div class='form-group'><label class='col-md-2 control-label' for='keshi1'>科室：</label><div class='input-text col-md-4'><select name='keshi1' id='keshi1' disabled='disabled' class='form-control input-sm'>"+keshi+"</select></div><label class='control-label' for='bingzhong1'>病种：</label><div class='input-text col-md-4'><select name='bingzhong1' id='bingzhong1' disabled='disabled' class='form-control input-sm'>"+bingzhong+"</select></div></div><div class='form-group'><label class='col-md-2 control-label' for='area1'>地区：</label><div class='input-text col-md-4'><select name='area1' id='area1' disabled='disabled' class='form-control input-sm'>"+area+"</select></div><label class='control-label' for='callback1'>回访：</label><div class='input-text col-md-4'><select name='callback1' id='callback1' disabled='disabled' class='form-control input-sm'>"+huifang+"</select></div><label class='control-label' for='isorder1' style='display:none;'>预约：</label><div class='input-text col-md-4' style='display:none;'><select name='isorder1' id='isorder1' class'form-control input-sm'>"+isorder+"</select></div></div><div class='form-group'><label class='col-md-2 control-label' for='time1'>时间：</label><div class='input-text col-md-4'><input type='text' disabled='disabled' name='time1' id='time1' class='form-control input-sm' value='"+time+"'></div><label class='control-label' for='type_in1'>录入者：</label><div class='input-text col-md-4'>"+type_in+"</div></div><div class='form-group' style='display:none;'><label class='col-md-2 control-label' for='bingzheng1'>病症：</label><div class='input-text col-md-9'><textarea name='bingzheng1' id='bingzheng1' disabled='disabled' class='form-control input-sm' rows='4'>"+bingzheng+"</textarea></div></div><div class='form-group' style='display:none;'><label class='col-md-2 control-label' for='remark1'>回访记录：</label><div class='input-text col-md-9'><textarea name='remark1' id='remark1' class='form-control input-sm' rows='4' disabled='disabled' style='background:#fff;'>"+remark+"</textarea></div></div><div class='form-group' style='display:none;'><label class='col-md-2 control-label' for='description'>新增回访：</label><div class='input-text col-md-9'><textarea name='description' id='description' disabled='disabled' class='form-control input-sm' rows='2'></textarea></div></div><div class='form-group' style='display:none;'><label class='col-md-2 control-label' for='consult1'>咨询方式：</label><div class='input-text col-md-4'><select name='consult1' disabled='disabled' id='consult1' class='form-control input-sm'>"+consult+"</select></div></div><div class='form-group' style='display:none;'><label class='col-md-2 control-label' for='info_channel1' >信息渠道：</label><div class='input-text col-md-4'><select name='info_channel1' id='info_channel1' class='form-control input-sm'>"+info_channel+"</select></div><label class='control-label' for='source_url1'>来源网址：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='source_url1' name='source_url1' value='"+source_url+"'></div></div><div class='form-group' style='display:none;'><label class='col-md-2 control-label' for='identitys1'>永久身份：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='identitys1' name='identitys1' value='"+identitys+"'></div><label class='control-label' for='marketing1'>营销方式：</label><div class='input-text col-md-4'><select name='marketing1' id='marketing1' class='form-control input-sm'>"+marketing+"</select></div></div><div class='form-group' style='display:none;'><label class='col-md-2 control-label' for='keyword1'>关键词：</label><div class='input-text col-md-4'><input type='text' class='form-control input-sm' id='keyword1' name='keyword1' value='"+keyword+"'></div><label class='control-label' for='source_web1'>来源网站：</label><div class='input-text col-md-4'><select name='source_web1' id='source_web1' class='form-control input-sm'>"+source_web+"</select></div></div></form></div><div class='modal-footer'><button type='button' id='buttons_kfedit' class='btn btn-primary'>确定</button><button type='button' class='btn btn-default'data-dismiss='modal'>关闭</button></div></div></div>";
 }
	
	        $("#kfedit-modal-data").append(html);
			var $modal_dialog = $("#kfedit-modal-data").find('.modal-dialog');
			var m_top = ($(window).height() - $modal_dialog.height()) / 2;
			$modal_dialog.css({
				'margin-top': m_top + 'px',
				'margin-bottom': m_top + 'px'
			})
			
			
			
		 $("#time1").datepicker();   	
			
			
			
			
		}
	});
	
$("#kfedit-modal-data").modal("toggle")
});	

	
$(document).on("click", "#buttons_kfedit",function() {
	
	$.ajax({
		type: 'POST',
		url: kfeditsubmit_ajax,
		data: {
	    'yyid':$.trim($('#yyid').val()),
		'yuyue':$.trim($('#yuyue1').val()),
		'username':$.trim($('#username1').val()),
		'sex':$.trim($("input[name='sex1']:checked").val()),
		'area':$.trim($('#area1').val()),
		'isorder':$.trim($('#isorder1').val()),
		'age':$.trim($('#age1').val()),
		'phone':$.trim($('#phone1').val()),
		'qq':$.trim($('#qq1').val()),
		'keshi':$.trim($('#keshi1').val()),
		'bingzhong':$.trim($('#bingzhong1').val()),
		'bingzheng':$.trim($('#bingzheng1').val()),
		'remark':$.trim($('#remark1').val()),
		'consult':$.trim($('#consult1').val()),
		'type_in':$.trim($('#type_in1').val()),
		'time':$.trim($('#time1').val()),
		'huifang':$.trim($('#callback1').val()),
		'info_channel':$.trim($('#info_channel1').val()),
		'source_url':$.trim($('#source_url1').val()),
		'marketing':$.trim($('#marketing1').val()),
		'keyword':$.trim($('#keyword1').val()),
		'source_web':$.trim($('#source_web1').val()),
		'identitys':$.trim($('#identitys1').val()),
		'description':$.trim($('#description').val()),
			},
		dataType: 'json',
		success: function(json) {
			
		if(json.state==1){

      $('#kfedit-modal-data').modal('hide');
	  $('#kfedit-modal-data').empty();

			
			}else{
				
				alert('修改失败，请核对后重试！');
				
				}
			
			},
	
});	
});	
        	

$(document).on("click", ".xqinfoicon",function() {
	var ids = $(this).attr('rel');
	$.ajax({
		type: 'POST',
		url: xiangqing_ajax,
		data: {
			'ids': ids
		},
		dataType: 'json',
		success: function(json) {
			var html = "";
			var yuyue = json.yuyue;
			var username = json.username;
			var in_time = json.in_time;
			var phone = json.phone;
			var area = json.area;
			var qq = json.qq;
			var sex = json.sex;
			var age = json.age;
			var laiyuan = json.laiyuan;
			var keyword = json.keyword;
			var laiyuan_time = json.laiyuan_time;
			var source_web = json.source_web;
			var source_url = json.source_url;
			var keshi = json.keshi;
			var bingzhong = json.bingzhong;
			var doctor = json.doctor;
			var time = json.time;
			var huifang = json.huifang;
			var type_in = json.type_in;
			var info_channel = json.info_channel;
			var consult = json.consult;
			var marketing = json.marketing;
			var bingzheng = json.bingzheng;
			var remark = json.remark;
			var huifangs = json.huifang;
			var laiyuan_time = json.laiyuan_time;
			var identitys = json.identitys;
			var quanxian = json.quanxian;
			$('#info-modal-data').empty();
			if(quanxian==1){
html += "<div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button><h4 class='modal-title'>患者详情</h4></div><div class='modal-body'><div class='table-responsive'><table class='table table-bordered table-hover'><thead><tr><td colspan='3' class='left'><strong>客户基本信息</strong></td></tr></thead><tbody><tr><td class='left'><strong>预约号：</strong>" + yuyue + "</td><td class='left'><strong>姓名：</strong>" + username + "</td><td class='left'><strong>登记时间：</strong>" + in_time + "</td></tr><tr><td class='left'><strong>电　话：</strong>" + phone + "</td><td class='left'><strong>地区：</strong>" + area + "</td><td class='left'><strong>QQ：</strong>" + qq + "</td></tr><tr><td class='left'><strong>性　别：</strong>" + sex + "</td><td class='left'><strong>年龄：</strong>" + age + "</td><td class='left'><strong>是否来院：</strong>" + laiyuan + "</td></tr><tr><td class='left'><strong>来院时间：</strong>" + laiyuan_time + "</td><td class='left'><strong>关键词：</strong>" + keyword + "</td><td class='left'><strong>来源网站：</strong>" + source_web + "</td></tr></tbody></table><table class='table table-border table-bordered table-bg'><thead><tr><td colspan='3' class='left'><strong>预约挂号信息</strong></td></tr></thead><tbody><tr><td class='left'><strong>科室：</strong>" + keshi + "</td><td class='left'><strong>病种：</strong>" + bingzhong + "</td><td class='left'><strong>6预约医生：</strong>" + doctor + "</td></tr><tr><td class='left'><strong>预约时间：</strong>" + time + "</td><td class='left'><strong>回访：</strong>" + huifang + "</td><td class='left'><strong>录入者：</strong>" + type_in + "</td></tr><tr><td class='left'><strong>咨询方式：</strong>" + consult + "</td><td class='left'><strong>营销方式：</strong>" + marketing + "</td><td class='left'><strong>获取信息渠道：</strong>" + info_channel + "</td></tr></tbody></table><table class='table table-border table-bordered table-bg'><thead><tr><td colspan='3' class='left'><strong>患者跟踪信息</strong></td></tr></thead><tbody><tr><td colspan='3' class='left'><strong>病症：</strong><textarea class='form-control input-sm' rows='4' readonly='readonly' style='background:#fff;'>" + bingzheng + "</textarea></td></tr><tr><td class='left' colspan='2'><strong>回访记录：</strong><textarea class='form-control input-sm' rows='4' readonly='readonly' style='background:#fff;'>" + remark + "</textarea></td></tr></tbody></table></div></div></div></div>";
			}else if(quanxian==2 || quanxian==3 || quanxian==5){
html += "<div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button><h4 class='modal-title'>患者详情</h4></div><div class='modal-body'><div class='table-responsive'><table class='table table-bordered table-hover'><thead><tr><td colspan='3' class='left'><strong>客户基本信息</strong></td></tr></thead><tbody><tr><td class='left'><strong>预约号：</strong>" + yuyue + "</td><td class='left'><strong>姓名：</strong>" + username + "</td><td class='left'><strong>登记时间：</strong>" + in_time + "</td></tr><tr><td class='left'><strong>电　话：</strong>" + phone + "</td><td class='left'><strong>地区：</strong>" + area + "</td><td class='left'><strong>QQ：</strong>" + qq + "</td></tr><tr><td class='left'><strong>性　别：</strong>" + sex + "</td><td class='left'><strong>年龄：</strong>" + age + "</td><td class='left'><strong>来院时间：</strong>" + laiyuan_time + "</td></tr></tbody></table><table class='table table-border table-bordered table-bg'><thead><tr><td colspan='3' class='left'><strong>预约挂号信息</strong></td></tr></thead><tbody><tr><td class='left'><strong>科室：</strong>" + keshi + "</td><td class='left'><strong>病种：</strong>" + bingzhong + "</td><td class='left'><strong>预约医生：</strong>" + doctor + "</td></tr><tr><td class='left'><strong>预约时间：</strong>" + time + "</td><td class='left'><strong>回访：</strong>" + huifang + "</td><td class='left'><strong>录入者：</strong>" + type_in + "</td></tr></tbody></table><table class='table table-border table-bordered table-bg'><thead><tr><td colspan='3' class='left'><strong>患者跟踪信息</strong></td></tr></thead><tbody><tr><td colspan='3' class='left'><strong>病症：</strong><textarea class='form-control input-sm' rows='4' readonly='readonly' style='background:#fff;'>" + bingzheng + "</textarea></td></tr><tr><td class='left' colspan='2'><strong>回访记录：</strong><textarea class='form-control input-sm' rows='4' readonly='readonly' style='background:#fff;'>" + remark + "</textarea></td></tr></tbody></table></div></div></div></div>";
				}else{
					
html += "<div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button><h4 class='modal-title'>患者详情</h4></div><div class='modal-body'><div class='table-responsive'><table class='table table-bordered table-hover'><thead><tr><td colspan='3' class='left'><strong>客户基本信息</strong></td></tr></thead><tbody><tr><td class='left'><strong>预约号：</strong>" + yuyue + "</td><td class='left'><strong>姓名：</strong>" + username + "</td><td class='left'><strong>登记时间：</strong>" + in_time + "</td></tr><tr><td class='left'><strong>电　话：</strong>" + phone + "</td><td class='left'><strong>地区：</strong>" + area + "</td><td class='left'><strong>QQ：</strong>" + qq + "</td></tr><tr><td class='left'><strong>性　别：</strong>" + sex + "</td><td class='left'><strong>年龄：</strong>" + age + "</td><td class='left'><strong>来院时间：</strong>" + laiyuan_time + "</td></tr></tbody></table><table class='table table-border table-bordered table-bg'><thead><tr><td colspan='3' class='left'><strong>预约挂号信息</strong></td></tr></thead><tbody><tr><td class='left'><strong>科室：</strong>" + keshi + "</td><td class='left'><strong>病种：</strong>" + bingzhong + "</td><td class='left'><strong>预约医生：</strong>" + doctor + "</td></tr><tr><td class='left'><strong>预约时间：</strong>" + time + "</td><td class='left'><strong>回访：</strong>" + huifang + "</td><td class='left'><strong>录入者：</strong>" + type_in + "</td></tr></tbody></table><table class='table table-border table-bordered table-bg'><thead><tr><td colspan='3' class='left'><strong>患者跟踪信息</strong></td></tr></thead><tbody><tr><td colspan='3' class='left'><strong>病症：</strong><textarea class='form-control input-sm' rows='4' readonly='readonly' style='background:#fff;'>" + bingzheng + "</textarea></td></tr></tbody></table></div></div></div></div>";	

					
					}
			$('#info-modal-data').append(html);
			var $modal_dialog = $('#info-modal-data').find('.modal-dialog');
			var m_top = ($(window).height() - $modal_dialog.height()) / 2;
			$modal_dialog.css({
				'margin-top': m_top + 'px',
				'margin-bottom': m_top + 'px'
			})
		}
	});
	$("#info-modal-data").modal("toggle")
});


$('#info-modal-data').on('hide.bs.modal',function() {
	$('#info-modal-data').empty()
});


$(document).on("click", ".fzicon",function() {  
	var rel = $(this).attr('rel');
	$('#fzid').val(rel);
	$("#fz-modal-data").modal("toggle")
});


$('#fz-modal-data').on('hide.bs.modal',
function() {
	$('#doctors').val('0');
	$('#doctor_section').empty();
	$('#fzid').val('');
});

	

	$(document).on("click", ".isorder",function() {
						 
	var isorder=$(this).children('span').attr('rel');
	var isorderid=$(this).attr('rel');
	if(isorder==0){		
	var statu = confirm("确认要修改成预约吗？");
        if(!statu){
            return false;
        }

		$.ajax({	
		 type: 'POST',
         url: isorder_ajax,
		 data: {'isorder':isorder,'isorderid':isorderid,},
		 dataType: 'json',
		    success: function(json) {
			
			if(json.states==1){
				alert('操作成功！');
			 $('#order_'+ isorderid).html("<span rel=1 style='color:green'>√</span>");
            }else{
				
				alert('操作失败！');
				}
		
			
			 }
	
	});	
		
		}

	});	
	
	
$(document).on("click", ".delicon",function() {
	var rel=$(this).attr('rel');		
	var statu = confirm("确定要删除这条信息吗？");
        if(!statu){
            return false;
        }
		$.ajax({	
		 type: 'POST',
         url: yydel_ajax,
		 data: {'rel':rel},
		 dataType: 'json',
		    success: function(json) {
			
			if(json.state==1){
			 $('#delinfo_'+rel).parent('.td-manage').parent('tr').remove();
            }else{
				
				alert('操作失败！');
				}
		
			
			 }
	
	});	
		

	});	

})