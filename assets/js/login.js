const urlFetch = "http://localhost:8080/php-loja-carrinho-compras/assets/functions/enviarEmailRecuperacaoSenha.php";
const popup = document.getElementById("popup");
const fechar = document.getElementById("fecharPopup");
let timeoutId;

async function processarEnvioEmailAsync() {
	const email = document.getElementById('login').value

	if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
		abrirPopup(false, 'Digite um email verdadeiro.')
		return
	}

  fecharPopUp()
  await enviarEmailAsync(email )
}

async function enviarEmailAsync(email) {
  await fetch(urlFetch, {
    method: 'POST', 
    headers: {
      'Content-Type': 'application/json',
    },
    
    body: JSON.stringify({ email }), 
  }).then(response => {
      
    if (!response.ok) {
      throw new Error('Erro na rede ou resposta do servidor: ' + response.statusText);
    }
    
    return response.json(); 
  }).then(dadosDaResposta => {
    
    if (parseInt(dadosDaResposta.CodigoRetorno) != 200) {
      abrirPopup(false, dadosDaResposta.Mensagem)
      return 
    }

    abrirPopup(true, 'Foi encaminhado um email para a recuperação de senha.')
  }).catch(ex => {
    abrirPopup(false, `Ocorreu um erro genérico: ${ex.message}` )
  })
}

fechar.addEventListener("click", () => {
  fecharPopUp()
  clearTimeout(timeoutId);
});

function fecharPopUp() {
  popup.style.display = "none";
}

function abrirPopup(sucesso, mensagem) {
  popup.style.display = "block";

  const color = sucesso ? "#008eb6" : "#FF0000"
  popup.style.backgroundColor = color

  document.getElementById("mensagem-pop-up").textContent = mensagem

  clearTimeout(timeoutId);
  timeoutId = setTimeout(() => {
    fecharPopUp()
  }, 5000);
}