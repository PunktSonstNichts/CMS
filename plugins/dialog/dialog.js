//**
// (c) Till Meyer-Arlt's dialog.js designed for MasterCMS
//**

function lockScroll(){
console.log("locked");
    var initWidth = $("body").outerWidth();
    var initHeight = $("body").outerHeight();

    var scrollPosition = [
        self.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft,
        self.pageYOffset || document.documentElement.scrollTop  || document.body.scrollTop
    ];
    $("html").data('scroll-position', scrollPosition);
    $("html").data('previous-overflow', $("html").css('overflow'));
    $("html").css('overflow', 'hidden');
    window.scrollTo(scrollPosition[0], scrollPosition[1]);   
		
    var marginR = $("body").outerWidth()-initWidth;
    var marginB = $("body").outerHeight()-initHeight; 
    $("body").css({'margin-right': marginR,'margin-bottom': marginB});
}

function unlockScroll(){
	var scrollPosition = $("html").data('scroll-position');
    $("html").css('overflow', $("html").data('previous-overflow'));
    window.scrollTo(scrollPosition[0], scrollPosition[1]);    
    $("body").css({'margin-right': 0, 'margin-bottom': 0});
	$("body").unbind('scroll');
}

(function( $ ){

  var methods = {
    init : function( options ) {
		
      $('<div id="dialog"><div id="close">&times;</div><div id="dialog_content"></div></div>').prependTo("body");
	  $('<div id="inactiv_box"></div>').insertBefore("#dialog");
	  $("#dialog").hide();
	  $("#inactiv_box").hide();
	  $("#close").click( function(e){
		$("#dialog").slideUp(700, function() {
			$("#dialog").removeClass("success").removeClass("error").removeClass("greenfile").removeClass("redfile").removeClass("yellowfile").removeClass("bluefile");
		});
		$("#inactiv_box").fadeOut();
		$(this).html("&times;");
		e.stopPropagation();
		unlockScroll();
	  });
    },
    show : function( file, options ){
			  var settings = {
                agree: "#agree",
				close: "#close",
				areyousure: "#commit",
				color: "yellow",
				inactivbox: true,
				callback: function() {},
				ajaxform: true,
				formname: ".dialog" // if ajaxform = true
            }
            var opt = $.extend(settings, options);

	if(opt.inactivbox == true){
		var top = $(window).scrollTop();
	$("#inactiv_box").fadeIn().css("margin-top", top);
		lockScroll();
	}	
	 
	 
       $("#dialog_content").load(file, function(response, status, xhr){
		if (status == "error") {
			console.log("Da lief etwas schief: " + xhr.status + " " + xhr.statusText + " - (" + file + ")");
		}else{
			$(opt.agree).click( function(e){
				$("#dialog").slideUp().removeClass("success").removeClass("error").removeClass("file");
				$("#inactiv_box").fadeOut();
				e.stopPropagation();
				if (typeof callback == 'function') {
					settings.callback.call(thisArg, e);
				}
				unlockScroll();
			});
			$(opt.close).click( function(e){
				$("#dialog").slideUp().removeClass("success").removeClass("error").removeClass("file");
				$("#inactiv_box").fadeOut();
				e.stopPropagation();
				if (typeof callback == 'function'){
					settings.callback.call(thisArg, e);
				}
				settings.callback.call(e);
				unlockScroll();
			});
		
			if(opt.ajaxform = true){
				$(opt.formname).on("submit", function(event){
					event.preventDefault();
					dataarray = [];
					
					$(opt.formname).children("input").each( function(){
						var newdata = $(this).attr("name") +"="+ $(this).val();
						 dataarray.push(newdata);
					});			
					var data = dataarray.join("&");
					var formtype = $(opt.formname).attr("method");
					var formurl = $(opt.formname).attr("action");
	
					$.ajax({
						url: formurl,
						type: formtype,		
						data: data,	
						success: function (response){
							console.log(response);
						}
					});
		
					event.preventDefault();
				});
			}
		}
		});
	 
    },
    error : function( content ) { 
      $("#dialog").removeClass("success").addClass("error").fadeIn();
      $("#inactiv_box").fadeIn();
	  $("#dialog_content").html(content);
	  $("#close").html("Okay");
    },
    success : function( content ) {
      $("#dialog").addClass("success").fadeIn().delay(1800).slideUp();
	  $("#dialog_content").html(content);
	  $("#close").html("");
    }
  };

  $.fn.dialog = function( method ) {
    if ( methods[method] ) {
      return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
    } else if ( typeof method === 'object' || ! method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error( 'Method ' +  method + " does not exist on the dialog.js" );  
	}
  };

})( jQuery );