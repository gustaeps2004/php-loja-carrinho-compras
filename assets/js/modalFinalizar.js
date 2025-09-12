const modal = document.getElementById('modal');
const openBtn = document.getElementById('openModalForm');
const closeBtn = document.getElementById('closeModalBtn');
const steps = document.querySelectorAll('.step');
const nextBtns = document.querySelectorAll('.next-btn');
const prevBtns = document.querySelectorAll('.prev-btn');
const finishBtn = document.querySelector('.finish-btn');

let currentStep = 0;

function showStep(index) {
  steps.forEach((step, i) => {
    step.classList.toggle('active', i === index);
  });
}

openBtn.addEventListener('click', () => {
  modal.style.display = 'block';
  showStep(currentStep);
});

closeBtn.addEventListener('click', () => {
  modal.style.display = 'none';
  currentStep = 0;
});

nextBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    currentStep++;
    showStep(currentStep);
  });
});

prevBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    if (currentStep > 0) {
      currentStep--;
      showStep(currentStep);
    }
  });
});

finishBtn.addEventListener('click', () => {
  modal.style.display = 'none';
  currentStep = 0;
});
