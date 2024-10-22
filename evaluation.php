<?php
  require('session.php');
  
  //if($_SESSION['member']['type'] == "admin")
  //{
  //  Header('Location: manageEvaluation.php');
  //}
?>

<!DOCTYPE html>
<html>
<head>
  <?php
    require('head.php');
  ?>
  <script src="loadDB.js?1" type="text/javascript"></script>
  <script src="common.js?1" type="text/javascript"></script>
</head>

<style type="text/css">
.button{
  border-radius: 5px; 
}

.rating-block .star {
  cursor: default;
  /*stroke: #cc4b37;*/
  stroke: #FF0000;
}


.stats-list {
  list-style-type: none;
  clear: left;
  margin: 0;
  padding: 0;
  text-align: center;
  margin-bottom: 30px;
}

.stats-list .stats-list-positive {
  color: #3adb76;
}

.stats-list .stats-list-negative {
  color: #cc4b37;
}

.stats-list > li {
  display: inline-block;
  margin-right: 10px;
  padding-right: 10px;
  border-right: 1px solid #cacaca;
  text-align: center;
  font-size: 1.1em;
  font-weight: bold;
}

.stats-list > li:last-child {
  border: none;
  margin: 0;
  padding: 0;
}

.stats-list > li .stats-list-label {
  display: block;
  margin-top: 2px;
  font-size: 0.9em;
  font-weight: normal;
}

.timeline-icon.button{
  padding: 0;
  margin: 0;
  text-align: inherit;
}

.table-expand td{
  padding: 0 0 0 0.5rem;
}

.table-expand{
  margin-top: 2rem;
}
</style>

<body>

  <div class="loading" id="cover" style="display: none;">
    <div class="row">
      <div class="small-12 text-center"><span><i class="fi-mobile-signal"></i> 連線中...</span></div>
    </div>
  </div>

<?php //require('stickyShrinkNav.php'); ?>

  <div style="max-width: 100%" class="row align-center">
    <div class="column small-12 large-10">
      <br>
      <h4 id="welcom">這是你的評量表</h4>
      <p id="starStatistics" style="color: brown;"></p>
    </div>
  </div>

  <div style="max-width: 100%" class="row align-center">
    <div class="column small-12 large-10">
      <div class="rating-block" style="justify-content: flex-end;">
        <p class="ratings-type">知道怎麼做</p>
        <div class="rating-block-rating is-voted" data-rating>            
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
        <div class="rating-block-rating is-voted" data-rating>            
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
        <div class="rating-block-rating is-voted" data-rating>            
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
<!--
  <div style="max-width: 100%" class="row align-center">
    <div class="column small-12 large-10">
      <label><h6>課程紀錄</h6>
    </div>
  </div>

  <div style="max-width: 100%" class="row align-center">
    <div class="column small-12 large-10">
      <select id="lessonIDSelect">
      </select>
    </div>
  </div>
-->
<!--
  <div style="max-width: 100%" class="row align-center">
    <div class="column small-12 large-10">
      <label><h6>評語</h6>
      <textarea name="comment" disabled rows="2" style="background-color: white; color: black; font-weight: bold;"></textarea>
      </label>
    </div>
  </div>
