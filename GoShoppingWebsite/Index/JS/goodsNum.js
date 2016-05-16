/**
 * Created by FanLiang on 5/15 2016.
 */

function decrease(obj) {
    var val=parseInt($(obj).next().val())-1;
    if(val>=0){$(obj).next().val(val);}

}

function increase(obj) {
    $(obj).prev().val(parseInt($(obj).prev().val())+1);
}
