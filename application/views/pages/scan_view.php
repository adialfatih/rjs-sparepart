<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemindai Barcode & QR Code</title>
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
    </style>
</head>
<body>

    <div class="container">
        <h1>📸 Pemindai Kode</h1>
        <p>Arahkan kamera ke Barcode atau QR Code</p>
        
        <div id="reader"></div>
        
        <div id="result_container">
            <div id="result">Hasil pindaian akan muncul di sini.</div>
        </div>
        
        <div class="footer">
            &copy; <?=date('Y');?> PT. Rindang Jati Spinning
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode/html5-qrcode.min.js"></script>

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
                } else {
                    resultContainer.innerHTML = `<strong>✅ Sukses!</strong> Hasil Pindaian:<br>${decodedText}`;
                }

                // Berhenti memindai setelah berhasil
                // Anda bisa menghapus baris ini jika ingin terus memindai
                html5QrcodeScanner.clear(); 
            }

            // Fungsi yang akan dijalankan jika terjadi error (misal, kamera tidak ditemukan)
            function onScanFailure(error) {
                // Biasanya error ini muncul terus menerus jika tidak ada kode yang terdeteksi
                // jadi kita bisa mengabaikannya atau menampilkannya secara halus.
                // console.warn(`Code scan error = ${error}`);
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
    </script>

</body>
</html>