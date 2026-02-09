<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('layout/_meta.php'); ?>
    <title>Sample Monitoring</title>
    <?php require_once('layout/_css.php'); ?>
    <style>
        body {
            background-color: #f7f7f7;
            font-family: "Poppins", sans-serif;
            height: 100vh;
            margin: 0;
        }

        .welcome-box {
            text-align: center;
            margin-top: 80px;
            margin-bottom: 40px;
        }

        .welcome-box h1 {
            font-size: 32px;
            font-weight: bold;
            color: #333;
        }

        .welcome-box p {
            font-size: 16px;
            color: #777;
        }

        .menu-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            padding: 0 20px;
        }

        .menu-box {
            background-color: #36454F;
            border-radius: 15px;
            padding: 40px;
            width: 250px;
            text-align: center;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .menu-box:hover {
            transform: translateY(-5px);
            background-color: #2b373f;
        }

       .menu-box h2 {
            font-size: 24px;
            font-weight: 600;
            margin: 0;
            color: white; /* default */
            transition: color 0.3s ease;
       }
        
        .menu-box:hover h2 {
            color: #d1d5db; /* abu muda saat hover */
        }

        @media (max-width: 768px) {
            .menu-container {
                flex-direction: column;
                align-items: center;
            }

            .menu-box {
                width: 80%;
            }
        }
    </style>
</head>
<body>
    <div class="welcome-box">
        <h1>Welcome To Sample Monitoring</h1>
        <p>Please select the menu below</p>
    </div>

    <div class="menu-container">
        <!--a href="< site_url('Welcome/login_adidas') ?>" class="menu-box"-->
        <a href="<?= site_url('Welcome/d_adidas') ?>" class="menu-box">
            <h2>adidas</h2>
        </a>
        <a href="<?= site_url('Welcome/login_other') ?>" class="menu-box">
            <h2>Other Buyer</h2>
        </a>
    </div>

    <?php require_once('layout/_js.php'); ?>
</body>
</html>
