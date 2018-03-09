function monthgoal_charts(){
//月到院目标完成情况
$.ajax({	
	type: 'POST',
	url: ajax_monthgoal_charts,
	dataType: 'json',
	success: function (data) {
	var series=[data.goalby,data.goalsy,data.goalssy];
	var categories= [data.benyuedate,data.shangyuedate,data.sshangyuedate];
	var yyweidao=[data.bywdnum,data.sywdnum,data.ssywdnum];
	var yidao=[data.byydnum,data.syydnum,data.ssyydnum];	
     $('#monthgoal_charts').highcharts({ 
	
        chart: {
            type: 'column'
        },
		legend: {
            borderColor: '#C98657',
            borderWidth: 1,
			borderRadius:5
        },
		credits: {
			 enabled:false 
        },
        title: {
           text:null    
        },
        xAxis: {
            categories:categories   
        },
        yAxis: {
            title: {
                text: '到院人数（人）'                
            },
	
        },

       tooltip: {
                     headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat:
                        '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y} 人</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
	   plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}人',
                            align: 'center',
                            style: {
                                fontSize: '12px',
								color: '#666'
                            }
                        }
                    }
                },
        series: [{
            name: '目标',
            data:series,
			color: '#92aecb'
        },
		
		{                  
            name: '预约',                          
            data: yyweidao,
			color: '#f7aeb0'
        }, {
            name: '到院',
            data:yidao,
			color: '#168B00' 
        }]
		
    });	

	 }

	 })	
	


}


	function getzxdydata(shijian){ 
   $.ajax({
      type: 'POST',
      url: zxdy_ajaxlist,
      data: {'riqi':shijian},
      dataType:'json',
	  
	   
      
      success:function(json){
	  $("#zxphb").empty();  
	   
     var tr = "<thead><tr><th style='border-left:0;'>占比</th><th>姓名</th><th>预约</th><th>到诊</th></tr></thead><tbody>";
   
		var list = json.list;
		
		 $.each(list,function(i,k){
			 tr += "<tr><td style='border-left:0;'>"+k['bfb']+"</td><td>"+k['name']+"</td><td>"+k['yynum']+"</td><td>"+k['lynum']+"</td></tr>"; 
			 }); 
			 
			  tr += "</tbody>"; 
			 
			  $("#zxphb").append(tr);
		  
		  },
	  
   });
  
}


function getqdxxdata(shijian){ 
   $.ajax({
      type: 'POST',
	  url: qdxx_ajaxlist,
      data: {'riqi':shijian},
      dataType:'json',
	  
	   
      
      success:function(json){
	  $("#qdxxphb").empty();  
	   
     var tr = "<thead><tr><th style='border-left:0;'>占比</th><th>渠道</th><th>预约</th><th>到诊</th></tr></thead><tbody>";
   
		var list = json.list;
		
		 $.each(list,function(i,k){
			 tr += "<tr><td style='border-left:0;'>"+k['bfb']+"</td><td>"+k['name']+"</td><td>"+k['yynum']+"</td><td>"+k['lynum']+"</td></tr>"; 
			 }); 
			   tr += "</tbody>"; 
			 
			  $("#qdxxphb").append(tr);
		  
		  },
	  
   });
  
}


function getlywzdata(shijian){ 
   $.ajax({
      type: 'POST',
	  url: lywz_ajaxlist,
      data: {'riqi':shijian},
      dataType:'json',
	  
	   
      
      success:function(json){
	  $("#lywzphb").empty();  
	   
     var tr = "<thead><tr><th style='border-left:0;'>占比</th><th>来源网站</th><th>预约</th><th>到诊</th></tr></thead><tbody>";
   
		var list = json.list;
		
		 $.each(list,function(i,k){
			 tr += "<tr><td style='border-left:0;'>"+k['bfb']+"</td><td>"+k['name']+"</td><td>"+k['yynum']+"</td><td>"+k['lynum']+"</td></tr>"; 
			 }); 
			 tr += "</tbody>";  
			  $("#lywzphb").append(tr);
		  
		  },
	  
   });
  
}



function getjiduchart(shijian) {
    $.ajax({
	  type: 'POST',
	  url: ajax_jiduchart,
      data: {'riqi':shijian},
      dataType:'json',
        beforeSend: function () {
            $('#jiduchartcontent').empty();
            $('#jiduchartcontent').html("loading...");
        },
        success: function (data) {
			 var nowDate=data.datess;
			 var categories=data.dydate;
	
			var jhdynums=data.jhdynums;
			var sjdynums=data.sjdynums;
			var sjyynums=data.sjyynums;
		
			

            $('#jiduchartcontent').highcharts({
                title: {
                    text: ''
                },
				legend: {
            borderColor: '#C98657',
            borderWidth: 1,
			borderRadius:5
        },
		credits: {
			 enabled:false 
        },
                xAxis: {
                    categories:categories
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '' + nowDate + '预约/到院人数 (人)'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">' + nowDate + '-{point.key}</span><table>',
                    pointFormat:
                        '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y} 人</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
             series: [{
            name: '计划到院人数',
            data:jhdynums,
			color: '#92aecb'
        },
		
		{                                 //指定数据列
            name: '实际到院人数',                          //数据列名
            data:sjdynums,
			color: '#168b00'                        //数据
        }, {
            name: '实际预约人数',
            data:sjyynums,
			color: '#f7aeb0' 
        }]
            });
        },
       
    });
}

$(function(){

monthgoal_charts();
getzxdydata('zxdy_zt');
getqdxxdata('qdxx_zt');	
getlywzdata('lywz_zt');

getjiduchart('jd_by');


$('#zxphb_nav').change(function(){ 
var rel=$(this).children('option:selected').val();

if(rel){
	return getzxdydata(rel);
	
	}


}) 


$('#qdxxphb_nav').change(function(){ 
var rel=$(this).children('option:selected').val();

if(rel){
	return getqdxxdata(rel);
	
	}


}) 


$('#lywzphb_nav').change(function(){ 
var rel=$(this).children('option:selected').val();

if(rel){
	return getlywzdata(rel);
	
	}


}) 


$('#jdinfo').change(function(){ 
var rel=$(this).children('option:selected').val();

if(rel){
	return getjiduchart(rel);
	
	}


})






















});