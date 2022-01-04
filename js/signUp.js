const pattern = /^(?:[0-9]+[a-z]|[a-z]+[0-9])[a-z0-9]*$/i;
function passwordCheck(password) {
    if(password.val()===undefined || password.val().length < 8 || !pattern.test(password.val())) {
        if(getError(password).val() === undefined)
          {
              password.addClass("isError");
              password.parent().append("<p id='error'>Password non valida. La password deve contenere almeno 8 caratteri, 1 lettera maiuscola e 1 numero</p>");
          }
     }
     else {
         password.removeClass("isError");
         getError(password).remove();
     }
}
function passwordConfirmCheck(element) {
    if(isValuePresent(element) && $("#password").val() != element.val()) {
        if(getError(element).val() === undefined)
        {
            element.removeClass("isCorrect");
            element.addClass("isError");
            element.parent().append("<p id='error'>Le password inserite non corrispondono</p>");
        }
    }  
    else if(isValuePresent(element)){
        element.addClass("isCorrect");
        element.removeClass("isError");
        getError(element).remove();
   }
    
}
function isValuePresent(element) {
    if(element.val().length > 0) {
        return true;
    }
    return false;
}
function getError(element) {
    return element.next().next().filter("#error");
}
function canEnable(input) {
    let canEnable = true;
    input.each(function() {
        if($(this).prop('required') && !$(this).hasClass("isCorrect")) {
            canEnable = false;
        }
    });
    return canEnable;
}
$(document).ready(function(){
    var input = $("main form input");
    input.focus(function(){
        $(this).next().addClass("moved");
    });
    input.focusout(function(){
        if(!isValuePresent($(this))) {
            $(this).next().removeClass("moved");
        }
    });
    input.keyup(function(e) {
        if($(this).is("#password")) {
            passwordCheck($(this));
            passwordConfirmCheck($("#confirm"));
        } else if($(this).is("#confirm")) {
            passwordConfirmCheck($(this));
        }
        if(isValuePresent($(this)) && getError($(this)).val() === undefined) {
            $(this).addClass("isCorrect");
        }
        else {
            $(this).removeClass("isCorrect");
        }
        if(canEnable(input)) {
            $("input[type=submit]").attr("disabled", false);
        } else {
            $("input[type=submit]").attr("disabled", true);
        }
    });
    
});