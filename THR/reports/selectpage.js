var xmlHttp

// window.alert("This");
// function loadAccordingToSCType() {
//     showPleaseWait();
//     var cmbSchoolType = $("#cmbSchoolType").val();
//     var cmbProvince = $("#cmbProvince").val();
//     var cmbDistrict = $("#cmbDistrict").val();
//     var cmbZone = $("#cmbZone").val();
//     var cmbDivision = $("#cmbDivision").val();
//     var txtLoggedUser = $("#txtLoggedUser").val();
//     var txtAccessLevel = $("#txtAccessLevel").val();
//     var cmbSchoolStatus = $("#cmbSchoolStatus").val();
//     // window.alert("This");
//     $.ajax({
//         url: "getpage.php",
//         type: "POST",
//         data: {
//             'r': "getDataAccordingToStatus",
//             cmbSchoolType: cmbSchoolType,
//             cmbProvince: cmbProvince,
//             cmbZone: cmbZone,
//             cmbDistrict: cmbDistrict,
//             cmbDivision: cmbDivision,
//             txtLoggedUser: txtLoggedUser,
//             txtAccessLevel: txtAccessLevel,
//             cmbSchoolStatus: cmbSchoolStatus
//         },
//         dataType: "json",
//         async: false,
//         success: function (data) {
//             // window.alert(data);
//             var dataSchool = data[0];
//             $('#cmbSchool').html(dataSchool);

//         }
//     });
//     hidePleaseWait();
//     // window.alert(data);
// }
// //Added load according to status by NHVithana
// function loadAccordingToSCStatus(){

//     showPleaseWait(); 
//     var cmbSchoolStatus = $("#cmbSchoolStatus").val(); // value of the cmbSchoolStatus variable

//     // alert("Hello! I am an alert box!!");

//     $.ajax({
//         url: "ajaxCall/teacherFilterDB.php",
//         type: "POST",
//         data: {
//             RequestType: "getDataAccordingToSCStatus",
//             cmbSchoolStatus: cmbSchoolStatus
//         },
//         dataType: "json",
//         async: false,
//         success: function(data) {
//             var dataSchool = data[0];
//             $('#InstCode').html(dataSchool);
//         }
//     });
//     hidePleaseWait();
// } 
// // End Load according to status

// function loadAccordingToProvince() {
//     // showPleaseWait();
//     var cmbSchoolType = $("#cmbSchoolType").val();
//     var cmbProvince = $("#cmbProvince").val();
//     var txtLoggedUser = $("#txtLoggedUser").val();
//     var txtAccessLevel = $("#txtAccessLevel").val();

//     $.ajax({
//         url: "ajaxCall/teacherFilterDB.php1",
//         type: "POST",
//         data: {
//             RequestType: "getDataAccordingToProvince",
//             cmbSchoolType: cmbSchoolType,
//             cmbProvince: cmbProvince,
//             txtLoggedUser: txtLoggedUser,
//             txtAccessLevel: txtAccessLevel
//         },
//         dataType: "json",
//         async: false,
//         success: function(data) {
//             var dataDistrict = data[0];
//             var dataZone = data[1];
//             var dataSchool = data[2];
//             var dataDivision = data[3];

//             $('#cmbDistrict').html(dataDistrict);
//             $('#cmbZone').html(dataZone);
//             $('#InstCode').html(dataSchool);
//             $('#cmbDivision').html(dataDivision);

//         }
//     });
//      if (cmbProvince != ""){
//         document.getElementById("chkSCType").disabled = true;
//         document.getElementById("chkSCType").checked = false;
//      }
//      else
//       document.getElementById("chkSCType").disabled = false;
//     // hidePleaseWait();
// }

// function loadAccordingToDistrict() {
//     showPleaseWait();
//     var cmbSchoolType = $("#cmbSchoolType").val();
//     var cmbProvince = $("#cmbProvince").val();
//     var cmbDistrict = $("#cmbDistrict").val();
//     var txtLoggedUser = $("#txtLoggedUser").val();
//     var txtAccessLevel = $("#txtAccessLevel").val();

//     $.ajax({
//         url: "ajaxCall/teacherFilterDB.php",
//         type: "POST",
//         data: {
//             RequestType: "getDataAccordingToDistrict",
//             cmbSchoolType: cmbSchoolType,
//             cmbProvince: cmbProvince,
//             cmbDistrict: cmbDistrict,
//             txtLoggedUser: txtLoggedUser,
//             txtAccessLevel: txtAccessLevel
//         },
//         dataType: "json",
//         async: false,
//         success: function(data) {
//             var dataDivision = data[0];
//             var dataSchool = data[1];
//             var dataZone = data[2];

