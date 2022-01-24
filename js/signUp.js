const pattern = /^(?:[0-9]+[a-z]|[a-z]+[0-9])[a-z0-9]*$/i;
const emailPattern = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
function passwordCheck(password) {
    if(password.val()===undefined || password.val().length < 8 || !pattern.test(password.val())) {
        if(getError(password).val() === undefined)
          {
              password.addClass("isError");
              password.parent().append("<p id='error'>Password non valida. La password deve contenere almeno 8 caratteri e 1 numero</p>");
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
    else {
        if(isValuePresent(element)) {
            element.removeClass("isError");
            getError(element).remove();
            element.addClass("isCorrect");
        }
    }
}
function emailCheck(email) {
    if(email.val() === undefined || !emailPattern.test(email.val())) {
        if(getError(email).val() === undefined) {
            email.addClass("isError");
            email.parent().append("<p id='error'>Inserire un email valida</p>");
        }
    }
    else {
        email.removeClass("isError");
        getError(email).remove();
    }
}
function isValuePresent(element) {
    if(element.val().length > 0) {
        return true;
    }
    return false;
}
function getError(element) {
    return element.next("p#error");
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
$(document).ready(function(e){
    e.preventDefault();
    var input = $("main form input");
    input.focus(function(){
        $(this).prev().addClass("moved");
    });
    if(input.is("#data")) {
        input.change(function() {
            if ($(this).is("#data") && isValuePresent($(this))){
                canEnable($(this));
                $(this).addClass("isCorrect");
            }
            else if($(this).is("#data")) {
                $(this).removeClass("isCorrect");
            }
            if(canEnable(input)) {
                $("input[type=submit]").attr("disabled", false);
            } else {
                $("input[type=submit]").attr("disabled", true);
            }
        });
    }
    input.focusout(function(){
        if(!$(this).is("#data") && !isValuePresent($(this))) {
            $(this).prev().removeClass("moved");
        }
    });
    input.keyup(function(e) {
        if($(this).is("#password")) {
            passwordCheck($(this));
            passwordConfirmCheck($("#confirm"));
        } else if($(this).is("#confirm")) {
            passwordConfirmCheck($(this));
        } else if($(this).is("#email")) {
            emailCheck($(this));
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