$(function(){
	$(document).on("click", ".xqinfoicon",function() {
		var rel=$(this).attr('rel');
		var ids=$(this).attr('rel');
	$.ajax({
      type: 'POST',
      url: xiangqing_ajax,
      data: {'ids':ids},
      dataType:'json',
      success:function(json){
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
       $('#info-modal-data').empty();
	   
       html +="<div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button><h4 class='modal-title'>患者详情</h4></div><div class='modal-body'><div class='table-responsive'><table class='table table-bordered table-hover'><thead><tr><td colspan='3' class='left'><strong>客户基本信息</strong></td></tr></thead><tbody><tr><td class='left'><strong>预约号：</strong>"+yuyue+"</td><td class='left'><strong>姓名：</strong>"+username+"</td><td class='left'><strong>登记时间：</strong>"+in_time+"</td></tr><tr><td class='left'><strong>电　话：</strong>"+phone+"</td><td class='left'><strong>地区：</strong>"+area+"</td><td class='left'><strong>QQ：</strong>"+qq+"</td></tr><tr><td class='left'><strong>性　别：</strong>"+sex+"</td><td class='left'><strong>年龄：</strong>"+age+"</td><td class='left'><strong>是否来院：</strong>"+laiyuan+"</td></tr><tr><td class='left'><strong>来院时间：</strong>"+laiyuan_time+"</td><td class='left'><strong>关键词：</strong>"+keyword+"</td><td class='left'><strong>来源网站：</strong>"+source_web+"</td></tr></tbody></table><table class='table table-border table-bordered table-bg'><thead><tr><td colspan='3' class='left'><strong>预约挂号信息</strong></td></tr></thead><tbody><tr><td class='left'><strong>科室：</strong>"+keshi+"</td><td class='left'><strong>病种：</strong>"+bingzhong+"</td><td class='left'><strong>预约医生：</strong>"+doctor+"</td></tr><tr><td class='left'><strong>预约时间：</strong>"+time+"</td><td class='left'><strong>回访：</strong>"+huifang+"</td><td class='left'><strong>录入者：</strong>"+type_in+"</td></tr><tr><td class='left'><strong>咨询方式：</strong>"+consult+"</td><td class='left'><strong>营销方式：</strong>"+marketing+"</td><td class='left'><strong>获取信息渠道：</strong>"+info_channel+"</td></tr></tbody></table><table class='table table-border table-bordered table-bg'><thead><tr><td colspan='3' class='left'><strong>患者跟踪信息</strong></td></tr></thead><tbody><tr><td class='left' colspan='2'><strong>来源网址：</strong>"+source_url+"</td></tr><tr><td class='left'><strong>病症：</strong>"+bingzheng+"</td><td class='left'><strong>回访记录：</strong>"+huifangs+"</td></tr><tr><td class='left' colspan='2'><strong>备注：</strong>"+remark+"</td></tr></tbody></table></div></div></div></div>";
   
       $('#info-modal-data').append(html);
	     var $modal_dialog = $('#info-modal-data').find('.modal-dialog');
          var m_top = ( $(document).height() - $modal_dialog.height() )/2;
	      $modal_dialog.css("margin-top", Math.max(0, ($(window).height() - $modal_dialog.height()) / 2)); 
      }
      
       });	   
$("#info-modal-data").modal("toggle");

});


});