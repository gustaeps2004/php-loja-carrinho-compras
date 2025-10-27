const urlFetch = 'http://localhost:8080/LojaCarrinhoCompras/assets/functions/obterDadosModalHistoricoPedidos.php'

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

async function abrirModalAsync(pedidoID) {
  await fetch(urlFetch, {
    method: 'POST', 
    headers: {
      'Content-Type': 'application/json',
    },
    
    body: JSON.stringify({ pedidoID }), 
  }).then(response => {
      
    if (!response.ok) {
      throw new Error('Erro na rede ou resposta do servidor: ' + response.statusText);
    }
    
    return response.json(); 
  }).then(dadosDaResposta => {

    const dados = dadosDaResposta.mensagem
    document.getElementById("valor-total-pedido-historico").textContent = dados.ValorTotal.toString().replace('.', ',')
    document.getElementById("data-pedido-historico").textContent = dados.DataPedido
    document.getElementById("metodo-pagamento-pedido-historico").textContent = obterDescricaoFormaPagamento(dados.FormaPagamento)
    
    inserirDetalhesProdutos(dados.DetalhesProdutos)
    inserirDetalhesEntregas(dados.DetalhesEntregas)
    console.log(dados)
  }).catch(ex => {
    console.log('Ocorreu um erro genérico: ', ex)
  })

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
  limparCampos()
  fecharModal()
});

function fecharModal() {
  modal.style.display = 'none';
  currentStep = 0;
}

function inserirDetalhesProdutos(detalhes) {
  let htmlContent = '';

  detalhes.forEach(detalhe => {
    htmlContent += `
                  <div class="content-step-confirmacao">
                    <div class="content-step-confirmacao-produto">
                      <p class="content-step-confirmacao-produto-paragrafo">Produto: ${detalhe.Titulo}</p>
                      <p class="content-step-confirmacao-produto-paragrafo">Quantidade: ${detalhe.Quantidade}</p>
                      <p class="content-step-confirmacao-produto-paragrafo">Valor unitário: R$ ${detalhe.Valor.toFixed(2).replace('.', ',')}</p>
                      <p class="content-step-confirmacao-produto-paragrafo">Valor Total: R$ ${(detalhe.Valor * detalhe.Quantidade).toFixed(2).replace('.', ',')}</p>
                    </div>
                  </div>
                  `
  })

  document.getElementById('detalhes-produtos').innerHTML = htmlContent
}

function inserirDetalhesEntregas(detalhes) {
  let htmlContent = '';

  detalhes.forEach(detalhe => {
    htmlContent += `
      <div class="content-step-confirmacao-entrega">
        <div class="content-step-confirmacao-produto">
          <p class="content-step-confirmacao-produto-paragrafo">Situação: ${obterDescricaoSituacaoEntrega(detalhe.Situacao)}</p>
          <p class="content-step-confirmacao-produto-paragrafo">Data atualização: ${detalhe.DtInclusao}</p>
        </div>
      </div>
    `
  })

  document.getElementById('detalhes-entregas').innerHTML = htmlContent
}

function limparCampos() {
  document.getElementById("valor-total-pedido-historico").textContent = null
  document.getElementById("data-pedido-historico").textContent = null
  document.getElementById("metodo-pagamento-pedido-historico").textContent = null
}

function obterDescricaoFormaPagamento(situacao) {
  const situacaoPagamento = {
    1: "Débito",
    2: "Crédito",
    3: "Pix"
  };

  return situacaoPagamento[situacao] ?? "Situação não encontrada";
}

function obterDescricaoSituacaoEntrega(situacao) {
  const situacaoPagamento = {
    1: "Pedido separado",
    2: "Com a transportadora",
    3: "Em trânsito",
    4: "Rota de entrega",
    5: "Entregue"
  };

  return situacaoPagamento[situacao] ?? "Situação não encontrada";
}