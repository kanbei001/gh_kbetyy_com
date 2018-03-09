$(function() {
      var total,pageSize,totalPage,quanxian,page,curPage,status;

    function getData(page) {
        var formtype = $('#formtype').val();  
        if(formtype=='long'){
            var data = $('.form-horizontal2').serializeArray(); 
        }else{
            var data = $('.form-horizontal').serializeArray();  
        }

        var orderby = $('#orderby').val();
        var orderway = $('#orderway').val();  //alert(orderby); alert(orderway);
        var tjdate = $('#tjdate').val();
        var date = $('#date').val();
       
        $.ajax({
            type: 'POST',
            url: search_ajax,
            data: {
                'pageNum': page - 1,
                'orderby': orderby,
                'orderway': orderway,
                'date': date,
                'tjdate': tjdate,
                'formtype':formtype,
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
                status=json.success; 
                totalPage = json.totalPage;
                // 预约情况
                var yyinfo = '<div class="col-md-5 col-md-offset-1 yyqk_left" style="display:block;">';
                if(tjdate ==''&&(formtype=='' ||formtype=='click') ){
                   if(date==4){
                     yyinfo +="<a href='"+json.yy_link+"' class=\"btn btn-default\" target=\"_blank\"><span>预到诊（<b>"+json.yy+"</b>）</span></a></div>";
                   }else{
                     yyinfo +="<a href='javascript:;' class=\"btn btn-default active\"><span>预约（"+json.yy+"）</span></a>";
                     yyinfo +="<a href='"+json.yy_link+"' class=\"btn btn-default\" target=\"_blank\"><span>录入（"+json.luru+"）</span></a>";
                     yyinfo +="<a href='"+json.yyshi_link+"' class=\"btn btn-default\" target=\"_blank\"><span>来院（<b>"+json.yyshi+"</b>）</span></a>";
                     yyinfo +="<a href='"+json.yyfou_link+"' class=\"btn btn-default\" target=\"_blank\"><span>未到（<b>"+json.yyfou+"</b>）</span></a></div>"; 
                   }
                    yyinfo +='<div class="col-md-5"> <a class="btn btn-default yylist" href="javascript:;" rel="0">本月<span class="yyh">('+json.total+')</span></a> <a class="btn btn-default yylist" href="javascript:;" rel="1">一周<span class="yyh">('+json.total+')</span></a> <a class="btn btn-default  yylist" href="javascript:;" rel="2">昨天<span class="yyh">('+json.total+')</span></a> <a class="btn btn-primary  yylist" href="javascript:;" rel="3">今天<span class="yyh">('+json.total+')</span></a> <a class="btn btn-default  yylist" href="javascript:;" rel="4">明天<span class="yyh">('+json.total+')</span></a><span><b>*</b>此处已预约时间为准</span> </div>'; 
               }else if(tjdate !=''&&formtype==''){
                    yyinfo += "<b>"+json.tjdate+'</b>&nbsp;录入&nbsp;<b>'+total+'</b>&nbsp;条记录[包含登记]！</div>'; 
                }else{
                   yyinfo += '</b>&nbsp;搜索到满足条件的&nbsp;<b>'+total+'</b>&nbsp;条记录[包含登记]！</div>'; 
                }
                $('#yyinfo').html(yyinfo);

                var tr = "";
                if(status==1){
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
                         }
                  tr += "</tbody>";
                  $("#ajax").append(tr);
                  $(".col-md-5 a.btn-primary").removeClass('btn-primary').addClass('btn-default');
                  $(".col-md-5 a[rel="+date+"]").children('span').css("display",'contents');
                  $(".col-md-5 a[rel="+date+"]").addClass('btn-primary');
               // $('.bootbox.modal').prop("outerHTML",'');
                  $('.bootbox.modal').css("display",'none');
                  $('.modal-backdrop').prop("outerHTML",'');
                  $('body').removeClass('modal-open');
            },
            complete: function() {
                if(status==1){
                        getPageBar();
                $('.tipso_style').tipso({useTitle: false,});
                    }
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
          pageStr += "<input class='tiaozhuan' type='text' /> <button class='tiaozhuan_1' type='button'>跳转</button></div>";
        $("#pageNavs_sousuo").html(pageStr)
    }
    
    $(document).on("click", "#search_btns",function() {
        getData(1)
    })
    
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
    $(document).on("click", ".yylist",function() {
        var rel = $(this).attr("rel");
        document.getElementById("date").value = rel;
        document.getElementById("formtype").value = 'click';
        return getData(1)
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