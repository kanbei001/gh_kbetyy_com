$(function() {
	var total,pageSize,totalPage,quanxian,page,curPage,status;
    function getData(page) {
        $.ajax({
            type: 'POST',
            url: hflist_ajax,
            data: {
                'pageNum': page - 1
            },
            dataType: 'json',
            success: function(json) {
                $("#ajax").empty();                
			        	$("#pageNavs").empty();
	            	$("#pageNavs").show();
			        	$("#pageNavs_sousuo").empty();
                $("#pageNavs_sousuo").hide();
                total = json.total;
                pageSize = json.pageSize;
                quanxian = json.quanxian;  
                curPage = page;
			        	status=json.success;   
                totalPage = json.totalPage;
                // 咨询回访情况
                var hfinfo = '<div class="col-md-5 col-md-offset-1 yyqk_left" style="display:block;">';
                    hfinfo +="<a href='javascript:;' class=\"btn btn-default\"><span>已回访（<b>"+json.hfshi+"</b>）</span></a>";
                    hfinfo +="<a href='"+json.hffou_link+"' class=\"btn btn-default\" target=\"_blank\"><span>未回访（<b>"+json.hffou+"</b>）</span></a></div>";
                    hfinfo +='<div class="col-md-5"> <a class="btn btn-default yylist" href="javascript:;" rel="-1">上月</a>&nbsp;<a class="btn btn-default yylist" href="javascript:;" rel="0">本月</a>&nbsp;<a class="btn btn-default yylist" href="javascript:;" rel="1">一周</a> <a class="btn btn-default  yylist" href="javascript:;" rel="2">昨天</a> <a class="btn btn-primary  yylist" href="javascript:;" rel="3">今天('+json.total+')</a> <a class="btn btn-default  yylist" href="javascript:;" rel="4">明天</a> <span class="nn"><b>*</b>此处已预约时间为准</span></div>'; 
                $('#hfinfo').html(hfinfo);




								if(status==1){
				var tr = "<thead><tr class='text-centerenter'><th>预约号</th><th>姓名</th><th>性别</th><th>年龄</th><th>电话</th><th>科室</th><th>医生</th><th>预约时间</th><th>地区</th><th>渠道</th><th>来源网站</th><th>信息渠道</th><th>来院</th><th>录入员</th><th>录入时间</th><th>回访状态</th><th>回访记录</th><th>操作</th></thead><tbody>";
                var list = json.list;
              if (quanxian == 1) {
              $.each(list,function(index, array) {
                if (array['laiyuan'] == '是') {
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['age'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['area'] + "</td><td>" + array['consult'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td>" + array['comed'] + "</td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td>" + array['huifang'] + "</td><td><span class='tipso_style' id='tipso_"+array['id']+"'  data-tipso='"+array['description2']+"'>" + array['description'] + "</span></td><td class='td-manage'><a  rel='"+array['id']+"' data-rel='"+array['isorder']+"'class='editicon'  href='javascript:;'title='编辑'><i class='fa fa-fw fa-edit'></i>编辑</a><a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a><a rel='"+array['id']+"' id='delinfo_"+array['id']+"' title='删除' class='delicon'  href='javascript:;'><i class='fa fa-fw fa-trash-o'></i>删除</a></td></tr>"
                } else {
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['age'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['area'] + "</td><td>" + array['consult'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td>" + array['comed'] + "</td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td>" + array['huifang'] + "</td><td><span class='tipso_style' id='tipso_"+array['id']+"'  data-tipso='"+array['description2']+"'>" + array['description'] + "</span></td><td class='td-manage'><a  rel='"+array['id']+"' data-rel='"+array['isorder']+"'class='editicon'  href='javascript:;'title='编辑'><i class='fa fa-fw fa-edit'></i>编辑</a><a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a><a rel='"+array['id']+"' id='delinfo_"+array['id']+"' title='删除' class='delicon'  href='javascript:;'><i class='fa fa-fw fa-trash-o'></i>删除</a></td></tr>"
                }
              })
            }
            if (quanxian == 2) {
              $.each(list,function(index, array) {
                if (array['laiyuan'] == '是') {
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['age'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['area'] + "</td><td>" + array['consult'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td>" + array['comed'] + "</td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td>" + array['huifang'] + "</td><td><span class='tipso_style' id='tipso_"+array['id']+"'  data-tipso='"+array['description2']+"'>" + array['description'] + "</span></td><td class='td-manage'><a  rel='"+array['id']+"' data-rel='"+array['isorder']+"'class='editicon'  href='javascript:;'title='编辑'><i class='fa fa-fw fa-edit'></i>编辑</a><a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a><a rel='"+array['id']+"' id='delinfo_"+array['id']+"' title='删除' class='delicon'  href='javascript:;'><i class='fa fa-fw fa-trash-o'></i>删除</a></td></tr>"
                } else{
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['age'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['area'] + "</td><td>" + array['consult'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td>" + array['comed'] + "</td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td>" + array['huifang'] + "</td><td><span class='tipso_style' id='tipso_"+array['id']+"'  data-tipso='"+array['description2']+"'>" + array['description'] + "</span></td><td class='td-manage'><a  rel='"+array['id']+"' data-rel='"+array['isorder']+"' class='editicon'  href='javascript:;'title='编辑'><i class='fa fa-fw fa-edit'></i>编辑</a><a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a><a rel='"+array['id']+"' id='delinfo_"+array['id']+"' title='删除' class='delicon'  href='javascript:;'><i class='fa fa-fw fa-trash-o'></i>删除</a></td></tr>"
                }
				
              })
            }
            if (quanxian == 3 || quanxian ==5){
              $.each(list,function(index, array) {
               
			   if (array['laiyuan'] == '是') {
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['age'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['area'] + "</td><td>" + array['consult'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td>" + array['comed'] + "</td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td>" + array['huifang'] + "</td><td><span class='tipso_style' id='tipso_"+array['id']+"'  data-tipso='"+array['description2']+"'>" + array['description'] + "</span></td><td class='td-manage'><a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a> </td></tr>"
                } else{
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['age'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['area'] + "</td><td>" + array['consult'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td>" + array['comed'] + "</td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td>" + array['huifang'] + "</td><td><span class='tipso_style' id='tipso_"+array['id']+"'  data-tipso='"+array['description2']+"'>" + array['description'] + "</span></td><td class='td-manage'> <a  rel='"+array['id']+"' data-rel='"+array['isorder']+"'class='editicon'  href='javascript:;'title='编辑'><i class='fa fa-fw fa-edit'></i>编辑</a><a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a></td></tr>"
                }
              })
            }
            if (quanxian == 4) {
              $.each(list,function(index, array) {
						   if (array['laiyuan'] == '是') {
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['age'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['area'] + "</td><td>" + array['consult'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td>" + array['comed'] + "</td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td>" + array['huifang'] + "</td><td><span class='tipso_style' id='tipso_"+array['id']+"'  data-tipso='"+array['description2']+"'>" + array['description'] + "</span></td><td class='td-manage'><a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a> </td></tr>"
                } else{
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['age'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['area'] + "</td><td>" + array['consult'] + "</td><td>" + array['source_web'] + "</td><td>" + array['info_channel'] + "</td><td>" + array['comed'] + "</td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td>" + array['huifang'] + "</td><td><span class='tipso_style' id='tipso_"+array['id']+"'  data-tipso='"+array['description2']+"'>" + array['description'] + "</span></td><td class='td-manage'><a title='分诊'  rel='"+array['id']+"'  href='javascript:;'  class='fzicon'><i <i class='fa fa-fw fa-calendar-plus-o'></i>分诊</a><a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a></td></tr>"
                }
				
              })
            }	
	
				tr += "</tbody>";
                $("#ajax").append(tr)
				
				}else{
					
					}
					
					
          },
		  
            complete: function() {
                 if(status==1){
				getPageBar();
                $('.tipso_style').tipso({useTitle: false,});
					}
            },
            error: function() {
                alert("数据异常,请检查是否json格式")
            }
        })
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
        $("#pageNavs").html(pageStr)
    }
    getData(1);
    $(document).on("click", "#pageNavs span a",function() {
        var rel = $(this).attr("rel");
        if (rel) {
            return getData(rel)
        }
    })
		    $(document).on("click", "#pageNavs .tiaozhuan_1",function() {
			var id=$("#pageNavs .tiaozhuan").val();
		if (id>0 && id<=totalPage) {
					return getData(id);
				}
    })
});