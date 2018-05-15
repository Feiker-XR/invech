$(document).ready(function() {
	var bodyheight = jQuery(window).height() - 54;
	$("#pageframe").css("height", bodyheight);
	$(".mega-dropdown a[target='pageframe']").on("click", function() {
		$(".mega-dropdown").removeClass("open")
	});
	//_fastData;
	$("#j-sign-out").on("click", function() {
		if (confirm("确定要退出吗？")) {
			document.location.href = $(this).attr('action');
		}
	})
});
$(window).resize(function() {
	var bodyheight = jQuery(window).height() - 54;
	$("#pageframe").css("height", bodyheight)
});