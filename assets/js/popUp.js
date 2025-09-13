const popup = document.getElementById("popup");
const fechar = document.getElementById("fecharPopup");
let timeoutId;

fechar.addEventListener("click", () => {
  popup.style.display = "none";
  clearTimeout(timeoutId);
});

export function abrirPopup(sucesso, mensagem) {
  popup.style.display = "block";

  const color = sucesso ? "#008eb6" : "#FF0000"

  popup.style.backgroundColor = color

  document.getElementById("mensagem-pop-up").textContent = mensagem

  clearTimeout(timeoutId);
  timeoutId = setTimeout(() => {
    popup.style.display = "none";
  }, 10000);
}