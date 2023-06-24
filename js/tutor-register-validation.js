/*-----------------------------------------------------------
  Function which is called on onsubmit in registration form
-----------------------------------------------------------*/
function validateRegistration() {
    var tutorName = document.registrationForm.tutorName; //stores tutor name retrieved from registration form
    var tutorPassword = document.registrationForm.tutorPassword; //stores tutor password retrieved from registration form
    var tutorConfirmPassword = document.registrationForm.tutorConfirmPassword; //stores tutor confirm password retrieved from registration form

    //calls all other functions used for validation
    if(validateTutorName(tutorName) && validateTutorPassword(tutorPassword) && validateTutorConfirmPassword(tutorPassword, tutorConfirmPassword)) {
        return true; //returns true if all of the validation functions return true (form will be submitted)
    }
    else {
        return false; //returns false if at least one of the validation functions return false (form will not be submitted)
    }
}

/*---------------------------------
  Function to validate tutor name
---------------------------------*/
function validateTutorName(tutorName) {
    var condition = /^[a-zA-Z ]*$/; //stores the condition (alphabets and whitespace only)

    if(tutorName.value.match(condition)) {
        return true; //returns true if the tutor name matches the condition
    }
    else {
        alert("Only alphabets and whitespace are allowed for Name!"); //displays message via alert box
        tutorName.focus(); //puts focus on the input field for tutor name
        return false; //returns false if the tutor name does not match the condition
    }
}

/*-------------------------------------
  Function to validate tutor password
-------------------------------------*/
function validateTutorPassword(tutorPassword) {
    var number = tutorPassword.value.match(/[0-9]/); //at least one number
    var uppercase = tutorPassword.value.match(/[A-Z]/); //at least one uppercase letter
    var lowercase = tutorPassword.value.match(/[a-z]/); //at least one lowercase letter
    var specialChar = tutorPassword.value.match(/[^\w]/); //at least one special character
    var passwordLength = tutorPassword.value.length; //stores the password length to be validated
  
    if(!number || !uppercase || !lowercase || !specialChar || passwordLength<8) {
        alert("Password must contain at least one number, one uppercase letter, one lowercase letter, one special character, and at least 8 or more characters!"); //displays message via alert box
        tutorPassword.focus(); //puts focus on the input field for tutor password
        return false; //returns false if the tutor password does not match the conditions
    }
    else {
        return true; //returns true if the tutor password matches the conditions
    }
}

/*---------------------------------------------
  Function to validate tutor confirm password
---------------------------------------------*/
function validateTutorConfirmPassword(tutorPassword, tutorConfirmPassword) {
    if(tutorPassword.value != tutorConfirmPassword.value) {
        alert("Passwords do not match!"); //displays message via alert box
        tutorConfirmPassword.focus(); //puts focus on the input field for tutor confirm password
        return false; //returns false if the tutor confirm password does not match the tutor password
    }
    else {
        return true; //returns true if the tutor confirm password matches the tutor password
    }
}

/*---------------------------------
  Function to show tutor password
---------------------------------*/
function showTutorPassword() {
    var x = document.getElementById("tutorPassword"); //stores the id of input field for tutor password

    if(x.type === "password") {
        x.type = "text"; //sets the input type as text
    }
    else {
        x.type = "password"; //sets the input type as password
    }
}

/*-----------------------------------------
  Function to show tutor confirm password
-----------------------------------------*/
function showTutorConfirmPassword() {
    var x = document.getElementById("tutorConfirmPassword"); //stores the id of input field for tutor confirm password

    if(x.type === "password") {
        x.type = "text"; //sets the input type as text
    }
    else {
        x.type = "password"; //sets the input type as password
    }
}
