$('#ReSecurity_CodeImage').click(function () {
  UpdateSecurityCode('#ReSecurity_EncrypCode', '#ReSecurity_VerifyCode', '#ReSecurity_CodeImage')
});
$('#radioGA').on('click', function () {
  $('#j-inputGAPwd').css('display', 'block');
  $('#j-inputFundsPwd').css('display', 'none');
  $('#validateGAInfo').text('请根据左边的谷歌身份验证器示例图输入正确的动态密码。');
  $('#j-validateImgGA').css('display', 'block');
  $('#validateGAInfo').css('display', 'block');
  $('#j-validateImgMB').css('display', 'none');
  $('#validateBankDiv').css('display', 'none');
  $('#addBankDiv').css('display', 'block');
  $('#j-validateType').css('visibility', 'visible');
  $('#ValidateMode').val(1)
});
$('#radioMB').on('click', function () {
  $('#j-inputGAPwd').css('display', 'none');
  $('#j-inputFundsPwd').css('display', 'block');
  $('#j-validateImgGA').css('display', 'none');
  $('#j-validateImgMB').css('display', 'block');
  $('#validateBankDiv').css('display', 'block');
  $('#addBankDiv').css('display', 'none');
  $('#ValidateMode').val(0)
});
$('#Number').blur(function () {
  return;
  var cardNumber = $('#Number').val();
  var cardNumber = cardNumber.replace(/[ ]/g, '');
  var regCardNumber = /^\d{16}$|^\d{18}$|^\d{19}$/;
  if (false == regCardNumber.test(cardNumber) || false == luhmCheck(cardNumber)) {
    $('#KindId').val(0);
    $('#BankId').val(0);
    $('#BankCardInfo').attr('class', 'text-danger');
    $('#BankCardInfo').text('无法识别的银行卡号，请输入16位或18位或19位有效的银行卡号。');
    $('#BankIcon').attr('class', 'fa fa-cc-discover fa-lg form-control-feedback text-danger');
    return
  }
});
$('#submitBtn').on('click', function () {
  var v_name = $('#Name').val();
  var v_card = $('#Number').val();
  var v_code = $('#Code').val();
  var v_pwd = $('#AddFundsPass').val();
  if (v_name.length < 2 || v_name > 20) {
    //$('#validateGAInfo').html('银行卡持卡人字符必须在2-20之间！');
    //return
  }
  if (v_card.length < 11 || v_card.length > 23) {
    //$('#validateGAInfo').html('银行卡卡号输入错误！');
    //return
  }
  if ($('#j-radioGALable').hasClass('active') && $('#j-validateType').css('visibility') == 'visible') {
    if (v_code.length <= 0 || v_code.length != 6) {
      $('#validateGAInfo').html('谷歌动态密码输入错误！');
      return
    }
    $('#ValidateMode').val(1)
  } else {
    if (v_pwd.length <= 0) {
      $('#validateGAInfo').html('资金密码不能为空！');
      return
    }
    $('#ValidateMode').val(0);
    //$('#AddFundsPass').val($.md5($.md5($('#AddFundsPass').val() + $('#hdVC').val())))
  }
  v_card = v_card.replace(/[ ]/g, '');
  var href = $(this).attr('action');
  $.ajax({
		type: "POST",
		url: href,
		data: { username: $('#Name').val(), account: $('#Number').val(),bankId: $('#bankId').val(),coinPassword: $('#AddFundsPass').val() },
		dataType: "json",
		global: false,
		success: function (result) {
			if(result.status){
				window.location.reload();
			}
			else{
				$('#validateGAInfo').html(result.info);
			}
		}, error: function () {
			$.niftyNoty({ type: 'danger', message: '未知错误', container: 'floating', closeBtn: true, timer: 3000 });
		}
	});
  //$('#addbankcard').submit()
});
$('#validateBankBtn').on('click', function () {
  var v_name = $('#FirstName').val();
  var v_card = $('#FirstNumber').val();
  var v_cmd = $('#ReSecurity_EncrypCode').val();
  var v_pwd = $('#ReSecurity_VerifyCode').val();
  if (v_name.length < 2 || v_name > 20) {
    $('#validateBankInfo').html('第一张银行卡持卡人字符必须在2-20之间！');
    return
  }
  if (v_card.length < 11 || v_card.length > 23) {
    $('#validateBankInfo').html('第一张银行卡卡号输入错误！');
    return
  }
  if (v_cmd.length <= 0 || v_pwd.length <= 0 || v_pwd.length != 6) {
    $('#validateBankInfo').html('密保卡密码输入错误！');
    return
  }
  v_card = v_card.replace(/[ ]/g, '');
  var regCardNumber = /^\d{16}$|^\d{18}$|^\d{19}$/;
  if (false == regCardNumber.test(v_card) || false == luhmCheck(v_card)) {
    $('#validateBankInfo').html('无法识别的银行卡号，请输入16位或18位或19位有效的银行卡号。');
    return
  }
  $('#validateBankBtn').attr('disabled', true);
  $('#validateBankBtn').text('验证中...');
  jQuery.ajax({
    type: 'POST',
    url: '/safety/validateBank',
    data: {
      name: v_name,
      card: v_card,
      cmd: v_cmd,
      pwd: v_pwd
    },
    dataType: 'json',
    global: false,
    success: function (data) {
      if (data.Flag == 1) {
        $('#validateGAInfo').text('');
        $('#j-validateType').css('visibility', 'hidden');
        $('#validateBankDiv').css('display', 'none');
        $('#addBankDiv').css('display', 'block');
        $('#j-inputPassword').text('请输入资金密码')
      } else {
        $('#SecurityCode').click();
        $('#validateBankInfo').html(data.Message)
      }
      $('#validateBankBtn').removeAttr('disabled');
      $('#validateBankBtn').text('验    证')
    },
    error: function () {
      $('#SecurityCode').click();
      $('#validateBankBtn').removeAttr('disabled');
      $('#validateBankBtn').text('验    证')
    }
  })
});
$('#addBank').on('click', function () {
  $('#FirstName').val('');
  $('#FirstNumber').val('');
  $('#Name').val('');
  $('#Number').val('');
  $('#AddFundsPass').val('');
  $('#KindId').val('');
  $('#BankId').val('');
  if($(this).attr('no')==1){
	  $.niftyNoty({ type: 'danger', message: '已经不能绑定更多的银行卡了', container: 'floating', closeBtn: true, timer: 3000 });
	  return;
  }
  $('#add-modal').modal('show');
  // $('#radioGA').click();
  // $('#ReSecurity_CodeImage').click();
  // $('#addBankInfo').html('开始添加新的银行卡，正在验证中...');
  // $.ajax({
    // type: 'POST',
    // url: '{:Url("user/bank")}',
    // dataType: 'json',
    // global: false,
    // success: function (data) {
      // $('#add-modal').modal('show');
      // $('#addBank').removeAttr('disabled');
      // $('#addBankInfo').html('添加新的银行卡');
      // if (data <= 0) {
        // $('#validateGAInfo').text('');
        // $('#j-validateType').css('visibility', 'hidden');
        // $('#validateBankDiv').css('display', 'none');
        // $('#j-validateImgDiv').css('display', 'none');
        // $('#j-validateFristRemark').css('display', 'block');
        // $('#addBankDiv').css('display', 'block');
        // $('#j-inputGAPwd').css('display', 'none');
        // $('#j-inputFundsPwd').css('display', 'block')
      // } else {
        // $('#j-validateImgDiv').css('display', 'block');
        // $('#j-validateFristRemark').css('display', 'none')
      // }
    // },
    // error: function () {
      // $('#addBank').removeAttr('disabled');
      // $('#addBankInfo').html('添加新的银行卡');
      // $.niftyNoty({
        // type: 'danger',
        // message: '操作失败！',
        // container: 'floating',
        // closeBtn: true,
        // timer: 3000
      // })
    // }
  // })
});
$('#Number').keyup(function () {
  //this.value = this.value.replace(/[^\d]/g, '').replace(/(\d{4})(?=\d)/g, '$1 ')
});
$('#FirstNumber').keyup(function () {
  this.value = this.value.replace(/[^\d]/g, '').replace(/(\d{4})(?=\d)/g, '$1 ')
});
function luhmCheck(bankno) {
  bankno = bankno.replace(/[ ]/g, '');
  var lastNum = bankno.substr(bankno.length - 1, 1);
  var first15Num = bankno.substr(0, bankno.length - 1);
  var newArr = new Array();
  for (var i = first15Num.length - 1; i > - 1; i--) {
    newArr.push(first15Num.substr(i, 1))
  }
  var arrJiShu = new Array();
  var arrJiShu2 = new Array();
  var arrOuShu = new Array();
  for (var j = 0; j < newArr.length; j++) {
    if ((j + 1) % 2 == 1) {
      if (parseInt(newArr[j]) * 2 < 9) {
        arrJiShu.push(parseInt(newArr[j]) * 2)
      } else {
        arrJiShu2.push(parseInt(newArr[j]) * 2)
      }
    } else {
      arrOuShu.push(newArr[j])
    }
  }
  var jishu_child1 = new Array();
  var jishu_child2 = new Array();
  for (var h = 0; h < arrJiShu2.length; h++) {
    jishu_child1.push(parseInt(arrJiShu2[h]) % 10);
    jishu_child2.push(parseInt(arrJiShu2[h]) / 10)
  }
  var sumJiShu = 0;
  var sumOuShu = 0;
  var sumJiShuChild1 = 0;
  var sumJiShuChild2 = 0;
  var sumTotal = 0;
  for (var m = 0; m < arrJiShu.length; m++) {
    sumJiShu = sumJiShu + parseInt(arrJiShu[m])
  }
  for (var n = 0; n < arrOuShu.length; n++) {
    sumOuShu = sumOuShu + parseInt(arrOuShu[n])
  }
  for (var p = 0; p < jishu_child1.length; p++) {
    sumJiShuChild1 = sumJiShuChild1 + parseInt(jishu_child1[p]);
    sumJiShuChild2 = sumJiShuChild2 + parseInt(jishu_child2[p])
  }
  sumTotal = parseInt(sumJiShu) + parseInt(sumOuShu) + parseInt(sumJiShuChild1) + parseInt(sumJiShuChild2);
  var k = parseInt(sumTotal) % 10 == 0 ? 10 : parseInt(sumTotal) % 10;
  var luhm = 10 - k;
  if (lastNum == luhm) {
    return true
  } else {
    return false
  }
};
