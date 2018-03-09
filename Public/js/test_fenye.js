 $(function() {
	 var total, pageSize, totalPage, quanxian,curPage;
	  function getData(page){
		$.ajax({
			
		  type: 'POST',
          url: right_ajax,
		 data: {'pageNum':page-1},
		 dataType: 'json',
		     success: function(json) {
            $("#ajax").empty();
            total = json.total;

            pageSize = json.pageSize;
            quanxian = json.quanxian;
            curPage = page;
            totalPage = json.totalPage;
            var tr = "<thead><tr class='text-centerenter'><th>预约号</th><th>姓名</th><th>性别</th><th>电话</th><th>科室</th><th>病种</th><th>医生</th><th>预约时间</th><th>渠道</th><th>qq</th><th>来源网站</th><th>信息渠道</th><th>来院</th><th>录入员</th><th>录入时间</th><th>操作</th></thead>";
            var list = json.list;
           if (quanxian == 1) {
              $.each(list,function(index, array) {
                if (array['laiyuan'] == '是') {
                  tr += "<tbody><tr class='text-center'><td>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['bingzhong'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td><span style='color:green'>√</span></td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td class='td-manage'><a title='编辑' target='_blank'  href=yyedit?id="+array['id']+"><i class='fa fa-fw fa-edit'></i>编辑</a> <a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a> <a title='删除'  onclick='return confirmAct();' href=yydel?id="+array['id']+"><i class='fa fa-fw fa-trash-o'></i>删除</a></td></tr></tbody>"
                } else {
                  tr += "<tbody><tr class='text-center'><td>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['bingzhong'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td><span style='color:red'>×</span></td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td class='td-manage'><a title='编辑' target='_blank'  href=yyedit?id="+array['id']+"><i class='fa fa-fw fa-edit'></i>编辑</a> <a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a> <a title='删除'  onclick='return confirmAct();' href=yydel?id="+array['id']+"><i class='fa fa-fw fa-trash-o'></i>删除</a></td></tr></tbody>"
                }
              })
            }
            if (quanxian == 2) {
              $.each(list,function(index, array) {
                if (array['laiyuan'] == '是') {
                  tr += "<tbody><tr class='text-center'><td>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['bingzhong'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td><span style='color:green'>√</span></td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td class='td-manage'><a title='编辑' target='_blank'  href=yyedit?id="+array['id']+"><i class='fa fa-fw fa-edit'></i>编辑</a> <a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a> <a title='删除'  onclick='return confirmAct();' href=yydel?id="+array['id']+"><i class='fa fa-fw fa-trash-o'></i>删除</a></td></tr></tbody>"
                } else{
                  tr += "<tbody><tr class='text-center'><td>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['bingzhong'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td><span style='color:red'>×</span></td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td class='td-manage'><a title='编辑' target='_blank'  href=yyedit?id="+array['id']+"><i class='fa fa-fw fa-edit'></i>编辑</a> <a title='回访'  rel='"+array['id']+"'  href='javascript:;'  class='hficon'><i <i class='fa fa-fw fa-calendar-plus-o'></i>回访</a> <a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a> <a title='删除'  onclick='return confirmAct();' href=yydel?id="+array['id']+"><i class='fa fa-fw fa-trash-o'></i>删除</a></td></tr></tbody>"
                }
				
              })
            }
            if (quanxian == 3) {
              $.each(list,function(index, array) {
               
			   if (array['laiyuan'] == '是') {
                  tr += "<tbody><tr class='text-center'><td>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['bingzhong'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td><span style='color:green'>√</span></td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td class='td-manage'><a title='编辑' target='_blank'  href=yyedit?id="+array['id']+"><i class='fa fa-fw fa-edit'></i>编辑</a> <a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a> </td></tr></tbody>"
                } else{
                  tr += "<tbody><tr class='text-center'><td>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['bingzhong'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td><span style='color:red'>×</span></td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td class='td-manage'><a title='编辑' target='_blank'  href=yyedit?id="+array['id']+"><i class='fa fa-fw fa-edit'></i>编辑</a> <a title='回访'  rel='"+array['id']+"'  href='javascript:;'  class='hficon'><i <i class='fa fa-fw fa-calendar-plus-o'></i>回访</a> <a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a></td></tr></tbody>"
                }
              })
            }
            if (quanxian == 4) {
              $.each(list,function(index, array) {
						   if (array['laiyuan'] == '是') {
                  tr += "<tbody><tr class='text-center'><td>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['bingzhong'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td><span style='color:green'>√</span></td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td class='td-manage'><a title='编辑' target='_blank'  href=yyedit?id="+array['id']+"><i class='fa fa-fw fa-edit'></i>编辑</a> <a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a> </td></tr></tbody>"
                } else{
                  tr += "<tbody><tr class='text-center'><td>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['bingzhong'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td><span style='color:red'>×</span></td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td class='td-manage'><a title='编辑' target='_blank'  href=yyedit?id="+array['id']+"><i class='fa fa-fw fa-edit'></i>编辑</a> <a title='分诊'  rel='"+array['id']+"'  href='javascript:;'  class='fzicon'><i <i class='fa fa-fw fa-calendar-plus-o'></i>分诊</a> <a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a></td></tr></tbody>"
                }
				
              })
            }
            $("#ajax").append(tr)
          },
		  
		  complete: function() {
            getPageBar()
          },
          error: function() {
            alert("数据异常,请检查是否json格式")
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
        var pageStr = "<div class='fy_fl'>共<span style='color:red;'>" + total + "</span>条<span>" + curPage + "/" + totalPage + "</span></div>";
        if (curPage == 1) {
          pageStr += "<div class='fy_fr'><span>首页</span><span>上一页</span>"
        } else {
          pageStr += "<div class='fy_fr'><span><a href='javascript:void(0)' rel='1'>首页</a></span><span><a href='javascript:void(0)' rel='" + (curPage - 1) + "'>上一页</a></span>"
        }
        if (curPage >= totalPage) {
          pageStr += "<span>下一页</span><span>尾页</span>"
        } else {
          pageStr += "<span><a href='javascript:void(0)' rel='" + (parseInt(curPage) + 1) + "'>下一页</a></span><span><a href='javascript:void(0)' rel='" + totalPage + "'>尾页</a></span>"
        }
        pageStr += "</div>";
        $("#pageNavs").html(pageStr)
      }
				 
	getData(1);
	$(document).on("click", ".fy_fr span a",function() {				 
	$("#ajax").empty();
	$("#pageNavs").empty();
	var rel = $(this).attr("rel");
	if (rel){
	return getData(rel)
	}
	
	});					 					 
		


});