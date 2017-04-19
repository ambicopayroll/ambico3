<?php include_once "t_userinfo.php" ?>
<?php

// Create page object
if (!isset($t_jdw_krj_def_grid)) $t_jdw_krj_def_grid = new ct_jdw_krj_def_grid();

// Page init
$t_jdw_krj_def_grid->Page_Init();

// Page main
$t_jdw_krj_def_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_jdw_krj_def_grid->Page_Render();
?>
<?php if ($t_jdw_krj_def->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft_jdw_krj_defgrid = new ew_Form("ft_jdw_krj_defgrid", "grid");
ft_jdw_krj_defgrid.FormKeyCountName = '<?php echo $t_jdw_krj_def_grid->FormKeyCountName ?>';

// Validate form
ft_jdw_krj_defgrid.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_pegawai_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t_jdw_krj_def->pegawai_id->FldCaption(), $t_jdw_krj_def->pegawai_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_tgl");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t_jdw_krj_def->tgl->FldCaption(), $t_jdw_krj_def->tgl->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_tgl");
			if (elm && !ew_CheckDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jdw_krj_def->tgl->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_jk_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t_jdw_krj_def->jk_id->FldCaption(), $t_jdw_krj_def->jk_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_hk_def");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t_jdw_krj_def->hk_def->FldCaption(), $t_jdw_krj_def->hk_def->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft_jdw_krj_defgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "pegawai_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "tgl", false)) return false;
	if (ew_ValueChanged(fobj, infix, "jk_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "hk_def", false)) return false;
	return true;
}

// Form_CustomValidate event
ft_jdw_krj_defgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft_jdw_krj_defgrid.ValidateRequired = true;
<?php } else { ?>
ft_jdw_krj_defgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft_jdw_krj_defgrid.Lists["x_pegawai_id"] = {"LinkField":"x_pegawai_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_pegawai_nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pegawai"};
ft_jdw_krj_defgrid.Lists["x_jk_id"] = {"LinkField":"x_jk_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_jk_nm","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t_jk"};
ft_jdw_krj_defgrid.Lists["x_hk_def"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft_jdw_krj_defgrid.Lists["x_hk_def"].Options = <?php echo json_encode($t_jdw_krj_def->hk_def->Options()) ?>;

// Form object for search
</script>
<?php } ?>
<?php
if ($t_jdw_krj_def->CurrentAction == "gridadd") {
	if ($t_jdw_krj_def->CurrentMode == "copy") {
		$bSelectLimit = $t_jdw_krj_def_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t_jdw_krj_def_grid->TotalRecs = $t_jdw_krj_def->SelectRecordCount();
			$t_jdw_krj_def_grid->Recordset = $t_jdw_krj_def_grid->LoadRecordset($t_jdw_krj_def_grid->StartRec-1, $t_jdw_krj_def_grid->DisplayRecs);
		} else {
			if ($t_jdw_krj_def_grid->Recordset = $t_jdw_krj_def_grid->LoadRecordset())
				$t_jdw_krj_def_grid->TotalRecs = $t_jdw_krj_def_grid->Recordset->RecordCount();
		}
		$t_jdw_krj_def_grid->StartRec = 1;
		$t_jdw_krj_def_grid->DisplayRecs = $t_jdw_krj_def_grid->TotalRecs;
	} else {
		$t_jdw_krj_def->CurrentFilter = "0=1";
		$t_jdw_krj_def_grid->StartRec = 1;
		$t_jdw_krj_def_grid->DisplayRecs = $t_jdw_krj_def->GridAddRowCount;
	}
	$t_jdw_krj_def_grid->TotalRecs = $t_jdw_krj_def_grid->DisplayRecs;
	$t_jdw_krj_def_grid->StopRec = $t_jdw_krj_def_grid->DisplayRecs;
} else {
	$bSelectLimit = $t_jdw_krj_def_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t_jdw_krj_def_grid->TotalRecs <= 0)
			$t_jdw_krj_def_grid->TotalRecs = $t_jdw_krj_def->SelectRecordCount();
	} else {
		if (!$t_jdw_krj_def_grid->Recordset && ($t_jdw_krj_def_grid->Recordset = $t_jdw_krj_def_grid->LoadRecordset()))
			$t_jdw_krj_def_grid->TotalRecs = $t_jdw_krj_def_grid->Recordset->RecordCount();
	}
	$t_jdw_krj_def_grid->StartRec = 1;
	$t_jdw_krj_def_grid->DisplayRecs = $t_jdw_krj_def_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t_jdw_krj_def_grid->Recordset = $t_jdw_krj_def_grid->LoadRecordset($t_jdw_krj_def_grid->StartRec-1, $t_jdw_krj_def_grid->DisplayRecs);

	// Set no record found message
	if ($t_jdw_krj_def->CurrentAction == "" && $t_jdw_krj_def_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t_jdw_krj_def_grid->setWarningMessage(ew_DeniedMsg());
		if ($t_jdw_krj_def_grid->SearchWhere == "0=101")
			$t_jdw_krj_def_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t_jdw_krj_def_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t_jdw_krj_def_grid->RenderOtherOptions();
?>
<?php $t_jdw_krj_def_grid->ShowPageHeader(); ?>
<?php
$t_jdw_krj_def_grid->ShowMessage();
?>
<?php if ($t_jdw_krj_def_grid->TotalRecs > 0 || $t_jdw_krj_def->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t_jdw_krj_def">
<div id="ft_jdw_krj_defgrid" class="ewForm form-inline">
<?php if ($t_jdw_krj_def_grid->ShowOtherOptions) { ?>
<div class="panel-heading ewGridUpperPanel">
<?php
	foreach ($t_jdw_krj_def_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_t_jdw_krj_def" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t_jdw_krj_defgrid" class="table ewTable">
<?php echo $t_jdw_krj_def->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t_jdw_krj_def_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t_jdw_krj_def_grid->RenderListOptions();

// Render list options (header, left)
$t_jdw_krj_def_grid->ListOptions->Render("header", "left");
?>
<?php if ($t_jdw_krj_def->pegawai_id->Visible) { // pegawai_id ?>
	<?php if ($t_jdw_krj_def->SortUrl($t_jdw_krj_def->pegawai_id) == "") { ?>
		<th data-name="pegawai_id"><div id="elh_t_jdw_krj_def_pegawai_id" class="t_jdw_krj_def_pegawai_id"><div class="ewTableHeaderCaption"><?php echo $t_jdw_krj_def->pegawai_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai_id"><div><div id="elh_t_jdw_krj_def_pegawai_id" class="t_jdw_krj_def_pegawai_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t_jdw_krj_def->pegawai_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t_jdw_krj_def->pegawai_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t_jdw_krj_def->pegawai_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t_jdw_krj_def->tgl->Visible) { // tgl ?>
	<?php if ($t_jdw_krj_def->SortUrl($t_jdw_krj_def->tgl) == "") { ?>
		<th data-name="tgl"><div id="elh_t_jdw_krj_def_tgl" class="t_jdw_krj_def_tgl"><div class="ewTableHeaderCaption"><?php echo $t_jdw_krj_def->tgl->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl"><div><div id="elh_t_jdw_krj_def_tgl" class="t_jdw_krj_def_tgl">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t_jdw_krj_def->tgl->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t_jdw_krj_def->tgl->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t_jdw_krj_def->tgl->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t_jdw_krj_def->jk_id->Visible) { // jk_id ?>
	<?php if ($t_jdw_krj_def->SortUrl($t_jdw_krj_def->jk_id) == "") { ?>
		<th data-name="jk_id"><div id="elh_t_jdw_krj_def_jk_id" class="t_jdw_krj_def_jk_id"><div class="ewTableHeaderCaption"><?php echo $t_jdw_krj_def->jk_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jk_id"><div><div id="elh_t_jdw_krj_def_jk_id" class="t_jdw_krj_def_jk_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t_jdw_krj_def->jk_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t_jdw_krj_def->jk_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t_jdw_krj_def->jk_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t_jdw_krj_def->hk_def->Visible) { // hk_def ?>
	<?php if ($t_jdw_krj_def->SortUrl($t_jdw_krj_def->hk_def) == "") { ?>
		<th data-name="hk_def"><div id="elh_t_jdw_krj_def_hk_def" class="t_jdw_krj_def_hk_def"><div class="ewTableHeaderCaption"><?php echo $t_jdw_krj_def->hk_def->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hk_def"><div><div id="elh_t_jdw_krj_def_hk_def" class="t_jdw_krj_def_hk_def">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t_jdw_krj_def->hk_def->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t_jdw_krj_def->hk_def->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t_jdw_krj_def->hk_def->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t_jdw_krj_def_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_jdw_krj_def_grid->StartRec = 1;
$t_jdw_krj_def_grid->StopRec = $t_jdw_krj_def_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t_jdw_krj_def_grid->FormKeyCountName) && ($t_jdw_krj_def->CurrentAction == "gridadd" || $t_jdw_krj_def->CurrentAction == "gridedit" || $t_jdw_krj_def->CurrentAction == "F")) {
		$t_jdw_krj_def_grid->KeyCount = $objForm->GetValue($t_jdw_krj_def_grid->FormKeyCountName);
		$t_jdw_krj_def_grid->StopRec = $t_jdw_krj_def_grid->StartRec + $t_jdw_krj_def_grid->KeyCount - 1;
	}
}
$t_jdw_krj_def_grid->RecCnt = $t_jdw_krj_def_grid->StartRec - 1;
if ($t_jdw_krj_def_grid->Recordset && !$t_jdw_krj_def_grid->Recordset->EOF) {
	$t_jdw_krj_def_grid->Recordset->MoveFirst();
	$bSelectLimit = $t_jdw_krj_def_grid->UseSelectLimit;
	if (!$bSelectLimit && $t_jdw_krj_def_grid->StartRec > 1)
		$t_jdw_krj_def_grid->Recordset->Move($t_jdw_krj_def_grid->StartRec - 1);
} elseif (!$t_jdw_krj_def->AllowAddDeleteRow && $t_jdw_krj_def_grid->StopRec == 0) {
	$t_jdw_krj_def_grid->StopRec = $t_jdw_krj_def->GridAddRowCount;
}

// Initialize aggregate
$t_jdw_krj_def->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t_jdw_krj_def->ResetAttrs();
$t_jdw_krj_def_grid->RenderRow();
if ($t_jdw_krj_def->CurrentAction == "gridadd")
	$t_jdw_krj_def_grid->RowIndex = 0;
if ($t_jdw_krj_def->CurrentAction == "gridedit")
	$t_jdw_krj_def_grid->RowIndex = 0;
while ($t_jdw_krj_def_grid->RecCnt < $t_jdw_krj_def_grid->StopRec) {
	$t_jdw_krj_def_grid->RecCnt++;
	if (intval($t_jdw_krj_def_grid->RecCnt) >= intval($t_jdw_krj_def_grid->StartRec)) {
		$t_jdw_krj_def_grid->RowCnt++;
		if ($t_jdw_krj_def->CurrentAction == "gridadd" || $t_jdw_krj_def->CurrentAction == "gridedit" || $t_jdw_krj_def->CurrentAction == "F") {
			$t_jdw_krj_def_grid->RowIndex++;
			$objForm->Index = $t_jdw_krj_def_grid->RowIndex;
			if ($objForm->HasValue($t_jdw_krj_def_grid->FormActionName))
				$t_jdw_krj_def_grid->RowAction = strval($objForm->GetValue($t_jdw_krj_def_grid->FormActionName));
			elseif ($t_jdw_krj_def->CurrentAction == "gridadd")
				$t_jdw_krj_def_grid->RowAction = "insert";
			else
				$t_jdw_krj_def_grid->RowAction = "";
		}

		// Set up key count
		$t_jdw_krj_def_grid->KeyCount = $t_jdw_krj_def_grid->RowIndex;

		// Init row class and style
		$t_jdw_krj_def->ResetAttrs();
		$t_jdw_krj_def->CssClass = "";
		if ($t_jdw_krj_def->CurrentAction == "gridadd") {
			if ($t_jdw_krj_def->CurrentMode == "copy") {
				$t_jdw_krj_def_grid->LoadRowValues($t_jdw_krj_def_grid->Recordset); // Load row values
				$t_jdw_krj_def_grid->SetRecordKey($t_jdw_krj_def_grid->RowOldKey, $t_jdw_krj_def_grid->Recordset); // Set old record key
			} else {
				$t_jdw_krj_def_grid->LoadDefaultValues(); // Load default values
				$t_jdw_krj_def_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_jdw_krj_def_grid->LoadRowValues($t_jdw_krj_def_grid->Recordset); // Load row values
		}
		$t_jdw_krj_def->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t_jdw_krj_def->CurrentAction == "gridadd") // Grid add
			$t_jdw_krj_def->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t_jdw_krj_def->CurrentAction == "gridadd" && $t_jdw_krj_def->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t_jdw_krj_def_grid->RestoreCurrentRowFormValues($t_jdw_krj_def_grid->RowIndex); // Restore form values
		if ($t_jdw_krj_def->CurrentAction == "gridedit") { // Grid edit
			if ($t_jdw_krj_def->EventCancelled) {
				$t_jdw_krj_def_grid->RestoreCurrentRowFormValues($t_jdw_krj_def_grid->RowIndex); // Restore form values
			}
			if ($t_jdw_krj_def_grid->RowAction == "insert")
				$t_jdw_krj_def->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t_jdw_krj_def->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t_jdw_krj_def->CurrentAction == "gridedit" && ($t_jdw_krj_def->RowType == EW_ROWTYPE_EDIT || $t_jdw_krj_def->RowType == EW_ROWTYPE_ADD) && $t_jdw_krj_def->EventCancelled) // Update failed
			$t_jdw_krj_def_grid->RestoreCurrentRowFormValues($t_jdw_krj_def_grid->RowIndex); // Restore form values
		if ($t_jdw_krj_def->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t_jdw_krj_def_grid->EditRowCnt++;
		if ($t_jdw_krj_def->CurrentAction == "F") // Confirm row
			$t_jdw_krj_def_grid->RestoreCurrentRowFormValues($t_jdw_krj_def_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_jdw_krj_def->RowAttrs = array_merge($t_jdw_krj_def->RowAttrs, array('data-rowindex'=>$t_jdw_krj_def_grid->RowCnt, 'id'=>'r' . $t_jdw_krj_def_grid->RowCnt . '_t_jdw_krj_def', 'data-rowtype'=>$t_jdw_krj_def->RowType));

		// Render row
		$t_jdw_krj_def_grid->RenderRow();

		// Render list options
		$t_jdw_krj_def_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_jdw_krj_def_grid->RowAction <> "delete" && $t_jdw_krj_def_grid->RowAction <> "insertdelete" && !($t_jdw_krj_def_grid->RowAction == "insert" && $t_jdw_krj_def->CurrentAction == "F" && $t_jdw_krj_def_grid->EmptyRow())) {
?>
	<tr<?php echo $t_jdw_krj_def->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t_jdw_krj_def_grid->ListOptions->Render("body", "left", $t_jdw_krj_def_grid->RowCnt);
?>
	<?php if ($t_jdw_krj_def->pegawai_id->Visible) { // pegawai_id ?>
		<td data-name="pegawai_id"<?php echo $t_jdw_krj_def->pegawai_id->CellAttributes() ?>>
<?php if ($t_jdw_krj_def->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($t_jdw_krj_def->pegawai_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t_jdw_krj_def_grid->RowCnt ?>_t_jdw_krj_def_pegawai_id" class="form-group t_jdw_krj_def_pegawai_id">
<span<?php echo $t_jdw_krj_def->pegawai_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t_jdw_krj_def->pegawai_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->pegawai_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_jdw_krj_def_grid->RowCnt ?>_t_jdw_krj_def_pegawai_id" class="form-group t_jdw_krj_def_pegawai_id">
<?php
$wrkonchange = trim(" " . @$t_jdw_krj_def->pegawai_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t_jdw_krj_def->pegawai_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t_jdw_krj_def_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" id="sv_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo $t_jdw_krj_def->pegawai_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t_jdw_krj_def->pegawai_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t_jdw_krj_def->pegawai_id->getPlaceHolder()) ?>"<?php echo $t_jdw_krj_def->pegawai_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_pegawai_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_jdw_krj_def->pegawai_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->pegawai_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" id="q_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo $t_jdw_krj_def->pegawai_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft_jdw_krj_defgrid.CreateAutoSuggest({"id":"x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t_jdw_krj_def->pegawai_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" name="s_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" id="s_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo $t_jdw_krj_def->pegawai_id->LookupFilterQuery(false) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_pegawai_id" name="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" id="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->pegawai_id->OldValue) ?>">
<?php } ?>
<?php if ($t_jdw_krj_def->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t_jdw_krj_def->pegawai_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t_jdw_krj_def_grid->RowCnt ?>_t_jdw_krj_def_pegawai_id" class="form-group t_jdw_krj_def_pegawai_id">
<span<?php echo $t_jdw_krj_def->pegawai_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t_jdw_krj_def->pegawai_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->pegawai_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_jdw_krj_def_grid->RowCnt ?>_t_jdw_krj_def_pegawai_id" class="form-group t_jdw_krj_def_pegawai_id">
<?php
$wrkonchange = trim(" " . @$t_jdw_krj_def->pegawai_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t_jdw_krj_def->pegawai_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t_jdw_krj_def_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" id="sv_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo $t_jdw_krj_def->pegawai_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t_jdw_krj_def->pegawai_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t_jdw_krj_def->pegawai_id->getPlaceHolder()) ?>"<?php echo $t_jdw_krj_def->pegawai_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_pegawai_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_jdw_krj_def->pegawai_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->pegawai_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" id="q_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo $t_jdw_krj_def->pegawai_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft_jdw_krj_defgrid.CreateAutoSuggest({"id":"x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t_jdw_krj_def->pegawai_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" name="s_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" id="s_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo $t_jdw_krj_def->pegawai_id->LookupFilterQuery(false) ?>">
</span>
<?php } ?>
<?php } ?>
<?php if ($t_jdw_krj_def->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jdw_krj_def_grid->RowCnt ?>_t_jdw_krj_def_pegawai_id" class="t_jdw_krj_def_pegawai_id">
<span<?php echo $t_jdw_krj_def->pegawai_id->ViewAttributes() ?>>
<?php echo $t_jdw_krj_def->pegawai_id->ListViewValue() ?></span>
</span>
<?php if ($t_jdw_krj_def->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_pegawai_id" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->pegawai_id->FormValue) ?>">
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_pegawai_id" name="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" id="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->pegawai_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_pegawai_id" name="ft_jdw_krj_defgrid$x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" id="ft_jdw_krj_defgrid$x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->pegawai_id->FormValue) ?>">
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_pegawai_id" name="ft_jdw_krj_defgrid$o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" id="ft_jdw_krj_defgrid$o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->pegawai_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t_jdw_krj_def_grid->PageObjName . "_row_" . $t_jdw_krj_def_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t_jdw_krj_def->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_jdw_id" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jdw_id" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jdw_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->jdw_id->CurrentValue) ?>">
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_jdw_id" name="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jdw_id" id="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jdw_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->jdw_id->OldValue) ?>">
<?php } ?>
<?php if ($t_jdw_krj_def->RowType == EW_ROWTYPE_EDIT || $t_jdw_krj_def->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_jdw_id" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jdw_id" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jdw_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->jdw_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t_jdw_krj_def->tgl->Visible) { // tgl ?>
		<td data-name="tgl"<?php echo $t_jdw_krj_def->tgl->CellAttributes() ?>>
<?php if ($t_jdw_krj_def->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jdw_krj_def_grid->RowCnt ?>_t_jdw_krj_def_tgl" class="form-group t_jdw_krj_def_tgl">
<input type="text" data-table="t_jdw_krj_def" data-field="x_tgl" data-format="5" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl" placeholder="<?php echo ew_HtmlEncode($t_jdw_krj_def->tgl->getPlaceHolder()) ?>" value="<?php echo $t_jdw_krj_def->tgl->EditValue ?>"<?php echo $t_jdw_krj_def->tgl->EditAttributes() ?>>
<?php if (!$t_jdw_krj_def->tgl->ReadOnly && !$t_jdw_krj_def->tgl->Disabled && !isset($t_jdw_krj_def->tgl->EditAttrs["readonly"]) && !isset($t_jdw_krj_def->tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft_jdw_krj_defgrid", "x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl", 5);
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_tgl" name="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl" id="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->tgl->OldValue) ?>">
<?php } ?>
<?php if ($t_jdw_krj_def->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jdw_krj_def_grid->RowCnt ?>_t_jdw_krj_def_tgl" class="form-group t_jdw_krj_def_tgl">
<input type="text" data-table="t_jdw_krj_def" data-field="x_tgl" data-format="5" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl" placeholder="<?php echo ew_HtmlEncode($t_jdw_krj_def->tgl->getPlaceHolder()) ?>" value="<?php echo $t_jdw_krj_def->tgl->EditValue ?>"<?php echo $t_jdw_krj_def->tgl->EditAttributes() ?>>
<?php if (!$t_jdw_krj_def->tgl->ReadOnly && !$t_jdw_krj_def->tgl->Disabled && !isset($t_jdw_krj_def->tgl->EditAttrs["readonly"]) && !isset($t_jdw_krj_def->tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft_jdw_krj_defgrid", "x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl", 5);
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t_jdw_krj_def->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jdw_krj_def_grid->RowCnt ?>_t_jdw_krj_def_tgl" class="t_jdw_krj_def_tgl">
<span<?php echo $t_jdw_krj_def->tgl->ViewAttributes() ?>>
<?php echo $t_jdw_krj_def->tgl->ListViewValue() ?></span>
</span>
<?php if ($t_jdw_krj_def->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_tgl" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->tgl->FormValue) ?>">
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_tgl" name="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl" id="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->tgl->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_tgl" name="ft_jdw_krj_defgrid$x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl" id="ft_jdw_krj_defgrid$x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->tgl->FormValue) ?>">
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_tgl" name="ft_jdw_krj_defgrid$o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl" id="ft_jdw_krj_defgrid$o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->tgl->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jdw_krj_def->jk_id->Visible) { // jk_id ?>
		<td data-name="jk_id"<?php echo $t_jdw_krj_def->jk_id->CellAttributes() ?>>
<?php if ($t_jdw_krj_def->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jdw_krj_def_grid->RowCnt ?>_t_jdw_krj_def_jk_id" class="form-group t_jdw_krj_def_jk_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id"><?php echo (strval($t_jdw_krj_def->jk_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t_jdw_krj_def->jk_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t_jdw_krj_def->jk_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_jk_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_jdw_krj_def->jk_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" value="<?php echo $t_jdw_krj_def->jk_id->CurrentValue ?>"<?php echo $t_jdw_krj_def->jk_id->EditAttributes() ?>>
<input type="hidden" name="s_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" id="s_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" value="<?php echo $t_jdw_krj_def->jk_id->LookupFilterQuery() ?>">
</span>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_jk_id" name="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" id="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->jk_id->OldValue) ?>">
<?php } ?>
<?php if ($t_jdw_krj_def->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jdw_krj_def_grid->RowCnt ?>_t_jdw_krj_def_jk_id" class="form-group t_jdw_krj_def_jk_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id"><?php echo (strval($t_jdw_krj_def->jk_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t_jdw_krj_def->jk_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t_jdw_krj_def->jk_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_jk_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_jdw_krj_def->jk_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" value="<?php echo $t_jdw_krj_def->jk_id->CurrentValue ?>"<?php echo $t_jdw_krj_def->jk_id->EditAttributes() ?>>
<input type="hidden" name="s_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" id="s_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" value="<?php echo $t_jdw_krj_def->jk_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php if ($t_jdw_krj_def->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jdw_krj_def_grid->RowCnt ?>_t_jdw_krj_def_jk_id" class="t_jdw_krj_def_jk_id">
<span<?php echo $t_jdw_krj_def->jk_id->ViewAttributes() ?>>
<?php echo $t_jdw_krj_def->jk_id->ListViewValue() ?></span>
</span>
<?php if ($t_jdw_krj_def->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_jk_id" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->jk_id->FormValue) ?>">
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_jk_id" name="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" id="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->jk_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_jk_id" name="ft_jdw_krj_defgrid$x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" id="ft_jdw_krj_defgrid$x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->jk_id->FormValue) ?>">
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_jk_id" name="ft_jdw_krj_defgrid$o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" id="ft_jdw_krj_defgrid$o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->jk_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jdw_krj_def->hk_def->Visible) { // hk_def ?>
		<td data-name="hk_def"<?php echo $t_jdw_krj_def->hk_def->CellAttributes() ?>>
<?php if ($t_jdw_krj_def->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jdw_krj_def_grid->RowCnt ?>_t_jdw_krj_def_hk_def" class="form-group t_jdw_krj_def_hk_def">
<div id="tp_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" class="ewTemplate"><input type="radio" data-table="t_jdw_krj_def" data-field="x_hk_def" data-value-separator="<?php echo $t_jdw_krj_def->hk_def->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" value="{value}"<?php echo $t_jdw_krj_def->hk_def->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $t_jdw_krj_def->hk_def->RadioButtonListHtml(FALSE, "x{$t_jdw_krj_def_grid->RowIndex}_hk_def") ?>
</div></div>
</span>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_hk_def" name="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" id="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->hk_def->OldValue) ?>">
<?php } ?>
<?php if ($t_jdw_krj_def->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jdw_krj_def_grid->RowCnt ?>_t_jdw_krj_def_hk_def" class="form-group t_jdw_krj_def_hk_def">
<div id="tp_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" class="ewTemplate"><input type="radio" data-table="t_jdw_krj_def" data-field="x_hk_def" data-value-separator="<?php echo $t_jdw_krj_def->hk_def->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" value="{value}"<?php echo $t_jdw_krj_def->hk_def->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $t_jdw_krj_def->hk_def->RadioButtonListHtml(FALSE, "x{$t_jdw_krj_def_grid->RowIndex}_hk_def") ?>
</div></div>
</span>
<?php } ?>
<?php if ($t_jdw_krj_def->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jdw_krj_def_grid->RowCnt ?>_t_jdw_krj_def_hk_def" class="t_jdw_krj_def_hk_def">
<span<?php echo $t_jdw_krj_def->hk_def->ViewAttributes() ?>>
<?php echo $t_jdw_krj_def->hk_def->ListViewValue() ?></span>
</span>
<?php if ($t_jdw_krj_def->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_hk_def" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->hk_def->FormValue) ?>">
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_hk_def" name="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" id="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->hk_def->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_hk_def" name="ft_jdw_krj_defgrid$x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" id="ft_jdw_krj_defgrid$x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->hk_def->FormValue) ?>">
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_hk_def" name="ft_jdw_krj_defgrid$o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" id="ft_jdw_krj_defgrid$o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->hk_def->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_jdw_krj_def_grid->ListOptions->Render("body", "right", $t_jdw_krj_def_grid->RowCnt);
?>
	</tr>
<?php if ($t_jdw_krj_def->RowType == EW_ROWTYPE_ADD || $t_jdw_krj_def->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft_jdw_krj_defgrid.UpdateOpts(<?php echo $t_jdw_krj_def_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t_jdw_krj_def->CurrentAction <> "gridadd" || $t_jdw_krj_def->CurrentMode == "copy")
		if (!$t_jdw_krj_def_grid->Recordset->EOF) $t_jdw_krj_def_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t_jdw_krj_def->CurrentMode == "add" || $t_jdw_krj_def->CurrentMode == "copy" || $t_jdw_krj_def->CurrentMode == "edit") {
		$t_jdw_krj_def_grid->RowIndex = '$rowindex$';
		$t_jdw_krj_def_grid->LoadDefaultValues();

		// Set row properties
		$t_jdw_krj_def->ResetAttrs();
		$t_jdw_krj_def->RowAttrs = array_merge($t_jdw_krj_def->RowAttrs, array('data-rowindex'=>$t_jdw_krj_def_grid->RowIndex, 'id'=>'r0_t_jdw_krj_def', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t_jdw_krj_def->RowAttrs["class"], "ewTemplate");
		$t_jdw_krj_def->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t_jdw_krj_def_grid->RenderRow();

		// Render list options
		$t_jdw_krj_def_grid->RenderListOptions();
		$t_jdw_krj_def_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t_jdw_krj_def->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t_jdw_krj_def_grid->ListOptions->Render("body", "left", $t_jdw_krj_def_grid->RowIndex);
?>
	<?php if ($t_jdw_krj_def->pegawai_id->Visible) { // pegawai_id ?>
		<td data-name="pegawai_id">
<?php if ($t_jdw_krj_def->CurrentAction <> "F") { ?>
<?php if ($t_jdw_krj_def->pegawai_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_t_jdw_krj_def_pegawai_id" class="form-group t_jdw_krj_def_pegawai_id">
<span<?php echo $t_jdw_krj_def->pegawai_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t_jdw_krj_def->pegawai_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->pegawai_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_jdw_krj_def_pegawai_id" class="form-group t_jdw_krj_def_pegawai_id">
<?php
$wrkonchange = trim(" " . @$t_jdw_krj_def->pegawai_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t_jdw_krj_def->pegawai_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t_jdw_krj_def_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" id="sv_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo $t_jdw_krj_def->pegawai_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t_jdw_krj_def->pegawai_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t_jdw_krj_def->pegawai_id->getPlaceHolder()) ?>"<?php echo $t_jdw_krj_def->pegawai_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_pegawai_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_jdw_krj_def->pegawai_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->pegawai_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" id="q_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo $t_jdw_krj_def->pegawai_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft_jdw_krj_defgrid.CreateAutoSuggest({"id":"x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t_jdw_krj_def->pegawai_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" name="s_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" id="s_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo $t_jdw_krj_def->pegawai_id->LookupFilterQuery(false) ?>">
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_jdw_krj_def_pegawai_id" class="form-group t_jdw_krj_def_pegawai_id">
<span<?php echo $t_jdw_krj_def->pegawai_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t_jdw_krj_def->pegawai_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_pegawai_id" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->pegawai_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_pegawai_id" name="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" id="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->pegawai_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jdw_krj_def->tgl->Visible) { // tgl ?>
		<td data-name="tgl">
<?php if ($t_jdw_krj_def->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t_jdw_krj_def_tgl" class="form-group t_jdw_krj_def_tgl">
<input type="text" data-table="t_jdw_krj_def" data-field="x_tgl" data-format="5" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl" placeholder="<?php echo ew_HtmlEncode($t_jdw_krj_def->tgl->getPlaceHolder()) ?>" value="<?php echo $t_jdw_krj_def->tgl->EditValue ?>"<?php echo $t_jdw_krj_def->tgl->EditAttributes() ?>>
<?php if (!$t_jdw_krj_def->tgl->ReadOnly && !$t_jdw_krj_def->tgl->Disabled && !isset($t_jdw_krj_def->tgl->EditAttrs["readonly"]) && !isset($t_jdw_krj_def->tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft_jdw_krj_defgrid", "x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl", 5);
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jdw_krj_def_tgl" class="form-group t_jdw_krj_def_tgl">
<span<?php echo $t_jdw_krj_def->tgl->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t_jdw_krj_def->tgl->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_tgl" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->tgl->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_tgl" name="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl" id="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_tgl" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->tgl->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jdw_krj_def->jk_id->Visible) { // jk_id ?>
		<td data-name="jk_id">
<?php if ($t_jdw_krj_def->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t_jdw_krj_def_jk_id" class="form-group t_jdw_krj_def_jk_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id"><?php echo (strval($t_jdw_krj_def->jk_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t_jdw_krj_def->jk_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t_jdw_krj_def->jk_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_jk_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_jdw_krj_def->jk_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" value="<?php echo $t_jdw_krj_def->jk_id->CurrentValue ?>"<?php echo $t_jdw_krj_def->jk_id->EditAttributes() ?>>
<input type="hidden" name="s_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" id="s_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" value="<?php echo $t_jdw_krj_def->jk_id->LookupFilterQuery() ?>">
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jdw_krj_def_jk_id" class="form-group t_jdw_krj_def_jk_id">
<span<?php echo $t_jdw_krj_def->jk_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t_jdw_krj_def->jk_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_jk_id" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->jk_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_jk_id" name="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" id="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->jk_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jdw_krj_def->hk_def->Visible) { // hk_def ?>
		<td data-name="hk_def">
<?php if ($t_jdw_krj_def->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t_jdw_krj_def_hk_def" class="form-group t_jdw_krj_def_hk_def">
<div id="tp_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" class="ewTemplate"><input type="radio" data-table="t_jdw_krj_def" data-field="x_hk_def" data-value-separator="<?php echo $t_jdw_krj_def->hk_def->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" value="{value}"<?php echo $t_jdw_krj_def->hk_def->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $t_jdw_krj_def->hk_def->RadioButtonListHtml(FALSE, "x{$t_jdw_krj_def_grid->RowIndex}_hk_def") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jdw_krj_def_hk_def" class="form-group t_jdw_krj_def_hk_def">
<span<?php echo $t_jdw_krj_def->hk_def->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t_jdw_krj_def->hk_def->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_hk_def" name="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" id="x<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->hk_def->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jdw_krj_def" data-field="x_hk_def" name="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" id="o<?php echo $t_jdw_krj_def_grid->RowIndex ?>_hk_def" value="<?php echo ew_HtmlEncode($t_jdw_krj_def->hk_def->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_jdw_krj_def_grid->ListOptions->Render("body", "right", $t_jdw_krj_def_grid->RowCnt);
?>
<script type="text/javascript">
ft_jdw_krj_defgrid.UpdateOpts(<?php echo $t_jdw_krj_def_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t_jdw_krj_def->CurrentMode == "add" || $t_jdw_krj_def->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t_jdw_krj_def_grid->FormKeyCountName ?>" id="<?php echo $t_jdw_krj_def_grid->FormKeyCountName ?>" value="<?php echo $t_jdw_krj_def_grid->KeyCount ?>">
<?php echo $t_jdw_krj_def_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_jdw_krj_def->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t_jdw_krj_def_grid->FormKeyCountName ?>" id="<?php echo $t_jdw_krj_def_grid->FormKeyCountName ?>" value="<?php echo $t_jdw_krj_def_grid->KeyCount ?>">
<?php echo $t_jdw_krj_def_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_jdw_krj_def->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_jdw_krj_defgrid">
</div>
<?php

// Close recordset
if ($t_jdw_krj_def_grid->Recordset)
	$t_jdw_krj_def_grid->Recordset->Close();
?>
<?php if ($t_jdw_krj_def_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t_jdw_krj_def_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t_jdw_krj_def_grid->TotalRecs == 0 && $t_jdw_krj_def->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t_jdw_krj_def_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t_jdw_krj_def->Export == "") { ?>
<script type="text/javascript">
ft_jdw_krj_defgrid.Init();
</script>
<?php } ?>
<?php
$t_jdw_krj_def_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t_jdw_krj_def_grid->Page_Terminate();
?>
