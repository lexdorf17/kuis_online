<?php
session_start();
include "Koneksi.php";

$data = mysql_query("SELECT * FROM banksoal limit 10");

$json = '{"soal":[ ';
while($x = mysql_fetch_array($data)){
    $json .= '{';
    $json .= '"id":"'.$x['id_soal'].'",
        "pertanyaan":"'.htmlspecialchars($x['pertanyaan']).'",
        "a":"'.$x['pilihan1'].'",
        "b":"'.$x['pilihan2'].'",
        "c":"'.$x['pilihan3'].'",
        "d":"'.$x['pilihan4'].'",
        "e":"'.$x['pilihan5'].'",
        "jawaban":"'.$x['jawaban'].'"
    },';
}
$json = substr($json,0,strlen($json)-1);
$json .= ']';

$json .= '}';
echo $json;

?>
