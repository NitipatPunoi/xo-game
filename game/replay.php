<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XO Game</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body onload="initialize()">

    <div class="run-replay" id="run-replay">
        <div class="game">
            <button type="button" data-action="close" class="close"></button>
            <div class="header">
                <h1>Replay</h1>
            </div>
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
    </div>

    <section>
        <div class="navigation">
            <button type="button" data-screen="index">Main Menu</button>
        </div>
        <div class="replay-list" id="replay-list"></div>
    </section>
    
    <!-- Script -->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/game.js"></script>

    <script>
        
        var renderInterval
        var save = false
        var player1 
        var player2 
        
        function initialize() {
            loadReplay()
            $('section').fadeIn(500)
        }

        function loadReplay() {
            $.ajax({
                url : '../services/replay/retrieve.php',
                type: 'GET',
                cache: false,
            }).done(function(response, textStatus, jqXHR) {
                $('#replay-list').empty()
                let loadReplay = response.result
                $.each(loadReplay, function(index, item) {
                    $('#replay-list').append(
                        `<button 
                            class="replay-item" 
                            data-id="${item.id}" 
                            data-size_row="${item.size_row}" 
                            data-size_col="${item.size_col}"
                            data-win_cond="${item.win_cond}"
                            data-player1="${item.player1}"
                            data-player2="${item.player2}">
                            <div class="replay-id">${String('0000' + item.id).slice(-4)}</div>
                            <div class="player">${item.player1} VS ${item.player2}</div>
                            <div class="size">
                                <label>size</label>
                                <div>${item.size_row}x${item.size_col}</div>
                            </div>
                            <div class="date-time">
                                <div class="date">${item.date}${item.month}${item.year}</div>
                                <div class="time">${item.time}</div>
                            </div>
                        </button>`
                    )
                })
                $('#replay-list').fadeIn(500)
            }).fail(function(jqXHR, textStatus, errorMessage) {
                setTimeout(function() {
                    Swal.fire({ 
                        icon : 'warning',
                        title: 'Sorry!',
                        text : jqXHR.responseJSON.message, 
                        confirmButtonColor: '#3085d6',
                    }).then(function() {
                        location.assign('index')
                    })
                }, 100)
            })
        }

        function loadReplayLog(replay_id, size_row, size_col, win_cond) {
            $.ajax({
                url : '../services/replay/detail.php',
                type: 'GET',
                data: {
                    replay_id: replay_id,
                },
                cache: false,
            }).done(function(response, textStatus, jqXHR) {
                let replay = response.result
                let timerInterval
                Swal.fire({
                    title: 'Loading Replay!',
                    timer: 1000,
                    timerProgressBar: true,
                    didOpen: function() {
                        Swal.showLoading()
                        $('#turn-count').html(1)
                        $('#whose-turn').removeClass()
                        $('#whose-turn').addClass('x-mark')
                    },
                    willClose: function() {
                        clearInterval(timerInterval)
                    }
                }).then(function(result) {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        $('#run-replay').fadeIn('slow')
                        $('#player1').html(player1)
                        $('#player2').html(player2)
                        createBoard(false, size_row, size_col) 
                        setTimeout(function() {
                            replayRender(replay, size_row, size_col, win_cond)
                        }, 1000)
                    }
                })
            }).fail(function(jqXHR, textStatus, errorMessage) {
                setTimeout(function() {
                    Swal.fire({ 
                        icon : 'error',
                        title: 'Oops!',
                        text : jqXHR.responseJSON.message, 
                        confirmButtonColor: '#3085d6',
                    })
                }, 100)
            })
        }
        
        function replayRender(replay, size_row, size_col, win_cond) {
            let length = replay.length
            let index  = 0
            let row
            let col
            let isDrawing
            let isWinning
            renderInterval = setInterval(function() {
                if (index < length) {
                    row = replay[index].place_row
                    col = replay[index].place_col
                    state[row][col] = mark
                    placeMark(row, col)
                    isWinning = winningConditionCheck(size_row, size_col, win_cond)
                    isDrawing = index + 1 == length && !isWinning ? drawingConditionCheck() : false 
                    !isDrawing && !isWinning && turnChange()
                    index++
                } else {
                    clearInterval(renderInterval)
                }
            }, 1000)
        }
        
        $('#replay-list').on('click', '[data-id]', function() {
            let replay_id = $(this).data('id')
            let size_row  = $(this).data('size_row')
            let size_col  = $(this).data('size_col')
            let win_cond  = $(this).data('win_cond')
                player1  = $(this).data('player1')
                player2  = $(this).data('player2')
            $('#run-replay').hide(500)
            clearInterval(renderInterval)
            loadReplayLog(replay_id, size_row, size_col, win_cond)
        })

        $('#run-replay').on('click', '[data-action=close]', function() {
            $('#run-replay').hide(500)
            clearInterval(renderInterval)
        })

        $(document).on('keyup', function(event) {
            if (event.key == "Escape") {
                $('#run-replay').hide(500)
                clearInterval(renderInterval)
            }
        })

    </script>

</body>
</html>