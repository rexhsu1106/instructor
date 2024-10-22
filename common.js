
	var MAX_EVALUATION_ITEM_NUMBER = 15;
	var MAX_EVALUATION_LEVEL = 6;

	var MAX_ABILITY_ITEM_NUMBER = 20;
	var MAX_ABILITY_LEVEL = 6;

	//var HTML_NEWLINE = &#10;

	var EVALUATION_LEVELS_DESCRIPTION_SB = ["基本（綠線）", "轉彎（綠線）", "一般雪道滑行（綠線/紅線）", "進階雪道滑行（綠線/紅線/黑線）", "高級雪道滑行（紅線/黑線/雙黑線）", "Park（small）"];
	var EVALUATION_LEVELS_DESCRIPTION_SKI = ["基本（綠線）", "轉彎（綠線）", "一般雪道滑行（綠線/紅線）", "進階雪道滑行（綠線/紅線/黑線）", "高級雪道滑行（紅線/黑線/雙黑線）", "Park（small）"];
	var EVALUATION_LEVELS_EXPLANATION_SB = [
	"在斜坡滑行時控制方向與速度", 
	"連續轉彎並且在各種初級滑道上控制速度", 
	"運用更多的鋼邊技巧，能以更高速或是在更陡的滑道滑行，學習簡單的跳躍", 
	"能在各式各樣的雪道(坡度，地形，雪況)上根據需要，採用不同的方式滑行", 
	"運用高階技巧，在任何滑道都能順暢的滑行，發展個人的滑雪風格", 
	"Park區的各種花式技巧"];

	function getEvaluationTableArray(db, levelNum, itemNum)
	{
		//new a evaluation table - 2D array
		var table = new Array();
		for(var i=0; i<levelNum; i++)
		{
			table[i] = new Array();
			for(var j=0; j<itemNum; j++)
			table[i][j] = "";
		}

		for(key in db)
		{
			if(db.hasOwnProperty(key))
			{
				if( (db[key]['level'] <= levelNum) && (db[key]['number'] <= itemNum) )
					table[db[key]['level']-1][db[key]['number']-1] = db[key]['mappingItemID'];
			}
		}

		return table;
	}

	function getAbilityListArray(db, levelNum, itemNum)
	{
		//new a evaluation table - 2D array
		var table = new Array();
		for(var i=0; i<levelNum; i++)
		{
			table[i] = new Array();
			for(var j=0; j<itemNum; j++)
				table[i][j] = {id: 0, item:""};
		}

		for(key in db)
		{
			if(db.hasOwnProperty(key))
			{
				if( (db[key]['level'] <= levelNum) && (db[key]['number'] <= itemNum) )
				{
					table[db[key]['level']-1][db[key]['number']-1]['item'] = db[key]['item'];
					table[db[key]['level']-1][db[key]['number']-1]['id'] = db[key]['idx'];
				}
				
			}
		}

		return table;
	}

	function getAbilityListArrayByIdx(db)
	{
		var array = new Array();

		for(key in db)
		{
			if(db.hasOwnProperty(key))
			{
				array[db[key]['idx']] = {item: db[key]['item'], explanation: db[key]['explanation']};
								//array[db[key]['idx']]['item'] = db[key]['item'];
				//array[db[key]['idx']]['explanation'] = db[key]['explanation'];			
			}
		}

		return array;
	}
