/****** Script for SelectTopNRows command from SSMS  ******/
SELECT DISTINCT [CenCode]
      ,[SubCode]
      ,[SecCode]
      ,[Medium]
      ,[ApprCardre]
      ,[RecordLog]
      ,[RecordStatus]
      ,[ApprovedDate]
  FROM [MOENational].[dbo].[ApprovedCardre] WHERE Medium = 1 AND SUBSTRING(SubCode, 1, 1) = 2 
	AND CenCode = 'SC21071'
	AND SecCode = '2'
	ORDER BY SubCode

	DELETE [MOENational].[dbo].[ApprovedCardre] WHERE ID = 4

	use MOENational
	UPDATE ExcessDeficit
    SET ExcDef = a.ApprCardre - p.AvailableTch
    FROM ExcessDeficit ed
    INNER JOIN AvailableTeachers p ON ed.CenCode = p.CenCode
	Inner Join AvailableTeachers q ON ed.SubCode = q.SubCode 
	Inner JOIN AvailableTeachers r ON ed.Medium = r.Medium
    Inner Join ApprovedCardre a ON ed.CenCode = a.CenCode
	INNER JOIN ApprovedCardre b ON ed.SubCode = b.SubCode
	INNER JOIN ApprovedCardre c ON ed.Medium = c.Medium
	WHERE ed.Medium = '1' AND ed.SecCode = '2'

	SELECT * FROM ExcessDeficit Where Medium = '1' and SecCode = '2'  

	UPDATE ExcessDeficit 
    SET Excess = a.ApprCardre
	FROM ExcessDeficit ed
	INNER JOIN ApprovedCardre a ON ed.CenCode = a.CenCode 
	INNER JOIN ApprovedCardre b ON ed.SubCode = b.SubCode
	INNER JOIN ApprovedCardre c ON ed.Medium = c.Medium
	WHERE ed.Medium = '1' AND ed.SecCode = '2'

	UPDATE ExcessDeficit 
    SET Deficit = a.AvailableTch
	FROM ExcessDeficit ed
	INNER JOIN AvailableTeachers a ON ed.CenCode = a.CenCode 
	INNER JOIN AvailableTeachers b ON ed.SubCode = b.SubCode
	INNER JOIN AvailableTeachers c ON ed.Medium = c.Medium
	WHERE ed.Medium = '1' AND ed.SecCode = '2'

	UPDATE ExcessDeficit 
	SET ExcDef = Excess-Deficit
	Where Medium = '1' and SecCode = '2'
--------------------------------------------------------------------------------------------------
SELECT * INTO #temppivot1 FROM   
(
    SELECT 
        SubCode, 
		--SubCode + '1' as SubCode1,
		--SubCode + '2' as SubCode2,
        ExcDef,
        CenCode
		--,Excess
		--,Deficit
    FROM 
        ExcessDeficit p
) t 
PIVOT(
    Sum(ExcDef) 
    FOR subcode IN (
        [201] , [202] , [203] , [204] , [205] , [206] , 
		[207] , [208] , [209] , [210] , [211] , [212] , 
		[213] , [214] , [215] , [216] , [217] , [218] , 
		[219] , [220] , [221] , [222] , [223] , [224] , 
		[225] , [226] , [227] , [228] , [229] , [230] , 
		[231] , [232] , [233] , [234] , [235] , [236] , 
		[237] , [238] , [239] , [240] , [241] , [242] , 
		[243] , [244] , [245] , [246] , [247] , [248] , 
		[249] , [250] , [251]
		)
) AS pivot_table

SELECT * INTO #temppivot2 FROM   
(
    SELECT 
        SubCode, 
		--SubCode + '1' as SubCode1,
		--SubCode + '2' as SubCode2,
        --ExcDef,
        CenCode
		,Excess
		--,Deficit
    FROM 
        ExcessDeficit p
) t 
PIVOT(
    Sum(Excess) 
    FOR subcode IN (
        [201] , [202] , [203] , [204] , [205] , [206] , 
		[207] , [208] , [209] , [210] , [211] , [212] , 
		[213] , [214] , [215] , [216] , [217] , [218] , 
		[219] , [220] , [221] , [222] , [223] , [224] , 
		[225] , [226] , [227] , [228] , [229] , [230] , 
		[231] , [232] , [233] , [234] , [235] , [236] , 
		[237] , [238] , [239] , [240] , [241] , [242] , 
		[243] , [244] , [245] , [246] , [247] , [248] , 
		[249] , [250] , [251]
		)
) AS pivot_table2

 
 SELECT * INTO #temppivot3 FROM   
(
    SELECT 
        SubCode, 
		--SubCode + '1' as SubCode1,
		--SubCode + '2' as SubCode2,
        --ExcDef,
        CenCode
		--,Excess
		,Deficit
    FROM 
        ExcessDeficit p
) t 
PIVOT(
    Sum(Deficit) 
    FOR subcode IN (
        [201] , [202] , [203] , [204] , [205] , [206] , 
		[207] , [208] , [209] , [210] , [211] , [212] , 
		[213] , [214] , [215] , [216] , [217] , [218] , 
		[219] , [220] , [221] , [222] , [223] , [224] , 
		[225] , [226] , [227] , [228] , [229] , [230] , 
		[231] , [232] , [233] , [234] , [235] , [236] , 
		[237] , [238] , [239] , [240] , [241] , [242] , 
		[243] , [244] , [245] , [246] , [247] , [248] , 
		[249] , [250] , [251]
		)
) AS pivot_table3

SELECT * FROM #temppivot1 tp1 
INNER JOIN #temppivot2 tp2 ON tp1.CenCode = tp2.CenCode 
INNER JOIN #temppivot3 tp3 ON tp1.CenCode = tp3.CenCode 