<?php
$anasayfa = "index.php";

require_once "config.php";
error_reporting(E_ALL);ini_set('display_errors', 1);

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST["veri"])){
        $alinan = $_POST["veri"];
        $kontrol = $db->query("SELECT isitover FROM books WHERE id=$alinan");
        $bol = $kontrol->fetchAll();
        foreach($bol as $row){
            $deger = $row["isitover"];
        }
        $query = $db->prepare("UPDATE books SET isitover=? WHERE id=?");
        if($deger ==0){
            $true = 1;
        }else{
            $true = 0;
        }
        $query->bindParam(1,$true, PDO::PARAM_STR);
        $query->bindParam(2,$alinan, PDO::PARAM_STR);
        $query->execute();
        echo "success";
    }
    if(isset($_POST["value"])){
        $deger = $_POST["value"];
        $sorgu = $db->query("SELECT * FROM books WHERE bookname LIKE '%$deger%' LIMIT 0,5");
        $bol = $sorgu->fetchAll(PDO::FETCH_ASSOC);
        foreach($bol as $row){
            echo "<a href='kitap.php?sayfa=".$row["id"]."'>".$row["bookname"]."</a>";
        }
    }
    if(isset($_POST["gunlukokuma"])){
        $id = $_POST["1"];
        $bastar = date("Y-m-d")." ".$_POST["2"];
        $endtar = date("Y-m-d")." ".$_POST["3"];
        $bassayfa = $_POST["4"];
        $endsayfa = $_POST["5"];
        $okunansayfa = $endsayfa-$bassayfa;
        if(empty($id) || empty($bastar) || empty($endtar) || empty($endsayfa)){

        }else{
            session_start();
            $kullanici = empty($_SESSION["kitap_kullanici_id_123789"])?"deneme":$_SESSION["kitap_kullanici_id_123789"];
            $query=$db->prepare("INSERT INTO dailyread (idkitap,starttm,finishtm,ilksayfa,sonsayfa,pageread,whois,created_at) VALUES (?,?,?,?,?,?,?,?)");
            $query->bindParam(1,$id);
            $query->bindParam(2,$bastar);
            $query->bindParam(3,$endtar);
            $query->bindParam(4,$bassayfa);
            $query->bindParam(5,$endsayfa);
            $query->bindParam(6,$okunansayfa);
            $query->bindParam(7,$kullanici);
            date_default_timezone_set("Europe/Istanbul");
            $tarih = date("Y-m-d h:i:s");
            $query->bindParam(8,$tarih);
            $query->execute();
            $query=$db->query("SELECT * FROM dailyread WHERE idkitap=$id");
            $fetch= $query->fetchAll(PDO::FETCH_ASSOC);
            $topla=0;
            foreach($fetch as $row){
                $topla+=$row["pageread"];
            }
            $query=$db->query("SELECT * FROM books where id=$id");
            $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($fetch as $row){
                if($topla>$row["pagenumber"]){
                    echo "hata";
                    die();
                }
                if($topla==$row["pagenumber"]){
                    $query2 = $db->prepare("UPDATE books SET finishdate=?, isitover=? WHERE id=?");
                    $query2->bindParam(1,$endtar);
                    $true = 1;
                    $query2->bindParam(2,$true);
                    $query2->bindParam(3,$id);
                    $query2->execute();
                    $query2 = $db->prepare("UPDATE books SET okunan=? WHERE id=?");
                    $query2->bindParam(1,$topla);
                    $query2->bindParam(2,$id);
                    $query2->execute();
                }
                if($bassayfa==0){
                    $query2 = $db->prepare("UPDATE books SET startdate=? WHERE id=?");
                    $query2->bindParam(1,$bastar);
                    $query2->bindParam(2,$id);
                    $query2->execute();
                }
            }
        }
    }
    if(isset($_POST["kayit"])){
        $i=1;
        $gelenarray=array();
        /*
        $query = $db->query("describe books");
            $fetch = $query->fetchAll();
            foreach($fetch as $row){
                if($row[5]!="auto_increment"){
                    $array[]=$row["Field"];
                }
            }
            print_r($array);
        */
        $array=array(1=>"bookname",2=>"bookauthor",3=>"pagenumber",4=>"booklang",5=>"publisher",6=>"startdate",7=>"finishdate",8=>"isitover",9=>"isset",10=>"isbeauty",11=>"youhave",12=>"kod",13=>"kind",14=>"okunan",15=>"originalang",16=>"translator",17=>"title",18=>"whois",19=>"konusu",20=>"img");
        while($i<20){
            if(!empty($_POST[$i]) || $_POST[$i]==0){
                $gelenarray[$i]=$_POST[$i];
            }
            $i++;
        }
        foreach($gelenarray as $row=>$value){
            $newarray[] = $array[$row];
            $newsarray[]=$value;
        }
        $dosya = $_FILES["20"];
        if($dosya["error"]==0){
            $newarray[]=$array[20];
        }
        $i=0;
        while($i<count($newarray)){
            $soru[] ="?";
            $i++;
        }
        $isaretler = implode(",",$soru);
        $newarrayler = implode(",",$newarray);
        $query = $db->prepare("INSERT INTO books ($newarrayler) VALUES($isaretler)");
        $i=0;
        $saymasayisi=1;
        $db->beginTransaction();
        print_r($dosya);
        if($dosya["error"]==0){
            $max_size=1000000*100;
            $gelendosya = $dosya["tmp_name"];
            $gidendosya = "/var/www/html/library/src/img/books/".basename($dosya["name"]);
            if($dosya["size"]>$max_size){
                echo "hata";
                die();
            }else{
                if(move_uploaded_file($gelendosya,$gidendosya)){
                    echo "işlem başarılı";
                }
            }
            $newsarray[]=$gidendosya;
        }
        while($i<count($newsarray)){
            $yeni = $newsarray[$i];
            $query->bindValue($saymasayisi,$yeni);
            $i++;
            $saymasayisi++;
        }
        $db->commit();
        $query->execute();
        header("Location:kaydet.php");
    }
    if(isset($_POST["duzenle"])){
        $query= $db->prepare("SELECT * FROM books WHERE id=?");
        $query->execute([$_POST["duzenle"]]);
        $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($fetch as $row){
            $arraynewss[]=empty($row["bookname"])?"Örnek: 1984 | (Sistemde Boş)":$row["bookname"];
            $arraynewss[]=empty($row["bookauthor"])?"Örnek: George Orwell | (Sistemde Boş)":$row["bookauthor"];
            $arraynewss[]=empty($row["pagenumber"])?"Örnek: 489 | (Sistemde Boş)":$row["pagenumber"];
            $arraynewss[]=empty($row["booklang"])?"Örnek: Türkçe | (Sistemde Boş)":$row["booklang"];
            $arraynewss[]=empty($row["publisher"])?"Örnek: İş Bankası | (Sistemde Boş)":$row["publisher"];
            $arraynewss[]="";
            $arraynewss[]="";
            $arraynewss[]=$row["isitover"];
            $arraynewss[]=$row["isset"];
            $arraynewss[]=$row["isbeauty"];
            $arraynewss[]=$row["youhave"];
            $arraynewss[]=empty($row["kod"])?"Örnek: Dil ve Edebiyat Salonu | PS 3503 .R167 F3419 2018 | (Sistemde Boş)":$row["kod"];
            $arraynewss[]=empty($row["kind"])?"Örnek: Bilim | (Sistemde Boş)":$row["kind"];
            $arraynewss[]=empty($row["okunan"])?"Örnek: 125 | (Sistemde Boş)":$row["okunan"];
            $arraynewss[]=empty($row["originalang"])?"Örnek: Deutsch | (Sistemde Boş)":$row["originalang"];
            $arraynewss[]=empty($row["translator"])?"Örnek: Hasan Ali Yücel | (Sistemde Boş)":$row["translator"];
            $arraynewss[]=empty($row["title"])?"Örnek: 1984 | (Sistemde Boş)":$row["title"];
            $arraynewss[]=empty($row["whois"])?"1 | (Sistemde Boş)":$row["whois"];
            $arraynewss[]=empty($row["konusu"])?"150.000 yıl önce Homo spiens'i artık modern insandan ayırt etmek mümkün değildi. İnsan 60.000 yıl önce anavatanı olan Afrika'dan çıkıp tüm dünyaya yayıldı. Yaklaşık 300.000 yıl önce, bugün din, bilim ve sanatta kendini dışa vuran soyutlama yetisi belli bir olgunluğa ulaştı. Ardından yerleşik yaşam ve Tarım Devrimi geldi. Onu içten yanmalı motorun icadıyla modernite kapımıza dayandı, elektronik devrimi bizi bugüne ulaştırdı. | (Sistemde Boş)":$row["konusu"];
            $arraynewss[]=empty($row["img"])?"1 | (Sistemde Boş)":$row["img"];
            echo json_encode($arraynewss);
        }
    }
    if(isset($_POST["edit"])){
        $i=1;
        $veritabani=array(1=>"bookname",2=>"bookauthor",3=>"pagenumber",4=>"booklang",5=>"publisher",6=>"startdate",7=>"finishdate",8=>"isitover",9=>"isset",10=>"isbeauty",11=>"youhave",12=>"kod",13=>"kind",14=>"okunan",15=>"originalang",16=>"translator",17=>"title",18=>"whois",19=>"konusu",20=>"img");
        while($i<20){
            if(!empty($_POST[$i]) || $_POST[$i]==0){
                $array[$i]=$_POST[$i];
            }
            $i++;
        }
        $dosya = empty($_FILES["20"])?array("error"=>1):$_FILES["20"];
        if($dosya["error"]==0){
            $oncekiyol = $dosya["tmp_name"];
            $dosyayolu = $_SERVER["DOCUMENT_ROOT"];
            $klasoradi = " /library/";
            $sonrakiyol=$dosyayolu.$klasoradi."src/img/books/".$dosya["name"];
            if(move_uploaded_file($oncekiyol,$sonrakiyol)){}
            $array[20]="src/img/books/".$dosya["name"];
        }
        foreach($array as $key => $value){
            $new[] = $veritabani[$key]."=?";
            $newsen[]= $value;
        }
        $newsen[]=$_POST["idyial"];
        $newler = implode(",",$new);
        $query=$db->prepare("UPDATE books SET $newler WHERE id=?");
        $i=1;
        $a=0;
        while($a<count($newsen)){
            $yeni = $newsen[$a];
            $query->bindValue($i,$yeni);
            $a++;
            $i++;
        }
        $query->execute();
        header("Refresh:1;url=index.php");
    }
    if(isset($_POST["id"])){
        $id = $_POST["id"];
        $query = $db->prepare("DELETE FROM books where id=?");
        $query->execute([$id]);
        echo "success";
    }
    if(isset($_POST["veriler"])){
        $kadi = $_POST["veriler"][0];
        $ksifre = $_POST["veriler"][1];
        $query = $db->prepare("SELECT * FROM users where email=?");
        $query->bindParam(1,$kadi);
        $query->execute();
        $fetch = $query->fetch(PDO::FETCH_ASSOC);
        if(!$query->rowCount()){
            echo "nomail";
        }else{
            if(md5($ksifre)===$fetch["sifre"]){
                echo "successfull";
                session_start();
                $_SESSION["kitap_kullanici_mail_123789"]=$kadi;
                $_SESSION["kitap_kullanici_id_123789"]=$fetch["id"];
                $_SESSION["kitap_kullanici_adi_123789"]=$fetch["isim"];
                $_SESSION["kitap_kullanici_soyadi_123789"]=$fetch["surname"];
            }else{
                echo "nosifre";

            }
        }
    }
}else{
    header("Location:$anasayfa");
}
?>