jQuery(document).ready( function($) {

	//change guid
	$("button[name='serverswitch_change_guid']").click ( function(){
		
		$.ajax({
			type:	"POST",
			data:	"&action=serverswitch_change_guid",
			url:	ajaxurl,
			beforeSend:	function() {
				$("#serverswitch_guid_changed").html("Processing...");
			}, success: function(data) {
				if( data != null ){
					$("#ss_status h4").html("GUID successfully changed!");
				} else {
					$("#ss_status h4").html("Sorry, the GUID couldn't be changed.");
				}
			}
		});
	});
	
	$("button[name='serverswitch_revert_guid']").click ( function(){
		
		$.ajax({
			type:	"POST",
			data:	"&action=serverswitch_revert_guid",
			url:	ajaxurl,
			beforeSend:	function() {
				$("#serverswitch_guid_changed").html("Processing...");
			}, success: function(data) {
				if( data != null ){
					$("#ss_status h4").html("GUID successfully reverted!");
				} else {
					$("#ss_status h4").html("Sorry, the GUID couldn't be reverted.");
				}
			}
		});
	});
	
	
	
	//change url in content
	$("button[name='serverswitch_change_url_in_content']").click ( function(){
		
		$.ajax({
			type:	"POST",
			data:	"&action=serverswitch_change_url_in_content",
			url:	ajaxurl,
			beforeSend:	function() {
				$("#serverswitch_url_in_content_changed").html("Processing...");
			}, success: function(data) {
				if( data != null ){
					$("#ss_status h4").html("URL in content successfully changed!");
				} else {
					$("#ss_status h4").html("Sorry, the URL in the content couldn't be changed.");
				}
			}
		});
	});
	
	$("button[name='serverswitch_revert_url_in_content']").click ( function(){
		
		$.ajax({
			type:	"POST",
			data:	"&action=serverswitch_revert_url_in_content",
			url:	ajaxurl,
			beforeSend:	function() {
				$("#serverswitch_url_in_content_changed").html("Processing...");
			}, success: function(data) {
				if( data != null ){
					$("#ss_status h4").html("URL in content successfully reverted!");
				} else {
					$("#ss_status h4").html("Sorry, the URL in the content couldn't be reverted.");
				}
			}
		});
	});

	//update post meta
	$("button[name='serverswitch_update_post_meta']").click ( function(){
		
		$.ajax({
			type:	"POST",
			data:	"&action=serverswitch_update_post_meta",
			url:	ajaxurl,
			beforeSend:	function() {
				$("#serverswitch_post_meta_changed").html("Processing...");
			}, success: function(data) {
				if( data != null ){
					$("#ss_status h4").html("Post meta successfully updated!");
				} else {
					$("#ss_status h4").html("Sorry, the post meta couldn't be changed.");
				}
			}
		});
	});
	
	$("button[name='serverswitch_revert_post_meta']").click ( function(){
		
		$.ajax({
			type:	"POST",
			data:	"&action=serverswitch_revert_post_meta",
			url:	ajaxurl,
			beforeSend:	function() {
				$("#serverswitch_post_meta_changed").html("Processing...");
			}, success: function(data) {
				if( data != null ){
					$("#ss_status h4").html("Post meta successfully reverted!");
				} else {
					$("#ss_status h4").html("Sorry, the post meta couldn't be reverted.");
				}
			}
		});
	});
	
	
});