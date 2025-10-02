const modal = document.getElementById('modal')
const steps = document.querySelectorAll('.step')
const closeBtn = document.getElementById('closeModalBtn')

let currentStep = 0

function showStep(index) {
  steps.forEach((step, i) => {
    step.classList.toggle('active', i === index);
  })
}

function abrirModalEntrega(pedidoID) {
  conectarWebSocket(pedidoID)

  modal.style.display = 'block';
  showStep(currentStep);
}

function conectarWebSocket(pedidoID) {
  const socket = new WebSocket("ws://localhost:3333");

  socket.onopen = (event) => {
    setInterval(() => {
      if (socket.readyState === WebSocket.OPEN) 
        socket.send(pedidoID); 
    }, 1000);
  };

  socket.onmessage = (event) => {
    let response = JSON.parse(event.data)
    
    if (document.getElementById("situacaoEntrega").textContent == obterDescricaoSituacaoEntrega(response.SituacaoEntrega))
      return

    document.getElementById("situacaoEntrega").textContent = obterDescricaoSituacaoEntrega(response.SituacaoEntrega)
    document.getElementById("dtSituacao").textContent = response.DtSituacao
  };

  closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
    currentStep = 0;

    socket.close()
  })
}

function obterDescricaoSituacaoEntrega(situacao) {
  const situacaoEntrega = {
      1: "Pedido separado",
      2: "Com a transportadora",
      3: "Em trânsito",
      4: "Em rota de entrega",
      5: "Entregue",
  };

  return situacaoEntrega[situacao] ?? "Situação não encontrada";
}