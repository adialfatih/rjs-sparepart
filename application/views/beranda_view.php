<!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title">Dashboard</h1>
                <div class="breadcrumb">
                    <a href="#">Home</a>
                    <span class="material-icons separator">chevron_right</span>
                    <span>Dashboard</span>
                </div>
            </div>

            <!-- Dashboard Cards -->
            <!-- <div class="card-grid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Total Sparepart</h3>
                        <div class="card-icon primary">
                            <span class="material-icons">inventory</span>
                        </div>
                    </div>
                    <div class="card-value">1,248</div>
                    <div class="card-footer positive">
                        <span class="material-icons">trending_up</span>
                        <span>12% from last month</span>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Stok Minimum</h3>
                        <div class="card-icon warning">
                            <span class="material-icons">warning</span>
                        </div>
                    </div>
                    <div class="card-value">36</div>
                    <div class="card-footer negative">
                        <span class="material-icons">trending_down</span>
                        <span>5% from last month</span>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Transaksi Hari Ini</h3>
                        <div class="card-icon success">
                            <span class="material-icons">receipt</span>
                        </div>
                    </div>
                    <div class="card-value">48</div>
                    <div class="card-footer positive">
                        <span class="material-icons">trending_up</span>
                        <span>8% from yesterday</span>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Permintaan</h3>
                        <div class="card-icon danger">
                            <span class="material-icons">assignment</span>
                        </div>
                    </div>
                    <div class="card-value">12</div>
                    <div class="card-footer positive">
                        <span class="material-icons">trending_up</span>
                        <span>20% from last week</span>
                    </div>
                </div>
            </div> -->

            <!-- Recent Transactions Table -->
            <!-- <div class="table-container">
                <div class="table-header">
                    <h3 class="table-title">Sparepart Stok Minimum</h3>
                    <div class="table-actions">
                        <button class="btn btn-outline btn-sm">
                            <span class="material-icons">file_download</span>
                            <span>Export</span>
                        </button>
                        <button class="btn btn-primary btn-sm" id="addSparepartBtn">
                            <span class="material-icons">add</span>
                            <span>Tambah</span>
                        </button>
                    </div>
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Sparepart</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Stok</th>
                            <th>Minimum</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>SP-001</td>
                            <td>Bearing 6204ZZ</td>
                            <td>Bearing</td>
                            <td>Rak A-12</td>
                            <td>3</td>
                            <td>10</td>
                            <td><span class="status-badge danger">Kritis</span></td>
                            <td>
                                <button class="btn btn-icon btn-sm btn-outline">
                                    <span class="material-icons">edit</span>
                                </button>
                                <button class="btn btn-icon btn-sm btn-outline">
                                    <span class="material-icons">delete</span>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>SP-005</td>
                            <td>V-Belt A-45</td>
                            <td>Belt</td>
                            <td>Rak B-03</td>
                            <td>5</td>
                            <td>15</td>
                            <td><span class="status-badge danger">Kritis</span></td>
                            <td>
                                <button class="btn btn-icon btn-sm btn-outline">
                                    <span class="material-icons">edit</span>
                                </button>
                                <button class="btn btn-icon btn-sm btn-outline">
                                    <span class="material-icons">delete</span>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>SP-012</td>
                            <td>Oil Seal 25x42x7</td>
                            <td>Seal</td>
                            <td>Rak C-08</td>
                            <td>8</td>
                            <td>20</td>
                            <td><span class="status-badge warning">Hati-hati</span></td>
                            <td>
                                <button class="btn btn-icon btn-sm btn-outline">
                                    <span class="material-icons">edit</span>
                                </button>
                                <button class="btn btn-icon btn-sm btn-outline">
                                    <span class="material-icons">delete</span>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>SP-018</td>
                            <td>O-Ring 3mm</td>
                            <td>Seal</td>
                            <td>Rak D-15</td>
                            <td>12</td>
                            <td>30</td>
                            <td><span class="status-badge warning">Hati-hati</span></td>
                            <td>
                                <button class="btn btn-icon btn-sm btn-outline">
                                    <span class="material-icons">edit</span>
                                </button>
                                <button class="btn btn-icon btn-sm btn-outline">
                                    <span class="material-icons">delete</span>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>SP-025</td>
                            <td>Bolt M8x30</td>
                            <td>Fastener</td>
                            <td>Rak E-22</td>
                            <td>25</td>
                            <td>50</td>
                            <td><span class="status-badge success">Aman</span></td>
                            <td>
                                <button class="btn btn-icon btn-sm btn-outline">
                                    <span class="material-icons">edit</span>
                                </button>
                                <button class="btn btn-icon btn-sm btn-outline">
                                    <span class="material-icons">delete</span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="pagination">
                    <button>&laquo;</button>
                    <button class="active">1</button>
                    <button>2</button>
                    <button>3</button>
                    <button>&raquo;</button>
                </div>
            </div> -->

            <!-- Button Examples -->
            <div class="table-container" style="margin-top: 1.5rem;">
                <h3 class="table-title">Welcome To Dashboard</h3>
                <div style="display: flex; flex-wrap: wrap; gap: 10px; padding: 1rem 0;">
                    <!-- <button class="btn btn-primary">
                        <span class="material-icons">save</span>
                        <span>Primary</span>
                    </button>
                    <button class="btn btn-secondary">
                        <span class="material-icons">add</span>
                        <span>Secondary</span>
                    </button>
                    <button class="btn btn-success">
                        <span class="material-icons">check</span>
                        <span>Success</span>
                    </button>
                    <button class="btn btn-danger">
                        <span class="material-icons">delete</span>
                        <span>Danger</span>
                    </button>
                    <button class="btn btn-warning">
                        <span class="material-icons">warning</span>
                        <span>Warning</span>
                    </button>
                    <button class="btn btn-outline">
                        <span class="material-icons">edit</span>
                        <span>Outline</span>
                    </button>
                    <button class="btn btn-primary btn-sm">
                        <span class="material-icons">download</span>
                        <span>Small</span>
                    </button>
                    <button class="btn btn-secondary btn-lg">
                        <span class="material-icons">print</span>
                        <span>Large</span>
                    </button>
                    <button class="btn btn-icon btn-primary">
                        <span class="material-icons">search</span>
                    </button>
                    <button class="btn btn-icon btn-danger">
                        <span class="material-icons">close</span>
                    </button> -->
                </div>
            </div>
        </main>
    </div>

    <!-- Add Sparepart Modal (Large) -->
    <div class="modal-overlay" id="addSparepartModal">
        <div class="modal modal-lg">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Sparepart Baru</h3>
                <button class="modal-close" id="closeAddModal">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Kode Sparepart</label>
                            <input type="text" class="form-control" placeholder="SP-XXX">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nama Sparepart</label>
                            <input type="text" class="form-control" placeholder="Nama sparepart">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Kategori</label>
                            <select class="form-control">
                                <option value="">Pilih Kategori</option>
                                <option value="bearing">Bearing</option>
                                <option value="belt">Belt</option>
                                <option value="seal">Seal</option>
                                <option value="fastener">Fastener</option>
                                <option value="electrical">Electrical</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Lokasi Gudang</label>
                            <input type="text" class="form-control" placeholder="Rak A-12">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Stok Awal</label>
                            <input type="number" class="form-control" placeholder="0">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Stok Minimum</label>
                            <input type="number" class="form-control" placeholder="10">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" rows="3" placeholder="Deskripsi sparepart"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Gambar Sparepart</label>
                        <input type="file" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="cancelAddModal">Batal</button>
                <button class="btn btn-primary">Simpan</button>
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