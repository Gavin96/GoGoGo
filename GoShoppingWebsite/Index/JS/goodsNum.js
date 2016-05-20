/**
 * Created by FanLiang on 5/15 2016.
 */

function decrease(obj) {
    var val=parseInt($(obj).next().val())-1;
    if(val>=0){$(obj).next().val(val);}
    $(".show_total_price").html(parseInt($(obj).next().val())*parseInt($(".show_per_price").html()));

}

function increase(obj) {
    $(obj).prev().val(parseInt($(obj).prev().val())+1);
    $(".show_total_price").html(parseInt($(obj).prev().val())*parseInt($(".show_per_price").html()));
}

function decrease2(obj) {
    var val=parseInt($(obj).parent().next().children().val())-1;
    if(val>=0){$(obj).parent().next().children().val(val);}
    $(".span_amount").html($(obj).parent().next().children().val());

}

function increase2(obj) {
    $(obj).parent().prev().children().val(parseInt($(obj).parent().prev().children().val())+1);
    $(".span_amount").html($(obj).parent().prev().children().val());
}