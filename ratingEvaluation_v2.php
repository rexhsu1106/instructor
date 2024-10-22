<?php
	require('session.php');

	//if($_SESSION['member']['type'] != "instructor")
	//	Header('Location: login.php');
?>

<!DOCTYPE html>
<html>
<head>
  <?php
    require('head.php');
	require('session.php');
  ?>
  <script src="loadDB.js?1" type="text/javascript"></script>
  <script src="common.js?1" type="text/javascript"></script>
</head>

<style type="text/css">
.rating-block .star.selfRating {
  cursor: inherit;
  stroke: #cc4b37;
}

.rating-block .rating-block-rating.hasSelfRating .star polygon {
  stroke: blue;
  stroke-width: 3px;
}

.rating-block .rating-block-rating.hasSelfRating .star.hasSelfRating ~ .star polygon {
  stroke: #cc4b37;
  stroke-width: 1px;
}


.rating-block .rating-block-rating .star.selfRating.selected polygon {
  fill: blue;
}

.rating-block .rating-block-rating.is-voted .star.selfRating polygon {
  fill: blue;
}

.sticky-social-bar {
	top: 80%;
	border-radius: 5px;
}

.sticky-social-bar .social-icon {
	border-radius: 5px;
}
</style>
<body>
	<!-- <?php require('stickyShrinkNav.php'); ?> -->

	<div class="loading" id="cover" style="display: none;">
		<div class="row">
			<div class="small-12 text-center"><span><i class="fi-mobile-signal"></i> 連線中...</span></div>
		</div>
	</div>

	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
			<div class="row column small-12">
				<br>
				<h4 id="welcom"></h4>
			</div>
		</div>
	</div>
<!--
<div id="orderDiv">
  <div style="background-color: #d7ecfa;">
    <div style="max-width: 100%" class="row align-center">
      <div class="small-12 medium-6 large-5 columns">
        <note>起始日期</note>
        <input type="date" name="start" id="dateStart_order" placeholder="起始日期">
      </div>

      <div class="small-12 medium-6 large-5 columns">
        <note>結束日期</note>
        <input type="date" name="end" id="dateEnd_order" placeholder="結束日期">
      </div>
    </div>
  </div>
  <div class="row column small-12 medium-12 large-10 align-center">
    <p id="classInfomation" style="font-size: 20px; font-weight: bold; color:blue; margin: 0;"></p>
    <div id="orderContent">
    </div>
  </div>
</div>
-->

	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
			<label><h6>課程</h6>
		</div>
	</div>

	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
		<!--
			<select id="lessonIDSelect">
			</select>
		-->
			<textarea name="lessonInfo" disabled rows="3"></textarea>
			</label>
		</div>
 	</div>

	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
			<label><h6>學生</h6>
				<select id="sutdentIDSelect">
				</select>
			</label>
		</div>
 	</div>

 	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
			<label><h6>學生備註</h6>
			<textarea name="studentComment" disabled rows="4"></textarea>
			</label>
		</div>
	</div>

	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
			<label><h6>教練建議</h6>
			<textarea name="comment" disabled rows="4"></textarea>
			</label>
		</div>
	</div>
	
	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
			<p id="selfRatingInfo" style="color: green;"></p>
		</div>
	</div>

	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
			<div class="card rating">
			</div>
		</div>
		<!--
		<div class="column small-12 large-2 hide-for-small-only hide-for-medium-only" style="z-index: -1;">
			<div class="card selfRating">
			</div>
		</div>
		-->
	</div>

	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
			<button class="storeRecords button expanded" disabled>儲存評量結果</button>
		</div>
	</div>

	<!-- You can add more icons at http://fontawesome.io/icons/#brand -->
<ul class="sticky-social-bar" hidden>
  <li class="social-icon">
    <a> 
      <i class="fa fa-id-card-o" aria-hidden="true" style="background-color: blue;"></i>
      <span class="social-icon-text storeRecords">儲存評量結果</span>
    </a>
  </li>
</ul>



