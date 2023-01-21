<?php

error_reporting(0); // E_ALL
date_default_timezone_set('Asia/Bangkok');
header("Content-type: application/json; charset=utf-8");

require_once('../classes/Database.php');
require_once('../classes/Request.php');
require_once('../classes/Response.php');

if (Request::getMethod() === 'GET') {
    $param = array('replay_id' => Request::getParam('replay_id'));
    $sql = 'SELECT 
                replay_detail.mark,
                replay_detail.turn_count,
                replay_detail.place_row,
                replay_detail.place_col 
            FROM replay_detail
            WHERE replay_detail.replay_id = :replay_id';
    $query = Database::query($sql, $param);
    if (count($query)) {
        $result = $query;
        return Response::success($result, 'success', 200);
    } else {
        return Response::error('Could Not Retrieve Replay item!', 404);
    }
} else {
    return Response::error('Method Not Allowed!', 405);
}