<!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title">Stok Gudang Sparepart</h1>
                <div class="breadcrumb">
                    <a href="#">Sparepart</a>
                    <span class="material-icons separator">chevron_right</span>
                    <span>Stok</span>
                    <span class="material-icons separator">chevron_right</span>
                    <span><?=$navigasi2=='stoksp' ? 'Gudang Spinning':'Gudang Weaving';?></span>
                </div>
            </div>
            
            <!-- Recent Transactions Table -->
            <div class="table-container">
                <div class="table-header">
                    <div>
                        <h3 class="table-title">Data Stok Sparepart <?=$navigasi2=='stoksp' ? 'Gudang Spinning':'Gudang Weaving';?></h3>
                        <small>Menampikan data stok sparepart tersedia di <?=$navigasi2=='stoksp' ? 'Gudang Spinning':'Gudang Weaving';?></small>
                    </div>
                    <div class="table-actions">
                        <button class="btn btn-outline btn-sm" onclick="addStokManual()">
                            <span class="material-icons">add_circle</span>
                            <span>Tambah Stok</span>
                        </button>
                    </div>
                </div>
                
                <table id="dataTable" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Nama Item</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Kode</th>
                            <th>Aksi</th>
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
                    <h3 class="modal-title">Input Data Sparepart</h3>
                </div>
                <button class="modal-close" id="closeAddModal">&times;</button>
            </div>
            <div class="modal-body">
                <div style="width:100%;background:#ccc;display:flex;padding:15px;border-radius:4px;margin-bottom:15px;">
                    <span><strong><?=$navigasi2=='stoksp' ? 'Gudang Spinning':'Gudang Weaving';?><strong></span>
                </div>
                <form>
                    <input type="hidden" id="tujuanGudang" value="<?=$navigasi2=='stoksp' ? 'Spinning':'Weaving';?>">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Kategori Barang</label>
                            <input type="text" class="form-control" placeholder="Pilih atau Ketik Kategori Baru" id="kategoriSparepart" list="kategoriList">
                            <datalist id="kategoriList">
                                <?php
                                $kat = $this->db->query("SELECT DISTINCT kategori_sp FROM table_sparepart ORDER BY kategori_sp");
                                if($kat->num_rows()>0){
                                foreach($kat->result() as $t){ echo "<option>".$t->kategori_sp."</option>"; }
                                } else {
                                    ?>                                 
                                <option>ELEKTRIK</option>   
                                <option>EQUIPMENT</option>
                                <option>LUBRICANT</option>
                                <option>MEKANIK</option>
                                    <?php
                                }
                                ?>
                            </datalist>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nama Sparepart</label>
                            <div class="custom-combobox">
                                <input type="text" class="combobox-input" placeholder="Pilih atau Ketik Sparepart Baru" id="combobox">
                                <div class="combobox-options" id="options">
                                    <!-- Opsi akan dimuat di sini -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Harga Satuan</label>
                            <input type="text" class="form-control" placeholder="Masukan Harga per Pcs" id="hrgpcs" onkeyup="formatRibuan(this)">
                        </div>
                    </div>
                    <div class="form-row">
                        
                        <div class="form-group">
                            <label class="form-label">Jumlah Stok Pcs</label>
                            <input type="text" class="form-control" style="border:1px solid red;" placeholder="Masukan berapa Pcs" id="pcsid">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Penempatan/Lokasi</label>
                            <input type="text" class="form-control" placeholder="Masukan lokasi penempatan item" id="locid">
                            <span style="color:#3b3a39;font-size:13px;">Contoh : RAK-A1 / RAK-A2</span>
                        </div>
                    </div>
                    
                    <input type="hidden" name="identifikasi" id="idencode" value="0">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Barcode / QR Code</label>
                            <input type="text" class="form-control" placeholder="Masukan Barcode / QR Code" id="qrcode">
                        </div>
                        <div class="form-group" >
                            <label class="form-label">&nbsp;</label>
                            <button class="btn btn-outline" type="button" id="generateQrCode">Generate QR Code</button>
                            <button class="btn btn-outline" type="button" id="startScan">Scan Code</button>
                        </div>
                    </div>
                    <div id="reader" style="width:100%; display: none;"></div>
                    <div id="qrcodeview"></div>
                    <p class="generated-data" id="qrcodeResult"></p>
                    
                    <!-- <div class="form-group">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" rows="3" id="keteranganss" placeholder="Keterangan sparepart"></textarea>
                    </div> -->
                    <input type="hidden" id="qr_code_data" value="0">
                    <!--                     
                    <div class="form-group">
                        <label class="form-label">Gambar Sparepart</label>
                        <input type="file" class="form-control">
                    </div> -->
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="cancelAddModal">Batal</button>
                <button class="btn btn-primary" onclick="simpanManual()">Simpan</button>
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