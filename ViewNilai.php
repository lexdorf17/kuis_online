<?php
$query	=mysql_query("select * from gdanilai nilai,gdakategori kategori where nilai.nilaiNip='$Nip' and kategori.Id=nilai.nilaiIdSoal order by nilai.nilaiNo desc LIMIT 1");
$row		=mysql_num_rows($query);
if($row<1){
	echo "Anda belum mengikuti ujian";	
}else {
?>
<div id="tenga">
<table class="table table-bordered">
<tr>
<th>NIP</th>
<th>Tanggal</th>
<th>Nilai</th>
<th>Ujian</th>
<th>Status</th>

<th>Aksi</th>
</tr>
<?php
while($array=mysql_fetch_array($query)){
    ?>
<tr align="center">
<td><?php echo $array['nilaiNip'];?></td>
<td><?php echo $array['nilaiTanggal'];?></td>
<td><?php echo $array['nilaiNilai'];?></td>
<td><?php echo $array['kategoriKategori'];?></td>
<td><?php echo $array['nilaiStatus'];?></td>
<td><a href="Print.php?id=<?php echo $array[0] ;?>">Cetak Nilai</a></td>
</tr>    
    <?php
}
?>
</table>
</div>
<?php
}
?>