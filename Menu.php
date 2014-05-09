<?php
$sqlNama    =   "select biodataNama from gdabiodata where biodataNip='$_SESSION[Nip]'";

$queryNama  =   mysql_query($sqlNama);
$arrayNama  =   mysql_fetch_array($queryNama);
//$nama       =   substr($arrayNama[0],0,10);
$nama       =   $arrayNama[0];
?>
<div class="navbar">
<div class="navbar-inner">
<div class="container">
<ul class="nav nav-pills">
<li><a href="ViewNilai">Nilai</a></li>
<li><a href="DaftarSoal">Ujian</a></li>
<li><a href="http://modul.ditostory.com/" target=blank>Modul</a> <span class="divider"></li>
<li><a href="Forum">Forum</a></li>
<li><a href="Logout.php">Logout</a></li>
<li id="name"><a href="#"><?php echo $nama;?></a></li>
</ul>
</div>
</div>
</div>



