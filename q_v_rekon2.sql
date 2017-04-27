SELECT
	a.jdw_id
    , a.pegawai_id
    , a.tgl
    , a.jk_id
    , a.hk_def
    , b.pegawai_pin
    , c.jk_nm
    , c.jk_kd
    , c.jk_m
    , c.jk_k
    , d.scan_masuk
    , e.scan_keluar
FROM
	t_jdw_krj_def a
    left join pegawai b on a.pegawai_id = b.pegawai_id
    left join t_jk c on a.jk_id = c.jk_id
    left join (select pin, scan_date as scan_masuk from att_log where cast(scan_date as date) between '2017-03-24' and '2017-04-24') d on
		b.pegawai_pin = d.pin
        and cast(d.scan_masuk as date) = cast(a.tgl as date)
		and cast(d.scan_masuk as time) between cast(concat('1974-12-24 ', c.jk_m) - interval '60' minute as time) and cast(c.jk_m as time)
	left join (select pin, scan_date as scan_keluar from att_log where cast(scan_date as date) between '2017-03-24' and '2017-04-24') e on
        b.pegawai_pin = e.pin
		and cast(e.scan_keluar as date) = case when left(c.jk_kd, 2) = 'S3' then cast(a.tgl + interval 1 day as date) else cast(a.tgl as date) end
		and cast(e.scan_keluar as time) between cast(c.jk_k as time) and cast(concat('1974-12-24 ', c.jk_k) + interval '60' minute as time)
where
	a.tgl between '2017-03-24' and '2017-04-23'
order by
	a.pegawai_id
    , a.tgl