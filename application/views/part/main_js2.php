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
            }, 800);
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
        loadData('<?=$navigasi2;?>');
        function tarikGudang(tujuan,id){
            $('#idencode').val('0');
            $('#qr_code_data').val('0');
            $.ajax({
                url:"<?=base_url('data/showItemSatuan');?>",
                type: "GET",
                dataType: 'json',
                data: {"id":id},
                cache: false,
                success: function(response){
                    $('#itemPembelianQuote').html(response.html);
                    $('#idDetilPem').val(''+response.idpemb);
                }
            });
            addSparepartModal.classList.toggle('show');
        }
        
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
            // const cek1 = document.getElementById('duscek');
            // const cek2 = document.getElementById('packcek');
            // const cek3 = document.getElementById('pcscek');
            // cek1.addEventListener('click', () => {
            //     cek2.checked = false;
            //     cek3.checked = false;
            //     $('#idencode').val('dus');
            // });
            // cek2.addEventListener('click', () => {
            //     cek1.checked = false;
            //     cek3.checked = false;
            //     $('#idencode').val('pack');
            // });
            // cek3.addEventListener('click', () => {
            //     cek2.checked = false;
            //     cek1.checked = false;
            //     $('#idencode').val('pcs');
            // });
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
            
            $('#simpanTarikPembelian').click(function() {
                var csrfName = $('#csrf_token_name').val();
			    var csrfHash = $('#csrf_token_value').val();
                console.log("Mengirim CSRF Name:", csrfName);
                console.log("Mengirim CSRF Hash:", csrfHash);
                var idDetilPem = $('#idDetilPem').val();
                if(idDetilPem!="" && idDetilPem!=0){
                    var kategoriSparepart = $('#kategoriSparepart').val();
                    var namaSparepart = $('#combobox').val();
                    //var idencode = $('#idencode').val();
                    var locid = $('#locid').val();
                    var qr_code_data = $('#qrcode').val();
                    var qr_code_data2 = $('#qr_code_data').val();
                    var tujuanGudang = $('#tujuanGudang').val();
                    //var dusid = $('#dusid').val();
                    //var packid = $('#packid').val();
                    var pcsid = $('#pcsid').val();
                    if(kategoriSparepart!="" &&  namaSparepart!="" && tujuanGudang!=""){
                        if(qr_code_data2=="" || qr_code_data2=="null" || qr_code_data2=="0"){
                            Swal.fire('Gagal Menyimpan!', 'Silahkan generate QR Code atau Scan Code', 'error');
                        } else {
                            $.ajax({
                                url: '<?=base_url("data/simpan_tarikan"); ?>',
                                type: 'POST',
                                dataType: 'json',
                                data: { 
                                    idDetilPem: idDetilPem,
                                    kategoriSparepart: kategoriSparepart,
                                    namaSparepart: namaSparepart,
                                    locid: locid,
                                    qr_code_data: qr_code_data,
                                    tujuanGudang: tujuanGudang,
                                    pcsid: pcsid,
                                    [csrfName]: csrfHash 
                                },
                                success: function(response) {
                                    $('#csrf_token_value').val(response.newCsrfHash);
                                    if(response.status == "success"){
                                        Swal.fire('Berhasil Menyimpan!', response.message, 'success').then((result) => {
                                            addSparepartModal.classList.remove('show');
                                        });
                                    } else {
                                        Swal.fire('Gagal Menyimpan!', response.message, 'error');
                                    }
                                    loadData('<?=$navigasi2;?>');
                                },
                                error: function(xhr, status, error) {
                                    console.log(''+error);
                                    console.log(''+xhr);
                                    console.log(''+status);
                                }
                            });
                        }
                    } else {
                        Swal.fire('Gagal Menyimpan!', 'Anda harus mengisi kategori dan nama sparepart.', 'error');
                    }
                } else {
                    Swal.fire('Gagal Menyimpan!', 'Token Error.', 'error');
                }
            });
            
        });
    
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
    
    function viewDetil(id){
        $('#modalDetilBody').html('Loading...');
        $('#addSparepartModal221').addClass('show');
        $.ajax({
            url: '<?=base_url("data/showDetilPenarikan"); ?>',
            type: 'GET',
            data: { "id":id },
            success: function(response) {
                $('#modalDetilBody').html(response);
                loadRetur(id);
            },
            error: function(xhr, status, error) {
                    console.log(''+error);
                    console.log(''+xhr);
                    console.log(''+status);
                }
        });
        
        //addSparepartModal.classList.add('show');
    }
    function closeModal(mdl){ $('#'+mdl+'').removeClass('show');}
    function hapusProsesTarik(inputanDari, id){
        //Swal.fire('oke di klik'+inputanDari+' - '+id);
        Swal.fire({
        title: "Hapus proses tarik ?",
        text: "Ini akan mengembalikan posisi item barang ke kantor",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Hapus"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?=base_url("data/hapsPenarikan"); ?>',
                    type: 'GET',
                    dataType: 'json',
                    data: { "id":id, "inputanDari":inputanDari },
                    success: function(response) {
                        if(response.status == 200){
                            Swal.fire('Berhasil Hapus!', response.message, 'success');
                        } else {
                            Swal.fire('Gagal Hapus!', response.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                            console.log(''+error);
                            console.log(''+xhr);
                            console.log(''+status);
                        }
                });
            }
        });
        
    }
    function testReturn(){
        var id1 = document.getElementById('idrwytkid').value;
        var id2 = document.getElementById('iddetilpemid').value;
        var jml = document.getElementById('jmlReturId').value;
        var txt = document.getElementById('textReturId').value;
        if(id1!='' && id2!='' && jml!='' && txt!=''){
            Swal.fire({
            title: "Retur Item ?",
            text: "Anda akan meretur "+jml+" item ke admin",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Retur"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?=base_url("data/returPenarikan"); ?>',
                        type: 'GET',
                        dataType: 'json',
                        data: { "id1":id1, "id2":id2, "jml":jml, "txt":txt },
                        success: function(response) {
                            if(response.status == 200){
                                Swal.fire('Berhasil Retur!', response.message, 'success');
                                loadRetur(id1);
                                document.getElementById('jmlReturId').value = '';
                                document.getElementById('textReturId').value = '';
                            } else {
                                Swal.fire('Gagal Retur!', response.message, 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(''+error);
                            console.log(''+xhr);
                            console.log(''+status);
                        }
                    });
                }
            });
        } else {
            Swal.fire('Peringatan .! ', 'Anda harus mengisi semua data.', 'info');
        }
    }
    function loadRetur(id){
        $.ajax({
            url: '<?=base_url("data/returPenarikandata"); ?>',
            type: 'GET',
            data: { "id":id },
            success: function(response) {
                $('#tableRetur').html(response);
            },
            error: function(xhr, status, error) {
                console.log(''+error);
                console.log(''+xhr);
                console.log(''+status);
            }
        });
    }
    function hpsReturan(id,id2){
        Swal.fire({
        title: "Batalkan Retur ?",
        text: "Item akan kembali masuk ke stok sparepart",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?=base_url("data/btlRetur"); ?>',
                    type: 'GET',
                    dataType: 'json',
                    data: { "id":id },
                    success: function(response) {
                        if(response.status == 200){
                            Swal.fire('Berhasil Hapus!', response.message, 'success');
                        } else {
                            Swal.fire('Gagal Hapus!', response.message, 'error');
                        }
                        loadRetur(id2);
                    },
                    error: function(xhr, status, error) {
                            console.log(''+error);
                            console.log(''+xhr);
                            console.log(''+status);
                        }
                });
            }
        });
    }
    </script>
</body>
</html>