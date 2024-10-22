<?php
  require('session.php');
?>

<!DOCTYPE html>
<html>
<head>
  <?php
    require('head.php');
  ?>
  <script src="common.js?4" type="text/javascript"></script>
  <script src="loadBasicInfo.js?10" type="text/javascript"></script>
</head>

<style type="text/css">

.input-group-label, #select_start_date {
 padding-top: 0.8rem;
 padding-bottom: 0.8rem;
}

.mobile-ios-modal-inner {
  -webkit-align-items: inherit;
      -ms-flex-align: inherit;
          align-items: inherit;
}

/*
if multiple tabs link into the same panel, the first one won't be shown at start
for the tab content to be shown, we force it by setting display(find another solution)
*/
.tabs-panel{
  display: block;
  padding: 0rem;
}

.tabs-title > a {
    padding: 1rem 1.5rem;
}

.tabs-title h5{
  margin: 0;
}

.tabs-title > a:focus, .tabs-title > a[aria-selected='true'] {
  background: #f7cd72;
  color: #1779ba;
}

.app-dashboard-icon{
  height: inherit;
}

.app-dashboard-icon .available {
  color: green;
  font-weight: bold;
}

@media print, screen and (min-width: 40em) {
  h3 {
    font-size: 1.5375rem;
  }
}

</style>
<body>
<!--
  <div id="canvas">
  </div>
  -->
<?php //require('canvas.php'); ?>

  <div class="loading" id="cover" style="display: none;">
    <div class="row">
      <div class="small-12 text-center"><span><i class="fi-mobile-signal"></i> 連線中...</span></div>
    </div>
  </div>

  <div class="row column small-12 medium-12 large-10 align-center">
    <label><h6>日期 <span style="font-size: 14px; color: #666" id="dateHint"></span></h6></label>
      <div class="input-group">
        <span  class="input-group-label button" id="previous_date">
          <i class="fa fa-chevron-left" aria-hidden="true">&nbsp</i>
          <sapn id="preSpan">往前一天</sapn><span>&nbsp</span>
          <i class="fa fa-calendar" aria-hidden="true"></i>
        </span>
        <input class="input-group-field" type="date" id="select_start_date">
        <span class="input-group-label button" id="next_date">
          <i class="fa fa-calendar" aria-hidden="true">&nbsp</i>
          <sapn id="nextSpan">往後一天</sapn><span>&nbsp</span>
          <i class="fa fa-chevron-right" aria-hidden="true"></i>
        </span>
      </div>
  </div>

  <div class="row column small-12 medium-12 large-10 align-center">
    <label><h6>課程種類 <span style="color: red;">(*請選擇Ski或是Snowboard)</span></h6></label>
    <div class="app-toggle" class-type-app-toggle>
      <button classType="ski" class="button is-active">Ski(雙板)</button>
      <button classType="sb" class="button">Snowboard(單板)</button>
    </div>
  </div>

  <div class="row column small-12 medium-12 large-10" id="courseSelectInstructor" style="display: none;">
    <p style="color:red; margin: 0.5rem 0;" class="classTypeSelectHint"></p>
    <p id="instructorHintForSuggestDate" style="color: darkgreen; margin: 0.5rem 0;"></p>
    <table class="unstriped" id="courseTableInstructor">
      <thead>
        <tr>
          <th width="14.2857%" align="center" style="text-align: center;word-wrap: break-word;padding-right: 0;padding-left: 0; color: red;">週日</th>
          <th width="14.2857%" align="center" style="text-align: center;word-wrap: break-word;padding-right: 0;padding-left: 0;">週一</th>
          <th width="14.2857%" align="center" style="text-align: center;word-wrap: break-word;padding-right: 0;padding-left: 0;">週二</th>
          <th width="14.2857%" align="center" style="text-align: center;word-wrap: break-word;padding-right: 0;padding-left: 0;">週三</th>
          <th width="14.2857%" align="center" style="text-align: center;word-wrap: break-word;padding-right: 0;padding-left: 0;">週四</th>
          <th width="14.2857%" align="center" style="text-align: center;word-wrap: break-word;padding-right: 0;padding-left: 0;">週五</th>
          <th width="14.2857%" align="center" style="text-align: center;word-wrap: break-word;padding-right: 0;padding-left: 0;">週六</th>
        </tr>
      </thead>
      <tbody id="instructorCourseTableBody">

      </tbody>
    </table>
  </div>

  <div class="large reveal mobile-ios-modal" id="courseSelectModal" data-reveal style="top:0;">
    <div class="mobile-ios-modal-inner" style="padding-bottom: 0;">
      <p style="margin: 0.5rem 0;" id="modalHint"></p>
      <ul class="tabs" data-tabs id="modalInstructorTabs" tableindex="-1" style="color: blue">
      </ul>
      
      <div class="tabs-content" data-tabs-content="modalInstructorTabs">
         
        <div class="tabs-panel is-active" id="panel1">
