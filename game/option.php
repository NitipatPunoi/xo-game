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

    <section>
        <div class="option">
            <h1>Option Setting</h1>
            <div class="option-menu">
                <label for="input-row-size">Row</label>
                <input type="number" name="input-row-size" max="25">
            </div>
            <div class="option-menu">
                <label for="input-col-size">Column</label>
                <input type="number" name="input-col-size" max="25">
            </div>
            <div class="option-menu">
                <label for="input-win-condition">Win Condition</label>
                <input type="number" name="input-win-condition">
            </div>
            <div class="option-menu">
                <button type="button" class="option-button" data-screen="index">Back</button>
                <button type="button" class="option-button" id="option-save">Save</button>
            </div>
        </div>
    </section>
    
    <!-- Script -->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../assets/js/main.js"></script>

    <script>

        function initialize() {
            let game_setting = JSON.parse(localStorage.getItem('game_setting') || "[]")
            let size_row_setting = $.isEmptyObject(game_setting['size_row_setting']) ? 3 : game_setting['size_row_setting']
            let size_col_setting = $.isEmptyObject(game_setting['size_col_setting']) ? 3 : game_setting['size_col_setting']
            let win_condition    = $.isEmptyObject(game_setting['win_condition']) ? 3 : game_setting['win_condition']
            $('.option input[name="input-row-size"]').val(size_row_setting)
            $('.option input[name="input-col-size"]').val(size_col_setting)
            $('.option input[name="input-win-condition"]').val(win_condition)
            $('section').fadeIn(500)
        }

        $('#option-save').on('click', function() {
            setTimeout(function() {
                Swal.fire({ 
                    icon : 'success',
                    title: 'Save!',
                    confirmButtonColor: '#3085d6', 
                }).then(function() {
                    let game_setting = {}
                    game_setting['size_row_setting'] = $('.option input[name="input-row-size"]').val()
                    game_setting['size_col_setting'] = $('.option input[name="input-col-size"]').val()
                    game_setting['win_condition']    = $('.option input[name="input-win-condition"]').val()
                    localStorage.setItem('game_setting', JSON.stringify(game_setting))
                    screenChange('index')
                })
            }, 100)
        })

    </script>

</body>
</html>