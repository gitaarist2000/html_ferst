<?php


if ($_COOKIE['session_id'] ?? []) {
    session_id($_COOKIE['session_id']);
    session_start();
} else {
    $sessionId = md5(rand(1,100000) . md5(time()));
    session_id($sessionId);
    session_start();
    setcookie('session_id', $sessionId, time() + 50000);
}