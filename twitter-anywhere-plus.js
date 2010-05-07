jQuery(function ($) {

$(document).ready(function(){
	
	$("#tweetBox").mouseover(function() {
		$(".twitter-anywhere-tweet-box").focus();
		$(".twitter-anywhere-tweet-box").contents().find("#tweet-box").focus();
	});
	
});

});