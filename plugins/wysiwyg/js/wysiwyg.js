$(document).ready( function(){

document.getElementById("wysiwygeditor-content").addEventListener("keyup", function(e) {
	saveEdit();
	checkhtml();
});

$("ul.wysiwyg").hover( function(){
$(this).children(".wysiwyg-submenu").show();
}, function(){
$(this).children(".wysiwyg-submenu").fadeOut();
});



$('#wysiwygeditor-content').bind('DOMNodeInserted', function(event){
	checkhtml();
});

$(document).on('click', '.wysiwyg-content-element', function(){
	if($(this)[0]["nodeName"] == "IMG"){
	var xsize = $(this).width();
	var ysize = $(this).height();
	var element = $(this);
	
	var site = "../plugins/wysiwyg/edit.php?type=img&x-size=" + xsize + "&y-size=" + ysize;
	$('div').dialog('show', site, {
		inactivbox: true,
		callback: function(type) {
			$(".elem-edit").each(function(){
			element.attr( $(this).attr("data-effected_attribut"), $(this).val() );
			});
			saveEdit();
		}
	});
	}else if($(this)[0]["nodeName"] == "A"){

	
	var site = "../plugins/wysiwyg/edit.php?type=a";
	$('div').dialog('show', site, {
		inactivbox: true,
		callback: function(type) {
			$(".elem-edit").each(function(){
			element.attr( $(this).attr("data-effected_attribut"), $(this).val() );
			});
			execDatavalues();
			saveEdit();
		}
	});
	}

});

});

function saveEdit(){
   document.getElementById("form_inhalt").value = document.getElementById("wysiwygeditor-content").innerHTML;
   return true;
}
function format(command_name, command_value) {
   document.execCommand(command_name, false, command_value);
}
function checkhtml(){
	$("#wysiwygeditor-content").children().each( function(){
	$(this).addClass("wysiwyg-content-element");
	if($(this)[0]["nodeName"] == "IMG" || $(this)[0]["nodeName"] == "A" ){
	$(this).data("defaultborder", $(this).css("border"));
	$(this).hover( function(){
	console.log($(this).data("defaultborder"));
	$(this).css("border", "1px solid red");
	}, function(){
	$(this).css("border", $(this).data("defaultborder"));
	});
	}
	});
}
function execDatavalues(){
$(".wysiwyg-content-element").each( function(){
	$(this).attr("data-*").each( function(){
	alert($(this));
	});
	var special_attribut = $(this).data("data-special");
	if(special_attribut != ""){
	var special_type = $(this).data("data-special-type");
	var special_type = special_type.split("-");
		if(special_type[0] == "css"){
			$(this);
		}
		if(special_type[0] == "html"){
			$(this).html(special_attribut);
		}
		if(special_type[0] == "copyright"){
			$(this).attr("title", special_attribut);
		}
	}
	
});
}