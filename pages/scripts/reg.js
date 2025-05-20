// Field Variables
const form = document.getElementById("registration-form")
const firstName = document.getElementById("firstName")
const lastName = document.getElementById("lastName")
const email = document.getElementById("email")
const postcode = document.getElementById("postcode")
const address = document.getElementById("address")
const password = document.getElementById("password")
const repeatPassword = document.getElementById("repeatPassword")
const termsCheckbox = document.getElementById("termsConditions")
const error = document.getElementById("error")

// Prevent default submission to validate each field
form.addEventListener("submit", (e) => {
    e.preventDefault();

    validateInput();
});

// Error variable for error indication + message
const setError = (element, message) => {
    const form_group = element.parentElement;
    const errorDisplay = form_group.querySelector(".error");

    errorDisplay.innerText = message;
    form_group.classList.add("error");
    form_group.classList.remove("success");
}

// Success variable for success indication
const setSuccess = element => {
    const form_group = element.parentElement;
    const errorDisplay = form_group.querySelector(".error");

    errorDisplay.innerText = "";
    form_group.classList.add("success");
    form_group.classList.remove("error")
}

// Email validation variable
const isValidEmail = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}


const validateInput = () => {
    const firstNameValue = firstName.value.trim();
    const lastNameValue = lastName.value.trim();
    const emailValue = email.value.trim();
    const postcodeValue = postcode.value.trim();
    const addressValue = address.value.trim();
    const passwordValue = password.value.trim();
    const repeatPasswordValue = repeatPassword.value.trim();
    const termsCheckboxTicked = termsCheckbox.checked;

    let valid = true;

    // First name validation
    if(firstNameValue === ""){
        setError(firstName, "First name required");
        valid = false;
    } else {
        setSuccess(firstName);
    }
    
    // Last name validation
    if(lastNameValue === ""){
        setError(lastName, "Last name required");
        valid = false;
    } else {
        setSuccess(lastName);
    }

    // Email validation
    if(emailValue === ""){
        setError(email, "Email is required");
        valid = false;
    } else if (!isValidEmail(emailValue)) {
        setError(email, "Provide a valid email address");
        valid = false;
    } else {
        setSuccess(email);
    }

    // Postcode validation
    if (postcodeValue === "") {
        setError(postcode, "Postcode required");
        valid = false;
    } else if (!/^[A-Za-z]{2}[A-Za-z0-9]{0,5}$/.test(postcodeValue)) {
        setError(postcode, "Postcode must be only alphanumeric");
        valid = false;
    } else {
        setSuccess(postcode);
    }
    
    // Address validation
    if (addressValue === "") {
        setError(address, "Address required");
        valid = false;
    } else {
        setSuccess(address);
    }

    // Password validation
    if (passwordValue === "") {
        setError(password, "Password required");
        valid = false;
    } else if (passwordValue.length < 6) { // Password length validation
        setError(password, "Password must be at least 6 characters");
        valid = false;
    } else {
        setSuccess(password);
    }

    // Password repeat validation
    if (repeatPasswordValue === "") {
        setError(repeatPassword, "Repeat your password");
        valid = false;
    } else if (repeatPasswordValue !== passwordValue) {
        setError(repeatPassword, "Passwords do not match");
        valid = false;
    } else {
        setSuccess(repeatPassword);
    }
    
    // Terms and service checkbox validation
    if (!termsCheckboxTicked) {
        setError(termsCheckbox, "You must agree to the terms");
        valid = false;
    } else {
        setSuccess(termsCheckbox);
    }

    // Form submission
    if (valid) {
        form.submit();
    }
}