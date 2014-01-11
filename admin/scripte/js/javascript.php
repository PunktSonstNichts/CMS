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
	$.ajax({
			type: "GET",
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
});