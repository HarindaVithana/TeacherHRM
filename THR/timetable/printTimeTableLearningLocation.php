<link href="../cms/css/screen.css" rel="stylesheet" type="text/css" />
<?php 
include('js/common.js.php'); 
include('js/ajaxloadpage.js.php'); 
include('myfunction.php');
?>
<?php
/* $array = array( 'a', 'a', 'a', 'a', 'b', 'b', 'c' );
print_r($array);
$count = count(array_keys($array, 'b', true));
echo "Found $count letter a's.";
echo "<br><br>";
$value="SB1101,SB1205,SB1205,SB1205,SB1501,SB1601,SB1401,SB1101,SB1101,SB1401,SB1101,SB1501,SB1501,SB1601,SB1401,SB1501,SB1401,SB1501,SB1401,SB1205,SB1601,SB1101,SB1205,SB1205,SB1601,SB1401,SB1401,SB1101,SB1501,SB1212,SB1401,SB1101,SB1601,SB1501,SB1501,SB1212,SB1212,SB1601,SB1205,SB1101";
$arrddd=explode(',',$value);
print_r($arrddd);
echo $count = count(array_keys($arrddd, 'SB1101', true));
echo "<br><br>"; */

        ?>
<?php 

$msg="";
//$tblNam="TG_SchoolGenerateTT_Temp";
if(isset($_POST["FrmSubmit"])){	
	//echo "hi";
	$SchoolID=$_REQUEST['SchoolID'];
	$ClassID=$_REQUEST['ClassID'];
	$GradeID=$_REQUEST['GradeID'];
	$newArraySuffled=array();
	$countTotal="SELECT * FROM TG_SchoolTimeTable where SchoolID='$SchoolID' and ClassID='$ClassID' and GradeID='$GradeID'";
	$TotaRows=$db->rowCount($countTotal);
    if($TotaRows==0){ //echo "hi";   	
        $sqlNoOfPeriod="SELECT        TG_SchoolGrade.GradeTitle, TG_SchoolGrade.NumberOfPeriods, TG_SchoolGradeMaster.ID
FROM            TG_SchoolGrade INNER JOIN
                         TG_SchoolGradeMaster ON TG_SchoolGrade.ID = TG_SchoolGradeMaster.GradeID
						 WHERE TG_SchoolGradeMaster.ID='$GradeID'";//TG_SchoolGradeMaster.SchoolID='$loggedSchool' and 
        $stmt = $db->runMsSqlQuery($sqlNoOfPeriod);
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $NumberOfPeriods=$row['NumberOfPeriods'];            
        }
        
$totalRows=5*$NumberOfPeriods;	

//$sqlSubject="SELECT SubjectID,PeriodsPerWeek from TG_SchoolSubjectMaster where SchoolID='$SchoolID' and GradeID='$GradeID'";
$sqlSubject="SELECT        TG_SchoolSubjectMaster.SubjectID, CD_Subject.SubjectName, TG_SchoolSubjectMaster.PeriodsPerWeek
FROM            TG_SchoolSubjectMaster INNER JOIN
                         CD_Subject ON TG_SchoolSubjectMaster.SubjectID = CD_Subject.SubCode
where TG_SchoolSubjectMaster.GradeID='$GradeID'";//TG_SchoolSubjectMaster.SchoolID='$SchoolID' and 

$stmtSub = $db->runMsSqlQuery($sqlSubject);
$subArry=array("default");
while ($row = sqlsrv_fetch_array($stmtSub, SQLSRV_FETCH_ASSOC)) {
   $SubjectID=$row['SubjectID'];  
   $PeriodsPerWeek=$row['PeriodsPerWeek'];
   for($t=0;$t<$PeriodsPerWeek;$t++){
       $subArry[]=$SubjectID;
    }
	
}
function custom_shuffle($my_array = array()) {
	  $copy = array();
	  $newArry=array("default");
	  while (count($my_array)) {
		  unset($my_array[0]);
		// takes a rand array elements by its key
		$element = array_rand($my_array);//echo "<br>";
		if($element!=0){
			$currentKey=count($newArry);
			$previous2K=$currentKey-1;
			if($newArry[$currentKey]==$my_array[$element] and $newArry[$previous2K]==$my_array[$element]){
				
			}else{
			$newArry[]=$my_array[$element];
			unset($my_array[$element]);
			}
		}
		// assign the array and its value to an another array
		//$copy[$element] = $my_array[$element];
		//delete the element from source array
		
	  }
	  return $newArry;
	}
	//echo "<br>";
	//print_r(custom_shuffle($subArry));
	$newArraySuffled=custom_shuffle($subArry);
//print_r($subArry);

//print_r($newArraySuffled);

/*for($i=1;$i<$totalRows;$i++){
    
    //echo $SubjectID;echo "<br>"; 
    $queryGradeSave="INSERT INTO $tblNam
           (SchoolID,GradeID,ClassID,SubjectID,FieldID)
     VALUES
           ('$SchoolID','$GradeID','$ClassID','$SubjectID','1')";
    //$db->runMsSqlQuery($queryGradeSave);
}*/

        
	}
}
if(isset($_POST["SaveTT"])){
	$SchoolID=$_REQUEST['SchoolID'];
	$ClassID=$_REQUEST['ClassID'];
	$GradeID=$_REQUEST['GradeID'];
        	
        $sqlNoOfPeriod="SELECT        TG_SchoolGrade.GradeTitle, TG_SchoolGrade.NumberOfPeriods, TG_SchoolGradeMaster.ID
FROM            TG_SchoolGrade INNER JOIN
                         TG_SchoolGradeMaster ON TG_SchoolGrade.ID = TG_SchoolGradeMaster.GradeID
						 WHERE TG_SchoolGradeMaster.SchoolID='$loggedSchool' and TG_SchoolGradeMaster.ID='$GradeID'";
        $stmt = $db->runMsSqlQuery($sqlNoOfPeriod);
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $NumberOfPeriods=$row['NumberOfPeriods'];            
        }
        
	$totalRows=5*$NumberOfPeriods;
	$Monday=$NumberOfPeriods;
	$Tuesday=$NumberOfPeriods*2;
	$Wednesday=$NumberOfPeriods*3;
	$Thursday=$NumberOfPeriods*4;
	$Friday=$NumberOfPeriods*5;
	
	for($i=1;$i<$totalRows+1;$i++){
		$fieldTag="TT".$i;
		
		if($i<=$Monday)$day="Monday";
		if($i<=$Tuesday and $i>$Monday)$day="Tuesday";
		if($i<=$Wednesday and $i>$Tuesday)$day="Wednesday";
		if($i<=$Thursday and $i>$Wednesday)$day="Thursday";
		if($i<=$Friday and $i>$Thursday)$day="Friday";
		//echo $_REQUEST['TT1'];
		$PeriodNumberM=$i%$NumberOfPeriods;
		if($PeriodNumberM==0)$PeriodNumberM=$NumberOfPeriods;
		$ttValue=$_REQUEST[$fieldTag];
		
		$sqlInsertTT="INSERT INTO TG_SchoolTimeTable
           (SchoolID,GradeID,ClassID,SubjectID,FieldID,TeacherID,PeriodNumber,Day)
     VALUES
           ('$SchoolID','$GradeID','$ClassID','$ttValue','$fieldTag','','$PeriodNumberM','$day')";
		$db->runMsSqlQuery($sqlInsertTT);
		
		$groupCheck=getGroupSubjects($SchoolID,$GradeID,$ttValue);
		$groupCode=explode(",",$groupCheck);
			for($p=0;$p<count($groupCode);$p++){
				$codeGroup=$groupCode[$p];
				if($codeGroup!=''){
					$groubSub=$fieldTag."_".$p;//echo "<br>";
					//$ttValueGroup=$_REQUEST[$groubSub];
					
					$sqlInsertTT="INSERT INTO TG_SchoolTimeTable
           (SchoolID,GradeID,ClassID,SubjectID,FieldID,TeacherID,PeriodNumber,Day)
     VALUES
           ('$SchoolID','$GradeID','$ClassID','$codeGroup','$groubSub','','$PeriodNumberM','$day')";
		$db->runMsSqlQuery($sqlInsertTT);
					//echo "<br>*";echo $groupCubName=getSubjectNameCommon($codeGroup);
					//echo "<input type=\"hidden\" id=\"$groubSub\" name=\"$groubSub\" value=\"$codeGroup\">";
				}
			}
		
		
	}	
	
}

