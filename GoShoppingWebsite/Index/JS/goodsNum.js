/**
 * Created by FanLiang on 5/15 2016.
 */
function showBanner1(obj){
    var src = "images/banner/banner_01.jpg";
    $(".bannerImgBox img").attr("src",src);
    $(".bannerImgBox a").attr("href","cateDetail.php?CId=1");
    $(".bannerImgNum").children().addClass("active");
    $(".bannerImgNum").children().next().removeClass("active");
}

function showBanner2(obj){
    var src = "images/banner/banner_02.jpg";
    $(".bannerImgBox img").attr("src",src);
    $(".bannerImgBox a").attr("href","cateDetail.php?CId=2");
    $(".bannerImgNum").children().removeClass("active");
    $(".bannerImgNum").children().next().addClass("active");
}

function decrease(obj) {
    var val=parseInt($(obj).next().val())-1;
    if(val>=0){$(obj).next().val(val);}
    $(".show_total_price").html(parseInt($(obj).next().val())*parseInt($(".show_per_price").html()));

}

function increase(obj) {
    var val = parseInt($(obj).prev().val())+1;
    if(val<=$(".total_amount_left").val()){
        $(obj).prev().val(val);
    }
    $(".show_total_price").html(parseInt($(obj).prev().val())*parseInt($(".show_per_price").html()));
    
}

function decrease2(obj) {
    var val=parseInt($(obj).parent().next().children().val())-1;
    if(val>=0){$(obj).parent().next().children().val(val);}
    $(".span_amount").html($(obj).parent().next().children().val());

}

function increase2(obj) {
    var val = parseInt($(obj).parent().prev().children().val())+1;
    if(val<=$(".total_amount_left").val()){
        $(obj).parent().prev().children().val(val);
    }
    $(".span_amount").html($(obj).parent().prev().children().val());
}

function changePhoto(obj){
    // $(".big").children().attr("src",$(obj).children().attr("src"));
    var src = $(obj).children().attr("src");
    var re=new RegExp("50","i");
    var newSrc=src.replace(re,"220");

    $(".big").children().attr("src",newSrc);
}