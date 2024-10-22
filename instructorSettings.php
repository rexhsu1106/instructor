<?php
	require('session.php');

	$_SESSION['history']['destination'] = 'teachingRecord.php';

	if($_SESSION['member']['type'] != "instructor" && $_SESSION['member']['type'] != "admin")
		Header('Location: login.php');
?>

<!DOCTYPE html>
<html>
<head>
	<?php
		require('head.php');
	?>
	<script src="loadTeachingInfo.js?1" type="text/javascript"></script>
	<script src="common.js?4" type="text/javascript"></script>
</head>

<style type="text/css">
optgroup[label="紅線"]
{
	color: red;
}
.sticky-social-bar {
	top: 70%;
	border-radius: 5px;
}

.sticky-social-bar .social-icon {
	border-radius: 5px;
}

.sticky-social-bar {
  padding: 0;
  margin: 0;
  top: 95%;
  -webkit-transform: translateY(-50%);
      -ms-transform: translateY(-50%);
          transform: translateY(-50%);
  width: 5.45rem;
  background-color: #333333;
  position: fixed;
  left: 0rem;
}

.sticky-social-bar .social-icon:hover {
  -webkit-transform: translateX(0rem);
      -ms-transform: translateX(0rem);
          transform: translateX(0rem);
}

.sticky-social-bar .social-icon > a > .social-icon-text {
  font-size: 100%;
  color: #fefefe;
  text-transform: uppercase;
  margin-right: 0.5rem;

}
</style>

<body>
	
	<div class="loading" id="cover" style="display: none;">
		<div class="row">
			<div class="small-12 text-center"><span><i class="fi-mobile-signal"></i> 連線中...</span></div>
		</div>
	</div>

<div style="background-color: bisque; margin-bottom: 60px;">
	<div class="row">
		<div class="column small-12 medium-6 large-4" style="background-color: bisque; padding-top: 10px;">
			<label><h6>日期</h6>
				<input type="date" id="eventDate">
			</label>
		</div>
 	</div>

	<div class="row">
	 	<div class="column small-12 medium-6 large-6" style="background-color: bisque; padding-top: 10px;">
			<label><h6>雪場</h6>
				<select id="resortSelect">
				</select>
			</label>
	 	</div>
	 	<div class="column small-12 medium-6 large-6" style="background-color: bisque; padding-top: 10px;">
			<label><h6>雪道</h6>
				<select id="courseSelect">
				</select>
			</label>
	 	</div>
 	</div>

	<div class="row">
		<div class="column small-12 medium-6 large-6" style="background-color: bisque; padding-top: 10px;">
			<label><h6>學生問題</h6>
				<select id="analysisSelect">
				</select>
			</label>
		</div>
		<div class="column small-12 medium-6 large-6" style="background-color: bisque; padding-top: 10px;">
			<label style="color: red;"><h6>--自訂學生問題--</h6>
			<input type="text" name="analysis">
			</label>
		</div>
	</div>
	<div class="row">
		<div class="column small-12 medium-6 large-6" style="background-color: bisque; padding-top: 10px;">
			<label><h6>改進方式</h6>
				<select id="improvementSelect">
				</select>
			</label>
		</div>
		<div class="column small-12 medium-6 large-6" style="background-color: bisque; padding-top: 10px;">
			<label style="color: red;"><h6>--自訂改進方式--</h6>
				<input type="text" name="improvement">
			</label>
		</div>
	</div>

	<div class="row">
		<div class="column small-12" style="background-color: bisque; padding-top: 10px;">
			<label><h6>改進成果</h6>
				<textarea id="feedbackTA" rows="5"></textarea>
			</label>
		</div>
	</div>
<!--
 	<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
	</form>

	<form action="upload_file.php" method="post" enctype="multipart/form-data">
	<label for="file"><span>Filename:</span></label>
	<input type="file" name="file" id="file" /> 
	<br />
	<input type="submit" name="submit" value="Submit" />
-->
	</div>

	<ul class="sticky-social-bar">
		<li class="social-icon storeRecords" style="padding: 0.5rem;">
			<a> 
			<!--
				<i class="fa fa-id-card-o" aria-hidden="true" style="background-color: blue;"></i>
			-->
				<span class="social-icon-text storeRecords" style="margin: 0;">儲存紀錄</span>
			</a>
		</li>
	</ul>

