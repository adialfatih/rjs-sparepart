<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title;?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* CSS will be placed here */
        :root{--primary:#4361ee;--primary-light:#eef2ff;--secondary:#3f37c9;--success:#4cc9f0;--danger:#f72585;--warning:#f8961e;--info:#4895ef;--dark:#212529;--light:#f8f9fa;--sidebar-width:260px;--sidebar-collapsed-width:80px;--transition-speed:0.3s}*{margin:0;padding:0;box-sizing:border-box}body{font-family:'Poppins',sans-serif;background-color:#f5f7fb;color:#333;overflow-x:hidden}.dashboard-container{display:grid;grid-template-columns:var(--sidebar-width) 1fr;grid-template-rows:60px 1fr;grid-template-areas:"sidebar header" "sidebar main";min-height:100vh;transition:all var(--transition-speed) ease}.header{grid-area:header;background:#fff;box-shadow:0 2px 10px rgb(0 0 0 / .1);display:flex;align-items:center;justify-content:space-between;padding:0 20px;z-index:10}.header-left{display:flex;align-items:center}.toggle-sidebar{background:none;border:none;font-size:1.2rem;cursor:pointer;color:var(--dark);margin-right:15px;transition:all 0.2s}.toggle-sidebar:hover{color:var(--primary)}.search-bar{position:relative;width:300px}.search-bar input{width:100%;padding:8px 15px 8px 35px;border-radius:20px;border:1px solid #ddd;outline:none;transition:all 0.3s}.search-bar input:focus{border-color:var(--primary);box-shadow:0 0 0 3px rgb(67 97 238 / .2)}.search-bar i{position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#aaa}.header-right{display:flex;align-items:center}.notification,.user-menu{position:relative;margin-left:20px;cursor:pointer}.notification i,.user-menu img{font-size:1.2rem;color:var(--dark)}.notification-badge{position:absolute;top:-5px;right:-5px;background:var(--danger);color:#fff;border-radius:50%;width:18px;height:18px;display:flex;align-items:center;justify-content:center;font-size:.7rem;font-weight:700}.user-menu img{width:36px;height:36px;border-radius:50%;object-fit:cover}.sidebar{grid-area:sidebar;background:#fff;box-shadow:2px 0 10px rgb(0 0 0 / .1);height:100vh;position:sticky;top:0;transition:all var(--transition-speed) ease;overflow-y:auto}.sidebar-header{padding:20px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #eee;height:60px}.logo{display:flex;align-items:center}.logo img{width:30px;height:30px;margin-right:10px}.logo-text{font-weight:600;font-size:1.2rem;color:var(--dark);white-space:nowrap}.sidebar-menu{padding:15px 0}.menu-title{padding:10px 20px;font-size:.8rem;text-transform:uppercase;color:#aaa;font-weight:600;white-space:nowrap}.menu-item{padding:12px 20px;display:flex;align-items:center;color:#555;text-decoration:none;transition:all 0.2s;border-left:3px solid #fff0;white-space:nowrap}.menu-item:hover{background:var(--primary-light);color:var(--primary);border-left-color:var(--primary)}.menu-item.active{background:var(--primary-light);color:var(--primary);border-left-color:var(--primary);font-weight:500}.menu-item i{margin-right:10px;font-size:1.1rem;width:24px;text-align:center}.menu-item .menu-text{transition:opacity var(--transition-speed)}.submenu{padding-left:20px;max-height:0;overflow:hidden;transition:max-height 0.3s ease}.submenu.show{max-height:500px}.submenu-item{padding:10px 20px 10px 40px;display:flex;align-items:center;color:#666;text-decoration:none;transition:all 0.2s;font-size:.9rem}.submenu-item:hover{color:var(--primary)}.submenu-item.active{color:var(--primary);font-weight:500}.submenu-item i{font-size:.8rem;margin-right:8px}.has-submenu{position:relative}.submenu-toggle{position:absolute;right:20px;transition:transform 0.3s}.has-submenu.active .submenu-toggle{transform:rotate(90deg)}.main-content{grid-area:main;padding:20px;background-color:#f5f7fb}.page-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px}.page-title h1{font-size:1.5rem;font-weight:600;color:var(--dark)}.breadcrumb{display:flex;list-style:none;padding:0;margin:5px 0 0 0;font-size:.9rem;color:#777}.breadcrumb li{margin-right:10px}.breadcrumb li:after{content:'/';margin-left:10px;color:#aaa}.breadcrumb li:last-child:after{content:''}.breadcrumb a{color:var(--primary);text-decoration:none}.page-actions button{padding:8px 15px;background:var(--primary);color:#fff;border:none;border-radius:5px;cursor:pointer;font-weight:500;transition:all 0.2s;display:flex;align-items:center}.page-actions button:hover{background:var(--secondary);box-shadow:0 2px 5px rgb(0 0 0 / .1)}.page-actions button i{margin-right:5px}.card-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(250px,1fr));gap:20px;margin-bottom:30px}.card{background:#fff;border-radius:10px;box-shadow:0 4px 6px rgb(0 0 0 / .05);padding:20px;transition:transform 0.3s,box-shadow 0.3s}.card:hover{transform:translateY(-5px);box-shadow:0 10px 15px rgb(0 0 0 / .1)}.card-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:15px}.card-icon{width:50px;height:50px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;color:#fff}.card-icon.blue{background:linear-gradient(135deg,#4361ee,#3f37c9)}.card-icon.green{background:linear-gradient(135deg,#4cc9f0,#4895ef)}.card-icon.orange{background:linear-gradient(135deg,#f8961e,#f3722c)}.card-icon.pink{background:linear-gradient(135deg,#f72585,#b5179e)}.card-title{font-size:.9rem;color:#777;font-weight:500}.card-value{font-size:1.8rem;font-weight:600;color:var(--dark);margin:5px 0}.card-change{font-size:.8rem;display:flex;align-items:center}.card-change.positive{color:#10b981}.card-change.negative{color:#ef4444}.table-container{background:#fff;border-radius:10px;box-shadow:0 4px 6px rgb(0 0 0 / .05);padding:20px;overflow-x:auto}table{width:100%;border-collapse:collapse}thead{background:var(--primary-light)}th{padding:12px 15px;text-align:left;font-weight:600;color:var(--dark);font-size:.9rem;white-space:nowrap}td{padding:12px 15px;border-bottom:1px solid #eee;font-size:.9rem;color:#555}tr:last-child td{border-bottom:none}tr:hover td{background:#f9fafc}.status{display:inline-block;padding:5px 10px;border-radius:20px;font-size:.8rem;font-weight:500}.status.active{background:#d1fae5;color:#065f46}.status.pending{background:#fef3c7;color:#92400e}.status.inactive{background:#e5e7eb;color:#4b5563}.action-btn{padding:5px 10px;border-radius:5px;border:none;cursor:pointer;font-size:.8rem;margin-right:5px;transition:all 0.2s}.action-btn.view{background:var(--info);color:#fff}.action-btn.edit{background:var(--warning);color:#fff}.action-btn.delete{background:var(--danger);color:#fff}.action-btn:hover{opacity:.8}@media screen and (max-width:768px){table{display:block;overflow-x:auto;white-space:nowrap}}.sidebar-collapsed{grid-template-columns:var(--sidebar-collapsed-width) 1fr}.sidebar-collapsed .logo-text,.sidebar-collapsed .menu-text,.sidebar-collapsed .menu-title,.sidebar-collapsed .submenu-toggle{opacity:0;display:none}.sidebar-collapsed .sidebar-header{justify-content:center}.sidebar-collapsed .menu-item{padding:12px 0;justify-content:center;border-left:none}.sidebar-collapsed .menu-item i{margin-right:0;font-size:1.3rem}.sidebar-collapsed .has-submenu .submenu-toggle{display:none}.sidebar-collapsed .submenu{position:absolute;left:var(--sidebar-collapsed-width);background:#fff;min-width:200px;box-shadow:2px 2px 10px rgb(0 0 0 / .1);border-radius:0 5px 5px 0;z-index:100;display:none}.sidebar-collapsed .menu-item:hover .submenu{display:block;max-height:none}.sidebar-collapsed .submenu-item{padding:10px 15px}@media screen and (max-width:992px){.dashboard-container{grid-template-columns:var(--sidebar-collapsed-width) 1fr}.logo-text,.menu-text,.menu-title,.submenu-toggle{opacity:0;display:none}.sidebar-header{justify-content:center}.menu-item{padding:12px 0;justify-content:center;border-left:none}.menu-item i{margin-right:0;font-size:1.3rem}.has-submenu .submenu-toggle{display:none}.submenu{position:absolute;left:var(--sidebar-collapsed-width);background:#fff;min-width:200px;box-shadow:2px 2px 10px rgb(0 0 0 / .1);border-radius:0 5px 5px 0;z-index:100;display:none}.menu-item:hover .submenu{display:block;max-height:none}.submenu-item{padding:10px 15px}.search-bar{width:200px}}@media screen and (max-width:768px){.dashboard-container{grid-template-columns:1fr;grid-template-rows:60px 1fr;grid-template-areas:"header" "main"}.sidebar{position:fixed;left:-100%;top:60px;height:calc(100vh - 60px);z-index:100;transition:all var(--transition-speed) ease}.sidebar.show{left:0}.search-bar{width:150px}.card-grid{grid-template-columns:1fr}}@media screen and (max-width:576px){.header{padding:0 10px}.search-bar{display:none}.page-header{flex-direction:column;align-items:flex-start}.page-actions{margin-top:10px}}.modal{display:none;position:fixed;z-index:99;top:0;left:0;width:100%;height:100%;background-color:rgb(0 0 0 / .4);justify-content:center;align-items:center;animation:fadeIn 0.3s ease}.modal-dialog{background:#fff;border-radius:10px;padding:20px 30px;position:relative;box-shadow:0 10px 30px rgb(0 0 0 / .2);animation:scaleIn 0.3s ease;max-height:90vh;overflow-y:auto}.modal-small{max-width:400px;width:90%}.modal-medium{max-width:600px;width:90%}.modal-large{max-width:900px;width:95%}.modal-close{position:absolute;top:10px;right:15px;font-size:22px;color:#999;background:none;border:none;cursor:pointer;font-weight:700}.modal-close:hover{color:#333}@keyframes fadeIn{from{opacity:0}to{opacity:1}}@keyframes scaleIn{from{transform:scale(.95);opacity:0}to{transform:scale(1);opacity:1}}.dataTables_wrapper{margin-top:20px;font-family:'Poppins',sans-serif;font-size:.9rem}.dataTables_filter{float:right;margin-bottom:10px}.dataTables_filter input{padding:6px 12px;border:1px solid #ddd;border-radius:20px;outline:none;transition:0.3s ease}.dataTables_filter input:focus{border-color:#4361ee;box-shadow:0 0 0 2px rgb(67 97 238 / .2)}.dataTables_paginate{text-align:right;padding-top:15px}.dataTables_paginate .paginate_button{background-color:#fff;border:1px solid #ddd;color:#4895ef!important;padding:6px 12px;margin:0 3px;border-radius:6px;cursor:pointer;transition:all 0.2s}.dataTables_paginate .paginate_button:hover{background-color:#eef2ff;border-color:#4361ee}.dataTables_paginate .paginate_button.current{background-color:#4895ef!important;color:#fff!important;border-color:#4361ee}.dataTables_info{margin-top:10px;color:#777;font-size:.85rem}.dataTables_length select{padding:4px 10px;border-radius:6px;border:1px solid #ddd;margin:0 5px}
        /* HTML: <div class="loader"></div> */
        .loader{width:50px;aspect-ratio:1;display:grid;border:4px solid #0000;border-radius:50%;border-right-color:#25b09b;animation:l15 1s infinite linear}.loader::before,.loader::after{content:"";grid-area:1/1;margin:2px;border:inherit;border-radius:50%;animation:l15 2s infinite}.loader::after{margin:8px;animation-duration:3s}@keyframes l15{100%{transform:rotate(1turn)}}
        .form-container{max-width:100%;margin:auto;background:#fff;margin-top:20px;}.form-group{display:flex;flex-direction:row;align-items:center;margin-bottom:15px}.form-group label{width:35%;color:#333}.form-group input,.form-group select{width:65%;padding:10px;border:1px solid #ccc;border-radius:6px;font-size:1rem}@media (max-width:768px){.form-group{flex-direction:column;align-items:stretch}.form-group label{width:100%;margin-bottom:5px}.form-group input,.form-group select{width:100%}}
        .btn{padding:12px 24px;font-size:16px;border:none;border-radius:8px;font-weight:600;color:#fff;cursor:pointer;transition:all 0.3s ease;box-shadow:0 4px 12px rgb(0 0 0 / .1)}.btn-blue{background-color:#007BFF}.btn-blue:hover{background-color:#0056d2;transform:translateY(-2px);box-shadow:0 6px 16px rgb(0 123 255 / .4)}.btn-green{background-color:#28a745}.btn-green:hover{background-color:#218838;transform:scale(1.05);box-shadow:0 6px 16px rgb(40 167 69 / .4)}.btn-red{background-color:#dc3545}.btn-red:hover{background-color:#c82333;transform:scale(1.05);box-shadow:0 6px 16px rgb(220 53 69 / .4)}.btn-orange{background-color:#fd7e14}.btn-orange:hover{background-color:#e76c04;transform:translateY(-2px);box-shadow:0 6px 16px rgb(253 126 20 / .4)}
        .menu-text2 {font-size:14px;margin-left:5px;}
        /* Floating Button Style */
.floating-menu-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color:rgb(30, 141, 214);
    display: none;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    z-index: 1001;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}

/* Hamburger Icon */
.hamburger {
    width: 24px;
    height: 18px;
    position: relative;
    transform: rotate(0deg);
    transition: .5s ease-in-out;
}

.hamburger span {
    display: block;
    position: absolute;
    height: 3px;
    width: 100%;
    background: white;
    border-radius: 3px;
    opacity: 1;
    left: 0;
    transform: rotate(0deg);
    transition: .25s ease-in-out;
}

.hamburger span:nth-child(1) {
    top: 0;
}

.hamburger span:nth-child(2),
.hamburger span:nth-child(3) {
    top: 8px;
}

.hamburger span:nth-child(4) {
    top: 16px;
}

/* Mobile Menu Style */
.mobile-menu {
    position: fixed;
    top: 0;
    left: -250px;
    width: 250px;
    height: 100vh;
    background-color: #fff;
    z-index: 1000;
    transition: all 0.3s ease;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    padding-top: 20px;
}

.mobile-menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.mobile-menu li a {
    display: block;
    padding: 12px 20px;
    color: #333;
    text-decoration: none;
    font-size: 16px;
}

.mobile-menu li a:hover {
    background-color: #f5f5f5;
}

/* Overlay Style */
.menu-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

/* Active States */
.menu-active .mobile-menu {
    left: 0;
}

.menu-active .menu-overlay {
    opacity: 1;
    visibility: visible;
}

/* Hamburger to X Animation */
.menu-active .hamburger span:nth-child(1) {
    top: 8px;
    width: 0%;
    left: 50%;
}

.menu-active .hamburger span:nth-child(2) {
    transform: rotate(45deg);
}

.menu-active .hamburger span:nth-child(3) {
    transform: rotate(-45deg);
}

.menu-active .hamburger span:nth-child(4) {
    top: 8px;
    width: 0%;
    left: 50%;
}

/* Hide on Desktop */
@media (min-width: 769px) {
    .floating-menu-btn,
    .mobile-menu,
    .menu-overlay {
        display: none;
    }
}
    </style>
</head>
<body>