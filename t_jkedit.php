<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t_jkinfo.php" ?>
<?php include_once "t_userinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t_jk_edit = NULL; // Initialize page object first

class ct_jk_edit extends ct_jk {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = "{503C8825-3846-4E96-8DFF-03202C380E17}";

	// Table name
	var $TableName = 't_jk';

	// Page object name
	var $PageObjName = 't_jk_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}
	var $AuditTrailOnAdd = FALSE;
	var $AuditTrailOnEdit = TRUE;
	var $AuditTrailOnDelete = FALSE;
	var $AuditTrailOnView = FALSE;
	var $AuditTrailOnViewData = FALSE;
	var $AuditTrailOnSearch = FALSE;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	function ClearMessage() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
	}

	function ClearFailureMessage() {
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
	}

	function ClearSuccessMessage() {
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
	}

	function ClearWarningMessage() {
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	function ClearMessages() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $TokenTimeout = 0;
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsHttpPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME], $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		global $UserTable, $UserTableConn;
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (t_jk)
		if (!isset($GLOBALS["t_jk"]) || get_class($GLOBALS["t_jk"]) == "ct_jk") {
			$GLOBALS["t_jk"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_jk"];
		}

		// Table object (t_user)
		if (!isset($GLOBALS['t_user'])) $GLOBALS['t_user'] = new ct_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't_jk', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect($this->DBID);

		// User table object (t_user)
		if (!isset($UserTable)) {
			$UserTable = new ct_user();
			$UserTableConn = Conn($UserTable->DBID);
		}
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("t_jklist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->jk_nm->SetVisibility();
		$this->jk_kd->SetVisibility();
		$this->jk_m->SetVisibility();
		$this->jk_k->SetVisibility();
		$this->jk_ket->SetVisibility();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $t_jk;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t_jk);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		 // Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) {
				$row = array();
				$row["url"] = $url;
				echo ew_ArrayToJson(array($row));
			} else {
				header("Location: " . $url);
			}
		}
		exit();
	}
	var $FormClassName = "form-horizontal ewForm ewEditForm";
	var $IsModal = FALSE;
	var $DbMasterFilter;
	var $DbDetailFilter;
	var $DisplayRecs = 1;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $RecCnt;
	var $RecKey = array();
	var $Recordset;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		global $gbSkipHeaderFooter;

		// Check modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;

		// Load key from QueryString
		if (@$_GET["jk_id"] <> "") {
			$this->jk_id->setQueryStringValue($_GET["jk_id"]);
			$this->RecKey["jk_id"] = $this->jk_id->QueryStringValue;
		} else {
			$bLoadCurrentRecord = TRUE;
		}

		// Load recordset
		$this->StartRec = 1; // Initialize start position
		if ($this->Recordset = $this->LoadRecordset()) // Load records
			$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
		if ($this->TotalRecs <= 0) { // No record found
			if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$this->Page_Terminate("t_jklist.php"); // Return to list page
		} elseif ($bLoadCurrentRecord) { // Load current record position
			$this->SetUpStartRec(); // Set up start record position

			// Point to current record
			if (intval($this->StartRec) <= intval($this->TotalRecs)) {
				$bMatchRecord = TRUE;
				$this->Recordset->Move($this->StartRec-1);
			}
		} else { // Match key values
			while (!$this->Recordset->EOF) {
				if (strval($this->jk_id->CurrentValue) == strval($this->Recordset->fields('jk_id'))) {
					$this->setStartRecordNumber($this->StartRec); // Save record position
					$bMatchRecord = TRUE;
					break;
				} else {
					$this->StartRec++;
					$this->Recordset->MoveNext();
				}
			}
		}

		// Process form if post back
		if (@$_POST["a_edit"] <> "") {
			$this->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values
		} else {
			$this->CurrentAction = "I"; // Default action is display
		}

		// Validate form if post back
		if (@$_POST["a_edit"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		}
		switch ($this->CurrentAction) {
			case "I": // Get a record to display
				if (!$bMatchRecord) {
					if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
						$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
					$this->Page_Terminate("t_jklist.php"); // Return to list page
				} else {
					$this->LoadRowValues($this->Recordset); // Load row values
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "t_jklist.php")
					$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} elseif ($this->getFailureMessage() == $Language->Phrase("NoRecord")) {
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render the record
		$this->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->jk_nm->FldIsDetailKey) {
			$this->jk_nm->setFormValue($objForm->GetValue("x_jk_nm"));
		}
		if (!$this->jk_kd->FldIsDetailKey) {
			$this->jk_kd->setFormValue($objForm->GetValue("x_jk_kd"));
		}
		if (!$this->jk_m->FldIsDetailKey) {
			$this->jk_m->setFormValue($objForm->GetValue("x_jk_m"));
			$this->jk_m->CurrentValue = ew_UnFormatDateTime($this->jk_m->CurrentValue, 4);
		}
		if (!$this->jk_k->FldIsDetailKey) {
			$this->jk_k->setFormValue($objForm->GetValue("x_jk_k"));
			$this->jk_k->CurrentValue = ew_UnFormatDateTime($this->jk_k->CurrentValue, 4);
		}
		if (!$this->jk_ket->FldIsDetailKey) {
			$this->jk_ket->setFormValue($objForm->GetValue("x_jk_ket"));
		}
		if (!$this->jk_id->FldIsDetailKey)
			$this->jk_id->setFormValue($objForm->GetValue("x_jk_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadRow();
		$this->jk_id->CurrentValue = $this->jk_id->FormValue;
		$this->jk_nm->CurrentValue = $this->jk_nm->FormValue;
		$this->jk_kd->CurrentValue = $this->jk_kd->FormValue;
		$this->jk_m->CurrentValue = $this->jk_m->FormValue;
		$this->jk_m->CurrentValue = ew_UnFormatDateTime($this->jk_m->CurrentValue, 4);
		$this->jk_k->CurrentValue = $this->jk_k->FormValue;
		$this->jk_k->CurrentValue = ew_UnFormatDateTime($this->jk_k->CurrentValue, 4);
		$this->jk_ket->CurrentValue = $this->jk_ket->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->SelectSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row = &$rs->fields;
		$this->Row_Selected($row);
		$this->jk_id->setDbValue($rs->fields('jk_id'));
		$this->jk_nm->setDbValue($rs->fields('jk_nm'));
		$this->jk_kd->setDbValue($rs->fields('jk_kd'));
		$this->jk_m->setDbValue($rs->fields('jk_m'));
		$this->jk_k->setDbValue($rs->fields('jk_k'));
		$this->jk_ket->setDbValue($rs->fields('jk_ket'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->jk_id->DbValue = $row['jk_id'];
		$this->jk_nm->DbValue = $row['jk_nm'];
		$this->jk_kd->DbValue = $row['jk_kd'];
		$this->jk_m->DbValue = $row['jk_m'];
		$this->jk_k->DbValue = $row['jk_k'];
		$this->jk_ket->DbValue = $row['jk_ket'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// jk_id
		// jk_nm
		// jk_kd
		// jk_m
		// jk_k
		// jk_ket

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// jk_id
		$this->jk_id->ViewValue = $this->jk_id->CurrentValue;
		$this->jk_id->ViewCustomAttributes = "";

		// jk_nm
		$this->jk_nm->ViewValue = $this->jk_nm->CurrentValue;
		$this->jk_nm->ViewCustomAttributes = "";

		// jk_kd
		$this->jk_kd->ViewValue = $this->jk_kd->CurrentValue;
		$this->jk_kd->ViewCustomAttributes = "";

		// jk_m
		$this->jk_m->ViewValue = $this->jk_m->CurrentValue;
		$this->jk_m->ViewValue = ew_FormatDateTime($this->jk_m->ViewValue, 4);
		$this->jk_m->ViewCustomAttributes = "";

		// jk_k
		$this->jk_k->ViewValue = $this->jk_k->CurrentValue;
		$this->jk_k->ViewValue = ew_FormatDateTime($this->jk_k->ViewValue, 4);
		$this->jk_k->ViewCustomAttributes = "";

		// jk_ket
		$this->jk_ket->ViewValue = $this->jk_ket->CurrentValue;
		$this->jk_ket->ViewCustomAttributes = "";

			// jk_nm
			$this->jk_nm->LinkCustomAttributes = "";
			$this->jk_nm->HrefValue = "";
			$this->jk_nm->TooltipValue = "";

			// jk_kd
			$this->jk_kd->LinkCustomAttributes = "";
			$this->jk_kd->HrefValue = "";
			$this->jk_kd->TooltipValue = "";

			// jk_m
			$this->jk_m->LinkCustomAttributes = "";
			$this->jk_m->HrefValue = "";
			$this->jk_m->TooltipValue = "";

			// jk_k
			$this->jk_k->LinkCustomAttributes = "";
			$this->jk_k->HrefValue = "";
			$this->jk_k->TooltipValue = "";

			// jk_ket
			$this->jk_ket->LinkCustomAttributes = "";
			$this->jk_ket->HrefValue = "";
			$this->jk_ket->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// jk_nm
			$this->jk_nm->EditAttrs["class"] = "form-control";
			$this->jk_nm->EditCustomAttributes = "";
			$this->jk_nm->EditValue = ew_HtmlEncode($this->jk_nm->CurrentValue);
			$this->jk_nm->PlaceHolder = ew_RemoveHtml($this->jk_nm->FldCaption());

			// jk_kd
			$this->jk_kd->EditAttrs["class"] = "form-control";
			$this->jk_kd->EditCustomAttributes = "";
			$this->jk_kd->EditValue = ew_HtmlEncode($this->jk_kd->CurrentValue);
			$this->jk_kd->PlaceHolder = ew_RemoveHtml($this->jk_kd->FldCaption());

			// jk_m
			$this->jk_m->EditAttrs["class"] = "form-control";
			$this->jk_m->EditCustomAttributes = "";
			$this->jk_m->EditValue = ew_HtmlEncode($this->jk_m->CurrentValue);
			$this->jk_m->PlaceHolder = ew_RemoveHtml($this->jk_m->FldCaption());

			// jk_k
			$this->jk_k->EditAttrs["class"] = "form-control";
			$this->jk_k->EditCustomAttributes = "";
			$this->jk_k->EditValue = ew_HtmlEncode($this->jk_k->CurrentValue);
			$this->jk_k->PlaceHolder = ew_RemoveHtml($this->jk_k->FldCaption());

			// jk_ket
			$this->jk_ket->EditAttrs["class"] = "form-control";
			$this->jk_ket->EditCustomAttributes = "";
			$this->jk_ket->EditValue = ew_HtmlEncode($this->jk_ket->CurrentValue);
			$this->jk_ket->PlaceHolder = ew_RemoveHtml($this->jk_ket->FldCaption());

			// Edit refer script
			// jk_nm

			$this->jk_nm->LinkCustomAttributes = "";
			$this->jk_nm->HrefValue = "";

			// jk_kd
			$this->jk_kd->LinkCustomAttributes = "";
			$this->jk_kd->HrefValue = "";

			// jk_m
			$this->jk_m->LinkCustomAttributes = "";
			$this->jk_m->HrefValue = "";

			// jk_k
			$this->jk_k->LinkCustomAttributes = "";
			$this->jk_k->HrefValue = "";

			// jk_ket
			$this->jk_ket->LinkCustomAttributes = "";
			$this->jk_ket->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD ||
			$this->RowType == EW_ROWTYPE_EDIT ||
			$this->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$this->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->jk_nm->FldIsDetailKey && !is_null($this->jk_nm->FormValue) && $this->jk_nm->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->jk_nm->FldCaption(), $this->jk_nm->ReqErrMsg));
		}
		if (!$this->jk_kd->FldIsDetailKey && !is_null($this->jk_kd->FormValue) && $this->jk_kd->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->jk_kd->FldCaption(), $this->jk_kd->ReqErrMsg));
		}
		if (!$this->jk_m->FldIsDetailKey && !is_null($this->jk_m->FormValue) && $this->jk_m->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->jk_m->FldCaption(), $this->jk_m->ReqErrMsg));
		}
		if (!ew_CheckTime($this->jk_m->FormValue)) {
			ew_AddMessage($gsFormError, $this->jk_m->FldErrMsg());
		}
		if (!$this->jk_k->FldIsDetailKey && !is_null($this->jk_k->FormValue) && $this->jk_k->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->jk_k->FldCaption(), $this->jk_k->ReqErrMsg));
		}
		if (!ew_CheckTime($this->jk_k->FormValue)) {
			ew_AddMessage($gsFormError, $this->jk_k->FldErrMsg());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$conn = &$this->Connection();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// jk_nm
			$this->jk_nm->SetDbValueDef($rsnew, $this->jk_nm->CurrentValue, "", $this->jk_nm->ReadOnly);

			// jk_kd
			$this->jk_kd->SetDbValueDef($rsnew, $this->jk_kd->CurrentValue, "", $this->jk_kd->ReadOnly);

			// jk_m
			$this->jk_m->SetDbValueDef($rsnew, $this->jk_m->CurrentValue, ew_CurrentTime(), $this->jk_m->ReadOnly);

			// jk_k
			$this->jk_k->SetDbValueDef($rsnew, $this->jk_k->CurrentValue, ew_CurrentTime(), $this->jk_k->ReadOnly);

			// jk_ket
			$this->jk_ket->SetDbValueDef($rsnew, $this->jk_ket->CurrentValue, NULL, $this->jk_ket->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t_jklist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 't_jk';
		$usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $Language;
		if (!$this->AuditTrailOnEdit) return;
		$table = 't_jk';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['jk_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if ($this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->FldHtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->Phrase("PasswordMask");
						$newvalue = $Language->Phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($t_jk_edit)) $t_jk_edit = new ct_jk_edit();

// Page init
$t_jk_edit->Page_Init();

// Page main
$t_jk_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_jk_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ft_jkedit = new ew_Form("ft_jkedit", "edit");

// Validate form
ft_jkedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_jk_nm");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t_jk->jk_nm->FldCaption(), $t_jk->jk_nm->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_jk_kd");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t_jk->jk_kd->FldCaption(), $t_jk->jk_kd->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_jk_m");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t_jk->jk_m->FldCaption(), $t_jk->jk_m->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_jk_m");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jk->jk_m->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_jk_k");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t_jk->jk_k->FldCaption(), $t_jk->jk_k->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_jk_k");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jk->jk_k->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft_jkedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft_jkedit.ValidateRequired = true;
<?php } else { ?>
ft_jkedit.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t_jk_edit->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_jk_edit->ShowPageHeader(); ?>
<?php
$t_jk_edit->ShowMessage();
?>
<?php if (!$t_jk_edit->IsModal) { ?>
<form name="ewPagerForm" class="form-horizontal ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t_jk_edit->Pager)) $t_jk_edit->Pager = new cPrevNextPager($t_jk_edit->StartRec, $t_jk_edit->DisplayRecs, $t_jk_edit->TotalRecs) ?>
<?php if ($t_jk_edit->Pager->RecordCount > 0 && $t_jk_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t_jk_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t_jk_edit->PageUrl() ?>start=<?php echo $t_jk_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t_jk_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t_jk_edit->PageUrl() ?>start=<?php echo $t_jk_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t_jk_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t_jk_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t_jk_edit->PageUrl() ?>start=<?php echo $t_jk_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t_jk_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t_jk_edit->PageUrl() ?>start=<?php echo $t_jk_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t_jk_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="ft_jkedit" id="ft_jkedit" class="<?php echo $t_jk_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t_jk_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t_jk_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_jk">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<?php if ($t_jk_edit->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div>
<?php if ($t_jk->jk_nm->Visible) { // jk_nm ?>
	<div id="r_jk_nm" class="form-group">
		<label id="elh_t_jk_jk_nm" for="x_jk_nm" class="col-sm-2 control-label ewLabel"><?php echo $t_jk->jk_nm->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t_jk->jk_nm->CellAttributes() ?>>
<span id="el_t_jk_jk_nm">
<input type="text" data-table="t_jk" data-field="x_jk_nm" name="x_jk_nm" id="x_jk_nm" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t_jk->jk_nm->getPlaceHolder()) ?>" value="<?php echo $t_jk->jk_nm->EditValue ?>"<?php echo $t_jk->jk_nm->EditAttributes() ?>>
</span>
<?php echo $t_jk->jk_nm->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jk->jk_kd->Visible) { // jk_kd ?>
	<div id="r_jk_kd" class="form-group">
		<label id="elh_t_jk_jk_kd" for="x_jk_kd" class="col-sm-2 control-label ewLabel"><?php echo $t_jk->jk_kd->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t_jk->jk_kd->CellAttributes() ?>>
<span id="el_t_jk_jk_kd">
<input type="text" data-table="t_jk" data-field="x_jk_kd" name="x_jk_kd" id="x_jk_kd" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t_jk->jk_kd->getPlaceHolder()) ?>" value="<?php echo $t_jk->jk_kd->EditValue ?>"<?php echo $t_jk->jk_kd->EditAttributes() ?>>
</span>
<?php echo $t_jk->jk_kd->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jk->jk_m->Visible) { // jk_m ?>
	<div id="r_jk_m" class="form-group">
		<label id="elh_t_jk_jk_m" for="x_jk_m" class="col-sm-2 control-label ewLabel"><?php echo $t_jk->jk_m->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t_jk->jk_m->CellAttributes() ?>>
<span id="el_t_jk_jk_m">
<input type="text" data-table="t_jk" data-field="x_jk_m" name="x_jk_m" id="x_jk_m" size="30" placeholder="<?php echo ew_HtmlEncode($t_jk->jk_m->getPlaceHolder()) ?>" value="<?php echo $t_jk->jk_m->EditValue ?>"<?php echo $t_jk->jk_m->EditAttributes() ?>>
</span>
<?php echo $t_jk->jk_m->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jk->jk_k->Visible) { // jk_k ?>
	<div id="r_jk_k" class="form-group">
		<label id="elh_t_jk_jk_k" for="x_jk_k" class="col-sm-2 control-label ewLabel"><?php echo $t_jk->jk_k->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t_jk->jk_k->CellAttributes() ?>>
<span id="el_t_jk_jk_k">
<input type="text" data-table="t_jk" data-field="x_jk_k" name="x_jk_k" id="x_jk_k" size="30" placeholder="<?php echo ew_HtmlEncode($t_jk->jk_k->getPlaceHolder()) ?>" value="<?php echo $t_jk->jk_k->EditValue ?>"<?php echo $t_jk->jk_k->EditAttributes() ?>>
</span>
<?php echo $t_jk->jk_k->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jk->jk_ket->Visible) { // jk_ket ?>
	<div id="r_jk_ket" class="form-group">
		<label id="elh_t_jk_jk_ket" for="x_jk_ket" class="col-sm-2 control-label ewLabel"><?php echo $t_jk->jk_ket->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jk->jk_ket->CellAttributes() ?>>
<span id="el_t_jk_jk_ket">
<textarea data-table="t_jk" data-field="x_jk_ket" name="x_jk_ket" id="x_jk_ket" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t_jk->jk_ket->getPlaceHolder()) ?>"<?php echo $t_jk->jk_ket->EditAttributes() ?>><?php echo $t_jk->jk_ket->EditValue ?></textarea>
</span>
<?php echo $t_jk->jk_ket->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<input type="hidden" data-table="t_jk" data-field="x_jk_id" name="x_jk_id" id="x_jk_id" value="<?php echo ew_HtmlEncode($t_jk->jk_id->CurrentValue) ?>">
<?php if (!$t_jk_edit->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t_jk_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php if (!isset($t_jk_edit->Pager)) $t_jk_edit->Pager = new cPrevNextPager($t_jk_edit->StartRec, $t_jk_edit->DisplayRecs, $t_jk_edit->TotalRecs) ?>
<?php if ($t_jk_edit->Pager->RecordCount > 0 && $t_jk_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t_jk_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t_jk_edit->PageUrl() ?>start=<?php echo $t_jk_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t_jk_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t_jk_edit->PageUrl() ?>start=<?php echo $t_jk_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t_jk_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t_jk_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t_jk_edit->PageUrl() ?>start=<?php echo $t_jk_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t_jk_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t_jk_edit->PageUrl() ?>start=<?php echo $t_jk_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t_jk_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<script type="text/javascript">
ft_jkedit.Init();
</script>
<?php
$t_jk_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t_jk_edit->Page_Terminate();
?>
