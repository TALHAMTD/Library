<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../src/css/bootstrap.min.css">
    <script src="../src/js/jquery.js"></script>
    <style>
        div > p{
            margin-left:1em;
        }
        .kitapbilgileri > p{
            position:relative;
        }
        .kitapbilgileri > p > span{
            background-color:aquamarine;
            padding:1em;cursor:pointer;
            position:absolute;
            z-index:50;
            left:50%;
        }
        .kitapbilgileri > p > span:hover{
            background-color:#69cfad;
        }
        .noscrollbar::-webkit-scrollbar {
            display: none;
        }
        .noscrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
        opacity:0;
        transition:500ms all;
        background-image:linear-gradient(to left, white, transparent);
        width:25%;
        }
        .noscrollbar:hover{
            opacity:1;
        }
        .noktalar{
            display:block;
            position:fixed;
            width:2px;
            height:2px;
            background-color:black;
            border-radius:50%;
            bottom:50%;left:5px;
            transition:left 20s,top 20s, opacity 1s;
            transition-timing-function:linear;
            opacity:0;
        }
        
    </style>
</head>
<body>
    <div class="aktifyap" style="width:100%;height:100%;position:fixed;z-index:150;display:none;">
    <div style="width:100%;height:100%;position:absolute;background-image:url('src/img/color-formation-8k-zt.jpg');filter:blur(5em);background-position:center;background-size:cover;"></div>
        <div class="container">
            <form action="" class="burayidoldur" method="post" style="position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);">
                <input type="text" class="form-control" style="background-color:transparent">
                <input type="submit" class="btn btn-primary w-100" value="Kaydet">
            </form>
        </div>
    </div>
    <?php
        $bosdeger = "Boş Bırakılmış";
        error_reporting(E_ALL);ini_set('display_errors', 1);
        require_once("config.php");
        $id = intval($_GET["sayfa"]);
        if($id==0){echo "Lütfen Sahtekarlık Yapmayın";die();}
        $query = $db->prepare("SELECT * FROM books WHERE id=?");
        $query->execute([$id]);
        $fetch = $query->fetch();
    ?>
    
    <div class="container">
        <h1 class="display-3 text-center"><?=$fetch["bookname"]?></h1>
        <h5 class="display-6 text-center"><?=$fetch["bookauthor"]?></h5>
        <div class="kitapbilgileri" style="width:60%;margin-left:auto;margin-right:auto;">
            <h4>Kitap Bilgileri</h4>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Kitabın Id'si</i> : <?=$fetch["id"]?></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Kitabın Adı</i> : <?=$fetch["bookname"]?><span data-hover="1" data-two="<?=$fetch['bookname']?>" style="display:none;">Kitap Adını Düzenle</span></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Kitabın Yazarı</i> : <?=$fetch["bookauthor"]?><span data-hover="2" style="display:none;" data-two="<?=$fetch['bookauthor']?>">Kitap Yazarını Düzenle</span></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Sayfa Sayısı</i> : <?=empty($fetch["pagenumber"])?$bosdeger:$fetch["pagenumber"];?><span data-hover="3" data-two="<?=$fetch['pagenumber']?>" style="display:none;">Sayfa Sayısını Düzenle</span></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Kitabın Dili</i> : <?=empty($fetch["booklang"])?$bosdeger:$fetch["booklang"];?><span data-two="<?=$fetch['booklang']?>" data-hover="4" style="display:none;">Kitap Dilini Düzenle</span></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Kitabın Yayımcısı</i> : <?=empty($fetch["publisher"])?$bosdeger:$fetch["publisher"];?><span data-two="<?=$fetch['publisher']?>" data-hover="5" style="display:none;">Kitap Yayımcısını Düzenle</span></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Kitabın Bitirilme Durumu</i> : <?=$fetch["isitover"]==0?$fetch["okunan"]>=0?"Okunuyor":"Bitmedi":"Bitti"?><span data-two="<?=$fetch['isitover']?>" data-hover="8" style="display:none;">Kitap Bitirilme Durumunu Düzenle</span></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Kitap Seri Olma Durumu</i> : <?=$fetch["isset"]==0?"Tek Kitap":"Seri Halinde"?><span data-two="<?=$fetch['isset']?>" data-hover="9" style="display:none;">Kitap Seri Olma Durumunu Düzenle</span></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Kitabın Öncelik Durumu</i> : <?=$fetch["isbeauty"]==0?"Öncelikli Değil":"Öncelikli"?><span data-two="<?=$fetch['isbeauty']?>" data-hover="10" style="display:none;">Kitap Öncelik Durumunu Düzenle</span></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Kitabın Sahiplik Durumu</i> : <?=$fetch["youhave"]==0?"Elde Yok":$fetch["youhave"]?><span data-two="<?=$fetch['youhave']?>" data-hover="11" style="display:none;">Kitap Sahiplik Durumunu Düzenle</span></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Kitabın Kodu</i> : <?=empty($fetch["kod"])?$bosdeger:$fetch["kod"];?><span data-two="<?=$fetch['kod']?>" data-hover="12" style="display:none;">Kitap Kodunu Düzenle</span></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Kitabın Türü</i> : <?=empty($fetch["kind"])?$bosdeger:$fetch["kind"];?><span data-two="<?=$fetch['kind']?>" data-hover="deneme" style="display:none;">Kitap Türünü Düzenle</span></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Okunan Sayfa Sayısı</i> : <?=empty($fetch["okunan"])?$bosdeger:$fetch["okunan"];?><span data-two="<?=$fetch['okunan']?>" data-hover="13" style="display:none;">Okunan Sayfa Sayısını Düzenle</span></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Kitabın Yazıldığı Dil</i> : <?=empty($fetch["originalang"])?$bosdeger:$fetch["originalang"];?><span data-two="<?=$fetch['originalang']?>" data-hover="14" style="display:none;">Kitabın Yazıldığı Dili Düzenle</span></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Kitabın Çevirist</i> : <?=empty($fetch["translator"])?$bosdeger:$fetch["translator"];?><span data-two="<?=$fetch['translator']?>" data-hover="15" style="display:none;">Kitabın Çeviristini Düzenle</span></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Kitabın Orijinal Adı</i> : <?=empty($fetch["title"])?$bosdeger:$fetch["title"];?><span data-two="<?=$fetch['title']?>" data-hover="16" style="display:none;">Kitap Orijinal Adını Düzenle</span></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Kitap Kimin</i> : <?php $who =$fetch['whois']; $sorgu=$db->query("SELECT * FROM users WHERE id=$who");$fetch2=$sorgu->fetch();echo $fetch2["isim"];?><span data-two="<?=$fetch['title']?>" data-hover="16" style="display:none;">Kitap Orijinal Adını Düzenle</span></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Kitab Hakkında</i> : <?=$fetch["konusu"]?><span data-hover="1" data-two="<?=$fetch['bookname']?>" style="display:none;">Kitap Adını Düzenle</span></p>
            <?php
            if(!empty($fetch["img"])):?>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Kitap Görseli</i> : <div class="gorsel" data-gorselac="<?=$fetch["img"];?>" style="background-image:url('<?=$fetch["img"];?>');display:block;width:100%;height:100vh;position:relative;background-position:center;background-size:cover;" ></div><span data-two="<?=$fetch['title']?>" data-hover="16" style="display:none;">Kitap Orijinal Adını Düzenle</span></p>
            <?php endif;?>
        </div>
        <div class="kitapbilgileri" style="width:60%;margin-left:auto;margin-right:auto;">
            <h4>Kitabın İstatistik Bilgileri</h4>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Kitaba Başlanma Tarihi</i> : <b><?=empty($fetch["startdate"])?$bosdeger:$fetch["startdate"];?></b><span data-two="<?=$fetch['startdate']?>" data-hover="6" style="display:none;">Kitap Başlama Tarihini Düzenle</span></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Kitabı Bitirme Tarihi</i> : <b><?=empty($fetch["finishdate"])?$bosdeger:$fetch["finishdate"];?></b><span data-two="<?=$fetch['finishdate']?>" data-hover="7" style="display:none;">Kitap Bitirme Tarihini Düzenle</span></p>
            <script>
        $(".kitapbilgileri > p").hover(function(){
            $("span",this).toggle();
        });
        $("p > span").click(function(){
            var deneme = $(this).data("hover");
            var two = $(this).data("two");
            $(".burayidoldur input[type=text]").val(two);
            $(".aktifyap").css("display","block");
        });
        var gorselac = document.getElementsByClassName("gorsel")[0];

        </script>
            <?php
                $query=$db->prepare("SELECT * FROM dailyread WHERE idkitap=?");
                $query->execute([$id]);
                $fetch2 = $query->fetchAll();
                $toplamokunan=0;
                $sonuc=array();
                $saattoplam=0;
                if($query->rowCount()==0){
                    echo "Okunma Veritabanında Bilgi Bulunamadı :(";
                    echo '
                    </body>
                    </html>';
                    die();
                }
                foreach($fetch2 as $row){
                    $baslangicgunleri[]=$row["idself"];
                    $max[]=$row["pageread"];
                    $toplamokunan+=$row["pageread"];
                    $starttm = $row["starttm"];
                    $finishtm = $row["finishtm"];
                    $tarih1=explode(":",explode(" ",$starttm)[1]);
                    $tarih2=explode(":",explode(" ",$finishtm)[1]);
                    $ilk = ($tarih1[0]*60)+($tarih1[1])+($tarih1[2]/60);
                    $iki = ($tarih2[0]*60)+($tarih2[1])+($tarih2[2]/60);
                    $sonuc = $iki-$ilk;
                    $saattoplam+=$sonuc;
                }
            ?>
            <?php
                $query = $db->prepare("SELECT * FROM dailyread WHERE idkitap=?");
                $query->execute([$id]);
                foreach($query->fetchAll() as $row){
                    $tarih = explode(" ",$row["starttm"]);
                    $days[]=$tarih[0];
                }
                $yeni = array_unique($days);
                $yeni2 = array_reverse($yeni);
                foreach($yeni2 as $row){
                    $arraynew[] = strtotime($row);
                }


            ?>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Kitap Kaç Günde Bitti</i> : <b><?=$fetch["isitover"]!=0?count($yeni):"Kitap Henüz Bitmedi"?></b></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Bir Günde Ortalama Kaç Sayfa Okudun</i> : <b><?=number_format($toplamokunan/count($baslangicgunleri),2)?> Sayfa</b></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Bu Kitabı Okurken Kaç Saat Harcadın</i> : <b><?=number_format($saattoplam/60,2)?> Saat</b></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Günde Ortalama Kaç Saat Okudun</i> : <b><?=number_format($saattoplam/count($baslangicgunleri),2)?> Dakika</b></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Günde En Fazla Kaç Sayfa Okudun</i> : <b><?=max($max);?> Sayfa</b></p>
            <p style="font-size:1.3rem;margin-bottom:.5em;"><i>Kitap Molası</i> : <b><?=(($arraynew[0]-end($arraynew))/86400+1)-count($yeni)?> Gün</b></p>
        </div>
    </div>
    <div class="noscrollbar" style="position:fixed;top:0;left:0;max-height:100%;overflow-y:scroll;">
        <ul style="list-style:none;">
            <?php
                $query=$db->prepare("SELECT * FROM books where id!=?");
                $query->execute([$id]);
                $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach($fetch as $row){
                    echo "<li><a href='".$_SERVER['PHP_SELF']."?sayfa=".$row["id"]."'>".$row["bookname"]."</a></li>";
                }
            ?>
        </ul>
    </div>
    <script>
        create();
        function create(){
            var arkaplan = document.getElementsByTagName("body")[0];
            for(i=0;i<10;i++){
                var xmax = window.innerWidth;
                var ymax = window.innerHeight;
                var x = Math.floor(Math.random()*xmax);
                var y = Math.floor(Math.random()*ymax);
                var create = document.createElement("span");
                create.className="noktalar";
                create.style.left=x+"px";
                create.style.top=y+"px";
                create.style.opacity=1;
                arkaplan.append(create);
            }
            //ikincil();
        }
        ikincil();

        var span = document.querySelectorAll("body > span");
        function ikincil(){
            setTimeout(function(){
                span.forEach(element =>{
                    var xmax = window.innerWidth;
                    var ymax = window.innerHeight;
                    var x = Math.floor(Math.random()*xmax);
                    var y = Math.floor(Math.random()*ymax);
                    element.style.left=x+"px";
                    element.style.top=y+"px";
                    setTimeout(function(){
                        element.style.opacity=0;
                        setTimeout(function(){
                            element.remove();
                        },1000);
                    },10000);
                });
            }, 100);
        }

    </script>
    
</body>
</html>