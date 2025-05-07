let currentStep = 0;
  const steps = document.querySelectorAll(".step");
  const numbers = document.querySelectorAll(".pagination .number");

  function showStep(index) {
    steps.forEach((step, i) => {
      step.classList.toggle("active", i === index);
      if (numbers[i]) numbers[i].classList.toggle("active", i <= index);
    });
  }

  document.addEventListener("DOMContentLoaded", () => {
    showStep(currentStep);

    document.querySelectorAll(".next").forEach(btn => {
      btn.addEventListener("click", () => {
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
  });