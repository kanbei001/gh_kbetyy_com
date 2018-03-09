function datadel() {
  var ids = '';
  $('.ckb').each(function() {
    if ($(this).is(':checked')) {
      ids += ',' + $(this).val()
    }
  });
  ids = ids.substring(1);
  if (ids.length == 0) {
    alert('请选择要删除的选项')
  } else {
    if (confirm("确定删除？删除后将无法恢复。")) {
      $.ajax({
        type: 'POST',
        url: delall_ajax,
        data: {
          'delid': ids,
        },
        dataType: 'json',
        success: function(json) {
          if (json.result == 1) {
            alert('批量删除成功！');
            location.reload()
          } else {
            alert('批量删除失败，请重试！')
          }
        },
      })
    }
  }
}