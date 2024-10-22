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
  <script src="loadBasicInfo.js?8" type="text/javascript"></script>
</head>

<style>
  input[type='checkbox']{
    margin-left: 1.2rem;
  }
</style>

<style type="text/css">
/*
.input-group-label, #select_start_date, #select_start_month {
 padding-top: 0.8rem;
 padding-bottom: 0.8rem;
}
*/
.mobile-ios-modal-inner {
  -webkit-align-items: inherit;
      -ms-flex-align: inherit;
          align-items: inherit;

  display: inherit;
  text-align: inherit;
}

.app-dashboard-icon{
  height: inherit;
  color: black;
}

#schduleTableBody .none.button:hover, #schduleTableBody .none.button:focus {
    color: inherit;
}

#courseTablePark .app-dashboard-icon{
  min-height: 5.625rem;
}
#courseTablePark .app-dashboard-inner{
  min-height: unset;
}

#courseTablePark .app-dashboard-inner img,
#courseTablePark .app-dashboard-inner svg,
#courseTablePark .app-dashboard-inner i {
  max-width: 2.625rem;
  max-height: 2.625rem;
  font-size: 2.625rem;

  display: block;
}

.app-dashboard-icon.none{
  background-color: gray;
  color: white;
}

.app-dashboard-icon.fullyBooked{
  background-color: pink;
  color: white;
}
/*
.app-dashboard-icon.fullyBooked:after {
  color: rgba(55, 160, 230, 0.43);
  content: "\f00c";
  font-size: 4.6rem;
  font-family: FontAwesome;
  position: absolute;
}
*/
.app-dashboard-icon.fullyOpenWithBook{
  background-color: pink;
  color: white;
}

.app-dashboard-icon.fullyOpen{
  background-color: lightgreen;
  color: white;
}

.app-dashboard-icon.allowOpen{
  background-color: lightgreen;
  color: white;
}

.app-dashboard-icon.allowOpenWithBook{
  background-color: pink;
  color: white;
}

@media print, screen and (min-width: 40em) {
  h3 {
    font-size: 1.5375rem;
  }
}

.app-dashboard-icon h4{
  margin-bottom: 0;
}

.app-dashboard-icon.fullyBooked i,
.app-dashboard-icon.fullyOpenWithBook i,
.app-dashboard-icon.fullyOpen i,
.app-dashboard-icon.allowOpen i,
.app-dashboard-icon.allowOpenWithBook i
{
  font-size: 2rem;
}
/*
.app-dashboard-icon.fullyOpen i, .app-dashboard-icon.fullyOpenWithBook i{
  position: relative;
  font-size: 0.5rem;
  right: -1.4rem;
  top: -2.2rem;
}
*/
</style>
<style type="text/css">
.order-content{
  padding: 0.25rem;
  border: 0.25rem solid #a3f3c0;
}

:last-child > .order-content:last-child {
  border-bottom: 0.25rem solid #a3f3c0;
}

.order-content .remark{
  color: #aa0000;
  margin: 0;
}

.order-content table{
  border: 1px solid #e6e6e6;
  margin: 0px;
  padding: 0.5rem;
  font-size: 16px;
  border-spacing: 0;
}

.order-content table td{
  padding: 0rem;
}

.order-content table td:nth-child(3){
 text-align: right;
}

.checkout-summary-details{
  border: 1px solid #e6e6e6;
  padding: 0.5rem;
  margin: 0.5rem 0;
}

.checkout-summary-details p{
  margin-bottom: 0.5rem;
}

.checkout-summary-details .payment{
  color: #ee0000;
  font-weight: bold;
}

.card-info .card-info-label {
  border-style: solid;
  border-width: 0 5.375rem 2.5rem 0;
  float: right;
  height: 0px;
  width: 0px;
  -webkit-transform: rotate(360deg);
      -ms-transform: rotate(360deg);
          transform: rotate(360deg);
}

.card-info .card-info-label-text {
  color: #fefefe;
  font-size: 0.75rem;
  font-weight: bold;
  position: relative;
  right: -3.2rem;
  top: 0px;
  white-space: nowrap;
  -webkit-transform: rotate(0deg);
      -ms-transform: rotate(0deg);
          transform: rotate(0deg);
}