//             $('#cmbZone').html(dataZone);
//             $('#cmbDivision').html(dataDivision);
//             $('#InstCode').html(dataSchool);
//         }
//     });
//     if (cmbDistrict != "") {
//         document.getElementById("chkProvince").disabled = true;
//         document.getElementById("chkProvince").checked = false;
//         document.getElementById("chkSCType").disabled = true;
//         document.getElementById("chkSCType").checked = false;
//     }
//     else {
//         document.getElementById("chkSCType").disabled = false;
//         document.getElementById("chkProvince").disabled = false;
//         document.getElementById("chkDistrict").disabled = false;
//     }
//     hidePleaseWait();
// }


// function loadAccordingToZone() {
//     showPleaseWait();
//     var cmbSchoolType = $("#cmbSchoolType").val();
//     var cmbProvince = $("#cmbProvince").val();
//     var cmbDistrict = $("#cmbDistrict").val();
//     var cmbZone = $("#cmbZone").val();
//     var txtLoggedUser = $("#txtLoggedUser").val();
//     var txtAccessLevel = $("#txtAccessLevel").val();

//     // window.alert('This');
//     $.ajax({
//         url: "ajaxCall/teacherFilterDB.php",
//         type: "POST",
//         data: {
//             RequestType: "getDataAccordingToZone",
//             cmbSchoolType: cmbSchoolType,
//             cmbProvince: cmbProvince,
//             cmbZone: cmbZone,
//             cmbDistrict: cmbDistrict,
//             txtLoggedUser: txtLoggedUser,
//             txtAccessLevel: txtAccessLevel
//         },
//         dataType: "json",
//         async: false,
//         success: function(data) {
//             var dataDivision = data[0];
//             var dataSchool = data[1];

//             $('#cmbDivision').html(dataDivision);
//             $('#InstCode').html(dataSchool);
//         }
//     });
//     if (cmbZone != "") {
//         document.getElementById("chkSCType").disabled = true;
//         document.getElementById("chkSCType").checked = false;
//         document.getElementById("chkProvince").disabled = true;
//         document.getElementById("chkProvince").checked = false;
//         document.getElementById("chkDistrict").disabled = true;
//         document.getElementById("chkDistrict").checked = false;        
//     }
//     else {
//         document.getElementById("chkSCType").disabled = false;
//         document.getElementById("chkProvince").disabled = false;
//         document.getElementById("chkDistrict").disabled = false;
//         document.getElementById("chkZone").disabled = false;
//     }
//     hidePleaseWait();

// }

// function loadAccordingToDivision() {
    
//     showPleaseWait();
//     var cmbSchoolType = $("#cmbSchoolType").val();
//     var cmbProvince = $("#cmbProvince").val();
//     var cmbDistrict = $("#cmbDistrict").val();
//     var cmbZone = $("#cmbZone").val();
//     var cmbDivision = $("#cmbDivision").val();
//     var txtLoggedUser = $("#txtLoggedUser").val();
//     var txtAccessLevel = $("#txtAccessLevel").val();
//     var cmbSchoolStatus = $("#cmbSchoolStatus").val();
 
    
//     $.ajax({
//         url: "ajaxCall/teacherFilterDB.php",
//         type: "POST",
//         data: {
//             RequestType: "getDataAccordingToSchool",
//             cmbSchoolType: cmbSchoolType,
//             cmbProvince: cmbProvince,
//             cmbZone: cmbZone,
//             cmbDistrict: cmbDistrict,
//             cmbDivision: cmbDivision,
//             txtLoggedUser: txtLoggedUser,
//             txtAccessLevel: txtAccessLevel,
//             cmbSchoolStatus: cmbSchoolStatus
//         },
//         dataType: "json",
//         async: false,
//         success: function(data) {
//             var dataSchool = data[0];
//             $('#InstCode').html(dataSchool);
//         }
//     });
//     if (cmbDivision != "") {
//         document.getElementById("chkSCType").disabled = true;
//         document.getElementById("chkSCType").checked = false;
//         document.getElementById("chkProvince").disabled = true;
//         document.getElementById("chkProvince").checked = false;
//         document.getElementById("chkDistrict").disabled = true;
//         document.getElementById("chkDistrict").checked = false;
//         document.getElementById("chkZone").disabled = true;
//         document.getElementById("chkZone").checked = false;
//     }
//     else {
//         document.getElementById("chkSCType").disabled = false;
//         document.getElementById("chkProvince").disabled = false;
//         document.getElementById("chkDistrict").disabled = false;
//         document.getElementById("chkZone").disabled = false;
//         document.getElementById("chkDivision").disabled = false;
//     }
//     hidePleaseWait();
    
