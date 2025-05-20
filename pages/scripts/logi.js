// Field variables
const email = document.getElementById("email")
const password = document.getElementById("password")
const form = document.getElementById("login-form")
const errorElement = document.getElementById("error")

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
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();

    let valid = true;

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


    // Password Validation
    if (passwordValue === "") {
        setError(password, "Password required");
        valid = false;
    } else if (passwordValue.length < 6) {
        setError(password, "Password must be at least 6 characters");
        valid = false;
    } else {
        setSuccess(password);
    }


    // Form Submission
    if (valid) {
        form.submit();
    }
}