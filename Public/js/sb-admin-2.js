$(function() {
    $('#side-menu').metisMenu();
	
	
});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        var topOffset = 50;
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
			var gaodu=$('.navbar-fixed-top').height();
			$('body').css('margin-top',gaodu);		
			
        } else {
			$('body').css('margin-top',50);	
            $('div.navbar-collapse').removeClass('collapse');
        }

        var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });


    var url = window.location;
    var element = $('ul.nav a').filter(function() {
		return this.href== url;
    }).addClass('active').parent();

    while (true) {
        if (element.is('li')) {
            element = element.parent().addClass('in').parent();
        } else {
            break;
        }
    }
	
	
});


function Setlist(orderby){
	document.getElementById("orderby").value = orderby;
	var way = document.getElementById("orderway");
	 if(way.value =='DESC' || way.value =='desc'){
		 way.value = orderway = 'ASC';
		 
	}else{
		way.value = orderway = 'DESC';
	}  
//	/Area/area_list/id/6.html

	//var url = $('#ajaxForm2').attr('action');
	//alert(url);
//		var url = order_ajax+"/orderby/"+orderby+"/orderway/"+orderway;
//		$('#ajaxForm2').attr('action',"/index.php/"+url+".html");
//		alert($('#ajaxForm2').attr('action'));
		

//	 $.ajax({
//          type: 'POST',
//          url: order_ajax,
//          data: {
//              'orderby': orderby,
//              'orderway': orderway
//          },
//          dataType: 'json',
//          success: function(json) {  
//          Result(data);
//      }
//  }); 
}