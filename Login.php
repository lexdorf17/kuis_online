<?php
session_start();
include "Koneksi.php";

$Nip=strip_tags($_POST['Nip']);
$Password=strip_tags($_POST['Password']);

$_SESSION['Nip']=$Nip;
        
/*if(empty($Nip) or (empty($Password))){
    
session_destroy();    
$alamat="me=Login Gagal");
$url="?$alamat";

}else{*/
    
    $sql    =   "select * from users where username='$Nip' and password=md5('$Password')";
    $query  =   mysql_query($sql);
    $row    =   mysql_num_rows($query);
    $array  =   mysql_fetch_array($query);
   
   
    $log     =   $array['loginError'];
    $status  =   $array['loginLog'];
    $error   =    $log+1; 
   if($row==0){
    session_destroy();
    /*if($log>=3){
    $alamat =   "me=ab";
    $url    =   "Ujian?$alamat";
    }else{
    $sqlUpdate  =   "update gdalogin set loginError=$error where loginNip='$Nip'";
    $queryUpdate=   mysql_query($sqlUpdate);     
    $alamat =   "me=lf";
    $url    =   "Ujian?$alamat";    
    }*/
    $alamat =   "me=lf";
    $url    =   "Ujian?$alamat";    
}else{
    if($log<3){
        $Hak=$array['loginHak'];
            $url =   "DaftarSoal.php";
$_SESSION['Hak']=$Hak;
        $sqlUpdate  =   "update gdalogin set loginLog='1' where loginNip='$Nip'";
        $queryUpdate=   mysql_query($sqlUpdate);         
        }else{
            $alamat =   "me=lf";
            $url    =   "Ujian?$alamat";    
            session_destroy();
        }
    }

//}

    header("location:http://".$_SERVER['HTTP_HOST']."/$web/$url");
    exit();

?>
