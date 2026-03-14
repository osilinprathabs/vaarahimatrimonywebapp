<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon | Vaarahi Matrimony</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Nunito Sans', sans-serif;
            background-color: #12243d;
            color: #ffffff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .container {
            max-width: 800px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(204, 159, 83, 0.3);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        .logo {
            margin-bottom: 30px;
        }
        .logo img {
            max-width: 250px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        h1 {
            font-size: 3rem;
            color: #cc9f53;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        p {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 30px;
            opacity: 0.9;
        }
        .countdown {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 40px;
        }
        .countdown-item {
            background: rgba(204, 159, 83, 0.1);
            padding: 20px;
            border-radius: 10px;
            border: 1px solid rgba(204, 159, 83, 0.2);
            min-width: 80px;
        }
        .countdown-item span {
            display: block;
            font-size: 2rem;
            font-weight: bold;
            color: #cc9f53;
        }
        .countdown-item label {
            font-size: 0.8rem;
            text-transform: uppercase;
        }
        .contact {
            margin-top: 40px;
            font-size: 1rem;
            color: #cc9f53;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: #cc9f53;
            color: #12243d;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn:hover {
            background-color: #e0b672;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(204, 159, 83, 0.4);
        }
        @media (max-width: 600px) {
            h1 { font-size: 2rem; }
            .countdown { gap: 10px; }
            .countdown-item { padding: 10px; min-width: 60px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Vaarahi Matrimony">
        </div>
        <h1>Coming Soon</h1>
        <p>Something beautiful is in the works. We are currently updating our website to bring you a better experience. Stay tuned!</p>
        
        <div class="countdown">
            <div class="countdown-item">
                <span id="days">00</span>
                <label>Days</label>
            </div>
            <div class="countdown-item">
                <span id="hours">00</span>
                <label>Hours</label>
            </div>
            <div class="countdown-item">
                <span id="minutes">00</span>
                <label>Mins</label>
            </div>
            <div class="countdown-item">
                <span id="seconds">00</span>
                <label>Secs</label>
            </div>
        </div>

        <a href="mailto:contact@sri9swarnavaarahimatrimony.com" class="btn">Notify Me</a>

        <div class="contact">
            &copy; {{ date('Y') }} Vaarahi Matrimony. All Rights Reserved.
        </div>
    </div>

    <script>
        // Set the countdown date (example: 7 days from now)
        const countdownDate = new Date().getTime() + (7 * 24 * 60 * 60 * 1000);

        const updateCountdown = () => {
            const now = new Date().getTime();
            const distance = countdownDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerText = days.toString().padStart(2, '0');
            document.getElementById("hours").innerText = hours.toString().padStart(2, '0');
            document.getElementById("minutes").innerText = minutes.toString().padStart(2, '0');
            document.getElementById("seconds").innerText = seconds.toString().padStart(2, '0');

            if (distance < 0) {
                clearInterval(interval);
                document.querySelector(".countdown").innerHTML = "<h2>We are Live!</h2>";
            }
        };

        const interval = setInterval(updateCountdown, 1000);
        updateCountdown();
    </script>
</body>
</html>
