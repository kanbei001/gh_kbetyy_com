
$(function(){

    $('#download').click(function(){
        var company_id=$('select[name="company_id"]').val();
        var start_time=$('input[name="start_time"]').val();
        var end_time=$('input[name="end_time"]').val();
        var url=$(this).data('url').replace('_ID_',company_id).replace('_START_',start_time).replace('_END_',end_time);
        location.href=url;
    })

    $('#ajaxForm').ajaxForm({
        dataType:'json',
        success:function(data){
            Result(data);
        }
    });

    var w_height=$(window).height(); 
    if($('.container').css('height')>w_height){
        $('.container').css('padding-bottom',100);
    }
   

    $('input').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });

    $('#checkall').on('ifChecked',function(){
        $('input').iCheck('check');
    })
    $('#checkall').on('ifUnchecked',function(){
        $('input').iCheck('uncheck');
    })


    $('.form_date').datetimepicker({
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });


})

//退出登录
function logout(url){
    bootbox.setDefaults("locale","zh_CN"); 
    bootbox.confirm({
        className:'result_window',
        message:'<span class="fa fa-warning" aria-hidden="true"></span>确定要退出吗？',
        title:'<span class="fa fa-info-circle" aria-hidden="true"></span> 系统提示',
        callback:function(result){
            if(result){
                $.get(url,function(data){
                    Result(data);
                })
            }
        }
    });
}

//批量删除
function BatchDel(url){
    var ids=new Array();
    $('.checkall').each(function(){ 
        if($(this).prop('checked')){
            ids.push($(this).val());
        }
    })
    if(ids==''){
        bootbox.setDefaults("locale","zh_CN"); 
        bootbox.alert({
            className:'result_window',
            message:'<span class="fa fa-warning" aria-hidden="true"></span>请先选择要删除的项,再删除！',
            title:'<span class="fa fa-info-circle" aria-hidden="true"></span> 删除提示',
        });
        return false;
    }
    bootbox.setDefaults("locale","zh_CN"); 
    bootbox.confirm({
        className:'result_window',
        message:'<span class="fa fa-warning" aria-hidden="true"></span>确定要删除选中项吗？',
        title:'<span class="fa fa-info-circle" aria-hidden="true"></span> 删除提示',
        callback:function(result){
            if(result){
                $.get(url,{id:ids.join(",")},function(data){
                    Result(data);
                })
            }
        }
    });
}

//删除一条记录
function DelOne(info,url){
    bootbox.setDefaults("locale","zh_CN"); 
    bootbox.confirm({
        className:'result_window',
        message:'<span class="fa fa-warning" aria-hidden="true"></span>'+info,
        title:'<span class="fa fa-info-circle" aria-hidden="true"></span> 删除提示',
        callback:function(result){
            if(result){
                $.get(url,function(data){
                    Result(data);
                })
            }
        }
    });
}

function showWindow(title,url){
    $.get(url,function(data){
        bootbox.setDefaults("locale","zh_CN"); 
        bootbox.dialog({
            message:data,
            title:'<span class="fa fa-info-circle" aria-hidden="true"></span> '+title
        });
    })
    
}


// 处理结果
function Result(data){
   if(data.status>0){
        if(data.info==''){
            window.location.href=data.url;
        }else{
            bootbox.setDefaults("locale","zh_CN"); 
            bootbox.alert({
                className:'result_window',
                message:'<span class="fa fa-check-square-o" aria-hidden="true"></span>'+data.info,
                title:'<span class="fa fa-info-circle" aria-hidden="true"></span> 系统提示',
                callback:function(){
                    window.location.href=data.url;
                }
            });
        }
   }else if(data.status==0){
        bootbox.setDefaults("locale","zh_CN"); 
        bootbox.alert({
            className:'result_window',
            message:'<span class="fa fa-warning" aria-hidden="true"></span>'+data.info,
            title:'<span class="fa fa-info-circle" aria-hidden="true"></span> 系统提示',
        });
        return false;
   }
}