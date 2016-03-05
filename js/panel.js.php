<?php
	require '../config.php';
	
	$langs->load('panel@panel');
	
?>

function panel_set_link() {
	$('a[href]').each(function() {
		
		var url = $(this).attr('href');
		
		if(url.indexOf('action=delete')==-1 && url.indexOf("javascript:")==-1) {
			url = "javascript:panel_open_panel('"+url+"')";
			link = '&nbsp;<a href="'+url+'" class="open-panel" style="display:none; "><?php echo img_object('OpenInPanel', 'panel@panel') ?></a>';
			
			$(this).after(link);
			
			$(this).mouseover(function() {
				$("a.open-panel").hide();
				$(this).next("a.open-panel").show();
			});
			
			
		}
		
	});
}
function panel_close_panel() {
	
	$('#panel-navigation').remove();
	$('body').css('padding-right', 0);
}
function panel_open_panel(url) {
	
	if($('#panel-navigation').length==0) {
		
		$div = $('<div id="panel-navigation" />');
		$div.append('<a href="javascript:panel_close_panel();" class="close-panel"><?php echo img_object('Close', 'close@panel'); ?></a>');
		
		$('body').append($div);
		var h = $(document).height();
		var w = $(document).width() / 2;
		$('#panel-navigation').css({
				height: h
				,width: w
				,position : "absolute"
				,top:0
				,right:0
				,'background-color':'#999'
				,'padding-left':'3px'
				
		});
		$('body').css({
			'padding-right': $('#panel-navigation').width()
			,'position':'relative'
		});
	}

	$('#panel-navigation>iframe').remove();
	$('#panel-navigation').append('<iframe src="#" width="100%" height="100%" allowfullscreen webkitallowfullscreen frameborder="0"></iframe>');

	
	$('#panel-navigation').resizable({
		handles: "w"
		,start:function(event,ui) {
			$('#panel-navigation>iframe').hide();
		}
		,stop:function(event,ui) {
			$('#panel-navigation>iframe').show();
			 $('#panel-navigation').css({
                                position : "absolute"
                                ,top:0
                                ,right:0
                                ,'padding-left':'3px'

                	});
			$('body').css('padding-right', $('#panel-navigation').width());
		}
	});
	$('#panel-navigation>iframe').attr('src', url);

}


$(document).ready(function() {
	panel_set_link();
});
