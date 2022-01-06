function isValuePresent(element) {
    if(element.val().length > 0) {
        return true;
    }
    return false;
}
$(document).ready(function () {
    var input = $("main form input");
    input.focus(function(){
        $(this).prev().addClass("moved");
    });
    input.focusout(function(){
        if(!isValuePresent($(this))) {
            $(this).prev().removeClass("moved");
        }
    });
});