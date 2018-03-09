$(function() {
	var total,pageSize,totalPage,quanxian,page,curPage;
    $("#selectConsultMethod").click(function() {
        $("#selectConsultMethod option:selected").appendTo("#selectConsultMethod_1")
    });
    $("#selectConsultMethod_1").click(function() {
        $("#selectConsultMethod_1 option:selected").appendTo("#selectConsultMethod")
    });
    $("#selectLocation").click(function() {
        $("#selectLocation option:selected").appendTo("#selectLocation_1")
    });
    $("#selectLocation_1").click(function() {
        $("#selectLocation_1 option:selected").appendTo("#selectLocation")
    });
    $("#selectMarketingMethod").click(function() {
        $("#selectMarketingMethod option:selected").appendTo("#selectMarketingMethod_1")
    });
    $("#selectMarketingMethod_1").click(function() {
        $("#selectMarketingMethod_1 option:selected").appendTo("#selectMarketingMethod")
    });
    $("#selectWebSite").click(function() {
        $("#selectWebSite option:selected").appendTo("#selectWebSite_1")
    });
    $("#selectWebSite_1").click(function() {
        $("#selectWebSite_1 option:selected").appendTo("#selectWebSite")
    });
    $("#selectInformationChannel").click(function() {
        $("#selectInformationChannel option:selected").appendTo("#selectInformationChannel_1")
    });
    $("#selectInformationChannel_1").click(function() {
        $("#selectInformationChannel_1 option:selected").appendTo("#selectInformationChannel")
    });
    function getData(page) {
        var yuyue = $('#yuyue').val();
        var username = $('#username').val();
        var phone = $('#phone').val();
        var in_time = $('#type_in_strat').val();
        var end_time = $('#type_in_end').val();
        var qq = $('#qq').val();
        var keshi = $('#keshi').find("option:selected").val();
        var laiyuan_star = $('#laiyuan_strat').val();
        var laiyuan_end = $('#laiyuan_end').val();
        var laiyuan = $('#laiyuan').find("option:selected").text();
        var chakan = $('#zxylist').find("option:selected").val();
        var yuyue_time = $('#yuyue_strat').val();
        var end_yuyue = $('#yuyue_end').val();
        var huifang = $('#huifang').find("option:selected").val();
        var isorder = $('#isorder').find("option:selected").val();
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
        $.ajax({
            type: 'POST',
            url: search_ajax,
            data: {
                'pageNum': page - 1,
                'yuyue': yuyue,
                'username': username,
                'phone': phone,
                'in_time': in_time,
                'end_time': end_time,
                'keshi': keshi,
                'laiyuan': laiyuan,
                'laiyuan_star': laiyuan_star,
                'laiyuan_end': laiyuan_end,
                'chakan': chakan,
                'yuyue_time': yuyue_time,
                'end_yuyue': end_yuyue,
                'diqu': diqu,
                'web': web,
                'qq': qq,
                'huifang': huifang,
                'isorder': isorder,
                'zixun': zixun,
                'yingxiao': yingxiao,
                'qudao': qudaos
            },
            dataType: 'json',
            success: function(json) {
                $("#ajax").hide();
                $("#pageNavs").hide();
                $("#ajax").empty();
                $("#pageNavs").empty();
                $("#pageNavs_sousuo").empty();
                $("#ajax_sousuo").empty();
                total = json.total;
                pageSize = json.pageSize;
                quanxian = json.quanxian;
                curPage = page;
                totalPage = json.totalPage;
                var tr = "<thead><tr class='text-centerenter'><th>预约号</th><th>姓名</th><th>性别</th><th>年龄</th><th>电话</th><th>科室</th><th>医生</th><th>3预约时间</th><th>地区</th><th>渠道</th><th>qq</th><th>来院</th><th>录入员</th><th>录入时间</th><th>回访状态</th><th>回访记录</th><th>操作</th></thead><tbody>";
                var list = json.list;
              if (quanxian == 1) {
              $.each(list,function(index, array) {
                if (array['laiyuan'] == '是') {
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['age'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['area'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['comed'] + "</td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td>" + array['huifang'] + "</td><td><span class='tipso_style' id='tipso_"+array['id']+"'  data-tipso='"+array['description2']+"'>" + array['description'] + "</span></td><td class='td-manage'><a  rel='"+array['id']+"' data-rel='"+array['isorder']+"'class='editicon'  href='javascript:;'title='编辑'><i class='fa fa-fw fa-edit'></i>编辑</a><a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a><a rel='"+array['id']+"' id='delinfo_"+array['id']+"' title='删除' class='delicon'  href='javascript:;'><i class='fa fa-fw fa-trash-o'></i>删除</a></td></tr>"
                } else {
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['age'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['area'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['comed'] + "</td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td>" + array['huifang'] + "</td><td><span class='tipso_style' id='tipso_"+array['id']+"'  data-tipso='"+array['description2']+"'>" + array['description'] + "</span></td><td class='td-manage'><a  rel='"+array['id']+"' data-rel='"+array['isorder']+"'class='editicon'  href='javascript:;'title='编辑'><i class='fa fa-fw fa-edit'></i>编辑</a><a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a><a rel='"+array['id']+"' id='delinfo_"+array['id']+"' title='删除' class='delicon'  href='javascript:;'><i class='fa fa-fw fa-trash-o'></i>删除</a></td></tr>"
                }
              })
            }
            if (quanxian == 2) {
              $.each(list,function(index, array) {
                if (array['laiyuan'] == '是') {
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['age'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['area'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['comed'] + "</td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td>" + array['huifang'] + "</td><td><span class='tipso_style' id='tipso_"+array['id']+"'  data-tipso='"+array['description2']+"'>" + array['description'] + "</span></td><td class='td-manage'><a  rel='"+array['id']+"' data-rel='"+array['isorder']+"'class='editicon'  href='javascript:;'title='编辑'><i class='fa fa-fw fa-edit'></i>编辑</a><a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a><a rel='"+array['id']+"' id='delinfo_"+array['id']+"' title='删除' class='delicon'  href='javascript:;'><i class='fa fa-fw fa-trash-o'></i>删除</a></td></tr>"
                } else{
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['age'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['area'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['comed'] + "</td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td>" + array['huifang'] + "</td><td><span class='tipso_style' id='tipso_"+array['id']+"'  data-tipso='"+array['description2']+"'>" + array['description'] + "</span></td><td class='td-manage'><a  rel='"+array['id']+"' data-rel='"+array['isorder']+"' class='editicon'  href='javascript:;'title='编辑'><i class='fa fa-fw fa-edit'></i>编辑</a><a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a><a rel='"+array['id']+"' id='delinfo_"+array['id']+"' title='删除' class='delicon'  href='javascript:;'><i class='fa fa-fw fa-trash-o'></i>删除</a></td></tr>"
                }
				
              })
            }
            if (quanxian == 3) {
              $.each(list,function(index, array) {
               
			   if (array['laiyuan'] == '是') {
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['age'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['area'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['comed'] + "</td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td>" + array['huifang'] + "</td><td><span class='tipso_style' id='tipso_"+array['id']+"'  data-tipso='"+array['description2']+"'>" + array['description'] + "</span></td><td class='td-manage'><a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a> </td></tr>"
                } else{
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['age'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['area'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['comed'] + "</td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td>" + array['huifang'] + "</td><td><span class='tipso_style' id='tipso_"+array['id']+"'  data-tipso='"+array['description2']+"'>" + array['description'] + "</span></td><td class='td-manage'> <a  rel='"+array['id']+"' data-rel='"+array['isorder']+"'class='editicon'  href='javascript:;'title='编辑'><i class='fa fa-fw fa-edit'></i>编辑</a><a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a></td></tr>"
                }
              })
            }
            if (quanxian == 4) {
              $.each(list,function(index, array) {
						   if (array['laiyuan'] == '是') {
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['age'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['area'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['comed'] + "</td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td>" + array['huifang'] + "</td><td><span class='tipso_style' id='tipso_"+array['id']+"'  data-tipso='"+array['description2']+"'>" + array['description'] + "</span></td><td class='td-manage'><a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a> </td></tr>"
                } else{
                  tr += "<tr class='text-center'><td class='bookId'>" + array['yuyue'] + "</td><td>" + array['username'] + "</td><td>" + array['sex'] + "</td><td>" + array['age'] + "</td><td>" + array['phone'] + "</td><td>" + array['keshi'] + "</td><td>" + array['doctor'] + "</td><td>" + array['time'] + "</td><td>" + array['area'] + "</td><td>" + array['consult'] + "</td><td>" + array['qq'] + "</td><td>" + array['comed'] + "</td><td>" + array['type_in'] + "</td><td>" + array['in_time'] + "</td><td>" + array['huifang'] + "</td><td><span class='tipso_style' id='tipso_"+array['id']+"'  data-tipso='"+array['description2']+"'>" + array['description'] + "</span></td><td class='td-manage'><a title='分诊'  rel='"+array['id']+"'  href='javascript:;'  class='fzicon'><i <i class='fa fa-fw fa-calendar-plus-o'></i>分诊</a><a rel='"+array['id']+"' class='xqinfoicon'  href='javascript:;' title='详情'><i class='fa fa-fw fa-file-text-o'></i>详情</a></td></tr>"
                }
				
              })
            }
		
				tr += "</tbody>";
                $("#ajax_sousuo").append(tr)
            },
            complete: function() {
                getPageBar();
                $('.tipso_style').tipso({
                    useTitle: false,
                })
            },
            error: function() {}
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
        pageStr += "</div>";
        $("#pageNavs_sousuo").html(pageStr)
    }
	
    $(document).on("click", "#search_btns",function() {
        getData(1)
    })
	
    $(document).on("click", "#pageNavs_sousuo span a",function() {
        $("#ajax").empty();
        $("#pageNavs").empty();
        var rel = $(this).attr("rel");
        if (rel) {
            return getData(rel)
        }
    })
})