$params1 = array(
	array($GradeID, SQLSRV_PARAM_IN),
	array($SchoolID, SQLSRV_PARAM_IN)
);

$SubjectID=1;
$params2 = array(
    array($SchoolID, SQLSRV_PARAM_IN),
    array($GradeID, SQLSRV_PARAM_IN),
    array($ClassID, SQLSRV_PARAM_IN),
    array($SubjectID, SQLSRV_PARAM_IN)
);
 /* $sql = "{call SP_TG_TimeTableTemp( ?, ?, ? ,? ,?)}";
                      $stmt = $db->runMsSqlQuery($sql, $params2); */
					  //exit();
//print_r($params2);
?>


<div class="main_content_inner_block">
    <form method="post" action="" name="frmSave" id="frmSave" enctype="multipart/form-data" onSubmit="return check_form(frmSave);">
        <?php if($msg!=''){//if($_SESSION['success_update']!='' || $_SESSION['success_update']!=''){  ?>   
   	  <div class="mcib_middle1">
          <div class="mcib_middle_full">
          <div class="form_error"><?php echo $msg;echo $_SESSION['success_update'];$_SESSION['success_update']="";?><?php echo $_SESSION['fail_update'];$_SESSION['fail_update']="";?></div>
        </div>
        <?php }//}?>
        <table width="945" cellpadding="0" cellspacing="0">
        <tr>
                  <td width="59%" valign="top"><img src="../cms/images/class-active.png" width="98" height="26" />&nbsp;<a href="printTimeTableTeacher-8.html"><img src="../cms/images/learning-location.jpg" width="98" height="26" /></a></td>
        <td width="41%" valign="top">&nbsp;</td>
          </tr>
			  <tr>
                  <td valign="top"><table width="100%" cellspacing="2" cellpadding="2">
                    <tr>
                      <td>School :</td>
                      <td> <select class="select2a" id="SchoolID" name="SchoolID">
                            <!--<option value="">School Name</option>-->
                            <?php
                            $sql = "SELECT [InstType]
      ,[CenCode]
      ,[InstitutionName]
      ,[DistrictCode]
      ,[RecordLog]
      ,[ZoneCode]
      ,[DivisionCode]
      ,[IsNationalSchool]
      ,[SchoolType]
  FROM [dbo].[CD_CensesNo]
  where CenCode='$loggedSchool'
  order by InstitutionName";
                            $stmt = $db->runMsSqlQuery($sql);
                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                echo '<option value=' . $row['CenCode'] . '>' . $row['InstitutionName'] . '</option>';
                            }
                            ?>
                      </select></td>
                    </tr>
                    <tr>
                      <td>Grade :</td>
                      <td><select class="select2a_new" id="GradeID" name="GradeID" onchange="filterClass();">
                            <option value="">-Select-</option>
                            <?php
                            $sql = "SELECT        TG_SchoolGrade.GradeTitle, TG_SchoolGrade.NumberOfPeriods, TG_SchoolGradeMaster.ID
