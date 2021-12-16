const pattern = /^(?:[0-9]+[a-z]|[a-z]+[0-9])[a-z0-9]*$/i;
$(document).ready(function(){
    const password = $("#password");
    password.keyup(function (e) { 
        if(password.val()==undefined || password.val().length < 8 || !pattern.test(password.val())) {
           if(!password.next().is("#error"))
             {
                password.parent().append("<p id='error'>La password deve essere almeno 8 caratteri e deve contenere almeno una lettera ed un numero</p>");
             }
        }
        else {
            password.next().remove();
        }
    });
});