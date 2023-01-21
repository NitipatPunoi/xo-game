<?php 

    error_reporting(0); // E_ALL
    date_default_timezone_set('Asia/Bangkok');
    header("Content-type: application/json; charset=utf-8");

    require_once('../classes/Database.php');
    require_once('../classes/Request.php');
    require_once('../classes/Response.php');

    if (Request::getMethod() === "POST") {
        $param = array(
            'player1' => Request::clean($_POST['player1']),
            'player2' => Request::clean($_POST['player2']),
            'size_row' => Request::clean($_POST['size_row']),
            'size_col' => Request::clean($_POST['size_col']),
            'win_cond' => Request::clean($_POST['win_cond']),
            'created_at' => date('Y-m-d h:i:s'),
        );
        $sql = 'INSERT INTO replay (
                    replay.player1, 
                    replay.player2, 
                    replay.size_row, 
                    replay.size_col, 
                    replay.win_cond, 
                    replay.created_at
                ) VALUES (
                    :player1, 
                    :player2, 
                    :size_row, 
                    :size_col,
                    :win_cond, 
                    :created_at
                )';
        $query = Database::query($sql, $param);
        if ($query) {
            $lastInsertId = $query;
            $log = json_decode(stripslashes($_POST['stateLog']), true);
            foreach ($log as $index => $item) {
                $param = array(
                    'replay_id' => $lastInsertId,
                    'mark' => $item['mark'],
                    'turn_count' => $index + 1,
                    'place_row' => $item['place_row'],
                    'place_col' => $item['place_col'],
                );        
                $sql = 'INSERT INTO replay_detail (
                            replay_detail.replay_id, 
                            replay_detail.mark, 
                            replay_detail.turn_count, 
                            replay_detail.place_row,
                            replay_detail.place_col
                        ) VALUES (
                            :replay_id, 
                            :mark, 
                            :turn_count, 
                            :place_row,
                            :place_col
                        )';
                $query = Database::query($sql, $param);
            }
            return Response::success();
        } else {
            return Response::error();
        }
    } else {
        return Response::error('Method Not Allowed!', 405);
    }