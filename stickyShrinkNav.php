<style type="text/css">
.sticky-top-bar {
  position: sticky;
  top: 0;
  z-index: 1000;
  background-color: #2196e3;
  padding: 15px 0;
  transition: all 0.3s ease;
}

.sticky-top-bar.shrink {
  padding: 10px 0;
}

.sticky-top-bar ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
}

.sticky-top-bar li {
  margin: 0 15px;
}

.sticky-top-bar a {
  color: #ffffff;
  text-decoration: none;
  font-weight: bold;
}

body {
  padding-top: 0; /* 移除之前的 padding-top */
}

.sticky-shrinknav-menu {
  position: absolute;
  left: 50%;
  -webkit-transform: translateX(-50%);
      -ms-transform: translateX(-50%);
          transform: translateX(-50%);
  bottom: 0;
  height: 3.75rem;
  line-height: 3.75rem;
  width: 100%;
  background-color: rgba(23, 121, 186, 0.5);
  transition: all 0.1s ease;
}

.sticky-shrinknav-menu li {
  border-radius: 2px;
  transition: all 0.1s ease;
}

.sticky-shrinknav-menu li:hover {
  box-shadow: 0 0 0 1px #fefefe;
}

.sticky-shrinknav-menu a {
  color: #fefefe;
}

.sticky-shrinknav-header-title {
  transition: all 0.1s ease;
  position: relative;
  -webkit-transform: translateY(-1.875rem);
      -ms-transform: translateY(-1.875rem);
          transform: translateY(-1.875rem);
  margin-bottom: 0;
  color: #fefefe;
}

.sticky-shrinknav-header {
  width: 100%;
  height: 160px;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-justify-content: center;
      -ms-flex-pack: center;
          justify-content: center;
  background-color: #2196e3;
  text-align: center;
  position: fixed;
  top: 0;
  left: 0;
  overflow: hidden;
  transition: all 0.1s ease;
  background: url("/photos/nozawa-1.jpg");
  background-size: cover;
}

body.sticky-shrinknav-wrapper {
  padding-top: 130px;
}

body.sticky-shrinknav-wrapper .sticky-shrinknav-header {
  height: 3.75rem;
  background-color: rgba(23, 121, 186, 0.9);
}

body.sticky-shrinknav-wrapper .sticky-shrinknav-header .sticky-shrinknav-header-title {
  -webkit-transform: scale(0);
      -ms-transform: scale(0);
          transform: scale(0);
  transition: all 0.1s ease;
}
</style>

<header class="sticky-top-bar">
  <ul>
  <?php
  $updatePasswordList = '<li><a href="changePassword.php">變更密碼</a></li>';
  $logoutList = '<li><a href="logout.php">登出</a></li>';
  $lessonManageList = '<li><a href="lessonManagement.php">課程管理</a></li>';
  $ratingManageList = '<li><a href="ratingEvaluation.php">評量</a></li>';
  $lookupEvaluationList = '<li><a href="evaluation.php">教練評量</a></li>';
  $selfRatingList = '<li><a href="selfEvaluation.php">自我評量</a></li>';
  $evaluationManageList = '<li><a href="manageEvaluation.php">評量表維護</a></li>';
  $scheduleManageList = '<li><a href="manageSchedule.php">行程管理</a></li>';
  $memberManageList = '<li><a href="manageDIYmembers.php">DIY學員評量狀態</a></li>';

  if($_SESSION['member']['type']=='instructor') {
    echo $ratingManageList . $lessonManageList . $scheduleManageList . $logoutList;
  }
  else if($_SESSION['member']['type']=='admin') {
    echo $evaluationManageList . $memberManageList;
  }
  else {
    echo $lookupEvaluationList . $selfRatingList . $updatePasswordList . $logoutList;
  }
  ?>
  </ul>
</header>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
  var topBar = document.querySelector('.sticky-top-bar');
  window.addEventListener('scroll', function() {
    if (window.scrollY > 50) {
      topBar.classList.add('shrink');
    } else {
      topBar.classList.remove('shrink');
    }
  });
});
</script>
