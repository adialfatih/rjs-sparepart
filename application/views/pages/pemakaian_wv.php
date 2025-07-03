<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Untuk Pemakaian Sparepart Departement Weaving</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 90%;
            max-width: 500px;
            text-align: center;
            box-sizing: border-box;
        }
        h1 {
            color: #1e2022;
            margin-bottom: 20px;
        }
        #reader {
            width: 100%;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
        }
        #result {
            margin-top: 20px;
            padding: 15px;
            background-color: #e9f5ff;
            border-left: 5px solid #007bff;
            text-align: left;
            word-wrap: break-word; /* Memastikan teks panjang tidak merusak layout */
            border-radius: 5px;
            font-size: 1.1em;
            display: none; /* Sembunyikan pada awalnya */
        }
        #result a {
            color: #0056b3;
            text-decoration: none;
            font-weight: bold;
        }
        #result a:hover {
            text-decoration: underline;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .footer {
            margin-top: 25px;
            font-size: 0.8em;
            color: #888;
        }
        .iptform {
            width: 90%;
            padding:10px;
            border-radius:4px;
            outline:none;
            border:1px solid #ccc;
        }
        label {
            color:#0056b3;
            font-weight:bold;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Pemakaian Sparepart</h1>
        <p>Scan Kode untuk pemakaian Weaving</p>
        
        <div id="reader"></div>
        
        <div id="result_container">
            <div id="result">Hasil pindaian akan muncul di sini.</div>
            <div id="inputPemakaian" style="display:none;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore quidem reiciendis aperiam nisi repudiandae quas enim facilis, animi error magnam odio aliquam itaque? Harum nostrum iure laboriosam beatae adipisci. Iusto!</div>
        </div>
        
        <div class="footer">
            &copy; <?=date('Y');?> Rindang Jati Weaving
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode/html5-qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const resultContainer = document.getElementById('result');
            const readerElement = document.getElementById('reader');
            // Fungsi yang akan dijalankan ketika kode berhasil dipindai
            function onScanSuccess(decodedText, decodedResult) {
                console.log(`Code matched = ${decodedText}`, decodedResult);

                // Menampilkan hasil
                resultContainer.style.display = 'block';

                // Cek apakah hasilnya adalah URL/Link
                if (decodedText.startsWith('http://') || decodedText.startsWith('https://')) {
                    resultContainer.innerHTML = `
                        <strong>✅ Sukses!</strong> Link terdeteksi:<br>
                        <a href="${decodedText}" target="_blank">${decodedText}</a>
                    `;
                    $('#inputPemakaian').hide();
                } else {
                    resultContainer.innerHTML = `✅ <strong>${decodedText}</strong> Ditemukan`;
                    $('#inputPemakaian').html('Loading...');
                    $('#inputPemakaian').show();
                    $.ajax({
                        url: '<?=base_url('proses-pemakaian'); ?>',
                        type: 'get',
                        data: { "dep":"Weaving", decodedText: decodedText },
                        success: function(response) {
                            $('#inputPemakaian').html(''+response);
                        },
                        error: function(xhr, status, error) {
                            console.log(''+xhr);
                            console.log(''+status);
                            console.log(''+error);
                            $('#inputPemakaian').hide();
                        }
                    });
                }

                // Berhenti memindai setelah berhasil
                // Anda bisa menghapus baris ini jika ingin terus memindai
                html5QrcodeScanner.clear(); 
            }

            // Fungsi yang akan dijalankan jika terjadi error (misal, kamera tidak ditemukan)
            function onScanFailure(error) {
                // Biasanya error ini muncul terus menerus jika tidak ada kode yang terdeteksi
                // jadi kita bisa mengabaikannya atau menampilkannya secara halus.
                
            }

            // Membuat instance pemindai baru
            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", // ID dari elemen div untuk menampilkan video
                { 
                    fps: 10, // Frames per second untuk pemindaian
                    qrbox: { width: 250, height: 250 }, // Ukuran kotak pemindaian
                    rememberLastUsedCamera: true, // Ingat kamera yang terakhir digunakan
                    supportedScanTypes: [ // Jenis pemindaian yang didukung
                        Html5QrcodeScanType.SCAN_TYPE_CAMERA,
                        Html5QrcodeScanType.SCAN_TYPE_FILE
                    ]
                },
                /* verbose= */ false
            );
            
            // Menjalankan pemindai
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        });
        function simpanPemakaian(){
            Swal.fire({
                title: "Simpan ?",
                text: "Pastikan data yang anda isi sudah benar",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Simpan",
                canlcelButtonText: "Batal"
                }).then((result) => {
                if (result.isConfirmed) {
                    var qrcode = $('#qrCodeScan').val();
                    var stokAsli = $('#stokAsli').val();
                    var jmlPakai = $('#jmlPakai').val();
                    var nmOpt = $('#nmOpt').val();
                    var nomc = $('#nomc').val();
                    var bekas = $('#bekas').val();
                    var ket = $('#ket').val();
                    var jmlitembekas = $('#jmlitembekas').val();
                    if(qrcode!="" && stokAsli!="" && jmlPakai!="" && nmOpt!="" && nomc!="" && bekas!=""){
                        $.ajax({
                            url: '<?=base_url('proses-simpan-pemakaian'); ?>',
                            type: 'get',
                            dataType: 'json',
                            data: { "qrcode":qrcode,
                                "stokAsli":stokAsli,
                                "jmlPakai":jmlPakai,
                                "nmOpt":nmOpt,
                                "nomc":nomc,
                                "ket":ket,
                                "jmlitembekas":jmlitembekas,
                                "dep":"Weaving",
                                "bekas":bekas },
                            success: function(response) {
                                if(response.statusCode == 200){
                                    Swal.fire('Berhasil', 'Menyimpan proses pemakaian sparepart', 'success').then((result) => {
										location.reload();
									});
                                } else {
                                    Swal.fire('Gagal .!', response.msg, 'error').then((result) => {
										location.reload();
									});
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(''+xhr);
                                console.log(''+status);
                                console.log(''+error);
                                $('#inputPemakaian').hide();
                            }
                        });
                    } else {
                        Swal.fire('Anda belum mengisi semua data dengan benar.!');
                    }
                }
            });
        }
    </script>

</body>
</html>