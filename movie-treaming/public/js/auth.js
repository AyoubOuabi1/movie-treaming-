//start check input section
let checkName,checkEmail1,checkPassword1,checkConfirmPassword;
function checkFullName(){
    if(checkNumber($('#name').val())){
        $('#name').addClass('border border-danger')
        $('#nameLabel').removeClass('d-none');
        $('#nameLabel').html('Name must contain only characters')
        checkName=false;
        enableRegisterBtn();
    }else {
        $('#nameLabel').addClass('d-none');
        $('#name').removeClass('border border-danger')

        checkName=true;
        enableRegisterBtn();

    }
}


function checkEmail(){
    if(!checkEmailValidation($('#email').val())){
        $('#email').addClass('border border-danger')
        $('#emailLabel').removeClass('d-none');
        $('#emailLabel').html('please entre valide Email')
        checkEmail1=false;
        enableRegisterBtn();
    }else {
        $('#emailLabel').addClass('d-none');
        $('#email').removeClass('border border-danger')
        checkEmail1=true;
        enableRegisterBtn();
    }
}
function checkPassword(){
    if(!checkPasswordValidation($('#password').val())){
        $('#password').addClass('border border-danger')
        $('#passwordLabel').removeClass('d-none');
        $('#passwordLabel').html('your password must longer than 6 and  has at least one special character and one number ')
        checkPassword1=false;
        enableRegisterBtn();
    }else {
        $('#passwordLabel').addClass('d-none');
        $('#password').removeClass('border border-danger')
        checkPassword1=true;
        enableRegisterBtn();
    }
}
function checkConfirmPasswordF(){
    if($("#password").val()!==$("#ConfirmPassword").val()) {
        $('#ConfirmPassword').addClass('border border-danger')
        $('#ConfirmPasswordLabel').removeClass('d-none');
        $('#ConfirmPasswordLabel').html('password does not match')
        checkConfirmPassword=false;
        enableRegisterBtn();

    }else {
        $('#ConfirmPasswordLabel').addClass('d-none');
        $('#ConfirmPassword').removeClass('border border-danger')
        checkConfirmPassword=true;
        enableRegisterBtn();
    }

}

//end check input section
function  enableRegisterBtn(){
    if(checkName===true  && checkEmail1===true && checkPassword1===true && checkConfirmPassword===true){
        $('#registerBtn').removeAttr('disabled');
        $('#registerBtn').removeClass('disabled');
    }else {
        $('#registerBtn').addClass('disabled');
        $('#registerBtn').attr('disabled','disabled');
    }
}
//start regex section
function checkNumber(s) {
    let rgx=/\d/
    return rgx.test(s);
}
function checkPasswordValidation(s){
    let rgx = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/
    return rgx.test(s)

}
function checkEmailValidation(s){
    let rgx = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,9}\b$/i
    return rgx.test(s)

}
//end verefication regex section
