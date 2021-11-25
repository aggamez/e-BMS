function checkPassword(){
    var x = document.getElementById("pass");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function checkPasswordRe(){
    var y = document.getElementById("repass");
    if (y.type === "password") {
        y.type = "text";
    } else {
        y.type = "password";
    }
}

function loginAccount(){
    var sNumb = document.getElementById("studNumber");
    var cpass = document.getElementById("pass");

    if(checkNum()){
    }else{
        sNumb.focus();
        return false;
    }
    if(checkPassW()){
    }else{
        cpass.focus();
        return false;
    }
}

function checkNum(){
    var sNumb = document.forms["loginForm"]["studNumber"];
    var regEx = /^[0-9]+$/;
    if(sNumb.value == ""){
        window.alert("Please enter your student number.");
        sNumb.focus();
        return false;
    } else if(regEx.test(sNumb.value)){
        if(sNumb.value.length == 11){
                return true;
        }else{
            window.alert("Invalid student number length.");
            return false;
        }
    } else{
        window.alert("Invalid characters in your student number.");
        sNumb.focus();
        return false;
    }
}

function checkPassW(){
    var pass = document.forms["loginForm"]["pass"];
    if(pass.value == ""){
        window.alert("Please enter your password.");
        pass.focus();
        return false;
    }else{
        return true;
    }
}


function validateCredentials(){
    var sNumb = document.getElementById("studNumber");
    var cpass = document.getElementById("pass");
    var rpass = document.getElementById("repass");

    if(checkNumber()){
    }else{
        sNumb.focus();
        return false;
    }
    if(checkPass()){
    }else{
        cpass.focus();
        return false;
    }
    if(checkRePass()){
    }else{
        rpass.focus();
        return false;
    }
    if(cpass.value === rpass.value){
        return true;
    }else{
        window.alert("Password mismatch!")
        rpass.focus();
        return false;
    }
}

function checkNumber(){
    var sNumb = document.forms["passForm"]["studNumber"];
    var regEx = /^[0-9]+$/;
    if(sNumb.value == ""){
        window.alert("Please enter your student number.");
        sNumb.focus();
        return false;
    } else if(regEx.test(sNumb.value)){
        if(sNumb.value.length == 11){
                return true;
        }else{
            window.alert("Invalid student number length.");
            return false;
        }
    } else{
        window.alert("Invalid characters in your student number.");
        sNumb.focus();
        return false;
    }
}

function checkPass(){
    var pass = document.forms["passForm"]["pass"];
    if(pass.value == ""){
        window.alert("Please enter your password.");
        pass.focus();
        return false;
    }else{
        return true;
    }
}

function checkRePass(){
    var repass = document.forms["passForm"]["repass"];
    if(repass.value == ""){
        window.alert("Please enter your password again.");
        repass.focus();
        return false;
    }else{
        return true;
    }   
}


function registerAccount(){  
    var fName = document.getElementById("firstName");
    var lName = document.getElementById("lastName");
    var sNumb = document.getElementById("studNumber");
    var yrLvl = document.getElementById("yearLevel");
    var progm = document.getElementById("program");
    var email = document.getElementById("email");
    var cntct = document.getElementById("contact");
    var sex = document.getElementById("sex");
    var date = document.getElementById("datemax");

    if(checkRead()){
    }else{
        return false;
    }
    if(checkFirst()){
    }else{
        fName.focus();
        return false;
    }
    if(checkLast()){
    }else{
        lName.focus();
        return false;
    }
    if(checkNumb()){
    }else{
        sNumb.focus();
        return false;
    }
    if(checkYear()){
    }else{
        yrLvl.focus();
        return false;
    }
    if(checkProgram()){
    }else{
        progm.focus();
        return false;
    }
    if(checkEmail()){
    }else{
        email.focus();
        return false;
    }
    if(checkContact()){
    }else{
        cntct.focus();
        return false;
    }
    if(checkSex()){
    }else{
        sex.focus();
        return false;
    }
    if(checkDate()){
    }else{
        date.focus();
        return false;
    }
    
}

function checkRead(){
    var temp = document.forms["regForm"]["t"];
    if(temp.checked){
        return true;
    }else{
        window.alert("Please read the Terms and Conditions.");
        return false;
    }
}

function checkLast(){
    var lName = document.forms["regForm"]["lastName"];
    var regEx = /^[a-zA-Z\s]/;
    if(lName.value == ""){
        window.alert("Please enter your last name.");
        return false;
    } else if(regEx.test(lName.value)){
        return true;
    } else{
        window.alert("Invalid characters in name.");
        return false;
    }
}

function checkFirst(){
    var fName = document.forms["regForm"]["firstName"];
    var regEx = /^[a-zA-Z\s]/;
    if(fName.value == ""){
        window.alert("Please enter your first name.");
        return false;
    } else if(regEx.test(fName.value)){
        return true;
    } else{
        window.alert("Invalid characters in name.");
        return false;
    }
}

function checkNumb(){
    var sNumb = document.forms["regForm"]["studNumber"];
    var regEx = /^[0-9]+$/;
    if(sNumb.value == ""){
        window.alert("Please enter your student number.");
        sNumb.focus();
        return false;
    } else if(regEx.test(sNumb.value)){
        if(sNumb.value.length == 11){
                return true;
        }else{
            window.alert("Invalid student number length.");
            return false;
        }
    } else{
        window.alert("Invalid characters in your student number.");
        sNumb.focus();
        return false;
    }
}

function checkContact(){
    var contact = document.forms["regForm"]["contact"];
    var regEx = /^[0-9]+$/;
    if(contact.value === ""){
        window.alert("Please enter your contact number.");
        return false;
    } else if(regEx.test(contact.value)){
        if(contact.value.length == 11){
            if(contact.value.startsWith("09")){
                return true;
            }else{
                window.alert("Invalid number. (Starts with 09)");
            return false;
            }
        }else{
            window.alert("Invalid contact number length.");
            return false;
        }
    } else{
        window.alert("Invalid characters in your contact number.");
        return false;
    }
}

function checkYear(){
    var yrLvl = document.forms["regForm"]["yearLevel"];
    if(yrLvl.value === "0"){
        window.alert("Please enter your year level.");
        return false;
    }else{
        return true;
    }
}

function checkProgram(){
    var program = document.forms["regForm"]["program"];
    if(program.value === "0"){
        window.alert("Please enter your programme.");
        return false;
    }else{
        return true;
    }
}

function checkSex(){
    var sex = document.forms["regForm"]["sex"];
    if(sex.value === "0"){
        window.alert("Please enter your sex.");
        return false;
    }else{
        return true;
    }
}

function checkDate(){
    var date = document.forms["regForm"]["datemax"];
    if(date.value === ""){
        window.alert("Please enter your birthdate.");
        return false;
    }else{
        return true;
    }
}

function checkEmail(){
    var email = document.forms["regForm"]["email"];
    var parts = email.value.split('@');

    if(email.value == ""){
        window.alert("Please enter your e-mail.");
        return false;
    } else if(parts.length === 2){
        if (parts[1] === "ue.edu.ph") {
            return true;
        }else{
            window.alert("Invalid domain. (use @ue.edu.ph)");
            return false;
        }
    } else{
        window.alert("E-mail error.");
        return false;
    }
}
