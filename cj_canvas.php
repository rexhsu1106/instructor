<style type="text/css">
.ecommerce-header-top {
  background-color: #ffffff;
  box-shadow: 0 0 10px rgba(10, 10, 10, 0.5);
  min-height: 6rem;
  padding-top: 1.8rem;
}
.ecommerce-header-top-message ul li{
  display: inline;
  padding-left: 0px;
}
.ecommerce-header-top-message .menu{
  padding-left: 5px;
}
.ecommerce-header-top-message .menu li a{
  padding-left: 6.4px;
}
.dropdown.menu > li.is-dropdown-submenu-parent > a {
  padding-right: 1.2rem;
}

.ecommerce-header-top-message .fa {
  color: inherit;
  font-size: inherit;
}
.ecommerce-header-top-links ul li {
  display: inline;
  padding-left: 5px;
}
.ecommerce-header-mobile-right ul{
  padding-top: 0.5rem;
  margin-bottom: 0rem;
}
.ecommerce-header-mobile-right ul li{
  display: inline;
  padding-left: 5px;
}

.ecommerce-header-mobile {
  background-color: #0a0a0a;
}
.ecommerce-header-off-canvas {
  background-color: #ffffff;
}
.ecommerce-header-off-canvas .menu{
  background-color: #e6e6e6;
}

.ecommerce-header-off-canvas .menu a{
  color: #358ccb;
}

.ecommerce-header-off-canvas hr{
  margin: 0;
}

.button-badge{
  padding: 0.5rem 0.8rem;
}
a.button-badge{
  color: white;
}

.dropdown a{
  padding-left: 6.4px;
  padding-right: 20px;
}


</style>


<?php
  $updatePasswordButton = '<li><a href="changePassword.php" class="button-badge"><i class="fa fa-id-card-o"></i> 變更密碼</a></li>';
  $logoutButton = '<li><a href="logout.php" class="button-badge"><i class="fa fa-sign-out"></i> 登出</a></li>';
  $lessonManageButton = '<li><a href="lessonManagement.php" class="button-badge"><i class="fa fa-book"></i> 課程管理</a></li>';
  $ratingButton = '<li><a href="ratingEvaluation.php" class="button-badge"><i class="fa fa-user-plus"></i> 評量</a></li>';

  $lookupEvaluationButton = '<li><a href="evaluation.php" class="button-badge"><i class="fa fa-user-plus"></i> 教練評量</a></li>';
  $selfRatingButton = '<li><a href="selfEvaluation.php" class="button-badge"><i class="fa fa-user-plus"></i> 自我評量</a></li>';


  $updatePasswordList = '<li><a href="changePassword.php"><i class="fa fa-id-card-o"></i> 變更密碼</a></li>';
  $logoutList = '<li><a href="logout.php"><i class="fa fa-sign-out"></i> 登出</a></li>';
  $lessonManageList = '<li><a href="lessonManagement.php"><i class="fa fa-book"></i> 課程管理</a></li>';
  $ratingList = '<li><a href="ratingEvaluation.php"><i class="fa fa-user-plus"></i> 評量</a></li>';
  $lookupEvaluationList = '<li><a href="evaluation.php""><i class="fa fa-user-plus"></i> 教練評量</a></li>';
  $selfRatingList = '<li><a href="selfEvaluation.php""><i class="fa fa-user-plus"></i> 自我評量</a></li>';
?>

<body>
<!-- ECOMMERCE HEADER -->
<!-- NOTE: This is the off-canvas menu that appears when you click on the hamburger menu on smaller screens. Everything in the `.off-canvas` div belongs in `src/layouts/default.html`. Copy this section into the `default.html` file and remove it from this file.  -->

<div class="off-canvas ecommerce-header-off-canvas position-left" id="ecommerce-header" data-off-canvas>

  <!-- Close button -->
  <button class="close-button" aria-label="Close menu" type="button" data-close>
    <span aria-hidden="true">&times;</span>
  </button>
<!--
  <ul class="vertical menu">
    <li class="main-nav-link"><a href="categories.html">Category 1</a></li>
    <li class="main-nav-link"><a href="#">Category 2</a></li>
    <li class="main-nav-link"><a href="why.html">Category 3</a></li>
    <li class="main-nav-link"><a href="build.html">Category 4</a></li>
    <li class="main-nav-link"><a href="#">Category 5</a></li>
  </ul>

  <hr>
