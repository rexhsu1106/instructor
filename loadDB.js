
var gEvaluationItems = null;
var gAbilityList = null;
var gRatingRecords = null;
var gSelfRatingRecords = null;
var gLessonRecordByID = null;
var gLessonRecordByInstructor = null;
var gMemebersBasicInfo = null;
var gStudentsInfo = null;

  function loadEvaluationItems(type, cb) {
    //console.log("loadEvaluationTable");
//    if(typeof(Storage) !== "undefined")
//      gEvaluationItems = JSON.parse(sessionStorage.getItem("EvaluationTable"));
//    else
//      gEvaluationItems = null;  //use server session
  
    if(1)//gEvaluationItems == null)
    {
      //console.log("reload park list");
      $.ajax({
        url:"evaluationHandler.php",
        type:"POST",
        data:{func: "loadEvaluations", type: type},
        dataType:"json",
        success: function(types){
          console.log(types);
          gEvaluationItems = types;
          if(gEvaluationItems)
          {
            if(cb && typeof(cb) === "function")
              cb(gEvaluationItems);
//            if(typeof(Storage) !== "undefined")
//              sessionStorage.setItem("EvaluationTable", JSON.stringify(gEvaluationItems));
//            else
//              ; //user server session
          }
        },
        complete: function(){ },
        error: function(){ console.log("error"); }
      });
    }
    else
    {
      if (cb && typeof(cb) === "function")
        cb(gEvaluationItems);
    }
  }

  function loadAbilityList(type, cb) {
      $.ajax({
        url:"evaluationHandler.php",
        type:"POST",
        data:{func: "loadAbilityList", type: type},
        dataType:"json",
        success: function(types){
          console.log(types);
          gAbilityList = types;
          if(gAbilityList)
          {
            if(cb && typeof(cb) === "function")
              cb(gAbilityList);
          }
        },
        complete: function(){ },
        error: function(){ console.log("error"); }
      });
  }

  function loadRatingRecords(studentID, cb) {
      $.ajax({
        url:"evaluationHandler.php",
        type:"POST",
        data:{func: "loadRatingRecords", studentID: studentID},
        dataType:"json",
        success: function(types){
          console.log(types);
          gRatingRecords = types;
          if(gRatingRecords)
          {
            if(cb && typeof(cb) === "function")
              cb(gRatingRecords);
          }
        },
        complete: function(){ },
        error: function(){ console.log("error"); }
      });
  }

  function loadSelfRatingRecords(studentID, cb) {
      $.ajax({
        url:"evaluationHandler.php",
        type:"POST",
        data:{func: "loadSelfRatingRecord", studentID: studentID},
        dataType:"json",
        success: function(types){
          console.log('self rating');
          console.log(types);
          gSelfRatingRecords = types;
          if(gSelfRatingRecords)
          {
            if(cb && typeof(cb) === "function")
              cb(gSelfRatingRecords);
          }
        },
        complete: function(){ },
        error: function(){ console.log("error"); }
      });
  }

  function loadRatingRecordsForOneLesson(type, studentID, lessonID, cb) {
      $.ajax({
        url:"evaluationHandler.php",
        type:"POST",
        data:{func: "loadRatingRecordsForOneLesson", type: type, studentID: studentID, lessonID: lessonID},
        dataType:"json",
        success: function(types){
          console.log(types);
          if(types)
          {
            if(cb && typeof(cb) === "function")
              cb(types);
          }
        },
        complete: function(){ },
        error: function(){ console.log("error"); }
      });
  }

  function loadLessonRecordsByID(type, lessonID, cb) {
      $.ajax({
        url:"evaluationHandler.php",
        type:"POST",
        data:{func: "loadLessonsByIdx", type: type, lessonID: lessonID},
        dataType:"json",
        success: function(types){
          console.log(types);
          gLessonRecordByID = types;
          if(gLessonRecordByID)
          {
            if(cb && typeof(cb) === "function")
              cb(gLessonRecordByID);
          }
        },
        complete: function(){ },
        error: function(){ console.log("error"); }
      });
  }

  function loadMultiLessonRecords(lessonIDs, cb) {
      $.ajax({
        url:"evaluationHandler.php",
        type:"POST",
        data:{func: "loadMultiLessons", lessonIDs: lessonIDs},
        dataType:"json",
        success: function(types){
          console.log(types);
          if(types)
          {
            if(cb && typeof(cb) === "function")
              cb(types);
          }
        },
        complete: function(){ },
        error: function(){ console.log("error"); }
      });
  }

  function loadLessonRecordsByInstructor(type, period, instructor, cb) {
      $.ajax({
        url:"evaluationHandler.php",
        type:"POST",
        data:{func: "loadLessonsByInstructor", type: type, period: period, instructor: instructor},
        dataType:"json",
        success: function(types){
          console.log(types);
          gLessonRecordByInstructor = types;
          if(gLessonRecordByInstructor)
          {
            if(cb && typeof(cb) === "function")
              cb(gLessonRecordByInstructor);
          }
        },
        complete: function(){ },
        error: function(){ console.log("error"); }
      });
  }
  
  function loadLessonRecordsByStudent(type, period, studentID, cb) {
      $.ajax({
        url:"evaluationHandler.php",
        type:"POST",
        data:{func: "loadLessonsByStudent", type: type, period: period, studentID: studentID},
        dataType:"json",
        success: function(types){
          console.log(types);
          if(types)
          {
            if(cb && typeof(cb) === "function")
              cb(types);
          }
        },
        complete: function(){ },
        error: function(){ console.log("error"); }
      });
  }

  function loadMultiMembersBasicInfo(memberIDS, cb) {
      $.ajax({
        url:"memberHandler.php",
        type:"POST",
        data:{func: "loadMultiMembersBasicInfo", memberIDs: memberIDS},
        dataType:"json",
        success: function(types){
          console.log(types);
          gMemebersBasicInfo = types;
          if(gMemebersBasicInfo)
          {
            if(cb && typeof(cb) === "function")
              cb(gMemebersBasicInfo);
          }
        },
        complete: function(){ },
        error: function(){ console.log("error"); }
      });
  }

  function loadMembersInfoByEmail(email, cb) {
      $.ajax({
        url:"memberHandler.php",
        type:"POST",
        data:{func: "loadMembersInfoByEmail", email: email},
        dataType:"json",
        success: function(info){
          console.log(info);
          if(info)
          {
            if(cb && typeof(cb) === "function")
              cb(info);
          }
        },
        complete: function(){ },
        error: function(){ console.log("error"); }
      });
  }

  function loadSkiDiyMembersInfo(studentsInfo, cb) {
      $.ajax({
        url:"memberHandler.php",
        type:"POST",
        data:{func: "loadSkiDiyMembersInfo", studentsInfo:studentsInfo},
        dataType:"json",
        success: function(info){
          console.log(info);
          gStudentsInfo = info;
          if(info)
          {
            if(cb && typeof(cb) === "function")
              cb(gStudentsInfo);
          }
        },
        complete: function(){ },
        error: function(){ console.log("error"); }
      });
  }

  function loadSkiDiyMembersNotSelfEva(cb) {
      $.ajax({
        url:"memberHandler.php",
        type:"POST",
        data:{func: "loadSkiDiyMembersNotSelfEva"},
        dataType:"json",
        success: function(info){
          if(info)
          {
            if(cb && typeof(cb) === "function")
              cb(info);
          }
        },
        complete: function(){ },
        error: function(){ console.log("error"); }
      });
  }

  function EvaluationLessonAndRecordMatchError(cb) {
      $.ajax({
        url:"memberHandler.php",
        type:"POST",
        data:{func: "EvaluationLessonAndRecordMatchError"},
        dataType:"json",
        success: function(info){
          if(info)
          {
            if(cb && typeof(cb) === "function")
              cb(info);
          }
        },
        complete: function(){ },
        error: function(){ console.log("error"); }
      });
  }

  function loadSkiDiyALLMembers(cb) {
      $.ajax({
        url:"memberHandler.php",
        type:"POST",
        data:{func: "loadSkiDiyALLMembers"},
        dataType:"json",
        success: function(info){
          if(info)
          {
            if(cb && typeof(cb) === "function")
              cb(info);
          }
        },
        complete: function(){ },
        error: function(){ console.log("error"); }
      });
  }

  function loadSkiDiyInfoNotEvaluated(cb) {
      $.ajax({
        url:"memberHandler.php",
        type:"POST",
        data:{func: "loadSkiDiyInfoNotEvaluated"},
        dataType:"json",
        success: function(info){
          if(info)
          {
            if(cb && typeof(cb) === "function")
              cb(info);
          }
        },
        complete: function(){ },
        error: function(){ console.log("error"); }
      });
  }

  function loadSkiDiyAllEvaluationInfo(cb) {
      $.ajax({
        url:"memberHandler.php",
        type:"POST",
        data:{func: "loadSkiDiyAllEvaluationInfo"},
        dataType:"json",
        success: function(info){
          if(info)
          {
            if(cb && typeof(cb) === "function")
              cb(info);
          }
        },
        complete: function(){ },
        error: function(){ console.log("error"); }
      });
  }
  
