const modal = document.getElementById('modal')
const steps = document.querySelectorAll('.step')
const closeBtn = document.getElementById('closeModalBtn')
const nextBtns = document.querySelectorAll('.next-btn')
const prevBtns = document.querySelectorAll('.prev-btn')
const finishBtn = document.querySelector('.finish-btn')

let currentStep = 0

function showStep(index) {
  steps.forEach((step, i) => {
    step.classList.toggle('active', i === index);
  })
}

closeBtn.addEventListener('click', () => {
  fecharModal()
})

function abrirModal(pedidoID) {
  modal.style.display = 'block';
  showStep(currentStep);
}

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
  fecharModal()
});

function fecharModal() {
  modal.style.display = 'none';
  currentStep = 0;
}