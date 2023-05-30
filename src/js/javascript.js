var islemler = "allin.php";

function deleteitem(id){
    console.log(id);
    $.ajax({
        url:islemler,
        type:"POST",
        data:{id},
        success:function(e){
            bildirim(e);
            console.log(e);
        }
    });
}

function bildirim(e){
    if(e ==="success"){
        $("#success").css("display","block");
    }else{
        $("#error").css("display","block");
    }
    setTimeout(function(){
        $(".mesaj").css("display","none");
    },5000);
}
$(".saat").val("00:00:00");
function klik(e){
    $(".id-"+e+" .piyasa").toggle();

}

function editajax(e){
    var veri = e;
    $.ajax({
        url:islemler,
        type:"POST",
        data:{veri},
        success:function(e){
            bildirim(e);
        }
    });
}
$(".closed").click(function(){
    $(".mesaj").css("display","none");
});

$("#search > form > input[type=search]").keyup(function(e){
    if($("#search > form > input[type=search]").val().length >=2){
        var value = $("#search > form > input[type=search]").val();
        if(e.key =="Backspace"){
            $(".aramayaz > a").remove();
        }
        $.ajax({
            url:islemler,
            type:"POST",
            data:{value},
            success:function(e){
                $(".aramayaz > a").remove();
                console.log("deneme");
                $(".aramayaz").append(e);
            }
        });
        
    }
});

var boyut = $(".istatis").eq(0).width();
var ilkdeger1 = $(".istatis").eq(0).data("max");
var ilkdeger2 = $(".istatis").eq(0).data("min");
var ikindeger1 = $(".istatis").eq(1).data("max");
var ikindeger2 = $(".istatis").eq(1).data("min");
var ilk = $(".istatis > .before").eq(0).css("width",(boyut/ilkdeger1)*ilkdeger2);
var ilk = $(".istatis > .before").eq(1).css("width",(boyut/ikindeger1)*ikindeger2);
var values=Array();
var labels =Array();
$.each($("#dilimler > span"),function(first,second){
    values[first] = second.dataset.sayi;
    labels[first] = second.dataset.isim;
    if(second.dataset.isim==""){
        labels[first]="Girilmemiş";
    }
});
var data = [{
    values,
    labels,
    type:"pie"
}];
var layout = [{
    height:"auto",
    width:"auto"
}];

Plotly.newPlot("dilimler",data,layout);


var xeks = Array();
var yeks= Array();

$.each($('#statistik > span'),function(ilk, son){
    xeks[ilk]=son.dataset.start;
    yeks[ilk]=son.dataset.sayfa;
});
var layout ={
    title:"Günlük Okunma Oranı",
}
var data2= [{
    x:xeks,
    y:yeks,
    z:yeks,
    type: 'scatter'}
];
Plotly.newPlot('statistik', data2,layout);
$(".modebar-container").remove();
$(".saat").change(function(){
    var ilk = $(".saat").eq(0).val();
    var iki = $(".saat").eq(1).val();
    var saat1= ilk.split(":");
    var saat2= iki.split(":");
    if(saat1[0]=="00"){
        saat1[0]==24;
    }if(saat2[0]=="00"){
        saat2[0]==24;
    }
    var baslangic = (parseInt(saat1[0])*60)+(parseInt(saat1[1]))+(parseInt(saat1[2])/60);
    var bitis = (parseInt(saat2[0])*60)+(parseInt(saat2[1]))+(parseInt(saat2[2])/60);
    $(".farksaat").val(parseInt((bitis-baslangic)/60)+" Saat, "+parseInt((bitis-baslangic)%60)+" Dakika");
    if(bitis-baslangic<0){
        bildirim("hata");
        $(".farksaat").val("Hata!");
    }
});