<script type="text/javascript">
	var selectedResort = null;
	var selectedAnalysis = null;
	var selectedImprovement = null;

	function updateCourseList(list, resort)
	{
		$('#courseSelect').empty();

		if((list.length <= 0) || (resort == null))
			return;

		$('#courseSelect').empty();
		$('#courseSelect').append('<optgroup label="綠線" style="color:green;"></optgroup><optgroup label="紅線"></optgroup><optgroup label="黑線"></optgroup><optgroup label="雙黑線"></optgroup>');

		var courses = new Array();
		for(var i=0; i<list.length; i++)
		{
			if(resort == list[i]['name'] && list[i]['course']!="default")
			{
				if(jQuery.inArray(list[i]['course'], courses)<0)
				{
					courses.push(list[i]['course']);
					if(list[i]['level']=="綠")
					{
						$('#courseSelect optgroup[label="綠線"]').append('<option value="'+list[i]['course']+'">'+list[i]['course']+'</option>')
					}
					else if(list[i]['level']=="紅")
					{
						$('#courseSelect optgroup[label="紅線"]').append('<option value="'+list[i]['course']+'">'+list[i]['course']+'</option>')
					}
					else if(list[i]['level']=="黑")
					{
						$('#courseSelect optgroup[label="黑線"]').append('<option value="'+list[i]['course']+'">'+list[i]['course']+'</option>')
					}
					else if(list[i]['level']=="雙黑")
					{
						$('#courseSelect optgroup[label="雙黑"]').append('<option value="'+list[i]['course']+'">'+list[i]['course']+'</option>')
					}
				}
			}
		}

		for(var i=$('#courseSelect optgroup').length-1; i>=0; i--)
		{
			//console.log(i, $('#courseSelect optgroup:eq('+i+') option').length);
			if($('#courseSelect optgroup:eq('+i+') option').length==0)
			{
				$('#courseSelect optgroup:eq('+i+')').remove();
			}
		}
	}

	function updateResortCourseList(list)
	{
		if(list.length > 0)
		{
			//find resorts
			var resorts = new Array();
			for(var i=0; i<list.length; i++)
			{
				if(jQuery.inArray(list[i]['name'], resorts)<0)
				{
					resorts.push(list[i]['name']);
				}
			}

			$('#resortSelect').empty();
			for(var i=0; i<resorts.length; i++)
			{
				console.log(resorts[i]);
				$('#resortSelect').append('<option value="'+resorts[i]+'">'+resorts[i]+'</option>');
			}
			if(selectedResort != null)
				$('#resortSelect').val(selectedResort);
			else
				selectedResort = resorts[0];
		}

		updateCourseList(list, selectedResort);

		$('#resortSelect').off('change');
		$('#resortSelect').change(function(){
			updateCourseList(list, $('#resortSelect').val());
		});
	}

	function updateAnalysisList(list)
	{
		if(list.length > 0)
		{
			$('#analysisSelect').empty();
			//find resorts
			var category = new Array();
			for(var i=0; i<list.length; i++)
			{
				if(jQuery.inArray(list[i]['category'], category)<0)
				{
					category.push(list[i]['category']);
					$('#analysisSelect').append('<optgroup label="'+list[i]['category']+'"></optgroup>');
				}
				if(list[i]['analysis']!="default")
				{
					$('#analysisSelect optgroup[label="'+list[i]['category']+'"]').append('<option value="'+list[i]['analysis']+'">'+list[i]['analysis']+'</option>');
				}
			}

			if(selectedAnalysis != null)
				$('#analysisSelect').val(selectedAnalysis);
			else
				selectedAnalysis = category[0];
		}
		else
			$('#analysisSelect').empty();
	}

	function updateSkillList(list)
	{
		console.log(list);
		if(list.length > 0)
		{
			$('#improvementSelect').empty();
			//find resorts
			var skills = new Array();
			for(var i=0; i<list.length; i++)
			{
				if(jQuery.inArray(list[i]['skill'], skills)<0)
				{
					skills.push(list[i]['skill']);
					$('#improvementSelect').append('<optgroup label="'+list[i]['skill']+'"></optgroup>');
				}
				if(list[i]['tactic']!="default")
				{
					$('#improvementSelect optgroup[label="'+list[i]['skill']+'"]').append('<option value="'+list[i]['tactic']+'">'+list[i]['tactic']+'</option>');
				}
			}

			if(selectedImprovement != null)
				$('#improvementSelect').val(selectedImprovement);
			else
				selectedImprovement = skills[0];
		}
		else
			$('#improvementSelect').empty();
	}
