<?php
require('session.php');

if($_SESSION['member']['type'] != "admin" || ($_SESSION['member']['name']!='CJ admin' && $_SESSION['member']['name']!='tempAdmin'))
{
	Header('Location: login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
  <?php
    require('head.php');
  ?>
  <script src="loadDB.js?2" type="text/javascript"></script>
  <script src="common.js?1" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/md5.js"></script>
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
  			<p id="comment" hidden=>
  			</p>
  		</div>
  		<div class="column small-12 large-10">
			<label><h6>選單</h6>
				<select id="caseSelect">
					<optgroup label="自我評量">
						<option value="SelfEvaEmpty">尚未填寫自評學員</option>
						<option value="AllMemberSelfEva">所有學員自評狀態</option>
					</optgroup>
					<optgroup label="教練評量">
						<option value="EvaluationEmpty">尚未被評量的課程</option>
						<option value="AllEvaluation">所有課程</option>
					</optgroup>
					<optgroup label="系統錯誤偵查">
						<option value="MatchError">課程紀錄與評量表不符</option>
					</optgroup>
				</select>
			</label>
 		</div>
 		<!--
		<div class="column small-12 large-10">
			<label><h6>學員姓名</h6>
				<input type="text" name="sutdentName">
			</label>
		</div>
		<div class="column small-12 large-10">
			<label><h6>學員郵件信箱</h6>
				<input type="email" name="sutdentName">
			</label>
		</div>
		-->
		<div class="column small-12 large-10">
			<table>
				<thead>
				</thead>
				<tbody id="Tbody">
				</tbody>
			</table>
		</div>
 	</div>
 	<br>
 	<br>
 </body>

	

<script type="text/javascript">
	function updateNotSelfEvaList(list) {
		if(NotSelfEvaList==null)
		{
			NotSelfEvaList = list;
			console.log(list);
		}
		
		var table = $('#Tbody');
		table.empty();

		var row = table.append('<tr></tr>');
		tr = row.find('tr').last();

		tr.append('<td>No.</td>');
		tr.append('<td>姓名</td>');
		tr.append('<td>郵箱</td>');

		for(key in list)
		{
			var row = table.append('<tr></tr>');
			tr = row.find('tr').last();
			tr.append('<td>'+list[key]['idx']+'</td>');
			tr.append('<td>'+list[key]['name']+'</td>');
			tr.append('<td>'+'<a href="mailto:'+list[key]['email']+'">'+list[key]['email']+'</a>'+'</td>');
		}

		$('#cover').hide();
	}

	function updateAllSelfEvaStaus(list) {
		if(AllMemberSelfEvaStatus==null)
		{
			AllMemberSelfEvaStatus = list;
			//console.log(list);
		}
		
		var table = $('#Tbody');
		table.empty();

		var row = table.append('<tr></tr>');
		tr = row.find('tr').last();

		tr.append('<td>No.</td>');
		tr.append('<td>姓名</td>');
		tr.append('<td>郵箱</td>');
		tr.append('<td>自評</td>');
		tr.append('<td>季度</td>');

		var date_23_24 = "2024-05-01";

		for(key in list)
		{
			var row = table.append('<tr></tr>');
			tr = row.find('tr').last();
			tr.append('<td>'+list[key]['idx']+'</td>');
			tr.append('<td>'+list[key]['name']+'</td>');
			tr.append('<td>'+list[key]['email']+'</td>');

			if(list[key]['selfEvaUpdateTime']=="none")
				tr.append('<td style="font-weight: bold; color: red;">'+'未完成自評'+'</td>');
			else
				tr.append('<td>'+'已完成自評'+'</td>');

			if(list[key]['selfEvaUpdateTime']=="none")
				tr.append('<td>'+'none'+'</td>');
			else if(list[key]['selfEvaUpdateTime'].replace(/\-/g, '/') < date_23_24.replace(/\-/g, '/'))
				tr.append('<td>'+'23-24'+'</td>');
			else
				tr.append('<td>'+'24-25'+'</td>');
		}

		$('#cover').hide();
	}

	function updateNotBeEvaluated(list) {
		if(NotEvaluatedList==null)
		{
			NotEvaluatedList = list;
			console.log(list);
		}
		
		var table = $('#Tbody');
		table.empty();

		var row = table.append('<tr></tr>');
		tr = row.find('tr').last();

		tr.append('<td>No.</td>');
		tr.append('<td>姓名</td>');
		tr.append('<td>郵箱</td>');
		tr.append('<td>課程編號</td>');
		tr.append('<td>教練</td>');
		tr.append('<td>日期</td>');

		for(var i in list['pair'])
		{
			var lessonInPair = list['pair'][i][0];
			var studentInPair = list['pair'][i][1];
			var row = table.append('<tr></tr>');
			tr = row.find('tr').last();

			if(list['student'][studentInPair]!== undefined)
			{
				tr.append('<td>'+list['student'][studentInPair]['idx']+'</td>');
				tr.append('<td>'+list['student'][studentInPair]['name']+'</td>');
				tr.append('<td>'+list['student'][studentInPair]['email']+'</td>');
			}
			if(list['lesson'][lessonInPair]!== undefined)
			{
				tr.append('<td>'+list['lesson'][lessonInPair]['lessonNo']+'</td>');
				tr.append('<td>'+list['lesson'][lessonInPair]['instructor']+'</td>');
				//var end = new Date(list['lesson'][lessonInPair]['endDate']);
				var limit = new Date(list['lesson'][lessonInPair]['endDate']);
				limit.setDate(limit.getDate()+7);
				var today = new Date();
				if(today.getTime() <= limit.getTime())
				{
					tr.append('<td>'+list['lesson'][lessonInPair]['startDate']+'~'+list['lesson'][lessonInPair]['endDate']+'</td>');
				}
				else
				{
					tr.append('<td style="font-weight:bold; color: red;">'+list['lesson'][lessonInPair]['startDate']+'~'+list['lesson'][lessonInPair]['endDate']+'</td>');
				}
			}
		}

		$('#cover').hide();
	}

	function updateAllEvaluation(list) {
		if(AllEvaList==null)
		{
			AllEvaList = list;
			console.log(list);
		}
		
		var table = $('#Tbody');
		table.empty();

		var row = table.append('<tr></tr>');
		tr = row.find('tr').last();

		tr.append('<td>No.</td>');
		tr.append('<td>姓名</td>');
		tr.append('<td>郵箱</td>');
		tr.append('<td>課程編號</td>');
		tr.append('<td>教練</td>');
		tr.append('<td>日期</td>');
		tr.append('<td>更新</td>');

		for(var i in list['pair'])
		{
			var lessonInPair = list['pair'][i][0];
			var studentInPair = list['pair'][i][1];
			var updatedStatus = list['pair'][i][2];
			var row = table.append('<tr></tr>');
			tr = row.find('tr').last();

			if(list['student'][studentInPair]!== undefined)
			{
				tr.append('<td>'+list['student'][studentInPair]['idx']+'</td>');
				tr.append('<td>'+list['student'][studentInPair]['name']+'</td>');
				tr.append('<td>'+list['student'][studentInPair]['email']+'</td>');
			}
			else
			{
				tr.append('<td>'+ERROR+'</td>');
				tr.append('<td>'+ERROR+'</td>');
				tr.append('<td>'+ERROR+'</td>');
			}
			if(list['lesson'][lessonInPair]!== undefined)
			{
				tr.append('<td>'+list['lesson'][lessonInPair]['lessonNo']+'</td>');
				tr.append('<td>'+list['lesson'][lessonInPair]['instructor']+'</td>');
				//var end = new Date(list['lesson'][lessonInPair]['endDate']);
				var limit = new Date(list['lesson'][lessonInPair]['endDate']);
				limit.setDate(limit.getDate()+7);
				var today = new Date();
				if(today.getTime() <= limit.getTime())
				{
					tr.append('<td style="font-size: smaller;">'+list['lesson'][lessonInPair]['startDate']+'~'+list['lesson'][lessonInPair]['endDate']+'</td>');
				}
				else
				{
					tr.append('<td style="font-weight:bold; color: red; font-size: smaller;">'+list['lesson'][lessonInPair]['startDate']+'~'+list['lesson'][lessonInPair]['endDate']+'</td>');
				}
			}
			else
			{
				tr.append('<td>'+ERROR+'</td>');
				tr.append('<td>'+ERROR+'</td>');
				tr.append('<td>'+ERROR+'</td>');
			}

			if(updatedStatus)
				tr.append('<td><a href="'+'https://www.withcj.fun/instructor/ratingLookup.php?info='
					+list['lesson'][lessonInPair]['lessonNo']
					+'@'+list['lesson'][lessonInPair]['type']
					+'@'+list['student'][studentInPair]['name']
					+'@'+list['student'][studentInPair]['email']
					+'&token='+CryptoJS.MD5('newdiyski'+list['lesson'][lessonInPair]['lessonNo'])
					+'" target="_blank" style="font-weight:bold; color: red;">是</a></td>');
			else
				tr.append('<td>'+'尚未'+'</td>');
		}

		$('#cover').hide();
	}

	function updateEvaMatchErrList(list) {
		if(EvaMatchErrList==null)
		{
			EvaMatchErrList = list;
			console.log(list);
		}

		var table = $('#Tbody');
		table.empty();

		var row = table.append('<tr></tr>');
		tr = row.find('tr').last();

		tr.append('<td>No.</td>');
		tr.append('<td>編號</td>');
		tr.append('<td>教練</td>');
		tr.append('<td>學員</td>');
		tr.append('<td>學員郵箱</td>');

		for(var i in list['pair'])
		{
			var lessonInPair = list['pair'][i][0];
			var studentInPair = list['pair'][i][1];
			var row = table.append('<tr></tr>');
			tr = row.find('tr').last();

			tr.append('<td>'+list['lesson'][lessonInPair]['idx']+'</td>');
			tr.append('<td>'+list['lesson'][lessonInPair]['lessonNo']+'</td>');
			tr.append('<td>'+list['lesson'][lessonInPair]['instructor']+'</td>');

			if(list['student'][studentInPair]!== undefined)
			{
				tr.append('<td>'+list['student'][studentInPair]['name']+'</td>');
				tr.append('<td>'+list['student'][studentInPair]['email']+'</td>');
			}
			else
			{
				tr.append('<td>'+'沒有紀錄'+'</td>');
				tr.append('<td>'+'沒有紀錄'+'</td>');
			}
		}

		$('#cover').hide();
	}

</script>

<script type="text/javascript">

	$('#cover').show();

	var NotSelfEvaList = null;
	var AllMemberSelfEvaStatus = null;
	var NotEvaluatedList = null;
	var AllEvaList = null;
	var EvaMatchErrList = null;

	$('#caseSelect').val('SelfEvaEmpty');
	loadSkiDiyMembersNotSelfEva(updateNotSelfEvaList);

	//set default value for selected options
	
</script>

<script type="text/javascript">
	$('#caseSelect').change(function(){
		//just update table, "don't" need to reload daysPeriod, abilityList 
		if($(this).val() == 'SelfEvaEmpty')
		{
			$('#cover').show();
			if(NotSelfEvaList==null)
				loadSkiDiyMembersNotSelfEva(updateNotSelfEvaList);
			else
				updateNotSelfEvaList(NotSelfEvaList);
		}
		else if($(this).val() == 'AllMemberSelfEva')
		{
			$('#cover').show();
			if(AllMemberSelfEvaStatus==null)
				loadSkiDiyALLMembers(updateAllSelfEvaStaus);
			else
				updateAllSelfEvaStaus(AllMemberSelfEvaStatus);
		}
		else if($(this).val() == 'EvaluationEmpty')
		{
			$('#cover').show();
			if(NotEvaluatedList==null)
				loadSkiDiyInfoNotEvaluated(updateNotBeEvaluated);
			else
				updateNotBeEvaluated(NotEvaluatedList);
		}
		else if($(this).val() == 'AllEvaluation')
		{
			$('#cover').show();
			if(AllEvaList==null)
				loadSkiDiyAllEvaluationInfo(updateAllEvaluation);
			else
				updateAllEvaluation(AllEvaList);
		}
		else if($(this).val() == 'MatchError')
		{
			$('#cover').show();
			if(EvaMatchErrList==null)
				EvaluationLessonAndRecordMatchError(updateEvaMatchErrList);
			else
				updateEvaMatchErrList(EvaMatchErrList);
		}
	});
</script>

</body>