.card-info.reserved td{
  background-color: #f5c55e;
}

.card-info-label-text p{
  font-size: 20px;
}

table.reserved, table.reserved tbody tr{
  background-color: #f5c55e;
}

table.combo, table.combo tbody tr{
  background-color: #cacaca;
}

tr.border_bottom td {
  border-bottom:1px dashed #8a8a8a;
}

.button{
  border-radius: 5px; 
}

.managerFunc .button
{
  margin: 0.5rem 0.5rem;
}
</style>
<style type="text/css">
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
  top: 80%;
  -webkit-transform: translateY(-50%);
      -ms-transform: translateY(-50%);
          transform: translateY(-50%);
  width: 100%;
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
  <?php require('stickyShrinkNav.php'); ?>
  
  <ul class="sticky-social-bar" id="StickySocialBar">
    <div style="background-color: #d7ecfa;">

      <div style="max-width: 100%" class="row align-center">  
      <!--
        <div class="column small-12 medium-12 large-10">
          <h4 style="margin: 0.2rem;">整段行程變更</h4>
        </div>
      -->
        <div class="small-6 columns text-center">
            <a style="margin-bottom: 0.2rem; padding: 0.5rem" class="button warning" id="updateButton">儲存更改</a>
          </div>
          <div class="small-6 columns text-center">
            <a style="margin-bottom: 0.2rem; padding: 0.5rem" class="button success" id="restoreButton">恢復原狀</a>
          </div>
      </div>
    <div style="background-color: #afd7f3; margin: 0;">
      <div style="max-width: 100%" class="row align-center">
                            <div class="small-12 medium-6 large-5 columns">
                                <note>起始日期</note>
                                <input style="margin-bottom: 0.2rem; height: 2rem;" type="date" name="start" id="dateStart" placeholder="起始日期">
                            </div>

                            <div class="small-12 medium-6 large-5 columns">
                                <note>結束日期</note>
                                <input style="margin-bottom: 0.2rem; height: 2rem;" type="date" name="end" id="dateEnd" placeholder="結束日期">
                            </div>
      </div>
      <div style="max-width: 100%" class="row">
                            <div class="small-6 columns text-center">
                                <a style="margin-bottom: 0.2rem; padding: 0.5rem" class="button alert" id="deleteBtn">清空行程</a>
                            </div>
                            <div class="small-6 columns text-center">
                                <a style="margin-bottom: 0.2rem; padding: 0.5rem" class="button" id="addBtn">新增行程</a>
                            </div>
      </div>
    </div>
  </ul>

  <div class="loading" id="cover" style="display: none;">
    <div class="row">
      <div class="small-12 text-center"><span><i class="fi-mobile-signal"></i> 連線中...</span></div>
    </div>
  </div>

  <div>
    <div class="row align-center managerFunc" style="display:none; background-color: lightgray; padding: 1rem 0;"> 
        <a href="main.php" class="button">main</a>
        
        <a href="courseTable.php" class="button">courseTable</a>
        <a href="orderManager.php" class="button">orderManager</a>
        <a href="checkOrder.php" class="button alert">checkOrder</a>
        <a href="reserveLimit.php" class="button">reserveLimit</a>
    </div>
  </div>

  <div class="row column small-12 medium-12 large-10 align-center" style="display: none;">
    <label><note>功能</note></label>
      <select id="functionSelector">
        <option value="arrange">排行程</option>
<!--
        <option value="order">訂單查詢</option>
        <option value="information">公告資訊</option>
        <option value="configuration">系統設定</option>
        <option value="refer">推薦查詢</option>
-->
      </select>
  </div>

