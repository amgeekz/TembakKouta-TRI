<?php

//KODE BY HAKU
//CAPEK NGODING AJG!! :v
system('clear');
error_reporting(0);
echo "\33[0;31m
++++CEK KOUTA DAN PULSA DI CLI+++++
    \33[0;32mVersion : \33[0;33mPREMIUM
    \33[0;32mName  : \33[0;33mCek Profil Aplikasi Tri
    \33[0;32mWeb: \33[0;33mRootSec.xyz
\33[0;31m++++CEK PROFIL BIMA TRI++++
";
echo "
\33[0;34m[1]--\33[0;36mLanjutkan Ke Profil 
\33[0;34m[2]--\33[0;36mEXIT
==> \33[0;35m";
$chose=trim(fgets(STDIN));
if($chose=="1"){
haku();}


function haku(){
if(file_exists('data.php')){
$H=[
'Content-Type: application/json',
'Accept: application/json',
'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 12_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.0 Mobile/15E148 Safari/604.1'
];
include('data.php');
$D='{"msisdn":"'.$nomer.'","imei":"null","secretKey":"'.$key.'","language":0,"subscriberType":"Prepaid","callPlan":"PACUAN MAX 1GB C2017"}';
$U="https://bimaplus.tri.co.id/api/v1/profile/profile";
$curls = curl_init();
curl_setopt($curls, CURLOPT_URL, $U);
curl_setopt($curls, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curls, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curls, CURLOPT_HTTPHEADER, $H);
curl_setopt($curls, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curls, CURLOPT_POST, 1);
curl_setopt($curls, CURLOPT_POSTFIELDS, $D);
$accept=curl_exec($curls);
if ($accept==false) {
  echo " Mohon Aktifkan Data\n";
}elseif($accept==true){
$z=json_decode($accept, true);
$bbw=$z['status'];
if($bbw== null){
system("rm -rf data.php");
echo "Silakan Mulai Ulang Toolsnya";
}if($bbw==['1']){
$numeric=$z['msisdn'];
$kuota=$z['sumOfBonuses']['Data'];
$pulsa=$z['balanceTotal'];
$package=$z['packageList'];
$namaplus=$package[0]['name'];
$kuotaplus=$package[0]['detail'][0];
$kuotaplus1=$kuotaplus['validity'];
$kuotaplus2=$kuotaplus['value'];
$namabulanan=$package[1]['name'];
$kuotabulanan=$package[1]['detail'][0];
$kuotabulanan1=$kuotabulanan['validity'];
$kuotabulanan2=$kuotabulanan['value'];
$namaunlimited=$package[2]['name'];
$kuotaunlimited=$package[2]['detail'][0];
$kuotaunlimited1=$kuotaunlimited['validity'];
$kuotaunlimited2=$kuotaunlimited['value'];
$namalokal=$package[3]['name'];
$kuotalokal=$package[3]['detail'][0];
$kuotalokal1=$kuotalokal['validity'];
$kuotalokal2=$kuotalokal['value'];
echo "
   \33[1;32mNomer Kamu : +$numeric

   \33[1;33mSemua Kuota : $kuota
   Sisa Pulsa  : $pulsa

   \33[0;32mNama Kuota : $namaplus
   Sisa Kuota : $kuotaplus2
   Masa Aktif : $kuotaplus1
    
   \33[0;33mNama Kuota : $namabulanan
   Sisa Kuota : $kuotabulanan2
   Masa Aktif : $kuotabulanan1

   \33[0;34mNama Kuota : $namaunlimited
   Sisa Kuota : $kuotaunlimited2
   Masa Aktif : $kuotaunlimited1


   \33[0;35mNama Kuota : $namalokal
   Sisa Kuota : $kuotalokal2
   Masa Aktif : $kuotalokal1


";
//print_r($kuotaplus1);
}}

}else{
OTP();
}}
function OTP(){
echo "Masukan Nomer Kamu +62 : ";
$nomer=trim(fgets(STDIN));
$HEADER=[
'Content-Type: application/json',
'Cache-Control: no-store, must-revalidate, no-cache',
'Pragma: no-cache',
'Accept: application/json',
'app-version: 3.4.16',
'Accept-Encoding: identity',
'User-Agent: Mozilla/5.0 (Linux; Android 8.0.0; SM-G960F Build/R16NW) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.84 Mobile Safari/537.36',
'Host: bimaplus.tri.co.id',
'Connection: Keep-Alive'
];
$DATA='{"msisdn":"'.$nomer.'","imei":"829745797392441","language":0}';
$URL="https://bimaplus.tri.co.id/api/v1/login/otp-request";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $HEADER);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $DATA);
$result=curl_exec($ch);
if ($result === FALSE) {
  echo " Mohon Aktifkan Data\n";
}else{
$result=json_decode($result);
$result=$result->status;
if($result==false){
echo" Masukan Nomer Dengan Benar \n";
system(exit);
}else if($result==true){
echo " Kode Sedang Di Kirim Ke Nomer Anda \n";
$save=fopen("data.php", "a");
$l=('<? $nomer="').$nomer.('";?>
');
fwrite($save,$l);
fclose($save);
}
echo "Masukan Kode Otp Kamu ";
$kode=trim(fgets(STDIN));
$ua=[
'Content-Type: application/json',
'Cache-Control: no-store, must-revalidate, no-cache',
'Pragma: no-cache',
'Accept: application/json',
'app-version: 3.4.16',
'Accept-Encoding: identity',
'User-Agent: Dalvik/2.1.0 (Linux; U; Android 8.1.0; vivo 1817 Build/OPM1.171019.026)',
'Host: bimaplus.tri.co.id',
'Connection: Keep-Alive'
];
$dt='{"msisdn":"'.$nomer.'","otp":"'.$kode.'","imei":"829745797392441","deviceModel":"vivo 1817","deviceOs":"8.1.0","deviceManufactur":"vivo","language":0}';
$url="https://bimaplus.tri.co.id/api/v1/login/login-with-otp";
$cl = curl_init();
curl_setopt($cl, CURLOPT_URL, $url);
curl_setopt($cl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($cl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($cl, CURLOPT_HTTPHEADER, $ua);
curl_setopt($cl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($cl, CURLOPT_POST, 1);
curl_setopt($cl, CURLOPT_POSTFIELDS, $dt);
$hasilotp=curl_exec($cl);
if($hasilotp==false){
echo "Mohon Aktifkan Data\n";}
elseif($hasilotp==true){
$queen=json_decode($hasilotp);
$king=$queen->status;
if($king==false){
echo "Maaf Kode Yang Anda Masukan Salah\nSilakan Mulai Ulang Kode Verifikasinya";
}else if($king==true){
$key=$queen->secretKey;
$save=fopen("data.php", "a");
$l=('<? $key="').$key.('";?>
');
fwrite($save,$l);
fclose($save);
echo "\n \33[0;32mSuksess Silakan Mulai Ulang Toolsnya\nKetikan php profil.php\n";
}
}
}
}