<script type="text/javascript">
	var ratingCardHTML = '<div class="card-section rating"> \
    <p class="ratings-card-header" style="color: red;"></p> \
  </div>';

	var ratingBlockHTML = '<div class="rating-block"> \
      <p class="ratings-type"></p> \
      <div class="rating-block-rating rating" data-rating> \
      </div> \
    </div>';

	var starHTML = '<div class="star"> \
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="37" viewBox="0 0 40 37"> \
            <polygon fill="none" points="272 30 260.244 36.18 262.489 23.09 252.979 13.82 266.122 11.91 272 0 277.878 11.91 291.021 13.82 281.511 23.09 283.756 36.18" transform="translate(-252)"/> \
          </svg> \
        </div>';

	var selfRatingCardHTML = '<div class="card-section selfRating"> \
	    <p class="ratings-card-header" style="color: red;"></p> \
	</div>';

    var selfRatingBlockHTML = '<div class="rating-block"> \
      <div class="rating-block-rating selfRating" data-rating> \
      </div> \
    </div>';

    var selfStarHTML = '<div class="star selfRating"> \
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="37" viewBox="0 0 40 37"> \
            <polygon fill="none" points="272 30 260.244 36.18 262.489 23.09 252.979 13.82 266.122 11.91 272 0 277.878 11.91 291.021 13.82 281.511 23.09 283.756 36.18" transform="translate(-252)"/> \
          </svg> \
        </div>';

    function updateSelfEvaluationTable(ratingRec) {
		var rating = $('.card.selfRating');
		rating.empty();

		var evaulationArray = getEvaluationTableArray(gEvaluationItems, MAX_EVALUATION_LEVEL, MAX_EVALUATION_ITEM_NUMBER);
		//console.log(evaulationArray);

		var abilityListByIdx = getAbilityListArrayByIdx(gAbilityList);

		for(var level=0; level<MAX_EVALUATION_LEVEL; level++)
		{
			rating.append(selfRatingCardHTML);
			var card = rating.find('.card-section').last();
			var cardTitle = card.find('p').last();
			//cardTitle.empty().text("等級-"+(level+1));
			cardTitle.empty().text(EVALUATION_LEVELS_DESCRIPTION_SB[level].substring(0, 4));
			for(var number=0; number<MAX_EVALUATION_ITEM_NUMBER; number++)
			{
				if(evaulationArray[level][number] > 0)
				{
					card.append(selfRatingBlockHTML);
					
					//var ratingType = card.find('p').last();
					//ratingType.text(abilityListByIdx[evaulationArray[level][number]]['item']);

					var block = card.find('.rating-block-rating').last();
					block.attr('abilityID', evaulationArray[level][number]);

					block.append(selfStarHTML);
					var star = block.find('.star').last();
					star.attr('grade', RATING_KNEW);
					if(jQuery.inArray(block.attr('abilityID'), ratingRec[RATING_KNEW]) >= 0)
					{
						star.siblings('.selected').removeClass('selected');
						star.addClass('selected');
						block.addClass('is-voted');
					}

					block.append(selfStarHTML);
					star = block.find('.star').last();
					star.attr('grade', RATING_FAMILIAR);
					if(jQuery.inArray(block.attr('abilityID'), ratingRec[RATING_FAMILIAR]) >= 0)
					{
						star.siblings('.selected').removeClass('selected');
						star.addClass('selected');
						block.addClass('is-voted');
					}

					block.append(selfStarHTML);
					star = block.find('.star').last();
					star.attr('grade', RATING_EXCELLENT);
					if(jQuery.inArray(block.attr('abilityID'), ratingRec[RATING_EXCELLENT]) >= 0)
					{
						star.siblings('.selected').removeClass('selected');
						star.addClass('selected');
						block.addClass('is-voted');
					}
				}
			}
		}

		rePositionSelfRating();
	}

	function rePositionSelfRating()
	{
		for(var i=0; i<$('.card-section.selfRating').length; i++)
		{
			var top = $('.card-section.rating:eq('+i+')').offset().top;
			var height = $('.card-section.rating:eq('+i+')').height();
			//console.log(top);
			$('.card-section.selfRating:eq('+i+')').offset({ top: top});
			$('.card-section.selfRating:eq('+i+')').height(height);
		}
		for(var i=0; i<$('.rating-block-rating.selfRating').length; i++)
		{
			var top = $('.rating-block-rating.rating:eq('+i+')').offset().top;
			//console.log(top);
			$('.rating-block-rating.selfRating:eq('+i+')').offset({ top: top});
		}
	}

	function updateEvaluationTable() {
		var windowWidth = $(window).width();
		//$('#cover').show();

		var evaulationArray = getEvaluationTableArray(gEvaluationItems, MAX_EVALUATION_LEVEL, MAX_EVALUATION_ITEM_NUMBER);
		//console.log(evaulationArray);

		var abilityListByIdx = getAbilityListArrayByIdx(gAbilityList);
		//console.log(abilityListByIdx);

		var rating = $('.card.rating');
		rating.empty();

		for(var level=0; level<MAX_EVALUATION_LEVEL; level++)
		{
			rating.append(ratingCardHTML);
			var card = rating.find('.card-section').last();
			var cardTitle = card.find('p').last();
			//cardTitle.empty().text("等級-"+(level+1));
			cardTitle.empty().text(EVALUATION_LEVELS_DESCRIPTION_SB[level]);
			for(var number=0; number<MAX_EVALUATION_ITEM_NUMBER; number++)
			{
				if(evaulationArray[level][number] > 0)
				{
					card.append(ratingBlockHTML);
					
					var ratingType = card.find('p').last();

					var position = abilityListByIdx[evaulationArray[level][number]]['item'].indexOf('(');
					if(position>0 && windowWidth<600)
						ratingType.text(abilityListByIdx[evaulationArray[level][number]]['item'].substring(0, position));
					else
						ratingType.text(abilityListByIdx[evaulationArray[level][number]]['item']);

					//ratingType.text(abilityListByIdx[evaulationArray[level][number]]['item']);

					var block = card.find('.rating-block-rating').last();
					block.attr('abilityID', evaulationArray[level][number]);

					block.append(starHTML);
					var star = block.find('.star').last();
					star.attr('grade', RATING_KNEW);
					if(jQuery.inArray(block.attr('abilityID'), gNewRatingRecords[RATING_KNEW]) >= 0)
					{
						star.siblings('.selected').removeClass('selected');
						star.addClass('selected');
						block.addClass('is-voted');
					}

					block.append(starHTML);
					star = block.find('.star').last();
					star.attr('grade', RATING_FAMILIAR);
					if(jQuery.inArray(block.attr('abilityID'), gNewRatingRecords[RATING_FAMILIAR]) >= 0)
					{
						star.siblings('.selected').removeClass('selected');
						star.addClass('selected');
						block.addClass('is-voted');
					}

					block.append(starHTML);
					star = block.find('.star').last();
					star.attr('grade', RATING_EXCELLENT);
					if(jQuery.inArray(block.attr('abilityID'), gNewRatingRecords[RATING_EXCELLENT]) >= 0)
					{
						star.siblings('.selected').removeClass('selected');
						star.addClass('selected');
						block.addClass('is-voted');
					}

					var starOBJs = block.find('.star');
					//console.log($(tmp[0]));
					if(jQuery.inArray(block.attr('abilityID'), gSelfRatingRec[RATING_KNEW]) >= 0)
					{
						block.addClass('hasSelfRating');
						$(starOBJs[0]).addClass('hasSelfRating');
					}

					if(jQuery.inArray(block.attr('abilityID'), gSelfRatingRec[RATING_FAMILIAR]) >= 0)
					{
						block.addClass('hasSelfRating');
						$(starOBJs[1]).addClass('hasSelfRating');
					}

					if(jQuery.inArray(block.attr('abilityID'), gSelfRatingRec[RATING_EXCELLENT]) >= 0)
					{
						block.addClass('hasSelfRating');
						$(starOBJs[2]).addClass('hasSelfRating');
					}
				}
			}
		}

		$('[data-rating] .star').off('click');

		$('[data-rating] .star').click(function() {
			
			var abilityID = $(this).parent().attr('abilityID');
			for(key in gNewRatingRecords)
			{
				console.log(key);
				if(gNewRatingRecords[key])
				{
					gNewRatingRecords[key] = jQuery.grep(gNewRatingRecords[key], function(value) {
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

				if(jQuery.inArray(abilityID, gNewRatingRecords[$(this).attr('grade')]) < 0)
				{
					gNewRatingRecords[$(this).attr('grade')].push(abilityID);
				}
			}

			//for(key in gNewRatingRecords)
			//	console.log(key+"--"+gNewRatingRecords[key]);
			console.log(gNewRatingRecords);
		});

		$('#cover').hide();
		$('button.storeRecords').removeAttr('disabled');
		$('.sticky-social-bar').show();
		$('textarea[name="comment"]').removeAttr('disabled');
	}

	function storeRatingRecords(type, studentID, lessonID, comment, instructor, records)
	{
		console.log(records);
		$('#cover').show();
			$.ajax({
			url:"evaluationHandler.php",
			type:"POST",
			data:{func: "setRatingRecord", type: type, studentID: studentID, lessonID: lessonID, comment: comment, instructor: instructor, records: records},
			dataType:"json",
			success: function(obj){
				$('#cover').hide();
				if(obj!="success")
					alert("無法更新評量表，請聯繫管理員。Error code: "+obj);
				else
				{
					alert("評量紀錄儲存成功");
					var diff = 0;
					for(key in gNewRatingRecords)
					{
						if( gNewRatingRecords[key].length != gPreRatingRec[key].length )
							diff = 1;
					}

					if(gNewRatingRecords[RATING_KNEW].length == 0 && gNewRatingRecords[RATING_FAMILIAR].length == 0 && gNewRatingRecords[RATING_EXCELLENT].length == 0)
						$('#sutdentIDSelect').css("background-color","khaki");
					else if(diff==0)
						$('#sutdentIDSelect').css("background-color","coral");
					else
						$('#sutdentIDSelect').css("background-color","");
				}
			},
			complete: function(){ },
			error: function(){ console.log("error"); $('#cover').hide();}
		});
	}
</script>

<script type="text/javascript">


<?php
	//echo $_GET['type'];
	$info = explode("@", $_GET['info']);

	$_ORDER_INDEX = 0;
	$_RESORT_INDEX = 1;
	$_INSTRUCTOR_INDEX = 2;
	$_CLASSTYPE_INDEX = 3;
	$_STARTDATE_INDEX = 4;
	$_ENDDATE_INDEX = 5;
	$_STUDENTNUM_INDEX = 6;
	$_FIRST_STUDENT_INDEX = 7;
	//var_dump($info);
//info=ORD1000@Naeba@James@SB@2019-01-24@2019-01-24@2@alex@a@mail@black@b@mail&token=81cfc2f548e3e3d82da5d08e9b154dd2
	//info[0] : orderNo
	//info[1] : resort
	//info[2] : instructor name
	//info[3] : class type
	//info[4] : start date
	//info[5] : end date
	//info[6] : numbers of students

	//info[7] : 1st student name
	//info[8] : 1st student email
	//info[9] : 2nd student name
	//info[10] : 2nd student email
	//.......

	//if(md5($info[$_ORDER_INDEX]) == 'ORD1000')
	if(md5('newdiyski'.$info[$_ORDER_INDEX]) == ($_GET['token']))
	{
		echo "var skidiyOrderNo = '".$info[$_ORDER_INDEX]."';";
		echo "var resort = '".$info[$_RESORT_INDEX]."';";
		echo "var instructor = '".$info[$_INSTRUCTOR_INDEX]."';";
		echo "var gType = '".strtolower($info[$_CLASSTYPE_INDEX])."';";
		echo "var startDate = '".$info[$_STARTDATE_INDEX]."';";
		echo "var endDate = '".$info[$_ENDDATE_INDEX]."';";
		echo "var studentNum = '".$info[$_STUDENTNUM_INDEX]."';";
		echo "var studentInfo = new Array();";
		for($i=0; $i<$info[$_STUDENTNUM_INDEX]; $i++)
		{
			echo "studentInfo[".$i."] = {};";
			echo "studentInfo[".$i."]['name'] = '".$info[$_FIRST_STUDENT_INDEX+($i*3)]."';";;
			echo "studentInfo[".$i."]['email'] = '".$info[$_FIRST_STUDENT_INDEX+($i*3)+1].'@'.$info[$_FIRST_STUDENT_INDEX+($i*3)+2]."';";;
		}
	}
	else
	{
		echo "var skidiyOrderNo = 'T100';";
		echo "resort = 'Teine';";
		echo "var instructor = 'Admin';";
		echo "var gType = 'sb';";
		//echo "var startDate = '".date("Y-m-d")."';";
		//echo "var endDate = '".date("Y-m-d")."';";
		echo "var startDate = '2023-10-20';";
		echo "var endDate = '2023-10-20';";
		echo "var studentInfo = new Array();";
		echo "var studentNum = 1;";
		echo "studentInfo[0] = {};";
		echo "studentInfo[0]['name'] = 'student';";
		echo "studentInfo[0]['email'] = 'student@mail';";;
	}
  ?>
  	console.log(gType);
  	//console.log(studentInfo);

  	$('textarea[name="lessonInfo"]').val((gType=='sb'?'Snowboard':'Ski')+' 課程，編號：'+skidiyOrderNo+'，雪場：'+resort+'，教練：'+instructor+'，課程日期：'+startDate+'～'+endDate);


	//var gType = "sb";
	//var gStudentID = 0;
	var gLessonIdx = 0;
	var gStudentsIdx = new Array();
	//var gStudentsInSelectedLesson = new Array();
	//var gLessonsInSelectedOption = new Array();

//	<?php 
//      echo 'var gUserName = "'.$_SESSION['member']['name'].'";';
//    ?>

//    if(gUserName)
      $('#welcom').empty().text('Hi，'+instructor+' 教練');
//    else
//      window.location.href = "login.php";

	var RATING_KNEW = 'knew';
	var RATING_FAMILIAR = 'familiar';
	var RATING_EXCELLENT = 'excellent';

	var gNewRatingRecords = {};
	var gPreRatingRec = {};
	var gSelfRatingRec = {};

	function setEvaluationTable()
	{
		loadAbilityList(gType, setAbilityList);
	}

	function setAbilityList()
	{
		loadSkiDiyMembersInfo(studentInfo, setLessonInfo);
	}

	function setLessonInfo(studentsInfo)
	{
		for(key in studentsInfo)
  		{
  			gStudentsIdx.push(key);
  		}

  		console.log(gStudentsIdx);
  		createNewLessonRecords(gType, skidiyOrderNo, resort, startDate, endDate, instructor, gStudentsIdx, setStudentsInfo);
	}

	function createNewLessonRecords(type, lessonNo, park, startDate, endDate, instructor, studentIDs, setStudentsInfoCB)
	{
		//$('#cover').show();
		$.ajax({
			url:"evaluationHandler.php",
			type:"POST",
			data:{func: "setLessonRecord", type: type, lessonNo: lessonNo, park: park, startDate: startDate, endDate: endDate, instructor: instructor, studentIDs: studentIDs},
			dataType:"json",
			success: function(obj){
				console.log(obj);
				//$('#cover').hide();
				if(obj.indexOf("Error") >= 0)
				{
					alert(obj);
				}
				else if(obj == "success" || obj == "add new")
				{
					if(obj=="add new")
						alert("新增課程成功");
					setStudentsInfoCB(gStudentsInfo);
				}
			},
			complete: function(){ },
			error: function(){ console.log("error"); $('#cover').hide();}
		});
	}

	function setSelfRatingRecords(records)
	{
		var ratingRecords = new Array();
		gSelfRatingRec[RATING_KNEW] = [];
		gSelfRatingRec[RATING_FAMILIAR] = [];
		gSelfRatingRec[RATING_EXCELLENT] = [];

		var hasSelfRating = true;

		if(records.length>1)
			alert("學生自我評量紀錄超過一份，請聯繫管理員");

		if(records && records.length > 0)
		{
			//$('.card.rating').parent().removeClass('large-10').addClass('large-8');
			//$('.card.selfRating').parent().show();

			for(key in records)
			{
				if(records[key]['studentIdx'] == $('#sutdentIDSelect').val())
				{
					gSelfRatingRec[RATING_KNEW] = jQuery.parseJSON(records[key][RATING_KNEW]);
					gSelfRatingRec[RATING_FAMILIAR] = jQuery.parseJSON(records[key][RATING_FAMILIAR]);
					gSelfRatingRec[RATING_EXCELLENT] = jQuery.parseJSON(records[key][RATING_EXCELLENT]);
				}
				//var date = records[key]['modifiedTime'].split(" ");
				//$('#selfRatingInfo').text("學生自我評量更新時間 "+date[0]).show().css("color", "green");
				if(gType == 'sb')
				{
					if(records[key]['updateDateSB'] != "")
						$('#selfRatingInfo').text("學生SB自我評量更新日期 "+records[key]['updateDateSB']).show().css("color", "green");
					else
					{
						hasSelfRating = false;
						$('#selfRatingInfo').text("學生尚未建立SB自我評量").show().css("color", "blue");
					}

					$('textarea[name="studentComment"]').text(records[key]['commentSB']);
				}
				else
				{
					if(records[key]['updateDateSKI'] != "")
						$('#selfRatingInfo').text("學生SKI自我評量更新日期 "+records[key]['updateDateSKI']).show().css("color", "green");
					else
					{
						hasSelfRating = false;
						$('#selfRatingInfo').text("學生尚未建立SKI自我評量").show().css("color", "blue");
					}

					$('textarea[name="studentComment"]').text(records[key]['commentSKI']);
				}
			}
			if(gSelfRatingRec[RATING_KNEW] == null)
				gSelfRatingRec[RATING_KNEW] = [];

			if(gSelfRatingRec[RATING_FAMILIAR] == null)
				gSelfRatingRec[RATING_FAMILIAR] = [];

			if(gSelfRatingRec[RATING_EXCELLENT] == null)
				gSelfRatingRec[RATING_EXCELLENT] = [];

			//updateSelfEvaluationTable(ratingRecords);
		}
		else
		{
			//$('.card.rating').parent().removeClass('large-8').addClass('large-10');
			//$('.card.selfRating').parent().hide();

			//$('#selfRatingInfo').text("").hide();
			if(gType == 'sb')
				$('#selfRatingInfo').text("學生尚未建立SB自我評量").show().css("color", "blue");
			else
				$('#selfRatingInfo').text("學生尚未建立SKI自我評量").show().css("color", "blue");
			$('textarea[name="studentComment"]').text("");
		}
		loadRatingRecords($('#sutdentIDSelect').val(), getAllLessonRecords);
		//$('#cover').hide();
	}

	function setRatingRecords(records, preLessonIdx, nowLessonIdx)
	{
		gPreRatingRec[RATING_KNEW] = [];
		gPreRatingRec[RATING_FAMILIAR] = [];
		gPreRatingRec[RATING_EXCELLENT] = [];

		gNewRatingRecords[RATING_KNEW] = [];
		gNewRatingRecords[RATING_FAMILIAR] = [];
		gNewRatingRecords[RATING_EXCELLENT] = [];

		$('textarea[name="comment"]').val("");

		var haveRecordForTheLesson = false;

		for(key in records)
		{
			if(records[key]['lessonIdx'] == nowLessonIdx)
			{
				haveRecordForTheLesson = true;

				gNewRatingRecords[RATING_KNEW] = jQuery.parseJSON(records[key][RATING_KNEW]);
				gNewRatingRecords[RATING_FAMILIAR] = jQuery.parseJSON(records[key][RATING_FAMILIAR]);
				gNewRatingRecords[RATING_EXCELLENT] = jQuery.parseJSON(records[key][RATING_EXCELLENT]);

				$('textarea[name="comment"]').val(records[key]['comment']);
			}
			else if(records[key]['lessonIdx'] == preLessonIdx)
			{
				gPreRatingRec[RATING_KNEW] = jQuery.parseJSON(records[key][RATING_KNEW]);
				gPreRatingRec[RATING_FAMILIAR] = jQuery.parseJSON(records[key][RATING_FAMILIAR]);
				gPreRatingRec[RATING_EXCELLENT] = jQuery.parseJSON(records[key][RATING_EXCELLENT]);
			}
		}

		for(key in gNewRatingRecords)
		{
			//console.log(key);
			if(gNewRatingRecords[key] == null)
				gNewRatingRecords[key] = [];
		}

		for(key in gPreRatingRec)
		{
			if(gPreRatingRec[key] == null)
				gPreRatingRec[key] = [];
		}

		var diff = 0;

		for(key in gNewRatingRecords)
		{
			if( gNewRatingRecords[key].length != gPreRatingRec[key].length )
				diff = 1;
		}

		if(!haveRecordForTheLesson)
			$('#sutdentIDSelect').css("background-color","lightcyan");
		else if(gNewRatingRecords[RATING_KNEW].length == 0 && gNewRatingRecords[RATING_FAMILIAR].length == 0 && gNewRatingRecords[RATING_EXCELLENT].length == 0)
			$('#sutdentIDSelect').css("background-color","khaki");
		else if(diff==0)
			$('#sutdentIDSelect').css("background-color","coral");
		else
			$('#sutdentIDSelect').css("background-color","");

		console.log("Rating of previous lesson");
		console.log(gPreRatingRec);
		console.log("Rating of this lesson");
		console.log(gNewRatingRecords);

		updateEvaluationTable();
	}

	function setStudentsInfo(info)
	{

		$('#sutdentIDSelect').empty();
		for(key in info)
  		{
  			$('#sutdentIDSelect').append('<option value="'+key+'">'+info[key]['name']+"，"+info[key]['email']+'</option>');
  		}

		$('#sutdentIDSelect').off('change');
		$('#sutdentIDSelect').change(function(){
			$('#cover').show();

			loadSelfRatingRecords($('#sutdentIDSelect').val(), setSelfRatingRecords);
			//loadRatingRecords($('#sutdentIDSelect').val(), getAllLessonRecords);

			$('button.storeRecords').removeAttr('disabled');
			$('.sticky-social-bar').show();
			$('textarea[name="comment"]').removeAttr('disabled');
		});

		loadSelfRatingRecords($('#sutdentIDSelect').val(), setSelfRatingRecords);
		//loadRatingRecords($('#sutdentIDSelect').val(), getAllLessonRecords);
	}

    function getAllLessonRecords(ratingRecords)
    {
    	var allLessonIDs = new Array();

    	for(key in ratingRecords)
    	{
    		allLessonIDs.push(ratingRecords[key]['lessonIdx']);
    	}

    	loadMultiLessonRecords(allLessonIDs, getNowAndPreviousRatingRecords);
    }

    function getNowAndPreviousRatingRecords(lessonRecords) {
    	
    	var preLessonIdx = -1;
    	var nowLessonIdx = -1;
    	gLessonIdx = -1;
    	for(var i=0; i<lessonRecords.length; i++)
    	{
    		if(lessonRecords[i]['lessonID'] == skidiyOrderNo)
    		{
    			gLessonIdx = nowLessonIdx = lessonRecords[i]['idx'];
    			if(i>0)
    				preLessonIdx = lessonRecords[i-1]['idx'];
    			break;
    		}
    	}

    	console.log("now lesson idx "+nowLessonIdx)
    	console.log("pre lesson idx "+preLessonIdx);

    	setRatingRecords(gRatingRecords, preLessonIdx, nowLessonIdx);
    	//loadSelfRatingRecords($('#sutdentIDSelect').val(), setSelfRatingRecords);
    }

    $('#cover').show();
	loadEvaluationItems(gType, setEvaluationTable);
</script>

<script type="text/javascript">

	$('.storeRecords').click(function(){
		console.log($('#sutdentIDSelect').val());
		if($('#sutdentIDSelect').val() && $('#sutdentIDSelect option').length <= 0)
			alert("沒有選取任何學生");
		else if(gLessonIdx <= 0)
			alert("課程IDX錯誤");
		else
			storeRatingRecords(gType, $('#sutdentIDSelect').val(), gLessonIdx, $('textarea[name="comment"]').val(), instructor, gNewRatingRecords);
	});

    $( window ).resize(function() {
		//rePositionSelfRating();
	});

</script>

</body>