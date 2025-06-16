 <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>
    <!-- Tambahkan ini di bagian head -->
    
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
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
        addSparepartBtn.addEventListener('click', () => {
            document.getElementById('tglDatang').value = '';
            document.getElementById('tglNota').value = '';
            document.getElementById('nomorNota').value = '';
            document.getElementById('supp').value = '';
            document.getElementById('divisiId').value = '';
            document.getElementById('codebeli').value = '0';
            $('#tableItem').html('');
            addSparepartModal.classList.add('show');
        });
        function showModalPembelian(kode){
            $.ajax({
				url: '<?=base_url('data/bukaPembelian');?>',
				type: 'GET',
				dataType: 'json',
				data: {'kode': kode},
				success: function(response) {
					console.log(response);
					if(response.status == 'success') {
						//$('#tableItem').html(response.html);
                        document.getElementById('tglDatang').value = ''+response.tgl_datang;
                        document.getElementById('tglNota').value = ''+response.tgl_nota;
                        document.getElementById('nomorNota').value = ''+response.no_nota_sj;
                        document.getElementById('supp').value = ''+response.supp;
                        document.getElementById('divisiId').value = ''+response.untuk;
                        document.getElementById('codebeli').value = ''+response.kode_beli;
                        loadItemDetil(response.kode_beli);
                        addSparepartModal.classList.add('show');
					} else {
						Swal.fire('Gagal Mengambil Data!', response.message, 'error');
					}
				},
				error: function() {
                    console.log('Error: 25');
				}
			});
            
        }

        // Close Add Sparepart Modal
        closeAddModal.addEventListener('click', () => {
            addSparepartModal.classList.remove('show');
        });

        cancelAddModal.addEventListener('click', () => {
            addSparepartModal.classList.remove('show');
        });

        // Show Confirm Modal (example)
        document.querySelectorAll('.btn-outline .material-icons').forEach(btn => {
            if (btn.textContent === 'delete') {
                btn.closest('button').addEventListener('click', () => {
                    confirmModal.classList.add('show');
                });
            }
        });

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
            }, 2000);
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
        function loadData(){
            $('#tableBody').html('<tr><td>Loading</td><td>Loading</td><td>Loading</td><td>Loading</td><td>Loading</td><td>Loading</td><td>Loading</td><td>Loading</td></tr>');
            $.ajax({
                url:"<?=base_url('data/showPembelian');?>",
                type: "GET",
                data: {},
                cache: false,
                success: function(dataResult){
                    if ($.fn.DataTable.isDataTable('#sparepartTable')) {
                        $('#table1').DataTable().destroy();
                    }
                    $('#tableBody').html(dataResult);
                    $('#sparepartTable').DataTable();
                }
            });
        }
        loadData();
       
        //untuk custom combobox 1
        document.addEventListener('DOMContentLoaded', function() {
            const combobox = document.getElementById('combobox');
            const optionsContainer = document.getElementById('options');
            
            // Daftar opsi yang tersedia
            <?php if($navigasi2=="pembelian"){ ?>
            const availableOptions = [<?= $im_data;?>];
            <?php } else { ?>
            const availableOptions = ["No Data"];
            <?php } ?>
            
            
            // Tampilkan opsi saat input difokus
            combobox.addEventListener('focus', function() {
                showOptions(availableOptions);
            });
            
            // Filter opsi saat user mengetik
            combobox.addEventListener('input', function() {
                const inputValue = this.value.toLowerCase();
                const filteredOptions = availableOptions.filter(option => 
                    option.toLowerCase().includes(inputValue)
                );
                
                showOptions(filteredOptions);
                
                // Jika input kosong, tampilkan semua opsi
                if (inputValue === '') {
                    showOptions(availableOptions);
                }
            });
            
            // Tangani klik di luar combobox untuk menyembunyikan opsi
            document.addEventListener('click', function(e) {
                if (e.target !== combobox && e.target.parentNode !== optionsContainer) {
                    optionsContainer.style.display = 'none';
                }
            });
            
            // Fungsi untuk menampilkan opsi
            function showOptions(options) {
                optionsContainer.innerHTML = '';
                
                if (options.length === 0) {
                    const noResult = document.createElement('div');
                    noResult.className = 'combobox-option';
                    noResult.textContent = 'Tidak ditemukan, ketik untuk menambahkan baru';
                    optionsContainer.appendChild(noResult);
                } else {
                    options.forEach(option => {
                        const optionElement = document.createElement('div');
                        optionElement.className = 'combobox-option';
                        optionElement.textContent = option;
                        
                        optionElement.addEventListener('click', function() {
                            combobox.value = option;
                            optionsContainer.style.display = 'none';
                        });
                        
                        optionsContainer.appendChild(optionElement);
                    });
                }
                
                optionsContainer.style.display = 'block';
            }
            
            // Navigasi dengan keyboard
            combobox.addEventListener('keydown', function(e) {
                const options = document.querySelectorAll('.combobox-option');
                let activeOption = document.querySelector('.combobox-option.active');
                
                // Tombol panah bawah
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    
                    if (!activeOption) {
                        options[0]?.classList.add('active');
                    } else {
                        activeOption.classList.remove('active');
                        const nextOption = activeOption.nextElementSibling;
                        if (nextOption) {
                            nextOption.classList.add('active');
                        } else {
                            options[0]?.classList.add('active');
                        }
                    }
                }
                
                // Tombol panah atas
                if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    
                    if (!activeOption) {
                        options[options.length - 1]?.classList.add('active');
                    } else {
                        activeOption.classList.remove('active');
                        const prevOption = activeOption.previousElementSibling;
                        if (prevOption) {
                            prevOption.classList.add('active');
                        } else {
                            options[options.length - 1]?.classList.add('active');
                        }
                    }
                }
                
                // Tombol Enter
                if (e.key === 'Enter') {
                    e.preventDefault();
                    activeOption = document.querySelector('.combobox-option.active');
                    if (activeOption) {
                        combobox.value = activeOption.textContent;
                        optionsContainer.style.display = 'none';
                    }
                }
            });
            
        });

         function formatRibuan(el) {
            // Hapus karakter non-angka
            let angka = el.value.replace(/[^0-9]/g, '');
            // Format ribuan
            el.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
        $("#addItem").click(function(){
            simpanPembelian('additem');
        });
        $("#simpanPembelian").click(function(){
            simpanPembelian('simpandata');
        });
        function simpanPembelian(fromdata){
            var csrfName = $('#csrf_token_name').val();
			var csrfHash = $('#csrf_token_value').val();
            var tglDatang = document.getElementById('tglDatang').value;
            var tglNota = document.getElementById('tglNota').value;
            var nomorNota = document.getElementById('nomorNota').value;
            var supp = document.getElementById('supp').value;
            var divisiId = document.getElementById('divisiId').value;
            var namaSpare = document.getElementById('combobox').value;
            var jmlPcs = document.getElementById('jmlPcs').value;
            var hrgPcs = document.getElementById('hrgPcs').value;
            // var keteranganss = document.getElementById('keteranganss').value;
            var codebeli = document.getElementById('codebeli').value;
            console.log(fromdata+' - '+namaSpare+' - '+jmlPcs+' - '+hrgPcs);
            if(tglDatang!="" && tglNota!="" && nomorNota!="" && supp!="" && divisiId!="" && codebeli!=""){
                $.ajax({
					url: '<?=base_url('data/simpanPembelian');?>',
					type: 'POST',
					dataType: 'json',
					data: {
						'tglDatang': tglDatang,
						'tglNota': tglNota,
						'nomorNota': nomorNota,
						'supp': supp,
						'divisiId': divisiId,
						'namaSpare': namaSpare,
						'jmlPcs': jmlPcs,
						'hrgPcs': hrgPcs,
						'codebeli': codebeli,
						'fromdata': fromdata,
    					[csrfName]: csrfHash
					},
					success: function(response) {
						console.log(response);
						if(response.status == 'success') {
							Swal.fire('Berhasil Menyimpan!', response.message, 'success');
                            loadItemDetil(response.kode_beli);
                            loadData();
						} else {
							Swal.fire('Gagal Menyimpan!', response.message, 'error');
						}
						$('#csrf_token_value').val(response.newCsrfHash);
						$('#codebeli').val(response.kode_beli);
					},
					error: function() {
						Swal.fire('Token Error 21', '', 'error');
					}
				});
            } else {
                Swal.fire('Gagal', 'Anda tidak mengisi data dengan benar!!', 'error');
            }
        }
        function loadItemDetil(kd){
            //var csrfName = $('#csrf_token_name').val();
			//var csrfHash = $('#csrf_token_value').val();
            $.ajax({
				url: '<?=base_url('data/detilPembelian');?>',
				type: 'GET',
				dataType: 'json',
				data: {'kd': kd},
				success: function(response) {
					console.log(response);
					if(response.status == 'success') {
						$('#tableItem').html(response.html);
					} else {
						Swal.fire('Gagal Mengambil Data!', response.message, 'error');
					}
					//$('#csrf_token_value').val(response.newCsrfHash);
				},
				error: function() {
					//Swal.fire('Token Error 22', '', 'error');
                    console.log('owek 22');
				}
			});
        }
        function hapusSparepart(id){
            const arrayData = id.split('_');
            var id = arrayData[0];
            var nm = arrayData[1];
            var qt = arrayData[2];
            var st = arrayData[3];
            Swal.fire({
                title: "Hapus Item?",
                text: ""+nm+" "+qt+" "+st,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus"
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?=base_url('data/hapusItemSp');?>',
                        type: 'GET',
                        dataType: 'json',
                        data: {'id': id},
                        success: function(response) {
                            console.log(response);
                            if(response.status == 'success') {
                                Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                                });
                                loadItemDetil(response.message);
                            } else {
                                Swal.fire('Gagal Mengambil Data!', response.message, 'error');
                            }
                        },
                        error: function() {
                            console.log('owek 52');
                        }
                    });
                }
            });
        }
    </script>
</body>
</html>