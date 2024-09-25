
function myFun(){
    
    var Name_correct_way = /^[A-Z a-z]+$/;
    var Name = document.getElementById("name").value;

    var Email = document.getElementById("email").value;

    var Mobile_correct_way = /^[0-9]+$/;
    var Mobile = document.getElementById("mobile").value;

    var Password = document.getElementById("password").value;
    var Password_correct_way = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;



  // for name validation
    if(Name=="" || Name.length<3){
        document.getElementById("name_id").innerHTML = "*Length must be greater then 3";
        return false;
    }
    if(Name.match(Name_correct_way)){
        true;
    }
    else{
        document.getElementById("name_id").innerHTML = "*No-special characters are allowed";
        return false;
    }


    // for email validation
    if(Email==""){
        document.getElementById("email_id").innerHTML = "*Email is blank";
        return false;
    }
    if(Email.indexOf('@')<=0){
        document.getElementById("email_id").innerHTML = "*Invalid @ position";
        return false;
    }
    if((Email.charAt(Email.length-4)!='.') && (Email.charAt(Email.length-3)!='.')){
        document.getElementById("email_id").innerHTML = "*Invalid . position";
        return false;
    }


     // for email validation
     if(Mobile=="" || Mobile.length<10){
        document.getElementById("mobile_id").innerHTML = "*Contact number must be equal to 10 digits";
        return false;
    }
    if(Mobile.match(Mobile_correct_way)){
        true;
    }
    else{
        document.getElementById("mobile_id").innerHTML = "*Only numbers are allowed";
        return false;
    }

    // for password validation
    if(Password=="" || Mobile.length<6){
        document.getElementById("password_id").innerHTML = "*Password length must be greater then 6";
        return false;
    }
    if (!Password.match(Password_correct_way)) {
        document.getElementById("password_id").innerHTML = "*Password must contain at least one lowercase, one uppercase, one number, and one special character, with total 6 characters";
        return false;
    }
}