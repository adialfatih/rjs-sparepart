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
        // addSparepartBtn.addEventListener('click', () => {
        //     addSparepartModal.classList.add('show');
        // });

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
        function viewPemakaian(id){
            $.ajax({
                url:"<?=base_url('detil-pemakaian');?>",
                type: "GET",
                data: {"id":id},
                cache: false,
                success: function(dataResult){
                    $('#modalDetilBody').html(dataResult);
                    addSparepartModal.classList.add('show');
                }
            });
        }
        function closeModal(mdl){
            const a2 = document.getElementById(''+mdl+'');
            a2.classList.remove('show');
        }
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
                url:"<?=base_url('data-pemakaian');?>",
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
        function hpsPemakaian(id,txt){
            Swal.fire({
            title: "Hapus Pemakaian ?",
            text: ""+txt,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?=base_url("data-hapus-pakai"); ?>',
                        type: 'GET',
                        dataType: 'json',
                        data: { "id":id },
                        success: function(response) {
                            if(response.status == 200){
                                Swal.fire('Berhasil Hapus!', response.message, 'success');
                                loadData('<?=$navigasi2;?>');
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
    
    </script>
</body>
</html>