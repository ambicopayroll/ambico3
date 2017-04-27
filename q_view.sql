CREATE VIEW `v_att_log` AS
SELECT att_log.sn AS sn,
  att_log.scan_date AS scan_date,
  att_log.pin AS pin,
  att_log.att_id AS att_id,
  CAST(Date_Format(att_log.scan_date, '%Y-%m-%d') AS date) AS scan_date_tgl,
  Date_Format(att_log.scan_date, '%d-%m-%Y %H:%i:%s') AS scan_date_tgl_jam,
  pegawai.pegawai_nip AS pegawai_nip,
  pegawai.pegawai_nama AS pegawai_nama
FROM att_log
  LEFT JOIN pegawai ON att_log.pin = pegawai.pegawai_pin;

CREATE VIEW `v_rekon` AS
SELECT t_jdw_krj_def.jdw_id AS jdw_id,
  t_jdw_krj_def.pegawai_id AS pegawai_id,
  t_jdw_krj_def.tgl AS tgl,
  t_jdw_krj_def.jk_id AS jk_id,
  t_jdw_krj_def.scan_masuk AS scan_masuk,
  t_jdw_krj_def.scan_keluar AS scan_keluar,
  pegawai.pegawai_nama AS pegawai_nama,
  pegawai.pegawai_pin AS pegawai_pin,
  pegawai.pegawai_nip AS pegawai_nip,
  t_jk.jk_nm AS jk_nm,
  (CASE
    WHEN ((t_jdw_krj_def.scan_masuk IS NOT NULL) AND
    (t_jdw_krj_def.scan_keluar IS NOT NULL)) THEN t_jk.jk_kd ELSE NULL
  END) AS jk_kd,
  (CASE
    WHEN ((t_jdw_krj_def.scan_masuk IS NOT NULL) AND
    (t_jdw_krj_def.scan_keluar IS NOT NULL)) THEN t_jdw_krj_def.hk_def ELSE NULL
  END) AS gol_hk
FROM (t_jdw_krj_def
  JOIN pegawai ON t_jdw_krj_def.pegawai_id = pegawai.pegawai_id)
  JOIN t_jk ON t_jdw_krj_def.jk_id = t_jk.jk_id;

CREATE VIEW `v_jdw_krj_def` AS  
SELECT b.pegawai_nama AS pegawai_nama,
  Concat((CASE Date_Format(a.tgl, '%a') WHEN 'Sun' THEN 'Min'
    WHEN 'Mon' THEN 'Sen' WHEN 'Tue' THEN 'Sel' WHEN 'Wed' THEN 'Rab'
    WHEN 'Thu' THEN 'Kam' WHEN 'Fri' THEN 'Jum' ELSE 'Sab'
  END), ', ', Date_Format(a.tgl, '%d %b %Y')) AS tgl_indo,
  c.jk_kd AS jk_kd,
  a.hk_def AS hk_def,
  a.tgl AS tgl
FROM (t_jdw_krj_def a
  LEFT JOIN pegawai b ON a.pegawai_id = b.pegawai_id)
  LEFT JOIN t_jk c ON a.jk_id = c.jk_id;