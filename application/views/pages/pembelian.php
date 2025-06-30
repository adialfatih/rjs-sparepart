<!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title">Pembelian Sparepart</h1>
                <div class="breadcrumb">
                    <a href="#">Sparepart</a>
                    <span class="material-icons separator">chevron_right</span>
                    <span>Pembelian</span>
                </div>
            </div>

            
            <!-- Recent Transactions Table -->
            <div class="table-container">
                <div class="table-header">
                    <h3 class="table-title">Data Pembelian Sparepart</h3>
                    <div class="table-actions">
                        <button class="btn btn-outline btn-sm">
                            <span class="material-icons">file_download</span>
                            <span>Export</span>
                        </button>
                        <button class="btn btn-primary btn-sm" id="addSparepartBtn">
                            <span class="material-icons">add</span>
                            <span>Input Pembelian</span>
                        </button>
                    </div>
                </div>
                
                <table id="sparepartTable" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Tanggal Datang</th>
                            <th>Tanggal Nota</th>
                            <th>Tanggal Input</th>
                            <th>Nomor Nota / SJ</th>
                            <th>PPN</th>
                            <th>PPh</th>
                            <th>Total Harga Barang</th>
                            <th>Supplier</th>
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
                <h3 class="modal-title">Input Pembelian Sparepart</h3>
                <button class="modal-close" id="closeAddModal">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Tanggal Datang</label>
                            <input type="date" class="form-control" placeholder="Tanggal Datang" id="tglDatang">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanggal Nota</label>
                            <input type="date" class="form-control" placeholder="Tanggal Nota" id="tglNota">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nomor Nota/SJ</label>
                            <input type="text" class="form-control" placeholder="Masukan Nomor Nota / SJ" id="nomorNota">
                        </div>
                        
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Supplier</label>
                            <input type="text" class="combobox-input" placeholder="Masukan Supplier" id="supp" list="supp2">
                            <datalist id="supp2">
                                <?php foreach($supplier->result() as $t){ echo "<option>".strtoupper($t->supp)."</option>"; }?>
                            </datalist>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">PPN (Nominal)</label>
                            <input type="text" class="combobox-input" placeholder="Masukan Nominal PPN" id="noppn" onkeyup="formatRibuan(this)">
                        </div>
                        <div class="form-group">
                            <label class="form-label">PPH (Persen)</label>
                            <input type="text" class="combobox-input" placeholder="Ex: 0.03% / 2%" id="nopph">
                        </div>
                        <div class="form-group">
                            <label class="form-label">PPH dibayar oleh</label>
                            <select class="form-control" id="dibayarOleh">
                                <option value="">Pilih</option>
                                <option value="penjual">Supplier</option>
                                <option value="pembeli">PT. Rindang Jati</option>
                            </select>
                        </div>
                    </div>
                    
                    <span>Masukan item sparepart yang di beli.</span>
                    <hr>
                    
                    <div class="form-row" style="margin-top:15px;">
                        <div class="form-group">
                            <label class="form-label">Nama Sparepart</label>
                            <div class="custom-combobox">
                                <input type="text" class="combobox-input" placeholder="Ketik atau pilih..." id="combobox">
                                <div class="combobox-options" id="options">
                                    <!-- Opsi akan dimuat di sini -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row" style="margin-top:-5px;border-bottom:1px solid #000;">
                        <div class="form-group">
                            <label class="form-label">Jumlah</label>
                            <input type="text" class="form-control" id="jmlPcs" placeholder="Ex: 10-Kg, 100-Pcs">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Harga /item</label>
                            <input type="text" class="form-control" id="hrgPcs" placeholder="Masukan Harga Satuan" onkeyup="formatRibuan(this)">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Divisi</label>
                            <select class="form-control" id="divisiId">
                                <option value="">Pilih Divisi</option>
                                <option value="Gudang Weaving">Gudang Weaving</option>
                                <option value="Gudang Spinning">Gudang Spinning</option>
                                <option value="Pemeliharaan">Pemeliharaan</option>
                            </select>
                        </div>
                        <div class="form-group2">
                            <label class="form-label">&nbsp;</label>
                            <button type="button" class="btn btn-secondary" style="padding:7px 10px;" id="addItem">
                                <span class="material-icons">add</span>
                                <span>Tambah Item</span>
                            </button>
                        </div>
                    </div>
                    <div id="tableItem"></div>
                    <!-- <div class="form-group">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" rows="3" id="keteranganss" placeholder="Keterangan sparepart"></textarea>
                    </div> -->
                    <input type="hidden" id="codebeli" value="0">
                    <!--                     
                    <div class="form-group">
                        <label class="form-label">Gambar Sparepart</label>
                        <input type="file" class="form-control">
                    </div> -->
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="cancelAddModal">Batal</button>
                <button class="btn btn-primary" id="simpanPembelian">Simpan</button>
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