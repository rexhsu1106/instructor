<?php
  require('session.php');

  $_SESSION['history']['destination'] = 'changePassword.php';

      if($_SESSION['member']['type'] == "student")
        ;
      else if($_SESSION['member']['type'] == "instructor")
        Header('Location: ratingEvaluation.php');
      else if($_SESSION['member']['type'] == "admin")
        Header('Location: manageEvaluation.php');
      else
        Header('Location: login.php');
?>

<!DOCTYPE html>
<html>
<head>
  <?php
    require('head.php');
  ?>
  <script src="loadDB.js?3" type="text/javascript"></script>
  <script src="common.js?3" type="text/javascript"></script>
</head>

<style type="text/css">

.login-box {
  box-shadow: 0 2px 4px rgba(10, 10, 10, 0.4);
  background: #fefefe;
  border-radius: 0;
  overflow: hidden;
}

.login-box .or {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
  display: inline-block;
  min-width: 2.1em;
  padding: 0.3em;
  border-radius: 50%;
  font-size: 0.6rem;
  text-align: center;
  font-size: 1.275rem;
  background: #cacaca;
  box-shadow: 0 2px 4px rgba(10, 10, 10, 0.4);
}

@media screen and (max-width: 39.9375em) {
  .login-box .or {
    top: 85%;
  }
}

.login-box-title {
  font-weight: 300;
  font-size: 1.875rem;
  margin-bottom: 1.25rem;
}

.login-box-form-section,
.login-box-social-section-inner {
  padding: 2.5rem;
}

.login-box-social-section {
  /*background: url("https://images.pexels.com/photos/179124/pexels-photo-179124.jpeg?w=1260&h=750&auto=compress&cs=tinysrgb");
  */
  background: url("/photos/cross-sky.jpg");
  background-size: cover;
  background-position: center;
}

.login-box-input {
  margin-bottom: 1.25rem;
  height: 2.5rem;
  border: 0;
  padding-left: 0;
  box-shadow: none;
  border-bottom: 1px solid #1779ba;
  font-weight: 400;
}

.login-box-input:focus {
  color: #1779ba;
  transition: 0.2s ease-in-out;
  box-shadow: none;
  border: 0;
  border-bottom: 2px solid #1779ba;
}

.login-box-submit-button {
  display: inline-block;
  vertical-align: middle;
  margin: 0 0 1rem 0;
  padding: 0.85em 1em;
  -webkit-appearance: none;
  border: 1px solid transparent;
  border-radius: 0;
  transition: background-color 0.25s ease-out, color 0.25s ease-out;
  font-size: 0.9rem;
  line-height: 1;
  text-align: center;
  cursor: pointer;
  background-color: #1779ba;
  color: #fefefe;
  display: block;
  width: 100%;
  margin-right: 0;
  margin-left: 0;
  border-radius: 0;
  text-transform: uppercase;
  margin-bottom: 0;
}

[data-whatinput='mouse'] .login-box-submit-button {
  outline: 0;
}

.login-box-submit-button:hover, .login-box-submit-button:focus {
  background-color: #126195;
  color: #fefefe;
}

.login-box-submit-button:hover,
.login-box-submit-button:focus {
  box-shadow: 0 2px 4px rgba(10, 10, 10, 0.4);
}

.login-box-submit-button:active {
  box-shadow: 0 1px 2px rgba(10, 10, 10, 0.4);
}

.login-box-social-button-facebook {
  display: inline-block;
  vertical-align: middle;
  margin: 0 0 1rem 0;
  padding: 0.85em 1em;
  -webkit-appearance: none;
  border: 1px solid transparent;
  border-radius: 0;
  transition: background-color 0.25s ease-out, color 0.25s ease-out;
  font-size: 0.9rem;
  line-height: 1;
  text-align: center;
  cursor: pointer;
  background-color: #3b5998;
  color: #fefefe;
  display: block;
  width: 100%;
  margin-right: 0;
  margin-left: 0;
  font-weight: 500;
  margin-bottom: 1.25rem;
  text-transform: uppercase;
}

[data-whatinput='mouse'] .login-box-social-button-facebook {
  outline: 0;
}

.login-box-social-button-facebook:hover, .login-box-social-button-facebook:focus {
  background-color: #2f477a;
  color: #fefefe;
}

.login-box-social-button-twitter {
  display: inline-block;
  vertical-align: middle;
  margin: 0 0 1rem 0;
  padding: 0.85em 1em;
  -webkit-appearance: none;
  border: 1px solid transparent;
  border-radius: 0;
  transition: background-color 0.25s ease-out, color 0.25s ease-out;
  font-size: 0.9rem;
  line-height: 1;
  text-align: center;
  cursor: pointer;
  background-color: #55acee;
  color: #fefefe;
  display: block;
  width: 100%;
  margin-right: 0;
  margin-left: 0;
  font-weight: 500;
  margin-bottom: 1.25rem;
  text-transform: uppercase;
}

[data-whatinput='mouse'] .login-box-social-button-twitter {
  outline: 0;
}

.login-box-social-button-twitter:hover, .login-box-social-button-twitter:focus {
  background-color: #1a8fe8;
  color: #fefefe;
}

