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
    // $(document).on("click", "#daoyi_btns",function() {
     $("#daoyi_btns").click(function(){
        var words = $('#words').val();
        if(words==''){
            alert('请输入关键词！');
        }else{
             getData(1);
        }
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
  //  alert(35486468);
    // $(document).on("click", ".settags",function() { 
    $(".settags").click(function(){
        var date = $(this).attr("data");
        $('#date').val(date);
        $(".settags").removeClass("hove");
        $(this).addClass('hove');
        getData(1);
    })
    // $(document).on("click", ".settags",function() {    alert(88888);
    //     var date = $(this).attr("data");
    //     $(".settags").removeClass("hove");
    //     $(this).addClass('hove');
    //     getData(1,date);

    // });
})