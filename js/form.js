function isValuePresent(element) {
    if(element.val().length > 0) {
        return true;
    }
    return false;
}
$(document).ready(function () {
    var input = $("main form input:not([type=radio])");
    $("textarea").focus(function(){
        $(this).prev().addClass("moved");
    });
    $("textarea").focusout(function(){
        if(!isValuePresent($(this))) {
            $(this).prev().removeClass("moved");
        }
    });
    input.focus(function(){
        $(this).prev().addClass("moved");
    });
    input.focusout(function(){
        if(!isValuePresent($(this))) {
            $(this).prev().removeClass("moved");
        }
    });
});