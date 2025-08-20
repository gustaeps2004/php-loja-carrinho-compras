function FormatarDocumento(){
  var documento = ObterCampoInput("documento").replace(/\D/g, '')

  if (documento.length === 14)
    return

  let novoValor = documento;

  if (documento.length == 11) 
    novoValor = documento.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4")

  InserirValorInput("documento", novoValor)
}

function ObterCampoInput(campo) {
  return document.getElementById(campo).value
}

function InserirValorInput(campo, novoValor) {
  document.getElementById(campo).value = novoValor
}

function ValidarToken(telaAdm) {
  const token = localStorage.getItem('auth');
  
  if (!token) {
    RedirecionarLogin(false);
    return;
  }

  const decoded = parseJwt(token);
  const now = Math.floor(Date.now() / 1000); 

  if ((decoded && decoded.exp > now) === false) {
    RemoverToken()
    RedirecionarLogin(false)

    return
  }

  if (decoded?.data?.permissao != 'Administrador') {
    
    if (telaAdm)
      RedirecionarLogin(true);

    document.getElementById('TabAdministracao').style.display = 'none';
  } else {
    document.getElementById('TabAdministracao').style.display = 'block';
  }

  InserirValoresIniciais(decoded?.data)
}

function RedirecionarLogin(telaAdm) {
  RemoverToken()

  if (telaAdm){
    window.location.href = "../login/login.php"
    return
  }

 window.location.href = "../html/login/login.php"
}

function RemoverToken() {
  localStorage.removeItem('auth')
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

function InserirValoresIniciais(data) {
  document.getElementById("nomeUsuario").textContent = data?.nome;
  document.getElementById("permissaoUsuario").textContent = data?.permissao;
}

$(document).ready(function () {
  $('#formFaleConosco').on('submit', function (e) {
    let cpf = $('#documento').val().trim()
    let regexCpf = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/

    if (!regexCpf.test(cpf)) {
      e.preventDefault()
      $('#erroCpf').text('CPF inválido. Use o formato xxx.xxx.xxx-xx')
    } else
      $('#erroCpf').text('')

    if ($('#nome').val().trim() === '') {
      e.preventDefault()
      $('#erroNome').text('O nome é um campo obrigatório.')
    } else
      $('#erroNome').text('')

    if ($('#email').val().trim() === '') {
      e.preventDefault()
      $('#erroEmail').text('O email é um campo obrigatório.')
    } else
      $('#erroEmail').text('')

    if ($('#motivo').val().trim() != '' && $('#comentario').val().trim() == '') {
      e.preventDefault()
      $('#erroComentario').text('O comentário é um campo obrigatório.')
    } else
      $('#erroComentario').text('')
  })
})

$(document).ready(function () {
  $('#fone').on('input', function () {
    let input = $(this).val().replace(/\D/g, '')

    if (input.length > 11) {
      input = input.substring(0, 11)
    }

    let formatado = input

    if (input.length >= 2)
      formatado = `(${input.substring(0, 2)}`

    if (input.length >= 3)
      formatado += `) ${input.substring(2, 3)}`

    if (input.length >= 7)
      formatado += ` ${input.substring(3, 7)}-${input.substring(7)}`
    else if (input.length > 3) 
      formatado += ` ${input.substring(3)}`

    $(this).val(formatado)
  })
})