<?php
require('session.php');

if($_SESSION['member']['type'] != "admin" || ($_SESSION['member']['name']!='CJ admin' && $_SESSION['member']['name']!='tempAdmin'))
{
	Header('Location: login.php');
}
?>

<style type="text/css">
.table-container {
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}

.responsive-table {
  width: 100%;
  border-collapse: collapse;
}

.responsive-table th,
.responsive-table td {
  padding: 1px;
  border: 2px solid #ddd;
  text-align: center;
}

.responsive-table th {
  background-color: #f2f2f2;
  font-weight: bold;
}

/* 大屏幕模式下的固定寬度和高度 */
@media screen and (min-width: 769px) {
  .table-container {
    /*max-width: 1200px;*/ /* 設置最大寬度 */
    margin: 0 auto; /* 居中顯示 */
  }

  .responsive-table {
    table-layout: fixed; /* 固定表格佈局 */
  }

  .responsive-table th,
  .responsive-table td {
    width: 200px; /* 設置固定列寬 */
    height: 65px; /* 設置固定行高 */
    overflow: hidden; /* 內容溢出時隱藏 */
    text-overflow: ellipsis; /* 顯示省略號 */
    white-space: nowrap; /* 防止文本換行 */
  }

  .responsive-table td:first-child, 
  .responsive-table th:first-child {
    width: 80px; /* 第一列（level）的寬度 */
    font-weight: bold;
  }
}

/* 小屏幕的響應式設計保持不變 */
@media screen and (max-width: 768px) {
  .responsive-table thead {
    display: none;
  }

  .responsive-table, 
  .responsive-table tbody, 
  .responsive-table tr, 
  .responsive-table td {
    display: block;
    width: 100%;
  }

  .responsive-table tr {
    margin-bottom: 15px;
  }

  .responsive-table td {
    text-align: left;
    position: relative;
    padding-left: 25%;
    height: 70px;
    padding-top: 2px;
    padding-bottom: 2px;
    text-align: center;
  }

  .responsive-table td:before {
    content: attr(data-label);
    position: absolute;
    left: 6px;
    width: 25%;
    height: 100%;
    padding-right: 10px;
    white-space: nowrap;
    font-weight: bold;
    align-content: center;
    text-align: center;
  }

  .responsive-table td:first-child {
  	font-weight: bold;
  	font-size: 20px;
    background-color: bisque;
    padding: 0;
    height: 50px;
    align-content: center;
  }

  .responsive-table td:first-child:before {
  	content: none;
  }
}	
</style>

<!DOCTYPE html>
<html>
<head>
  <?php
    require('head.php');
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

	<div class="column small-12 medium-6 large-3">
			<label><h6>維護項目</h6>
				<select id="itemSelect">
					<option value="evaluation">評量表</option>
					<option value="ability">能力項目</option>
	<!--
					<option value="question">問題表</option>
					<option value="skillDescription">技術描述表</option>
					<option value="tourSuggestion">參團建議表</option>
	-->
	<!--
					<option value="level">程度分級</option>
					<option value="days">天數分類</option>
					<option value="yearLimit">年數上限</option>
	-->
				</select>
			</label>
 	</div>

	<div class="column small-12 medium-6 large-3">
			<label><h6>雪板種類</h6>
				<select id="typeSelect">
					<option value="ski">ski</option>
					<option value="sb">sb</option>
				</select>
			</label>
 	</div>

	<div class="table-container">
		<table id="evaluationTable" class="responsive-table">
			<!-- 表格內容將由 JavaScript 動態生成 -->
		</table>
	</div>
</body>

<script type="text/javascript">
	var selectHTML = "<select></select>";
	var gPreSelectValue = 0;

