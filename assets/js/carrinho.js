const cancelarBtn = document.getElementById("cancelar-carrinho")

function abrirCarrinho(caminho) {
  window.location.href = `${caminho}?usuarioID=${obterUsuario()}`
}

function obterUsuario() {
  const token = localStorage.getItem('auth')
  const decoded = parseJwt(token)

  return decoded.data.id
}

function marcarProdutoSelecionado(id) {
  const checkbox = document.getElementById('checkProduto_' + id);
  window.location.href = `../../assets/functions/marcaCheckboxProduto.php?produtoID=${id}&checked=${checkbox.checked}&usuarioID=${obterUsuario()}`
}

function parseJwt(token) {
  try {
    const base64Url = token.split('.')[1]
    const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/')

    const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2)
    }).join(''));

    return JSON.parse(jsonPayload)
  } catch (e) {
    return null;
  }
}

function adicionarUsuarioNaURL(form) {
  const usuarioID = obterUsuario(); 

  form.action += `?usuarioID=${encodeURIComponent(usuarioID)}`;
  return true; 
}

cancelarBtn.addEventListener('click', () => {
  const usuarioID = new URLSearchParams(document.location.search).get("usuarioID")
  
  window.location.href = `../../assets/functions/cancelarCarrinho.php?usuarioID=${usuarioID}`
});