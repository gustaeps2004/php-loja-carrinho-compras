function abrirCarrinho(caminho) {
  window.location.href = caminho
}

function marcarProdutoSelecionado(id) {
  const checkbox = document.getElementById('checkProduto_' + id);
  window.location.href = `../../assets/functions/marcaCheckboxProduto.php?produtoID=${id}&checked=${checkbox.checked}`
}