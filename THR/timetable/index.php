<?php
require_once '../error_handle.php';
set_error_handler("errorHandler");
register_shutdown_function("shutdownHandler");
session_start();
if($_SESSION['NIC']=='') {
	header("Location: ../index.php") ;
	exit() ;
}
include '../db_config/DBManager.php';
$db = new DBManager();

$replace_data=array("'","/","!","&","*"," ","-","@",'"',"?",":","“","”");
$replace_data_new=array("'","/","!","&","*"," ","-","@",'"',"?",":","“","”",".");
$pageid=$_GET["pageid"];
$menu = $_GET['menu'];
$tpe = $_GET['tpe'];
$id = $_GET['id'];
$fm = $_GET['fm'];
$lng = $_GET['lng'];
$curPage = $_GET['curPage'];
$ttle = $_GET['ttle'];
$ttle = str_replace("_"," ",$ttle);
//str_replace(",","",$amount);

if($pageid=='') $pageid="0";


$nicNO = $_SESSION["NIC"];
$loggedPositionName=$_SESSION['loggedPositionName'];
$accLevel=$_SESSION["accLevel"];
/* if($accLevel!='3000'){
	header("Location:../index.php");
	exit();
} */
//$nicNO = '791231213V';
$querySaveVal = "";

$theamPath = "../cms/images/";
$theam = "theam1";
if($theam == "theam1"){
	$theamMenuFontColor = "#0888e2";
	$theamMenuButtonColor = "#3973b1";
}
if($theam == "theam2"){
	$theamMenuFontColor = "#d98813";
	$theamMenuButtonColor = "#3a2a07";
}
if($theam == "theam3"){
	$theamMenuFontColor = "#c2379b";
	$theamMenuButtonColor = "#8839b1";
}


$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$exUrl=explode('/',$url);
$folderLocation=count($exUrl)-2;
$ModuleFolder=$exUrl[$folderLocation];

if (isset($_POST["FrmSubmit"])) {
    $InstCode=$_REQUEST['InstCode'];
	$_SESSION['loggedSchoolSearch']=$InstCode;
	
	if($accLevel=='1000'){
		header("Location:myTimetable-13.html");
	}else if($accLevel=='3000'){
		header("Location:grade-1.html");
	}else{
		header("Location:printTimeTable-7.html");
	}
	exit();
}
if($accLevel=='1000' || $accLevel=='3000'){
	$CenCodex=$_SESSION['loggedSchool'];
	
	$detailSql="SELECT        CD_CensesNo.CenCode, CD_CensesNo.DistrictCode, CD_CensesNo.ZoneCode, CD_CensesNo.DivisionCode, CD_Districts.ProCode
FROM            CD_CensesNo INNER JOIN
                         CD_Districts ON CD_CensesNo.DistrictCode = CD_Districts.DistCode
WHERE        (CD_CensesNo.CenCode = N'$CenCodex')";
	$stmt = $db->runMsSqlQuery($detailSql);
	$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
	
	
	$ProCodex=trim($row['ProCode']);
	$DistrictCodex=trim($row['DistrictCode']);
	$ZoneCodex=trim($row['ZoneCode']);
	$DivisionCodex=trim($row['DivisionCode']);
	
	$disaTxt="disabled";
}else{
	$disaTxt="";	
}

?>

<!DOCTYPE html>
<html>
    <head>

        <link rel="icon" 
              type="image/png" 
              href="images/favicon.png">


        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>National Education Management Information System | Ministry of Education Sri Lanka</title>
        <!--<link href="css/emis.css" rel="stylesheet" type="text/css">-->
        <link href="css/emis.css" rel="stylesheet" type="text/css">
        <link href="../css/mStyle.css" rel="stylesheet" type="text/css" />
        <link href="css/category_tab.css" rel="stylesheet" type="text/css" />
        <link href="../cms/css/main_menu1.css" rel="stylesheet" type="text/css" />
        <link href="../cms/css/screen.css" rel="stylesheet" type="text/css" />
        <link href="../cms/css/grid_style.css" rel="stylesheet" type="text/css" />
        <link href="../cms/css/flexigrid.css" rel="stylesheet" type="text/css"/>

        <style type="text/css">

            /*menu style*/



            .mcib_top{
                 width:960px;
                height:33px;
                float:left;
                padding:1px 10px 1px 10px;
                font-size:12px;
                color:#FFF;
                font-weight:bold;
                line-height:34px;
                background:url(<?php echo $theamPath ?><?php echo $theam ?>/backgrounds/block_inner_back.png);
            }
            .link1{
	color:<?php echo $theamMenuFontColor ?>;
        cursor: pointer;
	}


        </style>
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/jquery.tabify.js" type="text/javascript" charset="utf-8"></script>
        <script src="js/FilterDB.js"  language="javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#menu').tabify();
                $('#menu2').tabify();
            });
        </script>
        <script type="text/javascript">
            // IE9 fix
            if (!window.console) {
                var console = {
                    log: function() {
                    },
                    warn: function() {
                    },
                    error: function() {
                    },
                    time: function() {
                    },
                    timeEnd: function() {
                    }
                }
            }
        </script>
		
