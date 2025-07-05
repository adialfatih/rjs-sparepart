 <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>
    <!-- Tambahkan ini di bagian head -->
    
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        // DOM Elements
        const themeToggle = document.getElementById('themeToggle');
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const idLogout = document.getElementById('idLogout');
        const sidebar = document.getElementById('sidebar');
        const addSparepartBtn = document.getElementById('addSparepartBtn');
        const addSparepartModal = document.getElementById('addSparepartModal');
        const closeAddModal = document.getElementById('closeAddModal');
        const cancelAddModal = document.getElementById('cancelAddModal');
        const confirmModal = document.getElementById('confirmModal');
        const closeConfirmModal = document.getElementById('closeConfirmModal');
        const cancelConfirmModal = document.getElementById('cancelConfirmModal');
        const loadingOverlay = document.getElementById('loadingOverlay');
        const submenuToggles = document.querySelectorAll('.menu-item > .menu-link ');

        // Theme Toggle
        themeToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', newTheme);
            
            // Update icon
            const icon = themeToggle.querySelector('span');
            icon.textContent = newTheme === 'light' ? 'brightness_4' : 'brightness_7';
        });

        // Mobile Menu Toggle
        mobileMenuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('show');
        });
        
        idLogout.addEventListener('click', () => {
            window.location.href = "<?=base_url('login');?>";
        });

        // Submenu Toggle
        submenuToggles.forEach(arrow => {
            arrow.addEventListener('click', (e) => {
                e.stopPropagation();
                const menuItem = arrow.closest('.menu-item');
                const submenu = menuItem.querySelector('.submenu');
                
                arrow.classList.toggle('rotated');
                submenu.classList.toggle('show');
            });
        });

        // Show Add Sparepart Modal
        

        // Close Add Sparepart Modal
        closeAddModal.addEventListener('click', () => {
            addSparepartModal.classList.remove('show');
        });

        cancelAddModal.addEventListener('click', () => {
            addSparepartModal.classList.remove('show');
        });
        addSparepartBtn.addEventListener('click', () => {
            addSparepartModal.classList.add('show');
        });

        // Show Confirm Modal (example)
        document.querySelectorAll('.btn-outline .material-icons').forEach(btn => {
            if (btn.textContent === 'delete') {
                btn.closest('button').addEventListener('click', () => {
                    confirmModal.classList.add('show');
                });
            }
        });
        function deleteUser(id,nama){
            $('#hapusUserNotif').html('Anda akan menghapus user atas nama <strong>'+nama+'</strong> ?');
            $('#idusers').val(''+id);
        }
        // Close Confirm Modal
        closeConfirmModal.addEventListener('click', () => {
            confirmModal.classList.remove('show');
        });

        cancelConfirmModal.addEventListener('click', () => {
            confirmModal.classList.remove('show');
        });

        // Close modals when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === addSparepartModal) {
                addSparepartModal.classList.remove('show');
            }
            if (e.target === confirmModal) {
                confirmModal.classList.remove('show');
            }
        });

        // Loading overlay example
        function showLoading() {
            loadingOverlay.classList.add('show');
            setTimeout(() => {
                loadingOverlay.classList.remove('show');
            }, 1000);
        }

        // Simulate loading
        showLoading();

        // Responsive sidebar
        function handleResize() {
            if (window.innerWidth > 992) {
                sidebar.classList.remove('show');
            }
        }

        window.addEventListener('resize', handleResize);
        function loadData(sp){
            console.log('testing :'+sp);
            $('#tableBody').html('<tr><td colspan="6">Loading Data</td></tr>');
            $.ajax({
                url:"<?=base_url('data/showReadyKantor');?>",
                type: "GET",
                data: {"sp":sp},
                cache: false,
                success: function(dataResult){
                    if ($.fn.DataTable.isDataTable('#dataTable')) {
                        $('#dataTable').DataTable().destroy();
                    }
                    $('#tableBody').html(dataResult);
                    $('#dataTable').DataTable();
                }
            });
        }
       
       $('#hapusthisuser').click(function() {
            var idusers = $('#idusers').val();
            var csrfName = $('#csrf_token_name').val();
			var csrfHash = $('#csrf_token_value').val();
            $.ajax({
				url: '<?=base_url('delete-inputuser');?>',
				type: 'POST',
				dataType: 'json',
				data: { 'idusers': idusers, [csrfName]: csrfHash },
				success: function(response) {
					console.log(response);
					if(response.status == 'success') {
						Swal.fire('Berhasil Menghapus!', response.msg, 'success').then((result) => {
                            location.reload();
                        });;
					} else {
						Swal.fire('Gagal Menghapus!', response.msg, 'error');
					}
					$('#csrf_token_value').val(response.newCsrfHash);
				},
					error: function() {
						Swal.fire('Token Error 22', '', 'error');
					}
				});
       });

        $('#simpanUser').click(function() {
            console.log('tombol simpanUser di klik');
            var namauser = $('#namauser').val();
            var usernameid = $('#usernameid').val();
            var hakakses = $('#hakakses').val();
            var passwordid = $('#passwordid').val();
            var csrfName = $('#csrf_token_name').val();
			var csrfHash = $('#csrf_token_value').val();
            if(namauser!='' && usernameid!='' && hakakses!='' && passwordid!=''){
                $.ajax({
					url: '<?=base_url('proses-inputuser');?>',
					type: 'POST',
					dataType: 'json',
					data: {
						'namauser': namauser,
						'usernameid': usernameid,
						'hakakses': hakakses,
						'passwordid': passwordid,
    					[csrfName]: csrfHash
					},
					success: function(response) {
						console.log('nama : '+namauser);
						console.log('user : '+usernameid);
						console.log('hak : '+hakakses);
						console.log('pass : '+passwordid);
						console.log(namauser);
						console.log(response);
						if(response.status == 'success') {
							Swal.fire('Berhasil Menyimpan!', response.msg, 'success').then((result) => {
                                location.reload();
                            });;
						} else {
							Swal.fire('Gagal Menyimpan!', response.msg, 'error');
						}
						$('#csrf_token_value').val(response.newCsrfHash);
					},
					error: function() {
						Swal.fire('Token Error 21', '', 'error');
					}
				});
            } else {
                Swal.fire('Mohon isi semua isian yang ada.!');
            }
        });
    
    
    </script>
</body>
</html>