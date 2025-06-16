<!DOCTYPE html>
<html>
<head>
    <title>QR Code Generator</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #qrcodeResult {
            margin-top: 20px;
        }
        #qrcodeResult img {
            max-width: 300px;
            height: auto;
            border: 1px solid #ddd;
            padding: 10px;
            background: white;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>QR Code Generator</h1>
    
    <input type="text" id="qrcode" placeholder="Masukkan teks/kode">
    <button id="generateQrCode">Generate QR Code</button>
    
    <div id="qrcodeResult"></div>
    <input type="hidden" id="csrf_token_name" value="<?= $this->security->get_csrf_token_name(); ?>">
	<input type="hidden" id="csrf_token_value" value="<?= $this->security->get_csrf_hash(); ?>">
    
    <script>
        $(document).ready(function() {
            $('#generateQrCode').click(function() {
                var qrtext = $('#qrcode').val().trim();
                
                if(!qrtext) {
                    $('#qrcodeResult').html('<p class="error">Masukkan teks/kode terlebih dahulu</p>');
                    return;
                }
                
                $('#qrcodeResult').html('<p>Membuat QR Code...</p>');
                var csrfName = $('#csrf_token_name').val();
			    var csrfHash = $('#csrf_token_value').val();
                $.ajax({
                    url: '<?php echo site_url("qrcode_generator/generate"); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: { qrcode: qrtext, [csrfName]: csrfHash },
                    success: function(response) {
                        if(response.error) {
                            $('#qrcodeResult').html('<p class="error">'+response.error+'</p>');
                        } else if(response.success) {
                            $('#qrcodeResult').html(
                                '<p>QR Code berhasil dibuat!</p>' +
                                '<img src="'+response.image_url+'" alt="QR Code">' +
                                '<p><a href="'+response.image_url+'" download>Download QR Code</a></p>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#qrcodeResult').html('<p class="error">Terjadi kesalahan: '+error+'</p>');
                    }
                });
            });
        });
    </script>
</body>
</html>