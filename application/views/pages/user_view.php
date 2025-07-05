<!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title">Pengguna</h1>
                <div class="breadcrumb">
                    <a href="#">Home</a>
                    <span class="material-icons separator">chevron_right</span>
                    <span>System</span>
                    <span class="material-icons separator">chevron_right</span>
                    <span>Users</span>
                </div>
            </div>


            <!-- Recent Transactions Table -->
            <div class="table-container">
                <?php if($sess_akses=="user"){
                    echo '<h3 class="table-title">Anda tidak memiliki akses ke halaman ini.!!</h3>';
                } else { ?>
                <div class="table-header">
                    <h3 class="table-title">Data user yang memiliki akses login.</h3>
                    <div class="table-actions">
                        <button class="btn btn-primary btn-sm" id="addSparepartBtn">
                            <span class="material-icons">add</span>
                            <span>Tambah User</span>
                        </button>
                    </div>
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Username</th>
                            <th>Hak Akses</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no=1;
                        foreach($records->result() as $val):
                        $id_user = sha1($val->iduser);
                        if($val->akses == "admin"){
                            $akses = '<span class="status-badge success">Admin Purchasing</span>';
                        } else {
                            if($val->akses == "user"){
                                $akses = '<span class="status-badge warning">Admin Sparepart</span>';
                            } else {
                                $akses = '<span class="status-badge danger">Security</span>';
                            }
                        }
                        if($val->username == "admin"){} else {
                        ?>
                        <tr>
                            <td><?=$no;?></td>
                            <td><?=$val->nama_user;?></td>
                            <td><?=$val->username;?></td>
                            <td><?=$akses;?></td>
                            <td>
                                <button class="btn btn-icon btn-sm btn-outline" onclick="deleteUser('<?=$id_user;?>','<?=$val->nama_user;?>')">
                                    <span class="material-icons">delete</span>
                                </button>
                            </td>
                        </tr>
                        <?php $no++; } endforeach; ?>
                    </tbody>
                </table>
                <?php } ?>
                
            </div>

        </main>
    </div>

    <div class="modal-overlay" id="addSparepartModal">
        <div class="modal modal-lg">
            <div class="modal-header">
                <h3 class="modal-title">Tambah User Baru</h3>
                <button class="modal-close" id="closeAddModal">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nama User</label>
                            <input type="text" class="form-control" placeholder="Masukan nama user" id="namauser">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Username Login</label>
                            <input type="text" class="form-control" placeholder="Masukan username untuk login" id="usernameid">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Hak Akses</label>
                            <select class="form-control" id="hakakses">
                                <option value="">Pilih Hak Akses</option>
                                <option value="user">Admin Gudang Sparepart</option>
                                <option value="satpam">Security</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password Login</label>
                            <input type="text" class="form-control" placeholder="Masukan password login user" id="passwordid">
                        </div>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="cancelAddModal">Batal</button>
                <button class="btn btn-primary" id="simpanUser">Simpan</button>
            </div>
        </div>
    </div>
    <input type="hidden" id="csrf_token_name" value="<?= $this->security->get_csrf_token_name(); ?>">
	<input type="hidden" id="csrf_token_value" value="<?= $this->security->get_csrf_hash(); ?>">
    <!-- Confirmation Modal (Small) -->
    <div class="modal-overlay" id="confirmModal">
        <div class="modal modal-sm">
            <div class="modal-header">
                <h3 class="modal-title">Konfirmasi Hapus</h3>
                <button class="modal-close" id="closeConfirmModal">&times;</button>
            </div>
            <div class="modal-body">
                <p id="hapusUserNotif"></p>
                <input type="hidden" id="idusers" value="0">
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="cancelConfirmModal">Batal</button>
                <button class="btn btn-danger" id="hapusthisuser">Hapus</button>
            </div>
        </div>
    </div>