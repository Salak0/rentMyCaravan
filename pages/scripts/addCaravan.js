let currentStep = 0;
const steps = document.querySelectorAll(".step");
const numbers = document.querySelectorAll(".pagination .number");

function showStep(index) {
  steps.forEach((step, i) => {
    step.classList.toggle("active", i === index);
    if (numbers[i]) numbers[i].classList.toggle("active", i <= index);
  });
}

// Validation helpers (assumes .error div already exists in HTML)
const setError = (element, message) => {
  const formGroup = element.closest(".form-group") || element.parentElement;
  const errorDisplay = formGroup.querySelector(".error");

  if (errorDisplay) errorDisplay.innerText = message;
  formGroup.classList.add("error");
  formGroup.classList.remove("success");
};

const setSuccess = element => {
  const formGroup = element.closest(".form-group") || element.parentElement;
  const errorDisplay = formGroup.querySelector(".error");

  if (errorDisplay) errorDisplay.innerText = "";
  formGroup.classList.add("success");
  formGroup.classList.remove("error");
};

// Step-by-step validation
function validateStep1() {
  const reg = document.getElementById("reg");
  let valid = true;

  if (reg.value.trim() === "" || reg.value.length < 2 || !/^[A-Za-z0-9]*$/.test(reg.value)) {
    setError(reg, "Registration number is required");
    valid = false;
  } else {
    setSuccess(reg);
  }

  return valid;
}

function validateStep2() {
  const make = document.getElementById("make");
  const model = document.getElementById("model");
  const year = document.getElementById("year");
  const mileage = document.getElementById("mileage");
  const bodyTrailer = document.getElementById("body-trailer");
  const bodyMotorhome = document.getElementById("body-motorhome");
  const transAuto = document.getElementById("trans-auto");
  const transManual = document.getElementById("trans-manual");

  let valid = true;

  // Body type
  if (!bodyTrailer.checked && !bodyMotorhome.checked) {
    setError(bodyTrailer, "Select a body type");
    valid = false;
  } else {
    setSuccess(bodyTrailer);
  }

  // Make
  if (make.value.trim() === "") {
    setError(make, "Make is required");
    valid = false;
  } else {
    setSuccess(make);
  }

  // Model
  if (model.value.trim() === "") {
    setError(model, "Model is required");
    valid = false;
  } else {
    setSuccess(model);
  }

  // Year
  const yearVal = parseInt(year.value.trim());
  const thisYear = new Date().getFullYear();
  if (isNaN(yearVal) || yearVal < 1900 || yearVal > thisYear) {
    setError(year, "Enter a valid year");
    valid = false;
  } else {
    setSuccess(year);
  }

  // Mileage
  const mileageVal = parseInt(mileage.value.trim());
  if (isNaN(mileageVal) || mileageVal < 0) {
    setError(mileage, "Mileage must be a positive number");
    valid = false;
  } else {
    setSuccess(mileage);
  }

  // Transmission
  if (!transAuto.checked && !transManual.checked) {
    setError(transAuto, "Select transmission type");
    valid = false;
  } else {
    setSuccess(transAuto);
  }

  return valid;
}

function validateStep3() {
  const description = document.getElementById("description");
  let valid = true;

  if (description.value.trim().length < 10) {
    setError(description, "Description must be at least 10 characters");
    valid = false;
  } else {
    setSuccess(description);
  }

  return valid;
}

function validateStep4() {
  const address1 = document.getElementById("address1");
  const city = document.getElementById("city");
  const postcode = document.getElementById("postcode");

  let valid = true;

  if (address1.value.trim() === "") {
    setError(address1, "Address Line 1 is required");
    valid = false;
  } else {
    setSuccess(address1);
  }

  if (city.value.trim() === "") {
    setError(city, "City is required");
    valid = false;
  } else {
    setSuccess(city);
  }

  if (postcode.value.trim() === "") {
    setError(postcode, "Postcode is required");
    valid = false;
  } else {
    setSuccess(postcode);
  }

  return valid;
}

function validateStep5() {
  const price = document.getElementById("price");
  let valid = true;

  if (price.value.trim() === "" || parseFloat(price.value) <= 0) {
    setError(price, "Enter a valid price");
    valid = false;
  } else {
    setSuccess(price);
  }

  return valid;
}

const validators = [
  validateStep1,
  validateStep2,
  validateStep3,
  validateStep4,
  validateStep5
];

// DOM load
document.addEventListener("DOMContentLoaded", () => {
  showStep(currentStep);

  document.querySelectorAll(".next").forEach(btn => {
    btn.addEventListener("click", () => {
      const validator = validators[currentStep];
      if (validator && !validator()) return;

      if (currentStep < steps.length - 1) {
        currentStep++;
        showStep(currentStep);
      }
    });
  });

  document.querySelectorAll(".prev").forEach(btn => {
    btn.addEventListener("click", () => {
      if (currentStep > 0) {
        currentStep--;
        showStep(currentStep);
      }
    });
  });

  const form = document.querySelector("form");
  form.addEventListener("submit", (e) => {
    if (!validateStep5()) {
      e.preventDefault();
    }
  });
});
