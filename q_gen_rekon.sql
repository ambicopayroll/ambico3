select 
	a.* 
    , b.jk_nm 
    , b.jk_kd 
    , b.jk_m 
    , b.jk_k 
    , c.pegawai_pin 
from 
	t_jdw_krj_def a 
    left join t_jk b on a.jk_id = b.jk_id 
    left join pegawai c on a.pegawai_id = c.pegawai_id 
where 
	a.tgl between cast('2017/03/24' as date) and cast('2017/04/23' as date) 
    and ( isnull(scan_masuk) or isnull(scan_keluar))