// }

// function hidePleaseWait()
// {
//     setTimeout(function() {
//         $("#divPleasewait").remove();
//     }, 1000);

// }

// function showPleaseWait() {
// //    $('body').append($('<div/>', {
// //        id: 'divPleasewait',
// //        class: 'modal'
// //    }));

//     var $div = $('<div />').appendTo('body');
//     $div.attr('id', 'divPleasewait');
//     $div.attr('class', 'modal');
// }

// function generatePDF() {
//     /*showPleaseWait();
     
//      $.ajax({
//      url: "ajaxCall/generateTeacherPDFReport.php",
//      type: "POST",
//      data: $("#form1").serialize(),
//      dataType: "html",
//      async: false,
//      success: function() {
//      }
//      });
//      hidePleaseWait();
//      */
//     document.getElementById('form1').submit();

//     //var reportLink = "ajaxCall/generateTeacherPDFReport.php?";
//     //window.open(reportLink);
// }


// function submitForm(type) {
//     var flag = true;
//     var reportType = $('input[name="reportT"]:checked').val();
//     var action = "";

//     if (reportType == "DR" || reportType == "SR") {
//         if (type == "mail") {
//             var emailAdd = $("#txtemailAddress").val();

//             if (emailAdd == "" || emailAdd == "N/A") {
//                 flag = false;
//                 $("#txtemailAddress").val("");
//                 $("#hiddenVal").show();
//             }
//             else {
//                 var atpos = emailAdd.indexOf("@");
//                 var dotpos = emailAdd.lastIndexOf(".");
//                 if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= emailAdd.length)
//                 {
//                     alert("Not a valid e-mail address");
//                     return false;
//                 }
//             }
//             if (reportType == "DR") {
//                 action = "sendEmailDetailReport.php";
//             }
//             if (reportType == "SR") {
//                 action = "sendEmailSummaryReport.php";
//                 var valStatus = validateGroupBy();
//                 if (!valStatus)
//                     flag = false;
//             }
//         }
//         if (type == "report") {
//             if (reportType == "SR") {
//                 action = "generateSummaryPDF.php";
//                 var valStatus = validateGroupBy();
//                 if (!valStatus)
//                     flag = false;
//             }
//             // if (reportType == "DR") {
//                 action = "genpdf.php"
//             // }
//         }
//         if (type == "Qsave") {
//             action = "saveQuery.php"
//         }



//         if (flag) {
//             document.getElementById('form1').action = action;
//             document.getElementById('form1').submit();
//             document.getElementById("form1").reset();
            
//         }

//     }
//     else {
//         alert("Please select a report type");
//     }
// }
function loadAccordingToSCType() {
    showPleaseWait();
    var cmbSchoolType = $("#cmbSchoolType").val();
    var cmbProvince = $("#cmbProvince").val();
    var cmbDistrict = $("#cmbDistrict").val();
    var cmbZone = $("#cmbZone").val();
    var cmbDivision = $("#cmbDivision").val();
    var txtLoggedUser = $("#txtLoggedUser").val();
    var txtAccessLevel = $("#txtAccessLevel").val();
    var cmbSchoolStatus = $("#cmbSchoolStatus").val();
    // window.alert("This");
    $.ajax({
        url: "getpage.php",
        type: "POST",
        data: {
            'r': "getDataAccordingToStatus",
            cmbSchoolType: cmbSchoolType,
            cmbProvince: cmbProvince,
            cmbZone: cmbZone,
            cmbDistrict: cmbDistrict,
            cmbDivision: cmbDivision,
            txtLoggedUser: txtLoggedUser,
            txtAccessLevel: txtAccessLevel,
            cmbSchoolStatus: cmbSchoolStatus
        },
        dataType: "json",
        async: false,
        success: function (data) {
            // window.alert(data);
            var dataSchool = data[0];
            $('#cmbSchool').html(dataSchool);

        }
    });
    hidePleaseWait();
    // window.alert(data);
}
//Added load according to status by NHVithana
function loadAccordingToSCStatus(){

    showPleaseWait(); 
    var cmbSchoolStatus = $("#cmbSchoolStatus").val(); // value of the cmbSchoolStatus variable

    // alert("Hello! I am an alert box!!");

    $.ajax({
        url: "ajaxCall/teacherFilterDB.php",
        type: "POST",
        data: {
            RequestType: "getDataAccordingToSCStatus",
            cmbSchoolStatus: cmbSchoolStatus
        },
        dataType: "json",
        async: false,
        success: function(data) {
            var dataSchool = data[0];
            $('#InstCode').html(dataSchool);
        }
    });
    hidePleaseWait();
} 
function SaveQueryForm(qName) {
    var action = "index.php";
    document.getElementById('form1').action = action;
    $("#hidquerySave").val('QS');
    document.getElementById('hidqueryName').value = qName;

    document.getElementById('form1').submit();
    document.getElementById("form1").reset();

}
function disableCheckBox() {
    document.getElementById("chkProvince").disabled = true;
    document.getElementById("chkDistrict").disabled = true;
    document.getElementById("chkZone").disabled = true;
    document.getElementById("chkDivision").disabled = true;
}