<script src="selectpage.js" type="text/javascript"></script>
<link type='text/css' href='../assets/css/dashboard.css' rel='stylesheet' media='screen'/>
<link rel="stylesheet" href="../assets/css/jquery-ui.css">

<script src="../assets/js/jquery-latest.min.js" type="text/javascript"></script>
<script src="../assets/js/jquery-ui.js"></script>
<script src="../assets/js/back/script.js"></script>

<style>
    .fields_errors{
        border-color: rgba(229, 103, 23, 0.8);
        box-shadow: 0 1px 1px rgba(229, 103, 23, 0.075) inset, 0 0 8px rgba(229, 103, 23, 0.6);
        outline: 0 none;
    }

</style>

    </head>
    <body>
        <!-- Begin Page Content -->
        
            <div class="container">
                <!--<div class="logOut" style="background-color: #212121;">
                    <div align="right" style="margin-top:10px;">
                        <label style="text-align:right; margin-right:30px; width:auto; font-family:Calibri; color: #FFFFFF;"><?php echo $_SESSION["fullName"]; ?></label>
                        <input type="button" class="logOutButton" align="right" name="" id="" value="Log Out" onClick="logoutForm('mail');"/>
                    </div>

                </div>-->

               <!-- <div class="containerHeader" style="text-align:center; background:url(images/menu_back.gif) repeat-x" >
                    <div align="right" style="margin-top:10px;">
                        <label style="text-align:right; margin-right:30px; width:auto; font-family:Calibri; color: #FFFFFF;"><b><?php echo $_SESSION["fullName"]; ?></b></label>
                        <input type="button" class="logOutButton" align="right" name="" id="" value="Log Out" onClick="logoutForm('mail');"/>

                    </div>
                    <img src="images/header.png" width="960" style="margin-top:0px;" />
                </div>
               -->
              <form id="form1" name="form1" action="" method="POST">  
              <div id="header_outer" style="background:url(<?php echo $theamPath ?><?php echo $theam ?>/backgrounds/menu_back.gif) repeat-x">
	<div id="header_inner">
      <div id="header_top">
       	<div class="header_top_left">&nbsp;&nbsp; </div>
            <div class="header_top_right">
           		<div id="admin_button" style="cursor:default;"><a href="#" id="admin_link" style="cursor:default;"><span style="cursor:default;"><?php echo $loggedPositionName;?></span></a></div>
               <!-- <div id="mail_button"><a href="#"></a><div id="mail_alert" class="alert">05</div></div>-->
               <div id="user_welcome">Welcome <?php echo $_SESSION["fullName"]; ?>, &nbsp;&nbsp; <span class="link1" onClick="logoutForm('mail');">Logout?</span></div>
            </div>
        </div>
        <div id="header_logo" style="margin-top:0px;"><img src="../images/header.png" width="960" height="150" /></div>
       
        <div style="clear:both"></div>
	</div>
