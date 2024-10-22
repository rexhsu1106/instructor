<?php
	require('session.php');

	if($_SESSION['member']['type'] != "instructor")
		Header('Location: login.php');
?>

<style type="text/css">
#LessonInfoDiv .button {
	border-radius: 10px;
}
</style>

<!DOCTYPE html>
<html>
<head>
  <?php
    require('head.php');
	require('session.php');
  ?>
  <script src="loadDB.js?4" type="text/javascript"></script>
  <script src="common.js?4" type="text/javascript"></script>
</head>

<body>
	<?php require('stickyShrinkNav.php'); ?>

	<div class="loading" id="cover" style="display: none;">
		<div class="row">
			<div class="small-12 text-center"><span><i class="fi-mobile-signal"></i> 連線中...</span></div>
		</div>
	</div>

	<br>
	<br>

	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
			<div class="row column small-12">
				<h4 id="welcom"></h4>
			</div>
		</div>
	</div>


	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
			<select id="functionSelect">
				<option value="createNewLesson">新增課程(空白課程內容)</option>
				<option value="createNewLessonWithInfo">新增課程(保留查詢課程內容)</option>
				<option value="updateLessonInfo">修改課程內容</option>
				<option value="deleteLesson">刪除課程</option>
			</select>
		</div>
 	</div>

<div id="LookupDateDiv">
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
</div>
<br>
<div id="LessonInfoDiv" style="background-color: lightgoldenrodyellow;">
	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
			<label><h6>課程</h6></label>
		</div>
	</div>

	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
			<select id="lessonIDSelect">
			</select>
		</div>
 	</div>
 	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 medium-6 large-5">
			<label><h6>開始日期</h6>
				<input type="date" name="lessonStartDate">
			</label>
		</div>
		<div class="column small-12 medium-6 large-5">
			<label><h6>結束日期</h6>
				<input type="date" name="lessonEndDate">
			</label>
		</div>
 	</div>

 	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
			<label><h6>雪場</h6>
				<input type="text" name="lessonPark">
			</label>
		</div>
 	</div>

	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
			<label><h6>學生</h6>
			</label>
		</div>
		<div class="column small-9 large-8">
			<input type="text" name="studentAccount-1" class="student">
		</div>
		<div class="column small-3 large-2">
			<button class="button student expanded" name="student-1" disabled>新增</button>
		</div>
		<div class="column small-9 large-8">
			<input type="text" name="studentAccount-2" class="student">
		</div>
		<div class="column small-3 large-2">
			<button class="button student expanded" name="student-2" disabled>新增</button>
		</div>
		<div class="column small-9 large-8">
			<input type="text" name="studentAccount-3" class="student">
		</div>
		<div class="column small-3 large-2">
			<button class="button student expanded" name="student-3" disabled>新增</button>
		</div>
		<div class="column small-9 large-8">
			<input type="text" name="studentAccount-4" class="student">
		</div>
		<div class="column small-3 large-2">
			<button class="button student expanded" name="student-4" disabled>新增</button>
		</div>
		<div class="column small-9 large-8">
			<input type="text" name="studentAccount-5" class="student">
		</div>
		<div class="column small-3 large-2">
			<button class="button student expanded" name="student-5" disabled>新增</button>
		</div>
		<div class="column small-9 large-8">
			<input type="text" name="studentAccount-6" class="student">
		</div>
		<div class="column small-3 large-2">
			<button class="button student expanded" name="student-6" disabled>新增</button>
		</div>
		<div class="column small-9 large-8">
			<input type="text" name="studentAccount-7" class="student">
		</div>
		<div class="column small-3 large-2">
			<button class="button student expanded" name="student-7" disabled>新增</button>
		</div>
		<div class="column small-9 large-8">
			<input type="text" name="studentAccount-8" class="student">
		</div>
		<div class="column small-3 large-2">
			<button class="button student expanded" name="student-8" disabled>新增</button>
		</div>
 	</div>

	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
			<button class="functionBtn createNewLesson button expanded">新增課程</button>
		</div>
	</div>
	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
			<button class="functionBtn updateLessonInfo button expanded" disabled>儲存課程修改</button>
		</div>
	</div>
	<div style="max-width: 100%" class="row align-center">
		<div class="column small-12 large-10">
			<button class="functionBtn deleteLesson button expanded" disabled>刪除課程及相關資料</button>
		</div>
	</div>
</div>

