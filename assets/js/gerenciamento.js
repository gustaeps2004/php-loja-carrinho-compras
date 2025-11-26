const urlBase = "http://localhost:8080/php-loja-carrinho-compras/assets/functions/obterValoresGrafico.php"

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
  console.log(maior)
  console.log(menor)
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