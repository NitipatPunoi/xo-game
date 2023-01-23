<?php

error_reporting(0); // E_ALL
date_default_timezone_set('Asia/Bangkok');
header("Content-type: application/json; charset=utf-8");

require_once('../classes/Database.php');
require_once('../classes/Request.php');
require_once('../classes/Response.php');

if (Request::getMethod() === 'GET') {
    $sql = 'SELECT 
                replay.id,
                replay.player1,
                replay.player2,
                replay.size_row,
                replay.size_col,
                replay.win_cond, 
                replay.result, 
                replay.created_at 
            FROM replay
            ORDER BY replay.id DESC';
    $query = Database::query($sql);
    if (count($query)) {
        $result = array();
        foreach ($query AS $index => $item) {
            $time  = $item->created_at;
            $date  = date('j', strtotime($time));
            $month = date('M', strtotime($time));
            $year  = date('Y', strtotime($time));
            $time  = date('h:i:s', strtotime($time));
            $item->time  = $time;
            $item->date  = $date;
            $item->month = $month;
            $item->year  = $year;
            array_push($result, $item);
        }
        $result = $query;
        return Response::success($result, 'success', 200);
    } else {
        return Response::error('We have no record!', 404);
    }
} else {
    return Response::error('Method Not Allowed!', 405);
}