<div id="arrangeDiv" style="display: none;">
  <div style="max-width: 100%" class="row align-center">
    <div class="column small-12 medium-12 large-5">
      <label><note>月份</note></label>
        <div class="input-group">
          <span  class="input-group-label button" id="previous_month">
            <i class="fa fa-chevron-left" aria-hidden="true">&nbsp</i>
            <sapn>上個月</sapn><span>&nbsp</span>
            <i class="fa fa-calendar" aria-hidden="true"></i>
          </span>
          <input class="input-group-field" type="month" id="select_start_month">
          <span class="input-group-label button" id="next_month">
            <i class="fa fa-calendar" aria-hidden="true">&nbsp</i>
            <sapn>下個月</sapn><span>&nbsp</span>
            <i class="fa fa-chevron-right" aria-hidden="true"></i>
          </span>
        </div>
    </div>
    <div class="column small-12 medium-12 large-5" id="parkSelectField">
      <label><note>雪場</note></label>
      <select id="parkSelector">
      </select>    
    </div>
    </div>
  </div>
  <div class="row column small-12 large-10">
    <table class="unstriped" id="schduleTable">
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
      <tbody id="schduleTableBody">

      </tbody>
    </table>
  </div>

  <hr class="multi-step-checkout-form-divider">

<div style="background-color: #d7ecfa; display: none;">

  <div style="max-width: 100%" class="row align-center">  
    <div class="column small-12 medium-12 large-10">
      <h4>整段行程變更</h4>
    </div>
 <!--   
    <div class="column small-8 medium-8 large-7" id="parkSelectField">
      <label><note>雪場</note></label>
      <select id="parkSelector">
      </select>    
    </div>
    <div class="column small-4 medium-4 large-3">
      <label><note>項目</note></label>
      <select id="typeSelector">
        <option value="sb">SB</option>
        <option value="ski">SKI</option>
        <option value="both">不限</option>
        <option value="busy">私人行程</optioin>
      </select>
    </div>
-->
  </div>
<div style="background-color: #afd7f3; margin: 1rem;">
<!--<
  <div class="column small-12 medium-12 large-10">
    h6>快速排課</h6>
  </div>
-->
  <div style="max-width: 100%" class="row align-center">
                        <div class="small-12 medium-6 large-5 columns">
                            <note>起始日期</note>
                            <input type="date" name="start" id="dateStart" placeholder="起始日期">
                        </div>

                        <div class="small-12 medium-6 large-5 columns">
                            <note>結束日期</note>
                            <input type="date" name="end" id="dateEnd" placeholder="結束日期">
                        </div>
  </div>
  <div style="max-width: 100%" class="row">
                        <div class="small-6 columns text-center">
                            <a class="button" id="deleteBtn">清空行程</a>
                        </div>
                        <div class="small-6 columns text-center">
                            <a class="button alert" id="addBtn">新增行程</a>
                        </div>
  </div>