$(".sayfasayi").change(function(){
    if($(".sayfasayi").eq(0).val()=="" || $(".sayfasayi").eq(1).val()==""){
        $(".farksayfa").val("Hata!");
    }else{
        if($(".sayfasayi").eq(1).val()-$(".sayfasayi").eq(0).val()<0){
            bildirim("hata");
        }else{
            $(".farksayfa").val($(".sayfasayi").eq(1).val()-$(".sayfasayi").eq(0).val());

        }
    }
});
$(".sayac-bas").val("00:00:00");
function sayac(){
    var s =0;
    var d =0;
    var h =0;
    window.zaman = setInterval(function(){
    s++;
    if(s==60){
        s=0;
        d++;
        $(".sayac-bas").val(tamamla(h)+":"+tamamla(d)+":"+tamamla(s));
    }
    if(d==60){
        d=0;
        h++;
        $(".sayac-bas").val(tamamla(h)+":"+tamamla(d)+":"+tamamla(s));
    }
    $(".sayac-bas").val(tamamla(h)+":"+tamamla(d)+":"+tamamla(s));
    },1000);
}
function tamamla(al){
    var gelen = String(al);
    if(gelen.length!=2){
        return "0"+al;
    }else{
        return al;
    }
}
var sayacbaslatmak=false;
var sayacbitirmek=false;
function sayac_bitir(){clearInterval(window.zaman);}
$(".baslat").click(function(){
    console.log(window.sayacbaslatmak);
    if(!window.sayacbaslatmak){
        const tarih = new Date();
        sayac();
        var baslatogesi = document.getElementsByClassName("ekle");
        var baslatlabel = document.createElement("label");
        var baslatinput = document.createElement("input");
        baslatlabel.htmlFor="baslatinp";
        baslatlabel.innerHTML="Başlangıç Saati";
        baslatinput.value = tarih.toLocaleTimeString();
        baslatinput.type="text";
        baslatinput.className="form-control";
        baslatinput.id="baslatinp";
        baslatogesi[0].appendChild(baslatlabel);
        baslatogesi[0].appendChild(baslatinput);
        window.sayacbaslatmak=true;
    }
});
$(".bitir").click(function(){
    if(window.sayacbaslatmak){
        if(!window.sayacbitirmek){
            const tarih = new Date();
            sayac_bitir();
            var bringme = document.getElementsByClassName("ekle");
            var bitislabel = document.createElement("label");
            var bitisinput = document.createElement("input");
            var soninput = document.createElement("input");
            bitislabel.htmlFor="bitirinp";
            bitislabel.innerHTML="Bitiriş Saati";
            bitisinput.value=tarih.toLocaleTimeString();
            bitisinput.id="bitirinp";
            bitisinput.type="text";
            bitisinput.className="form-control";
            soninput.value="Günlük Okumaya Aktar";
            soninput.type="submit";
            soninput.className="btn btn-primary";
            soninput.onclick=function(){
                var ilkdeger = $(".ekle input").eq(0).val();
                var ikdeger = $(".ekle input").eq(1).val();
                $(".saat").eq(0).val(ilkdeger);
                $(".saat").eq(1).val(ikdeger);
            };
            soninput.style.margin="0.375rem auto 0.375rem auto";
            soninput.style.display="block";
            bringme[0].appendChild(bitislabel);
            bringme[0].appendChild(bitisinput);
            bringme[0].appendChild(soninput);
            window.sayacbitirmek=true;
        }
    }
});
$(".sifirla").click(function(){
    sifirla();
});
function sifirla(){
    var doc =document.getElementsByClassName("ekle");
    doc[0].innerHTML="";
    sayac_bitir();
    $(".sayac-bas").val("00:00:00");
    window.sayacbaslatmak=false;
    window.sayacbitirmek=false;
}

$(".inteaktifoge > span").click(function(e){
    $(this).find("+form").toggle();
});

function edit(gelen){
    var duzenle = gelen;
    $.ajax({
        url:islemler,
        type:"POST",
        data:{duzenle},
        success:function(e){
            var gelecek = JSON.parse(e);
            $(window).scrollTop(0);
            $(".editing .container h2").eq(0).html(gelecek[0]);
            $(".editing .container h2").eq(1).html(gelecek[1]);
            $(".editing").css("display","block");
            $(".editing div div form input").eq(0).val(gelen);
            $(".kaplayici").css("display","none");
            $.each(gelecek, function(sayi,bilgi){
                var dokuman = document.getElementsByClassName("islemli");
                if(sayi==5){
                    dokuman[sayi].value=bilgi;

                }else if(sayi ==6){
                    dokuman[sayi].value=bilgi;

                }else{
                    dokuman[sayi].placeholder=bilgi;

                }

            });
        }
    });
}
