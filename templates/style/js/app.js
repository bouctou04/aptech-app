$(document).ready(function(){
			$('.box').fadeOut(0, function(){
				$('.box').slideDown(2000)
			});
		});
setInterval('load_messages()', 500);
function load_messages() {
	$('#messages').load('include/load_messages.php');
}