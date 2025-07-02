 <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>
    <!-- Tambahkan ini di bagian head -->
    
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode/html5-qrcode.min.js"></script>
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
            console.log('tampilkan '+sp);
            $('#tableBody').html('<tr><td colspan="6">Loading Data</td></tr>');
            $.ajax({
                url:"<?=base_url('data/showDataStok');?>",
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
        loadData('<?=$navigasi2;?>');
        
    function addStokManual(){
        addSparepartModal.classList.add('show');
    }
        
            
    const qrcodeResult22 = document.getElementById("qrcodeResult");
    const qrcodeResult23 = document.getElementById("qrcode");
    const reader = new Html5Qrcode("reader");

    document.getElementById("startScan").addEventListener("click", function() {
        document.getElementById("reader").style.display = "block";

        reader.start(
            { facingMode: "environment" },
            {
                fps: 10,
                qrbox: 250
            },
            (decodedText, decodedResult) => {
                // Success callback
                qrcodeResult23.value = "" + decodedText;
                reader.stop().then(() => {
                    buatkanCode();
                    document.getElementById("reader").style.display = "none";
                });
            },
            (errorMessage) => {
                // Error callback (opsional)
                console.warn("Scan error", errorMessage);
            }
        ).catch((err) => {
            console.error("Camera start failed", err);
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
            const kategoriSparepartInput = document.getElementById('kategoriSparepart');
            const combobox = document.getElementById('combobox');
            const optionsContainer = document.getElementById('options');
            
            let availableOptions = [];

            async function loadSparepartsByCategory(category) {
                if (category.trim() === '') {
                    availableOptions = [];
                    showOptions([]);
                    return;
                }

                try {
                    // *** UBAH URL INI UNTUK MENGARAH KE CONTROLLER CI3 ANDA ***
                    // Asumsi: Base URL CI3 Anda adalah http://localhost/nama_proyek_ci/
                    // Dan Anda memiliki controller 'Api' dengan method 'get_spareparts_by_category'
                    const baseUrl = '<?=base_url();?>'; // Ganti dengan base URL proyek CI Anda
                    const apiUrl = `${baseUrl}apis/get_spareparts_by_category?category=${encodeURIComponent(category)}`;
                    
                    const response = await fetch(apiUrl);
                    
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }

                    const data = await response.json();
                    
                    if (data.error) {
                        console.error("Server error:", data.error);
                        availableOptions = [];
                        showOptions([]);
                        return;
                    }

                    availableOptions = data;
                    console.log("Nama sparepart untuk kategori '" + category + "':", availableOptions);
                    
                    if (document.activeElement === combobox || combobox.value.trim() !== '') {
                        const inputValue = combobox.value.toLowerCase();
                        const filteredOptions = availableOptions.filter(option => 
                            option.toLowerCase().includes(inputValue)
                        );
                        showOptions(filteredOptions);
                    } else {
                        showOptions([]); // Sembunyikan jika combobox tidak aktif dan tidak ada input
                    }

                } catch (error) {
                    console.error("Gagal memuat nama sparepart:", error);
                    availableOptions = [];
                    showOptions([]);
                }
            }

            kategoriSparepartInput.addEventListener('input', function() {
                const category = this.value;
                loadSparepartsByCategory(category);
            });

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
            
            combobox.addEventListener('focus', function() {
                if (kategoriSparepartInput.value.trim() !== '') {
                    showOptions(availableOptions);
                } else {
                    optionsContainer.innerHTML = '<div class="combobox-option">Silakan isi kategori terlebih dahulu.</div>';
                    optionsContainer.style.display = 'block';
                }
            });
            
            combobox.addEventListener('input', function() {
                const inputValue = this.value.toLowerCase();
                const filteredOptions = availableOptions.filter(option => 
                    option.toLowerCase().includes(inputValue)
                );
                showOptions(filteredOptions);
                
                if (inputValue === '') {
                    showOptions(availableOptions);
                }
            });
            
            document.addEventListener('click', function(e) {
                const isClickInsideCombobox = combobox.contains(e.target) || optionsContainer.contains(e.target);
                if (!isClickInsideCombobox) {
                    optionsContainer.style.display = 'none';
                }
            });
            
            combobox.addEventListener('keydown', function(e) {
                const options = document.querySelectorAll('.combobox-option');
                let activeOption = document.querySelector('.combobox-option.active');
                
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
                    if (document.querySelector('.combobox-option.active')) {
                        document.querySelector('.combobox-option.active').scrollIntoView({ block: 'nearest' });
                    }
                }
                
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
                     if (document.querySelector('.combobox-option.active')) {
                        document.querySelector('.combobox-option.active').scrollIntoView({ block: 'nearest' });
                    }
                }
                
                if (e.key === 'Enter') {
                    e.preventDefault();
                    activeOption = document.querySelector('.combobox-option.active');
                    if (activeOption) {
                        combobox.value = activeOption.textContent;
                        optionsContainer.style.display = 'none';
                    }
                }
            });
            
            function buatkanCode(){
                var qrtext = $('#qrcode').val().trim();
                
                if(!qrtext) {
                    $('#qrcodeResult').html('<p style="color:red;">Masukkan teks/kode terlebih dahulu</p>');
                    return;
                }
                
                $('#qrcodeResult').html('<p>Membuat QR Code...</p>');
                var csrfName = $('#csrf_token_name').val();
			    var csrfHash = $('#csrf_token_value').val();
                $.ajax({
                    url: '<?php echo site_url("qrcode_generator/generate"); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: { qrcode: qrtext, [csrfName]: csrfHash },
                    success: function(response) {
                        if(response.error) {
                            $('#qrcodeResult').html('<p class="error">'+response.error+'</p>');
                        } else if(response.success) {
                            $('#qrcodeResult').html(
                                '<p>QR Code berhasil dibuat!</p>' +
                                '<img src="'+response.image_url+'" alt="QR Code">' +
                                '<p><a href="'+response.image_url+'" download>Download QR Code</a></p>'
                            );
                        }
                        $('#csrf_token_value').val(response.newCsrfHash);
                        $('#qr_code_data').val(response.image_url);
                    },
                    error: function(xhr, status, error) {
                        $('#qrcodeResult').html('<p class="error">Terjadi kesalahan: '+error+'</p>');
                    }
                });
            }
            $('#generateQrCode').click(function() {
                console.log('tombol di klik');
                buatkanCode();
            });
            
            
            
        });
        function simpanManual(){
            var tujuanGudang = document.getElementById('tujuanGudang').value;
            var kat = document.getElementById('kategoriSparepart').value;
            var nmsp = document.getElementById('combobox').value;
            var hrg = document.getElementById('hrgpcs').value;
            var pcs = document.getElementById('pcsid').value;
            var loc = document.getElementById('locid').value;
            var qrcode = document.getElementById('qrcode').value;
            var qrcode2 = document.getElementById('qr_code_data').value;
            if(tujuanGudang == ''){
                Swal.fire('Gagal Menyimpan!', 'Tujuan penambahan stok tidak ada.!', 'error');
            } else {
                if(kat!="" && nmsp!="" && hrg!="" && loc!=""){
                    if(qrcode==""){
                        Swal.fire('Gagal Menyimpan!', 'Anda harus mengisi QR Code.!', 'error');
                    } else {
                        if(qrcode2=="" || qrcode2=="null" || qrcode2=="0"){
                            Swal.fire('Info', 'Silahkan klik generate QR Code', 'info');
                        } else {
                            var csrfName = $('#csrf_token_name').val();
                            var csrfHash = $('#csrf_token_value').val();
                            $.ajax({
                                url: '<?php echo site_url("proses/inputStok"); ?>',
                                type: 'POST',
                                dataType: 'json',
                                data: { tujuanGudang: tujuanGudang,
                                        kat: kat,
                                        nmsp: nmsp,
                                        hrg: hrg,
                                        pcs: pcs,
                                        loc: loc,
                                        qrcode2: qrcode2,
                                        qrcode: qrcode,
                                        [csrfName]: csrfHash },
                                success: function(response) {
                                    if(response.statusCode==200) {
                                        Swal.fire('Berhasil Menyimpan!', response.msg, 'success');
                                    } else {
                                        Swal.fire('Gagal Menyimpan!', response.msg, 'error');
                                    }
                                    document.getElementById('kategoriSparepart').value = '';
                                    document.getElementById('combobox').value = '';
                                    document.getElementById('hrgpcs').value = '';
                                    document.getElementById('pcsid').value = '';
                                    document.getElementById('locid').value = '';
                                    document.getElementById('qrcode').value = '';
                                    document.getElementById('qr_code_data').value = '';
                                    $('#qrcodeResult').html('');
                                    loadData('<?=$navigasi2;?>');
                                    $('#csrf_token_value').val(response.newCsrfHash);
                                },
                                error: function(xhr, status, error) {
                                    Swal.fire('error code :21 '+error);
                                }
                            });
                        }
                    }
                } else {
                    Swal.fire('Gagal Menyimpan!', 'Anda harus mengisi data sparepart dengan benar.!', 'error');
                }
            }
        }
        function formatRibuan(el) { 
            let nilai = el.value.replace(/[^0-9,]/g, '');
            let [bilangan, desimal] = nilai.split(',');
            bilangan = bilangan.replace(/^0+(?=\d)/, '');
            bilangan = bilangan.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            if (desimal !== undefined) {
                desimal = desimal.substring(0, 3);
                el.value = `${bilangan},${desimal}`;
            } else {
                el.value = bilangan;
            }
        }
        function saveAndPrint(initCode, kodeSparepart){
            $.ajax({
                url: '<?=base_url('cetak/code/'); ?>'+initCode+'/'+kodeSparepart+'',
                type: 'get',
                dataType: 'json',
                data: { initCode: initCode, kodeSparepart: kodeSparepart },
                success: function(response) {
                    if(response.status == "error"){
                        Swal.fire('Gagal Proses!', response.message, 'error');
                    } else {
                        Swal.fire('Menyimpan kode', 'Masuk dalam antrian cetak', 'success');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(''+xhr);
                    console.log(''+status);
                    console.log(''+error);
                }
            });
        }
    </script>
</body>
</html>