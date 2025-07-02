<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Departement</title>
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
            margin-top: 55px;
            font-size: 0.8em;
            color: #888;
        }
        .button-group {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap:20px;
        }

        .btn-dept {
            text-decoration: none;
            display: block;
            padding: 15px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: all 0.4s ease;
        }

        .btn-dept:hover {
            transform: scale(1.03) translateY(-2px);
            background: linear-gradient(135deg, #6a6ffb, #9fa4ff);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Pilih Departement</h1>
        <p>&nbsp;</p>
        
        <div class="button-group">
            <a href="<?=base_url('pemakaian-sp');?>" class="btn-dept">Departement Spinning</a>
            <a href="<?=base_url('pemakaian-wv');?>" class="btn-dept">Departement Weaving</a>
        </div>

        <div class="footer">
            &copy; <?= date('Y'); ?> PT. Rindang Jati Spinning
        </div>
    </div>

    

</body>
</html>