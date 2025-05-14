const email = document.getElementById("email")
const password = document.getElementById("password")
const form = document.getElementById("login-form")
const errorElement = document.getElementById("error")

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
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();

    let valid = true;

    if(emailValue === ""){
        setError(email, "Email is required");
        valid = false;
    } else if (!isValidEmail(emailValue)) {
        setError(email, "Provide a valid email address");
        valid = false;
    } else {
        setSuccess(email);
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

    if (valid) {
        alert("Login successful!");
        form.submit();
    }
}