FROM            TG_SchoolGrade INNER JOIN
                         TG_SchoolGradeMaster ON TG_SchoolGrade.ID = TG_SchoolGradeMaster.GradeID
						 WHERE TG_SchoolGradeMaster.SchoolID='$loggedSchool'";
                            $stmt = $db->runMsSqlQuery($sql);
                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                $selectd="";
                                $GradeIDThis=$row['ID'];
                                $GradeTitle=$row['GradeTitle'];
                                if($GradeID==$row['ID'])$selectd="selected";
                                echo "<option value=\"$GradeIDThis\" $selectd>$GradeTitle</option>";
                            }
                            ?>
                        </select>
                        <input type="hidden" name="cat" value="<?php echo $cat; ?>" />
                        <input type="hidden" name="AED" value="<?php echo $AED; ?>" />
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="hidden" name="tblName" value="<?php echo $tablename; ?>" />
                        <input type="hidden" name="redirect_page" value="<?php echo $redirect_page ?>" />
                        <input type="hidden" name="vID" value="<?php echo $id; ?>" />
                        <input type="hidden" name="mode" value="<?php echo $mode; ?>" />
                        <input type="hidden" name="mainID" value="<?php echo $primaryid; ?>" /></td>
                    </tr>
                     <tr>
                      <td>Class :</td>
                      <td><?php //echo $ClassID;//print_r($params1);?>
                      <select id="ClassID" name="ClassID" class="select2a_new">
                        
                        <?php $sql = "{call SP_TG_GetClassOfGrade( ?, ?)}";
    $dataSchool = "<option value=\"\">-Select-</option>";
    $stmt = $db->runMsSqlQuery($sql, $params1);
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$ClassIDOp=$row['ClassID'];
		$IDop=$row['ID'];
		$selTExt="";
		if($IDop==$ClassID)$selTExt="selected";
        echo $dataSchool= "<option value=\"$IDop\" $selTExt>$ClassIDOp</option>";
    }?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input name="FrmSubmit" type="submit" id="FrmSubmit" style="background-image: url(../cms/images/generate.jpg); width:98px; height:26px; background-color:transparent; border:none;" value="" />
                     <?php if($TotaRows==0){ ?> <input name="SaveTT" type="submit" id="SaveTT" style="background-image: url(../cms/images/complete.jpg); width:98px; height:26px; background-color:transparent; border:none;" value="" /><?php }?></td>
                    </tr>
                    </table>
        </td>
        <td width="41%" valign="top"><table width="100%" cellspacing="2" cellpadding="2">
                <tr>
                  <td width="43%" align="left" valign="top">&nbsp;</td>
                  <td width="57%">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
          </table></td>
          </tr>
                <tr>
                    <td colspan="2"><table width="100%" cellspacing="2" cellpadding="2">
                <tr>
                  <td width="64%" align="left" valign="top" style="color:#C00; font-weight:bold;"><?php if($TotaRows!=0){ echo "Already generated !"; }?></td>
                  <td width="4%" style="background-color:#33FFCC;border:1px solid #CCC; ">&nbsp;</td>
                  <td width="15%">Less than the limit</td>
                  <td width="4%" style="background-color:#F8C7D0;border:1px solid #CCC; ">&nbsp;</td>
                  <td width="13%">Over the limit</td>
                </tr>
                
          </table></td>
                  
                </tr>
                <tr>
                    <td colspan="2" bgcolor="#999999"><table width="100%" cellspacing="1" cellpadding="1">
                      <tr>
                        <td width="15%" height="30" bgcolor="#CCCCCC">&nbsp;</td>
                        <td width="17%" align="center" bgcolor="#CCCCCC"><strong>Monday</strong></td>
                        <td width="17%" align="center" bgcolor="#CCCCCC"><strong>Tuesday</strong></td>
                        <td width="17%" align="center" bgcolor="#CCCCCC"><strong>Wednesday</strong></td>
                        <td width="17%" align="center" bgcolor="#CCCCCC"><strong>Thursday</strong></td>
                        <td width="17%" align="center" bgcolor="#CCCCCC"><strong>Friday</strong>
                            <input type="hidden" id="test" name="test" value="">
                            <input type="hidden" id="test2" name="test" value="">
                            <input type="hidden" id="subArr" name="subArr" value="<?php echo $newArraySuffled?>"></td>
                      </tr>
                      <?php 
					  //print_r($params2);
                     $sql = "{call SP_TG_TimeTableTemp( ?, ?, ? , ?)}";
                      $stmt = $db->runMsSqlQuery($sql, $params2); 
                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                            //if ($sqZone == trim($row['CenCode']))
                                //echo '<option selected="selected" value=' . $row['CenCode'] . '>' . $row['Zone'] . '</option>';
                           // else
                               // echo '<option value=' . $row['CenCode'] . '>' . $row['Zone'] . '</option>';
                        }
                      
                      for($i=1;$i<$NumberOfPeriods+1;$i++){?>
                      <tr>
                        <td height="30" bgcolor="#CCCCCC"><strong>&nbsp;&nbsp;Period <?php echo $i ?></strong><input type="hidden" name="PeriodNumber<?php echo $i ?>" value="<?php echo $i ?>" /></td>
                        <td bgcolor="#FFFFFF"><?php //echo $i ?><input type="hidden" name="" value="" /> 
                           <?php 
						    $valueField=$i;
							$thisSubCode=$newArraySuffled[$valueField];
						   ?>
                            <select name="TT<?php echo $i ?>" class="select2a_new" id="TT<?php echo $i ?>" onchange="checkOverload(<?php echo $totalRows?>)">
                                <option value="">-Select-</option>
                                <?php
                               
                                $stmtSub = $db->runMsSqlQuery($sqlSubject);
                                
                                while ($row = sqlsrv_fetch_array($stmtSub, SQLSRV_FETCH_ASSOC)) {
                                   $SubjectID=$row['SubjectID'];
                                   $SubjectName=$row['SubjectName'];
                                   $selectedOk="";
                                   if($SubjectID==$thisSubCode)$selectedOk="selected";
                                   echo "<option value=\"$SubjectID\" $selectedOk>$SubjectName - $SubjectID</option>";
                                }
                                ?>
                        </select>
                        <?php //echo $thisSubCode;
						    /* $groupCheck=getGroupSubjects($SchoolID,$GradeID,$thisSubCode);
							$groupCode=explode(",",$groupCheck);
								for($p=0;$p<count($groupCode);$p++){
									$codeGroup=trim($groupCode[$p]);
									if($codeGroup!=''){
										$groubSub="TT".$valueField."_".$p;
										echo "<br>*";echo $groupCubName=getSubjectNameCommon($codeGroup);
									echo "<input type=\"hidden\" id=\"$groubSub\" name=\"$groubSub\" value=\"$codeGroup\">";
									}
								} */
						?>
                        </td>
                        <td bgcolor="#FFFFFF"><?php 
						$valueField=$i+1*$NumberOfPeriods;
						$thisSubCode=$newArraySuffled[$valueField];
						 ?>
                            <select name="TT<?php echo $i+$NumberOfPeriods; ?>" class="select2a_new" id="TT<?php echo $i+$NumberOfPeriods; ?>" onchange="checkOverload(<?php echo $totalRows?>)">
                         <option value="">-Select-</option>
                                <?php
                                $stmtSub = $db->runMsSqlQuery($sqlSubject);
                                while ($row = sqlsrv_fetch_array($stmtSub, SQLSRV_FETCH_ASSOC)) {
                                   $SubjectID=$row['SubjectID'];
                                   $SubjectName=$row['SubjectName'];
                                   $selectedOk="";
                                   if($SubjectID==$thisSubCode)$selectedOk="selected";
                                   echo "<option value=\"$SubjectID\" $selectedOk>$SubjectName - $SubjectID</option>";
                                }
                                ?>
                            </select>
                            <?php 
						    /* $groupCheck=getGroupSubjects($SchoolID,$GradeID,$thisSubCode);
							$groupCode=explode(",",$groupCheck);
								for($p=0;$p<count($groupCode);$p++){
									$codeGroup=$groupCode[$p];
									if($codeGroup!=''){
										$groubSub="TT".$valueField."_".$p;
										echo "<br>*";echo $groupCubName=getSubjectNameCommon($codeGroup);
									echo "<input type=\"hidden\" id=\"$groubSub\" name=\"$groubSub\" value=\"$codeGroup\">";
									}
								} */
						?></td>
                        <td bgcolor="#FFFFFF"><?php //echo $i+2*$NumberOfPeriods;
						$valueField=$i+2*$NumberOfPeriods;
						 $thisSubCode=$newArraySuffled[$valueField];
						 ?>
                            <select name="TT<?php echo $i+2*$NumberOfPeriods; ?>" class="select2a_new" id="TT<?php echo $i+2*$NumberOfPeriods; ?>" onchange="checkOverload(<?php echo $totalRows?>)">
                         <option value="">-Select-</option>
                                <?php
                                $stmtSub = $db->runMsSqlQuery($sqlSubject);
                               
                                while ($row = sqlsrv_fetch_array($stmtSub, SQLSRV_FETCH_ASSOC)) {
                                   $SubjectID=$row['SubjectID'];
                                   $SubjectName=$row['SubjectName'];
                                   $selectedOk="";
                                   if($SubjectID==$thisSubCode)$selectedOk="selected";
                                   echo "<option value=\"$SubjectID\" $selectedOk>$SubjectName - $SubjectID</option>";
                                }
                                ?>
                            </select>
                            <?php 
						    /* $groupCheck=getGroupSubjects($SchoolID,$GradeID,$thisSubCode);
							$groupCode=explode(",",$groupCheck);
								for($p=0;$p<count($groupCode);$p++){
									$codeGroup=$groupCode[$p];
									if($codeGroup!=''){
										$groubSub="TT".$valueField."_".$p;
										echo "<br>*";echo $groupCubName=getSubjectNameCommon($codeGroup);
									echo "<input type=\"hidden\" id=\"$groubSub\" name=\"$groubSub\" value=\"$codeGroup\">";
									}
								} */
						?></td>
                        <td bgcolor="#FFFFFF"><?php //echo $i+3*$NumberOfPeriods; 
						 $valueField=$i+3*$NumberOfPeriods;
						 $thisSubCode=$newArraySuffled[$valueField];
						?>
                            <select name="TT<?php echo $i+3*$NumberOfPeriods; ?>" class="select2a_new" id="TT<?php echo $i+3*$NumberOfPeriods; ?>" onchange="checkOverload(<?php echo $totalRows?>)">
                         <option value="">-Select-</option>
                                <?php
                                
                                $stmtSub = $db->runMsSqlQuery($sqlSubject);
                                while ($row = sqlsrv_fetch_array($stmtSub, SQLSRV_FETCH_ASSOC)) {
                                   $SubjectID=$row['SubjectID'];
                                   $SubjectName=$row['SubjectName'];
                                   $selectedOk="";
                                   if($SubjectID==$thisSubCode)$selectedOk="selected";
                                   echo "<option value=\"$SubjectID\" $selectedOk>$SubjectName - $SubjectID</option>";
                                }
                                ?>
                            </select>
                            <?php 
						    /* $groupCheck=getGroupSubjects($SchoolID,$GradeID,$thisSubCode);
							$groupCode=explode(",",$groupCheck);
								for($p=0;$p<count($groupCode);$p++){
									$codeGroup=$groupCode[$p];
									if($codeGroup!=''){
										$groubSub="TT".$valueField."_".$p;
										echo "<br>*";echo $groupCubName=getSubjectNameCommon($codeGroup);
									echo "<input type=\"hidden\" id=\"$groubSub\" name=\"$groubSub\" value=\"$codeGroup\">";
									}
								} */
						?></td>
                        <td bgcolor="#FFFFFF"><?php //echo $i+4*$NumberOfPeriods;
						$valueField=$i+4*$NumberOfPeriods;
						$thisSubCode=$newArraySuffled[$valueField];
						 ?>
                            <select name="TT<?php echo $i+4*$NumberOfPeriods; ?>" class="select2a_new" id="TT<?php echo $i+4*$NumberOfPeriods; ?>" onchange="checkOverload(<?php echo $totalRows?>)">
                         <option value="">-Select-</option>
                                <?php
                                
                                $stmtSub = $db->runMsSqlQuery($sqlSubject);
                                while ($row = sqlsrv_fetch_array($stmtSub, SQLSRV_FETCH_ASSOC)) {
                                   $SubjectID=$row['SubjectID'];
                                   $SubjectName=$row['SubjectName'];
                                   $selectedOk="";
                                   if($SubjectID==$thisSubCode)$selectedOk="selected";
                                   echo "<option value=\"$SubjectID\" $selectedOk>$SubjectName - $SubjectID</option>";
                                }
                                ?>
                            </select>
                            <?php 
						    /* $groupCheck=getGroupSubjects($SchoolID,$GradeID,$thisSubCode);
							$groupCode=explode(",",$groupCheck);
								for($p=0;$p<count($groupCode);$p++){
									$codeGroup=$groupCode[$p];
									if($codeGroup!=''){
										$groubSub="TT".$valueField."_".$p;
										echo "<br>*";echo $groupCubName=getSubjectNameCommon($codeGroup);
									echo "<input type=\"hidden\" id=\"$groubSub\" name=\"$groubSub\" value=\"$codeGroup\">";
									}
								} */
						?>
                        </td>
                      </tr>
                      <?php }?>
                    </table></td>
          </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
    </div>
    
    </form>
</div><!--
<div style="width:945px; width: auto; float: left;">
    <div style="width: 150px; float: left; margin-left: 50px;">
        School
    </div>
    <div style="width: 745px; float: left;">
        <select name="teachingSubject" class="select2a_n" id="teachingSubject" style="width: auto;" onchange="">
            <option value="">School Name</option>
           
        </select>
    </div>
    <div style="width: 150px; float: left;margin-left: 50px;">
        Grade
    </div>
    <div style="width: 745px; float: left;">
        <select name="teachingSubject" class="select2a_n" id="teachingSubject" style="width: auto;" onchange="">
            <option value="">Grade</option>
           
        </select>
    </div>
    <div style="width: 200px; float: left;margin-left: 50px;">
        
    </div>
    
</div>-->