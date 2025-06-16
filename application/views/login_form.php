<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Login Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root{--primary-blue:#1a73e8;--dark-blue:#0d47a1;--light-blue:#e8f0fe;--white:#ffffff;--gray:#f5f5f5;--dark-gray:#757575}*{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif}body{background-color:var(--light-blue);display:flex;justify-content:center;align-items:center;min-height:100vh;padding:20px}.login-container{background-color:var(--white);border-radius:16px;box-shadow:0 10px 30px rgb(0 0 139 / .1);width:100%;max-width:420px;padding:40px;position:relative;overflow:hidden}.login-container::before{content:"";position:absolute;top:0;left:0;width:100%;height:8px;background:linear-gradient(90deg,var(--primary-blue),#34a853,#fbbc05,#ea4335)}.login-header{text-align:center;margin-bottom:30px}.login-header h1{color:var(--primary-blue);font-size:28px;font-weight:600;margin-bottom:10px}.login-header p{color:var(--dark-gray);font-size:14px}.login-header i{font-size:48px;color:var(--primary-blue);margin-bottom:15px;background:linear-gradient(135deg,var(--primary-blue),#00bcd4);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:#fff0}.input-group{position:relative;margin-bottom:20px}.input-group i{position:absolute;left:15px;top:50%;transform:translateY(-50%);color:var(--primary-blue)}.input-group input{width:100%;padding:15px 15px 15px 45px;border:1px solid #ddd;border-radius:8px;font-size:16px;transition:all 0.3s;background-color:var(--gray)}.input-group input:focus{outline:none;border-color:var(--primary-blue);box-shadow:0 0 0 2px rgb(26 115 232 / .2);background-color:var(--white)}.login-actions{display:flex;justify-content:space-between;align-items:center;margin-bottom:25px;font-size:14px}.remember-me{display:flex;align-items:center}.remember-me input{margin-right:8px}.forgot-password a{color:var(--primary-blue);text-decoration:none}.login-button{width:100%;padding:15px;background-color:var(--primary-blue);color:var(--white);border:none;border-radius:8px;font-size:16px;font-weight:500;cursor:pointer;transition:all 0.3s;display:flex;align-items:center;justify-content:center}.login-button i{margin-right:10px}.login-button:hover{background-color:var(--dark-blue);transform:translateY(-2px);box-shadow:0 5px 15px rgb(26 115 232 / .3)}.login-footer{text-align:center;margin-top:25px;font-size:14px;color:var(--dark-gray)}.login-footer a{color:var(--primary-blue);text-decoration:none;font-weight:500}@media (max-width:480px){.login-container{padding:30px 20px}.login-header h1{font-size:24px}.input-group input{padding:12px 12px 12px 40px}.login-button{padding:12px}}
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <i class="fas fa-robot"></i>
            <h1>AI Asistant</h1>
            <p>Access your AI-BOT by Grafamedia</p>
        </div>
        
        <form>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Username" id="username">
            </div>
            
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Password" id="password">
            </div>
            
            <div class="login-actions">
                <div class="remember-me">
                    <input type="checkbox" id="remember">
                    <label for="remember">Remember me</label>
                </div>
                <div class="forgot-password">
                    <a href="#">Forgot password?</a>
                </div>
            </div>
            
            <button type="button" class="login-button" id="btnLogin">
                <i class="fas fa-sign-in-alt"></i>
                <span>Login</span>
            </button>
        </form>
        <input type="hidden" id="csrf_token_name" value="<?= $this->security->get_csrf_token_name(); ?>">
		<input type="hidden" id="csrf_token_value" value="<?= $this->security->get_csrf_hash(); ?>">
        <div class="login-footer">
            &copy; <?=date('Y');?> AI Asistant. By : <a href="#">Grafamedia</a>
        </div>
    </div>

	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function() {
			$('#username, #password').on('keypress', function(e) {
				if (e.which === 13) { // kode 13 = Enter
					$('#btnLogin').click(); // trigger tombol login
				}
			});
			$('#btnLogin').click(function() { 
				var username = $('#username').val();
				var password = $('#password').val();
				var csrfName = $('#csrf_token_name').val();
				var csrfHash = $('#csrf_token_value').val();
				if(username == '' && password == '') {
					Swal.fire('Login Error!', 'Anda harus mengisi username dan password untuk login', 'error');
				} else {
					if(username!='' && password!=''){
						$.ajax({
							url: '<?=base_url('login/actlogin');?>',
							type: 'POST',
							contentType: 'application/x-www-form-urlencoded',
							dataType: 'json',
							data: {
								'username': username,
								'password': password,
    							[csrfName]: csrfHash
							},
							success: function(response) {
								console.log(response);
								if(response.status == 'success') {
									Swal.fire('Login Success!', '', 'success').then((result) => {
										window.location.href = '<?=base_url('dashboard');?>';
									});
								} else {
									Swal.fire('Login Error!', response.message, 'error');
								}
								$('#csrf_token_value').val(response.newCsrfHash);
							},
							error: function() {
								Swal.fire('Token Error', '', 'error');
							}
						});
					} else {
						if(username == '') {
							Swal.fire('Username Kosong', 'Anda harus mengisi username untuk login', 'error');
						}
						if(password == '') {
							Swal.fire('Password Kosong', 'Anda harus mengisi password untuk login', 'error');
						}
					}
				}
			});
		});
	</script>
</body>
</html>