<!-- to do, now we copy table content from courseTablePark, create it's own table content, not copy-->
          <table id="revealCourseTableInstructor">
    
          </table>

        </div>
      </div>
       <!--
      <table id="revealCourseTableInstructor">
      </table>-->
      <br>
      <a href="checkOut.php" class="button expanded">
        <h5 style="margin: 0;">下一步  <i class="sticky fa fa-shopping-cart"></i></h5>
      </a>
    </div>

    <div class="mobile-ios-modal-options">
      <button data-close class="button"><h5>繼續選課</h5></button>
    </div>
  </div>

<style type="text/css">
.reveal h3{/*小標題*/
  font-size: 1.6rem;
  border-bottom: 1px solid #258ccb;
  color: #258ccb;
  font-weight: bold;
  margin-top: 1.2rem;
}  
</style>

  <script type="text/javascript">

  $(document).foundation();

  var MAX_MONTH_FIELD_NUM = 7;
  var MAX_MONTH_ROW = 6;

  function loadCourseInstructor()
  {
    //selectedInstructor = $('#instructorSelector').val();
    //storeCourseSelectInfo(chooseBy, classType, selectedPark, selectedInstructor, $("#StudentNumSelectField").val(), startDate);
//console.log("loadCourseInstructor");
    $('#cover').show();

    var firstDate = new Date(startDate);
    firstDate.setDate(1);
    var endDate = new Date(startDate);
    endDate.setMonth(endDate.getMonth()+1);
    endDate.setDate(0);

    periodStart = getYYMMDDString(firstDate);
    periodEnd = getYYMMDDString(endDate);
//console.log(selectedInstructor, periodStart, periodEnd);
    $.ajax({
      url:"scheduleInfoHandler.php",
      type:"POST",
      data:{func: "getSchedules", instructor: selectedInstructor, periodStart: periodStart, periodEnd: periodEnd},
      dataType:"json",
      success: function(objs){
        console.log(objs);
        if(objs)
        {
          updateCourseInstructor(objs, selectedInstructor);
        }
      },
      complete: function(){
        if(chooseBy == "instructor")
          $("#courseSelectInstructor").attr('style', "display: block;");

        $('#cover').hide();
      },
      error: function(){ console.log("error"); $('#cover').hide();}
    })

/*
    types = {};
    types['available'] = [];
    types['available'][0] = { 'name': "留壽都" };
    types['available'][10] = { 'name': "留壽都" };
    types['available'][20] = { 'name': "留壽都" };
    //types['available'][5]['name'] = '留壽都';

    console.log(types);

    updateCourseInstructor(types, selectedInstructor);

    if(chooseBy == "instructor")
      $("#courseSelectInstructor").attr('style', "display: block;");
    $('#cover').hide();
*/
  }

  function updateCourseInstructor(course, instructor)
  {
//console.log("updateCourseInstructor");
    $("#courseTableInstructor .app-dashboard-inner").empty();
    $('#instructorHintForSuggestDate').empty();

    //var bookInfo = getBookingInfo();

    var month = moment($('#select_start_date').attr('value')).toDate();
    if(month.getHours()!=0)
    {
      alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
      //window.location.href = 'index.php';
    }
    month.setDate(1);
    var firstDay = month.getDay();  //算出每個月第一天是星期幾
    var daysInMonth = new Date(month.getFullYear(), month.getMonth()+1, 0).getDate(); //how many days in this month
    var selector;
    var text;
    var yyyy = month.getFullYear();
    var mm = month.getMonth()+1;
    if(mm<10){mm='0'+mm;}
    var dd;

    var openDate = new Date();
    var ignoredays = 0;
    openDate.setDate(openDate.getDate()+LOCKED_DAYS);

    if(openDate.getMonth()==month.getMonth() && openDate.getFullYear()==month.getFullYear())
      ignoredays = openDate.getDate();

    //console.log(ignoredays);

    //set date for each block
    for(var i=0; i < MAX_MONTH_FIELD_NUM*MAX_MONTH_ROW; i++)
    {
      selector = '#courseTableInstructor .app-dashboard-icon:eq('+i+') .app-dashboard-inner';
      $(selector).removeClass("available");
      $(selector).parent().removeClass("button");
      $(selector).parent().attr('data-open', "");
      $(selector).parent().css('background-color', "");
    }
    for(var i=0; i < daysInMonth; i++)
    {
      selector = '#courseTableInstructor .app-dashboard-icon:eq('+(i+firstDay)+') .app-dashboard-inner';
      dd = (i+1);
      if(dd<10){dd='0'+dd;}
      var date = yyyy+'-'+mm+'-'+dd;
      text = '<h3 style="margin-bottom: 0;">'+(i+1)+'</h3>';
      $(selector).append(text);
      $(selector).attr('date', date);
    }
    if((daysInMonth+firstDay)>35)
    {
      $("#lastWeekRow").attr('style', "display: table-row");
    }
    else
      $("#lastWeekRow").attr('style', "display: none");

    //set icon if there are courses available 
    for(var i=0; (i < course.length) && (i < daysInMonth); i++)
    {
      //if(i < (ignoredays-1))
      //  continue;

      selector = '#courseTableInstructor .app-dashboard-icon:eq('+(i+firstDay)+') .app-dashboard-inner';

      {
        if(course[i]!=null && course[i]['name'] != "none")
        {
          //<i class="fa fa-snowflake-o small-icon" aria-hidden="true"></i>
          var parkName = course[i]['name'];
          var park = parkName.split(',');
          var cnameString = "";

          for(var count=0; count<park.length; count++)
          {
             cnameString += ('<br>'+parkList[park[count]]['cname'].slice(0,4));
          }
          text = '<sapn><h4 style="font-size: 0.825rem">'+cnameString+'</h4></span>';

          //text = '<sapn><h4 style="font-size: 1.125rem">'+parkList[parkName]['cname']+'</h4></span>';//<br><sapn>('+courseNum+')</span>';
          $(selector).append(text);
          $(selector).attr('park', parkName);
          $(selector).attr('instructor', instructor);
          $(selector).addClass("available");
          $(selector).parent().addClass("button");
          $(selector).parent().css('background-color', "burlywood");
          //$(selector).parent().attr('data-open', "courseSelectModal");
        }
        else
        {
          $(selector).parent().css('background-color', "lightgrey");
        }
      }
    }
/*
    if(course['closest'] && $(selector).find('.available').length==0)
    {
      
      $('#instructorHintForSuggestDate').append("*"+instructorList[selectedInstructor]['cname']+"教練目前最靠近有開課的日期是：<br>");
      if(course['closest']['prevDate'])
        $('#instructorHintForSuggestDate').append(course['closest']['prevDate']+' (往前)');
      if(course['closest']['nextDate'])
      {
        if(course['closest']['prevDate'])
          $('#instructorHintForSuggestDate').append('，');
        $('#instructorHintForSuggestDate').append(course['closest']['nextDate']+' (往後)');
      }

    }
*/
  }

  function registerInstructorCourseIconClick()
  {
    $("#courseTableInstructor .app-dashboard-icon").unbind( "click" );
    $('#courseTableInstructor .app-dashboard-icon').click(function(){
      //console.log("icon click");
      if($(this).attr('data-open') == "courseSelectModal")
      {
        $("#revealCourseTableInstructor").attr('style', "display: none");
        var park = $(this).children('.app-dashboard-inner').attr('park').split(',');
        console.log(park);
        var date = moment($(this).children('.app-dashboard-inner').attr('date')).toDate();
        if(date.getHours()!=0)
        {
          alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
          //window.location.href = 'index.php';
        }
        var instructor = $(this).children('.app-dashboard-inner').attr('instructor');
        selectedInstructor = instructor;
        startDate = date;
        selectedPark = park[0];

        if(park.length >1)
        {
          var cnameString = parkList[park[1]]['cname'];

          for(var count=2; count<park.length; count++)
          {
             cnameString += ('/'+parkList[park[count]]['cname']);
          }
          alert("該教練當天在兩個以上的雪場開課("+parkList[park[0]]['cname']+"/"+cnameString+")，此次查詢只提供"+'"'+parkList[park[0]]['cname']+'"'+"的課程資訊，如果想選擇"+'"'+cnameString+'"'+"的課程，可以利用"+'"'+"依雪場選課"+'"'+"功能查詢");
        }

        var typeName = (classType=="ski")?"Ski":"Snowboard";
        $("#modalHint").empty();
        //document.getElementById("modalHint").innerHTML = '<h4>'+parkList[selectedPark]['cname']+', '+instructorList[selectedInstructor]['cname']+'教練, '+typeName+'</h4>';
        document.getElementById("modalHint").innerHTML = '<h4>'+parkList[selectedPark]['cname']+', '+typeName+'</h4>';

        $("#modalInstructorTabs li").remove();
        $('#modalTabsHint').hide();

        var result = checkStudentNumValid(selectedPark, selectedInstructor, $('#StudentNumSelectField').val(), parkList, instructorList);
        //show close reveal modal and show alert message
        if(result == 'park')
        {
          //alert('抱歉，'+parkList[selectedPark]['cname']+'上課人數最多'+parkList[selectedPark]['maxStudentNum']+'位，請調整上課人數');
          $('#courseSelectModal').foundation('close');
          document.getElementById("modalHint").innerHTML = '<h4>抱歉，'+parkList[selectedPark]['cname']+'上課人數最多'+parkList[selectedPark]['maxStudentNum']+'位，請調整上課人數</h4>';
        }
        else if(result == 'instructor')
        {
          //alert('抱歉，'+instructorList[selectedInstructor]['cname']+'教練上課人數最多'+instructorList[selectedInstructor]['maxStudentNum']+'位，請調整上課人數');
          $('#courseSelectModal').foundation('close');
          document.getElementById("modalHint").innerHTML = '<h4>抱歉，'+instructorList[selectedInstructor]['cname']+'教練上課人數最多'+instructorList[selectedInstructor]['maxStudentNum']+'位，請調整上課人數</h4>';
        }
        else
        {
          $('#cover').show();

          updateHeaderDate(date);
          updateHeaderTimeSlot(parkList[selectedPark]['timeslot']);
          //loadCoursePark();
          findAvailableInstructor("#modalInstructorTabs");
        }
      }
    });
  }

  </script>

  <script type="text/javascript">
    var CryptoJSAesJson = {
        stringify: function (cipherParams) {
            var j = {ct: cipherParams.ciphertext.toString(CryptoJS.enc.Base64)};
            if (cipherParams.iv) j.iv = cipherParams.iv.toString();
            if (cipherParams.salt) j.s = cipherParams.salt.toString();
            return JSON.stringify(j);
        },
        parse: function (jsonStr) {
            var j = JSON.parse(jsonStr);
            var cipherParams = CryptoJS.lib.CipherParams.create({ciphertext: CryptoJS.enc.Base64.parse(j.ct)});
            if (j.iv) cipherParams.iv = CryptoJS.enc.Hex.parse(j.iv)
            if (j.s) cipherParams.salt = CryptoJS.enc.Hex.parse(j.s)
            return cipherParams;
        }
    }
    
    $(document).foundation();
    var LOCKED_DAYS = 3;//LOCKED_DAYS_NORMAL;

    var chooseBy = "instructor";
    var classType = "sb";

    var parkList = null;
    var instructorList = null;
    var parkFeeList = null;

    var maxStudentNum = 6;
    var minStudentNum = 1;

    var selectedPark = null;
    var selectedInstructor = null;
    //var selectedtype; replaced by classType
    var startDate = null;
    var periodStart;
    var periodEnd;

    var debug = false;

    var tableIcon = '<td style="padding: 0;border-spacing: 0;border-collapse: collapse;"> \
          <div style="padding: 0;" class = "app-dashboard-icon"> \
              <div class="app-dashboard-inner"> \
              </div> \
          </div> \
        </td>';

    var wantedPark = null;
    var wantedInstructor = null;
    var wantedStudentNum = null;
    var wantedStartDate = null;

    var preCourseSelect = null;//getCourseSelectInfo();
    if(preCourseSelect)
    {
      chooseBy = preCourseSelect['chooseBy'];
      classType = preCourseSelect['classType'];
      wantedPark = preCourseSelect['park'];
      wantedInstructor = preCourseSelect['instructor'];
      wantedStudentNum = preCourseSelect['studentNum'];
      wantedStartDate = preCourseSelect['startDate'];
    }
