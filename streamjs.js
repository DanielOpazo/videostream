$(document).ready(function() {
	$('.iframe').click(function() {
		alert("JavaScript!");
	});
	setTimeout(function() {
		window.location.reload(1);
	}, 60000);
});
