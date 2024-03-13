<?php
session_start();

$action = $_GET['action'] ?? 'time';
$additional_time = $_GET['additional_time'] ?? 0;

switch ($action) {
    case 'start':
        $_SESSION['start_time'] = time() - ($additional_time + ($_SESSION['elapsed_time'] ?? 0));
        break;

    case 'stop':
        if (isset($_SESSION['start_time'])) {
            $_SESSION['elapsed_time'] = time() - $_SESSION['start_time'];
            unset($_SESSION['start_time']);
        }
        break;

    case 'reset':
        unset($_SESSION['start_time'], $_SESSION['elapsed_time']);
        $_SESSION['elapsed_time'] = 0;
        break;

    case 'time':
        if (isset($_SESSION['start_time'])) {
            $elapsedTime = time() - $_SESSION['start_time'];
        } else {
            $elapsedTime = $_SESSION['elapsed_time'] ?? 0;
        }

        $hours = floor($elapsedTime / 3600);
        $minutes = floor(($elapsedTime / 60) % 60);
        $seconds = $elapsedTime % 60;

        echo str_pad($hours, 2, "0", STR_PAD_LEFT) . ":" 
           . str_pad($minutes, 2, "0", STR_PAD_LEFT) . ":" 
           . str_pad($seconds, 2, "0", STR_PAD_LEFT);
        break;
}
?>