console.log("record: "+ chooseBy+","+classType+","+wantedPark+","+wantedInstructor+","+wantedStudentNum+","+wantedStartDate);
    //get url information to set dault UI
    var $_GET = {};

    document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
      function decode(s) {
        return decodeURIComponent(s.split("+").join(" "));
      }

      $_GET[decode(arguments[1])] = decode(arguments[2]);
    });

    if($_GET['park'])
    {
      chooseBy = "park";
      wantedPark = $_GET['park'];
    }
    else if($_GET['instructor'])
    {
      chooseBy = "instructor";
      wantedInstructor = $_GET['instructor'].toLowerCase();
    }

    if($_GET['type'] && $_GET['type'].toUpperCase() == 'SKI')
    {
      classType = "ski";
    }
    else if($_GET['type'] && $_GET['type'].toUpperCase() == 'SB')
    {
      classType = "sb";
    }
/*
    if($_GET['ct'] && $_GET['iv'] && $_GET['s'])
    {
      //var encrypted = CryptoJS.AES.encrypt(JSON.stringify("cj admin"), "cj", {format: CryptoJSAesJson}).toString();

      var encrypted = '{"ct":"'+$_GET['ct']+'","iv":"'+$_GET['iv']+'","s":"'+$_GET['s']+'"}';
      selectedInstructor = JSON.parse(CryptoJS.AES.decrypt(encrypted, "cj", {format: CryptoJSAesJson}).toString(CryptoJS.enc.Utf8));
    }
*/
    if($_GET['name'])
    {
      selectedInstructor = window.atob($_GET['name']);
    }
    console.log(selectedInstructor);

    //console.log("init: "+ chooseBy+","+classType+","+wantedPark+","+wantedInstructor+","+wantedStudentNum+","+wantedStartDate);

    if(chooseBy == "park")
    {
      $('[chooseby="park"]').addClass('is-active');
      $('[chooseby="park"]').siblings().removeClass('is-active');
    }
    else
    {
      $('[chooseby="instructor"]').addClass('is-active');
      $('[chooseby="instructor"]').siblings().removeClass('is-active');
    }

    if(classType == "ski")
    {
      $('[classType="ski"]').addClass('is-active');
      $('[classType="ski"]').siblings().removeClass('is-active');
    }
    else
    {
      $('[classType="sb"]').addClass('is-active');
      $('[classType="sb"]').siblings().removeClass('is-active');
    }

    //$('#canvas').load("canvas.html", function(){});

    //$('#dateHint').append("(不能選擇"+LOCKED_DAYS+"天以內的課程)");

    //clear those parameters from url
    //window.history.replaceState(null, null, "course.php");

    InstructorCourseTableHTML();

    //use callback function to make sure we will have park list and instructor list before we set up everything
    loadParkList(getParkList);
    //getParkFeeList();

    //see if the user read notice and checked before, otherwise show the notice again
    //$('#checkboxRead').prop("checked", getNoticeReadRecord('select-course'));