-->
  <!-- Menu -->
  <ul class="menu vertical">
    <?php
          if($_SESSION['member']['type']=='instructor') {
            echo $ratingList;
            echo $lessonManageList;
          }
          else {
            echo $lookupEvaluationList;
            echo $selfRatingList;
            echo $updatePasswordList;
            //echo $logoutList;
          }
    ?>
  </ul>
  <!--
  <ul class="menu vertical">
    <li><a href="index.php"><i class="fi-mountains"></i>雪場資訊</a></li>
    <li><a href="instructors.php"><i class="fi-torsos-all"></i>教練團隊</a></li>
    <li><a href="articles.php"><i class="fi-book-bookmark"></i>相關文章</a></li>
  </ul>
  <hr>
  <ul class="menu vertical">
    <li><a href="comboCourse.php"><i class="fa fa-user-plus"></i>湊班資訊</a></li>
    <li><a href="order.php"><i class="fa fa-book"></i>訂單資訊</a></li>
    <li><a href="config.php"><i class="fa fa-id-card-o"></i>帳號設定</a></li>
  </ul>
  <hr>
  <ul class="menu vertical">
    <li><a href="mailto:admin@diy.ski"><i class="fi-mail"></i> 聯絡我們</a></li>
    <li><a href="logout.php"><i class="fa fa-sign-out"></i>登出</a></li>
  </ul>
  -->
</div>

<!-- NOTE: This is the header menu that appears at the top of your site. -->
<div class="off-canvas-content" data-off-canvas-content>
  <div class="ecommerce-header-top show-for-large">
    <div style="max-width: 100%" class="row align-justify">
      <div class="ecommerce-header-top-message">
        <div style=" display: -webkit-flex; display: -ms-flexbox; display: flex;  -webkit-justify-content: flex-start; -ms-flex-pack: start; justify-content: flex-start;">
        <!--
          <a style="padding: 0;" href="index.php"><img style="width: 12rem;"></a>
          <ul class="dropdown menu" data-dropdown-menu>
            <li>
              <a href="index.php"><i class="fi-mountains"></i>雪場資訊</a>
              <ul class="menu parkMenu">
                <li><a href="index.php">雪場一覽</a></li>
              </ul>
            </li>
            <li>
              <a href="instructors.php"><i class="fi-torsos-all"></i>教練團隊</a>
              <ul class="menu instructorMenu">
                <li><a href="instructors.php">教練一覽</a></li>
              </ul>
            </li>
            <li><a href="articles.php"><i class="fi-book-bookmark"></i>相關文章</a></li>
            <li>
              <a><i class="fa fa-info"></i> 查詢設定</a>
              <ul class="menu">
                <li><a href="comboCourse.php"><i class="fa fa-user-plus"></i>湊班資訊</a></li>
                <li><a href="order.php"><i class="fa fa-book"></i>訂單資訊</a></li>
                <li><a href="config.php"><i class="fa fa-id-card-o"></i>帳號設定</a></li>
                <li><a href="logout.php"><i class="fa fa-sign-out"></i>登出</a></li>
              </ul>
            </li>
            <li><a href="mailto:admin@diy.ski"><i class="fi-mail"></i> 聯絡我們</a></li>
          </ul>
          -->
        </div>
      </div>
      <div class="ecommerce-header-top-links">

        <ul>
          <li style="color: #000;">
            <?php
            if( $_SESSION['member']['name'] ) {
              echo 'Hi! '.$_SESSION['member']['name'];
            }
            ?>
          </li>
          <?php
          if($_SESSION['member']['type']=='instructor') {
            echo $ratingButton;
            echo $lessonManageButton;
          }
          else {
            echo $lookupEvaluationButton;
            echo $selfRatingButton;
            echo $updatePasswordButton;
            echo $logoutButton;
          }
          ?>
        </ul>
      </div>
    </div>
  </div>

  <div class="ecommerce-header-mobile hide-for-large">
    <div class="ecommerce-header-mobile-left">
      <button class="menu-icon" type="button" data-toggle="ecommerce-header"></button>
      <?php
      if($_SESSION['member']['type']=='instructor') {
        echo '<span style="color: #ffffff; font-weight:bold;">&nbsp&nbsp教練後台</span>';
      }
      else {
        echo '<span style="color: #ffffff; font-weight:bold;">&nbsp&nbsp滑雪成就紀錄</span>';
      }
      ?>
    </div>

    <div class="ecommerce-header-mobile-right">
    <ul>
      <?php
      if($_SESSION['member']['type']=='instructor') {
        //echo $lessonManageButton;
        echo $ratingButton;
      }
      else {
        //echo $updatePasswordButton;
        echo $logoutButton;
      }
      ?>

    </ul>
    </div>
  </div>
</div>
<br>

<script type="text/javascript">
  $(document).foundation();
</script>
</body>