<?php
include "Koneksi.php";
$Tanggal=date("Y-m-d");
$Nip    =$_POST['Nip'];
$IdSoal =$_POST['IdSoal'];
$jumlahbenar = 0;
$jumlahsalah = 0;
$i = 1;

echo "Jawaban anda<br>";

$pilih[] =  $_POST['pilihan'];
foreach($_POST['pilihan'] as $key => $value){
   if($value == $_POST['jawaban'][$key]){
        $j = "benar";
        $jumlahbenar++;
    }else{
       $j = "salah";
        $jumlahsalah++;  
    }
    
   echo $i.". ".$value." $j<br>";
 $i++;
   
}

$select=mysql_query("select kkmBatasKelulusan from gdakkm where kkmIdSoal='$IdSoal'");
$array=mysql_fetch_array($select);
$minimal=$array[0];

if($jumlahbenar>=$minimal){
    $status="Lulus";
    $keterangan="Melebihi nilai kelulusan minimal";
}else{
    $status="Tidak Lulus";
    $keterangan="Tidak melebihi nilai kelulusan minimal";
}

/*$sql="insert into gdanilai (nilaiNip,nilaiTanggal,nilaiNilai,nilaiIdSoal,nilaiStatus,nilaiKeterangan) values ('$Nip','$Tanggal','$jumlahbenar','$IdSoal','$status','$keterangan')";
$query=mysql_query($sql);
header("location:http://".$_SERVER['HTTP_HOST']."/$web/ViewNilai");
exit();*/

$select=mysql_query("select kategoriLimit from gdakategori where Id='$IdSoal'");
$array=mysql_fetch_array($select);
$jum=$array[0];


$tidakdijawab  =  $jum-$jumlahbenar-$jumlahsalah;
echo "Jumlah benar= ".$jumlahbenar."<br>";
echo "Jumlah salah= ".$jumlahsalah."<br>";
echo "Tidak dijawab= ".$tidakdijawab."<br>";

//echo $sql;
?>