.login-box-social-button-google {
  display: inline-block;
  vertical-align: middle;
  margin: 0 0 1rem 0;
  padding: 0.85em 1em;
  -webkit-appearance: none;
  border: 1px solid transparent;
  border-radius: 0;
  transition: background-color 0.25s ease-out, color 0.25s ease-out;
  font-size: 0.9rem;
  line-height: 1;
  text-align: center;
  cursor: pointer;
  background-color: #dd4b39;
  color: #fefefe;
  display: block;
  width: 100%;
  margin-right: 0;
  margin-left: 0;
  font-weight: 500;
  margin-bottom: 1.25rem;
  text-transform: uppercase;
}

[data-whatinput='mouse'] .login-box-social-button-google {
  outline: 0;
}

.login-box-social-button-google:hover, .login-box-social-button-google:focus {
  background-color: #be3221;
  color: #fefefe;
}

[class*="login-box-social-button-"]:hover,
[class*="login-box-social-button-"]:focus {
  box-shadow: 0 2px 4px rgba(10, 10, 10, 0.4);
}

.login-box-social-headline {
  display: block;
  margin-bottom: 2.5rem;
  font-size: 1.875rem;
  color: #fefefe;
  text-align: center;
}
</style>

<?php require('stickyShrinkNav.php'); ?>

<body>

  <div class="loading" id="cover" style="display: none;">
    <div class="row">
      <div class="small-12 text-center"><span><i class="fi-mobile-signal"></i> 連線中...</span></div>
    </div>
  </div>

<div class="login-box">
  <div class="row collapse expanded">
    <div class="small-12 medium-6 column small-order-2 medium-order-1">
      <div class="login-box-form-section">
        <h1 class="login-box-title">設定新密碼</h1>
        <input class="login-box-input" type="password" name="oldPassword" placeholder="舊密碼" />
        <input class="login-box-input" type="password" name="newPassword" placeholder="新密碼" />
        <input class="login-box-input" type="password" name="confirmedPassword" placeholder="再輸入一次新密碼" />
        <input class="login-box-submit-button" type="submit" name="change_submit" value="變更" />
      </div>
    </div>
    <div class="small-12 medium-6 column small-order-1 medium-order-2 login-box-social-section hide-for-small-only">
      <div class="login-box-social-section-inner">
      </div>
    </div>
  </div>
</div>

  <div class="row expanded">
    <div class="small-12 medium-6 column small-order-2 medium-order-1">

    </div>
  </div>

  <script type="text/javascript">

    <?php 
      echo 'var gUserName = "'.$_SESSION['member']['name'].'";';
    ?>
    <?php 
      echo 'var gUserEmail = "'.$_SESSION['member']['email'].'";';
    ?>

    $('input.login-box-input[name="oldPassword"]').change(function(){
      if($('input.login-box-input[name="oldPassword"]').val() == $('input.login-box-input[name="newPassword"]').val())
      {
        alert("新密碼跟舊密碼一樣，請輸入不同的新密碼");
        $('input.login-box-input[name="newPassword"]').val("");
      }
    });

    $('input.login-box-input[name="newPassword"]').change(function(){
      if($('input.login-box-input[name="oldPassword"]').val() == $('input.login-box-input[name="newPassword"]').val())
      {
        alert("新密碼跟舊密碼一樣，請輸入不同的新密碼");
        $('input.login-box-input[name="newPassword"]').val("");
      }
    });

    $('input.login-box-input[name="confirmedPassword"]').change(function(){
      if($('input.login-box-input[name="confirmedPassword"]').val() != $('input.login-box-input[name="newPassword"]').val())
      {
        alert("密碼輸入不相同，請重新確認");
        $('input.login-box-input[name="newPassword"]').val("");
        $('input.login-box-input[name="confirmedPassword"]').val("");
      }
    });

    $('input.login-box-submit-button[name="change_submit"]').click(function(){

      if($('input.login-box-input[name="oldPassword"]').val()=="")
      {
        alert("請輸入舊密碼");
        return;
      }

      if($('input.login-box-input[name="newPassword"]').val()=="")
      {
        alert("請輸入新密碼");
        return;
      }
      if($('input.login-box-input[name="confirmedPassword"]').val()=="")
      {
        alert("請再輸入一次新密碼");
        return;
      }

      $(this).attr('disabled', "");

      $('#cover').show();

      $.ajax({
        url:"accountHandler.php",
        type:"POST",
        data:{func: "updatePassword", user: {name: gUserName, email: gUserEmail, password: $('input.login-box-input[name="oldPassword"]').val(), newPassword: $('input.login-box-input[name="newPassword"]').val()}},
        dataType:"json",
        success: function(info){
          console.log(info);
          if(info.indexOf("Error") >= 0)
          {
            alert(info);
            $('input.login-box-submit-button[name="change_submit"]').removeAttr('disabled');
            $('#cover').hide();
          }
          else if(info=="success")
          {
            alert("密碼更新成功");
            //alert("電子信箱驗證信件已寄送，請查看您的電子郵件信箱");
            window.location.href = "evaluation.php";
          }
        },
        complete: function(){
          $('input.login-box-submit-button[name="change_submit"]').removeAttr('disabled');
          $('#cover').hide();
        },
        error: function(){
          alert("系統錯誤，無法登入"); 
          $('input.login-box-submit-button[name="change_submit"]').removeAttr('disabled');
          $('#cover').hide();
        }
      });
    });
  </script>
</body>

