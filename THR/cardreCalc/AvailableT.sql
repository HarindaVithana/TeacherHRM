USE MOENational
SELECT CenCode, TchSubject1, Medium1, Count(TeachingDetails.NIC) AS AvailableTCH
    INTO #Table2$NICUser
    FROM TeachingDetails 
    INNER JOIN TeacherMast ON TeachingDetails.NIC = TeacherMast.NIC
    INNER JOIN StaffServiceHistory ON StaffServiceHistory.ID = TeacherMast.CurServiceRef
    INNER JOIN CD_CensesNo ON CD_CensesNo.CenCode = StaffServiceHistory.InstCode
	INNER JOIN CD_Districts ON CD_CensesNo.DistrictCode = CD_Districts.DistCode
	INNER JOIN CD_Provinces ON CD_Districts.ProCode = CD_Provinces.ProCode
	WHERE CD_CensesNo.SchoolType = '1' GROUP BY CenCode, TchSubject1, Medium1

	SELECT * FROM #Table2$NICUser
	WHERE Medium1 = 1 AND SUBSTRING(TchSubject1, 1, 1) = 2 
	AND CenCode = 'SC21072'


	DROP Table #Table2$NICUser

	UPDATE AvailableTeachers 
    SET 
    AvailableTeachers.AvailableTch = p.AvailableTCH,
    AvailableTeachers.RecordStatus = 1,
    AvailableTeachers.RecordLog = '$NICUser',
	CalculatedDate = GETDATE()
    FROM AvailableTeachers av
    INNER JOIN #Table2$NICUser p
    ON av.CenCode = p.CenCode 
    Inner Join #Table2$NICUser q
    ON av.SubCode = q.TchSubject1
    Inner JOIN #Table2$NICUser r
    ON av.Medium = r.Medium1