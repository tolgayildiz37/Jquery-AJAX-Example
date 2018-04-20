<?php

	$sunucu="localhost";
	$veritabani="agprogramlamaodev1";
	$kullaniciAdi="root";
	$sifre="12345678"; // Bu bilgileri daha güvenli bir klasörde (etc/...) saklayıp oradan erişmek daha güvenlidir.

	//$baglantiNo= pg_connect($sunucu, $kullaniciAdi, $sifre, $veritabani);
	$baglan=mysql_connect($sunucu, $kullaniciAdi, $sifre);
	mysql_query("SET NAMES UTF8");

	if(!$baglan){
		echo "Bağlantı Hatası: ".mysql_errno();		
		echo "<br";
		exit();
	}

	$db=mysql_select_db($veritabani);

	if(!$db){
		echo "Veri Tabanı Hatası: ".mysql_errno();
		echo "<br>";
		echo "Veritabanı Bağlantı Bilgilerini /Baglanti/dbBaglanti.php Dosyasından Düzenleyebilirsiniz.";
		exit();
	}
?>