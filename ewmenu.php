<!-- Begin Main Menu -->
<?php $RootMenu = new cMenu(EW_MENUBAR_ID) ?>
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(70, "mi_dashboard_php", $Language->MenuPhrase("70", "MenuText"), "dashboard.php", -1, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}dashboard.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(71, "mci_Setup", $Language->MenuPhrase("71", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(30, "mi_pegawai", $Language->MenuPhrase("30", "MenuText"), "pegawailist.php", 71, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}pegawai'), FALSE, FALSE);
$RootMenu->AddMenuItem(42, "mi_t_jdw_krj_peg", $Language->MenuPhrase("42", "MenuText"), "t_jdw_krj_peglist.php?cmd=resetall", 30, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}t_jdw_krj_peg'), FALSE, FALSE);
$RootMenu->AddMenuItem(41, "mi_t_jdw_krj_def", $Language->MenuPhrase("41", "MenuText"), "t_jdw_krj_deflist.php", 30, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}t_jdw_krj_def'), FALSE, FALSE);
$RootMenu->AddMenuItem(45, "mi_t_rumus_peg", $Language->MenuPhrase("45", "MenuText"), "t_rumus_peglist.php?cmd=resetall", 30, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}t_rumus_peg'), FALSE, FALSE);
$RootMenu->AddMenuItem(32, "mi_pembagian1", $Language->MenuPhrase("32", "MenuText"), "pembagian1list.php", 71, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}pembagian1'), FALSE, FALSE);
$RootMenu->AddMenuItem(33, "mi_pembagian2", $Language->MenuPhrase("33", "MenuText"), "pembagian2list.php", 71, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}pembagian2'), FALSE, FALSE);
$RootMenu->AddMenuItem(34, "mi_pembagian3", $Language->MenuPhrase("34", "MenuText"), "pembagian3list.php", 71, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}pembagian3'), FALSE, FALSE);
$RootMenu->AddMenuItem(43, "mi_t_jk", $Language->MenuPhrase("43", "MenuText"), "t_jklist.php", 71, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}t_jk'), FALSE, FALSE);
$RootMenu->AddMenuItem(44, "mi_t_rumus", $Language->MenuPhrase("44", "MenuText"), "t_rumuslist.php", 71, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}t_rumus'), FALSE, FALSE);
$RootMenu->AddMenuItem(46, "mi_t_user", $Language->MenuPhrase("46", "MenuText"), "t_userlist.php", 71, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}t_user'), FALSE, FALSE);
$RootMenu->AddMenuItem(72, "mci_Proses", $Language->MenuPhrase("72", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(74, "mi_gen_jdwkrj__php", $Language->MenuPhrase("74", "MenuText"), "gen_jdwkrj_.php", 72, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}gen_jdwkrj_.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(75, "mi_gen_rekon__php", $Language->MenuPhrase("75", "MenuText"), "gen_rekon_.php", 72, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}gen_rekon_.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(73, "mci_Laporan", $Language->MenuPhrase("73", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(76, "mi_lap_gaji__php", $Language->MenuPhrase("76", "MenuText"), "lap_gaji_.php", 73, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}lap_gaji_.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(2, "mi_audittrail", $Language->MenuPhrase("2", "MenuText"), "audittraillist.php", 73, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}audittrail'), FALSE, FALSE);
$RootMenu->AddMenuItem(-2, "mi_changepwd", $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, "mi_logout", $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, "mi_login", $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
<!-- End Main Menu -->
