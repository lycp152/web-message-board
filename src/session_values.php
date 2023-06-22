<?php
// ページ内で使用する変数を初期化する
$messages['input_error_author_name'] = '';
$messages['input_error_message'] = '';
$messages['input_pre_author_name'] = '';
$messages['input_pre_message'] = '';

// ページ内で使用する変数にセッションから代入する
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