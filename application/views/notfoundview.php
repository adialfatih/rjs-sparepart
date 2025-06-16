<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found | AI Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #1a73e8;
            --dark-blue: #0d47a1;
            --light-blue: #e8f0fe;
            --white: #ffffff;
            --gray: #f5f5f5;
            --dark-gray: #757575;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--light-blue);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            text-align: center;
        }
        
        .error-container {
            background-color: var(--white);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 139, 0.1);
            width: 100%;
            max-width: 500px;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }
        
        .error-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, var(--primary-blue), #34a853, #fbbc05, #ea4335);
        }
        
        .error-icon {
            font-size: 80px;
            margin-bottom: 20px;
            background: linear-gradient(135deg, var(--primary-blue), #00bcd4);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        h1 {
            color: var(--primary-blue);
            font-size: 36px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        p {
            color: var(--dark-gray);
            font-size: 18px;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        
        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 12px 24px;
            background-color: var(--primary-blue);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .back-button i {
            margin-right: 10px;
        }
        
        .back-button:hover {
            background-color: var(--dark-blue);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(26, 115, 232, 0.3);
        }
        
        .ai-suggestion {
            margin-top: 30px;
            padding: 15px;
            background-color: var(--gray);
            border-radius: 8px;
            border-left: 4px solid var(--primary-blue);
        }
        
        .ai-suggestion h3 {
            color: var(--primary-blue);
            margin-bottom: 10px;
            font-size: 16px;
            display: flex;
            align-items: center;
        }
        
        .ai-suggestion h3 i {
            margin-right: 8px;
        }
        
        @media (max-width: 480px) {
            .error-container {
                padding: 30px 20px;
            }
            
            h1 {
                font-size: 28px;
            }
            
            p {
                font-size: 16px;
            }
            
            .error-icon {
                font-size: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-icon">
            <i class="fas fa-robot"></i>
        </div>
        
        <h1>404 - Page Not Found</h1>
        
        <p>Our AI couldn't locate the page you're looking for.<br>
        It might have been moved, deleted, or never existed.</p>
        
        <a href="javascript:history.back()" class="back-button">
            <i class="fas fa-arrow-left"></i>
            <span>Return to Previous Page</span>
        </a>
        
        <div class="ai-suggestion">
            <h3><i class="fas fa-lightbulb"></i> AI Suggestion</h3>
            <p>Try checking the URL for errors, or use the search function to find what you're looking for.</p>
        </div>
    </div>

    <script>
        // Optional: Add a smooth back button animation
        document.querySelector('.back-button').addEventListener('click', function(e) {
            e.preventDefault();
            document.body.style.opacity = '0.8';
            setTimeout(() => {
                window.history.back();
            }, 300);
        });
    </script>
</body>
</html>