/*	//gAbilityList is ordered by level and number, so don't need to use a table for ordering
	function getSelectOptionHTMLForAbility_old(abilityArray)
	{
		var html = '<option value="0">'+"----"+'</option>';
		for(var i=0; i<MAX_ABILITY_LEVEL; i++)
		{
			for(var j=0; j<MAX_ABILITY_ITEM_NUMBER; j++)
			{
				if(abilityArray[i][j]['item'].length>0 && abilityArray[i][j]['id']>0)
				{
					html = html+'<option value="'+abilityArray[i][j]['id']+'">'+abilityArray[i][j]['id']+". "+abilityArray[i][j]['item']+'</option>';
				}
			}
		}

		return html;
	}
*/
	function getSelectOptionHTMLForAbility(abilityDB)
	{
		var html = '<option value="0">'+"----"+'</option>';

		for(key in abilityDB)
		{
			if(abilityDB.hasOwnProperty(key))
			{
				if(abilityDB[key]['item'].length>0 && abilityDB[key]['idx']>0)
				{
					html = html+'<option value="'+abilityDB[key]['idx']+'">'+'('+abilityDB[key]['level']+", "+abilityDB[key]['number']+')'+abilityDB[key]['item']+'</option>';
				}
				
			}
		}

		return html;
	}

	function updateEvaluationTable() {
		$('#cover').show();

		var table = $('#evaluationTable');
		table.empty();

		// 添加表頭
		var thead = $('<thead></thead>');
		var headerRow = $('<tr></tr>');
		headerRow.append('<th></th>');
		for (var i = 1; i <= MAX_EVALUATION_ITEM_NUMBER; i++) {
			headerRow.append('<th>Item ' + i + '</th>');
		}
		thead.append(headerRow);
		table.append(thead);

		// 添加表體
		var tbody = $('<tbody></tbody>');

		var optionHTML = getSelectOptionHTMLForAbility(gAbilityList);

		for (var level = 0; level < MAX_EVALUATION_LEVEL; level++) {
			var row = $('<tr></tr>');
			row.append('<td data-label="level">Level ' + (level + 1) + '</td>');

			for (var item = 0; item < MAX_EVALUATION_ITEM_NUMBER; item++) {
				var cell = $('<td></td>').attr('data-label', 'Item ' + (item + 1));
				var select = $('<select></select>').css({
					width: '100%',
					height: '100%',
					fontSize: '16px',
					padding: '0px 20px 0px 5px',
					margin: '0'
				});

				// 根據需要添加更多選項

				if (gType == 'sb') {
					select.prop('disabled', true);
				}

				select.attr('level', level + 1);
				select.attr('itemNo', item + 1);

				// 如果有現有的數據，填充到文本區域
				if (gEvaluationItems[level] && gEvaluationItems[level][item]) {
					select.val(gEvaluationItems[level][item]);
				}

				select.append(optionHTML);
				cell.append(select);
				row.append(cell);
			}

			tbody.append(row);
		}
		table.append(tbody);

		// 設置所有 td 的高度為 45px
		$('#evaluationTable td').css('height', '50px');

		// 遍歷 gEvaluationItems 對象
		for(key in gEvaluationItems)
		{
			// 確保屬性是對象自身的，而不是原型鏈上的
			if(gEvaluationItems.hasOwnProperty(key))
			{
				// 獲取當前項目的等級和編號
				var level = gEvaluationItems[key]['level'];
				var itemNo = gEvaluationItems[key]['number'];
				//console.log(level+','+itemNo);

				// 計算並選擇對應的 select 元素
				// 公式：(level-1) * MAX_EVALUATION_ITEM_NUMBER + (itemNo-1)
				// 這樣可以準確定位到特定等級和項目號的 select 元素
				var select = $('#evaluationTable select:eq('+((level-1)*MAX_EVALUATION_ITEM_NUMBER+(itemNo-1))+')');
				
				// 檢查是否有映射項目，且該選項在 select 中存在
				if(gEvaluationItems[key]['mappingItemID']!=0 && $('#evaluationTable select option[value="'+gEvaluationItems[key]['mappingItemID']+'"]').length > 0)
				{
					// 設置 select 的值為映射項目 ID
					select.val(gEvaluationItems[key]['mappingItemID']);

					// 隱藏並禁用已選擇的選項，防止重複選擇
					$('#evaluationTable select option[value="'+gEvaluationItems[key]['mappingItemID']+'"]').attr("hidden", "");
					$('#evaluationTable select option[value="'+gEvaluationItems[key]['mappingItemID']+'"]').attr("disabled", "");
				}
				else
				{
					// 如果沒有映射項目或選項不存在，將 select 的值設為 0（可能代表未選擇）
					select.val(0);
				}
			}
		}

		$('#evaluationTable select').off('change');
		$('#evaluationTable select').off('focus');

		$("select").focus(function(){
			gPreSelectValue = $(this).val();
			//console.log(gPreSelectValue);
		});

		// 添加事件監聽器
		$('#evaluationTable select').change(function(){
			var select = $('#evaluationTable select');
			if($(this).val() > 0)
			{
				for(var i=0; i<select.length; i++)
				{
					if( ( $('#evaluationTable select:eq('+i+')').attr('level') == $(this).attr('level') ) && ( $('#evaluationTable select:eq('+i+')').attr('itemNo') == $(this).attr('itemNo') ) )
						continue;

					if( $('#evaluationTable select:eq('+i+')').val() == $(this).val() ) 
					{
						$(this).val(gPreSelectValue);
						alert("該項目已被選走");
						break;
					}
				}
			}

			if(gPreSelectValue != $(this).val())
			{
				storeEvaluation(gType, $(this).attr('level'),  $(this).attr('itemNo'), $(this).val());
				gPreSelectValue = $(this).val();
			}
		});

		$('#cover').hide();
	}

	function storeEvaluation(type, level, itemNo, mappingID)
	{
		$('#cover').show();
			$.ajax({
			url:"evaluationHandler.php",
			type:"POST",
			data:{func: "setEvaluations", type: type, level: level, itemNo: itemNo, mappingID: mappingID},
			dataType:"json",
			success: function(obj){
				$('#cover').hide();
				if(obj!="success")
					alert("無法更新評量表，請聯繫管理員。Error code: "+obj);
			},
			complete: function(){
				$('#cover').show();
				loadEvaluationItems(gType, updateEvaluationTable);
			},
			error: function(){ console.log("error"); $('#cover').hide();}
		});
	}

	function updateAbilityList() {
		$('#cover').show();

		var table = $('#evaluationTable');
		table.empty();

		// 創建表頭
		var thead = $('<thead></thead>');
		var headerRow = $('<tr></tr>');
		headerRow.append('<th></th>');
		for (var i = 0; i < MAX_ABILITY_ITEM_NUMBER; i++) {
			headerRow.append('<th>Item ' + (i + 1) + '</th>');
		}
		thead.append(headerRow);
		table.append(thead);

		// 創建表體
		var tbody = $('<tbody></tbody>');
		for (var level = 0; level < MAX_ABILITY_LEVEL; level++) {
			var row = $('<tr></tr>');
			row.append('<td data-label="Level">Level ' + (level + 1) + '</td>');

			for (var item = 0; item < MAX_ABILITY_ITEM_NUMBER; item++) {
				var cell = $('<td></td>').attr('data-label', 'Item ' + (item + 1));
				var textarea = $('<textarea></textarea>').css({
					width: '100%',
					height: '100%',
					padding: '5px',
					margin: '0px',
					fontSize: '16px',
					border: '1px solid #ddd',
					borderRadius: '4px',
					resize: 'vertical'
				});

				if (gType == 'sb') {
					textarea.prop('disabled', true);
				}

				textarea.attr("level", level + 1);
				textarea.attr("itemNo", item + 1);

				cell.append(textarea);
				row.append(cell);
			}

			tbody.append(row);
		}
		table.append(tbody);

		// 填充現有數據
		for (key in gAbilityList) {
			if (gAbilityList.hasOwnProperty(key)) {
				var level = gAbilityList[key]['level'];
				var itemNo = gAbilityList[key]['number'];
				var textarea = $('#evaluationTable textarea[level="' + level + '"][itemNo="' + itemNo + '"]');
				textarea.val(gAbilityList[key]['item']);
			}
		}

		// 添加事件監聽器
		$('#evaluationTable textarea').off('change');
		$('#evaluationTable textarea').change(function(){
			storeAbilityList(gType, $(this).attr('level'),  $(this).attr('itemNo'), $(this).val());
		});

		$('#cover').hide();
	}

	function storeAbilityList(type, level, itemNo, item)
	{
		$('#cover').show();
		$.ajax({
			url:"evaluationHandler.php",
			type:"POST",
			data:{func: "setAbilityList", type: type, level: level, itemNo: itemNo, item: item},
			dataType:"json",
			success: function(obj){
				$('#cover').hide();
				if(obj!="success")
					alert("無法更新能力項目，請聯繫管理員。Error code: "+obj);
			},
			complete: function(){ },
			error: function(){ console.log("error"); $('#cover').hide();}
		});
	}
