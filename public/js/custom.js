var clicked = false;

function handlerInMouse() {
	if (clicked === false) {
		$(this).children("ul").show();
	}
}

function handlerOutMouse() {
	if (clicked === false) {
		$(this).children("ul").hide();
	}
}

function handlerClick() {
	if (clicked === true) {
		clicked = false;
		$(this).children("ul").hide();
	} else {
		clicked = true;
		$(this).children("ul").show();
	}
}

$( document ).ready(function() {
	// Function to remove clicked items from the list, without a pager reload.
	$(".resultA").click(function(event){
		event.preventDefault();
		
		$(this).closest('tr').remove();
		
		$.post($(this).attr("href"), function(data){
			$('#response').html(data);
		});
	});
	
	$("nav.navbar.navbar-inverse.navbar-fixed-top div.container div.collapse.navbar-collapse ul.nav.navbar-nav li").mouseenter( handlerInMouse ).mouseleave( handlerOutMouse );
	$("nav.navbar.navbar-inverse.navbar-fixed-top div.container div.collapse.navbar-collapse ul.nav.navbar-nav li").click( handlerClick );
});

$(document).ready(function() {
    $('#dataTable').DataTable({
    	"order": [[ 0, "asc" ]],
    	"pageLength": 50
    });
} );