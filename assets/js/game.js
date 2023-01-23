let game_setting = JSON.parse(localStorage.getItem('game_setting') || "[]")
var size_row_setting = $.isEmptyObject(game_setting['size_row_setting']) ? 3 : game_setting['size_row_setting']
var size_col_setting = $.isEmptyObject(game_setting['size_col_setting']) ? 3 : game_setting['size_col_setting']
var win_condition    = $.isEmptyObject(game_setting['win_condition']) ? 3 : game_setting['win_condition']
var stateLog = []
var state = []
var mark = 'x'
var turn = 1

function createBoard(playable = true, size_row = size_row_setting, size_col = size_col_setting) {
    stateLog = []
    state = []
    mark = 'x'
    turn = 1
    const fadeTime = 500
    $('.board').fadeOut(fadeTime)
    setTimeout(function() {
        $('.board').empty()
        for (let row = 0; row < size_row; row++) {
            state.push([])
            let column = ''
            for (let col = 0; col < size_col; col++) {
                state[row].push(null)
                column += '<td class="cell"></td>' 
            }
            $('.board').append(`<tr>${column}</tr>`)
        }
        playable == true && playableBoard()
        $('#turn-count').html(turn)
        $('#whose-turn').removeClass()
        $('#whose-turn').addClass(`${mark}-mark`)
        $('.board').fadeIn('slow')
    }, fadeTime)
}

function playableBoard() {
    $('.board td.cell').addClass('playable')
}

function placeMark(row, col) {
    $('.cell').removeClass(`latest`)
    let placement = $('.board').children(`tr:nth-child(${row + 1})`).children(`.cell:nth-child(${col + 1})`)
    placement.addClass(`${mark}-mark latest`)
    placement.removeClass('playable')
}


function drawingConditionCheck() {
    let isDrawing = false
    let playable  = $('.board').find('.playable').length
        isDrawing = playable == 0 ? true : false
        isDrawing == true && drawing()
        return isDrawing
}

function drawing() {
    setTimeout(function() {
        Swal.fire({ 
            icon : 'success',
            title: 'Drawing!',
            confirmButtonColor: '#3085d6', 
        }).then(function() {
            save && saveReplay(0)
        })
    }, 200)
    
}
                
function winningConditionCheck(size_row = size_row_setting, size_col = size_col_setting, win_cond = win_condition) {
    let isWinning = false
    if (!isWinning) {
        // Row Combo Condition
        for (let row = 0; row < size_row; row++) {
            for (let col = 0; col < size_col; col++) {
                if (state[row][col] !== null) {
                    let streak = 0
                    for (let offset = 0; offset < win_cond; offset++) {
                        if (col + offset < size_col) {
                            if (state[row][col+offset] == mark) {
                                streak++
                                if (streak >= win_cond) {
                                    isWinning = true
                                    winning(row, col, win_cond, 1)
                                }
                            } else {
                                break
                            }
                        }
                    }
                }
            }
        }
    }
    if (!isWinning) {
        // Column Combo Condition
        for (let row = 0; row < size_row; row++) {
            for (let col = 0; col < size_col; col++) {
                if (state[row][col] !== null) {
                    let streak = 0
                    for (let offset = 0; offset < win_cond; offset++) {
                        if (row + offset < size_row) {
                            if (state[row+offset][col] == mark) {
                                streak++
                                if (streak >= win_cond) {
                                    isWinning = true
                                    winning(row, col, win_cond, 2)
                                }
                            } else {
                                break
                            }
                        }
                    }
                }
            }
        }
    }
    if (!isWinning) {            
        // Diagonally Down Combo Condition
        for (let row = 0; row < size_row; row++) {
            for (let col = 0; col < size_col; col++) {
                if (state[row][col] !== null) {
                    let streak = 0
                    for (let offset = 0; offset < win_cond; offset++) {
                        if (row + offset < size_row && col + offset < size_col) {
                            if (state[row+offset][col+offset] == mark) {
                                streak++
                                if (streak >= win_cond) {
                                    isWinning = true
                                    winning(row, col, win_cond, 3)
                                }
                            } else {
                                break
                            }
                        }
                    }
                }
            }
        }
    }
    if (!isWinning) {
        // Diagonally Up Combo Condition
        for (let row = 0; row < size_row; row++) {
            for (let col = 0; col < size_col; col++) {
                if (state[row][col] !== null) {
                    let streak = 0
                    for (let offset = 0; offset < win_cond; offset++) {
                        if (row - offset >= 0 && col + offset < size_col) {
                            if (state[row-offset][col+offset] == mark) {
                                streak++
                                if (streak >= win_cond) {
                                    isWinning = true
                                    winning(row, col, win_cond, 4)
                                }
                            } else {
                                break
                            }
                        }
                    }
                }
            }
        }
    }
    return isWinning
}

function winning(row, col, win_cond = win_condition, pattern) {
    $('.cell.playable').removeClass(`playable`)
    for (let offset = 0; offset < win_cond; offset++) {
        switch (pattern) {
            case 1:
                winningHilight(row, col + offset)
                break
            case 2:
                winningHilight(row + offset, col)
                break
            case 3:
                winningHilight(row + offset, col + offset)
                break
            case 4:
                winningHilight(row - offset, col + offset)
                break
            default:
                break
        }
    }
    let name = mark == 'x' ? player1 : player2
    let winner = mark == 'x' ? 1 : 2
    setTimeout(function() {
        Swal.fire({ 
            icon : 'success',
            title: 'WINNER!',
            text : name, 
            confirmButtonColor: '#3085d6', 
        }).then(function() {
            save && saveReplay(winner)
        })
    }, 200)
}

function winningHilight(row, col) {
    let placement = $('.board').children(`tr:nth-child(${row + 1})`).children(`.cell:nth-child(${col + 1})`)
    placement.addClass('hilight')
}
                
function turnChange() {
    mark = mark === 'x' ? 'o' : 'x'
    turn++
    $('#turn-count').html(turn)
    $('#whose-turn').removeClass()
    $('#whose-turn').addClass(`${mark}-mark`)
}
