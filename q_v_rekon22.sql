create view v_rekon2 as
SELECT
  a.jdw_id
  , a.pegawai_id
  , a.tgl
  , a.jk_id
  , a.hk_def
  , b.pegawai_pin
  , b.pegawai_nama
  , c.jk_nm
  , c.jk_kd
  , c.jk_m
  , c.jk_k
  , d.scan_date as scan_masuk
  , e.scan_date as scan_keluar
  , f.pembagian2_nama
FROM
  t_jdw_krj_def a
  left join pegawai b on a.pegawai_id = b.pegawai_id
  left join t_jk c on a.jk_id = c.jk_id
  left join att_log d on
    b.pegawai_pin = d.pin
    and cast(d.scan_date as date) = cast(a.tgl as date)
    and cast(d.scan_date as time) between cast(concat('1974-12-24 ', c.jk_m) - interval '60' minute as time) and cast(c.jk_m as time)
  left join att_log e on
    b.pegawai_pin = e.pin
    and cast(e.scan_date as date) = case when left(c.jk_kd, 2) = 'S3' then cast(a.tgl + interval 1 day as date) else cast(a.tgl as date) end
    and cast(e.scan_date as time) between cast(c.jk_k as time) and cast(concat('1974-12-24 ', c.jk_k) + interval '60' minute as time)
  left join pembagian2 f on f.pembagian2_id = b.pembagian2_id