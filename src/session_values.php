<?php
// ページ内で使用する変数を初期化する
$messages['action_success_text'] = '';
$messages['action_error_text'] = '';
$messages['input_error_author_name'] = '';
$messages['input_error_message'] = '';
$messages['input_pre_author_name'] = '';
$messages['input_pre_message'] = '';

// ページ内で使用する変数にセッションから代入する
if (isset($_SESSION['action_success_text'])) {
    $messages['action_success_text'] = $_SESSION["action_success_text"];
    unset($_SESSION["action_success_text"]);
}

if (isset($_SESSION['action_error_text'])) {
    $messages['action_error_text'] = $_SESSION["action_error_text"];
    unset($_SESSION["action_error_text"]);
}

if (isset($_SESSION['input_error_author_name'])) {
    $messages['input_error_author_name'] = $_SESSION["input_error_author_name"];
    unset($_SESSION["input_error_author_name"]);
}

if (isset($_SESSION['input_error_message'])) {
    $messages['input_error_message'] = $_SESSION["input_error_message"];
    unset($_SESSION["input_error_message"]);
}

if (isset($_SESSION['input_pre_author_name'])) {
    $messages['input_pre_author_name'] = $_SESSION["input_pre_author_name"];
    unset($_SESSION["input_pre_author_name"]);
}

if (isset($_SESSION['input_pre_message'])) {
    $messages['input_pre_message'] = $_SESSION["input_pre_message"];
    unset($_SESSION["input_pre_message"]);
}