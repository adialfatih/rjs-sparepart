<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title;?></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root{--primary:#2A5C99;--primary-light:#4a7cb9;--secondary:#FF6B35;--accent:#FFE74C;--text:#2D2D2D;--text-light:#5E5E5E;--bg:#F8F9FA;--card-bg:#FFFFFF;--border:#E0E0E0;--success:#28A745;--warning:#FFC107;--danger:#DC3545;--info:#17A2B8}[data-theme="dark"]{--primary:#1E3A8A;--primary-light:#3B5998;--secondary:#FF7B4D;--accent:#FFE74C;--text:#F0F0F0;--text-light:#CCCCCC;--bg:#121F3D;--card-bg:#1A2C4D;--border:#2D3A5A;--success:#38A169;--warning:#D69E2E;--danger:#E53E3E;--info:#3182CE}*{margin:0;padding:0;box-sizing:border-box;transition:background-color 0.3s,color 0.3s,border-color 0.3s}body{font-family:'Roboto',sans-serif;background-color:var(--bg);color:var(--text);min-height:100vh;display:flex;flex-direction:column}header{background-color:var(--primary);color:#fff;padding:.8rem 1.5rem;display:flex;justify-content:space-between;align-items:center;box-shadow:0 2px 10px rgb(0 0 0 / .1);z-index:100}.logo{display:flex;align-items:center;gap:10px}.logo h1{font-size:1.5rem;font-weight:500}.logo-icon{font-size:2rem;color:var(--accent)}.header-actions{display:flex;align-items:center;gap:15px}.theme-toggle{background:none;border:none;color:#fff;cursor:pointer;font-size:1.5rem;display:flex;align-items:center}.user-profile{display:flex;align-items:center;gap:8px;cursor:pointer}.user-avatar{width:36px;height:36px;border-radius:50%;background-color:var(--secondary);display:flex;align-items:center;justify-content:center;font-weight:700}.mobile-menu-btn{display:none;background:none;border:none;color:#fff;font-size:1.5rem;cursor:pointer}.main-container{display:flex;flex:1;overflow:hidden}.sidebar{width:250px;background-color:var(--card-bg);border-right:1px solid var(--border);height:calc(100vh - 60px);overflow-y:auto;transition:transform 0.3s ease;transform:translateX(0);z-index:90}.sidebar.collapsed{transform:translateX(-250px)}.sidebar-menu{list-style:none;padding:1rem 0}.menu-title{padding:.8rem 1.5rem;font-size:.8rem;text-transform:uppercase;color:var(--text-light);font-weight:500;letter-spacing:.5px}.menu-item{margin:.2rem 0}.menu-link{display:flex;align-items:center;padding:.8rem 1.5rem;color:var(--text);text-decoration:none;gap:12px;font-weight:500;border-left:3px solid #fff0;cursor: pointer;}.menu-link:hover{background-color:rgb(0 0 0 / .05)}.menu-link.active{background-color:rgb(42 92 153 / .1);border-left:3px solid var(--primary);color:var(--primary)}.menu-icon{font-size:1.3rem}.submenu{list-style:none;max-height:0;overflow:hidden;transition:max-height 0.3s ease;background-color:rgb(0 0 0 / .03)}.submenu.show{max-height:500px}.submenu .menu-link{padding-left:3rem;font-weight:400}.submenu-toggle{display:flex;align-items:center;justify-content:space-between;width:100%}.submenu-arrow{transition:transform 0.3s ease}.submenu-arrow.rotated{transform:rotate(90deg)}.main-content{flex:1;padding:1.5rem;overflow-y:auto;height:calc(100vh - 60px)}.page-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem}.page-title{font-size:1.8rem;font-weight:500;color:var(--primary)}.breadcrumb{display:flex;align-items:center;gap:8px;color:var(--text-light);font-size:.9rem}.breadcrumb a{color:var(--text-light);text-decoration:none}.breadcrumb a:hover{color:var(--primary)}.breadcrumb .separator{font-size:1rem}.card-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(250px,1fr));gap:1.5rem;margin-bottom:1.5rem}.card{background-color:var(--card-bg);border-radius:8px;box-shadow:0 2px 10px rgb(0 0 0 / .05);padding:1.5rem;border:1px solid var(--border)}.card-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem}.card-title{font-size:1rem;font-weight:500;color:var(--text-light)}.card-icon{width:40px;height:40px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1.2rem}.card-icon.primary{background-color:rgb(42 92 153 / .1);color:var(--primary)}.card-icon.success{background-color:rgb(40 167 69 / .1);color:var(--success)}.card-icon.warning{background-color:rgb(255 193 7 / .1);color:var(--warning)}.card-icon.danger{background-color:rgb(220 53 69 / .1);color:var(--danger)}.card-value{font-size:1.8rem;font-weight:700;margin-bottom:.5rem}.card-footer{font-size:.8rem;color:var(--text-light);display:flex;align-items:center;gap:5px}.card-footer.positive{color:var(--success)}.card-footer.negative{color:var(--danger)}.table-container{background-color:var(--card-bg);border-radius:8px;box-shadow:0 2px 10px rgb(0 0 0 / .05);padding:1.5rem;border:1px solid var(--border);overflow-x:auto}.table-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem}.table-title{font-size:1.2rem;font-weight:500}.table-actions{display:flex;gap:10px}table{width:100%;border-collapse:collapse}th,td{padding:.8rem 1rem;text-align:left;border-bottom:1px solid var(--border)}th{font-weight:500;color:var(--text-light);background-color:rgb(0 0 0 / .03)}tr:hover{background-color:rgb(0 0 0 / .02)}.status-badge{display:inline-block;padding:.3rem .6rem;border-radius:20px;font-size:.8rem;font-weight:500}.status-badge.success{background-color:rgb(40 167 69 / .1);color:var(--success)}.status-badge.warning{background-color:rgb(255 193 7 / .1);color:var(--warning)}.status-badge.danger{background-color:rgb(220 53 69 / .1);color:var(--danger)}.pagination{display:flex;justify-content:flex-end;margin-top:1rem;gap:5px}.pagination button{padding:.5rem .8rem;border:1px solid var(--border);background-color:var(--card-bg);color:var(--text);border-radius:4px;cursor:pointer}.pagination button.active{background-color:var(--primary);color:#fff;border-color:var(--primary)}.pagination button:hover:not(.active){background-color:rgb(0 0 0 / .05)}.btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:.6rem 1rem;border-radius:6px;font-weight:500;cursor:pointer;border:none;transition:all 0.2s;font-size:.9rem}.btn-sm{padding:.4rem .8rem;font-size:.8rem}.btn-lg{padding:.8rem 1.4rem;font-size:1rem}.btn-primary{background-color:var(--primary);color:#fff}.btn-primary:hover{background-color:var(--primary-light)}.btn-secondary{background-color:var(--secondary);color:#fff}.btn-secondary:hover{background-color:#FF804D}.btn-outline{background-color:#fff0;border:1px solid var(--border);color:var(--text)}.btn-outline:hover{background-color:rgb(0 0 0 / .05)}.btn-success{background-color:var(--success);color:#fff}.btn-success:hover{background-color:#218838}.btn-danger{background-color:var(--danger);color:#fff}.btn-danger:hover{background-color:#C82333}.btn-warning{background-color:var(--warning);color:#212529}.btn-warning:hover{background-color:#E0A800}.btn-icon{width:36px;height:36px;border-radius:50%;padding:0;justify-content:center}.modal-overlay{position:fixed;top:0;left:0;right:0;bottom:0;background-color:rgb(0 0 0 / .5);display:flex;align-items:center;justify-content:center;z-index:1000;opacity:0;visibility:hidden;transition:opacity 0.3s,visibility 0.3s}.modal-overlay.show{opacity:1;visibility:visible}.modal{background-color:var(--card-bg);border-radius:8px;box-shadow:0 5px 20px rgb(0 0 0 / .2);transform:translateY(-20px);transition:transform 0.3s;max-width:90%;max-height:90vh;overflow-y:auto}.modal-overlay.show .modal{transform:translateY(0)}.modal-sm{width:400px}.modal-lg{width:1000px}.modal-header{padding:1.2rem 1.5rem;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center}.modal-title{font-size:1.3rem;font-weight:500}.modal-close{background:none;border:none;font-size:1.5rem;cursor:pointer;color:var(--text-light)}.modal-body{padding:1.5rem}.modal-footer{padding:1rem 1.5rem;border-top:1px solid var(--border);display:flex;justify-content:flex-end;gap:10px}.form-group{margin-bottom:1.2rem}.form-label{display:block;margin-bottom:.5rem;font-weight:500}.form-control{width:100%;padding:.6rem .8rem;border:1px solid var(--border);border-radius:4px;background-color:var(--card-bg);color:var(--text)}.form-control:focus{outline:none;border-color:var(--primary);box-shadow:0 0 0 2px rgb(42 92 153 / .2)}.form-row{display:flex;gap:1rem}.form-row .form-group{flex:1}.loading-overlay{position:fixed;top:0;left:0;right:0;bottom:0;background-color:rgb(0 0 0 / .5);display:flex;align-items:center;justify-content:center;z-index:2000;opacity:0;visibility:hidden;transition:opacity 0.3s,visibility 0.3s}.loading-overlay.show{opacity:1;visibility:visible}.loading-spinner{width:50px;height:50px;border:4px solid rgb(255 255 255 / .3);border-radius:50%;border-top-color:var(--primary);animation:spin 1s ease-in-out infinite}@keyframes spin{to{transform:rotate(360deg)}}@media (max-width:992px){.sidebar{position:fixed;top:60px;left:0;z-index:90;transform:translateX(-250px)}.sidebar.show{transform:translateX(0)}.mobile-menu-btn{display:block}}@media (max-width:768px){.card-grid{grid-template-columns:1fr}.modal-sm,.modal-lg{width:95%}.form-row{flex-direction:column;gap:0}}
        /* Tambahkan CSS ini untuk menyesuaikan tampilan DataTables dengan tema Anda */
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_paginate {
    color: var(--text);
    padding: 0.5rem 0;
}

.dataTables_wrapper .dataTables_filter input {
    border: 1px solid var(--border);
    padding: 0.3rem 0.5rem;
    border-radius: 4px;
    background-color: var(--card-bg);
    color: var(--text);
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    color: var(--text) !important;
    border: 1px solid var(--border);
    padding: 0.3rem 0.8rem;
    margin: 0 2px;
    border-radius: 4px;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current,
.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    background: var(--primary);
    color: white !important;
    border-color: var(--primary);
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: rgba(0, 0, 0, 0.1);
    border-color: var(--border);
}

/* Untuk responsive */
.dataTables_wrapper .dataTables_length select {
    border: 1px solid var(--border);
    background-color: var(--card-bg);
    color: var(--text);
    padding: 0.2rem;
    border-radius: 4px;
}
        .custom-combobox {
            width: 100%;
            position: relative;
        }
        
        .combobox-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        
        .combobox-options {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            border-top: none;
            border-radius: 0 0 4px 4px;
            background: white;
            z-index: 1000;
            display: none;
        }
        .combobox-options2 {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            border-top: none;
            border-radius: 0 0 4px 4px;
            background: white;
            z-index: 1000;
            display: none;
        }
        
        .combobox-option {
            padding: 10px;
            cursor: pointer;
        }
        
        .combobox-option:hover {
            background-color: #f0f0f0;
        }
        
        .combobox-option.active {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>