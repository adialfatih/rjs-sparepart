<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse RJS | Login</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root{--primary:#2A5C99;--primary-light:#4a7cb9;--secondary:#FF6B35;--accent:#FFE74C;--text:#2D2D2D;--text-light:#5E5E5E;--bg:#F8F9FA;--card-bg:#FFFFFF;--border:#E0E0E0;--success:#28A745;--warning:#FFC107;--danger:#DC3545}*{margin:0;padding:0;box-sizing:border-box}body{font-family:'Roboto',sans-serif;background-color:var(--bg);color:var(--text);min-height:100vh;display:flex;justify-content:center;align-items:center;padding:1rem;background-image:linear-gradient(135deg,rgb(42 92 153 / .1) 0%,rgb(255 107 53 / .1) 100%)}.login-container{width:100%;max-width:420px;background-color:var(--card-bg);border-radius:12px;box-shadow:0 10px 30px rgb(0 0 0 / .1);overflow:hidden;animation:fadeIn 0.5s ease}@keyframes fadeIn{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}.login-header{background-color:var(--primary);color:#fff;padding:1.5rem;text-align:center;position:relative}.logo{display:flex;align-items:center;justify-content:center;gap:10px;margin-bottom:.5rem}.logo-icon{font-size:2.5rem;color:var(--accent)}.logo-text{font-size:1.8rem;font-weight:500}.login-header p{font-size:.9rem;opacity:.9}.login-body{padding:2rem}.form-group{margin-bottom:1.5rem;position:relative}.form-label{display:block;margin-bottom:.5rem;font-weight:500;color:var(--text-light)}.input-group{position:relative;display:flex;align-items:center}.input-icon{position:absolute;left:12px;color:var(--text-light);font-size:1.2rem}.form-control{width:100%;padding:.8rem 1rem .8rem 40px;border:1px solid var(--border);border-radius:6px;font-size:1rem;transition:border-color 0.3s,box-shadow 0.3s}.form-control:focus{outline:none;border-color:var(--primary);box-shadow:0 0 0 3px rgb(42 92 153 / .2)}.password-toggle{position:absolute;right:12px;background:none;border:none;color:var(--text-light);cursor:pointer;font-size:1.2rem}.btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;width:100%;padding:.8rem;border-radius:6px;font-weight:500;cursor:pointer;border:none;transition:all 0.2s;font-size:1rem}.btn-primary{background-color:var(--primary);color:#fff}.btn-primary:hover{background-color:var(--primary-light)}.login-footer{text-align:center;margin-top:1.5rem;font-size:.9rem;color:var(--text-light)}.login-footer a{color:var(--primary);text-decoration:none}.login-footer a:hover{text-decoration:underline}@media (max-width:480px){.login-container{border-radius:8px}.login-header{padding:1.2rem}.logo-text{font-size:1.5rem}.login-body{padding:1.5rem}}@media (max-width:360px){.logo{flex-direction:column;gap:5px}.logo-icon{font-size:2rem}.logo-text{font-size:1.3rem}}
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="logo">
                <span class="material-icons logo-icon">warehouse</span>
                <span class="logo-text">Rindang Jati</span>
            </div>
            <p>Sistem Manajemen Sparepart Gudang</p>
        </div>
        
        <div class="login-body">
            <form>
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="material-icons input-icon">person</span>
                        <input type="text" id="username" class="form-control" placeholder="Masukkan username">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="material-icons input-icon">lock</span>
                        <input type="password" id="password" class="form-control" placeholder="Masukkan password">
                        <button type="button" class="password-toggle" id="togglePassword">
                            <span class="material-icons" id="passwordIcon">visibility_off</span>
                        </button>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary" id="btnLogin">
                    <span class="material-icons">login</span>
                    <span>Masuk</span>
                </button>
            </form>
            
            <div class="login-footer">
                <p>&copy; <?=date('Y');?> <a href="#">PT. Rindang Jati Spinning</a></p>
            </div>
        </div>
    </div>
    <input type="hidden" id="csrf_token_name" value="<?= $this->security->get_csrf_token_name(); ?>">
	<input type="hidden" id="csrf_token_value" value="<?= $this->security->get_csrf_hash(); ?>">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const passwordIcon = document.getElementById('passwordIcon');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            // Toggle icon
            passwordIcon.textContent = type === 'password' ? 'visibility_off' : 'visibility';
        });

        // Form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Here you would typically handle the login logic
            console.log('Login attempted with:', {
                username: document.getElementById('username').value,
                password: document.getElementById('password').value
            });
            
            // Simulate loading and redirect to dashboard
            // window.location.href = 'dashboard.html';
        });
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