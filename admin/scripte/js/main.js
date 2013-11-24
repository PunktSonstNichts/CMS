(function( $ ){

  var methods = {
    init : function( options ) {
		
      $('<div id="dialog-helper"><div id="dialog"></div></div><div id="inactiv-overlay"></div>').prependTo("body");
	  $("#dialog").fadeOut();
	  $("#inactiv-overlay").fadeOut();
	  $("#close").click( function(e){
		$("#dialog").slideUp(700, function() {
			$("#dialog").removeClass("success").removeClass("error").removeClass("greenfile").removeClass("redfile").removeClass("yellowfile").removeClass("bluefile");
		});
		$("#inactiv-overlay").fadeOut();
		e.stopPropagation();
	  });
    },
    show : function( file, options ){
			  var settings = {
                agree: ".btn-success",
				close: ".btn-danger",
				areyousure: "#commit",
				inactivbox: true,
				callback: function() {},
				ajaxform: false,
				formname: ".dialog" // if ajaxform = true
            }
            var opt = $.extend(settings, options);

	if(opt.inactivbox == true){
    var top = $(window).scrollTop();
	$("#inactiv-overlay").fadeIn().css("margin-top", top);
	}	
	 

	 
       $("#dialog").load(file, function(response, status, xhr){
		if (status == "error") {
			console.log("Da lief etwas schief: " + xhr.status + " " + xhr.statusText + " - (" + file + ")");
		}else{
			$(opt.agree).click( function(e){
				$("#dialog").slideUp().removeClass("success").removeClass("error").removeClass("file");
				$("#inactiv-overlay").fadeOut();
				e.stopPropagation();
				settings.callback.call("Agree");
				return "Agree";
			});
			$(opt.close).click( function(e){
				$("#dialog").slideUp().removeClass("success").removeClass("error").removeClass("file");
				$("#inactiv-overlay").fadeOut();
				e.stopPropagation();
				settings.callback.call("Deny");
				return "Deny";
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
		}).fadeIn();
	 
    },
    error : function( content ) { 
      $("#dialog").removeClass("success").addClass("error").fadeIn();
      $("#inactiv-overlay").fadeIn();
	  $("#dialog").html(content);
	  $("#close").html("Okay");
    },
    success : function( content ) {
      $("#dialog").addClass("success").fadeIn().delay(1800).slideUp();
	  $("#dialog").html(content);
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