<link href="../cms/css/screen.css" rel="stylesheet" type="text/css" />
<?php 

if($fm=='' || $fm=='A'){
			$sql = "SELECT SurnameWithInitials,FullName,GenderCode,CivilStatusCode,SpouseName,SpouseOccupationCode, SpouseOfficeAddr,CurServiceRef,CONVERT(varchar(20),DOB,121) AS dateofBirth FROM TeacherMast where NIC='$NICUser'";
		
		$stmt = $db->runMsSqlQuery($sql);
		while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
			$SurnameWithInitials=$row['SurnameWithInitials'];
			$FullName=$row['FullName'];
			$GenderCode=$row['GenderCode'];
			$CivilStatusCode=$row['CivilStatusCode'];
			$SpouseName=$row['SpouseName'];
			$SpouseOccupationCode=$row['SpouseOccupationCode'];
			$SpouseOfficeAddr=$row['SpouseOfficeAddr'];
			$CurServiceRef=$row['CurServiceRef'];
			$DOB=$row['dateofBirth'];
		}
		
		$sqlCS="SELECT        CD_CensesNo.InstitutionName, StaffServiceHistory.WorkStatusCode, StaffServiceHistory.ServiceTypeCode, StaffServiceHistory.SecGRCode, StaffServiceHistory.PositionCode
		FROM            StaffServiceHistory INNER JOIN
								 CD_CensesNo ON StaffServiceHistory.InstCode = CD_CensesNo.CenCode where StaffServiceHistory.ID='$CurServiceRef'";
		$stmtCS = $db->runMsSqlQuery($sqlCS);
		while ($row = sqlsrv_fetch_array($stmtCS, SQLSRV_FETCH_ASSOC)) {
			$InstitutionName=$row['InstitutionName'];
			$WorkStatusCode=$row['WorkStatusCode'];
			$ServiceTypeCode=$row['ServiceTypeCode'];
			$SecGRCode=$row['SecGRCode'];
			$PositionCode=$row['PositionCode'];
		}
		$sqlTG = "SELECT * FROM CD_Service where ServCode='$ServiceTypeCode'";
		$stmtTG = $db->runMsSqlQuery($sqlTG);
		while ($row = sqlsrv_fetch_array($stmtTG, SQLSRV_FETCH_ASSOC)) {
			$ServiceName=$row['ServiceName'];
		}
		
		$sqlFA = "SELECT CONVERT(varchar(20),AppDate,121) AS firstAppDate FROM StaffServiceHistory where NIC='$NICUser' and ServiceRecTypeCode='NA01'";
		$stmtFA = $db->runMsSqlQuery($sqlFA);
		while ($row = sqlsrv_fetch_array($stmtFA, SQLSRV_FETCH_ASSOC)) {
			$firstAppDate=$row['firstAppDate'];
		}
		
		$sqlFA = "SELECT CONVERT(varchar(20),AppDate,121) AS currentAppDate FROM StaffServiceHistory where NIC='$NICUser' and InstCode='$loggedSchool'"; //ORDER BY ID DESC
		$stmtFA = $db->runMsSqlQuery($sqlFA);
		while ($row = sqlsrv_fetch_array($stmtFA, SQLSRV_FETCH_ASSOC)) {
			$currentAppDate=$row['currentAppDate'];
		}
		
	
	}else{
		$sqlCS="SELECT        CD_CensesNo.InstitutionName, StaffServiceHistory.WorkStatusCode, StaffServiceHistory.ServiceTypeCode, StaffServiceHistory.SecGRCode, StaffServiceHistory.PositionCode
		FROM            StaffServiceHistory INNER JOIN
								 CD_CensesNo ON StaffServiceHistory.InstCode = CD_CensesNo.CenCode where StaffServiceHistory.ID='$ServiceHistoryID'";// ServiceHistoryID Variable on teacherPersonalDetails.php
		$stmtCS = $db->runMsSqlQuery($sqlCS);
		while ($row = sqlsrv_fetch_array($stmtCS, SQLSRV_FETCH_ASSOC)) {
			$InstitutionName=$row['InstitutionName'];
			$WorkStatusCode=$row['WorkStatusCode'];
			$ServiceTypeCode=$row['ServiceTypeCode'];
			$SecGRCode=$row['SecGRCode'];
			$PositionCode=$row['PositionCode'];
		}
		$sqlTG = "SELECT * FROM CD_Service where ServCode='$ServiceTypeCode'";
		$stmtTG = $db->runMsSqlQuery($sqlTG);
		while ($row = sqlsrv_fetch_array($stmtTG, SQLSRV_FETCH_ASSOC)) {
			$ServiceName=$row['ServiceName'];
		}
		$sqlFA = "SELECT CONVERT(varchar(20),AppDate,121) AS firstAppDate FROM StaffServiceHistory where NIC='$NICUser' and ServiceRecTypeCode='NA01'";
		$stmtFA = $db->runMsSqlQuery($sqlFA);
		while ($row = sqlsrv_fetch_array($stmtFA, SQLSRV_FETCH_ASSOC)) {
			$firstAppDate=$row['firstAppDate'];
		}
		
		$sqlFA = "SELECT CONVERT(varchar(20),AppDate,121) AS currentAppDate FROM StaffServiceHistory where ID='$ServiceHistoryID'"; //ORDER BY ID DESC // ServiceHistoryID Variable on teacherPersonalDetails.php
		$stmtFA = $db->runMsSqlQuery($sqlFA);
		while ($row = sqlsrv_fetch_array($stmtFA, SQLSRV_FETCH_ASSOC)) {
			$currentAppDate=$row['currentAppDate'];
		}
		
		
	}
	//echo $ServiceHistoryID;
