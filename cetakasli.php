<?php
session_start();
$Nip=$_SESSION['Nip'];
include"../../Proses/Koneksi.php";
require('../../Lib/fpdf/rotation.php');

$sql="select * from gdakategori k,gdanilai n,gdabiodata a where k.kategoriIdKategori=n.nilaiIdSoal and a.biodataNip=n.nilaiNip and n.nilaiNip='$Nip' and n.nilaiNo='$_GET[id]'";
$query=mysql_query($sql)or die(mysql_error());
$row=mysql_fetch_array($query);

$kategori=$row['kategoriKategori'];
$tanggal=$row['nilaiTanggal'];
$nilai=$row['nilaiNilai'];
$status=$row['nilaiStatus'];

$pdf=new PDF_Rotate();
$pdf->AddPage('Landscape');
$pdf->SetFont('Arial','I',18);

//$pdf->Image('logo.jpg',32);
$pdf->Rotate(90);
$x=-140;
$y=80;
$pdf->Text($x,$y,'Terima Kasih Anda Telah Mengikuti Ujian');

$x2=-110;
$y2=90;
$pdf->Text($x2,$y2,'Dengan Kategori');

$x3=-100;
$y3=100;
$pdf->Text($x3,$y3,$kategori);

$x4=-105;
$y4=120;
$pdf->Text($x4,$y4,"Pada Tanggal ");

$x5=-103;
$y5=130;
$pdf->Text($x5,$y5,$tanggal);

$x6=-105;
$y6=140;
$pdf->Text($x6,$y6,"Dengan Nilai ");

$x7=-90;
$y7=150;
$pdf->Text($x7,$y7,$nilai);

$x8=-120;
$y8=160;
$pdf->Text($x8,$y8,"Dan Status Kelulusan ");

$x9=-105;
$y9=170;
$pdf->Text($x9,$y9,$status);


$x9=-90;
$y9=280;
$pdf->Text($x9,$y9,"DIrektorat Jendral Pemasyarakatan");

$pdf->Output('Ujian PK.pdf','D');
?>