<script type="text/javascript">

	var gType = "sb";
	var gStudentsInSelectedLesson = new Array();
	var gLessonsInSelectedOption = new Array();
	<?php 
		echo 'var gUserName = "'.$_SESSION['member']['name'].'";';
	?>

	if(gUserName)
		$('#welcom').empty().text('Hi，'+gUserName+' 教練');
	else
		window.location.href = "login.php";


	function setStudentsInfo(info)
	{
		for(var i=0; i<gStudentsInSelectedLesson.length; i++)
		{
			$('input[name="studentAccount-'+(i+1)+'"]').val(gStudentsInSelectedLesson[i]+"，"+info[gStudentsInSelectedLesson[i]]['name']+"，"+info[gStudentsInSelectedLesson[i]]['email']);
			$('input[name="studentAccount-'+(i+1)+'"]').attr("disabled", "").attr("studentID", gStudentsInSelectedLesson[i]).css("background-color", "");
			if($('#functionSelect').val()!="deleteLesson")
			{
				$('button[name="student-'+(i+1)+'"]').text("刪除").removeAttr('disabled').attr("studentID", gStudentsInSelectedLesson[i]);
				$('button[name="student-'+(i+1)+'"]').addClass("alert");
			}
		}

		$('#cover').hide();
	}

	function setLessonInfo(records)
	{
		$('#LessonInfoDiv input').val("").removeAttr("disabled").css("background-color", "");
		$('#LessonInfoDiv button[name]').removeClass("alert").text("新增").attr("disabled", "");

		if(jQuery.isEmptyObject(records))
		{
			alert("沒有這堂課");
			$('button.updateLessonInfo').attr('disabled', '');
			$('button.deleteLesson').attr('disabled', '');
			gStudentsInSelectedLesson = [];
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

				$('input[name="lessonStartDate"]').val(records[key]['startDate']).attr("disabled", "").css("background-color", "");
				$('input[name="lessonEndDate"]').val(records[key]['endDate']).attr("disabled", "").css("background-color", "");
				$('input[name="lessonPark"]').val(records[key]['park']);
			}

			$('button.updateLessonInfo').removeAttr('disabled');
			$('button.deleteLesson').removeAttr('disabled');

			loadMultiMembersBasicInfo(gStudentsInSelectedLesson, setStudentsInfo);
		}
	}

	function setLessonRecordOption(records)
	{
		$('#LessonInfoDiv input').val("").removeAttr("disabled").css("background-color", "");
		$('#LessonInfoDiv button[name]').removeClass("alert").text("新增").attr("disabled", "");

		if(jQuery.isEmptyObject(records))
		{
			//alert("沒有任何課程");
			$('#lessonIDSelect').empty();
			$('#lessonIDSelect').off('change');
			$('button.updateLessonInfo').attr('disabled', '');
			$('button.deleteLesson').attr('disabled', '');
			$('#LessonInfoDiv input').attr("disabled", "");
			$('#cover').hide();
			gStudentsInSelectedLesson = [];
		}
		else
		{
			$('#lessonIDSelect').empty();
			for(key in records)
			{
				if(records[key]['instructor'].toUpperCase() == gUserName.toUpperCase() )
				{
					gLessonsInSelectedOption.push(records[key]['lessonNo']);

					$('#lessonIDSelect').append('<option value="'+records[key]['idx']+'">'+
						"課程編號: "+records[key]['lessonNo']+"，雪場: "+records[key]['park']+
						"，課程時間: "+records[key]['startDate']+"～"+records[key]['endDate']+'</option>');
				}
			}

			loadLessonRecordsByID(gType, $('#lessonIDSelect').val(), setLessonInfo);

			//setLessonInfo([records[0]]);

			$('#lessonIDSelect').off('change');
			$('#lessonIDSelect').change(function(){
				$('#cover').show();
				loadLessonRecordsByID(gType, $('#lessonIDSelect').val(), setLessonInfo);
			});
		}
	}

	function loadLessonInPeriod()
	{
		var period = {start: $('#dateStart_order').val(), end: $('#dateEnd_order').val()};
		console.log(period);
		if(gUserName)
		{
			$('#cover').show();
			loadLessonRecordsByInstructor(gType, period, gUserName, setLessonRecordOption);
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

	function setForFunctionSelect(func)
	{
		$('button.functionBtn').hide();

		if(func=="createNewLesson" || func=="createNewLessonWithInfo")
		{
			$("#LookupDateDiv").hide();
			$('#lessonIDSelect').hide();
			$('button.createNewLesson').show();

			$('#LessonInfoDiv input[name="lessonStartDate"]').removeAttr("disabled").css("background-color", "");
			$('#LessonInfoDiv input[name="lessonEndDate"]').removeAttr("disabled").css("background-color", "");

			if(func=="createNewLesson")
			{
				gStudentsInSelectedLesson = [];
				$('#LessonInfoDiv input').val("").removeAttr("disabled").css("background-color", "");
				$('#LessonInfoDiv button[name]').removeClass("alert").text("新增").attr("disabled", "");
			}
		}
		else if(func=="updateLessonInfo")
		{
			$("#LookupDateDiv").show();
			$('#lessonIDSelect').show();
			$('button.updateLessonInfo').show();

			loadLessonInPeriod();
		}
		else if(func=="deleteLesson")
		{
			$("#LookupDateDiv").show();
			$('#lessonIDSelect').show();
			$('button.deleteLesson').show();

			loadLessonInPeriod();
		}
	}

	setForFunctionSelect($("#functionSelect").val());

	$("#functionSelect").change(function(){
		setForFunctionSelect($(this).val());
	});
	
</script>

<script type="text/javascript">

	function updateLessonRecords(type, lessonNo, park, startDate, endDate, instructor, studentIDs)
	{
		$('#cover').show();
		$.ajax({
			url:"evaluationHandler.php",
			type:"POST",
			data:{func: "setLessonRecord", type: type, lessonNo: lessonNo, park: park, startDate: startDate, endDate: endDate, instructor: instructor, studentIDs: studentIDs},
			dataType:"json",
			success: function(obj){
				console.log(obj);
				if(obj.indexOf("Error") >= 0)
				{
					$('#cover').hide();
					alert(obj);
					loadLessonRecordsByID(gType, $('#lessonIDSelect').val(), setLessonInfo);
				}
				else if(obj == "success")
				{
					alert("課程內容修改成功");
					loadLessonRecordsByID(gType, $('#lessonIDSelect').val(), setLessonInfo);
				}
			},
			complete: function(){ },
			error: function(){ console.log("error"); $('#cover').hide();}
		});
	}

	function createNewLessonRecords(type, lessonNo, park, startDate, endDate, instructor, studentIDs)
	{
		$('#cover').show();
		$.ajax({
			url:"evaluationHandler.php",
			type:"POST",
			data:{func: "setLessonRecord", type: type, lessonNo: -1, park: park, startDate: startDate, endDate: endDate, instructor: instructor, studentIDs: studentIDs},
			dataType:"json",
			success: function(obj){
				console.log(obj);
				$('#cover').hide();
				if(obj.indexOf("Error") >= 0)
				{
					alert(obj);
				}
				else if(obj == "success")
				{
					alert("新增課程成功");
				}
				setForFunctionSelect("createNewLesson");
			},
			complete: function(){ },
			error: function(){ console.log("error"); $('#cover').hide();}
		});
	}

	function deleteLessonRecords(type, lessonID)
	{
		$('#cover').show();
		$.ajax({
			url:"evaluationHandler.php",
			type:"POST",
			data:{func: "deleteLessonRecord", type: type, lessonID: lessonID},
			dataType:"json",
			success: function(obj){
				console.log(obj);
				$('#cover').hide();
				if(obj.indexOf("Error") >= 0)
				{
					alert(obj);
				}
				else if(obj == "success")
				{
					alert("刪除課程成功");
				}
				setForFunctionSelect("deleteLesson");
			},
			complete: function(){ },
			error: function(){ console.log("error"); $('#cover').hide();}
		});
	}

	function checkMemeberInfo(info)
	{
		if(info.indexOf("Error") >= 0)
		{
			alert(info);
		}
		else
		{
			if(jQuery.inArray(info[0]['idx'], gStudentsInSelectedLesson) > 0)
			{
				alert("已經有這位學生");
				gStudentInputObject.val("");

			}
			else if(gStudentInputObject)
			{
				gStudentInputObject.val(info[0]['idx']+"，"+info[0]['name']+"，"+info[0]['email']).attr("disabled", "").attr("studentID", info[0]['idx']);
				gStudentInputObject.closest('div').next().find('button').text("刪除").removeAttr("disabled").addClass('alert').attr("studentID", info[0]['idx']);
				gStudentsInSelectedLesson.push(info[0]['idx']);

				console.log(gStudentsInSelectedLesson);
			}
		}

		$('#cover').hide();
	}

	var gStudentInputObject = null;

	$('input[name="lessonPark"]').change(function(){
		//console.log(gLessonRecordByID);
		if($('#functionSelect').val()=="createNewLesson")
		{
			//$(this).css("background-color", "pink");
		}
		else if($('#functionSelect').val()=="updateLessonInfo")
		{
			if($(this).val() != gLessonRecordByID[0]['park'])
				$(this).css("background-color", "pink");
			else
				$(this).css("background-color", "");
		}
	});

	$('input[name="lessonStartDate"]').change(function(){
		if(isNaN(new Date($(this).val()/*+"T00:00:00"*/)))
		{
			alert("日期輸入錯誤");
		}
		else
		{
			var start = moment($(this).val()).toDate();

			if(isNaN(new Date($('input[name="lessonEndDate"]').val())))
				setDate(start, $('input[name="lessonEndDate"]'));

			var end = moment($('input[name="lessonEndDate"]').val()).toDate();

			console.log(start, end);
			if(end.getTime() < start.getTime())
			{
				setDate(start, $('input[name="lessonEndDate"]'));
				//alert("開始日期在結束日期之後，調整結束日期");
			}
			//$(this).css("background-color", "pink");
		}
	});

	$('input[name="lessonEndDate"]').change(function(){
		if(isNaN(new Date($(this).val()/*+"T00:00:00"*/)))
		{
			alert("日期輸入錯誤");
		}
		else
		{
			var end = moment($(this).val()).toDate();

			if(isNaN(new Date($('input[name="lessonStartDate"]').val())))
				setDate(end, $('input[name="lessonStartDate"]'));

			var start = moment($('input[name="lessonStartDate"]').val()).toDate();
			
			if(end.getTime() < start.getTime())
			{
				setDate(start, $(this));
				alert("結束日期在開始日期之前，調整結束日期");
			}
			//$(this).css("background-color", "pink");
		}
	});

	$('input.student').change(function(){
		console.log($(this).val());
		if(jQuery.inArray("@", $(this).val()) > 0)
		{
			$('#cover').show();
			loadMembersInfoByEmail($(this).val(), checkMemeberInfo);
			gStudentInputObject = $(this);
		}
		else if($(this).val()!="")
			alert("email格式錯誤");
	});

	$('button.student').click(function(){

		var studentID = $(this).attr("studentID");

		gStudentsInSelectedLesson = jQuery.grep(gStudentsInSelectedLesson, function(value) {
			return value != studentID;
		});

		console.log(gStudentsInSelectedLesson);

		$(this).closest('div').prev().find('input').val("").removeAttr("disabled").removeAttr("studentID");
		$(this).attr("disabled", "").removeClass("alert").text("新增").removeAttr("studentID");
	});

	$('button.updateLessonInfo').click(function(){

		updateLessonRecords(gType, $('#lessonIDSelect').val(), $('input[name="lessonPark"]').val(), $('input[name="lessonStartDate"]').val(), $('input[name="lessonEndDate"]').val(), gUserName,gStudentsInSelectedLesson);
	});

	$('button.createNewLesson').click(function(){

		if(isNaN(new Date($('input[name="lessonStartDate"]').val())))
			alert("需要開始日期");
		else if(isNaN(new Date($('input[name="lessonEndDate"]').val())))
			alert("需要結束日期");
		else if($('input[name="lessonPark"]').val()=="")
			alert("需要雪場名稱");
		else if(gStudentsInSelectedLesson.length == 0)
			alert("需要學生資訊");
		else
		{
			console.log(gType, -1, $('input[name="lessonPark"]').val(), $('input[name="lessonStartDate"]').val(), $('input[name="lessonEndDate"]').val(), gUserName, gStudentsInSelectedLesson);
			createNewLessonRecords(gType, -1, $('input[name="lessonPark"]').val(), $('input[name="lessonStartDate"]').val(), $('input[name="lessonEndDate"]').val(), gUserName, gStudentsInSelectedLesson);
		}
	});

	$('button.deleteLesson').click(function(){
		if($('#lessonIDSelect').val())
		{
			deleteLessonRecords(gType, $('#lessonIDSelect').val());
		}
		else
			alert("沒有任何選取的課程");
	});

	$('#dateStart_order').change(function(){
		if(isNaN(new Date($(this).val()/*+"T00:00:00"*/)))
		{
			alert("日期輸入錯誤");
		}
		else
		{
			var start = moment($(this).val()).toDate();

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

			if(end.getTime() < start.getTime())
			{
				setDate(end, $('#dateStart_order'));
			}

			loadLessonInPeriod();
		}
	});
</script>
</body>