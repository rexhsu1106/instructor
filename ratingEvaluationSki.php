<?php
	require('session.php');

	if($_SESSION['member']['type'] != "instructor")
		Header('Location: login.php');
?>

<!DOCTYPE html>
<html>
<head>
  <?php
    require('head.php');
	require('session.php');
  ?>
  <script src="loadDB.js?2" type="text/javascript"></script>
  <script src="common.js?1" type="text/javascript"></script>
</head>

<style type="text/css">
.rating-block .star.selfRating {
  cursor: inherit;
  stroke: #cc4b37;
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
	<?php //require('stickyShrinkNav.php'); ?>

	<div class="loading" id="cover" style="display: none;">
		<div class="row">
			<div class="small-12 text-center"><span><i class="fi-mobile-signal"></i> 連線中...</span></div>
		</div>
	</div>

	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
			<div class="row column small-12">
				<h4 id="welcom"></h4>
			</div>
		</div>
	</div>

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

	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
			<label><h6>課程</h6>
		</div>
	</div>

	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
			<select id="lessonIDSelect">
			</select>
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
			<label><h6>評語</h6>
			<textarea name="comment" disabled rows="2"></textarea>
			</label>
		</div>
	</div>
	
	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
			<p id="selfRatingInfo" style="color: green;"></p>
		</div>
	</div>

	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-8">
			<div class="card rating">
			</div>
		</div>
		<div class="column small-12 large-2 hide-for-small-only hide-for-medium-only" style="z-index: -1;">
			<div class="card selfRating">
			</div>
		</div>
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
			cardTitle.empty().text(EVALUATION_LEVELS_DESCRIPTION_SKI[level].substring(0, 4));
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
		$('#cover').show();

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
			cardTitle.empty().text(EVALUATION_LEVELS_DESCRIPTION_SKI[level]);
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

	var gType = "ski";
	var gStudentID = 0;
	var gLessonID = 0;
	var gStudentsInSelectedLesson = new Array();
	var gLessonsInSelectedOption = new Array();

	<?php 
      echo 'var gUserName = "'.$_SESSION['member']['name'].'";';
    ?>

    if(gUserName)
      $('#welcom').empty().text('Hi，'+gUserName+' 教練');
    else
      window.location.href = "login.php";

	var RATING_KNEW = 'knew';
	var RATING_FAMILIAR = 'familiar';
	var RATING_EXCELLENT = 'excellent';

	var gNewRatingRecords = {};
	var gPreRatingRec = {};

	function setEvaluationTable()
	{
		loadAbilityList(gType, setAbilityList);
	}

	function setAbilityList()
	{
		loadLessonInPeriod();
	}

	function loadLessonInPeriod()
	{
		var period = {start: $('#dateStart_order').val(), end: $('#dateEnd_order').val()};
		//console.log(period);
		if(gUserName)
		{
			$('#cover').show();
			loadLessonRecordsByInstructor(gType, period, gUserName, setLessonRecordOption);
		}
	}

	function setSelfRatingRecords(records)
	{
		var ratingRecords = new Array();
		ratingRecords[RATING_KNEW] = [];
		ratingRecords[RATING_FAMILIAR] = [];
		ratingRecords[RATING_EXCELLENT] = [];

		if(records && records.length > 0)
		{
			$('.card.rating').parent().removeClass('large-10').addClass('large-8');
			$('.card.selfRating').parent().show();

			for(key in records)
			{
				if(records[key]['studentIdx'] == $('#sutdentIDSelect').val())
				{
					ratingRecords[RATING_KNEW] = jQuery.parseJSON(records[key][RATING_KNEW]);
					ratingRecords[RATING_FAMILIAR] = jQuery.parseJSON(records[key][RATING_FAMILIAR]);
					ratingRecords[RATING_EXCELLENT] = jQuery.parseJSON(records[key][RATING_EXCELLENT]);
				}
				var date = records[key]['modifiedTime'].split(" ");
				$('#selfRatingInfo').text("學生自我評量建立時間 "+date[0]).show();
			}
			if(ratingRecords[RATING_KNEW] == null)
				ratingRecords[RATING_KNEW] = [];

			if(ratingRecords[RATING_FAMILIAR] == null)
				ratingRecords[RATING_FAMILIAR] = [];

			if(ratingRecords[RATING_EXCELLENT] == null)
				ratingRecords[RATING_EXCELLENT] = [];

			updateSelfEvaluationTable(ratingRecords);
		}
		else
		{
			$('.card.rating').parent().removeClass('large-8').addClass('large-10');
			$('.card.selfRating').parent().hide();

			$('#selfRatingInfo').text("").hide();
		}
	}

	function setRatingRecords(records, preLessonIdx)
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
			if(records[key]['lessonIdx'] == $('#lessonIDSelect').val())
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

		console.log(gPreRatingRec);
		console.log(gNewRatingRecords);

		updateEvaluationTable(gPreRatingRec);
	}

	function setStudentsInfo(info)
	{
		//var windowWidth = $(window).width();
		//if(windowWidth<1024)


		$('#sutdentIDSelect').empty();
		for(var i=0; i<gStudentsInSelectedLesson.length; i++)
		{
			$('#sutdentIDSelect').append('<option value="'+gStudentsInSelectedLesson[i]+'">'+gStudentsInSelectedLesson[i]+"，"+info[gStudentsInSelectedLesson[i]]['name']+"，"+info[gStudentsInSelectedLesson[i]]['email']+'</option>');
		}

		$('#sutdentIDSelect').off('change');
		$('#sutdentIDSelect').change(function(){
			$('#cover').show();
			//loadRatingRecordsForOneLesson(gType, $('#sutdentIDSelect').val(), $('#lessonIDSelect').val(), setRatingRecords);
			loadRatingRecords($('#sutdentIDSelect').val(), getAllLessonRecords);

			loadSelfRatingRecords($('#sutdentIDSelect').val(), setSelfRatingRecords);
			$('button.storeRecords').removeAttr('disabled');
			$('.sticky-social-bar').show();
			$('textarea[name="comment"]').removeAttr('disabled');
		});

		//loadRatingRecordsForOneLesson(gType, $('#sutdentIDSelect').val(), $('#lessonIDSelect').val(), setRatingRecords);
		loadRatingRecords($('#sutdentIDSelect').val(), getAllLessonRecords);


		loadSelfRatingRecords($('#sutdentIDSelect').val(), setSelfRatingRecords);
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
    	for(var i=0; i<lessonRecords.length; i++)
    	{
    		if(lessonRecords[i]['idx'] == $('#lessonIDSelect').val())
    		{
    			if(i>0)
    				preLessonIdx = lessonRecords[i-1]['idx'];
    			break;
    		}
    	}

    	console.log("pre lesson idx "+preLessonIdx);
    	setRatingRecords(gRatingRecords, preLessonIdx);
    }

	function setLessonInfo(records)
	{
		if(jQuery.isEmptyObject(records))
		{
			alert("沒有這堂課");
			$('#sutdentIDSelect').empty();
			$('#sutdentIDSelect').off('change');
			setRatingRecords({}, -1);
			setSelfRatingRecords({});
			$('#sutdentIDSelect').css("background-color","");
			$('button.storeRecords').attr('disabled', '');
			$('.sticky-social-bar').hide();
			$('textarea[name="comment"]').attr('disabled', '');
		}
		else
		{
			for(key in records)
			{
				if(records[key]['instructor'].toUpperCase() != gUserName.toUpperCase() )
				{
					alert("該課程屬於"+records[key]['instructor']+"教練");
					break;
				}
				gStudentsInSelectedLesson = jQuery.parseJSON(records[key]['students']);
			}

			loadMultiMembersBasicInfo(gStudentsInSelectedLesson, setStudentsInfo);
		}
	}

	function setLessonRecordOption(records)
	{
		if(jQuery.isEmptyObject(records))
		{
			//alert("沒有任何課程");
			$('#lessonIDSelect').empty();
			$('#lessonIDSelect').off('change');
			$('#sutdentIDSelect').empty();
			$('#sutdentIDSelect').off('change');
			setRatingRecords({}, -1);
			setSelfRatingRecords({});
			$('#sutdentIDSelect').css("background-color","");
			$('button.storeRecords').attr('disabled', '');
			$('.sticky-social-bar').hide();
			$('textarea[name="comment"]').attr('disabled', '');
		}
		else
		{
			$('#lessonIDSelect').empty();
			for(key in records)
			{
				if(records[key]['instructor'].toUpperCase() == gUserName.toUpperCase() )
				{
					gLessonsInSelectedOption.push(records[key]['lessonID']);

					$('#lessonIDSelect').append('<option value="'+records[key]['idx']+'">'+
						"課程編號: "+records[key]['lessonID']+"，雪場: "+records[key]['park']+
						"，課程時間: "+records[key]['startDate']+"～"+records[key]['endDate']+'</option>');
				}
			}

			setLessonInfo([records[0]]);

			$('#lessonIDSelect').off('change');
			$('#lessonIDSelect').change(function(){
				$('#cover').show();
				loadLessonRecordsByID(gType, $('#lessonIDSelect').val(), setLessonInfo);
			});
		}
	}

	function setDate(date, input)
    {
      var dd = date.getDate();
      var mm = date.getMonth()+1; //January is 0!
      var yyyy = date.getFullYear();
      if(dd<10){dd='0'+dd;}
      if(mm<10){mm='0'+mm;}

      if(input.attr('type') == "month" )
      {
        input.attr('value', yyyy+'-'+mm);
        input.val(yyyy+'-'+mm);
      }
      else
      {
        input.attr('value', yyyy+'-'+mm+'-'+dd);
        input.val(yyyy+'-'+mm+'-'+dd);
      }
    }
	
    var start_order = new Date();
    var end_order = new Date();
    end_order.setDate(start_order.getDate()+7);
    start_order.setDate(start_order.getDate()-7);

    setDate(start_order, $('#dateStart_order'));
    setDate(end_order, $('#dateEnd_order'));


    $('#cover').show();
	loadEvaluationItems(gType, setEvaluationTable);
