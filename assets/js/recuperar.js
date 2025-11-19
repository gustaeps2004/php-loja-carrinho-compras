const popup = document.getElementById("popup");
const fechar = document.getElementById("fecharPopup");
let timeoutId;

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

function compararSenhas() {
  const senha = document.getElementById("senha").value
  const confirmacaoSenha = document.getElementById("confirmacaoSenha").value

  if (senha !== confirmacaoSenha) {
    abrirPopup(false, "As senhas devem ser iguais.")
    return false
  }

  return true
}

window.onload = function() {
  const queryParams = new URLSearchParams(document.location.search)

  document.getElementById("senha").value = null
  document.getElementById("token").value = queryParams.get("token")
  document.getElementById("idUsuario").value = queryParams.get("id")
  document.getElementById("login").value = queryParams.get("email")
};