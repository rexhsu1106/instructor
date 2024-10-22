<style type="text/css">
.sticky-shrinknav-header {
  width: 100%;
  height: 60px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: rgba(23, 121, 186, 0.9);
  position: fixed;
  bottom: 0;
  left: 0;
  z-index: 1000;
}

.sticky-button {
  width: 100%;
  height: 100%;
  font-size: 1.1rem;
  font-weight: bold;
  color: #ffffff;
  background-color: #2196e3;
  border: none;
  cursor: pointer;
  transition: background-color 0.2s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.sticky-button:hover {
  background-color: #1976d2;
}

body {
  padding-bottom: 70px;
}

@media screen and (max-width: 768px) {
  .sticky-button {
    font-size: 1rem;
  }
}
</style>

<header class="sticky-shrinknav-header">
  <?php
  $currentPage = basename($_SERVER['PHP_SELF']);
  $buttonText = '';
  $buttonAction = '';

  switch ($currentPage) {
    case 'ratingEvaluation.php':
      $buttonText = '儲存評量結果';
      $buttonAction = 'saveRatingEvaluation()';
      break;
    case 'selfEvaluation.php':
      $buttonText = '儲存自我評量結果';
      $buttonAction = 'saveSelfEvaluation()';
      break;
    // 可以根據需要添加更多的頁面
    default:
      // 如果不是特定頁面，不顯示按鈕
      $buttonText = '';
      break;
  }

  if ($buttonText) {
    echo "<button class='sticky-button storeRecords' onclick='$buttonAction'>$buttonText</button>";
  }
  ?>
</header>

<script type="text/javascript">
function saveRatingEvaluation() {
  // 實現儲存評量結果的邏輯
  console.log('儲存評量結果');
  // 這裡可以添加 AJAX 請求或其他必要的邏輯
}

function saveSelfEvaluation() {
  // 實現儲存自我評量結果的邏輯
  console.log('儲存自我評量結果');
  // 這裡可以添加 AJAX 請求或其他必要的邏輯
}
</script>
