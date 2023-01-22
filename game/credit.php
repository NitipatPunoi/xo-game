<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XO Game</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="../assets/images/favicons/site.webmanifest">
    <link rel="mask-icon" href="../assets/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="../assets/images/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="msapplication-config" content="../assets/images/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body onload="initialize()">

    <section>
        <div class="credit">
            <h1>Credits</h1>
            <h3>Game Designer</h3>
            <p>Nitipat Punoi</p>
            <h3>Game Coding</h3>
            <p>Nitipat Punoi</p>
            <h3>Game Tester</h3>
            <p>Nitipat Punoi</p>
            <h4>Special Thank</h4>
            <p>Digio (Thailand) Co., Ltd.</p>
            
            <h5>I hope you enjoyed it</h5>
            <h6>Punoi.n@gmail.com</h6>
            <h6>083-4079422</h6>
            <button type="button" data-screen="index">Back</button>
        </div>
    </section>
    
    <!-- Script -->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../assets/js/main.js"></script>

    <script>

        function initialize() {
            $('section').fadeIn(500)
        }

    </script>

</body>
</html>