<?php
  require('session.php');
?>

<!DOCTYPE html>
<html>
<head>
  <?php
    require('head.php');
  ?>
  <script src="loadDB.js?1" type="text/javascript"></script>
  <script src="common.js?1" type="text/javascript"></script>
  <script src="experienceCase.js?3" type="text/javascript"></script>
</head>

<style type="text/css">
.button{
  border-radius: 5px; 
}

.rating-block .star {
  /*stroke: #cc4b37;*/
  stroke: #5f9ea0;
}

/* Hover effect */
.rating-block-rating:hover .star polygon,
.rating-block-rating.is-voted:hover .star.selected ~ .star polygon {
  fill: #D7F0FC;
}
.rating-block-rating .star:hover ~ .star polygon,

.rating-block-rating.is-voted .star:hover ~ .star.selected ~ .star polygon, 
.rating-block-rating.is-voted .star.selected:hover ~ .star polygon,
.rating-block-rating.is-voted .star.selected ~ .star:hover ~ .star polygon {
  fill: transparent;
}

.rating-block .rating-block-rating .star.selected polygon {
  /*fill: blue;*/
  fill: #1e90ff;
}

.rating-block .rating-block-rating.is-voted .star polygon {
  /*fill: blue;*/
  fill: #1e90ff;
}

.styled {
  width: 10rem;
  cursor: pointer;
  margin: 3px;
  border: 0;
  line-height: 2.5;
  padding: 0 20px;
  font-size: 1rem;
  text-align: center;
  color: #fff;
  text-shadow: 1px 1px 1px #000;
  border-radius: 10px;
  background-color: rgba(220, 0, 0, 1);
  background-image: linear-gradient(
    to top left,
    rgba(0, 0, 0, 0.2),
    rgba(0, 0, 0, 0.2) 30%,
    rgba(0, 0, 0, 0)
  );
  box-shadow:
    inset 2px 2px 3px rgba(255, 255, 255, 0.6),
    inset -2px -2px 3px rgba(0, 0, 0, 0.6);
}

.styled:hover {
  background-color: rgba(255, 0, 0, 1);
}

.styled:active {
  box-shadow:
    inset -2px -2px 3px rgba(255, 255, 255, 0.6),
    inset 2px 2px 3px rgba(0, 0, 0, 0.6);
}

.table-expand td{
  padding: 0.25rem 0 0.25rem 0.25rem;
}

.table-expand{
  margin-top: 2rem;
}

.rating-block {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: center;
}

@media screen and (max-width: 768px) {
  .rating-block {
    flex-direction: column;
    align-items: flex-start;
  }
}

</style>

<body>

  <div class="loading" id="cover" style="display: none;">
    <div class="row">
      <div class="small-12 text-center"><span><i class="fi-mobile-signal"></i> 連線中...</span></div>
    </div>
  </div>