</div>

  <script type="text/javascript">
  $(document).foundation();

  var MAX_MONTH_FIELD_NUM = 7;
  var MAX_MONTH_ROW = 6;

  function loadSchedules(cb)
    {
      $('#cover').show();

      var firstDate = moment($('#select_start_month').attr('value')).toDate();
      if(firstDate.getHours()!=0)
      {
        console.log(firstDate);
        alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
        window.location.href = 'index.php';
      }
      firstDate.setDate(1);
      var endDate = moment($('#select_start_month').attr('value')).toDate();
      if(endDate.getHours()!=0)
      {
        console.log(endDate);
        alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
        window.location.href = 'index.php';
      }
      endDate.setMonth(endDate.getMonth()+1);
      endDate.setDate(0);

      periodStart = getYYMMDDString(firstDate);
      periodEnd = getYYMMDDString(endDate);

      //var period = {start: periodStart, end: periodEnd};

      $.ajax({
            url:"scheduleInfoHandler.php",
            type:"POST",
            data:{func: "getSchedules", instructor: selectedInstructor, periodStart: periodStart, periodEnd: periodEnd},
            dataType:"json",
            success: function(obj){
              if(cb && typeof(cb) === "function")
                cb(obj);
              $('#cover').hide();
            },
            complete: function(){ },
            error: function(){ console.log("error"); $('#cover').hide();}
      });
    }

  function updateScheduleUI(schedule)
  {    
    var localSchedules = getUpdateSchedule();
    gScheduleThisMonth = schedule;
console.log(schedule);
console.log(localSchedules);
    $("#schduleTable .app-dashboard-inner").empty();

    //var bookInfo = getBookingInfo();

    var month = moment($('#select_start_month').attr('value')).toDate();
    if(month.getHours()!=0)
    {
      console.log(month);
      alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
      window.location.href = 'index.php';
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

    //if(openDate.getMonth()==month.getMonth() && openDate.getFullYear()==month.getFullYear())
    //  ignoredays = openDate.getDate();

    //console.log(ignoredays);

    //set date for each block
    for(var i=0; i < MAX_MONTH_FIELD_NUM*MAX_MONTH_ROW; i++)
    {
      selector = '#schduleTable .app-dashboard-icon:eq('+i+') .app-dashboard-inner';
      $(selector).parent().removeClass("allowOpen fullyOpen fullyBooked none fullyOpenWithBook allowOpenWithBook");
      $(selector).parent().removeClass("button");
      $(selector).parent().attr('data-open', "");
      $(selector).parent().css("border-color", "").css("border-width", "").css("background-color", "");
    }
    for(var i=0; i < daysInMonth; i++)
    {
      selector = '#schduleTable .app-dashboard-icon:eq('+(i+firstDay)+') .app-dashboard-inner';
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

    //set icon
    for(var i=0; (i < schedule.length) && (i < daysInMonth); i++)
    {
      if(i < (ignoredays-1))
        continue;

      selector = '#schduleTable .app-dashboard-icon:eq('+(i+firstDay)+') .app-dashboard-inner';

      if(schedule[i]!=null && schedule[i]['name'] != "none")
        $(selector).attr('park', schedule[i]['name']);
      else
        $(selector).attr('park', "none");

      $(selector).parent().addClass("button");

      if(localSchedules && localSchedules[$(selector).attr('date')])
      {
        console.log("bad situation");
        if(localSchedules[$(selector).attr('date')]['status'] == 'close')
        {
          $(selector).parent().addClass("none");
        }
        else
        {
          var parkName = parkList[localSchedules[$(selector).attr('date')]['park']]['cname'].slice(0, 4);
          text = '<sapn><h4 style="font-size: 0.825rem; font-weight: bold;">'+parkName+'</h4></span>';
          $(selector).append(text); 

          $(selector).parent().css("background-color", "burlywood");
        }               
      }
      else
      {
        if(schedule[i]!=null && schedule[i]['name'] != "none")
        {
          //雪場名稱最多只能有三個字
          var parkName = parkList[schedule[i]['name']]['cname'].slice(0, 4);
          
          text = '<sapn><h4 style="font-size: 0.825rem; font-weight: bold;">'+parkName+'</h4></span>';
          $(selector).append(text);

          $(selector).parent().css("background-color", "burlywood");        
        }
        else
        {
          $(selector).parent().addClass("none");
        }
      }
    }
  }

  function registerInstructorCourseIconClick()
  {
    $("#schduleTable .app-dashboard-icon").off( "click" );
    $('#schduleTable .app-dashboard-icon').click(function(){
      
      if($(this).hasClass('button'))
      {
        var date = moment($(this).find('.app-dashboard-inner').attr('date')).toDate();
        if(date.getHours()!=0)
        {
          console.log(date);
          alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
          window.location.href = 'index.php';
        }
        //setDateInput(date, $('#start'));
        //setDateInput(date, $('#dateStart'));
        //setDateInput(date, $('#end'));
        //setDateInput(date, $('#dateEnd'));

        if($(this).hasClass('none'))
        {
          var parkName = parkList[selectedPark]['cname'].slice(0, 4);

          $(this).removeClass('none');
          $(this).find('h4').parent().remove();
          $(this).find('.app-dashboard-inner').append('<sapn><h4 style="font-size: 0.825rem; font-weight: bold;">'+parkName+'</h4></span>');

          $(this).css("background-color", "burlywood");

          var park = $(this).find('.app-dashboard-inner').attr('park');
          if(park!=null && park!=="undefined" && park!=selectedPark && park!="none")
            updateSchedules($(this).find('.app-dashboard-inner').attr('date'), selectedPark, 'both', "update");
          else
            updateSchedules($(this).find('.app-dashboard-inner').attr('date'), selectedPark, 'both', "open");
        }
        else
        {
          $(this).addClass('none');
          $(this).find('h4').parent().remove();
          $(this).css("background-color", "");

          updateSchedules($(this).find('.app-dashboard-inner').attr('date'), selectedPark, 'both', "close");
        }

        var localSchedules = getUpdateSchedule();
        if(localSchedules && localSchedules[$(this).find('.app-dashboard-inner').attr('date')])
        {
          var park = $(this).find('.app-dashboard-inner').attr('park');
          if(park!=null && parkList[park]!=null && parkList[park]['cname']!=null)
          {
            $('<sapn><h4 style="font-size: 0.825rem; font-weight: bold; text-decoration:line-through">'+parkList[park]['cname'].slice(0, 4)+'</h4></span>').insertAfter($(this).find('.app-dashboard-inner h3'));
          }
          $(this).css("border-color", "green").css("border-width", "medium");
          console.log(this);
        }
        else
        {
          $(this).css("border-color", "").css("border-width", "");
        }
      }
    });
  }

  function storeSchedules()
  {
      $('#cover').show();
      $.ajax({
            url:"scheduleInfoHandler.php",
            type:"POST",
            data:{func: "storeSchedules", instructor: selectedInstructor, schedules: getUpdateSchedule()},
            dataType:"json",
            success: function(obj){
              console.log(obj);
              if(obj!="success")
                alert(obj);
              
              clearUpdateSchedule();
              updateTableByMonth();
              $('#schduleTable .app-dashboard-icon').css("border-color", "").css("border-width", "");
              $('#cover').hide();
            },
            complete: function(){ },
            error: function(){ 
              console.log("error"); 
              clearUpdateSchedule();
              updateTableByMonth();
              $('#cover').hide();
            }
    });
  }

  function restoreScheduleUI()
  {
    if(gScheduleThisMonth)
      updateScheduleUI(gScheduleThisMonth);
  }

  </script>

  <script type="text/javascript">
    $(document).foundation();
    var LOCKED_DAYS = 0;

    var parkList = null;
    var parkFeeList = null;

    var selectedPark = null;
<?php
  echo 'var selectedInstructor = "'.strtolower($_SESSION['member']['name']).'";';
  echo 'var userID = "'.$_SESSION['member']['idx'].'";';
  if($_SESSION['member']['memberID'])
    echo 'var memberID = "'.$_SESSION['member']['memberID'].'";';
  else
    echo 'var memberID = null;';
?>

  if(memberID)
  {
    //console.log("https://teaching.diy.ski/instructor/mySchedule.php?ct="+memberID['ct']+"&iv="+memberID['iv']+"&s="+memberID['s']);
    console.log("https://teaching.diy.ski/instructor/mySchedule.php?name="+memberID);

  }
    
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
    var wantedStartDate = null;

    var checkClassNo = [false];

    var gScheduleThisMonth = null;

    InstructorCourseTableHTML();
    loadParkList(getParkList);

    function getParkList(list)
    {
      parkList = list;
      getParkFeeList();
    }

    function getParkFeeList(list)
    {
      parkFeeList = list;

      //instructorList['cj']['levelFee'] = 2000;
      //some device won't show default date, to solve this, we need write defferent value into 
      //here we write a value into and real default date will be wirte again later 
      var BadDay = new Date();  
      BadDay.setDate(BadDay.getDate()-1);
      var dd = BadDay.getDate();
      var mm = BadDay.getMonth()+1; //January is 0!
      var yyyy = BadDay.getFullYear();
      if(dd<10){dd='0'+dd;}
      if(mm<10){mm='0'+mm;}
      
      $('#select_start_month').attr('value', (yyyy-1)+'-'+mm);
      $('#select_start_month').val((yyyy-1)+'-'+mm);

      $('#dateStart').attr('value', (yyyy-1)+'-'+mm+'-'+dd);
      $('#dateStart').val((yyyy-1)+'-'+mm)+'-'+dd;

      $('#dateEnd').attr('value', (yyyy-1)+'-'+mm+'-'+dd);
      $('#dateEnd').val((yyyy-1)+'-'+mm+'-'+dd);

      setDefaultUI();
    }

    function InstructorCourseTableHTML()
    {   
      for(var i=0; i<MAX_MONTH_ROW; i++)
      {
        if(i==(MAX_MONTH_ROW-1))
          $('#schduleTableBody').append('<tr id="lastWeekRow" style="display: none;"></tr>');
        else
          $('#schduleTableBody').append('<tr></tr>');

        var tr = $('#schduleTableBody').find('tr').last();
        for(var j=0; j<MAX_MONTH_FIELD_NUM; j++)
        {
          tr.append(tableIcon);
        }
      }

      registerInstructorCourseIconClick();
    }

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
            }
            $("#parkSelector").append($("<option></option>").attr("value", key).text(list[key]['cname']+" （"+key+"）"));
          }
        }
        $("#parkSelector").val(selectedPark);
        //updateTimeslotCheckBox();
      }
    }

    //set the value for date input
    //date: a Date() class
    //input: selector of input field
    function setDateInput(date, input)
    {
      if(!date || typeof(date) === "undefined" || isNaN(date))
      {
        date = new Date();
      }
      //if not, while press previous month, it maybe update table if date is on this month 
      if(input.attr('type') == "month" )
        date.setDate(1);

      var valid = checkDateValid(date, LOCKED_DAYS);
      
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

      var isNewDate = false;

      if(!startDate || (startDate.getDate() !== date.getDate()) || (startDate.getMonth() !== date.getMonth())|| (startDate.getFullYear() !== date.getFullYear()))
      {
        startDate = date;
        isNewDate = true;
        //console.log("new date: "+startDate);
      }

      return isNewDate;
    }

    function setDefaultUI()
    {
      //$("body").append(spinner.el);
      $('#cover').show();

      setParkSelector(parkList);
   
      $("select_start_month").attr("min", yyyy+'-'+mm);
      $("select_start_month").attr("max", yyyy+1+'-'+mm);

      $('#dateStart').attr('min', yyyy+'-'+mm+'-'+dd);
      $('#dateStart').attr('max', yyyy+1+'-'+mm+'-'+dd);

      $('#dateEnd').attr('min', yyyy+'-'+mm+'-'+dd);
      $('#dateEnd').attr('max', yyyy+1+'-'+mm+'-'+dd);

      var start_order = new Date();
      var end_order = new Date();
      end_order.setMonth(start_order.getMonth()+1);
      setDateInput(start_order, $('#dateStart_order'));
      setDateInput(end_order, $('#dateEnd_order'));

      setDateInput(start_order, $('#dateStart_refer'));
      setDateInput(start_order, $('#dateEnd_refer'));

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

      setDateInput(today, $('#select_start_month'));

      var endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0);

      setDateInput(today, $('#dateStart'));
      setDateInput(endDate, $('#dateEnd'));

      $('#arrangeDiv').show();
      //$('#functionSelector').parents('div').show();

      loadSchedules(updateScheduleUI);
    } //end of setDefaultUI

    function updateTableByMonth()
    {
      loadSchedules(updateScheduleUI);
    }

    $('#parkSelector').change(function(){
      wantedPark = selectedPark = $(this).find(":selected").attr('value');
      //updateTimeslotCheckBox();
      if(Object.size(getUpdateSchedule()) > 0)
      {
        //updateScheduleDataBase();
      }
    });

    $('#typeSelector').change(function(){
      if(Object.size(getUpdateSchedule()) > 0)
      {
        //updateScheduleDataBase();
      }
    });

    $('#select_start_month').change(function(){
      //console.log("on change");
      if(isNaN(new Date($(this).val()/*+"T00:00:00"*/)))
      {
        alert("日期輸入錯誤");
      }

      var date = moment($(this).val()).toDate();
      if(date.getHours()!=0)
      {
        console.log(date);
        alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
        window.location.href = 'index.php';
      }

      if(setDateInput(date, $(this)))
      {
        storeSchedules();
        //updateTableByMonth();
      }
      var endDate = new Date(date.getFullYear(), date.getMonth() + 1, 0);

      setDateInput(date, $('#dateStart'));
      setDateInput(endDate, $('#dateEnd'));
    });

    //set previus date as the value of date input
    $('#previous_month').click(function(){
      var prev = moment($('#select_start_month').attr('value')).toDate();
      if(prev.getHours()!=0)
      {
        console.log(prev);
        alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
        window.location.href = 'index.php';
      }
      prev.setMonth(prev.getMonth()-1);

      if(setDateInput(prev, $('#select_start_month')))
      {
        storeSchedules();
        //updateTableByMonth();
      }
      var endDate = new Date(prev.getFullYear(), prev.getMonth() + 1, 0);

      setDateInput(prev, $('#dateStart'));
      setDateInput(endDate, $('#dateEnd'));
    });

    //set next date as the value of date input
    $('#next_month').click(function(){
      var next = moment($('#select_start_month').attr('value')).toDate();
      if(next.getHours()!=0)
      {
        console.log(next);
        alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
        window.location.href = 'index.php';
      }
      next.setMonth(next.getMonth()+1);

      if(setDateInput(next, $('#select_start_month')))
      {
        storeSchedules();
        //updateTableByMonth();
      }
      var endDate = new Date(next.getFullYear(), next.getMonth() + 1, 0);

      setDateInput(next, $('#dateStart'));
      setDateInput(endDate, $('#dateEnd'));
    });

    $('#dateStart').change(function(){
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
        var end = moment($('#dateEnd').val()).toDate();
        if(end.getHours()!=0)
        {
          console.log("15 :"+end);
          alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
          window.location.href = 'index.php';
        }

        //console.log(start.getTime(), end.getTime());
        if(end.getTime() < start.getTime())
        {
          setDateInput(start, $('#dateEnd'));
        }
      }
    });

    $('#dateEnd').change(function(){

      if(isNaN(new Date($(this).val()/*+"T00:00:00"*/)))
      {
        alert("日期輸入錯誤");
      }
      else
      {
        var start = moment($('#dateStart').val()).toDate();
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
          setDateInput(end, $('#dateStart'));
        }
      }
    });

    $('#updateButton').click(function(){
      if(Object.size(getUpdateSchedule()) > 0)
      {
        storeSchedules();
        //updateTableByMonth();
      }
    });

    $('#restoreButton').click(function(){
      if(Object.size(getUpdateSchedule()) > 0)
      {
        clearUpdateSchedule();
        restoreScheduleUI();
      }
    });

    $('#deleteBtn').click(function(){
      
      if(Object.size(getUpdateSchedule())>0)
      {
        alert('課表已被修改，請先按一下"行程修改確認"，儲存之前的修改');
        return;
      }

      $('#cover').show();

      var start = moment($('#dateStart').val()).toDate();
      if(start.getHours()!=0)
      {
        console.log(start);
        alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
        window.location.href = 'index.php';
      }
      var end = moment($('#dateEnd').val()).toDate();
      if(end.getHours()!=0)
      {
        console.log(end);
        alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
        window.location.href = 'index.php';
      }

        $.ajax({
          url:"scheduleInfoHandler.php",
          type:"POST",
          data:{func: "deleteSchedulesPatch", instructor: selectedInstructor, periodStart: $('#dateStart').val(), periodEnd: $('#dateEnd').val()},
          //刪除的話，不管課程種類
          dataType:"json",
          success: function(obj){
            console.log(obj);
            updateTableByMonth();
          },
          complete: function(){
            //$('#cover').hide();
          },
          error: function(){ console.log("error"); $('#cover').hide();}
        });
    });

    $('#addBtn').click(function(){

      if(Object.size(getUpdateSchedule())>0)
      {
        alert('課表已被修改，請先按一下"行程修改確認"，儲存之前的修改');
        return;
      }
      $('#cover').show();

      $.ajax({
        url:"scheduleInfoHandler.php",
        type:"POST",
        data:{func: "increaseSchedulesPatch", instructor: selectedInstructor, park:selectedPark, periodStart: $('#dateStart').val(), periodEnd: $('#dateEnd').val()},
        dataType:"json",
        success: function(obj){
          console.log(obj);
          updateTableByMonth();
        },
        complete: function(){
        },
        error: function(){ console.log("error"); $('#cover').hide();}
      });

    });
  </script>
  <script type="text/javascript">
    clearUpdateSchedule();
    settingOnScreenSize();

    function settingOnScreenSize()
    {
      if(Foundation.MediaQuery.current=="small")
      {
        $('#StickySocialBar').css("top", "84%");
      }
        else
      {
        $('#StickySocialBar').css("top", "89%");
      }

      $('#schduleTable').css("margin-bottom", $('#StickySocialBar').height());
    }

    $(window).on('changed.zf.mediaquery', function() {
      settingOnScreenSize()
    });
    
  </script>
  </body>
</html>