</script>

<script type="text/javascript">

	$('#cover').show();
	var date = new Date();
	var dd = date.getDate();
	var mm = date.getMonth()+1; //January is 0!
	var yyyy = date.getFullYear();
	if(dd<10){dd='0'+dd;}
	if(mm<10){mm='0'+mm;}

	$('input[type="date"]').val(yyyy+'-'+mm+'-'+dd);

	loadResortList(null, setResort);
	function setResort(list)
	{
		updateResortCourseList(list);
		loadAnalysis(null, "sb", setAnalysis);
	}
	function setAnalysis(list)
	{
		if(list.indexOf("Error") >= 0)
		{
			//alert(list);
			list = [];
		}
		updateAnalysisList(list);
		loadSkillTactics(null, "sb", setSkill);
	}
	function setSkill(list)
	{
		if(list.indexOf("Error") >= 0)
		{
			//alert(list);
			list = [];
		}
		updateSkillList(list);
		$('#cover').hide();
	}
</script>

<script type="text/javascript">
	<?php 
      echo 'var gUserName = "'.$_SESSION['member']['name'].'";';
    ?>

	function storeTeachingRecord(orderIdx, date, resort, course, courseLevel, category, analysis, skill, tactic, feedback)
	{
		$('#cover').show();
		console.log(gUserName, orderIdx, date, resort, course, courseLevel, category, analysis, skill, tactic, feedback);
		var record = {instructor: gUserName, orderIdx: orderIdx, date: date, resort: resort, course: course, courseLevel: courseLevel, category: category, analysis: analysis, skill: skill, tactic: tactic, feedback: feedback, type: "sb"};
		$.ajax({
					url:"teachingRecordHandler.php",
					type:"POST",
					data:{func: "storeRecord", record},
					dataType:"json",
					success: function(obj){
						console.log(obj);
						$('#cover').hide();
						if(obj!="success")
							alert("無法儲存資料，"+obj);
						else
						{
						}
					},
					complete: function(){ },
					error: function(){ console.log("error"); $('#cover').hide();}
		});
	}

	$('.social-icon.storeRecords').click(function(){
		console.log("click");

		var date = $('#eventDate').val();
		var resort = $('#resortSelect').val();
		var course = $('#courseSelect').val();
		var courseLevel = $('#courseSelect :selected').parent().attr('label');

		if($('input[name="analysis"]').val()!="")
			var category = "自訂";
		else
			var category =  $('#analysisSelect :selected').parent().attr('label');
		
		if($('input[name="analysis"]').val()!="")
			var analysis =  $('input[name="analysis"]').val()
		else
			var analysis =  $('#analysisSelect').val();
		
		if($('input[name="improvement"]').val()!="")
			var skill = "自訂";
		else
			var skill = $('#improvementSelect :selected').parent().attr('label');
		if($('input[name="improvement"]').val()!="")
			var tactic =  $('input[name="improvement"]').val()
		else
			var tactic = $('#improvementSelect').val();

		var feedback = $('#feedbackTA').val();

		if(analysis==null || (!analysis.replace(/\s/g, '').length))
			alert("請選擇學生問題或是自行輸入");
		else if(tactic==null || (!tactic.replace(/\s/g, '').length))
			alert("請選擇改進方式或是自行輸入");
		else if(feedback=="" || (!feedback.replace(/\s/g, '').length))
			alert("請輸入改進成果");
		else
			storeTeachingRecord(null, date, resort, course, courseLevel, category, analysis, skill, tactic, feedback);
	});

	$('input[type="text"]').change(function(){
		if($(this).val().replace(/\s/g, '').length>0)
			$(this).css('background-color', 'lightpink');
		else
			$(this).css('background-color', 'white');
	});
</script>

</body>

