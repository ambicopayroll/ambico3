<!-- Begin Main Menu -->
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(70, "mmi_dashboard_php", $Language->MenuPhrase("70", "MenuText"), "dashboard.php", -1, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}dashboard.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(71, "mmci_Setup", $Language->MenuPhrase("71", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(32, "mmi_pembagian1", $Language->MenuPhrase("32", "MenuText"), "pembagian1list.php", 71, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}pembagian1'), FALSE, FALSE);
$RootMenu->AddMenuItem(33, "mmi_pembagian2", $Language->MenuPhrase("33", "MenuText"), "pembagian2list.php", 71, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}pembagian2'), FALSE, FALSE);
$RootMenu->AddMenuItem(34, "mmi_pembagian3", $Language->MenuPhrase("34", "MenuText"), "pembagian3list.php", 71, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}pembagian3'), FALSE, FALSE);
$RootMenu->AddMenuItem(43, "mmi_t_jk", $Language->MenuPhrase("43", "MenuText"), "t_jklist.php", 71, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}t_jk'), FALSE, FALSE);
$RootMenu->AddMenuItem(10076, "mmi_t_rumus2", $Language->MenuPhrase("10076", "MenuText"), "t_rumus2list.php", 71, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}t_rumus2'), FALSE, FALSE);
$RootMenu->AddMenuItem(44, "mmi_t_rumus", $Language->MenuPhrase("44", "MenuText"), "t_rumuslist.php", 71, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}t_rumus'), FALSE, FALSE);
$RootMenu->AddMenuItem(10078, "mmi_t_lapgroup", $Language->MenuPhrase("10078", "MenuText"), "t_lapgrouplist.php", 71, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}t_lapgroup'), FALSE, FALSE);
$RootMenu->AddMenuItem(30, "mmi_pegawai", $Language->MenuPhrase("30", "MenuText"), "pegawailist.php", 71, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}pegawai'), FALSE, FALSE);
$RootMenu->AddMenuItem(42, "mmi_t_jdw_krj_peg", $Language->MenuPhrase("42", "MenuText"), "t_jdw_krj_peglist.php?cmd=resetall", 71, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}t_jdw_krj_peg'), FALSE, FALSE);
$RootMenu->AddMenuItem(41, "mmi_t_jdw_krj_def", $Language->MenuPhrase("41", "MenuText"), "t_jdw_krj_deflist.php", 71, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}t_jdw_krj_def'), FALSE, FALSE);
$RootMenu->AddMenuItem(10075, "mmi_t_rumus2_peg", $Language->MenuPhrase("10075", "MenuText"), "t_rumus2_peglist.php?cmd=resetall", 71, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}t_rumus2_peg'), FALSE, FALSE);
$RootMenu->AddMenuItem(45, "mmi_t_rumus_peg", $Language->MenuPhrase("45", "MenuText"), "t_rumus_peglist.php?cmd=resetall", 71, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}t_rumus_peg'), FALSE, FALSE);
$RootMenu->AddMenuItem(46, "mmi_t_user", $Language->MenuPhrase("46", "MenuText"), "t_userlist.php", 71, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}t_user'), FALSE, FALSE);
$RootMenu->AddMenuItem(72, "mmci_Proses", $Language->MenuPhrase("72", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(74, "mmi_gen_jdwkrj__php", $Language->MenuPhrase("74", "MenuText"), "gen_jdwkrj_.php", 72, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}gen_jdwkrj_.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(75, "mmi_gen_rekon__php", $Language->MenuPhrase("75", "MenuText"), "gen_rekon_.php", 72, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}gen_rekon_.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(73, "mmci_Laporan", $Language->MenuPhrase("73", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(10071, "mmri_r5fatt5flog", $Language->MenuPhrase("10071", "MenuText"), "r_att_logsmry.php", 73, "{049CCBC0-CFE5-40D9-8A80-2D734899363E}", AllowListMenu('{049CCBC0-CFE5-40D9-8A80-2D734899363E}r_att_log'), FALSE, FALSE);
$RootMenu->AddMenuItem(10073, "mmri_r5fjdwkrj", $Language->MenuPhrase("10073", "MenuText"), "r_jdwkrjsmry.php", 73, "{049CCBC0-CFE5-40D9-8A80-2D734899363E}", AllowListMenu('{049CCBC0-CFE5-40D9-8A80-2D734899363E}r_jdwkrj'), FALSE, FALSE);
$RootMenu->AddMenuItem(10070, "mmri_r5frekon", $Language->MenuPhrase("10070", "MenuText"), "r_rekonctb.php", 73, "{049CCBC0-CFE5-40D9-8A80-2D734899363E}", AllowListMenu('{049CCBC0-CFE5-40D9-8A80-2D734899363E}r_rekon'), FALSE, FALSE);
$RootMenu->AddMenuItem(10077, "mmi_lap_gaji2__php", $Language->MenuPhrase("10077", "MenuText"), "lap_gaji2_.php", 73, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}lap_gaji2_.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(76, "mmi_lap_gaji__php", $Language->MenuPhrase("76", "MenuText"), "lap_gaji_.php", 73, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}lap_gaji_.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(2, "mmi_audittrail", $Language->MenuPhrase("2", "MenuText"), "audittraillist.php", 73, "", AllowListMenu('{503C8825-3846-4E96-8DFF-03202C380E17}audittrail'), FALSE, FALSE);
$RootMenu->AddMenuItem(-2, "mmi_changepwd", $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, "mmi_logout", $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, "mmi_login", $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
<!-- End Main Menu -->
