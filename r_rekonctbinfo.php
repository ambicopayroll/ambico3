<?php

// Global variable for table object
$r_rekon = NULL;

//
// Table class for r_rekon
//
class crr_rekon extends crTableCrosstab {
	var $jdw_id;
	var $pegawai_id;
	var $pegawai_nama;
	var $tgl;
	var $jk_id;
	var $scan_masuk;
	var $scan_keluar;
	var $pegawai_pin;
	var $pegawai_nip;
	var $jk_nm;
	var $jk_kd;
	var $gol_hk;

	//
	// Table class constructor
	//
	function __construct() {
		global $ReportLanguage, $gsLanguage;
		$this->TableVar = 'r_rekon';
		$this->TableName = 'r_rekon';
		$this->TableType = 'REPORT';
		$this->DBID = 'DB';
		$this->ExportAll = FALSE;
		$this->ExportPageBreakCount = 0;

		// jdw_id
		$this->jdw_id = new crField('r_rekon', 'r_rekon', 'x_jdw_id', 'jdw_id', '`jdw_id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->jdw_id->Sortable = TRUE; // Allow sort
		$this->jdw_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['jdw_id'] = &$this->jdw_id;
		$this->jdw_id->DateFilter = "";
		$this->jdw_id->SqlSelect = "";
		$this->jdw_id->SqlOrderBy = "";

		// pegawai_id
		$this->pegawai_id = new crField('r_rekon', 'r_rekon', 'x_pegawai_id', 'pegawai_id', '`pegawai_id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->pegawai_id->Sortable = TRUE; // Allow sort
		$this->pegawai_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pegawai_id'] = &$this->pegawai_id;
		$this->pegawai_id->DateFilter = "";
		$this->pegawai_id->SqlSelect = "";
		$this->pegawai_id->SqlOrderBy = "";

		// pegawai_nama
		$this->pegawai_nama = new crField('r_rekon', 'r_rekon', 'x_pegawai_nama', 'pegawai_nama', '`pegawai_nama`', 200, EWR_DATATYPE_STRING, -1);
		$this->pegawai_nama->Sortable = TRUE; // Allow sort
		$this->pegawai_nama->GroupingFieldId = 1;
		$this->fields['pegawai_nama'] = &$this->pegawai_nama;
		$this->pegawai_nama->DateFilter = "";
		$this->pegawai_nama->SqlSelect = "";
		$this->pegawai_nama->SqlOrderBy = "";

		// tgl
		$this->tgl = new crField('r_rekon', 'r_rekon', 'x_tgl', 'tgl', '`tgl`', 133, EWR_DATATYPE_DATE, -1);
		$this->tgl->Sortable = TRUE; // Allow sort
		$this->tgl->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EWR_DATE_SEPARATOR"], $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['tgl'] = &$this->tgl;
		$this->tgl->DateFilter = "";
		$this->tgl->SqlSelect = "";
		$this->tgl->SqlOrderBy = "";

		// jk_id
		$this->jk_id = new crField('r_rekon', 'r_rekon', 'x_jk_id', 'jk_id', '`jk_id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->jk_id->Sortable = TRUE; // Allow sort
		$this->jk_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['jk_id'] = &$this->jk_id;
		$this->jk_id->DateFilter = "";
		$this->jk_id->SqlSelect = "";
		$this->jk_id->SqlOrderBy = "";

		// scan_masuk
		$this->scan_masuk = new crField('r_rekon', 'r_rekon', 'x_scan_masuk', 'scan_masuk', '`scan_masuk`', 135, EWR_DATATYPE_DATE, 5);
		$this->scan_masuk->Sortable = TRUE; // Allow sort
		$this->scan_masuk->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EWR_DATE_SEPARATOR"], $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['scan_masuk'] = &$this->scan_masuk;
		$this->scan_masuk->DateFilter = "";
		$this->scan_masuk->SqlSelect = "";
		$this->scan_masuk->SqlOrderBy = "";

		// scan_keluar
		$this->scan_keluar = new crField('r_rekon', 'r_rekon', 'x_scan_keluar', 'scan_keluar', '`scan_keluar`', 135, EWR_DATATYPE_DATE, 5);
		$this->scan_keluar->Sortable = TRUE; // Allow sort
		$this->scan_keluar->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EWR_DATE_SEPARATOR"], $ReportLanguage->Phrase("IncorrectDateYMD"));
		$this->fields['scan_keluar'] = &$this->scan_keluar;
		$this->scan_keluar->DateFilter = "";
		$this->scan_keluar->SqlSelect = "";
		$this->scan_keluar->SqlOrderBy = "";

		// pegawai_pin
		$this->pegawai_pin = new crField('r_rekon', 'r_rekon', 'x_pegawai_pin', 'pegawai_pin', '`pegawai_pin`', 200, EWR_DATATYPE_STRING, -1);
		$this->pegawai_pin->Sortable = TRUE; // Allow sort
		$this->fields['pegawai_pin'] = &$this->pegawai_pin;
		$this->pegawai_pin->DateFilter = "";
		$this->pegawai_pin->SqlSelect = "";
		$this->pegawai_pin->SqlOrderBy = "";

		// pegawai_nip
		$this->pegawai_nip = new crField('r_rekon', 'r_rekon', 'x_pegawai_nip', 'pegawai_nip', '`pegawai_nip`', 200, EWR_DATATYPE_STRING, -1);
		$this->pegawai_nip->Sortable = TRUE; // Allow sort
		$this->fields['pegawai_nip'] = &$this->pegawai_nip;
		$this->pegawai_nip->DateFilter = "";
		$this->pegawai_nip->SqlSelect = "";
		$this->pegawai_nip->SqlOrderBy = "";

		// jk_nm
		$this->jk_nm = new crField('r_rekon', 'r_rekon', 'x_jk_nm', 'jk_nm', '`jk_nm`', 200, EWR_DATATYPE_STRING, -1);
		$this->jk_nm->Sortable = TRUE; // Allow sort
		$this->fields['jk_nm'] = &$this->jk_nm;
		$this->jk_nm->DateFilter = "";
		$this->jk_nm->SqlSelect = "";
		$this->jk_nm->SqlOrderBy = "";

		// jk_kd
		$this->jk_kd = new crField('r_rekon', 'r_rekon', 'x_jk_kd', 'jk_kd', '`jk_kd`', 200, EWR_DATATYPE_STRING, -1);
		$this->jk_kd->Sortable = TRUE; // Allow sort
		$this->fields['jk_kd'] = &$this->jk_kd;
		$this->jk_kd->DateFilter = "";
		$this->jk_kd->SqlSelect = "";
		$this->jk_kd->SqlOrderBy = "";

		// gol_hk
		$this->gol_hk = new crField('r_rekon', 'r_rekon', 'x_gol_hk', 'gol_hk', '`gol_hk`', 16, EWR_DATATYPE_NUMBER, -1);
		$this->gol_hk->Sortable = TRUE; // Allow sort
		$this->gol_hk->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['gol_hk'] = &$this->gol_hk;
		$this->gol_hk->DateFilter = "";
		$this->gol_hk->SqlSelect = "";
		$this->gol_hk->SqlOrderBy = "";
	}

	// Set Field Visibility
	function SetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Multiple column sort
	function UpdateSort(&$ofld, $ctrl) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			if ($ofld->GroupingFieldId == 0) {
				if ($ctrl) {
					$sOrderBy = $this->getDetailOrderBy();
					if (strpos($sOrderBy, $sSortField . " " . $sLastSort) !== FALSE) {
						$sOrderBy = str_replace($sSortField . " " . $sLastSort, $sSortField . " " . $sThisSort, $sOrderBy);
					} else {
						if ($sOrderBy <> "") $sOrderBy .= ", ";
						$sOrderBy .= $sSortField . " " . $sThisSort;
					}
					$this->setDetailOrderBy($sOrderBy); // Save to Session
				} else {
					$this->setDetailOrderBy($sSortField . " " . $sThisSort); // Save to Session
				}
			}
		} else {
			if ($ofld->GroupingFieldId == 0 && !$ctrl) $ofld->setSort("");
		}
	}

	// Get Sort SQL
	function SortSql() {
		$sDtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
		$argrps = array();
		foreach ($this->fields as $fld) {
			if ($fld->getSort() <> "") {
				$fldsql = $fld->FldExpression;
				if ($fld->GroupingFieldId > 0) {
					if ($fld->FldGroupSql <> "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->FldGroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
				}
			}
		}
		$sSortSql = "";
		foreach ($argrps as $grp) {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $grp;
		}
		if ($sDtlSortSql <> "") {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $sDtlSortSql;
		}
		return $sSortSql;
	}

	// Table level SQL
	// Column field

	var $ColumnField = "";

	function getColumnField() {
		return ($this->ColumnField <> "") ? $this->ColumnField : "`tgl`";
	}

	function setColumnField($v) {
		$this->ColumnField = $v;
	}

	// Column date type
	var $ColumnDateType = "";

	function getColumnDateType() {
		return ($this->ColumnDateType <> "") ? $this->ColumnDateType : "d";
	}

	function setColumnDateType($v) {
		$this->ColumnDateType = $v;
	}

	// Column captions
	var $ColumnCaptions = "";

	function getColumnCaptions() {
		global $ReportLanguage;
		return ($this->ColumnCaptions <> "") ? $this->ColumnCaptions : "";
	}

	function setColumnCaptions($v) {
		$this->ColumnCaptions = $v;
	}

	// Column names
	var $ColumnNames = "";

	function getColumnNames() {
		return ($this->ColumnNames <> "") ? $this->ColumnNames : "";
	}

	function setColumnNames($v) {
		$this->ColumnNames = $v;
	}

	// Column values
	var $ColumnValues = "";

	function getColumnValues() {
		return ($this->ColumnValues <> "") ? $this->ColumnValues : "";
	}

	function setColumnValues($v) {
		$this->ColumnValues = $v;
	}

	// From
	var $_SqlFrom = "";

	function getSqlFrom() {
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`v_rekon`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}

	// Select
	var $_SqlSelect = "";

	function getSqlSelect() {
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT `pegawai_nama`, <DistinctColumnFields> FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}

	// Where
	var $_SqlWhere = "";

	function getSqlWhere() {
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}

	// Group By
	var $_SqlGroupBy = "";

	function getSqlGroupBy() {
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "`pegawai_nama`";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}

	// Having
	var $_SqlHaving = "";

	function getSqlHaving() {
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}

	// Order By
	var $_SqlOrderBy = "";

	function getSqlOrderBy() {
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`pegawai_nama` ASC";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Select Distinct
	var $_SqlDistinctSelect = "";

	function getSqlDistinctSelect() {
		return ($this->_SqlDistinctSelect <> "") ? $this->_SqlDistinctSelect : "SELECT DISTINCT DATE_FORMAT(`tgl`,'%Y-%m-%d') FROM `v_rekon`";
	}

	function SqlDistinctSelect() { // For backward compatibility
		return $this->getSqlDistinctSelect();
	}

	function setSqlDistinctSelect($v) {
		$this->_SqlDistinctSelect = $v;
	}

	// Distinct Where
	var $_SqlDistinctWhere = "";

	function getSqlDistinctWhere() {
		$sWhere = ($this->_SqlDistinctWhere <> "") ? $this->_SqlDistinctWhere : "";
		return $sWhere;
	}

	function SqlDistinctWhere() { // For backward compatibility
		return $this->getSqlDistinctWhere();
	}

	function setSqlDistinctWhere($v) {
		$this->_SqlDistinctWhere = $v;
	}

	// Distinct Order By
	var $_SqlDistinctOrderBy = "";

	function getSqlDistinctOrderBy() {
		return ($this->_SqlDistinctOrderBy <> "") ? $this->_SqlDistinctOrderBy : "DATE_FORMAT(`tgl`,'%Y-%m-%d') ASC";
	}

	function SqlDistinctOrderBy() { // For backward compatibility
		return $this->getSqlDistinctOrderBy();
	}

	function setSqlDistinctOrderBy($v) {
		$this->_SqlDistinctOrderBy = $v;
	}
	var $ColCount;
	var $Col;
	var $DistinctColumnFields = "";

	// Load column values
	function LoadColumnValues($filter = "") {
		global $ReportLanguage;
		$conn = &$this->Connection();

		// Build SQL
		$sSql = ewr_BuildReportSql($this->getSqlDistinctSelect(), $this->getSqlDistinctWhere(), "", "", $this->getSqlDistinctOrderBy(), $filter, "");

		// Load recordset
		$rscol = $conn->Execute($sSql);

		// Get distinct column count
		$this->ColCount = ($rscol) ? $rscol->RecordCount() : 0;

/* Uncomment to show phrase
		if ($this->ColCount == 0) {
			if ($rscol) $rscol->Close();
			echo "<p>" . $ReportLanguage->Phrase("NoDistinctColVals") . $sSql . "</p>";
			exit();
		}
*/
		$this->Col = &ewr_Init2DArray($this->ColCount+1, 2, NULL);
		$colcnt = 0;
		while (!$rscol->EOF) {
			if (is_null($rscol->fields[0])) {
				$wrkValue = EWR_NULL_VALUE;
				$wrkCaption = $ReportLanguage->Phrase("NullLabel");
			} elseif ($rscol->fields[0] == "") {
				$wrkValue = EWR_EMPTY_VALUE;
				$wrkCaption = $ReportLanguage->Phrase("EmptyLabel");
			} else {
				$wrkValue = $rscol->fields[0];
				$wrkCaption = $rscol->fields[0];
			}
			$colcnt++;
			$this->Col[$colcnt] = new crCrosstabColumn($wrkValue, $wrkCaption, TRUE);
			$rscol->MoveNext();
		}
		$rscol->Close();

		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of distinct values

		$nGrps = 1;
		$this->SummaryFields[0] = new crSummaryField('x_gol_hk', 'gol_hk', '`gol_hk`', 'MAX');
		$this->SummaryFields[0]->SummaryCaption = $ReportLanguage->Phrase("RptMax");
		$this->SummaryFields[0]->SummaryVal = &ewr_InitArray($this->ColCount+1, NULL);
		$this->SummaryFields[0]->SummaryValCnt = &ewr_InitArray($this->ColCount+1, NULL);
		$this->SummaryFields[0]->SummaryCnt = &ewr_Init2DArray($this->ColCount+1, $nGrps+1, NULL);
		$this->SummaryFields[0]->SummarySmry = &ewr_Init2DArray($this->ColCount+1, $nGrps+1, NULL);
		$this->SummaryFields[0]->SummarySmryCnt = &ewr_Init2DArray($this->ColCount+1, $nGrps+1, NULL);
		$this->SummaryFields[0]->SummaryInitValue = NULL;
		$this->SummaryFields[1] = new crSummaryField('x_jk_kd', 'jk_kd', '`jk_kd`', 'MAX');
		$this->SummaryFields[1]->SummaryCaption = $ReportLanguage->Phrase("RptMax");
		$this->SummaryFields[1]->SummaryVal = &ewr_InitArray($this->ColCount+1, NULL);
		$this->SummaryFields[1]->SummaryValCnt = &ewr_InitArray($this->ColCount+1, NULL);
		$this->SummaryFields[1]->SummaryCnt = &ewr_Init2DArray($this->ColCount+1, $nGrps+1, NULL);
		$this->SummaryFields[1]->SummarySmry = &ewr_Init2DArray($this->ColCount+1, $nGrps+1, NULL);
		$this->SummaryFields[1]->SummarySmryCnt = &ewr_Init2DArray($this->ColCount+1, $nGrps+1, NULL);
		$this->SummaryFields[1]->SummaryInitValue = NULL;
		$this->SummaryFields[2] = new crSummaryField('x_scan_masuk', 'scan_masuk', '`scan_masuk`', 'MAX');
		$this->SummaryFields[2]->SummaryCaption = $ReportLanguage->Phrase("RptMax");
		$this->SummaryFields[2]->SummaryVal = &ewr_InitArray($this->ColCount+1, NULL);
		$this->SummaryFields[2]->SummaryValCnt = &ewr_InitArray($this->ColCount+1, NULL);
		$this->SummaryFields[2]->SummaryCnt = &ewr_Init2DArray($this->ColCount+1, $nGrps+1, NULL);
		$this->SummaryFields[2]->SummarySmry = &ewr_Init2DArray($this->ColCount+1, $nGrps+1, NULL);
		$this->SummaryFields[2]->SummarySmryCnt = &ewr_Init2DArray($this->ColCount+1, $nGrps+1, NULL);
		$this->SummaryFields[2]->SummaryInitValue = NULL;
		$this->SummaryFields[3] = new crSummaryField('x_scan_keluar', 'scan_keluar', '`scan_keluar`', 'MAX');
		$this->SummaryFields[3]->SummaryCaption = $ReportLanguage->Phrase("RptMax");
		$this->SummaryFields[3]->SummaryVal = &ewr_InitArray($this->ColCount+1, NULL);
		$this->SummaryFields[3]->SummaryValCnt = &ewr_InitArray($this->ColCount+1, NULL);
		$this->SummaryFields[3]->SummaryCnt = &ewr_Init2DArray($this->ColCount+1, $nGrps+1, NULL);
		$this->SummaryFields[3]->SummarySmry = &ewr_Init2DArray($this->ColCount+1, $nGrps+1, NULL);
		$this->SummaryFields[3]->SummarySmryCnt = &ewr_Init2DArray($this->ColCount+1, $nGrps+1, NULL);
		$this->SummaryFields[3]->SummaryInitValue = NULL;

		// Update crosstab sql
		$sSqlFlds = "";
		$cnt = count($this->SummaryFields);
		for ($is = 0; $is < $cnt; $is++) {
			$smry = &$this->SummaryFields[$is];
			for ($colcnt = 1; $colcnt <= $this->ColCount; $colcnt++) {
				$sFld = ewr_CrossTabField($smry->SummaryType, $smry->FldExpression, $this->getColumnField(), $this->getColumnDateType(), $this->Col[$colcnt]->Value, "'", "C" . $is . $colcnt, $this->DBID);
				if ($sSqlFlds <> "")
					$sSqlFlds .= ", ";
				$sSqlFlds .= $sFld;
			}
		}
		$this->DistinctColumnFields = $sSqlFlds;
	}

	// Table Level Group SQL
	// First Group Field

	var $_SqlFirstGroupField = "";

	function getSqlFirstGroupField() {
		return ($this->_SqlFirstGroupField <> "") ? $this->_SqlFirstGroupField : "`pegawai_nama`";
	}

	function SqlFirstGroupField() { // For backward compatibility
		return $this->getSqlFirstGroupField();
	}

	function setSqlFirstGroupField($v) {
		$this->_SqlFirstGroupField = $v;
	}

	// Select Group
	var $_SqlSelectGroup = "";

	function getSqlSelectGroup() {
		return ($this->_SqlSelectGroup <> "") ? $this->_SqlSelectGroup : "SELECT DISTINCT " . $this->getSqlFirstGroupField() . " FROM " . $this->getSqlFrom();
	}

	function SqlSelectGroup() { // For backward compatibility
		return $this->getSqlSelectGroup();
	}

	function setSqlSelectGroup($v) {
		$this->_SqlSelectGroup = $v;
	}

	// Order By Group
	var $_SqlOrderByGroup = "";

	function getSqlOrderByGroup() {
		return ($this->_SqlOrderByGroup <> "") ? $this->_SqlOrderByGroup : "`pegawai_nama` ASC";
	}

	function SqlOrderByGroup() { // For backward compatibility
		return $this->getSqlOrderByGroup();
	}

	function setSqlOrderByGroup($v) {
		$this->_SqlOrderByGroup = $v;
	}

	// Select Aggregate
	var $_SqlSelectAgg = "";

	function getSqlSelectAgg() {
		return ($this->_SqlSelectAgg <> "") ? $this->_SqlSelectAgg : "SELECT <DistinctColumnFields> FROM " . $this->getSqlFrom();
	}

	function SqlSelectAgg() { // For backward compatibility
		return $this->getSqlSelectAgg();
	}

	function setSqlSelectAgg($v) {
		$this->_SqlSelectAgg = $v;
	}

	// Group By Aggregate
	var $_SqlGroupByAgg = "";

	function getSqlGroupByAgg() {
		return ($this->_SqlGroupByAgg <> "") ? $this->_SqlGroupByAgg : "";
	}

	function SqlGroupByAgg() { // For backward compatibility
		return $this->getSqlGroupByAgg();
	}

	function setSqlGroupByAgg($v) {
		$this->_SqlGroupByAgg = $v;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {

			//$sUrlParm = "order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort();
			$sUrlParm = "order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort();
			return ewr_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld) {
		global $gsLanguage;
		switch ($fld->FldVar) {
		case "x_pegawai_nama":
			$sSqlWrk = "";
		$sSqlWrk = "SELECT DISTINCT `pegawai_nama`, `pegawai_nama` AS `DispFld`, '' AS `DispFld2`, '' AS `DispFld3`, '' AS `DispFld4` FROM `v_rekon`";
		$sWhereWrk = "{filter}";
		$this->pegawai_nama->LookupFilters = array("dx1" => '`pegawai_nama`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "DB", "f0" => '`pegawai_nama` = {filter_value}', "t0" => "200", "fn0" => "", "dlm" => ewr_Encrypt($fld->FldDelimiter));
			$sSqlWrk = "";
		$this->Lookup_Selecting($this->pegawai_nama, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `pegawai_nama` ASC";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld) {
		global $gsLanguage;
		switch ($fld->FldVar) {
		}
	}

	// Table level events
	// Page Selecting event
	function Page_Selecting(&$filter) {

		// Enter your code here
	}

	// Page Breaking event
	function Page_Breaking(&$break, &$content) {

		// Example:
		//$break = FALSE; // Skip page break, or
		//$content = "<div style=\"page-break-after:always;\">&nbsp;</div>"; // Modify page break content

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Cell Rendered event
	function Cell_Rendered(&$Field, $CurrentValue, &$ViewValue, &$ViewAttrs, &$CellAttrs, &$HrefValue, &$LinkAttrs) {

		//$ViewValue = "xxx";
		//$ViewAttrs["style"] = "xxx";

		if ($Field->FldName == "scan_masuk") {
			$ViewAttrs["style"] = "color: green";
		}
		if ($Field->FldName == "scan_keluar") {
			$ViewAttrs["style"] = "color: red";
		}
		if ($Field->FldName == "jk_kd") {
			$ViewAttrs["style"] = "color: blue";
		}
		if ($Field->FldName == "gol_hk") {
			$ViewAttrs["style"] = "color: brown";
		}
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}

	// Load Filters event
	function Page_FilterLoad() {

		// Enter your code here
		// Example: Register/Unregister Custom Extended Filter
		//ewr_RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A', 'GetStartsWithAFilter'); // With function, or
		//ewr_RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A'); // No function, use Page_Filtering event
		//ewr_UnregisterFilter($this-><Field>, 'StartsWithA');

	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//$this->MyField1->SearchValue = "your search criteria"; // Search value

	}

	// Page Filtering event
	function Page_Filtering(&$fld, &$filter, $typ, $opr = "", $val = "", $cond = "", $opr2 = "", $val2 = "") {

		// Note: ALWAYS CHECK THE FILTER TYPE ($typ)! Example:
		//if ($typ == "dropdown" && $fld->FldName == "MyField") // Dropdown filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "extended" && $fld->FldName == "MyField") // Extended filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "popup" && $fld->FldName == "MyField") // Popup filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "custom" && $opr == "..." && $fld->FldName == "MyField") // Custom filter, $opr is the custom filter ID
		//	$filter = "..."; // Modify the filter

	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		// Enter your code here
	}
}
?>
