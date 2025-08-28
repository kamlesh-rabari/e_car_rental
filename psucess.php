<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
        /* Reset */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: "Nunito Sans", sans-serif; }

        /* Background Styling */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #f8f9fa, #e3f2fd);
        }

        /* Card Styling */
        .card {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            animation: fadeIn 1s ease-in-out;
            max-width: 350px;
        }

        /* Success Circle */
        .circle {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #4CAF50;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            animation: popIn 0.5s ease-out, glow 1.5s infinite alternate;
        }

        /* Checkmark */
        .checkmark {
            color: white;
            font-size: 48px;
            font-weight: bold;
            animation: checkmarkFadeIn 0.8s ease-in-out forwards 0.5s;
        }

        /* Heading & Text */
        h1 { color: #2E7D32; font-size: 26px; margin-bottom: 10px; }
        p { color: #555; font-size: 18px; margin-bottom: 20px; }

        /* Button */
        #back {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            background: #ff7200;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s ease-in-out;
            font-weight: bold;
        }

        #back:hover { background: #e66000; }

        /* Animations */
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes popIn { from { transform: scale(0.5); opacity: 0; } to { transform: scale(1); opacity: 1); } }
        @keyframes glow { from { box-shadow: 0 0 10px rgba(76, 175, 80, 0.6); } to { box-shadow: 0 0 20px rgba(76, 175, 80, 1); } }
        @keyframes checkmarkFadeIn { from { opacity: 0; transform: scale(0.5); } to { opacity: 1; transform: scale(1); } }
    </style>
</head>
<body>
    <div class="card">
        <div class="circle">
            <span class="checkmark">✓</span>
        </div>
        <h1>Payment Successful</h1>
        <p>Your rental request has been received.<br>We’ll be in touch shortly!</p>
        <a id="back" href="cardetails.php">Search Cars</a>
    </div>
</body>
</html>
