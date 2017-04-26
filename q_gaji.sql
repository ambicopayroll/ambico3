-- select * from pembagian1
-- select * from pembagian2
-- select * from pembagian3
select
	a.*
    , b.*
    , c.*
    , d.*
from
	t_lapgroup a
    left join t_lapsubgroup b on a.lapgroup_id = b.lapgroup_id
    left join pembagian2 c on b.pembagian2_id = c.pembagian2_id
    left join pegawai d on d.pembagian2_id = b.pembagian2_id
order by
	a.lapgroup_index
    , b.lapsubgroup_index