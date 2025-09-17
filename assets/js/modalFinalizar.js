const modal = document.getElementById('modal')
const openBtn = document.getElementById('openModalForm')
const closeBtn = document.getElementById('closeModalBtn')
const steps = document.querySelectorAll('.step')
const nextBtns = document.querySelectorAll('.next-btn')
const prevBtns = document.querySelectorAll('.prev-btn')
const finishBtn = document.querySelector('.finish-btn')
import { abrirPopup } from './popUp.js'

let currentStep = 0;

function showStep(index) {
  steps.forEach((step, i) => {
    step.classList.toggle('active', i === index);
  });
}

openBtn.addEventListener('click', () => {
  limparCampos()
  modal.style.display = 'block';
  showStep(currentStep);
});

closeBtn.addEventListener('click', () => {
  limparCampos()
  modal.style.display = 'none';
  currentStep = 0;
});

nextBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    
    if (currentStep == 1 && !enderecoValido())
      return
    
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
  limparCampos()
  
  redirecionarPagamento()
});

document.getElementById("cep")?.addEventListener('input', function(e) {
  let valor = e.target.value.replace(/\D/g, "");
  if (valor.length > 5) {
    valor = valor.replace(/(\d{5})(\d{1,3}).*/, "$1-$2");
  }
  e.target.value = valor;
});

function limparCampos() {
  document.getElementById("cep").value = null
  document.getElementById("logradouro").value = null
  document.getElementById("numero").value = null
  document.getElementById("complemento").value = null
  document.getElementById("cidade").value = null
  document.getElementById("estado").value = null
}

document.getElementById("cep").addEventListener("blur", buscarCepAsync);

async function buscarCepAsync() {
    const cep = document.getElementById("cep").value.replace(/\D/g, "")
    
    if (cep.length !== 8)
      return;

    try {
      const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`)

      if (!response.ok)
        return

      const data = await response.json()

      if (data.erro)
        return

      document.getElementById("logradouro").value = data.logradouro || "";
      document.getElementById("complemento").value = data.complemento || "";
      document.getElementById("cidade").value = data.localidade || "";
      document.getElementById("estado").value = data.uf || "";
    } catch (error) {
      console.error("Erro:", error);
    }
}

function enderecoValido() {
  if(!/^\d{5}-\d{3}$/.test(document.getElementById('cep').value)){
    abrirPopup(false, "Preencha o campo cep corretamente")
    document.getElementById('cep').focus();
    return false;
  }

  if(document.getElementById('logradouro').value == ""){
    abrirPopup(false, "Preencha o campo logradouro")
    document.getElementById('logradouro').focus();
    return false;
  }

  if(/^\d{1,5}$/.test(document.getElementById('numero').value) == false){
    abrirPopup(false, "Preencha o campo número corretamente")
    document.getElementById('numero').focus();
    return false;
  }

  const cidade = document.getElementById('cidade').value
  if(/^[A-Za-zÀ-ÿ]+([ ][A-Za-zÀ-ÿ]+)*$/.test(cidade) == false){
    abrirPopup(false, "Preencha o campo cidade corretamente")
    document.getElementById('cidade').focus();
    return false;
  }

  const estado = document.getElementById('estado').value
  if(/^[A-Za-zÀ-ÿ]+([ ][A-Za-zÀ-ÿ]+)*$/.test(estado) == false){
    abrirPopup(false, "Preencha o campo estado corretamente")
    document.getElementById('estado').focus();
    return false;
  }

  return true;
}

function redirecionarPagamento() {
  const usuarioID = new URLSearchParams(document.location.search).get("usuarioID")
  const metodoPagamento = document.getElementById('metodo-pagamento').value
  window.location.href = `../../assets/functions/finalizarPagamentoCarrinho.php?usuarioID=${usuarioID}&metodoPagamento=${metodoPagamento}`
}