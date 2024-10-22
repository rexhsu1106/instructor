<?php
  require('session.php');

  $_SESSION['history']['destination'] = 'cj_TourRecords.php';

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
  <script src="loadDB.js?1" type="text/javascript"></script>
  <script src="common.js?1" type="text/javascript"></script>
</head>

<style type="text/css">
.timeline-icon.button{
	padding: 0;
	margin: 0;
	text-align: inherit;
}
</style>

<body>

  <div class="loading" id="cover" style="display: none;">
    <div class="row">
      <div class="small-12 text-center"><span><i class="fi-mobile-signal"></i> 連線中...</span></div>
    </div>
  </div>

<?php require('stickyShrinkNav.php'); ?>

<div class="timeline" style="background-color: midnightblue;">
</div>

<script type="text/javascript">
	var gType = "sb";

	<?php 
    echo 'var gStudentID = '.$_SESSION['member']['idx'].';';
    echo 'var gUserName = "'.$_SESSION['member']['name'].'";';
  ?>

  function getAllLessonRecords(ratingRecords)
  {
    var allLessonIDs = new Array();

    for(key in ratingRecords)
    {
      allLessonIDs.push(ratingRecords[key]['lessonIdx']);
    }

    loadMultiLessonRecords(allLessonIDs, setLessonRecord);
  }

  var timeLineHtml = '<div class="timeline-item">\
	    <div class="timeline-icon button">\
	      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill-rule="evenodd" clip-rule="evenodd"><path d="M9 21h-9v-2h9v2zm6.695-2.88l-3.314-3.13-1.381 1.47 4.699 4.54 8.301-8.441-1.384-1.439-6.921 7zm-6.695-1.144h-9v-2h9v2zm8-3.976h-17v-2h17v2zm7-4h-24v-2h24v2zm0-4h-24v-2h24v2z"/></svg>\
	    </div>\
	    <div class="timeline-content button">\
	      <p class="timeline-content-date"></p>\
	      <div class="timeline-content-info"></div>\
	    </div>\
	  </div> <div style="background-color:white"><br><br></div>';
	function setLessonRecord(records)
	{
		$('div.timeline').empty();
		for(var i=0; i<records.length; i++)
		{
			$('div.timeline').append(timeLineHtml);
			var timeItem = $('div.timeline').find('.timeline-item').last();
			var timeIcon = $('div.timeline').find('.timeline-icon').last();
			var timeContent = timeItem.find('.timeline-content').last();
			var date = timeContent.find('.timeline-content-date').last();
			var info = timeContent.find('.timeline-content-info').last();
			date.text(records[i]['startDate']);
			info.append('<p></p>').find('p').last().text('雪場: '+records[i]['park']);
			info.append('<p></p>').find('p').last().text('教練: '+records[i]['instructor']);

			if(i%2 == 1)
				timeContent.addClass("right");

		}
	}

  loadRatingRecords(gStudentID, getAllLessonRecords);
</script>

</body>