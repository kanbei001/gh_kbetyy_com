$(function() {
    var total, pageSize, totalPage, quanxian, page, curPage,status;
    function getData(page) {
    	var tjdate = $('#tjdate').val(); 
        $.ajax({
            type: 'POST',
            url: right_ajax,
            data: {
                'pageNum': page - 1,
                'tjdate' :tjdate,
                'pageSize' :100
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
                // 预约情况
                var yyinfo = '<div class="col-md-5 col-md-offset-1 yyqk_left" style="display:block;">';
                if(tjdate ==''){
                    yyinfo +="<a href='javascript:;' class=\"btn btn-default active\"><span>预约（<b>"+json.yy+"</b>）</span></a>";
                    yyinfo +="<a href='"+json.yy_link+"' class=\"btn btn-default\" target=\"_blank\"><span>录入（<b>"+json.luru+"</b>）</span></a>";
                    yyinfo +="<a href='"+json.yyshi_link+"' class=\"btn btn-default\" target=\"_blank\"><span>来院（<b>"+json.yyshi+"</b>）</span></a>";
                    yyinfo +="<a href='"+json.yyfou_link+"' class=\"btn btn-default\" target=\"_blank\"><span>未到（<b>"+json.yyfou+"</b>）</span></a></div>";
                    yyinfo +='<div class="col-md-5"> <a class="btn btn-default yylist" href="javascript:;" rel="0">本月</a> <a class="btn btn-default yylist" href="javascript:;" rel="1">一周</a> <a class="btn btn-default  yylist" href="javascript:;" rel="2">昨天</a> <a class="btn btn-primary  yylist" href="javascript:;" rel="3">今天('+json.total+')</a> <a class="btn btn-default  yylist" href="javascript:;" rel="4">明天</a> <span class="nn"><b>*</b>此处已预约时间为准</span></div>'; 
	            }else{
	            	yyinfo += "<b>"+json.tjdate+'</b>&nbsp;录入&nbsp;<b>'+total+'</b>&nbsp;条记录！</div>'; 
	            }
	            $('#yyinfo').html(yyinfo);
				if(status==1){
	                var tr = "";
	                var list = json.list;
	                $.each(list,function(index, array) {
	                	var sex = array['sex']==1? '男':'女';
	                	var order = array['isorder']==1? "<span  style='color:green;'>√</span>":"<span  style='color:red;'>×</span>";
	                	var comed = array['laiyuan']=='是'? "<span  style='color:green;'>√</span>":"<span  style='color:red;'>×</span>";
	              	    tr += "<tr class='text-center'><td class='bookId'>"+array['yuyue']+"</td><td>"+array['username']+"</td><td name='sex'>"+sex+"</td><td name='phone'>"+array['phone']+"</td>";
	              	    tr += "<td name='keshi'>"+array['keshi']+"</td><td name='bingzhong'>"+array['bingzhong']+"</td><td name='time'>"+array['time']+"</td><td name='area'>"+array['area']+"</td><td name='consult'>"+array['consult']+"</td>";
	              	    tr += "<td name='qq'>"+array['qq']+"</td><td name='source_web'>"+array['source_web']+"</td><td name='info_channel'>"+array['info_channel']+"</td><td name='isorder'>"+order+"</td><td name='type_in'>"+array['type_in']+"</td>";
	              	    tr += "<td name='laiyuan'>"+comed+"</td><td name='laiyuan_time'>"+array['laiyuan_time']+"</td><td name='in_time'>"+array['in_time']+"</td>";
	              	    if (array['huifang'] == '否') { 
	              	        tr += "<td name='huifang'>"+array['huifang']+"</td><td class='td-manage'>";
	              	     }else{
	              	        tr += "<td name='huifang' title='"+array['remark']+"'>"+array['huifang']+"☆</td><td class='td-manage'>";
	              	     }
	              	  
		              	if (array['laiyuan'] == '否') {
                            if (quanxian <=2 ) {
                               tr += "<a href='javascript:;' onclick=\"showWindow('分诊','/index.php/Index/fenzhen/id/"+array['id']+".html')\"><i <i class='fa fa-fw fa-calendar-plus-o'></i>分诊</a>";
                            }
		              		if (quanxian <=3 ) {
		              		   tr += "<a href='javascript:;' onclick=\"showWindow('患者信息修改','/index.php/Index/edit/id/"+array['id']+".html')\"><i class='fa fa-fw fa-edit'></i>编辑</a>";
		              		}
		                }else{
		                	if (quanxian <=2 ) {
		              		   tr += "<a href='javascript:;' onclick=\"showWindow('患者信息修改','/index.php/Index/edit/id/"+array['id']+".html')\"><i class='fa fa-fw fa-edit'></i>编辑</a>";
		              		}
		                }
		              	tr += "<a href='javascript:;' onclick=\"showWindow('患者详情','/index.php/Index/view/id/"+array['id']+".html')\"><i class='fa fa-fw fa-file-text-o'></i>详情</a>";
		                if (quanxian <= 2) {
		              	   tr += "<a href='javascript:;' onclick=\"DelOne('您确定要删除ID为["+array['id']+"]的记录吗？','/index.php/Index/del/id/"+array['id']+".html')\"><i class='fa fa-fw fa-trash-o'></i>删除</a></td></tr>";
	                    }
	                })
	                $("#ajax").append(tr)
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