 $(function() {
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
	
	$(document).on("change", "#keshi",function() {	
      var keshi_val = $("#keshi").val();
      $.ajax({
        type: 'POST',
        url: bzxuanzhe_ajax,
        data: {
          'keshi_val': keshi_val
        },
        dataType: 'json',
        success: function(json) {
          $("#bingzhong").empty();
          var list = json.list;
        var option = "";
          $.each(list,
          function(index, array) {
            option += "<option value='" + array['id'] + "'>" + array['bingzhong_name'] + "</option>"
          });
          $("#bingzhong").append(option)
        }
      })
    });
	
		$(document).on("change", "#keshi1",function() {	
      var keshi_val = $("#keshi1").val();
      $.ajax({
        type: 'POST',
        url: bzxuanzhe_ajax,
        data: {
          'keshi_val': keshi_val
        },
        dataType: 'json',
        success: function(json) {
          $("#bingzhong1").empty();
          var list = json.list;
        var option = "";
          $.each(list,
          function(index, array) {
            option += "<option value='" + array['id'] + "'>" + array['bingzhong_name'] + "</option>"
          });
          $("#bingzhong1").append(option)
        }
      })
    });
	
	

$(".yyqk_right .btn").click(function(){			
$(this).removeClass("btn-default").addClass("btn-primary").siblings().removeClass("btn-primary").addClass("btn-default");
$(".yyqk_left").hide();
$(".yyqk_left").eq($(this).index()).show();
			   
})


	 })