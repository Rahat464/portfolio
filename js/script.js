// Prevent user from submitting empty form
function preventDefault() {
    var title = document.getElementById("title");
    var body = document.getElementById("body");
    
    if (title.value == "") {
        alert("Please enter a title");
        title.style.border = "5px solid red";
    }

    if (body.value == "") {
        alert("Please enter a body");
        body.style.border = "5px solid red";
    }
}

// Validate passwords
function validatePassword() {
    var password = document.getElementById("password");
    var confirmPassword = document.getElementById("confirmPassword");

    // Check if password is at least 8 characters long
    if (password.value.length < 8) {    
        alert("Password must be at least 8 characters long");
        password.style.border = "5px solid red";
        confirmPassword.style.border = "5px solid red";
        return false;

    } else if (password.value != confirmPassword.value) { // Check if passwords match
        alert("Passwords do not match");
        password.style.border = "5px solid red";
        confirmPassword.style.border = "5px solid red";
        return false;
    }

    return true;
}