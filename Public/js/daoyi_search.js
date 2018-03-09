$(function() {
    var total, pageSize, totalPage, quanxian, page, curPage;
    function getData(page) {
        var data = $('.form-horizontal').serializeArray();
        $.ajax({
            type: 'POST',
            url: daoyisearch_ajax,
            data: {
                'pageNum': page - 1,
                'data': data
            },
            dataType: 'json',
            success: function(json) {                
			    $("#ajax").empty();
				$("#pageNavs").empty();
				$("#pageNavs").hide();				
				$("#pageNavs_sousuo").empty();
				$("#pageNavs_sousuo").show();
                total = json.total;
                pageSize = json.pageSize;
                quanxian = json.quanxian;
                curPage = page;
                totalPage = json.totalPage;
                var tr = "";
                var list = json.list;
                $.each(list,function(index, array) {
                	var sex = array['sex']==1? '男':'女';
                	var comed = array['laiyuan']=='是'? "<span  style='color:green;'>√</span>":"<span  style='color:red;'>×</span>";
                	
                    tr += "<tr class='text-center'><td class='bookId'>"+array['yuyue']+"</td><td>"+array['username']+"</td><td>"+sex+"</td><td>"+array['age']+"</td>";
            	    tr += "<td>"+array['phone']+"</td><td>"+array['keshi']+"</td><td>"+array['bingzhong']+"</td><td>"+array['doctor']+"</td><td>"+array['time']+"</td>";
            	    tr += "<td>"+array['qq']+"</td><td>"+array['type_in']+"</td><td>"+comed+"</td><td>"+array['laiyuan_time']+"</td><td>"+array['in_time']+"</td><td class='td-manage'>";
                    if (array['laiyuan'] == '否') {
	              		tr += "<a href='javascript:;' onclick=\"showWindow('分诊','/index.php/Index/fenzhen/id/"+array['id']+".html')\"><i <i class='fa fa-fw fa-calendar-plus-o'></i>分诊</a>";
	              		if (quanxian <=3 ) {
	              		   tr += "<a href='javascript:;' onclick=\"showWindow('患者信息修改','/index.php/Index/edit/id/"+array['id']+".html')\"><i class='fa fa-fw fa-edit'></i>编辑</a>";
	              		}
	                }else{
	                	if (quanxian ==2 ) {
	              		   tr += "<a href='javascript:;' onclick=\"showWindow('患者信息修改','/index.php/Index/edit/id/"+array['id']+".html')\"><i class='fa fa-fw fa-edit'></i>编辑</a>";
	              		}
	                }
                	tr += "<a href='javascript:;' onclick=\"showWindow('详情','/index.php/Index/view/id/"+array['id']+".html')\"><i class='fa fa-fw fa-file-text-o'></i>详情</a></td></tr>";
                });
                $("#ajax").append(tr)
            },
            complete: function() {
                getPageBar()
            },
            error: function() {},
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
        if (curPage == 1) { 
        	pageStr += "<div class='fy_fr col-md-5  col-xs-12'><span>首页</span><span>上一页</span>"
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
    $(document).on("click", "#daoyi_btns",function() {
        getData(1)
    });
	 $(document).on("click", "#pageNavs_sousuo span a",function() {
        var rel = $(this).attr("rel");
        if (rel) {
            return getData(rel)
        }
    })
		    $(document).on("click", "#pageNavs_sousuo .tiaozhuan_1",function() {
	     var id=$("#pageNavs_sousuo .tiaozhuan").val();
		 if (id>0 && id<=totalPage) {
					return getData(id);
				}
		
    })
	/**
     * 排序
     */
    $(document).on("click", ".orderclick",function() { 
        var name = $(this).attr("name");
        document.getElementById("orderby").value = name;
        $('.orderclick').find("i.fa").attr("class",'');
				var way = document.getElementById("orderway");
				 if(way.value =='DESC' || way.value =='desc'){
					 way.value = orderway = 'ASC';
					 $(this).find("i").attr("class",'fa fa-sort-amount-asc')
				}else{
					way.value = orderway = 'DESC';
					$(this).find("i").attr("class",'fa fa-sort-amount-desc')
				}  
        return getData(1)
    })
    	    
})