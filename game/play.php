<?php 

    $bot = isset($_GET['bot']) ? 1 : 0;

?>

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
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body onload="initialize()">

    <section id="play-game">
        <div class="navigation">
            <button type="button" data-screen="index">Main Menu</button>
            <button type="button" data-action="reset">Restart</button>
        </div>
        <div class="header">
            <h1>X O GAME</h1>
        </div>
        <div class="game">
            <div class="game-wrapper">
                <div class="game-info">
                    <span>turn<span id="turn-count"></span></span>
                    <span id="whose-turn">play</span>
                </div>
                <div class="board-area">
                    <table class="board"></table>
                </div>
            </div>
            <div class="player-info">
                <p id="player1"></p>
                <p>VS</p>
                <p id="player2"></p>
            </div>
        </div>
    </section>
    
    <!-- Script -->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/game.js"></script>

    <script>
        
        var bot = '<?php echo $bot; ?>'
        var botTurn = false
        var save = true
        var player1 = 'Player1'
        var player2 = bot == 1 ? 'BotEazy' : 'Player2'

        function initialize() {
            $('#player1').html(player1)
            $('#player2').html(player2)
            createBoard()
            $('section').fadeIn(500)
        }
        
        function saveReplay() {
            let formData = new FormData()
                formData.append('player1', player1)
                formData.append('player2', player2)
                formData.append('size_row', size_row_setting)
                formData.append('size_col', size_col_setting)
                formData.append('win_cond', win_condition)
                formData.append('stateLog', JSON.stringify(stateLog))
            $.ajax({  
                url  : '../services/replay/create.php',
                type : 'POST',
                data : formData,
                cache: false,
                contentType: false,
                processData: false,
            }).done(function(response, textStatus, jqXHR) {
                setTimeout(function() {
                    alert.fire({
                        icon: 'success',
                        title: 'Replay saved',
                    })
                }, 100)
            }).fail(function(jqXHR, textStatus, errorMessage) { 
                setTimeout(function() {
                    alert.fire({
                        icon: 'error',
                        title: 'Oops! No replay saved',
                    })
                }, 100)
            })
        }
        
        const alert = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
        })

        $('.board').on('click', '.cell.playable', function() {
            if (!botTurn) {
                const row = $(this).parent().parent().children().index($(this).parent())
                const col = $(this).parent().children().index($(this))
                state[row][col] = mark
                log = {}
                log['mark'] = mark
                log['place_row'] = row
                log['place_col'] = col
                stateLog.push(log)
                placeMark(row, col)
                let isWinning = winningConditionCheck()
                let isDrawing = !isWinning ? drawingConditionCheck() : false
                    !isDrawing && !isWinning && turnChange()
                    !isDrawing && !isWinning && bot > 0 && botPlay()
            }
        })

        function botPlay() {
            botTurn = true
            let playable = $('.board').find('.playable').length
            let botPlace = getRandomInt(1, playable)
            let target = $(`.board .playable:eq(${botPlace-1})`)
            const row = target.parent().parent().children().index(target.parent())
            const col = target.parent().children().index(target)
            setTimeout(function() {
                state[row][col] = mark
                log = {}
                log['mark'] = mark
                log['place_row'] = row
                log['place_col'] = col
                stateLog.push(log)
                placeMark(row, col)
                let isWinning = winningConditionCheck()
                let isDrawing = !isWinning ? drawingConditionCheck() : false
                    !isDrawing && !isWinning && turnChange()
                botTurn = false  
            }, 500)
        }

        function getRandomInt(min, max) {
            min = Math.ceil(min)
            max = Math.floor(max)
            return Math.floor(Math.random() * (max - min) + min)
        }

        $('[data-action=reset]').on('click', function() {
            createBoard()
            botTurn = false
        })

    </script>

</body>
</html>