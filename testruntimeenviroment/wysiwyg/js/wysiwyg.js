$(document).ready( function(){


$(".wysiwygeditor-content").each( function() {
this.addEventListener("paste", function(e) {
    e.preventDefault();
    var text = e.clipboardData.getData("text/plain");
    document.execCommand("insertHTML", false, text);
});
});



});