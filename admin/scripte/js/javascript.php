$(document).ready(function(){

$("#sidebar-toggleview").click( function(){
$("#sidebar").toggleClass("visible");
$("#contentframe").toggleClass("sidebaraffected");
});

$("#admin-sidebar-panel").children(".submenu-group").hover( function(){
$(this).children(".submenu").fadeIn("fast");
}, function(){
$(this).children(".submenu").fadeOut("fast");
});

	$("a.ajax").click( function(e){
	e.preventDefault();
	alert($(this).attr("href"));
	if($(this).attr("method") != ""){
	var method = $(this).attr("method");
	}else{
	var method = "GET";
	}
	$.ajax({
			type: method,
			url: $(this).attr("href"),
			success: function(data){
				alert(data);
				console.log(data);
				var obj = JSON.parse(data);
				if(obj.error == false){
					$('div').dialog('success', obj.msg);
					if(obj.location){
						location.replace(obj.location);
					}else{
						form.children('input[type=text]').val("");
						form.find('div[contenteditable=true]').html("");		
					}
				}else{
					$('div').dialog('error', obj.msg);
				}
			}
		});

	});
	
	$('form').submit(function(e){
	var form = $(this);
	e.preventDefault();
	$.ajax({
		type: $(this).attr("method"),
		url: $(this).attr("action"),
		data: $(this).serialize(),
		success: function(data){
			console.log(data);
			var obj = JSON.parse(data);
			if(obj.error == false){
				$('div').dialog('success', obj.msg);
				if(obj.location){
					location.replace(obj.location);
				}else{
					if(form.attr("data-type") == "new-content"){
						form.children('input[type=text]').val("");
						form.find('div[contenteditable=true]').html("");
					}					
				}
			}else{
				$('div').dialog('error', obj.msg);
			}
		}
	});
});
});