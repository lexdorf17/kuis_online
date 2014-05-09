
<html>
<head>
<title>Ujian PK</title>
<script type="text/javascript" src="Jquery_plugin.js"></script>
<script>
var totalwaktu = 1000; //batas waktu pengerjaan semua soal
var indexsoal = 0;
var topik;
var timer;
var habis = 0;
var nilaiakhir = 0;
var inputpilihan;
var inputjawaban;
$(document).ready(function(){
    $("#benar").val(nilaiakhir);
    checkCookie();
    topik = $("#divtopik").html();
    url = "Soal.php?"
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            topik = msg;
            setinputpilihan();
            setinputjawaban()
            tampilkan();
            mainkanwaktu();
        }
    });
    $("#next").click(function(){
        indexsoal++;
        $("#divpertanyaan").hide();
        $("#divoption").hide();
        tampilkan();
    });
});

function setinputpilihan(){
    inputpilihan = "";
    for(i=0;i<topik.soal.length;i++){
        inputpilihan = inputpilihan+"<input type=hidden name=pilihan[] id=pilihan"+i+">";
    }
    $("#divpilihan").html(inputpilihan);
}

function setinputjawaban(){
    inputjawaban = "";
    for(i=0;i<topik.soal.length;i++){
        inputjawaban = inputjawaban+"<input type=hidden name=jawaban[] value='"+topik.soal[i].jawaban+"'>";
    }
    $("#divjawaban").html(inputjawaban);
}
function mainkanwaktu(){
    if(totalwaktu>0){
        $("#divtotalwaktu").html(totalwaktu);
        totalwaktu--;
        timer = setTimeout("mainkanwaktu()",1000);
    }else{
        clearTimeout(timer);
        habis = 1;
        document.getElementById("formulir").submit();
    }
}
function setnilai(nilai){
    idinput = "#pilihan"+indexsoal;
    $(idinput).val(nilai);
}
function tampilkan(){
    if(indexsoal<topik.soal.length){
        nomorsoal = indexsoal + 1;
        $("#divnomor").html("Soal "+nomorsoal+" dari "+ topik.soal.length);
        $("#divpertanyaan").html(topik.soal[indexsoal].pertanyaan);
        $("#divpertanyaan").fadeIn(2000);
        $("#jawaban_a").html("<input type='radio' onclick='setnilai(this.value)' name='R"+indexsoal+"'value='A'>A. "+topik.soal[indexsoal].a);
        $("#jawaban_b").html("<input type='radio' onclick='setnilai(this.value)' name='R"+indexsoal+"'value='B'>B. "+topik.soal[indexsoal].b);
        $("#jawaban_c").html("<input type='radio' onclick='setnilai(this.value)' name='R"+indexsoal+"'value='C'>C. "+topik.soal[indexsoal].c);
        $("#jawaban_d").html("<input type='radio' onclick='setnilai(this.value)' name='R"+indexsoal+"'value='D'>D. "+topik.soal[indexsoal].d);
        $("#jawaban_e").html("<input type='radio' onclick='setnilai(this.value)' name='R"+indexsoal+"'value='E'>E. "+topik.soal[indexsoal].e);
        $("#divoption").slideDown(750);
    }else{
        habis = 1;
        document.getElementById("formulir").submit();
    }
}

function getCookie(c_name){
    if (document.cookie.length>0){
        c_start=document.cookie.indexOf(c_name + "=");
        if (c_start!=-1){
            c_start=c_start + c_name.length+1;
            c_end=document.cookie.indexOf(";",c_start);
            if (c_end==-1) c_end=document.cookie.length;
            return unescape(document.cookie.substring(c_start,c_end));
        }
    }
    return "";
}

function setCookie(c_name,value,expiredays){
    var exdate=new Date();
    exdate.setDate(exdate.getDate()+expiredays);
    document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
}

function checkCookie(){
    totalwaktucookies=getCookie('waktucookies');
    if (totalwaktucookies!=null && totalwaktucookies!=""){
        totalwaktu = totalwaktucookies;
    }else{
        setCookie('waktucookies',totalwaktu,7);
    }
}
function keluar(){
    if(habis==0){
        setCookie('waktucookies',totalwaktu,7);
    }else{
        setCookie('waktucookies',0,-1);
    }
}

function dey(){
    javascript:window.history.forward(1);
}

function noBack(){window.history.forward()}

noBack();

window.onload=noBack;

window.onpageshow=function(evt){if(evt.persisted)noBack()}

window.onunload=function(){void(0)}
</script>
<style>
body{
    font-family:arial;
}
.waktu{
    padding:10;
    color: black;
    }
#divpertanyaan{
    padding:10;
    background-color:gray;
    display:none;
    color:white;
    }
#divoption{
    padding:10;
    background:#00709e;
    display:none;
    color:white;
}
</style>
</head>
<body onunload="keluar()" topmargin="0" leftmargin="0" >

<h2 class="waktu">Total Waktu Mengerjakan soal: <span id="divtotalwaktu"></span></h2>
<div id="divnomor"></div>
<b><div id="divpertanyaan"></div></b>
<div id="divoption">
<span id="jawaban_a"></span><br/>
<span id="jawaban_b"></span><br/>
<span id="jawaban_c"></span><br/>
<span id="jawaban_d"></span><br/>
<?php //<span id="jawaban_e"></span> ?>
</div>
<p>
<a href="#" id="next" style="cursor: pointer;">Selanjutnya</a>
<form action="Penilaian.php" method="post" id="formulir">
<!--<input type="hidden" name="Nip" value="<?php echo $Nip;?>"/>
<input type="hidden" name="IdSoal" value="<?php echo $_GET['id'];?>"/>-->
<div id="divpilihan"></div>
<div id="divjawaban"></div>
</form>
</body>

</html>
