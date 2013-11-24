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

var url = "<?php ?>";
$.getScript( url, function() {
});

});