<?php 
  if(isset($_SESSION[SKIDIY]['member']['idx']))
    echo 'var userID = '.$_SESSION[SKIDIY]['member']['idx'].';';
  else
    echo 'var userID = -1;';
?>
    function getParkList(list)
    {
      parkList = list;
      getParkFeeList();
    }

    function getParkFeeList(list)
    {
      parkFeeList = list;
      //loadInstructorList(getInstructorList);
    
      //instructorList = list;
      //instructorList['pending'] = new Array();
      //instructorList['pending']['maxStudentNum'] = 6;

      //some device won't show default date, to solve this, we need write defferent value into 
      //here we write a value into and real default date will be wirte again later 
      var BadDay = new Date();  
      BadDay.setDate(BadDay.getDate()-1);
      var dd = BadDay.getDate();
      var mm = BadDay.getMonth()+1; //January is 0!
      var yyyy = BadDay.getFullYear();
      if(dd<10){dd='0'+dd;}
      if(mm<10){mm='0'+mm;}
      if(chooseBy=="park")
      {
        $('#select_start_date').attr('value', yyyy+'-'+mm+'-'+dd);
        $('#select_start_date').val(yyyy+'-'+mm+'-'+dd);
      }
      else
      {
        $('#select_start_date').attr('value', (yyyy-1)+'-'+mm);
        $('#select_start_date').val((yyyy-1)+'-'+mm);
      }

      setDefaultUI();
    }

    function InstructorCourseTableHTML()
    {   
      for(var i=0; i<MAX_MONTH_ROW; i++)
      {
        if(i==(MAX_MONTH_ROW-1))
          $('#instructorCourseTableBody').append('<tr id="lastWeekRow" style="display: none;"></tr>');
        else
          $('#instructorCourseTableBody').append('<tr></tr>');

        var tr = $('#instructorCourseTableBody').find('tr').last();
        for(var j=0; j<MAX_MONTH_FIELD_NUM; j++)
        {
          tr.append(tableIcon);
        }
      }

      registerInstructorCourseIconClick();
    }
