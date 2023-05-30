<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kütüphanem</title>
    <link rel="stylesheet" href="../src/css/bootstrap.min.css">
    <script src="../src/js/fontawesome.js"></script>
    <script src="../src/js/jquery.js"></script>
    <!--<script src="../src/js/ritcuqlt.js"></script>-->
    <style>
        i{
            font-size: 1.1em;
            padding-left: 24px;
        }
        #siralama > span{
            background-color:#D1B6E1;
            padding:0.375rem;
            display:inline-block;
            margin:0.2em 0.2em;
            border-radius:4px;
            cursor:pointer;
        }
        #siralama > span:hover{
            background-color:#a390af;
        }
        #siralama > span:hover a{
            color:white;
        }
        #siralama > span >a{
            color:#212529;
            text-decoration: none;
        }
        input:focus{
            box-shadow:unset!important;
        }
        #success,#error{
            display:none;
        }
        .closed{
            cursor:pointer;
        }
        .aramayaz > a{
            background-color:#ced4da;
            display:block;
            padding:.375rem;
            border-radius:10px;
            margin-bottom:5px;
        }
        .istatis > .before{
            content:"";
            position:absolute;
            width:50%;
            height:100%;
            background-color:#519D9E;
        }
        .istatis{
            position:relative;
            overflow:hidden;            
            background-color:#ced4da;
        }
        #modebar-dfa61f{
            display:none;
        }
        .likedauthors > span{
            background:#D1B6E1;
            display:block;
            padding:0.375rem;
            position:relative;
            color:white;
        }
        .likedauthors > span:after{
            content:attr(data-sayi);
            background-color:white;
            transform:rotate(4deg);
            float:right;
            color:black;
            font-size:1.2em;
        }
        .likedauthors{
            position:relative;
        }
        .inteaktifoge{
            background-color:#9DC8C8;
            padding:1em 2em;
            margin-bottom:1em;
            border-radius:1em;
            cursor:pointer;
        }
        .inteaktifoge > span{
            font-size:1.4em;
            display: block;
            margin: 0.375rem;
        }
        .inteaktifoge > span + form{
            display:none;
        }
        .eszaman{
            background:#D1B6E1;
        }
        .eszaman > li{
            padding:1em 0;
            color:white;
        }
        html {
            scroll-behavior: smooth;
        }
        @media only screen and (max-width:768px){
            #panel{
                display:none!important;
            }
            #liste{
                width:100%!important;
            }
            button{
                display:block!important;
                margin:25px auto!important;
                width:100%;
            }
        }
        button:nth-child(1):hover{
            background-color:unset!important;
            color:black!important;
        }
        button:nth-child(2):hover{
            background-color:#0AAFF9!important;
            color:white!important;
        }
        #login-pg{
            display:none;
            <?php
            $kullanici=empty($_SESSION["kitap_kullanici_id_123789"])?"":$_SESSION["kitap_kullanici_id_123789"];

            if(empty($kullanici)){
                echo "display:block;";
            }
            
            ?>
        }
    </style>
