

function loadbouns(min,max,id) {
	
	$(".noUiSlider6").html('');
	
	var min=parseFloat(min).toFixed(1);
	var max=(parseFloat(max)-0.1).toFixed(1);
	$('#range-def-min').html(min);
    $('#range-def-max').html(max);
	
	$(".noUiSlider6").noUiSlider({
		range: [min, max],
		start: min,
		handles: 0.1,
		step: 0.1,
		slide: function() {
			var values = $(this).val();
			var ff=parseFloat(values);
			if(ff>0){
				$("#"+id).val(ff.toFixed(1));
				$("#"+id).text(ff.toFixed(1));
			}
			else {
				$("#"+id).val(min);
				$("#"+id).text(min);
			}
		}
	});
	$("#"+id).val(min);
	$("#"+id).text(min);
	return;
	
}

function showBet() {
	var href = $(this).attr('action');
	var v_id = $(this).attr('data-value');
	var me = this;
	$("#betDetail").empty();
	$.ajax({
		type: "GET",
		url: href,
		data: { },
		dataType: "html",
		global: false,
		success: function (data) {
			$("#betDetail").append(data);
			$("#cancelproject").click(function () {
				if (true) {
					$.ajax({
						type: "POST",
						url: "/game/deletecode",
						data: { id: v_id },
						dataType: "json",
						global: false,
						success: function (data) {
							try {
								if (data.status == 0) {
									bootbox.alert(data.info);
								} else {
									$(me).parent().siblings("td:last").html('<label class="graylab">已撤单</label>');
									$("#details-modal").hide();
									bootbox.alert("撤单成功");
									//$("#betrecord").submit();
								}
							} catch (e) {
								bootbox.alert("撤单失败，请梢后重试");
							}
						},
						error: null,
						cache: false
					})
				}
			})
		},
		error: null,
		cache: false
	})
}
var dataAlert = [{
	type: "info"
}, {
	type: "primary"
}, {
	type: "success"
}, {
	type: "warning"
}, {
	type: "danger"
}, {
	type: "mint"
}, {
	type: "purple"
}, {
	type: "pink"
}, {
	type: "dark"
}];
var faIcon = {
	valid: "fa fa-check-circle fa-lg text-success",
	invalid: "fa fa-times-circle fa-lg",
	validating: "fa fa-refresh"
};

function UpdateValidateCode(encrypCode, verifyCode, codeImage) {
	$(verifyCode).val("");
	$(encrypCode).val("");
	$.ajax({
		type: "POST",
		url: "/common/getValidCodeByJosn?time=" + (new Date()).getTime(),
		dataType: "json",
		global: false,
		success: function(data) {
			$(verifyCode).val("");
			$(encrypCode).val(data.EncrypCode);
			$(codeImage).attr("src", data.CodeImage)
		},
		error: function() {
			$(verifyCode).val("");
			$(encrypCode).val("");
			$(codeImage).attr("src", "")
		}
	})
}
function UpdateSecurityCode(encrypCode, verifyCode, codeImage) {
	$(verifyCode).val("");
	$(encrypCode).val("");
	$.ajax({
		type: "POST",
		url: "/common/getSecurityCodeByJosn?time=" + (new Date()).getTime(),
		dataType: "json",
		global: false,
		success: function(data) {
			$(verifyCode).val("");
			$(encrypCode).val(data.EncrypCode);
			$(codeImage).attr("src", data.CodeImage)
		},
		error: function() {
			$(verifyCode).val("");
			$(encrypCode).val("");
			$(codeImage).attr("src", "")
		}
	})
}
function passwordStrength(pwdId, strengthId, sdivId) {
	var pwd = $(pwdId).val();
	var strength = 0;
	var reg = /[0-9]/;
	if (reg.test(pwd)) {
		strength = strength + 1
	}
	reg = /[a-z]/;
	if (reg.test(pwd)) {
		strength = strength + 1
	}
	reg = /[A-Z]/;
	if (reg.test(pwd)) {
		strength = strength + 1
	}
	reg = /[`~!@#\$%\^\&\*\(\)_\+<>\?:"\{\},\.\\\/;'\[\]]/;
	if (reg.test(pwd)) {
		strength = strength + 1
	}
	if (pwd.length >= 12) {
		strength = strength + 1
	}
	$(strengthId).val(strength);
	if (strength <= 3) {
		$(sdivId).html("弱");
		$(sdivId).css("width", "33%");
		$(sdivId).attr("class", "progress-bar progress-bar-danger")
	} else {
		if (strength == 4) {
			$(sdivId).html("一般");
			$(sdivId).css("width", "66%");
			$(sdivId).attr("class", "progress-bar progress-bar-warning")
		} else {
			$(sdivId).html("强");
			$(sdivId).css("width", "100%");
			$(sdivId).attr("class", "progress-bar progress-bar-info")
		}
	}
}
function getUrlParam(name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
	var r = window.location.search.substr(1).match(reg);
	if (r != null) {
		return encodeURI(r[2])
	}
	return null
}
function showNiftyNoty() {
	if (arguments.length == 1) {
		if (typeof(arguments[0]) == "object") {
			var niftyType = arguments[0].IsSuccess ? "success" : "danger";
			$.niftyNoty({
				type: niftyType,
				message: arguments[0].Message,
				container: "floating",
				closeBtn: true,
				timer: 3000
			})
		} else {
			$.niftyNoty({
				type: "danger",
				message: arguments[0],
				container: "floating",
				closeBtn: true,
				timer: 3000
			})
		}
	} else {
		if (arguments.length == 2) {
			if (typeof(arguments[0]) == "boolean") {
				var type = arguments[0] ? "success" : "danger";
				$.niftyNoty({
					type: type,
					message: arguments[1],
					container: "floating",
					closeBtn: true,
					timer: 3000
				})
			}
		}
	}
};