<?php
session_start();
$sqlNama    =   "select loginStatus from gdalogin where loginNip='$_SESSION[Nip]'";
include "Koneksi.php";
$queryNama  =   mysql_query($sqlNama);
$arrayNama  =   mysql_fetch_array($queryNama);
//$nama       =   substr($arrayNama[0],0,10);
$nama       =   $arrayNama[0];

if($nama==0){
    echo "Anda belum terdaftar sebagai peserta ujian";
}else{
?>
<table class="table table-bordered">
<tr>
<th>No</th>
<th>Kategori</th>

<th>Aksi</th>
</tr>
<?php
$no=1;
$sql		=	"select kategoriKategori,Id from gdakategori where id=1";
$query	=	mysql_query($sql);
while($array=mysql_fetch_array($query)){
    ?>
<tr align="center">
<td><?php echo $no;?></td>
<td><?php echo $array[0];?></td>

<td><a href="Ujian.php?id=<?php echo $array[1] ;?>">Ikuti Ujian</a></td>
</tr>    
    <?php
    $no++;
}
?>
</table>
</div>
<?php
}
?>