</div>
			  </form>

                <div id="main_content_outer">
                    <div id="main_content_inner">

                        <div class="main_content_inner_block">
                            <?php include('../mainmenu.php')?>
                            <div class="mcib_middle">

                                <div class="containerHeaderOne">

                                     
                                    
								<div style="width:960px; height:auto; float:left; margin-left:10px;">
                                <div class="main_content_inner_block">
        <div class="mcib_middle1" style="width: 500px; margin-left: 220px; font-weight: bold;">
        	<form method="post" action="" name="frmSave" id="frmSave" enctype="multipart/form-data" onSubmit="return check_form(frmSave);">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="30" colspan="2" align="center" style="border-bottom: 1px; border-bottom-style: solid; font-size: 14px;"><strong>Search School</strong></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" valign="top"><table width="100%" cellspacing="1" cellpadding="1">
                    <tr>
                      <td width="27%">Province</td>
                      <td width="2%">:</td>
                      <td width="71%"><select class="select2a_n" id="ProCode" name="ProCode" onchange="Javascript:show_district('districtList', this.options[this.selectedIndex].value, '');" <?php echo $disaTxt ?>>
                        <!--<option value="">Select Province</option>-->
                        <?php
                            $sql = "SELECT ProCode,Province FROM CD_Provinces order by Province asc";
                            $stmt = $db->runMsSqlQuery($sql);
                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
								$DistCoded=trim($row['ProCode']);
								$DistNamed=$row['Province'];
								$seltebr="";
								if($DistCoded==$ProCodex){
									$seltebr="selected";
								}
                                echo "<option value=\"$DistCoded\" $seltebr>$DistNamed</option>";
                            }
                            ?>
                      </select></td>
                    </tr>
                    <tr>
                      <td>District</td>
                      <td>:</td>
                      <td><div id="txt_district"><select class="select2a_n" id="DistrictCode" name="DistrictCode" onchange="Javascript:show_zone('zonelist', this.options[this.selectedIndex].value, '');" <?php echo $disaTxt ?>>
                        <option value="">District Name</option>
                        <?php
                            $sql = "SELECT DistCode,DistName FROM CD_Districts where ProCode='$ProCodex' order by DistName asc";
                            $stmt = $db->runMsSqlQuery($sql);
                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
								$DistCoded=trim($row['DistCode']);
								$DistNamed=$row['DistName'];
								$seltebr="";
								if($DistCoded==$DistrictCodex){
									$seltebr="selected";
								}
                                echo "<option value=\"$DistCoded\" $seltebr>$DistNamed</option>";
                            }
                            ?>
                      </select></div></td>
                    </tr>
                    <tr>
                      <td>Zone</td>
                      <td>:</td>
                      <td><div id="txt_zone">
                        <select class="select2a_n" id="ZoneCode" name="ZoneCode" onchange="Javascript:show_division('divisionList', this.options[this.selectedIndex].value, document.frmSave.DistrictCode.value);" <?php echo $disaTxt ?>>
                          <option value="">Zone Name</option>
                          <?php
                            $sql = "SELECT CenCode,InstitutionName FROM CD_Zone where DistrictCode='$DistrictCodex' order by InstitutionName asc";
                            $stmt = $db->runMsSqlQuery($sql);
                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
								$DSCoded=trim($row['CenCode']);
								$DSNamed=$row['InstitutionName'];
								$seltebr="";
								if($DSCoded==$ZoneCodex){
									$seltebr="selected";
								}
                                echo "<option value=\"$DSCoded\" $seltebr>$DSNamed</option>";
                            }
                            ?>
                        </select>
                      </div></td>
                    </tr>
                    <tr>
                      <td>Division</td>
                      <td>:</td>
                      <td><div id="txt_division">
                        <select class="select2a_n" id="DivisionCode" name="DivisionCode" onchange="Javascript:show_cences('censesList', this.options[this.selectedIndex].value, document.frmSave.DistrictCode.value);" <?php echo $disaTxt ?>>
                          <option value="">Division Name</option>
                          <?php
                            $sql = "SELECT CenCode,InstitutionName FROM CD_Division where DistrictCode='$DistrictCodex' and ZoneCode='$ZoneCodex' order by InstitutionName asc";
                            $stmt = $db->runMsSqlQuery($sql);
                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
								$DSCoded=trim($row['CenCode']);
								$DSNamed=$row['InstitutionName'];
								$seltebr="";
								if($DSCoded==$DivisionCodex){
									$seltebr="selected";
								}
                                echo "<option value=\"$DSCoded\" $seltebr>$DSNamed</option>";
                            }
                            ?>
                        </select>
                      </div></td>
                    </tr>
                    <tr>
                      <td>School</td>
                      <td>:</td>
                      <td><div id="txt_showInstitute">
                        <select class="select2a" id="InstCode" name="InstCode">
                          <option value="">School Name</option>
                          <?php $DivisionCode="abc";
                            $sql = "SELECT [InstType]
      ,[CenCode]
      ,[InstitutionName]
      ,[DistrictCode]
      ,[RecordLog]
      ,[ZoneCode]
      ,[DivisionCode]
      ,[IsNationalSchool]
      ,[SchoolType]
  FROM [dbo].[CD_CensesNo] where CenCode='$CenCodex'
  order by InstitutionName";
                            $stmt = $db->runMsSqlQuery($sql);
                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
								$CenCode=trim($row['CenCode']);
								$InstitutionName=addslashes($row['InstitutionName']);
								$seltebr="";
								if($CenCode==$CenCodex){
									$seltebr="selected";
								}
                                echo "<option value=\"$CenCode\" $seltebr>$InstitutionName $CenCode</option>";
                            }
                            ?>
                        </select>
                      </div></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td><input name="FrmSubmit" type="submit" id="FrmSubmit" style="background-image: url(../cms/images/saveform.jpg); width:98px; height:26px; background-color:transparent; border:none;" value="" /></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                    <td width="50%" valign="top">&nbsp;</td>
                    <td width="50%" valign="top">&nbsp;</td>
                </tr>
            </table>
            </form>
            <script>

    $("#frmSave").submit(function(event) {
        var dialogStatus = false;//NIC, Title, SurnameWithInitials, FullName, ZoneCode
        var InstCode = trim($("#InstCode").val());
      
        //$("#vUserName").attr('class', 'fields_errors');
        if (InstCode == "") {
            $("#InstCode").attr('class', 'input2_error');
            dialogStatus = true;
        }

        if (dialogStatus) {
            $("#dialog").dialog({
                modal: true
            });
            event.preventDefault();
        }

    });

    function numbersonly(e) {
        var unicode = e.charCode ? e.charCode : e.keyCode
        if (unicode != 8) { //if the key isn't the backspace key (which we should allow)
            if (unicode < 48 || unicode > 57) //if not a number
                return false //disable key press
        }
    }

</script>
        </div>
</div>
                                </div>
                                </div>
                            </div>




                            <div class="mcib_bottom"></div>
                        </div>





                    </div>
                </div>

                <!--/ container-->
                <!-- End Page Content -->
            </div>
       
    </body>
</html>