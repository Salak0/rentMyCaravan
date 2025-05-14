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

form.addEventListener("submit", (e) => {
    e.preventDefault();

    validateInput();
});

const setError = (element, message) => {
    const form_group = element.parentElement;
    const errorDisplay = form_group.querySelector(".error");

    errorDisplay.innerText = message;
    form_group.classList.add("error");
    form_group.classList.remove("success");
}

const setSuccess = element => {
    const form_group = element.parentElement;
    const errorDisplay = form_group.querySelector(".error");

    errorDisplay.innerText = "";
    form_group.classList.add("success");
    form_group.classList.remove("error")
}

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

    if(firstNameValue === ""){
        setError(firstName, "First name required");
        valid = false;
    } else {
        setSuccess(firstName);
    }

    if(lastNameValue === ""){
        setError(lastName, "Last name required");
        valid = false;
    } else {
        setSuccess(lastName);
    }


    if(emailValue === ""){
        setError(email, "Email is required");
        valid = false;
    } else if (!isValidEmail(emailValue)) {
        setError(email, "Provide a valid email address");
        valid = false;
    } else {
        setSuccess(email);
    }

    if (postcodeValue === "") {
        setError(postcode, "Postcode required");
        valid = false;
    } else if (!/^[A-Za-z]{2}[A-Za-z0-9]{0,5}$/.test(postcodeValue)) {
        setError(postcode, "Postcode must be only alphanumeric");
        valid = false;
    } else {
        setSuccess(postcode);
    }

    if (addressValue === "") {
        setError(address, "Address required");
        valid = false;
    } else {
        setSuccess(address);
    }


    if (passwordValue === "") {
        setError(password, "Password required");
        valid = false;
    } else if (passwordValue.length < 6) {
        setError(password, "Password must be at least 6 characters");
        valid = false;
    } else {
        setSuccess(password);
    }

    if (repeatPasswordValue === "") {
        setError(repeatPassword, "Repeat your password");
        valid = false;
    } else if (repeatPasswordValue !== passwordValue) {
        setError(repeatPassword, "Passwords do not match");
        valid = false;
    } else {
        setSuccess(repeatPassword);
    }

    if (!termsCheckboxTicked) {
        setError(termsCheckbox, "You must agree to the terms");
        valid = false;
    } else {
        setSuccess(termsCheckbox);
    }

    if (valid) {
        alert("Registration successful!");
        form.submit();
    }
}