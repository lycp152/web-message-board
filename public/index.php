<?php
session_start();
require_once(__DIR__ . '/../src/db_connect.php');

if (isset($_POST['action_type']) && $_POST['action_type']) {
  if ($_POST['action_type'] === 'insert') {
    require(__DIR__ . '/../src/insert_message.php');
  } elseif ($_POST['action_type'] === 'delete') {
    require(__DIR__ . '/../src/delete_message.php');
  }
}

require(__DIR__ . '/../src/session_values.php');

$stmt = $dbh->query('SELECT * FROM posts ORDER BY created_at DESC;');
$message_length = $stmt->rowCount();

function convertTz($datetime_text)
{
  $datetime = new DateTime($datetime_text);
  $datetime->setTimezone(new DateTimeZone('Asia/Tokyo'));
  return $datetime->format('Y/m/d H:i:s');
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex" />
  <title>ひとこと掲示板</title>
  <link rel="stylesheet" href="./assets/main.css" />
</head>

<body>
  <div class="page-cover">
    <p class="page-title">ひとこと掲示板</p>
    <hr class="page-divider" />

    <?php if ($messages['action_success_text'] !== '') { ?>
      <div class="action-success-area"><?php echo $messages['action_success_text']; ?></div>
    <?php } ?>
    <?php if ($messages['action_error_text'] !== '') { ?>
      <div class="action-failed-area"><?php echo $messages['action_error_text']; ?></div>
    <?php } ?>

    <div class="form-cover">
      <form action="/" method="post">
        <div class="form-input-title">投稿者ニックネーム</div>
        <input type="text" name="author_name" maxlength="40" value="<?php echo htmlspecialchars($messages['input_pre_author_name'], ENT_QUOTES); ?>" class="input-author-name" />
        <?php if ($messages['input_error_author_name'] !== '') { ?>
          <div class="form-input-error">
            <?php echo $messages['input_error_author_name']; ?>
          </div>
        <?php } ?>
        <div class="form-input-title">投稿内容<small>(必須)</small></div>
        <textarea name="message" class="input-message"><?php echo htmlspecialchars($messages['input_pre_message'], ENT_QUOTES); ?></textarea>
        <?php if ($messages['input_error_message'] !== '') { ?>
          <div class="form-input-error">
            <?php echo $messages['input_error_message']; ?>
          </div>
        <?php } ?>
        <input type="hidden" name="action_type" value="insert" />
        <button type="submit" class="input-submit-button">投稿する</button>
      </form>
    </div>
    <hr class="page-divider" />
    <div class="message-list-cover">
      <small>
        <?php echo $message_length; ?> 件の投稿
      </small>

      <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
        <?php $lines = explode("\n", $row['message']); ?>
        <div class="message-item">
          <div class="message-title">
            <div><?php echo htmlspecialchars($row['author_name'], ENT_QUOTES); ?></div>
            <small><?php echo convertTz($row['created_at']); ?></small>
            <div class="spacer"></div>
            <form action="/" method="post" style="text-align:right">
              <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
              <input type="hidden" name="action_type" value="delete" />
              <button type="submit" class="message-delete-button">削除</button>
            </form>
          </div>
          <?php foreach ($lines as $line) { ?>
            <p class="message-line"><?php echo htmlspecialchars($line, ENT_QUOTES); ?></p>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
  </div>
</body>

</html>