</script>

<script type="text/javascript">

	$('.storeRecords').click(function(){
		console.log($('#sutdentIDSelect').val());
		if($('#sutdentIDSelect').val() && $('#sutdentIDSelect option').length <= 0)
			alert("沒有選取任何學生");
		else if($('#lessonIDSelect').val() && $('#lessonIDSelect option').length <= 0)
			alert("沒有選取任何課程");
		else
			storeRatingRecords(gType, $('#sutdentIDSelect').val(), $('#lessonIDSelect').val(), $('textarea[name="comment"]').val(), gUserName, gNewRatingRecords);
	});

	$('.button.lookupLesson').click(function(){
		$('#cover').show();
		console.log($('input[name="lessonID"]').val());
		if($('input[name="lessonID"]').val().length > 0)
			loadLessonRecordsByID(gType, $('input[name="lessonID"]').val(), setLessonInfo);
		else
		{
			$('#cover').hide();
			alert("請輸入課程ID");
		}
	});

	$('#dateStart_order').change(function(){
      if(isNaN(new Date($(this).val()/*+"T00:00:00"*/)))
      {
        alert("日期輸入錯誤");
      }
      else
      {
        var start = moment($(this).val()).toDate();
        //console.log(start);
        if(start.getHours()!=0)
        {
          console.log(start);
          alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
          window.location.href = 'index.php';
        }
        var end = moment($('#dateEnd_order').val()).toDate();
        if(end.getHours()!=0)
        {
          console.log(end);
          alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
          window.location.href = 'index.php';
        }

        //console.log(start.getTime(), end.getTime());
        if(end.getTime() < start.getTime())
        {
          setDate(start, $('#dateEnd_order'));
        }

        loadLessonInPeriod();
      }
    });

    $('#dateEnd_order').change(function(){

      if(isNaN(new Date($(this).val()/*+"T00:00:00"*/)))
      {
        alert("日期輸入錯誤");
      }
      else
      {
        var start = moment($('#dateStart_order').val()).toDate();
        if(start.getHours()!=0)
        {
          console.log(start);
          alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
          window.location.href = 'index.php';
        }
        var end = moment($(this).val()).toDate();
        if(end.getHours()!=0)
        {
          console.log(end);
          alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
          window.location.href = 'index.php';
        }

        //console.log(start.getTime(), end.getTime());
        if(end.getTime() < start.getTime())
        {
          setDate(end, $('#dateStart_order'));
        }

        loadLessonInPeriod();
      }
    });

    $( window ).resize(function() {
		rePositionSelfRating();
	});

</script>

</body>