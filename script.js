// Define global variables for input elements
let emailInput, usernameInput, passwordInput, confirmPasswordInput, termInput, emailError, usernameError, passwordError, confirmPasswordError;
let defaultMsg = "";
let emailErrorMsg = "X Email address should be non-empty with the format xyz@xyz.xyz.";
let usernameErrorMsg = "X User name should not be empty and less than 30 characters.";
let passwordErrorMsg = "X Password should be at least 8 characters long.";
let confirmPasswordErrorMsg = "X Passwords do not match.";
let termsErrorMsg = "X Please accept the terms and conditions.";

// Initialize error messages and event listeners once the DOM is fully loaded
document.addEventListener("DOMContentLoaded", function() {
    // Selecting elements for inputs and checkboxes
    emailInput = document.querySelector("#email");
    usernameInput = document.querySelector("#login");
    passwordInput = document.querySelector("#pass");
    confirmPasswordInput = document.querySelector("#pass2");
    termInput = document.querySelector("#terms");
    
    // Initialize and append error message elements for each field
        emailError = document.createElement('p'); // Create a paragraph element for error display
        emailError.setAttribute("class", "warning");// Give it a class for styling
        // Find the first element in the document with the class "textfield" 
        // Append the newly created <p> element (emailError) as a child to this "textfield" element.
        document.querySelectorAll(".textfield")[0].append(emailError); 
    
        usernameError = document.createElement('p');
        usernameError.setAttribute("class", "warning");
        document.querySelectorAll(".textfield")[1].append(usernameError);

        passwordError = document.createElement('p');
        passwordError.setAttribute("class", "warning");
        document.querySelectorAll(".textfield")[2].append(passwordError);

        confirmPasswordError = document.createElement('p');
        confirmPasswordError.setAttribute("class", "warning");
        document.querySelectorAll(".textfield")[3].append(confirmPasswordError);

        termError = document.createElement('p');
        termError.setAttribute("id", "termError");
        document.querySelector(".checkbox").append(termError);

    // Inline validation for email on blur
    emailInput.addEventListener("blur", function() { //sets up an event listener that listens for the blur event on the emailInput element when user click away/tab out of the field
        let validationMessage = validateEmail(); //assign the result of validate email function to validate message
        emailError.textContent = validationMessage; // message it assigned to textcontent of emailError element(error or default msg), to show the nessage below the email input field
        emailInput.classList.toggle("error-input", validationMessage !== defaultMsg); //checks the conditions, if true add the class error-input for css styling on email input field, if false removes the class)
    });

    // Inline validation for username on blur
    usernameInput.addEventListener("blur", function() {
        let validationMessage = validateUsername();
        usernameError.textContent = validationMessage;
        usernameInput.classList.toggle("error-input", validationMessage !== defaultMsg);
    });

    // Inline validation for password on blur
    passwordInput.addEventListener("blur", function() {
        let validationMessage = validatePassword();
        passwordError.textContent = validationMessage;
        passwordInput.classList.toggle("error-input", validationMessage !== defaultMsg);
    });

    // Inline validation for confirm password on blur
    confirmPasswordInput.addEventListener("blur", function() {
        let validationMessage = validateConfirmPassword();
        confirmPasswordError.textContent = validationMessage;
        confirmPasswordInput.classList.toggle("error-input", validationMessage !== defaultMsg);
    });

    // Inline validation for terms on change
    termInput.addEventListener("change", function() {//The change event fires whenever the user checks or unchecks the box.
        let termsValidation = validateTerms();
        termError.textContent = termsValidation;
    });

    // Event listener for form submission
    const form = document.querySelector("form");
    if (form) {
        form.addEventListener("submit", function(event) {
            if (!validate()) { // Call a validation function before submitting
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });

        // Clear error messages on form reset
        form.addEventListener("reset", function() { //. When the reset button is clicked, this function runs to clear error messages and reset input field styles.
            emailError.textContent = defaultMsg;
            usernameError.textContent = defaultMsg;
            passwordError.textContent = defaultMsg;
            confirmPasswordError.textContent = defaultMsg;
            termError.textContent = defaultMsg;
            emailInput.classList.remove("error-input");
            usernameInput.classList.remove("error-input");
            passwordInput.classList.remove("error-input");
            confirmPasswordInput.classList.remove("error-input");
        });
    }
});

// Function to validate email format
function validateEmail() {
    let email = emailInput.value;
    let emailRegex = /[a-zA-Z]+@[a-zA-Z]+\.[a-zA-Z]{2,}$/;
    return emailRegex.test(email) ? defaultMsg : emailErrorMsg;
}

// Function to validate username
function validateUsername() {
    let username = usernameInput.value;
    return username.trim() !== "" && username.length < 30 ? defaultMsg : usernameErrorMsg;
}

// Function to validate password
function validatePassword() {
    let password = passwordInput.value;
    return password.length >= 8 ? defaultMsg : passwordErrorMsg;
}

// Function to validate confirm password
function validateConfirmPassword() {
    let password = passwordInput.value;
    let confirmPassword = confirmPasswordInput.value;
    return password === confirmPassword ? defaultMsg : confirmPasswordErrorMsg;
}

// Function to validate terms checkbox
function validateTerms() {
    return termInput.checked ? defaultMsg : termsErrorMsg;
}

// Main validate function for form submission: executed when the form is submitted.
function validate() {
    console.log("inside validate func");
    let valid = true;

    // Email validation
    let emailValidation = validateEmail();
    if (emailValidation !== defaultMsg) {
        emailError.textContent = emailValidation;
        emailInput.classList.add("error-input");
        valid = false;
    } else {
        emailInput.classList.remove("error-input");
    }

    // Username validation
    let usernameValidation = validateUsername();
    if (usernameValidation !== defaultMsg) {
        usernameError.textContent = usernameValidation;
        usernameInput.classList.add("error-input");
        valid = false;
    } else {
        usernameInput.classList.remove("error-input");
    }

    // Password validation
    let passwordValidation = validatePassword();
    if (passwordValidation !== defaultMsg) {
        passwordError.textContent = passwordValidation;
        passwordInput.classList.add("error-input");
        valid = false;
    } else {
        passwordInput.classList.remove("error-input");
    }

    // Confirm Password validation
    let confirmPasswordValidation = validateConfirmPassword();
    if (confirmPasswordValidation !== defaultMsg) {
        confirmPasswordError.textContent = confirmPasswordValidation;
        confirmPasswordInput.classList.add("error-input");
        valid = false;
    } else {
        confirmPasswordInput.classList.remove("error-input");
    }

    // Terms validation
    let termsValidation = validateTerms();
    if (termsValidation !== defaultMsg) {
        termError.textContent = termsValidation;
        valid = false;
    }

    usernameInput.value = usernameInput.value.toLowerCase();

    return valid; // Prevent form submission if not valid
}
