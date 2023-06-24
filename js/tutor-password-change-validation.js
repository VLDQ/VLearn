/*--------------------------------------------------------------
  Function which is called on onsubmit in password change form
--------------------------------------------------------------*/
function validatePasswordChange() {
    var newPassword = document.passwordChangeForm.newPassword; //stores new password retrieved from password change form
    var confirmPassword = document.passwordChangeForm.confirmPassword; //stores confirm password retrieved from password change form

    //calls all other functions used for validation
    if(validateNewPassword(newPassword) && validateConfirmPassword(newPassword, confirmPassword)) {
        return true; //returns true if all of the validation functions return true (form will be submitted)
    }
    else {
        return false; //returns false if at least one of the validation functions return false (form will not be submitted)
    }
}

/*-----------------------------------
  Function to validate new password
-----------------------------------*/
function validateNewPassword(newPassword) {
    var number = newPassword.value.match(/[0-9]/); //at least one number
    var uppercase = newPassword.value.match(/[A-Z]/); //at least one uppercase letter
    var lowercase = newPassword.value.match(/[a-z]/); //at least one lowercase letter
    var specialChar = newPassword.value.match(/[^\w]/); //at least one special character
    var passwordLength = newPassword.value.length; //stores the password length to be validated

    if(!number || !uppercase || !lowercase || !specialChar || passwordLength<8) {
        alert("Password must contain at least one number, one uppercase letter, one lowercase letter, one special character, and at least 8 or more characters!"); //displays message via alert box
        newPassword.focus(); //puts focus on the input field for new password
        return false; //returns false if the new password does not match the conditions
    }
    else {
        return true; //returns true if the new password matches the conditions
    }
}

/*---------------------------------------
  Function to validate confirm password
---------------------------------------*/
function validateConfirmPassword(newPassword, confirmPassword) {
    if(newPassword.value != confirmPassword.value) {
        alert("Passwords do not match!"); //displays message via alert box
        confirmPassword.focus(); //puts focus on the input field for confirm password
        return false; //returns false if the confirm password does not match the new password
    }
    else {
        return true; //returns true if the confirm password matches the new password
    }
}

/*-----------------------------------
  Function to show current password
-----------------------------------*/
function showCurrentPassword() {
    var x = document.getElementById("currentPassword"); //stores the id of input field for current password

    if(x.type === "password") {
        x.type = "text"; //sets the input type as text
    }
    else {
        x.type = "password"; //sets the input type as password
    }
}

/*-------------------------------
  Function to show new password
-------------------------------*/
function showNewPassword() {
    var x = document.getElementById("newPassword"); //stores the id of input field for new password

    if(x.type === "password") {
        x.type = "text"; //sets the input type as text
    }
    else {
        x.type = "password"; //sets the input type as password
    }
}

/*-----------------------------------
  Function to show confirm password
-----------------------------------*/
function showConfirmPassword() {
    var x = document.getElementById("confirmPassword"); //stores the id of input field for confirm password

    if(x.type === "password") {
        x.type = "text"; //sets the input type as text
    }
    else {
        x.type = "password"; //sets the input type as password
    }
}
