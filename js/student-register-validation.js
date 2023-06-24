/*-----------------------------------------------------------
  Function which is called on onsubmit in registration form
-----------------------------------------------------------*/
function validateRegistration() {
    var studentName = document.registrationForm.studentName; //stores student name retrieved from registration form
    var studentPassword = document.registrationForm.studentPassword; //stores student password retrieved from registration form
    var studentConfirmPassword = document.registrationForm.studentConfirmPassword; //stores student confirm password retrieved from registration form

    //calls all other functions used for validation
    if(validateStudentName(studentName) && validateStudentPassword(studentPassword) && validateStudentConfirmPassword(studentPassword, studentConfirmPassword) && handleCheckboxData()) {
        return true; //returns true if all of the validation functions return true (form will be submitted)
    }
    else {
        return false; //returns false if at least one of the validation functions return false (form will not be submitted)
    }
}

/*-----------------------------------
  Function to validate student name
-----------------------------------*/
function validateStudentName(studentName) {
    var condition = /^[a-zA-Z ]*$/; //stores the condition (alphabets and whitespace only)

    if(studentName.value.match(condition)) {
        return true; //returns true if the student name matches the condition
    }
    else {
        alert("Only alphabets and whitespace are allowed for Name!"); //displays message via alert box
        studentName.focus(); //puts focus on the input field for student name
        return false; //returns false if the student name does not match the condition
    }
}

/*---------------------------------------
  Function to validate student password
---------------------------------------*/
function validateStudentPassword(studentPassword) {
    var number = studentPassword.value.match(/[0-9]/); //at least one number
    var uppercase = studentPassword.value.match(/[A-Z]/); //at least one uppercase letter
    var lowercase = studentPassword.value.match(/[a-z]/); //at least one lowercase letter
    var specialChar = studentPassword.value.match(/[^\w]/); //at least one special character
    var passwordLength = studentPassword.value.length; //stores the password length to be validated
  
    if(!number || !uppercase || !lowercase || !specialChar || passwordLength<8) {
        alert("Password must contain at least one number, one uppercase letter, one lowercase letter, one special character, and at least 8 or more characters!"); //displays message via alert box
        studentPassword.focus(); //puts focus on the input field for student password
        return false; //returns false if the student password does not match the conditions
    }
    else {
        return true; //returns true if the student password matches the conditions
    }
}

/*-----------------------------------------------
  Function to validate student confirm password
-----------------------------------------------*/
function validateStudentConfirmPassword(studentPassword, studentConfirmPassword) {
    if(studentPassword.value != studentConfirmPassword.value) {
        alert("Passwords do not match!"); //displays message via alert box
        studentConfirmPassword.focus(); //puts focus on the input field for student confirm password
        return false; //returns false if the student confirm password does not match the student password
    }
    else {
        return true; //returns true if the student confirm password matches the student password
    }
}

/*-----------------------------------
  Function to show student password
-----------------------------------*/
function showStudentPassword() {
    var x = document.getElementById("studentPassword"); //stores the id of input field for student password
    
    if(x.type === "password") {
        x.type = "text"; //sets the input type as text
    }
    else {
        x.type = "password"; //sets the input type as password
    }
}

/*-------------------------------------------
  Function to show student confirm password
-------------------------------------------*/
function showStudentConfirmPassword() {
    var x = document.getElementById("studentConfirmPassword"); //stores the id of input field for student confirm password
  
    if(x.type === "password") {
        x.type = "text"; //sets the input type as text
    }
    else {
        x.type = "password"; //sets the input type as password
    }
}

/*---------------------------------------------------------------
  Function to validate at least one checkbox option is selected
---------------------------------------------------------------*/
function handleCheckboxData() {
    var formData = new FormData(document.querySelector("form")); //stores the form data from the form element
    
    if(!formData.has("studentSubjects[]")) {
        alert("Please select at least one option for Subject(s)."); //displays message via alert box
        return false; //returns false if none of the checkbox options are selected
    }
    else {
        return true; //returns true if at least one checkbox option is selected
    }
}
