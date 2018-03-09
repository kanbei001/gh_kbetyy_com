 $(function() {
	 var total, pageSize, totalPage, quanxian,curPage;
    $(document).on("click", "#search_btns",function() {
	  var yuyue = $('#yuyue').val();
      var username = $('#username').val();
      var phone = $('#phone').val();
      var in_time = $('#type_in_strat').val();
      var end_time = $('#type_in_end').val();
      var qq = $('#qq').val();
      var keshi = $('#keshi').val();
      var bingzhong = $('#bingzhong').val();
      var laiyuan_star = $('#laiyuan_strat').val();
      var laiyuan_end = $('#laiyuan_end').val();
      var laiyuan = $('#laiyuan').find("option:selected").text();
      var chakan = $('#zxylist').find("option:selected").val();
      var yuyue_time = $('#yuyue_strat').val();
      var end_yuyue = $('#yuyue_end').val();
      var huifang = $('#huifang').find("option:selected").val();
      var area_text = "";
      for (var i = 0; i < $("#selectLocation_1").length; i++) {
        area_text += $("#selectLocation_1:eq(" + i + ")").val()
      }
      diqu = area_text;
      var qudaos_text = "";
      for (var i = 0; i < $("#selectInformationChannel_1").length; i++) {
        qudaos_text += $("#selectInformationChannel_1:eq(" + i + ")").val()
      }
      qudaos = qudaos_text;
      var text = "";
      for (var i = 0; i < $("#selectConsultMethod_1").length; i++) {
        text += $("#selectConsultMethod_1:eq(" + i + ")").val()
      }
      zixun = text;
      var yingxiao_text = "";
      for (var i = 0; i < $("#selectMarketingMethod_1").length; i++) {
        yingxiao_text += $("#selectMarketingMethod_1:eq(" + i + ")").val()
      }
      yingxiao = yingxiao_text;
      var web_text = "";
      for (var i = 0; i < $("#selectWebSite_1").length; i++) {
        web_text += $("#selectWebSite_1:eq(" + i + ")").val()
      }
      web = web_text;
	  
	  function getData(page){
		$.ajax({
			
		  type: 'POST',
          url: search_ajax,
		   data: {
              'pageNum':page-1,
              'yuyue':yuyue,
              'username':username,
              'phone':phone,
              'in_time':in_time,
              'end_time':end_time,
              'keshi':keshi,
              'bingzhong':bingzhong,
              'laiyuan':laiyuan,
              'laiyuan_star':laiyuan_star,
              'laiyuan_end':laiyuan_end,
              'chakan':chakan,
              'yuyue_time':yuyue_time,
              'end_yuyue':end_yuyue,
              'diqu':diqu,
              'web':web,
              'qq':qq,
              'huifang':huifang,
              'zixun':zixun,
              'yingxiao':yingxiao,
              'qudao':qudaos
            },
			
		   dataType: 'json',
		     success: function(json) {                
			    $("#ajax").empty();
				$("#pageNavs").empty();
				$("#pageNavs").hide();				
				$("#pageNavs_sousuo").empty();
				$("#pageNavs_sousuo").show();
            total = json.total;
            if (total == 0) {
              window.location.reload()
            }
            pageSize = json.pageSize;
            quanxian = json.quanxian;
            curPage = page;
            totalPage = json.totalPage;
            var tr = "<thead><tr class='text-centerenter'><th>预约号</th><th>姓名</th><th>性别</th><th>电话</th><th>科室</th><th>病种</th><th>医生</th><th>预约时间</th><th>渠道</th><th>qq</th><th>来源网站</th><th>信息渠道</th><th>来院</th><th>录入员</th><th>录入时间</th><th>操作</th></thead><tbody>";
            var list = json.list;
           if (quanxian == 1) {
              $.each(list,function(index, array) {
                if (array['laiyuan'] == '是') {
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['bingzhong'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td class='isorder'  rel='"+array['id']+"'>" + array['order'] + "</td><td><span style='color:green'>√</span></td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td class='td-manage'><a title='还原' target='_blank' href=restore?id="+array['id']+"&isorder="+array['isorder']+"><i class='fa fa-fw fa-edit'></i>还原</a> <a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a> <a title='删除'  onclick='return confirmAct();' href=recycle_del?id="+array['id']+"><i class='fa fa-fw fa-trash-o'></i>删除</a></td></tr>"
                } else {
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['bingzhong'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td class='isorder'  rel='"+array['id']+"'>" + array['order'] + "</td><td><span style='color:red'>×</span></td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td class='td-manage'><a title='还原' target='_blank' href=restore?id="+array['id']+"&isorder="+array['isorder']+"><i class='fa fa-fw fa-edit'></i>还原</a> <a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a> <a title='删除'  onclick='return confirmAct();' href=recycle_del?id="+array['id']+"><i class='fa fa-fw fa-trash-o'></i>删除</a></td></tr>"
                }
              })
            }
            if (quanxian == 2) {
              $.each(list,function(index, array) {
                if (array['laiyuan'] == '是') {
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['bingzhong'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td class='isorder'  rel='"+array['id']+"'>" + array['order'] + "</td><td><span style='color:green'>√</span></td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td class='td-manage'><a title='还原' target='_blank' href=restore?id="+array['id']+"&isorder="+array['isorder']+"><i class='fa fa-fw fa-edit'></i>还原</a> <a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a> <a title='删除'  onclick='return confirmAct();' href=recycle_del?id="+array['id']+"><i class='fa fa-fw fa-trash-o'></i>删除</a></td></tr>"
                } else{
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['bingzhong'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td class='isorder'  rel='"+array['id']+"'>" + array['order'] + "</td><td><span style='color:red'>×</span></td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td class='td-manage'><a title='还原' target='_blank' href=restore?id="+array['id']+"&isorder="+array['isorder']+"><i class='fa fa-fw fa-edit'></i>还原</a> <a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a> <a title='删除'  onclick='return confirmAct();' href=recycle_del?id="+array['id']+"><i class='fa fa-fw fa-trash-o'></i>删除</a></td></tr>"
                }
				
              })
            }
            if (quanxian == 3) {
              $.each(list,function(index, array) {
               
			   if (array['laiyuan'] == '是') {
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['bingzhong'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td class='isorder'  rel='"+array['id']+"'>" + array['order'] + "</td><td><span style='color:green'>√</span></td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td class='td-manage'><a title='还原' target='_blank' href=restore?id="+array['id']+"&isorder="+array['isorder']+"><i class='fa fa-fw fa-edit'></i>还原</a> <a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a> </td></tr>"
                } else{
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['bingzhong'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td class='isorder'  rel='"+array['id']+"'>" + array['order'] + "</td><td><span style='color:red'>×</span></td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td class='td-manage'><a title='还原' target='_blank' href=restore?id="+array['id']+"&isorder="+array['isorder']+"><i class='fa fa-fw fa-edit'></i>还原</a> <a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a></td></tr>"
                }
              })
            }
            if (quanxian == 4) {
              $.each(list,function(index, array) {
						   if (array['laiyuan'] == '是') {
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['bingzhong'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td class='isorder'  rel='"+array['id']+"'>" + array['order'] + "</td><td><span style='color:green'>√</span></td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td class='td-manage'><a title='还原' target='_blank' href=restore?id="+array['id']+"&isorder="+array['isorder']+"><i class='fa fa-fw fa-edit'></i>还原</a> <a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a> </td></tr>"
                } else{
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['bingzhong'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td class='isorder'  rel='"+array['id']+"'>" + array['order'] + "</td><td><span style='color:red'>×</span></td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td class='td-manage'><a title='还原' target='_blank' href=restore?id="+array['id']+"&isorder="+array['isorder']+"><i class='fa fa-fw fa-edit'></i>还原</a> <a title='分诊'  rel='"+array['id']+"'  href='javascript:;'  class='fzicon'><i <i class='fa fa-fw fa-calendar-plus-o'></i>分诊</a> <a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a></td></tr>"
                }
				
              })
            }
			tr +="</tbody>"
            $("#ajax").append(tr)
          },
		  
		  complete: function() {
            getPageBar()
          },
          error: function() {
			  
			  $("#ajax").empty();
			  
			  alert("数据异常,请检查数据是否存在！");
			 
          }

			 }); 
       }
 function getPageBar() {
        if (curPage > totalPage) {
            curPage = totalPage
        }
        if (curPage < 1) {
            curPage = 1
        }
        var pageStr = "<div class='fy_fl col-md-3 col-sm-offset-2 col-xs-12'>共<span style='color:red;'>" + total + "</span>条<span>" + curPage + "/" + totalPage + "</span></div>";
        if (curPage == 1) { pageStr += "<div class='fy_fr col-md-5  col-xs-12'><span>首页</span><span>上一页</span>"
        } else {
            pageStr += "<div class='fy_fr col-md-5  col-xs-12'><span><a href='javascript:void(0)' rel='1'>首页</a></span><span><a href='javascript:void(0)' rel='" + (curPage - 1) + "'>上一页</a></span>"
        }
        if (curPage >= totalPage) {
            pageStr += "<span>下一页</span><span>尾页</span>"
        } else {
            pageStr += "<span><a href='javascript:void(0)' rel='" + (parseInt(curPage) + 1) + "'>下一页</a></span><span><a href='javascript:void(0)' rel='" + totalPage + "'>尾页</a></span>"
        }
          pageStr += "<input class='tiaozhuan' type='text' /> <button class='tiaozhuan_1' type='button'>跳转</button></div>";
        $("#pageNavs_sousuo").html(pageStr)
    }
	getData(1);
	$(document).on("click", ".fy_fr span a",function() {				 
	var rel = $(this).attr("rel");
	if (rel){
	return getData(rel)
	}
	
	});		    $(document).on("click", "#pageNavs_sousuo .tiaozhuan_1",function() {
	     var id=$("#pageNavs_sousuo .tiaozhuan").val();
		 if (id>0 && id<=totalPage) {
					return getData(id);
				}
    })				 					 
		
	});
	
	

});