<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'login';
$route['dashboard'] = 'beranda';
//$route['manager-dashboard'] = 'beranda/dsbmng';
$route['operator-dashboard'] = 'beranda/dsbopt';
$route['404_override'] = 'Notfounde';
$route['translate_uri_dashes'] = FALSE;
$route['upload-image'] = 'Upload_image';
$route['store-image'] = 'Upload_image/produk_upload';
$route['daftar'] = 'beranda/daftar';
$route['tarik/ke/spinning'] = 'beranda/kesp';
$route['history/ke/spinning'] = 'showpage/rwyt_kesp';
$route['history/ke/weaving'] = 'showpage/rwyt_kewv';

$route['user-login'] = 'showpage/loginuser';proses-inputuser
$route['proses-inputuser'] = 'proses/inputuserbaru';


$route['tarik/ke/weaving'] = 'beranda/kewv';
$route['cobascan'] = 'beranda/cobascan';
$route['pemakaian-sparepart'] = 'beranda/pemakaian';
$route['pemakaian-sp'] = 'beranda/pemakaian_sp';
$route['pemakaian-wv'] = 'beranda/pemakaian_wv';
$route['proses-pemakaian'] = 'proses/use_sparepart';
$route['proses-simpan-pemakaian'] = 'proses/save_pemakaian';

$route['gudang/stok/spinning'] = 'beranda/stoksp';
$route['gudang/stok/weaving'] = 'beranda/stokwv';

$route['cetak/code/(:any)/(:any)'] = 'nota/qrcode';


$route['qrcode'] = 'qrcode_generator';
$route['qrcode/generate'] = 'qrcode_generator/generate';

$route['api/spareparts/(:any)'] = 'apis/get_spareparts_by_category/$1'; // Contoh route

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/

$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8
