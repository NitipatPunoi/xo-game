<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XO Game</title>

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