-->
  <div style="max-width: 100%" class="row align-center">
    <div class="column small-12 large-10">
      <div class="timeline" style="background-color: midnightblue;">
      </div>
    </div>
  </div>

  <div style="max-width: 100%" class="row align-center" id="evaulationResultsDiv">
    <div class="column small-12 large-10">
      <div id="evaulationResults" style="background-color: white; padding: 0 0.5rem; position: relative; z-index: 9">
      </div>
    </div>
  </div>

  <script type="text/javascript">
    var timeLineHtml = '<div class="timeline-item" style="margin-bottom:20px">\
      <div class="timeline-icon button">\
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill-rule="evenodd" clip-rule="evenodd"><path d="M9 21h-9v-2h9v2zm6.695-2.88l-3.314-3.13-1.381 1.47 4.699 4.54 8.301-8.441-1.384-1.439-6.921 7zm-6.695-1.144h-9v-2h9v2zm8-3.976h-17v-2h17v2zm7-4h-24v-2h24v2zm0-4h-24v-2h24v2z"/></svg>\
      </div>\
      <div class="timeline-content button">\
        <p class="timeline-content-date"></p>\
        <div class="timeline-content-info"></div>\
      </div>\
    </div>';
    function setLessonRecord(records)
    {
      //console.log(gRatingRecords);
      $('div.timeline').empty();
      if(records.length == 0)
      {
        alert("尚未有評量紀錄");
        setRatingRecords({}, 0, 'sb');
      }
      else
      {
        var showOneEvaResult = false;
        for(var i=0; i<records.length; i++)
        {
          $('div.timeline').append(timeLineHtml);
          var timeItem = $('div.timeline').find('.timeline-item').last();
          timeItem.attr("lessonIDx", records[i]['idx']);
          timeItem.attr("lessonType", records[i]['type']);

          var timeIcon = $('div.timeline').find('.timeline-icon').last();
          var timeContent = timeItem.find('.timeline-content').last();
          var date = timeContent.find('.timeline-content-date').last();
          var info = timeContent.find('.timeline-content-info').last();
          if(records[i]['type']=='sb' || records[i]['type']=='SB')
            info.append('<p></p>').find('p').last().text('Snowboard');
          else
            info.append('<p></p>').find('p').last().text('ski');
          date.text(records[i]['startDate']);
          info.append('<p></p>').find('p').last().text('雪場: '+records[i]['park']);
          info.append('<p></p>').find('p').last().text('教練: '+records[i]['instructor']);

          if(i%2 == 1)
            timeContent.addClass("right");

          //原本是顯示最後一筆，現在是顯示參數中帶的訂單那一筆
          if(records[i]['lessonNo'] == skidiyOrderNo)
          {
            setRatingRecords(gRatingRecords, records[i]['idx'], records[i]['type']);
            timeItem.after($('#evaulationResults')).css("margin-bottom", "0");
            $('#evaulationResults').css("margin-bottom", "20px");
            showOneEvaResult = true;
          }

          //if(i==records.length-1)
          //  setRatingRecords(gRatingRecords, records[i]['idx']);
        }

        if(showOneEvaResult==false)
        {
          alert("抱歉，尚未完成該課程的教學評量");
          $('#cover').hide();
        }

        //$('div.timeline').find('.timeline-item').last().after($('#evaulationResults')).css("margin-bottom", "0");
      }

      $('.timeline-item').off('change');
      $('.timeline-item').click(function(){

        if($(this).next().find('.table-expand').length > 0)
        {
          if($('#evaulationResults').is(":visible"))
          {
            $('#evaulationResults').hide();
            $(this).css("margin-bottom", "20px");
          }
          else
          {
            $('#evaulationResults').show();
            $(this).css("margin-bottom", "0");
          }
          //console.log("true");
        }
        else
        {
          var lessonIDx = $(this).attr("lessonIDx");
          var lessonType = $(this).attr("lessonType");
          $('#cover').show();
          setTimeout(function(){
            setRatingRecords(gRatingRecords, lessonIDx, lessonType);
          }, 300);
          $(this).after($('#evaulationResults'));
          $('#evaulationResults').show();
          $(this).css("margin-bottom", "0");
          $(this).siblings().css("margin-bottom", "20px");
        }
      });
    }
  </script>

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
      </tr> \
      <tr class="table-expand-row-content"> \
        <td colspan="8" class="table-expand-row-nested"> \
          <p style="margin: 0.5rem 0;"></p> \
        </td> \
      </tr>';
    var starHTML = '<div class="star"> \
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="37" viewBox="0 0 40 37"> \
            <polygon fill="none" points="272 30 260.244 36.18 262.489 23.09 252.979 13.82 266.122 11.91 272 0 277.878 11.91 291.021 13.82 281.511 23.09 283.756 36.18" transform="translate(-252)"/> \
          </svg> \
        </div>';

    function updateEvaluationTable(comment, lessonType) {
      console.log(lessonType);
      if(lessonType == 'sb' || lessonType == 'SB')
      {
        gAbilityList = gAbilityList_SB;
        gEvaluationItems = gEvaluationItems_SB;
      }
      else
      {
        gAbilityList = gAbilityList_SKI;
        gEvaluationItems = gEvaluationItems_SKI;
      }

      var windowWidth = $(window).width();
      $('#cover').show();
      
      var evaulationArray = getEvaluationTableArray(gEvaluationItems, MAX_EVALUATION_LEVEL, MAX_EVALUATION_ITEM_NUMBER);
      //console.log(evaulationArray);

      var abilityListByIdx = getAbilityListArrayByIdx(gAbilityList);
      //console.log(abilityListByIdx);

      var eva = $('#evaulationResults');
      eva.empty();

      //eva.append('<label style="margin: 0 0 2rem 0; padding-top: 1rem;"><h6>評語</h6><textarea name="comment" disabled rows="2" style="background-color: white; color: black; font-weight: bold;"></textarea></label>');

      //$('textarea[name="comment"]').val(comment);

      eva.append('<label style="margin: 0 0 2rem 0; padding-top: 1rem;"><h5>評語</h5><p style="font-weight: bold;"></p>'+comment+'</label>');

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
            if(jQuery.inArray(block.attr('abilityID'), gNewRatingRecords[RATING_KNEW]) >= 0)
            {
              star.siblings('.selected').removeClass('selected');
              star.addClass('selected');
              block.addClass('is-voted');
            }

            block.append(starHTML);
            star = block.find('.star').last();
            star.attr('grade', RATING_FAMILIAR);
            totalStar++;
            if(jQuery.inArray(block.attr('abilityID'), gNewRatingRecords[RATING_FAMILIAR]) >= 0)
            {
              star.siblings('.selected').removeClass('selected');
              star.addClass('selected');
              block.addClass('is-voted');
            }

            block.append(starHTML);
            star = block.find('.star').last();
            star.attr('grade', RATING_EXCELLENT);
            totalStar++;
            if(jQuery.inArray(block.attr('abilityID'), gNewRatingRecords[RATING_EXCELLENT]) >= 0)
            {
              star.siblings('.selected').removeClass('selected');
              star.addClass('selected');
              block.addClass('is-voted');
            }

            if(jQuery.inArray(block.attr('abilityID'), gNewRatingRecords[RATING_KNEW]) >= 0)
              markedStar = markedStar+1;
            else if(jQuery.inArray(block.attr('abilityID'), gNewRatingRecords[RATING_FAMILIAR]) >= 0)
              markedStar = markedStar+2;
            else if(jQuery.inArray(block.attr('abilityID'), gNewRatingRecords[RATING_EXCELLENT]) >= 0)
              markedStar = markedStar+3;
          }
        }
      }

      console.log("收集"+markedStar+"／"+totalStar+"顆星，達成率"+ (markedStar*100/totalStar).toFixed(2)+"%");
      $('#starStatistics').text("收集"+markedStar+"／"+totalStar+"顆星，達成率"+ (markedStar*100/totalStar).toFixed(2)+"%");

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

    $_ORDER_INDEX = 0;
    $_NAME_INDEX = 1;
    $_EMAIL_USER_INDEX = 2;
    $_EMAIL_DOMAIN_INDEX = 3;
    //var_dump($info);
    //info=ORD1000@Naeba@James@SB@2019-01-24@2019-01-24@2@alex@a@mail@black@b@mail&token=81cfc2f548e3e3d82da5d08e9b154dd2
    //info=S01000@alex@a@mail@&token=116f96d8184eebdde08bb4cbbcff1d52
    //info[0] : orderNo
    //info[1] : student name
    //info[2] : eamil address(user name)
    //info[3] : eamil address(domain)

    //if(md5($info[$_ORDER_INDEX]) == 'ORD1000')
    if(md5('newdiyski'.$info[$_ORDER_INDEX]) == ($_GET['token']))
    {
      echo "var skidiyOrderNo = '".$info[$_ORDER_INDEX]."';";
      echo "var studentInfo = new Array();";
      echo "studentInfo[0] = {};";
      echo "studentInfo[0]['name'] = '".$info[$_NAME_INDEX]."';";
      echo "studentInfo[0]['email'] = '".$info[$_EMAIL_USER_INDEX].'@'.$info[$_EMAIL_DOMAIN_INDEX]."';";
    }
    else
    {
      echo "var skidiyOrderNo = 'T100';";
      echo "var studentInfo = new Array();";
      echo "studentInfo[0] = {};";
      echo "studentInfo[0]['name'] = 'student';";
      echo "studentInfo[0]['email'] = 'student@mail';";
    }
  ?>
    var gStudentID = -1;
    var gAbilityList_SB = null;
    var gEvaluationItems_SB = null;
    var gAbilityList_SKI = null;
    var gEvaluationItems_SKI = null;

    <?php 
      //echo 'var gStudentID = '.$_SESSION['member']['idx'].';';
      //echo 'var gUserName = "'.$_SESSION['member']['name'].'";';
    ?>
    //var gStudentID = 3;

    //if(gUserName)
    $('#welcom').empty().text('Hi '+studentInfo[0]['name']+'，這是你的評量表');
    //else
    //  window.location.href = "login.php";

    var RATING_KNEW = 'knew';
    var RATING_FAMILIAR = 'familiar';
    var RATING_EXCELLENT = 'excellent';

    var gNewRatingRecords = {};

    $('#cover').show();
    loadEvaluationItems('sb', setEvaluationTable_SB);

    function setEvaluationTable_SB()
    {
      gEvaluationItems_SB = gEvaluationItems;
      loadAbilityList('sb', setAbilityList_SB);
    }

    function setAbilityList_SB()
    {
      gAbilityList_SB = gAbilityList;
      loadEvaluationItems('ski', setEvaluationTable_SKI);
    }

    function setEvaluationTable_SKI()
    {
      gEvaluationItems_SKI = gEvaluationItems;
      loadAbilityList('ski', setAbilityList_SKI);
    }

    function setAbilityList_SKI()
    {
      gAbilityList_SKI = gAbilityList;
      loadSkiDiyMembersInfo(studentInfo, setStudentInfo);
    }

    function setStudentInfo(studentInfo)
    {
      for(key in studentInfo)
      {
        console.log('studentIdx = '+key);
        gStudentID = key;
      }
      loadRatingRecords(gStudentID, getAllLessonRecords);
    }

    function getAllLessonRecords(ratingRecords)
    {
      var allLessonIDs = new Array();

      for(key in ratingRecords)
      {
        allLessonIDs.push(ratingRecords[key]['lessonIdx']);
      }

      loadMultiLessonRecords(allLessonIDs, setLessonRecord);
    }

    //function setRatingRecords(records)
    function setRatingRecords(records, lessonIDx, lessonType)
    {
      //console.log("lessonIDx = ", lessonIDx);
      gNewRatingRecords[RATING_KNEW] = [];
      gNewRatingRecords[RATING_FAMILIAR] = [];
      gNewRatingRecords[RATING_EXCELLENT] = [];

      var comment = "";

      //$('textarea[name="comment"]').val("");

      for(key in records)
      {
        //if(records[key]['lessonIdx'] == $('#lessonIDSelect').val())
        if(records[key]['lessonIdx'] == lessonIDx)
        {
          gNewRatingRecords[RATING_KNEW] = jQuery.parseJSON(records[key][RATING_KNEW]);
          gNewRatingRecords[RATING_FAMILIAR] = jQuery.parseJSON(records[key][RATING_FAMILIAR]);
          gNewRatingRecords[RATING_EXCELLENT] = jQuery.parseJSON(records[key][RATING_EXCELLENT]);

          comment = records[key]['comment'];

          //$('textarea[name="comment"]').val(records[key]['comment']);
        }
      }
/*
      if(gNewRatingRecords[RATING_KNEW] == null)
        gNewRatingRecords[RATING_KNEW] = [];

      if(gNewRatingRecords[RATING_FAMILIAR] == null)
        gNewRatingRecords[RATING_FAMILIAR] = [];

      if(gNewRatingRecords[RATING_EXCELLENT] == null)
        gNewRatingRecords[RATING_EXCELLENT] = [];
*/
      //console.log(gNewRatingRecords);

      updateEvaluationTable(comment, lessonType);
    }
  </script>

  <script type="text/javascript">

  </script>
</body>