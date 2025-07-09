<?php
            if($navigasi2=="sp"){
                $tujuan_untuk = "Spinning";
            } else {
                $tujuan_untuk = "Weaving";
            }
            ?>
        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title">Riwayat Pemakaian</h1>
                <div class="breadcrumb">
                    <a href="#">Sparepart</a>
                    <span class="material-icons separator">chevron_right</span>
                    <span>Riwayat</span>
                    <span class="material-icons separator">chevron_right</span>
                    <span>Pemakaian</span>
                </div>
            </div>
            
            
            <!-- Recent Transactions Table -->
            <div class="table-container">
                <div class="table-header">
                    <div>
                        <h3 class="table-title">Riwayat Pemakaian <?=$tujuan_untuk;?></h3>
                        <small>Menampikan data riwayat pemakaian sparepart untuk departement <?=$tujuan_untuk;?>.</small>
                    </div>
                    
                </div>
                
                <table id="dataTable" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Operator</th>
                            <th>Sparepart</th>
                            <th>Kode</th>
                            <th>Jumlah</th>
                            <th>Mesin</th>
                            <th>Bekas</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        
                    </tbody>
                </table>
                
                <!-- <div class="pagination">
                    <button>&laquo;</button>
                    <button class="active">1</button>
                    <button>2</button>
                    <button>3</button>
                    <button>&raquo;</button>
                </div> -->
            </div>

            <!-- Button Examples -->
            
        </main>
    </div>
    <input type="hidden" id="csrf_token_name" value="<?= $this->security->get_csrf_token_name(); ?>">
	<input type="hidden" id="csrf_token_value" value="<?= $this->security->get_csrf_hash(); ?>">
    <!-- Add Sparepart Modal (Large) -->
    <div class="modal-overlay" id="addSparepartModal">
        <div class="modal modal-lg">
            <div class="modal-header">
                <div>
                    <h3 class="modal-title">Detail Pemakaian</h3>
                </div>
                <button class="modal-close" id="closeAddModal" onclick="closeModal('addSparepartModal')">&times;</button>
            </div>
            <div class="modal-body" id="modalDetilBody">
                <div style="width:100%;background:#ccc;display:flex;flex-direction:column;gap:5px;padding:15px;border-radius:4px;margin-bottom:15px;">
                    <strong>Item Pembelian : </strong>
                    <p id="itemPembelianQuote"></p>
                    <input type="hidden" id="idDetilPem" value="0">
                    <input type="hidden" id="tujuanGudang" value="<?=$tujuan_untuk;?>">
                </div>
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="cancelAddModal" onclick="closeModal('addSparepartModal')">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal (Small) -->
    <div class="modal-overlay" id="confirmModal">
        <div class="modal modal-sm">
            <div class="modal-header">
                <h3 class="modal-title">Konfirmasi</h3>
                <button class="modal-close" id="closeConfirmModal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus sparepart ini?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="cancelConfirmModal">Batal</button>
                <button class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>