function loadQNameDiv() {
    if ($('#rSaveQuery').is(":checked")){
        $("#hiddenQName").show();
        $("#genEmail").hide();
        $("#genPDF").hide();
        $("#divRptHedding").hide();
        $("#saveQuery").show();
    }
    else{
        document.getElementById("genPDF").value = "Print Report";
        $("#hiddenQName").hide();
        $("#genEmail").show();
        $("#genPDF").show();
        $("#saveQuery").hide();
        $("#divRptHedding").show();
    }
}

function hideEmailReport() {
    if ($('#rExportXLS').is(":checked"))
        $("#genEmail").hide();
    else
        $("#genEmail").show();
}

function unchekedBoxes() {
    document.getElementById("chkProvince").disabled = false;
    document.getElementById("chkProvince").checked = false;
    document.getElementById("chkDistrict").disabled = false;
    document.getElementById("chkDistrict").checked = false;
    document.getElementById("chkZone").disabled = false;
    document.getElementById("chkZone").checked = false;
    document.getElementById("chkDivision").disabled = false;
    document.getElementById("chkDivision").checked = false;

    // window.alert('chkDivision');
}
// window.alert('chkDivision');
function validateGroupBy() {
    var chkBoxGroupBy = document.getElementsByName("groupBy[]");
    var chkFlag = false;
    for (var i = 0; i < chkBoxGroupBy.length; i++) {

        if (chkBoxGroupBy[i].checked) {
            chkFlag = false;
            break;
        }
        else {
            chkFlag = true;
        }

    }
    if (chkFlag) {
        alert("Please tick the tick boxes for group by.");
        return false;
    }
    else
        return true;
}

function logoutForm() {
    var action = "../login.php?request=signOut";
    document.getElementById('form1').action = action;
    document.getElementById('form1').submit();
}

function disableBioCheckbox(obj) {
    var tbl = document.getElementById('tblMainBioDetails');
    var rowIndex = obj.parentNode.parentNode.rowIndex;
    if (tbl.rows[rowIndex].cells[4].childNodes[0].checked)
    {
        for (i = 1; i < tbl.rows.length; i++) {
            if (!tbl.rows[i].cells[4].childNodes[0].checked) {
                tbl.rows[i].cells[4].childNodes[0].disabled = true;
            }
        }
    }
    else {
        for (i = 1; i < tbl.rows.length; i++) {
            tbl.rows[i].cells[4].childNodes[0].disabled = false;
        }

    }

}

function show_district(str,icid,srch)
{ // alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
	xmlHttp=GetXmlHttpObject(show_districtTxt)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
	
} 


function show_districtTxt()
{ 
    // alert(xmlHttp.responseText);
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
    document.getElementById("divdistrict").innerHTML=xmlHttp.responseText;
    // alert('divdistrict'); 
    } 
    
}

function show_zone(str,icid,srch)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
	xmlHttp=GetXmlHttpObject(show_zoneTxt)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)

	loadAccordingToDistrict();
} 

function show_zoneTxt()
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
	document.getElementById("divzone").innerHTML=xmlHttp.responseText 
	} 
}


// var Division
function show_cences(str,icid,srch)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
	xmlHttp=GetXmlHttpObject(show_censesTxt)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
	// window.alert(srch);
	// window.value = icid
    // loadAccordingToDivision();
    
} 

function show_censesTxt()
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
	document.getElementById("divschool").innerHTML=xmlHttp.responseText
	} 
	// window.alert(xmlHttp.responseText);
}

//getSubCatID
function show_division(str,icid,srch)
{ //alert(icid);
var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
xmlHttp=GetXmlHttpObject(show_divisionTxt)
xmlHttp.open("GET", url , true)
xmlHttp.send(null)

// loadAccordingToZone();
} 

