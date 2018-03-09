$(function() {
    var total, pageSize, totalPage, quanxian, page, curPage;
    function getData(page) {
        $.ajax({
            type: 'POST',
            url: daoyi_ajax,
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
                totalPage = json.totalPage;
                var tr = "";
                var list = json.list;
                $.each(list,function(index, array) {
                	tr += "<tr><td bgcolor='#f1f1f1' class='tab_top_t'>" + array['yuyue'] + "</td><td bgcolor='#f1f1f1' class='tab_top_t'>" + array['username'] + "</td>";
                	tr += "<td bgcolor='#f1f1f1' class='tab_top_t'>" + array['phone'] + "</td><td bgcolor='#f1f1f1' class='tab_top_t'>" + array['bingzhong'] + "</td>";
                    if (array['laiyuan'] == '是') {
                    	tr += "<td bgcolor='#f1f1f1' class='tab_top_tr'>" + array['doctor'] + "</td></tr>";
                    } else {  
                        tr += "<td bgcolor='#f1f1f1' class='tab_top_tr'><a class='qr mfzicon' rel="+array['id']+" href='javascript:;'>确认</a></td></tr>";
                    }
                });
                $("#ajax").append(tr)
            },
            complete: function() {
                getPageBar()
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
    // $(document).on("click", "#pageNavs span a",function() {
    $("#pageNavs span a").click(function() {
        var rel = $(this).attr("rel");
        if (rel) {
            return getData(rel)
        }
    })
    // $(document).on("click", "#pageNavs .tiaozhuan_1",function() {
    $("#pageNavs .tiaozhuan_1").click(function() {
		var id=$("#pageNavs .tiaozhuan").val();
		if (id>0 && id<=totalPage) {
					return getData(id);
		}
    })
});