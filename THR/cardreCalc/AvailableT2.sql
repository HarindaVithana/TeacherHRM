/****** Script for SelectTopNRows command from SSMS  ******/
SELECT TchSubject1, Medium1, GradeCode1,count(*) as tch
  FROM [TeachingDetails] INNER JOIN TeacherMast ON TeacherMast.NIC = TeachingDetails.NIC
  INNER JOIN StaffServiceHistory ON StaffServiceHistory.ID = TeacherMast.CurServiceRef
  INNER JOIN CD_CensesNo on CD_CensesNo.CenCode = StaffServiceHistory.InstCode WHERE CD_CensesNo.CenCode = 'SC21072'
  AND Medium1 = 1 AND SUBSTRING(TchSubject1, 1, 1) = 2 
  group by TchSubject1, Medium1, GradeCode1
	