/* 
    function setParkSelector(list)
    {
      $('#parkSelector option').remove();
      selectedPark = null;

      if(list)
      {
        for (key in list) {
          if (list.hasOwnProperty(key)){
            //console.log(key);
            //assing first key value to selectedPark or the park of url
            if((key == wantedPark) || (selectedPark == null))
            {
              selectedPark = key;
              maxStudentNum = document.getElementById("maxStudentNum").innerHTML = list[key]['maxStudentNum'];
            }
            $("#parkSelector").append($("<option></option>").attr("value", key).text(list[key]['cname']+" （"+key+"）"));
          }
        }
        $("#parkSelector").val(selectedPark);
      }
    }
*/
/*
    function setInstructorSelector(list)
    {
      $('#instructorSelector option').remove();
      selectedInstructor = null;

      if(list)
      {
        for (key in list) {
          if (list.hasOwnProperty(key)){
            if(list[key]['expertise']!=classType && list[key]['expertise']!='both')
              continue;
            if(list[key]['jobType'] == 'support')
              continue;
            if(list[key]['jobType'] == 'none'  || key=='pending' || key=='virtual')
              continue;

            if((key == wantedInstructor) || (selectedInstructor == null))
            {
              selectedInstructor = key;
              maxStudentNum = document.getElementById("maxStudentNum").innerHTML = list[key]['maxStudentNum'];
            }

            $("#instructorSelector").append($("<option></option>").attr("value", key).text(list[key]['cname']));
          }
        }
        $("#instructorSelector").val(selectedInstructor);
        
        if(instructorList[selectedInstructor]['expertise']=='both')
        {
          $('.classTypeSelectHint').empty();
          $('.classTypeSelectHint').append("*"+instructorList[selectedInstructor]['cname']+"教練，SB(單板)與SKI(雙板)都有提供服務，記得選擇您要的種類喔！");
          $('.classTypeSelectHint').show();
        }
        else
          $('.classTypeSelectHint').hide();
          //alert(instructorList[selectedInstructor]['cname']+"教練，SB(單板)與SKI(雙板)都有提供服務，記得選擇您要的項目喔!");
      }
    }
*/
    //set the value for date input
    //date: a Date() class
    //input: selector of input field
    function setDateInput(date, input)
    {
      if(!date || typeof(date) === "undefined" || isNaN(date))
      {
        date = new Date();
      }
      if(chooseBy=="instructor")
        date.setDate(1);

      var valid = true;//checkDateValid(date, LOCKED_DAYS);
    
      var dd = date.getDate();
      var mm = date.getMonth()+1; //January is 0!
      var yyyy = date.getFullYear();
      if(dd<10){dd='0'+dd;}
      if(mm<10){mm='0'+mm;}

      var value;

      if(chooseBy=="park")
        value = yyyy+'-'+mm+'-'+dd;
      else
        value = yyyy+'-'+mm;

      input.attr('value', value);
      input.val(value);

      var isNewDate = false;

      if(!startDate || (startDate.getDate() !== date.getDate()) || (startDate.getMonth() !== date.getMonth())|| (startDate.getFullYear() !== date.getFullYear()))
      {
        startDate = date;
        isNewDate = true;
        console.log("new date: "+startDate);
      }

      return isNewDate;
    }

    function setDefaultUI()
    {
      $('#cover').show();

      //set today as the min value of date input field
      var today = new Date();
      today.setDate(today.getDate()+LOCKED_DAYS); //plus few days as the open date 

      var dd = today.getDate();
      var mm = today.getMonth()+1; //January is 0!
      var yyyy = today.getFullYear();
      if(dd<10){
        dd='0'+dd
      } 
      if(mm<10){
        mm='0'+mm
      }

      if(chooseBy=="park")
      {
        $("#courseSelectInstructor").attr('style', "display: none;");

        setParkSelector(parkList);

        //$('[chooseBy="park"]').siblings().removeClass('is-active');
        //$('[chooseBy="park"]').addClass('is-active');

        $('#instructorSelectField').attr('style', 'display:none');
        $('#parkSelectField').attr('style', 'display:block');
        //change date input to show yyyy-mm-dd
        $('#select_start_date').attr('type', 'date');
        //set min value as today for date input
        document.getElementById("select_start_date").setAttribute("min", yyyy+'-'+mm+'-'+dd);
        document.getElementById("select_start_date").setAttribute("max", yyyy+1+'-'+mm+'-'+dd);

        document.getElementById("preSpan").innerHTML = '往前一天';
        document.getElementById("nextSpan").innerHTML = '往後一天';
      }
      else  //instructor
      {
        console.log("instructor");
        $("#courseSelectPark").attr('style', "display: none;");
        $('#parkHintForTaipeiClose').hide();

        //setInstructorSelector(instructorList);

        //$('[chooseBy="instructor"]').siblings().removeClass('is-active');
        //$('[chooseBy="instructor"]').addClass('is-active');

        $('#parkSelectField').attr('style', 'display:none');
        $('#instructorSelectField').attr('style', 'display:block');
        //change date input to show yyyy-mm
        $('#select_start_date').attr('type', 'month');
        //set min value as this month for date input
        document.getElementById("select_start_date").setAttribute("min", yyyy+'-'+mm);
        document.getElementById("select_start_date").setAttribute("max", yyyy+1+'-'+mm);

        document.getElementById("preSpan").innerHTML = '上一個月';
        document.getElementById("nextSpan").innerHTML = '下一個月';        
      }

      //var targetDate = new Date();
      var targetDate = moment(yyyy+'-'+mm+'-'+dd).toDate();
      if(targetDate.getHours()!=0)
      {
        alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
        //window.location.href = 'index.php';
      }
      setDateInput(targetDate, $('#select_start_date'));
      
      //executed finally, wait all global variables were filled
      if(chooseBy == "park")
      {
        updateHeaderDate(startDate);
        updateHeaderTimeSlot(parkList[selectedPark]['timeslot']);
        findAvailableInstructor("#instructorTabs");
      }
      else
        loadCourseInstructor();
    } //end of setDefaultUI

    //choose ski or snowboard
    $('[class-type-app-toggle] .button').click(function () {
      $(this).siblings().removeClass('is-active');
      $(this).addClass('is-active');

      if(classType != $(this).attr('classType'))
      {
        classType = $(this).attr('classType');
        console.log("class type : "+classType);

        if(chooseBy == "park")
          findAvailableInstructor("#instructorTabs");
        else
        {
          setInstructorSelector(instructorList);
          if(parseInt($('#StudentNumSelectField').val()) > maxStudentNum)
          {
            $('#StudentNumSelectField').val(maxStudentNum);
          }
          loadCourseInstructor();
        }  
      }
    });

    function updateTableByDate(date, selector)
    {
      if(chooseBy=="park")
      {
        updateHeaderDate(startDate);
        findAvailableInstructor("#instructorTabs");
      }
      else
        loadCourseInstructor();
    }

    $('#select_start_date').change(function(){
      //console.log("on change");
      if(isNaN(new Date($(this).val())))
      {
        alert("日期輸入錯誤");
      }

      var date = moment($(this).val()).toDate();
      if(date.getHours()!=0)
      {
        alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
        //window.location.href = 'index.php';
      }
      if(setDateInput(date, $(this)))
        updateTableByDate();
    });

    //set previus date as the value of date input
    $('#previous_date').click(function(){
      var prev = moment($('#select_start_date').attr('value')).toDate();
      if(prev.getHours()!=0)
      {
        alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
        //window.location.href = 'index.php';
      }
      if(chooseBy=="park"){
        prev.setDate(prev.getDate()-1);
      }
      else{
        prev.setMonth(prev.getMonth()-1);
      }
      if(setDateInput(prev, $('#select_start_date')))
        updateTableByDate();
    });

    //set next date as the value of date input
    $('#next_date').click(function(){
      var next = moment($('#select_start_date').attr('value')).toDate();
      if(next.getHours()!=0)
      {
        alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
        //window.location.href = 'index.php';
      }
      if(chooseBy=="park"){
        next.setDate(next.getDate()+1);
      }
      else{
        next.setMonth(next.getMonth()+1);
      }
      if(setDateInput(next, $('#select_start_date')))
        updateTableByDate();
    });

  </script>

</body>
</html>