?>

<table width="945" cellpadding="0" cellspacing="0">
        	  <tr>
        	    <td><table width="100%" cellspacing="1" cellpadding="1">
        	      <tr>
        	        <td bgcolor="#F7E2DD">Reqistration Number :</td>
        	        <td bgcolor="#EDEEF3">&nbsp;</td>
      	        </tr>
        	      <tr>
        	        <td width="23%" bgcolor="#F7E2DD">1st Appointment Date :</td>
        	        <td width="77%" bgcolor="#EDEEF3"><?php echo $firstAppDate ?></td>
       	          </tr>
        	      <tr>
        	        <td bgcolor="#F7E2DD">1st Appointment Place :</td>
        	        <td bgcolor="#EDEEF3">&nbsp;</td>
       	          </tr>
        	      <tr>
        	        <td bgcolor="#F7E2DD">Appointment Type :</td>
        	        <td bgcolor="#EDEEF3"><select name="select3" class="select2a_n" id="select3">
        	          <option value="NED">National Educatio Diploma</option>
        	          <option value="OZ">Disapathi</option>
        	          <option value="TE">Teaching Exams</option>
        	          <option value="OT">Other</option>
      	          </select></td>
       	          </tr>
        	      <tr>
        	        <td bgcolor="#F7E2DD">Current Appointment Date :</td>
        	        <td bgcolor="#EDEEF3"><?php echo $currentAppDate; ?></td>
       	          </tr>
        	      <tr>
        	        <td bgcolor="#F7E2DD">Current School Name :</td>
        	        <td bgcolor="#EDEEF3"><?php echo ucwords(strtolower(($InstitutionName))); ?></td>
       	          </tr>
        	      <tr>
        	        <td bgcolor="#F7E2DD">Current School Address :</td>
        	        <td bgcolor="#EDEEF3"><?php //echo ucwords(strtolower(($SpouseOfficeAddr))); ?></td>
       	          </tr>
                   <tr>
                      <td valign="top" bgcolor="#F7E2DD">Service Details :</td>
                      <td bgcolor="#EDEEF3"><table width="100%" cellspacing="1" cellpadding="1">
                        <tr>
                          <td width="19%" bgcolor="#CCCCCC">&nbsp;</td>
                          <td width="31%" bgcolor="#CCCCCC">School</td>
                          <td width="15%" bgcolor="#CCCCCC">District</td>
                          <td width="9%" bgcolor="#CCCCCC">&nbsp;</td>
                          <td width="11%" bgcolor="#CCCCCC">Duration</td>
                          <td width="15%" bgcolor="#CCCCCC">Score</td>
                        </tr>
                        <?php $sqlStHistry="SELECT        CD_CensesNo.InstitutionName, CD_CensesNo.DistrictCode, CD_Districts.DistName
FROM            StaffServiceHistory INNER JOIN
                         CD_CensesNo ON StaffServiceHistory.InstCode = CD_CensesNo.CenCode INNER JOIN
                         CD_Districts ON CD_CensesNo.DistrictCode = CD_Districts.DistCode
WHERE        (StaffServiceHistory.NIC = '$NICUser') ORDER BY StaffServiceHistory.AppDate ASC";
 //echo $TotaRows=$db->rowCount($sqlStHistry);
 $stmtSH = $db->runMsSqlQuery($sqlStHistry);
						while ($rowh = sqlsrv_fetch_array($stmtSH, SQLSRV_FETCH_ASSOC)) {
								$InstitutionName=$rowh['InstitutionName'];
								$DistrictCode=$rowh['DistrictCode'];
								$DistName=$rowh['DistName'];
								?>
                        <tr>
                          <td bgcolor="#FFFFFF">&nbsp;</td>
                          <td bgcolor="#FFFFFF"><?php echo $InstitutionName;?></td>
                          <td bgcolor="#FFFFFF"><?php echo $DistName ?> <?php //echo $DistrictCode ?></td>
                          <td bgcolor="#FFFFFF">&nbsp;</td>
                          <td bgcolor="#FFFFFF">&nbsp;</td>
                          <td bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <?php }?>
                      </table></td>
                    </tr>
      	      </table></td>
      	    </tr>
        	  </table>