function show_divisionTxt()
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById("divdivision").innerHTML=xmlHttp.responseText 
} 
}

function show_divisionC(str,icid,srch)
{ //alert(icid);
var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
xmlHttp=GetXmlHttpObject(show_divisionCTxt)
xmlHttp.open("GET", url , true)
xmlHttp.send(null)

} 

function show_divisionCTxt()
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById("txt_divisionC").innerHTML=xmlHttp.responseText 
}
 
}

function show_changepw(str,icid,srch)
{ //alert(icid);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
	xmlHttp=GetXmlHttpObject(stateChangedshow_changepw)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
	
} 

function stateChangedshow_changepw() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("txt_changepw").innerHTML=xmlHttp.responseText 
	} 
}

function show_dealerDischangepw(str,icid,srch)
{ //alert(str);
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCID=" + icid + "&srch=" + srch	
	xmlHttp=GetXmlHttpObject(stateshow_dealerDischangepw)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 

function stateshow_dealerDischangepw()
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{ 
		document.getElementById("div_passwd").innerHTML=xmlHttp.responseText 
	} 
}

//chathura
//changeItemIdBySubCatIDAndCatID


function stateChangedshow_file()
{
    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
    {
        document.getElementById("showfile").innerHTML=xmlHttp.responseText
    }
}
//end files


//end og change room type

function GetXmlHttpObject(handler)
{ 
var objXmlHttp=null

if (navigator.userAgent.indexOf("Opera")>=0)
{
alert("This example doesn't work in Opera") 
return 
}
if (navigator.userAgent.indexOf("MSIE")>=0)
{ 
var strName="Msxml2.XMLHTTP"
if (navigator.appVersion.indexOf("MSIE 5.5")>=0)
{
strName="Microsoft.XMLHTTP"
} 
try
{ 
objXmlHttp=new ActiveXObject(strName)
objXmlHttp.onreadystatechange=handler 
return objXmlHttp
} 
catch(e)
{ 
alert("Error. Scripting for ActiveX might be disabled") 
return 
} 
} 
if (navigator.userAgent.indexOf("Mozilla")>=0)
{
objXmlHttp=new XMLHttpRequest()
objXmlHttp.onload=handler
objXmlHttp.onerror=handler 
return objXmlHttp
}
} 

function showContactTimer() {
	//alert('bar');
	var loader = document.getElementById('loadBar');
	loader.style.display = 'block';
	sentTimer = setTimeout("hideContactTimer()",2000);
}
function hideContactTimer () {
	var loader = document.getElementById('loadBar');
	loader.style.display = "none";
}

function show_cences_status(){
	var url="getpage.php?sid=" + Math.random() + "&q=" + str + "&iCIK=" + icik + "&srch=" + srch	
	xmlHttp=GetXmlHttpObject(show_censes_statusTxt)
	xmlHttp.open("GET", url , true)
    xmlHttp.send(null)

    // console.log(cmbSchoolStatus);
}

function show_censes_statusTxt(){
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("divschool").innerHTML=xmlHttp.responseText
	}
}


function loadAccordingToSCStatus() {
    showPleaseWait();
    var cmbSchoolType = $("#cmbSchoolType").val();
    var cmbProvince = $("#cmbProvince").val();
    var cmbDistrict = $("#cmbDistrict").val();
    var cmbZone = $("#cmbZone").val();
    var cmbDivision = $("#cmbDivision").val();
    var txtLoggedUser = $("#txtLoggedUser").val();
    var txtAccessLevel = $("#txtAccessLevel").val();
    var cmbSchoolStatus = $("#cmbSchoolStatus").val();

    //window.alert("cmbSchoolStatus");
    // console.log(cmbSchoolStatus);

    $.ajax({
        // url: "ajaxCall/teacherFilterDB.php",
        url: "getpage.php",
        type: "POST",
        data: { 
            'r': 'getDataAccordingToStatus', 
            cmbSchoolType: cmbSchoolType,
            cmbProvince: cmbProvince,
            cmbZone: cmbZone,
            cmbDistrict: cmbDistrict,
            cmbDivision: cmbDivision,
            txtLoggedUser: txtLoggedUser,
            txtAccessLevel: txtAccessLevel,
            cmbSchoolStatus: cmbSchoolStatus
        },
        dataType: "json",
        async: false,
        success: function (data) {
            // window.alert(data);
            var dataSchool = data[0];
            $('#cmbSchool').html(dataSchool);
        }
    });

    hidePleaseWait();

}

