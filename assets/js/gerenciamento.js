const urlBase = "http://localhost:8080/php-loja-carrinho-compras/assets/functions/obterValoresGrafico.php"
const urlBaseDownload = "http://localhost:8080/php-loja-carrinho-compras/assets/functions/obterHtmlRelatorio.php"

document.addEventListener("DOMContentLoaded", async function() {

  await fetch(urlBase, {
    method: 'POST', 
    headers: {
      'Content-Type': 'application/json',
    },
    
    body: JSON.stringify({ usuarioID: 1 }), 
  })
  .then(response => {
    return response.json();
  })
  .then(data => {
    atualizarGrafico("totalAnual", "TOTAL ANUAL", data.mensagem.TotalAnual)
    atualizarGrafico("totalMensal", "TOTAL MENSAL", data.mensagem.TotalMensal)

    atualizarGrafico("projecaoAnual", "  PROJEÇÃO ANUAL", data.mensagem.ProjecaoAnual)
    atualizarGrafico("projecaoMensal", "PROJEÇÃO MENSAL", data.mensagem.ProjecaoMensal)

    atualizarGraficoPizza(
      data.mensagem.QtdProdutosVendidos.reduce((max, item) => {
        return Number(item.Valor) > Number(max.Valor) ? item : max;
      }),
      data.mensagem.QtdProdutosVendidos.reduce((min, item) => {
        return Number(item.Valor) < Number(min.Valor) ? item : min;
      })
    )
  })
})

function atualizarGrafico(campo, titulo, data) {
  const campoHtml = document.getElementById(campo).getContext('2d');
        
  new Chart(campoHtml, {
    type: 'bar',
    options: {
      animation: true,
      plugins: {
        legend: {
          display: true
        },
        tooltip: {
          enabled: false
        }
      }
    },
    data: {
      labels: data.map(row => row.Campo),
      datasets: [{
        label: titulo,
        data: data.map(row => Math.ceil(row.Valor))
      }]
    }
  });
}

function atualizarGraficoPizza(maior, menor) {
  new Chart(document.getElementById("produtos-mais-menos-vendidos"), {
    type: "pie",
    data: {
      labels: [maior.Campo, menor.Campo],
      datasets: [{
        data: [maior.Valor, menor.Valor],
        backgroundColor: ["#3498db", "#9b59b6"]
      }]
    },
    options: {
      responsive: true
    }
  });
}

document.getElementById("btn-download-relatorio").addEventListener("click", async () => {
  const totalAnual = document.getElementById("checkTotalAnual").checked
  const totalMensal = document.getElementById("checkTotalMensal").checked
  const projecaoAnual = document.getElementById("checkProjecaoAnual").checked
  const produtosVendidos = document.getElementById("checkTotalProdutosVendidos").checked
  const selecionarTodos = todosSelecionados()

  const response = await fetch(urlBaseDownload, {
    method: 'POST', 
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ 
      usuarioID: obterUsuario(),
      totalAnual: selecionarTodos ? true : totalAnual,
      totalMensal: selecionarTodos ? true : totalMensal,
      projecaoAnual: selecionarTodos ? true : projecaoAnual,
      projecaoMensal: false,
      produtosVendidos: selecionarTodos ? true : produtosVendidos,
    }), 
  })

  if (!response.ok) {
    throw new Error('Erro na geração do PDF');
  }

  const blob = await response.blob();
  
  const url = window.URL.createObjectURL(blob);
  
  const a = document.createElement('a');
  a.href = url;
  a.download = 'meu-relatorio.pdf'; 
  document.body.appendChild(a); 
  a.click();

  // 4. Limpeza
  a.remove();
  window.URL.revokeObjectURL(url);
});

function todosSelecionados() {
  const totalAnual = document.getElementById("checkTotalAnual").checked
  const totalMensal = document.getElementById("checkTotalMensal").checked
  const projecaoAnual = document.getElementById("checkProjecaoAnual").checked
  const produtosVendidos = document.getElementById("checkTotalProdutosVendidos").checked

  return !totalAnual && !totalMensal && !projecaoAnual && !produtosVendidos
}

function obterUsuario() {
  const token = localStorage.getItem('auth')
  const decoded = parseJwt(token)

  return decoded.data.id
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