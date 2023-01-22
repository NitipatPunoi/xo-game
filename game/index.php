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

    <section id="main-menu">
        <div class="menu">
            <h1 class="title"><span>X</span><span>O</span>GAME</h1>  
            <p class="subtitle">Main Menu</p>
            <button type="button" data-action="play-game">Let's Play</button>
            <button type="button" data-screen="replay">Replay</button>
            <button type="button" data-screen="option">Option</button>
            <button type="button" data-screen="credit">Credits</button>
        </div>
    </section>

    <div class="play-setting" id="play-setting">
        <div class="play-setting-menu">
            <button type="button" data-action="close" class="close"></button>
            <h1>Mode</h1>
            <button type="button" data-action="single">Single Player</button>
            <button type="button" data-action="multi">Multiplayer</button>
        </div>
    </div>
    
    <!-- Script -->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../assets/js/main.js"></script>

    <script>

        function initialize() {
            $('section').fadeIn(500)
        }

        $('#main-menu').on('click', '[data-action]', function() {
            let action = $(this).data('action')
            switch (action) {
                case 'play-game':
                    $('#play-setting').fadeIn(500)
                    break
                default:
                    $('#play-setting').fadeOut(500)
                    break
            }
        })

        $('#play-setting').on('click', '[data-action]', function() {
            let action = $(this).data('action')
            $('#play-setting').hide(500)
            switch (action) {
                case 'single':
                    screenChange('play?bot=1')
                    break
                case 'multi':
                    screenChange('play')
                    break
                default:
                    $('#play-setting').fadeOut(500)
                    break
            }
        })

    </script>

</body>
</html>