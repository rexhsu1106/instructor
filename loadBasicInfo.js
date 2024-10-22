
  var gParkList = null;
  var gInstructorList = null;
  var gParkFeeList = null

  var gWeekDayChinese = ['(日)', '(一)', '(二)', '(三)', '(四)', '(五)', '(六)'];

  var LOCKED_DAYS_NORMAL = 3;
  var LOCKED_DAYS_COMBO = 3;

  var bookingCurrency = "";

  //avoid user use private browsing that leave no space for session Storage
  try {
    // try to use localStorage
    sessionStorage.test = 2;        
  } catch (e) {
    // there was an error so...
    alert('您正在使用私密瀏覽，這會影響網站部分功能的正常使用\n請關閉私密瀏覽模式，重新開啟網頁');
  }

  Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
      if (obj.hasOwnProperty(key)) size++;
    }
    return size;
  };

  function loadParkFee(cb)
  {
    if(typeof(Storage) !== "undefined")
      gParkFeeList = JSON.parse(sessionStorage.getItem("parkFeeList"));
    else
      gParkFeeList = null;  //use server session

    if(gParkFeeList == null)
    {
      $.ajax({
        url:"/courseInfoHandler.php",
        type:"POST",
        data:{func: "getParkFee"},
        dataType:"json",
        success: function(types){
          gParkFeeList = types;
          if(gParkFeeList)
          {
            if (cb && typeof(cb) === "function")
              cb(gParkFeeList);
            if(typeof(Storage) !== "undefined")
              sessionStorage.setItem("parkFeeList", JSON.stringify(gParkFeeList));
            else
              ; //user server session
          }
        },
        complete: function(){ },
        error: function(){ console.log("error"); }
      })
    }
    else
    {
      //console.log("use stored park Fee list");
      if (cb && typeof(cb) === "function")
        cb(gParkFeeList);
    }
  }

  function loadParkList(cb) {
    if(typeof(Storage) !== "undefined")
      gParkList = JSON.parse(sessionStorage.getItem("parkList"));
    else
      gParkList = null;  //use server session
  
    if(gParkList == null)
    {
      //console.log("reload park list");
      $.ajax({
        url:"basicInfoHandler.php",
        type:"POST",
        data:{func: "parkList"},
        dataType:"json",
        success: function(types){
          gParkList = types;
          if(gParkList)
          {
            if (cb && typeof(cb) === "function")
              cb(gParkList);
            if(typeof(Storage) !== "undefined")
              sessionStorage.setItem("parkList", JSON.stringify(gParkList));
            else
              ; //user server session
          }
        },
        complete: function(){ },
        error: function(){ console.log("error"); }
      })
    }
    else
    {
      //console.log("use stored park list");
      if (cb && typeof(cb) === "function")
        cb(gParkList);
    }
  }

  function loadInstructorList(cb) {
    if(typeof(Storage) !== "undefined")
      gInstructorList = JSON.parse(sessionStorage.getItem("instructorList"));
    else
      gInstructorList = null;  //use server session
  
    if(gInstructorList == null)
    {
      //console.log("reload instructor list");
      $.ajax({
        url:"/courseInfoHandler.php",
        type:"POST",
        data:{func: "instructorList"},
        dataType:"json",
        success: function(types){
          gInstructorList = types;
          if(gInstructorList) {
            if (cb && typeof(cb) === "function")
              cb(gInstructorList);
            if(typeof(Storage) !== "undefined")
              sessionStorage.setItem("instructorList", JSON.stringify(gInstructorList));
            else
              ; //user server session
          }
        },
        complete: function(){ },
        error: function(){ console.log("error"); }
      });
    }
    else
    {
      //console.log("use stored instructor list");
      if (cb && typeof(cb) === "function")
        cb(gInstructorList);
    }
  }

  function getParkCname(park, parkList)
  {
    if(parkList[park] && parkList[park]!=="undefined" && parkList[park]['cname'] && parkList[park]['cname']!=="undefined")
      return parkList[park]['cname'];
    else
      return park;
  }

  function getYYMMDDString(date)
  {
    var dateType = new Date(date);
    var dd = dateType.getDate();
    if(dd<10){dd='0'+dd;}
    var mm = dateType.getMonth()+1; //January is 0!
    if(mm<10){mm='0'+mm;}
    var yy = dateType.getFullYear();
    return yy+'-'+mm+'-'+dd;
  }

  //we need the selected date beyond an specific date and utill 1 year later mostly. 
  function checkDateValid(date, lockDays)
  {
    if(0)console.log("date before valid: "+date);

    var valid = false;
    var openDay = new Date(); //set today as the earliest open date
    
    openDay.setDate(openDay.getDate()+parseInt(lockDays)); //plus few days as the open date 
    openDay.setHours(0, 0, 0, 0); //make sure time is from 00:00:00:00

    var maxDay = new Date();
    maxDay.setFullYear(maxDay.getFullYear()+1); //maximum is 1 year later

    if(date.getTime() < openDay.getTime())
    {
      date.setTime(openDay.getTime());
    }
    else if(date.getTime() > maxDay.getTime())
    {
      date.setTime(maxDay.getTime());
    }
    else
      valid = true;

    if(0)console.log("date after valid: "+date);

    return valid;
  }

  function checkBookingCurrency(currency) //check before booking
  {
    if(typeof(Storage) !== "undefined")
    {
      bookingCurrency = JSON.parse(sessionStorage.getItem("bookingCurrency"));
      //bookingNo = Number(sessionStorage.lastBookingNo)+1;
    }

    if( countBookingCourses()==0 || !bookingCurrency)
      bookingCurrency = currency;

    if(typeof(Storage) !== "undefined"){
      sessionStorage.setItem("bookingCurrency", JSON.stringify(bookingCurrency));
    }

    if(currency != bookingCurrency)
      return false;
    else
      return true;
  }

  function getBookingCurrency()
  {
    var currency;
    if(typeof(Storage) !== "undefined")
      currency = JSON.parse(sessionStorage.getItem("bookingCurrency"));

    return currency;
  }

  function storeBookingInfo(park, instructor, type, date, timeslot, studentNum, scheduleID)
  {
    console.log(park, instructor, type, date, timeslot, studentNum, scheduleID);
    var combo = getComboBookingInfo();
    if(Object.size(combo) > 0)
      return false;

    var bookingInfo = null;

    if(typeof(Storage) !== "undefined")
    {
      bookingInfo = JSON.parse(sessionStorage.getItem("bookingInfo"));
      //bookingNo = Number(sessionStorage.lastBookingNo)+1;
    }
    else
      ; //use sever session

    if(bookingInfo == null)
      bookingInfo = {};

    bookingInfo[scheduleID] = {};

    bookingInfo[scheduleID]['park'] = park;
    bookingInfo[scheduleID]['instructor'] = instructor;
    bookingInfo[scheduleID]['type'] = type;
    bookingInfo[scheduleID]['date'] = date;
    bookingInfo[scheduleID]['timeslot'] = timeslot;
    bookingInfo[scheduleID]['studentNum'] = studentNum;
    bookingInfo[scheduleID]['arranged'] = 0;

    if(typeof(Storage) !== "undefined"){
      sessionStorage.setItem("bookingInfo", JSON.stringify(bookingInfo));
    }
    else
      ; //use sever session

    return true;
  }

  function updateBookingStudentNum(scheduleID, num)
  {
    var bookingInfo = null;

    if(typeof(Storage) !== "undefined")
    {
      bookingInfo = JSON.parse(sessionStorage.getItem("bookingInfo"));
      //bookingNo = Number(sessionStorage.lastBookingNo)+1;
    }
    else
      ; //use sever session

    if(bookingInfo!=null && bookingInfo[scheduleID])
    {
      bookingInfo[scheduleID]['studentNum'] = num;
    }

    if(typeof(Storage) !== "undefined"){
      sessionStorage.setItem("bookingInfo", JSON.stringify(bookingInfo));
    }
    else
      ; //use sever session
  }

  //check if the date of courses in booking list is beyond LOCKED_DAYS+today
  function checkBookingInfo()
  {
    var bookingInfo = null;
    var valid = true;

    //for normal course
    if(typeof(Storage) !== "undefined")
      bookingInfo = JSON.parse(sessionStorage.getItem("bookingInfo"));
    else
      bookingInfo = {}; //use server session

    for(key in bookingInfo) {
      if (bookingInfo.hasOwnProperty(key)){
        var date = moment(bookingInfo[key]['date']).toDate();
        if(date.getHours()!=0)
        {
          alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
          window.location.href = 'index.php';
        }
        if(!checkDateValid(date, LOCKED_DAYS_NORMAL))
        {
          valid = false;
          delete bookingInfo[key];
        }
      }
    }

    if(typeof(Storage) !== "undefined"){
      sessionStorage.setItem("bookingInfo", JSON.stringify(bookingInfo));
    }
    else
      ; //use sever session


    //for combo course
    if(typeof(Storage) !== "undefined")
      bookingInfo = JSON.parse(sessionStorage.getItem("comboBookingInfo"));
    else
      bookingInfo = {}; //use server session

    for(key in bookingInfo) {
      if (bookingInfo.hasOwnProperty(key)){
        var dateTime = bookingInfo[key]['time'][0].split(" ");
        var date = moment(dateTime[0]).toDate();
        if(date.getHours()!=0)
        {
          alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
          window.location.href = 'index.php';
        }
        if(!checkDateValid(date, LOCKED_DAYS_COMBO))
        {
          valid = false;
          delete bookingInfo[key];
        }
      }
    }

    if(typeof(Storage) !== "undefined"){
      sessionStorage.setItem("comboBookingInfo", JSON.stringify(bookingInfo));
    }
    else
      ; //use sever session

    return valid;
  }

  function getBookingInfo()
  {
    var bookingInfo;
    
    if(typeof(Storage) !== "undefined")
      bookingInfo = JSON.parse(sessionStorage.getItem("bookingInfo"));
    else
      bookingInfo = {}; //use server session

    //console.log(bookingInfo);
    return bookingInfo;
  }

  function getSortedBookingKey()
  {
    var bookingInfo;
    
    if(typeof(Storage) !== "undefined")
      bookingInfo = JSON.parse(sessionStorage.getItem("bookingInfo"));
    else
      bookingInfo = {}; //use server session

    //console.log("sorted: "+bookingInfo);

    var scheduleID = {};
    var sortedScheduleID = {};
    var sortedArray = [];
    var sortedBookingInfo = {};
    var timeArray = new Array();
    var loopCnt = 0;

    if(bookingInfo)
    {
      for(key in bookingInfo)
      {
        if(bookingInfo.hasOwnProperty(key))
        {
          var sortDate = moment(bookingInfo[key]['date']).toDate();
          if(sortDate.getHours()!=0)
          {
            alert("因為時區的關係，暫時無法提供服務，請您直接聯繫管理員，謝謝～～");
            window.location.href = 'index.php';
          }
          var timeString = bookingInfo[key]['timeslot'].split(":");
          sortDate.setHours(timeString[0], timeString[1]);
          var index = sortDate.getTime();

          $loopCnt = 0;
          while(jQuery.inArray(index, timeArray)>=0 && loopCnt<10000)
          {
            index++;
            loopCnt++;
          }
          timeArray.push(index);
          scheduleID[index] = key;
        }
      }
    }

    timeArray.sort()

    for(var i=0; i<timeArray.length; i++)
    {
      sortedScheduleID[timeArray[i]] = scheduleID[timeArray[i]];
    }

    for(key in sortedScheduleID)
      sortedArray.push(sortedScheduleID[key]);

    return sortedArray;
  }

  function deleteBookingElement(scheduleID)
  {
    var bookingInfo;

    if(typeof(Storage) !== "undefined")
    {
      bookingInfo = JSON.parse(sessionStorage.getItem("bookingInfo"));
      //bookingNo = Number(sessionStorage.lastBookingNo)+1;
    }
    else
      ; //use sever session

    if( scheduleID && bookingInfo)
    {
      delete bookingInfo[scheduleID];
    }
    //console.log("after delete "+bookingInfo);

    if(typeof(Storage) !== "undefined"){
      sessionStorage.setItem("bookingInfo", JSON.stringify(bookingInfo));
    }
    else
      ; //use sever session
  }

  function clearAllBookingElement()
  {
    var bookingInfo = {};

    if(typeof(Storage) !== "undefined"){
      sessionStorage.setItem("bookingInfo", JSON.stringify(bookingInfo));
    }
    else
      ; //use sever session
  }

  function storeCourseSelectInfo(chooseBy, classType, park, instructor, studentNum, startDate)
  {
    console.log("course info: "+chooseBy+","+classType+","+park+","+instructor+","+studentNum+","+startDate);
    
    var info = null;

    if(typeof(Storage) !== "undefined")
    {
      info = JSON.parse(sessionStorage.getItem("courseSelectInfo"));
      //bookingNo = Number(sessionStorage.lastBookingNo)+1;
    }
    else
      ; //use sever session

    if(info == null)
      info = {};

    info['chooseBy'] = chooseBy;
    info['classType'] = classType;
    info['park'] = park;
    if(instructor!="pending")
      info['instructor'] = instructor;
    info['studentNum'] = studentNum;

    if(startDate && typeof(startDate) !== "undefined")
    {
      var dd = startDate.getDate();
      var mm = startDate.getMonth()+1; //January is 0!
      var yyyy = startDate.getFullYear();
      if(dd<10){dd='0'+dd;}
      if(mm<10){mm='0'+mm;}
      info['startDate'] = yyyy+'-'+mm+'-'+dd;
    }

    if(typeof(Storage) !== "undefined"){
      sessionStorage.setItem("courseSelectInfo", JSON.stringify(info));
    }
    else
      ; //use sever session
  }

  function getCourseSelectInfo()
  {
    var info;
    
    if(typeof(Storage) !== "undefined")
      info = JSON.parse(sessionStorage.getItem("courseSelectInfo"));
    else
      info = null; //use server session

    return info;
  }

  
  function storeComboBookingInfo(park, instructor, type, time, studentNum, bookedStudentNum, maxStudentNum, orderNo, oidx, arragned)
  {
    console.log(park, instructor, type, time, studentNum, orderNo);
    var bookingInfo = null;

    if(typeof(Storage) !== "undefined")
    {
      bookingInfo = JSON.parse(sessionStorage.getItem("comboBookingInfo"));
      //bookingNo = Number(sessionStorage.lastBookingNo)+1;
    }
    else
      ; //use sever session

    if(bookingInfo == null)
      bookingInfo = {};

    var normal = getBookingInfo();
    if(Object.size(normal) > 0)
      return "other";
    else if(Object.size(bookingInfo) > 0)
      return "combo";

    bookingInfo[orderNo] = {};

    bookingInfo[orderNo]['park'] = park;
    bookingInfo[orderNo]['instructor'] = instructor;
    bookingInfo[orderNo]['type'] = type;
    bookingInfo[orderNo]['time'] = new Array();
    bookingInfo[orderNo]['time'] = JSON.parse(time);
    bookingInfo[orderNo]['studentNum'] = studentNum;
    bookingInfo[orderNo]['bookedStudentNum'] = bookedStudentNum;
    bookingInfo[orderNo]['maxStudentNum'] = maxStudentNum;
    bookingInfo[orderNo]['oidx'] = oidx;
    bookingInfo[orderNo]['arranged'] = arragned;

    if(typeof(Storage) !== "undefined"){
      sessionStorage.setItem("comboBookingInfo", JSON.stringify(bookingInfo));
    }
    else
      ; //use sever session

    return true;
  }

  function updateComboBookingStudentNum(orderNo, num)
  {
    console.log(orderNo, num);
    var bookingInfo = null;

    if(typeof(Storage) !== "undefined")
    {
      bookingInfo = JSON.parse(sessionStorage.getItem("comboBookingInfo"));
      //bookingNo = Number(sessionStorage.lastBookingNo)+1;
    }
    else
      ; //use sever session

    if(bookingInfo!=null && bookingInfo[orderNo])
    {
      bookingInfo[orderNo]['studentNum'] = num;
    }

    if(typeof(Storage) !== "undefined"){
      sessionStorage.setItem("comboBookingInfo", JSON.stringify(bookingInfo));
    }
    else
      ; //use sever session
  }

  function getComboBookingInfo()
  {
    var bookingInfo;
    
    if(typeof(Storage) !== "undefined")
      bookingInfo = JSON.parse(sessionStorage.getItem("comboBookingInfo"));
    else
      bookingInfo = null; //use server session

    //console.log("combo: "+bookingInfo);
    return bookingInfo;
  }

  function deleteComboBookingElement(orderNo)
  {
    var bookingInfo;

    if(typeof(Storage) !== "undefined")
    {
      bookingInfo = JSON.parse(sessionStorage.getItem("comboBookingInfo"));
      //bookingNo = Number(sessionStorage.lastBookingNo)+1;
    }
    else
      ; //use sever session

    if( orderNo && bookingInfo)
    {
      delete bookingInfo[orderNo];
    }
    //console.log("after delete "+bookingInfo);

    if(typeof(Storage) !== "undefined"){
      sessionStorage.setItem("comboBookingInfo", JSON.stringify(bookingInfo));
    }
    else
      ; //use sever session
  }

  function clearAllComboBookingElement()
  {
    var bookingInfo = {};

    if(typeof(Storage) !== "undefined"){
      sessionStorage.setItem("comboBookingInfo", JSON.stringify(bookingInfo));
    }
    else
      ; //use sever session
  }

  function storeNoticeReadRecord(notice, boolean)
  {
    var record = null;

    if(typeof(Storage) !== "undefined")
    {
      record = JSON.parse(sessionStorage.getItem("noticeRecord"));
    }
    else
      ; //use sever session

    if(record == null)
      record = {};

    record[notice] = boolean;

    if(typeof(Storage) !== "undefined"){
      sessionStorage.setItem("noticeRecord", JSON.stringify(record));
    }
    else
      ; //use sever session
  }

  function getNoticeReadRecord(notice)
  {
    var record;

    if(typeof(Storage) !== "undefined")
      record = JSON.parse(sessionStorage.getItem("noticeRecord"));
    else
      record = null; //use sever session

    if(!record || !record[notice] || typeof(record[notice])==="undefined")
      return false;
    else
      return record[notice];
  }

  function checkStudentNumValid(park, instructor, studentNum, parkList, instructorList)
  {
    if(typeof(parkList[park])==="undefined" || typeof(parkList[park]['maxStudentNum'])==="undefined" || typeof(instructorList[instructor])==="undefined" || typeof(instructorList[instructor]['maxStudentNum'])==="undefined")
      return "error";

    if(studentNum > parkList[park]['maxStudentNum'])
      return "park";
    else if(studentNum > instructorList[instructor]['maxStudentNum'])
      return "instructor";
    else
      return "valid";
  }

  function getMaxStudentNum(park, instructor, parkList, instructor)
  {
    if(typeof(parkList[park])==="undefined" || typeof(parkList[park]['maxStudentNum'])==="undefined" || typeof(instructorList[instructor])==="undefined" || typeof(instructorList[instructor]['maxStudentNum'])==="undefined")
      return 0;

    if(instructor=="pending")
      return parkList[park]['maxStudentNum'];
    else
    {
      if(parkList[park]['maxStudentNum'] < instructorList[instructor]['maxStudentNum'])
        return parkList[park]['maxStudentNum'];
      else
        return instructorList[instructor]['maxStudentNum'];
    }
  }

  function storeOrderInfo(order, oidx)
  {
    var orderInfo = order;
    orderInfo['oidx'] = oidx;
    if(typeof(Storage) !== "undefined"){
      sessionStorage.setItem("orderInfo", JSON.stringify(orderInfo));
    }
    else
      ; //use sever session
  }

  function getOrderInfo(order)
  {
    var orderInfo = null;

    if(typeof(Storage) !== "undefined"){
      orderInfo = JSON.parse(sessionStorage.getItem("orderInfo"));
    }
    else
      ; //use sever session

    return orderInfo;
  }

  function CalCoursePayment(bookings, parkFeeList, instructorList)
  {
    var courseCost = 0; //cost not include insurance
    var insuranceTotal = 0; //insurance via summarizing all student numbers of all courses 
    var deposit = 0;
    var studentVolumn = {};
    var currency = null;
    var levelFee = 0;

    var dateArray = {};

    for(var key in bookings)
    {
        if(bookings[key]['instructor'].toLowerCase()=='eden')
        {
          if(dateArray[bookings[key]['date']]==null || dateArray[bookings[key]['date']]==="undefined")
          {
            dateArray[bookings[key]['date']] = 'half';
          }
          else
          {
            dateArray[bookings[key]['date']] = 'whole';
          }
        }
    }

    for(var key in bookings) {
      if (bookings.hasOwnProperty(key)){

        var parkName = bookings[key]['park'];

        if(!studentVolumn[bookings[key]['studentNum']])
        {
          studentVolumn[bookings[key]['studentNum']] = {};
          studentVolumn[bookings[key]['studentNum']]['sum']=1;
          studentVolumn[bookings[key]['studentNum']]['park'] = parkName;
        }
        else
        {
          studentVolumn[bookings[key]['studentNum']]['sum']++;
        }

        if(parkName=='taipei' && bookings[key]['studentNum']<= 1) //台北滑雪學校，低消兩位學生
        {
          courseCost+=parkFeeList[parkName]['base'] + 2*parkFeeList[parkName]['unit'];
        }
        else if(bookings[key]['instructor']=='eden' && dateArray[bookings[key]['date']]=='half')
        {
            courseCost+= 1.5*(parkFeeList[parkName]['base'] + bookings[key]['studentNum']*parkFeeList[parkName]['unit']);
        }
        else
        {
          courseCost+=parkFeeList[parkName]['base'] + bookings[key]['studentNum']*parkFeeList[parkName]['unit'];
        }

        insuranceTotal+=bookings[key]['studentNum']*parkFeeList[parkName]['insurance'];

        if(bookings[key]['instructor']=='eden' && dateArray[bookings[key]['date']]=='half')
          deposit+=1.5*parkFeeList[parkName]['deposit'];
        else
          deposit+=parkFeeList[parkName]['deposit'];

        currency = parkFeeList[parkName]['currency'];

        if((currency=='JPY' || currency=='jpy') && bookings[key]['arranged']==0)
          levelFee+=parseInt(instructorList[bookings[key]['instructor']]['levelFee']);
      }
    }

    var insurance = 0;
    //if(currency=='JPY')
    {
      for(var key in studentVolumn){
        if(studentVolumn.hasOwnProperty(key))
        {
          insurance += key*parkFeeList[studentVolumn[key]['park']]['insurance'];
        }
      }
    }

    var totalCost = courseCost + insuranceTotal + levelFee;
    var discount = insuranceTotal - insurance;
    deposit += insurance;
    var payment = courseCost + levelFee + insurance - deposit; //totalCost - discount - deposit

    return {totalCost:totalCost, discount:discount, payment:payment, deposit:deposit, insurance: insurance, levelFee: levelFee};
  }

  function CalComboCoursePayment(booking, parkFeeList, instructorList)
  {
    var comboClassCost = 0;
    var comboDeposit = 0;
    var comboInsuranceTotal = 0;
    var comboInsurance = 0;
    var combolevelFee = 0;

    for(var key in booking) {
      if (booking.hasOwnProperty(key)){
        var parkName = booking[key]['park'];
        if(Array.isArray(booking[key]['time']))
          var classNum = booking[key]['time'].length;
        else
          var classNum = Object.size(booking[key]['time']);
        var selectedStudentNum = parseInt(booking[key]['studentNum']);
        var bookedStudentNum = parseInt(booking[key]['bookedStudentNum']);
        comboClassCost+= 
          parseInt(parkFeeList[parkName]['base']*selectedStudentNum*classNum/(selectedStudentNum+bookedStudentNum)+
          selectedStudentNum*classNum*parkFeeList[parkName]['unit']);

        comboInsuranceTotal+=selectedStudentNum*classNum*parkFeeList[parkName]['insurance'];
        comboInsurance+=selectedStudentNum*parkFeeList[parkName]['insurance'];
        comboDeposit+=classNum*parkFeeList[parkName]['deposit'];

        currency = parkFeeList[parkName]['currency'];
        if((currency=='JPY' || currency=='jpy') && booking[key]['arranged']==0)
          combolevelFee+=parseInt(instructorList[booking[key]['instructor']]['levelFee']*selectedStudentNum*classNum/(selectedStudentNum+bookedStudentNum));
      }
    }

    var totalCost=(comboClassCost+comboInsuranceTotal+combolevelFee);
    var discount=(comboInsuranceTotal-comboInsurance);
    var deposit=comboDeposit+comboInsurance;
    var payment=(comboClassCost+combolevelFee-comboDeposit); //totalCost - discount - deposit

    var remainder = payment%1000;
    if(remainder!=0)
    {
      deposit+=remainder;
      payment-=remainder;
    }

    return {totalCost:totalCost, discount:discount, payment:payment, deposit:deposit, insurance: comboInsurance, levelFee: combolevelFee};
  }

  function countBookingCourses()
  {
    var booking = getBookingInfo();
    var combo = getComboBookingInfo();
    var comboClassNum = 0;
    for(key in combo)
    {
      if(combo.hasOwnProperty(key))
      {
        if(combo[key]['time'] && Array.isArray(combo[key]['time']))
          comboClassNum += combo[key]['time'].length;
      }
    }
    return (Object.size(booking)+comboClassNum);
  }

  function updateSchedules(id, park, type, status)
  {
    var schedules = null;

    if(typeof(Storage) !== "undefined")
    {
      schedules = JSON.parse(sessionStorage.getItem("schedules"));
    }
    else
      ; //use sever session

    if(schedules == null)
      schedules = {};

    //console.log(schedules[id]);

    if((schedules[id] == null) || (schedules[id]==="undefined"))
    {
      schedules[id] = {};
      schedules[id]['park'] = park;
      schedules[id]['type'] = type
      schedules[id]['status'] = status;
    }
    else
    {
      if(status=="update" || schedules[id]['status']=="update")
        schedules[id]['status'] = status;
      else
        delete schedules[id];
    }

    if(typeof(Storage) !== "undefined"){
      sessionStorage.setItem("schedules", JSON.stringify(schedules));
    }
    else
      ; //use sever session

    console.log(schedules);

    if(schedules[id] == null)
      return false;
    else
      return true;
  }

  function deleteSchedules(id)
  {
    var schedules = null;

    if(typeof(Storage) !== "undefined")
    {
      schedules = JSON.parse(sessionStorage.getItem("schedules"));
    }
    else
      ; //use sever session

    if(schedules != null && schedules[id] != null)
    {
      delete schedules[id];
    }

    if(typeof(Storage) !== "undefined"){
      sessionStorage.setItem("schedules", JSON.stringify(schedules));
    }
    else
      ; //use sever session
  }

  function getUpdateSchedule()
  {
    if(typeof(Storage) !== "undefined")
    {
      return JSON.parse(sessionStorage.getItem("schedules"));
    }
    else
      return null;
  }

  function clearUpdateSchedule()
  {
    sessionStorage.setItem("schedules", JSON.stringify({}));
  }