</head>
<body>
    <div style="position:fixed;left:0;top:0;width:100%;height:100%;" id="login-pg">
        <div class="container" style="height:100%;position:relative;">
            <div style="left:50%;top:50%;transform:translate(-50%,-50%);position:absolute;">
            <h1 class="text-center">Henüz Giriş Yapmadığını Görüyorum</h1>
            <div style="text-align:center;margin-top:3em;"><button class="btn" style="background-color:#0AAFF9;margin-right:32px;color:white;border:2px solid #0AAFF9;"><a href="login.php">Giriş Yap</a></button><button style="border:2px solid #0AAFF9;" class="btn"> Kayıt Ol</button></div>
            </div>
        </div>
    </div>
    <div class="editing bg-light" style="display:none;z-index:100;">
        <div style="z-index:101;width:100%;height:100%;background-color:black;position:fixed;top:-50%;transform:rotate(-65deg);left:-40%;"></div>
        <div class="container">
            <h2 style="color:white;position:fixed;top:0;z-index:102;white-space:nowrap;" class="display-4 kitap">Deneme</h2>
            <h2 style="color:white;position:fixed;top:10%;z-index:102" class="display-6 yazar">Deneme</h2>
            <div style="width:50%;margin-left:auto;">
                <form action="allin.php" enctype="multipart/form-data" method="post">
                    <input name="idyial" readonly type="text" value="id" class="form-control">
                    <label for="1">Kitabın Adı</label>
                    <input id="1" name="1" type="text" placeholder="1984" class="form-control islemli">
                    <label for="2">Kitabın Yazarı</label>
                    <input id="2" name="2" type="text" placeholder="George Orwell" class="form-control islemli">
                    <label for="3">Sayfa Sayısı</label>
                    <input id="3" name="3" type="number" placeholder="489" class="form-control islemli">
                    <label for="4">Kitabın Dili <b class="text-warning">(Default "Türkçe")</b></label>
                    <input id="4" name="4" type="text" placeholder="English" class="form-control islemli">
                    <label for="5">Yayımcı</label>
                    <input id="5" name="5" type="text" placeholder="Kodlab" class="form-control islemli">
                    <label for="6">Kitaba Başlanma Tarihi</label>
                    <input id="6" name="6" type="date" class="form-control islemli">
                    <label for="7">Kitabı Bitirme Tarihi</label>
                    <input id="7" name="7" type="date" class="form-control islemli">
                    <label for="8">Okundu mu<b class="text-warning">(Default "0")</b></label>
                    <input id="8" name="8" maxlength="1" type="number" max="1" min="0" class="form-control islemli">
                    <label for="9">Set mi? <b class="text-warning">(Default "0")</b></label>
                    <input id="9" name="9" maxlength="1" type="number" max="1" min="0" class="form-control islemli">
                    <label for="10">Öncelikli mi? <b class="text-warning">(Default "0")</b></label>
                    <input id="10" name="10" maxlength="1" type="number" max="1" min="0" class="form-control islemli">
                    <label for="11">Elinde var mı? <b class="text-warning">(Default "0")</b></label>
                    <input id="11" name="11" maxlength="1" type="number" max="1" min="0" class="form-control islemli">
                    <label for="12">Salon | Kod (Kütüphane için)</label>
                    <input id="12" name="12" type="text" placeholder="Dil ve Edebiyat Salonu | PS 3503 .R167 F3419 2018" class="form-control islemli">
                    <label for="13">Kitabın Türü</label>
                    <input id="13" name="13" type="text" placeholder="Eğitim" class="form-control islemli">
                    <label for="14">Okunan Sayfa</label>
                    <input id="14" name="14" type="number" placeholder="125" class="form-control islemli">
                    <label for="15">Orijinal Dili</label>
                    <input id="15" name="15" type="text" placeholder="Deutsch" class="form-control islemli">
                    <label for="16">Çeviren</label>
                    <input id="16" name="16" type="text" placeholder="Hasan Ali Yücel" class="form-control islemli">
                    <label for="17">Orijinal Adı</label>
                    <input id="17" name="17" type="text" placeholder="1984" class="form-control islemli">
                    <label for="18">Kimin Listesinde</label>
                    <input id="18" name="18" type="number" placeholder="1" class="form-control islemli">
                    <label for="19">Kitabın Konusu</label>
                    <input id="19" name="19" type="text" placeholder="1984" class="form-control islemli">
                    <label for="20">Kitabın Görseli</label>
                    <input id="20" name="20" accept="image/*" type="file" class="form-control islemli">
                    <input type="submit" name="edit" class="mt-2 btn btn-light w-50" style="display:block;margin-left:auto;margin-right:auto;" value="Kaydet">
                </form>
            </div>
        </div>
    </div>
    <div id="error" class="mesaj" style="z-index:5;position:fixed;right:5%;top:5%;background:#dc3545;width:25%;color:white;">
        <div>
            <span style="display:block;padding:0.75rem;background-color: rgba(0,0,0,0.4);">Hata!
                <div style="float:right;">
                    <i class="closed fa-solid fa-xmark"></i>
                </div>
            </span>
            <div id="errordesc" style="padding:0.75rem;">Bir hata oluştu!</div>
        </div>
    </div>
    <div id="success" class="mesaj" style="z-index:5;position:fixed;right:5%;top:5%;background:#198754;width:25%;color:white;">
        <div>
            <span style="display:block;padding:0.75rem;background-color: rgba(0,0,0,0.4);">Başarılı
            <div style="float:right;">
                    <i class="closed fa-solid fa-xmark"></i>
                </div>
        </span>
            <div id="successdesc" style="padding:0.75rem;">İşlem Başarılı</div>
        </div>
    </div>
    <?php
    error_reporting(E_ALL);ini_set('display_errors', 1);
    require_once("config.php");
    ?>
    <div class="container kaplayici <?=empty($kullanici)?"d-none":$kullanici;?>">
        <h4 class="display-4">Kitap Listesi</h4>
        <div style="display:flex;">
            <div id="liste" style="width:70%;display:inline-block;">
            <div class="normal">
            <?php
            $siralama = empty($_GET["1"])?1:$_GET["1"];
            $ozellik = "ASC";
            switch($siralama){
                case (1):
                    $ilk = "bookauthor";
                    break;
                case (2):
                    $ilk = "bookname";
                    break;
                case (3):
                    $ilk = "pagenumber";
                    break;
                case (4):
                    $ilk = "id";
                    break;
                case (5):
                    $ilk = "isitover";$ozellik="DESC";
                    break;
                case (6):
                    $ilk = "isbeauty";
                    $ozellik = "DESC";
                    break;
                case (7):
                    $ilk = "youhave";
                    $ozellik="DESC";
                    break;
            }
    
    

            $query = $db->query("SELECT * FROM books where whois=$kullanici ORDER BY $ilk $ozellik");
            $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($fetch as $row) {
                ?>
                <div onclick="klik(<?=$row['id']?>)" style="overflow:hidden;margin-bottom:0.375rem;color:white;padding:1rem 2rem;border-radius:0.375rem;cursor:pointer;background-color:<?= $row['isitover'] == 1 ? '#8ab1b1' : '#9DC8C8';?>;" class="temelkabuk id-<?=$row['id']?>">
                    <div class="kabuk">
                        <span style="display:block;position:relative;"><h2 style="margin-bottom:unset;"><?= $row["bookname"];?></h2><p style="color:#519D9E"><?= $row["bookauthor"];?></p></span>
                    <div class="piyasa" style="padding:1rem 1.5rem;display:none;">
                        <div style="float:right;">
                        <?php
                        echo $row["isitover"]==1?'<i onclick=\'editajax('.$row["id"].')\' data-hangi="'.$row["id"].'" data-isim="'.$row["bookname"].'" data-yazar="'.$row["bookauthor"].'" class="fa-solid fa-xmark"></i>':'<i onclick=\'editajax('.$row["id"].')\' data-hangi="'.$row["id"].'" data-isim="'.$row["bookname"].'" data-yazar="'.$row["bookauthor"].'" class="fa-solid fa-check"></i>';
                        ?>
                        <i data-hangi="<?php echo $row["id"]; ?>" data-isim="<?php echo $row["bookname"]?>" data-yazar="<?php echo $row["bookauthor"]?>" onclick="edit(<?=$row['id']?>)" class="fa-solid fa-pencil"></i><i onclick="deleteitem(<?=$row['id'];?>)" data-hangi="<?=$row["id"]; ?>" data-isim="<?php echo $row["bookname"]?>" data-yazar="<?php echo $row["bookauthor"]?>"  class="fa-solid fa-trash text-white"></i></div>
                            <p>Detaylı Kitap Bilgisi:</p>
                            <ul style="list-style:none;padding:unset;margin:unset;">
                                <li><b>ID:</b> <?=$row['id']?> </li>
                                <li><b>KITAP ADI:</b> <?= $row["bookname"];?> </li>
                                <li><b>YAZAR ADI:</b> <?= $row["bookauthor"];?> </li>
                                <li><b>SAYFA SAYISI:</b> <?= $row["pagenumber"];?> </li>
                                <li><b>KITAP DILI:</b> <?= $row["booklang"];?> </li>
                                <li><b>YAYIMCI:</b> <?= $row["publisher"];?> </li>
                                <li><b>BASLANMA TARIHI:</b> <?= $row["startdate"];?> </li>
                                <li><b>BITIRME TARIHI:</b> <?= $row["finishdate"];?> </li>
                                <li><b>OKUNDU MU:</b> <?= $row["isitover"]==true?"Evet":"Hayır";?> </li>
                                <li><b>SET MI:</b> <?= $row["isset"]==true?"Evet":"Hayır";?> </li>
                                <li><b>ONCELIK:</b> <?= $row["isbeauty"]==true?"Evet":"Hayır";?> </li>
                                <li><b>ELINDE VAR MI:</b> <?= $row["youhave"] ==true?"Evet":"Hayır";?> </li>
                                <li><b>SALON | KOD:</b> <?=$row["kod"];?> </li>
                                <li><b>TUR:</b> <?=$row["kind"];?> </li>
                                <li><b>OKUNAN SAYFA:</b> <?=$row["okunan"];?> </li>
                                <li><b>ORIJINAL DIL:</b> <?=$row["originalang"];?> </li>
                                <li><b>CEVIRIST:</b> <?=$row["translator"];?> </li>
                                <li><b>ORIJINAL ADI:</b> <?=$row["title"];?> </li>
                                <li><b>KITAP KIMIN:</b> <?php $who =$row['whois']; $sorgu=$db->query("SELECT * FROM users WHERE id=$who");$fetch2=$sorgu->fetch();echo $fetch2["isim"];?> </li>
                                <li><b>Kitap Konusu:</b> <?=$row["konusu"];?> </li>
                                <?php if(!empty($row["img"])):?>
                                <li><b>Kitap Görseli:</b> <span style="background-image:url('<?=$row["img"];?>');display:block;width:100%;height:384px;position:relative;background-position:center;background-size:cover;" ></span> </li>
                                <?php endif;?>
                            </ul>
                        </div></div>
                </div>
                <?php }?>
                </div>
                <div class="arama"></div>
            </div>
            <div id="panel" style="width:30%;display:inline-block;padding:1rem 2rem;">
                <div style="position:sticky;top:0;position:-webkit-sticky;">
                <div id="search">
                    <form action="javascript:void(0)">
                        <label for="searchin">Arama Yap</label>
                        <input type="search" style="margin-bottom:0.375rem;" id="searchin" class="form-control" placeholder="Yaz bakalım.">
                        <div class="aramayaz">
                        </div>
                        <input type="submit" value="Bul" class="btn mt-1 btn-outline-dark w-100">
                    </form>
                    
                </div>
                <div id="siralama" class="mt-2">
                    <p>Sıralama</p>
                    <span><a href="<?=$_SERVER['PHP_SELF']?>?1=1">Yazar Adı</a></span><span><a href="<?=$_SERVER['PHP_SELF']?>?1=2">Kitap Adı</a></span><span><a href="<?=$_SERVER['PHP_SELF']?>?1=3">Sayfa Sayısı</a></span><span><a href="<?=$_SERVER['PHP_SELF']?>?1=4">Eklenme Sırası</a></span><span><a href="<?=$_SERVER['PHP_SELF']?>?1=5">Okunma Durumu</a></span><span><a href="<?=$_SERVER['PHP_SELF']?>?1=6">Öncelik Durumu</a></span><span><a href="<?=$_SERVER['PHP_SELF']?>?1=7">Eldeki Kitap</a></span></div>
                </div>
            </div>
        </div>  
        <div>
            <h4 class="display-6">İstatiksel Veriler</h4>
            <div id="dilimler">
                        <?php
                        $query = $db->query("SELECT DISTINCT kind FROM books");
                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $row){
                            $rowt = $row['kind'];
                            $query = $db->query("SELECT COUNT(*) FROM books WHERE kind LIKE '%$rowt%'");
                            $sayi = $query->fetchAll(PDO::FETCH_ASSOC)[0]["COUNT(*)"];
                            echo "<span style='display:none;' data-isim='$rowt' data-sayi='$sayi'></span>";
                        }
                        ?>
                    </div>
            <div class="row">
                <div class="col-md-4">
                    <?php
                    $query = $db->query("SELECT COUNT(*) FROM books");
                    $maxbook = $query->fetchAll(PDO::FETCH_ASSOC)[0]["COUNT(*)"];
                    $query = $db->query("SELECT COUNT(*) FROM books WHERE isitover=1");
                    $minbook = $query->fetchAll(PDO::FETCH_ASSOC)[0]["COUNT(*)"];
                    $query = $db->query("SELECT COUNT(*) FROM books WHERE youhave=1");
                    $elde = $query->fetchAll(PDO::FETCH_ASSOC)[0]["COUNT(*)"];
                    $query = $db->query("SELECT COUNT(*) FROM books WHERE youhave=1 AND isitover=1");
                    $eldeokunmuş = $query->fetchAll(PDO::FETCH_ASSOC)[0]["COUNT(*)"];
                    ?>
                <p>Okunan Kitap Sayısı</p>
                <span style="display:block;">
                <span><?=$minbook?></span>
                <span style="float:right;"><?=$maxbook?></span></span>
                <span class="istatis" data-max="<?=$maxbook?>" data-min="<?=$minbook?>" style="display:block;height:.75rem;border-radius:50px;">
                <span class="before"></span>
                </span>
                <p class="mt-4">Sahip Olunan Kitap Sayısı</p>
                <span style="display:block;">
                <span><?=$eldeokunmuş?></span>
                <span style="float:right;"><?=$minbook?></span></span>
                <span class="istatis" data-max="<?=$minbook?>" data-min="<?=$eldeokunmuş?>" style="display:block;height:.75rem;border-radius:50px;">
                <span class="before"></span>
                </span>

                </div>
                <div class="col-md-4">
                    <h5>Diğer İstatistik Bilgileri</h5>
                    <?php
                        $query=$db->prepare("SELECT * FROM books WHERE isitover=?");
                        $query->execute([1]);
                        $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
                        $sayfatoplam=0;
                        foreach($fetch as $row){
                            if(intval($row["pagenumber"])!=0){
                                $sayfatoplam+=intval($row["pagenumber"]);

                            }
                        }
                        $sayfaortalamasi= intval($sayfatoplam/$query->rowCount());

                        $query= $db->prepare("SELECT * FROM dailyread");
                        $query->execute();
                        $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
                        $geneltoplam=0;
                        $saataytoplam=0;
                        $sayfaaytoplam=0;
                        $genelsayfaaytoplam=0;
                        foreach($fetch as $row){
                            $baslangic = explode(" ",$row["starttm"]);
                            $kitapszgunsayisi[]=$baslangic[0];
                            $bitis = explode(" ",$row["finishtm"]);
                            $tarih = explode("-",$baslangic[0]);
                            $baslangiczaman = explode(":",$baslangic[1]);
                            $bitiszaman = explode(":",$bitis[1]);
                            $ilktoplam=($baslangiczaman[0]*60)+$baslangiczaman[1]+($baslangiczaman[2]/60);
                            $sontoplam=($bitiszaman[0]*60)+$bitiszaman[1]+($bitiszaman[2]/60);
                            $genelsayfaaytoplam+=$row["pageread"];
                            if(($tarih[0]."-".$tarih[1])==date("Y-m")){
                                $saataytoplam+=$sontoplam-$ilktoplam;
                                $sayfaaytoplam+=$row["pageread"];
                            }
                            $genel = $sontoplam-$ilktoplam;
                            $geneltoplam += $genel;
                        }
                        $okunmaortalama = $geneltoplam/$query->rowCount();
                        $gunlukortalama =$genelsayfaaytoplam/$query->rowCount();
                        $tekrarsil = array_unique($kitapszgunsayisi);
                        $sirala = array_reverse($tekrarsil);
                        foreach($sirala as $row){
                            $zamanlar[] = strtotime($row);
                        }
                        $sonucson = (($zamanlar[0])-end($zamanlar))/86400;
                        $query = $db->query("SELECT * FROM dailyread");
                        $fetch = $query->fetchAll();

                        $kayitlitoplampage=0;
                        foreach($fetch as $row){
                            $kayitlitoplampage +=$row["pageread"];
                        }
                    
                    ?>
                    <ul style="list-style:none;">
                        <li><b>Toplam Okunan Sayfa Sayısı : </b><?=number_format($sayfatoplam);?></li>
                        <li><b>Toplam Okunan Kayıtlı Sayfa Sayısı : </b><?=number_format($kayitlitoplampage);?></li>
                        <li><b>Kitapların Sayfa Ortalaması : </b><?=$sayfaortalamasi?></li>
                        <li><b>Kayıtlı Okuma Süresi : </b><?=number_format($geneltoplam/60,2);?> Saat</li>
                        <li><b>Ortalama Okuma Süresi : </b><?=number_format($okunmaortalama,2);?> Dakika</li>
                        <li><b>Bu Ay Toplam Okuma Süresi : </b><?=number_format($saataytoplam/60,2);?> Saat</li>
                        <li><b>Bu Ay Toplam Okunan Sayfa : </b><?=number_format($sayfaaytoplam);?> Sayfa</li>
                        <li><b>Günlük Ortalama Okunan Sayfa : </b><?=number_format($gunlukortalama,2);?> Sayfa</li>
                        <li><b>Kitapsız Geçen Gün Sayısı : </b><?=$sonucson-count($sirala);?> Gün</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Sevilen Yazarlar</h5>
                    <div class="likedauthors" style="max-height:50vh;overflow-Y:scroll">
                        <?php
                        $query = $db->query("SELECT DISTINCT bookauthor FROM books");
                        $array = array();
                        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $row){
                            $ata = $row["bookauthor"];
                            $query = $db->prepare("SELECT * FROM books WHERE bookauthor=?");
                            $query->bindParam(1,$ata);
                            $query->execute();
                            $array[$ata]=$query->rowCount();
                        }
                        arsort($array);
                        foreach($array as $row => $value){
                            if($value!=1){
                                echo "<span data-sayi='$value'>$row</span>";
                            }
                        }
                        
                        ?>
                    </div>
                </div>
                
            </div>
            <div id="statistik">
                <?php
                    $query=$db->query("SELECT * FROM dailyread WHERE whois=$kullanici");
                    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach($fetch as $row){
                        $start = $row["starttm"];
                        $end = $row["finishtm"];
                        $sayfa = $row["pageread"];

                        echo "<span style='display:none;' data-start='$start' data-end='$end' data-sayfa='$sayfa'></span>";
                    }
                ?>
            </div>
            <div>
                <h5>Aylık Okuma Dağılımı</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Aylar(2023)</th>
                        <th>Ocak</th>
                        <th>Şubat</th>
                        <th>Mart</th>
                        <th>Nisan</th>
                        <th>Mayıs</th>
                        <th>Haziran</th>
                        <th>Temmuz</th>
                        <th>Ağustos</th>
                        <th>Eylül</th>
                        <th>Ekim</th>
                        <th>Kasım</th>
                        <th>Aralık</th>
                    </tr>
                    <tr>
                        <th>Okunan Sayfa</th>
                        <?php
                            $query=$db->prepare("SELECT * FROM dailyread WHERE whois=$kullanici");
                            $query->execute();
                            $fetch = $query->fetchAll();
                            $yil=2023;
                            $i=1;
                            $toplamokunan=0;
                            $toplamzaman=0;
                            while($i<13){
                                $a=0;
                                foreach($fetch as $row){
                                    $a++;
                                    $tarih = explode(" ",$row["starttm"]);
                                    $tarih2= explode("-",$tarih[0]);
                                    if($tarih2[0]==$yil){
                                        if($tarih2[1]==$i){
                                            $toplamokunan+=$row["pageread"];
                                            $tarih1=explode(" ",$row["starttm"]);
                                            $tarih2=explode(" ",$row["finishtm"]);
                                            $date1 = explode(":",$tarih1[1]);
                                            $date2 = explode(":",$tarih2[1]);
                                            $bir = ((intVal($date2[0])*60)+intVal($date2[1])+(intVal($date2[2])/60));
                                            $iki = ((intVal($date1[0])*60)+intVal($date1[1])+(intVal($date1[2])/60));
                                            $all = $bir-$iki;
                                            $toplamzaman+=$all;
                                        }
                                    }
                                }
                                $ortalamatoplamsaat[]=($toplamzaman/60)/$a;
                                $toplamzamanar[]= $toplamzaman;
                                $toplamzaman=0;
                                echo "<td>".number_format($toplamokunan)."</td>";
                                $toplamokunan=0;
                                $i++;
                            }
                        ?>
                    </tr>
                    <tr>
                        <th>Kitap Okurken Geçen Süre (Hour)</th>
                        <?php
                            foreach($toplamzamanar as $row){
                                echo "<td>".number_format($row/60,1)."</td>";
                            }
                        

                        ?>
                    </tr>
                    <tr>
                        <th>Ortalama Okuma Süresi (Second)</th>
                        <?php
                            $query = $db->query("select * from dailyread where whois=$kullanici");
                            $fetch =$query->fetchAll(PDO::FETCH_ASSOC);
                            $i=1;
                            $geneltoplam=0;
                            $toplamkitap=0;
                            while($i<13){
                                $a=0;
                                foreach($fetch as $row){
                                    $tarih1 = $row["starttm"];
                                    $tarih2 = $row["finishtm"];
                                    $saat1 = explode(" ",$tarih1);
                                    $saat2 = explode(" ",$tarih2);
                                    $saat1uc = explode(":",$saat1[1]);
                                    $saat2uc = explode(":",$saat2[1]);
                                    if($yil == $tarih1[0].$tarih1[1].$tarih1[2].$tarih1[3]){
                                        if($i==intval($tarih1[5].$tarih1[6])){
                                            $sonhal1=($saat1uc[0]*60)+$saat1uc[1]+($saat1uc[2]/60);
                                            $sonhal2=($saat2uc[0]*60)+$saat2uc[1]+($saat2uc[2]/60);
                                            $sonuc = floatval($sonhal2)-floatval($sonhal1);
                                            $geneltoplam+=$sonuc;
                                            $toplamkitap+=$sonhal1;
                                            $a++;
                                        }
                                    }
                                }
                                $a = $a==0?1:$a;
                                $ortalamasaat[]=($toplamkitap/60/$a);
                                echo "<td>".number_format($geneltoplam/$a,2)."</td>";
                                $sonuc=0;
                                $toplamkitap=0;
                                $geneltoplam=0;
                                $i++;
                            }
                            
                        ?>
                    </tr>
                    <tr>
                        <th>Ortalama Kitap Okuma Saati</th>
                        <?php

                        foreach($ortalamasaat as $row){
                            echo "<td>".number_format($row,2)."</td>";
                        }
                        
                        
                        ?>
                    </tr>
                    <tr>
                        <th>Bitirilen Kitap Sayısı</th>
                        <?php
                        $query = $db->query("SELECT DISTINCT idkitap FROM dailyread WHERE whois=$kullanici");
                        $fetch = $query->fetchAll();
                        foreach($fetch as $row){
                            $allid[]=$row["idkitap"]."<br>";
                        }
                        $toplam=0;
                        foreach($allid as $row){
                            $query = $db->query("SELECT * FROM dailyread where idkitap='$row' AND whois=$kullanici");
                            $fetch = $query->fetchAll();
                            foreach($fetch as $row2){
                                $toplam+=$row2["pageread"];
                                $sontarih=$row2["finishtm"];
                            }
                            $bilgiler[]=array($row,$sontarih,$toplam);
                            $toplam=0;
                        }

                        foreach($bilgiler as $row){
                            $query = $db->query("SELECT * FROM books where id='$row[0]' AND whois=$kullanici");
                            $fetch = $query->fetchAll();
                            foreach($fetch as $row2){
                                $ayir = explode("-",explode(" ",$row[1])[0]);
                                if($row[2]==$row2["pagenumber"]){
                                    $diger[]=array($row,intval($ayir[1]),intval($ayir[0]));
                                    if($yil==intval($ayir[0])){
                                        $gun[]=intval($ayir[1]);
                                    }
                                }else{
                                    $diger[]=array($row,0);
                                }
                            }
                        }
                        $array = array_count_values($gun);
                        $i=1;
                        while($i<13){
                            if(array_key_exists($i,$array)){
                                echo "<td>$array[$i]</td>";
                            }else{
                                echo "<td></td>";
                            }
                            $i++;
                        }
                        ?>
                    </tr>
                </table>
            </div>
            <div class="mt-4 mb-4">
                <h5>Son Okunan Kitaplar</h5>
                <ul class="eszaman" style="list-style:none;">
                <?php 
                    $query= $db->query("SELECT DISTINCT idkitap FROM dailyread");
                    $fetch= $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach($fetch as $row){
                        $newar[] = $row["idkitap"]."<br>";
                    }
                    $i=0;
                    while($i<count($newar)){
                        $tranmission = $newar[$i];
                        $query2=$db->query("SELECT * FROM books WHERE id='$tranmission'");
                        $fetch2=$query2->fetchAll(PDO::FETCH_ASSOC);
                        foreach($fetch2 as $row){
                            $newar2[]=array($row["pagenumber"],$row["bookname"],$row["okunan"],$row["finishdate"]);
                        }
                        
                        $i++;
                    }
                    $i=0;
                    $toplam=0;
                    $geneltoplam =array();
                    foreach($newar as $row){
                        $query=$db->query("SELECT * FROM dailyread WHERE idkitap='$row'");
                        $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
                        $a = 0;
                        foreach($fetch as $row2){
                            $toplam+=$row2["pageread"];
                            $a++;
                        }
                        $geneltoplam[]= $toplam;
                        $ortalama = $toplam/$a;
                        $ortalamagenel[]=$ortalama;
                        $toplam=0;
                    }
                    $i=0;
                    while($i<count($newar2)){
                        if($geneltoplam[$i]>=$newar2[$i][0]){

                        }else{
                        echo "<li>".$newar2[$i][1].", Kaldığınız Sayfa:".$geneltoplam[$i].", Kalan Sayfa:".$newar2[$i][0]-$geneltoplam[$i].", Tahmini Bitirme Süresi:".number_format(($newar2[$i][0]-$geneltoplam[$i])/$ortalamagenel[$i],2)." Gün</li>";
                        }
                        $i++;
                    }

                ?>
                </ul>
            </div>
            <div class="mt-4 mb-4">
                <h5>Son Bitirilen Kitaplar</h5>
                <ul class="eszaman" style="list-style:none;">
                <?php 
                    $i=0;
                    while($i<count($newar2)){
                        if($geneltoplam[$i]>=$newar2[$i][0]){
                        echo "<li>".$newar2[$i][1].", Bitirme Tarihi: ".$newar2[$i][3]."</li>";
                        }
                        $i++;
                    }
                ?>
                </ul>
            </div>
            <div class="inteaktifoge">
                <span>Günlük Okuma</span>
                <form action="allin.php" style="padding:1em 0 1em 0;" method="post">
                    <label style="font-size:unset">Kitap Id'si</label>
                    <input required name="1" type="number" min="0" class="form-control">
                    <label>Bugünün Tarihi</label>
                    <input type="text" readonly value="<?=date("d/m/Y")?>" class="form-control">
                    <label for="">Başlangıç Saati</label>
                    <input required name="2" type="time" step="1" class="form-control saat">
                    <label for="">Bitiş Saati</label>
                    <input required name="3" type="time" step="1" class="form-control saat">
                    <label for="">Saat Fark</label>
                    <input  type="text" readonly class="form-control farksaat">
                    <label>Okunan Sayfa Sayısı</label>
                    <div style="display:flex;">
                        <input required name="4" type="number" min="0" class="form-control w-50 sayfasayi">
                        <input required name="5" type="number" min="0" class="form-control w-50 sayfasayi">
                    </div>
                    <label>Sayfa Fark</label>
                    <input type="text" readonly class="form-control farksayfa">
                    <input type="submit" name="gunlukokuma" class="btn btn-dark w-50 mt-2" style="margin-left:auto;margin-right:auto;display:block;" value="Kaydet">
                </form>
            </div>
            <div class="inteaktifoge">
                <span>Günlük Sayaç</span>
                <form action="javascript:void(0)" style="padding:1em 0 1em 0;" method="post">
                    <label>Sayaç</label>
                    <div style="display:flex;">
                        <input type="time" readonly step="1" class="form-control sayac-bas">
                        <input type="submit" value="Başlat" class="btn btn-success baslat">
                        <input type="submit" value="Bitir" class="btn btn-danger bitir">
                        <input type="submit" value="Sıfırla" class="btn btn-warning sifirla">
                        
                    </div>
                    <div class="ekle">
                            
                    </div>
                </form>
            </div>  
        </div>        
    </div>
    <script src="../src/js/istatistik.js"></script>
    <script src="src/js/javascript.js"></script>
</body>
</html>