<?php require('stickyShrinkNav_Bottom.php'); ?>

  <div style="max-width: 100%" class="row align-center">
    <div class="column small-12 large-10">
      <br>
      <h4 id="welcom">歡迎幫自己做個評量</h4>
      <h5 style="color: darkgray;">如果你沒有上過課或者間隔好幾次課程沒有上課，自我的評量結果可以讓教練更清楚你的學習進度喔。</h5>
      <p style="color: brown; display:inline;">針對每一個項目，可點選一至三顆星。</p>
      <p style="color: brown; font-weight: bold; display:inline; background: khaki; padding: 3px;">若是要取消該項目的星星，請重複點擊第一顆星。</p>
    </div>
  </div>

  <div style="max-width: 100%" class="row align-center">
    <div class="column small-12 large-10">
      <div class="rating-block" style="justify-content: flex-end;">
        <p class="ratings-type">知道怎麼做</p>
        <div class="rating-block-rating is-voted">            
          <div class="star selected">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="37" viewBox="0 0 40 37">
              <polygon fill="none" points="272 30 260.244 36.18 262.489 23.09 252.979 13.82 266.122 11.91 272 0 277.878 11.91 291.021 13.82 281.511 23.09 283.756 36.18" transform="translate(-252)"/> 
            </svg>
          </div>
            <div class="star">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="37" viewBox="0 0 40 37">
              <polygon fill="none" points="272 30 260.244 36.18 262.489 23.09 252.979 13.82 266.122 11.91 272 0 277.878 11.91 291.021 13.82 281.511 23.09 283.756 36.18" transform="translate(-252)"/> 
            </svg>
          </div>
            <div class="star">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="37" viewBox="0 0 40 37">
              <polygon fill="none" points="272 30 260.244 36.18 262.489 23.09 252.979 13.82 266.122 11.91 272 0 277.878 11.91 291.021 13.82 281.511 23.09 283.756 36.18" transform="translate(-252)"/> 
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div style="max-width: 100%" class="row align-center">
    <div class="column small-12 large-10">
      <div class="rating-block" style="justify-content: flex-end;">
        <p class="ratings-type">正確的操作</p>
        <div class="rating-block-rating is-voted">            
          <div class="star">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="37" viewBox="0 0 40 37">
              <polygon fill="none" points="272 30 260.244 36.18 262.489 23.09 252.979 13.82 266.122 11.91 272 0 277.878 11.91 291.021 13.82 281.511 23.09 283.756 36.18" transform="translate(-252)"/> 
            </svg>
          </div>
            <div class="star selected">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="37" viewBox="0 0 40 37">
              <polygon fill="none" points="272 30 260.244 36.18 262.489 23.09 252.979 13.82 266.122 11.91 272 0 277.878 11.91 291.021 13.82 281.511 23.09 283.756 36.18" transform="translate(-252)"/> 
            </svg>
          </div>
            <div class="star">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="37" viewBox="0 0 40 37">
              <polygon fill="none" points="272 30 260.244 36.18 262.489 23.09 252.979 13.82 266.122 11.91 272 0 277.878 11.91 291.021 13.82 281.511 23.09 283.756 36.18" transform="translate(-252)"/> 
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div style="max-width: 100%" class="row align-center">
    <div class="column small-12 large-10">
      <div class="rating-block" style="justify-content: flex-end;">
        <p class="ratings-type">熟練的動作</p>
        <div class="rating-block-rating is-voted">            
          <div class="star">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="37" viewBox="0 0 40 37">
              <polygon fill="none" points="272 30 260.244 36.18 262.489 23.09 252.979 13.82 266.122 11.91 272 0 277.878 11.91 291.021 13.82 281.511 23.09 283.756 36.18" transform="translate(-252)"/> 
            </svg>
          </div>
            <div class="star">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="37" viewBox="0 0 40 37">
              <polygon fill="none" points="272 30 260.244 36.18 262.489 23.09 252.979 13.82 266.122 11.91 272 0 277.878 11.91 291.021 13.82 281.511 23.09 283.756 36.18" transform="translate(-252)"/> 
            </svg>
          </div>
            <div class="star selected">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="37" viewBox="0 0 40 37">
              <polygon fill="none" points="272 30 260.244 36.18 262.489 23.09 252.979 13.82 266.122 11.91 272 0 277.878 11.91 291.021 13.82 281.511 23.09 283.756 36.18" transform="translate(-252)"/> 
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div style="max-width: 100%" class="row align-center">
    <div class="column small-12 large-10">
      <label><h6>備註: (*可以描述最近的滑行狀況)</h6></label>
      <textarea name="comment" rows="4" style="background-color: white; color: black; font-weight: bold;"></textarea>
    </div>
  </div>

  <div style="max-width: 100%" class="row align-center">
    <div class="column small-12 large-10" style="padding: 1rem; background-color: antiquewhite;">
      <label><h6 style="color: darkslateblue; font-weight: bold;">如果您是第一次使用，可以利用下面的按鈕為您快速完成自我評量</h6></label>
      <button class="favorite styled" type="button" id="recordCase" style="background-color: cadetblue;">重新下載評量</button>
      <button class="favorite styled" type="button" id="noExpCase">沒有試過滑雪</button>
      <button class="favorite styled" type="button" id="indoorCase">嘗試過室內滑雪</button>
      <button class="favorite styled" type="button" id="greenCase">可以綠線轉彎</button>
      <button class="favorite styled" type="button" id="redCase">可以紅線轉彎</button>
      <button class="favorite styled" type="button" id="blackCase">可以黑線轉彎</button>

    </div>
  </div>

  <div style="max-width: 100%" class="row align-center">
    <div class="column small-12 large-10">
      <div id="evaulationResults" style="margin-bottom: 4rem;">
      </div>
    </div>
  </div>
