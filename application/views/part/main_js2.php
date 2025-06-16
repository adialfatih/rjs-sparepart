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
        // function hapusSparepart(id){
        //     const arrayData = id.split('_');
        //     var id = arrayData[0];
        //     var nm = arrayData[1];
        //     var qt = arrayData[2];
        //     var st = arrayData[3];
        //     Swal.fire({
        //         title: "Hapus Item?",
        //         text: ""+nm+" "+qt+" "+st,
        //         icon: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#3085d6",
        //         cancelButtonColor: "#d33",
        //         confirmButtonText: "Hapus"
        //         }).then((result) => {
        //         if (result.isConfirmed) {
        //             Swal.fire({
        //             title: "Deleted!",
        //             text: "Your file has been deleted.",
        //             icon: "success"
        //             });
        //         }
        //     });
        // }
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
            const cek1 = document.getElementById('duscek');
            const cek2 = document.getElementById('packcek');
            const cek3 = document.getElementById('pcscek');
            cek1.addEventListener('click', () => {
                cek2.checked = false;
                cek3.checked = false;
            });
            cek2.addEventListener('click', () => {
                cek1.checked = false;
                cek3.checked = false;
            });
            cek3.addEventListener('click', () => {
                cek2.checked = false;
                cek1.checked = false;
            });
            
            
        });
    </script>
</body>
</html>