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
  JOIN t_jk ON t_jdw_krj_def.jk_id = t_jk.jk_id