<!--
  <div style="max-width: 100%" class="row align-center">
    <div class="column small-12 large-10">
      <button class="storeRecords button expanded">儲存自我評量結果</button>
    </div>
-->
  </div>

  <script type="text/javascript">
    var evaTableHTML = '<table class="table-expand"> \
        <thead> \
          <tr class="table-expand-row"> \
            <th><h3 style="margin: 0 0 0.3rem 0;font-weight: bold; color: darkblue "></h3><h5 style="margin: 0; color: chocolate"></h5></th> \
          </tr> \
        </thead> \
        <tbody> \
        </tbody> \
      </table>';
    var evaTableRowHTML = '<tr class="table-expand-row" data-open-details> \
        <td> \
          <div class="rating-block"> \
            <p class="ratings-type" style="color: darkslategray;"></p> \
            <div class="rating-block-rating" data-rating> \
            </div> \
          </div> \
        </td> \
      </tr>';
    var starHTML = '<div class="star" role="radio" aria-checked="false" tabindex="0"> \
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="37" viewBox="0 0 40 37"> \
            <polygon fill="none" points="272 30 260.244 36.18 262.489 23.09 252.979 13.82 266.122 11.91 272 0 277.878 11.91 291.021 13.82 281.511 23.09 283.756 36.18" transform="translate(-252)"/> \
          </svg> \
        </div>';

    function updateEvaluationTable(ratingRecords) {
      var windowWidth = $(window).width();
      $('#cover').show();
      
      var evaulationArray = getEvaluationTableArray(gEvaluationItems, MAX_EVALUATION_LEVEL, MAX_EVALUATION_ITEM_NUMBER);
      //console.log(evaulationArray);

      var abilityListByIdx = getAbilityListArrayByIdx(gAbilityList);
      //console.log(abilityListByIdx);

      var eva = $('#evaulationResults');
      eva.empty();

      var totalStar = 0;
      var markedStar = 0;

      for(var level=0; level<MAX_EVALUATION_LEVEL; level++)
      {
        eva.append(evaTableHTML);
        var table = eva.find('.table-expand').last();
        if(level==0)
          table.css("margin-top", "1rem");
        //table.find('th').text("等級-"+(level+1));
        table.find('th h3').text(EVALUATION_LEVELS_DESCRIPTION_SB[level]);
        table.find('th h5').text(EVALUATION_LEVELS_EXPLANATION_SB[level]);
        for(var number=0; number<MAX_EVALUATION_ITEM_NUMBER; number++)
        {
          if(evaulationArray[level][number] > 0)
          {
            table.find('tbody').append(evaTableRowHTML);
           
            var rating = table.find('tbody .rating-block').last();

            var position = abilityListByIdx[evaulationArray[level][number]]['item'].indexOf('(');
            if(position>0 && windowWidth<600)
              rating.find('p').text(abilityListByIdx[evaulationArray[level][number]]['item'].substring(0, position));
            else
              rating.find('p').text(abilityListByIdx[evaulationArray[level][number]]['item']);

            var explanation = table.find('tbody .table-expand-row-nested').last();
            explanation.find('p').text(abilityListByIdx[evaulationArray[level][number]]['explanation']);

            var block = rating.find('.rating-block-rating').last();
            block.attr('abilityID', evaulationArray[level][number]);

            block.append(starHTML);
            var star = block.find('.star').last();
            star.attr('grade', RATING_KNEW);
            totalStar++;
            if(jQuery.inArray(block.attr('abilityID'), ratingRecords[RATING_KNEW]) >= 0)
            {
              star.siblings('.selected').removeClass('selected');
              star.addClass('selected');
              block.addClass('is-voted');
            }

            block.append(starHTML);
            star = block.find('.star').last();
            star.attr('grade', RATING_FAMILIAR);
            totalStar++;
            if(jQuery.inArray(block.attr('abilityID'), ratingRecords[RATING_FAMILIAR]) >= 0)
            {
              star.siblings('.selected').removeClass('selected');
              star.addClass('selected');
              block.addClass('is-voted');
            }

            block.append(starHTML);
            star = block.find('.star').last();
            star.attr('grade', RATING_EXCELLENT);
            totalStar++;
            if(jQuery.inArray(block.attr('abilityID'), ratingRecords[RATING_EXCELLENT]) >= 0)
            {
              star.siblings('.selected').removeClass('selected');
              star.addClass('selected');
              block.addClass('is-voted');
            }

            if(jQuery.inArray(block.attr('abilityID'), ratingRecords[RATING_KNEW]) >= 0)
              markedStar = markedStar+1;
            else if(jQuery.inArray(block.attr('abilityID'), ratingRecords[RATING_FAMILIAR]) >= 0)
              markedStar = markedStar+2;
            else if(jQuery.inArray(block.attr('abilityID'), ratingRecords[RATING_EXCELLENT]) >= 0)
              markedStar = markedStar+3;
          }
        }
      }

      $('[data-rating] .star').off('click');

      $('[data-rating] .star').click(function() {
        
        var abilityID = $(this).parent().attr('abilityID');
        var rating = {};

        if(gType == 'sb')
          rating = gSBratingRecords;
        else
          rating = gSKIratingRecords;

        for(key in rating)
        {
          //console.log(key);
          if(rating[key])
          {
            rating[key] = jQuery.grep(rating[key], function(value) {
              return value != abilityID;
            });
          }
        }

        //clear all red star, if first star is red and click it
        if($(this).attr('grade') == RATING_KNEW && $(this).hasClass('selected'))
        {
          $(this).removeClass('selected');
          $(this).parent().removeClass('is-voted');
        }
        else
        {
          $(this).siblings('.selected').removeClass('selected');
          $(this)
            .addClass('selected')
            .parent().addClass('is-voted');

          if(jQuery.inArray(abilityID, rating[$(this).attr('grade')]) < 0)
          {
            //console.log(rating);
            console.log($(this).attr('grade'));
            rating[$(this).attr('grade')].push(abilityID);
          }
        }

        console.log(rating);

        if(gType == 'sb')
          gSBratingRecords = rating;
        else
          gSKIratingRecords = rating;

      });

      //console.log("收集"+markedStar+"／"+totalStar+"顆星，達成率"+ (markedStar*100/totalStar).toFixed(2)+"%");
      //$('#starStatistics').text("收集"+markedStar+"／"+totalStar+"顆星，達成率"+ (markedStar*100/totalStar).toFixed(2)+"%");

      $('[data-open-details]').click(function (e) {
        e.preventDefault();
        $(this).next().toggleClass('is-active');
        $(this).toggleClass('is-active');
      });

      $('#cover').hide();
    }

  </script>

  <script type="text/javascript">

  <?php
    //echo $_GET['type'];
    $info = explode("@", $_GET['info']);

    $_NAME_INDEX = 0;
    $_EMAIL_USER_INDEX = 1;
    $_EMAIL_DOMAIN_INDEX = 2;
    $_TYPE_INDEX = 3;
    //var_dump($info);
    //info=alex@a@mail@SB&token=3708a8eb2a17bf1f926bcbcdb9a2f28e
    //info[0] : student name
    //info[1] : eamil address(user name)
    //info[2] : eamil address(domain)
    //info[3] : type

    //if(md5($info[$_ORDER_INDEX]) == 'ORD1000')
    
    if(md5('newdiyski'.$info[$_NAME_INDEX]) == ($_GET['token']))
    {
      echo "var studentInfo = new Array();";
      echo "studentInfo[0] = {};";
      echo "studentInfo[0]['name'] = '".htmlspecialchars($info[$_NAME_INDEX], ENT_QUOTES, 'UTF-8')."';";
      echo "studentInfo[0]['email'] = '".$info[$_EMAIL_USER_INDEX].'@'.$info[$_EMAIL_DOMAIN_INDEX]."';";
      echo "var gType = '".strtolower($info[$_TYPE_INDEX])."';";
    }
    else
    {
      echo "var studentInfo = new Array();";
      echo "studentInfo[0] = {};";
      echo "studentInfo[0]['name'] = 'student';";
      echo "studentInfo[0]['email'] = 'student@mail';";
      echo "var gType = 'sb'";
    }
  ?>
    //var gType = "sb";
    //console.log(studentInfo);

    <?php 
      //echo 'var gStudentID = '.$_SESSION['member']['idx'].';';
      //echo 'var gUserName = "'.$_SESSION['member']['name'].'";';
    ?>

    var gStudentID = -1;

    $('#welcom').empty().text('Hi '+studentInfo[0]['name']+'，歡迎幫自己做個'+(gType=='sb'?'Snowboard(單板)':'Ski(雙板)')+'評量紀錄');

    const RATING_TYPES = {
      KNEW: 'knew',
      FAMILIAR: 'familiar',
      EXCELLENT: 'excellent'
    };

    var RATING_KNEW = RATING_TYPES.KNEW;
    var RATING_FAMILIAR = RATING_TYPES.FAMILIAR;
    var RATING_EXCELLENT = RATING_TYPES.EXCELLENT;

    var gSBratingRecords = {};
    var gSKIratingRecords = {};

    function setEvaluationTable()
    {
      loadAbilityList(gType, setAbilityList);
    }

    function setAbilityList()
    {
      loadSkiDiyMembersInfo(studentInfo, setStudentInfo);
    }

    function setStudentInfo(studentInfo)
    {
      for(key in studentInfo)
      {
        console.log('studentIdx = '+key);
        gStudentID = key;
      }
      loadSelfRatingRecords(gStudentID, setRatingRecords);
    }

    function setRatingRecords(records)
    {
      var rating = {};
      rating[RATING_KNEW] = [];
      rating[RATING_FAMILIAR] = [];
      rating[RATING_EXCELLENT] = [];

      $('textarea[name="comment"]').val("");

      for(key in records)
      {
        //if(records[key]['lessonIdx'] == $('#lessonIDSelect').val())
        //{
          rating[RATING_KNEW] = jQuery.parseJSON(records[key][RATING_KNEW]);
          rating[RATING_FAMILIAR] = jQuery.parseJSON(records[key][RATING_FAMILIAR]);
          rating[RATING_EXCELLENT] = jQuery.parseJSON(records[key][RATING_EXCELLENT]);

          if(gType == 'sb')
            $('textarea[name="comment"]').val(records[key]['commentSB']);
          else
            $('textarea[name="comment"]').val(records[key]['commentSKI']);
        //}
      }

      if(rating[RATING_KNEW] == null)
        rating[RATING_KNEW] = [];

      if(rating[RATING_FAMILIAR] == null)
        rating[RATING_FAMILIAR] = [];

      if(rating[RATING_EXCELLENT] == null)
        rating[RATING_EXCELLENT] = [];

      //console.log(rating);

      for(key in rating)
      {
        if(rating[key])
        {
          gSBratingRecords[key] = jQuery.grep(rating[key], function(value) {
              return parseInt(value) <= 160;
          });
          gSKIratingRecords[key] = jQuery.grep(rating[key], function(value) {
              return parseInt(value) >= 161;
          });
        }
        else
        {
          gSBratingRecords[key] = gSKIratingRecords[key] = [];
        }
      }
      console.log(gSBratingRecords);
      console.log(gSKIratingRecords);

      if(gType == 'sb')
        updateEvaluationTable(gSBratingRecords);
      else
        updateEvaluationTable(gSKIratingRecords);
    }

    $('#cover').show();
    loadEvaluationItems(gType, setEvaluationTable);


    function storeSelfRatingRecords(type, studentID, comment, records)
    {
      //console.log(records);
      $('#cover').show();
        $.ajax({
        url:"evaluationHandler.php",
        type:"POST",
        data:{func: "setSelfRatingRecord", type: type, studentID: studentID, comment: comment, records: records},
        dataType:"json",
        success: function(obj){
          $('#cover').hide();
          if(obj.indexOf("Error") >= 0)
          {
            alert(obj);
          }
          else if(obj == "success")
          {
            alert("評量紀錄儲存成功");
          }
        },
        complete: function(){ },
        error: function(xhr, status, error) { 
          console.error("AJAX error: " + status + ": " + error);
          alert("發生錯誤，請稍後再試。");
          $('#cover').hide();
        }
      });
    }
  </script>

  <script type="text/javascript">
    $('.styled').click(function(){
      var elementID = $(this)[0].id;

      if(elementID=='recordCase')
      {
        $('#cover').show();
        loadSelfRatingRecords(gStudentID, setRatingRecords);
      }
      else if(elementID=='noExpCase')
      {
        if(gType == 'sb')
          gSBratingRecords=jQuery.extend(true, {}, SB_HAS_NO_EXP);
        else
          gSKIratingRecords=jQuery.extend(true, {}, SKI_HAS_NO_EXP);

        $('textarea[name="comment"]').val("沒有嘗試過滑雪");
      }
      else if(elementID=='indoorCase')
      {
        if(gType == 'sb')
          gSBratingRecords=jQuery.extend(true, {}, SB_HAS_INDOOR_EXP);
        else
          gSKIratingRecords=jQuery.extend(true, {}, SKI_HAS_INDOOR_EXP);
        $('textarea[name="comment"]').val("有在室內滑雪場(機)練習過");
      }
      else if(elementID=='greenCase')
      {
        if(gType == 'sb')
          gSBratingRecords=jQuery.extend(true, {}, SB_HAS_GREEN_EXP);
        else
          gSKIratingRecords=jQuery.extend(true, {}, SKI_HAS_GREEN_EXP);
        $('textarea[name="comment"]').val("可以順利完成綠線轉彎");
      }
      else if(elementID=='redCase')
      {
        if(gType == 'sb')
          gSBratingRecords=jQuery.extend(true, {}, SB_HAS_RED_EXP);
        else
          gSKIratingRecords=jQuery.extend(true, {}, SKI_HAS_RED_EXP);
        $('textarea[name="comment"]').val("可以順利完成紅線轉彎");
      }
      else if(elementID=='blackCase')
      {
        if(gType == 'sb')
          gSBratingRecords=jQuery.extend(true, {}, SB_HAS_BLACK_EXP);
        else
          gSKIratingRecords=jQuery.extend(true, {}, SKI_HAS_BLACK_EXP);
        $('textarea[name="comment"]').val("可以順利完成黑線轉彎");
      }

      console.log(gSKIratingRecords);

      if(gType == 'sb')
        updateEvaluationTable(gSBratingRecords);
      else
        updateEvaluationTable(gSKIratingRecords);
    });

    $('button.storeRecords').click(function(){
      var combinedRatingRecords = {};
      combinedRatingRecords[RATING_KNEW] = [];
      combinedRatingRecords[RATING_FAMILIAR] = [];
      combinedRatingRecords[RATING_EXCELLENT] = [];

      for(key in combinedRatingRecords)
      {
        $.merge(combinedRatingRecords[key], gSBratingRecords[key]);
        $.merge(combinedRatingRecords[key], gSKIratingRecords[key]);
      }

      console.log(gSBratingRecords);
      console.log(gSKIratingRecords);
   
      console.log(gType, gStudentID, $('textarea[name="comment"]').val(), combinedRatingRecords);
      storeSelfRatingRecords(gType, gStudentID, $('textarea[name="comment"]').val(), combinedRatingRecords);
    });

  </script>
</body>