</script>

<script type="text/javascript">

	//$('#typeSelect').val("sb");
	var gType = $('#typeSelect').val();

	console.log('type='+gType);

	function setEvaluationTable()
	{
		loadAbilityList(gType, updateEvaluationTable);
		//updateEvaluationTable();
	}

	function setAbilityList()
	{
		updateAbilityList();
	}

	$('#itemSelect').val('evaluation');
	loadEvaluationItems(gType, setEvaluationTable);

	//set default value for selected options
	
</script>

<script type="text/javascript">
	$('#itemSelect').change(function(){
		//just update table, "don't" need to reload daysPeriod, abilityList 
		if($(this).val() == 'evaluation')
		{
			$('#cover').show();
			loadEvaluationItems(gType, setEvaluationTable);
		}
		else if($(this).val() == 'ability')
		{
			$('#cover').show();
			loadAbilityList(gType, setAbilityList);
		}
	});

	$('#typeSelect').change(function(){
		gType = $('#typeSelect').val();
		console.log('type='+gType);

		function setEvaluationTable()
		{
			loadAbilityList(gType, updateEvaluationTable);
			//updateEvaluationTable();
		}

		$('#itemSelect').val('evaluation');
		loadEvaluationItems(gType, setEvaluationTable);
	});
</script>

</body>





