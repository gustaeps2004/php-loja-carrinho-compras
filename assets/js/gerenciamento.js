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
    console.log(response)
    return response.json();
  })
  .then(data => {
    atualizarGraficoTotalAnual(data.mensagem.TotalAnual)
  });
});

function atualizarGraficoTotalAnual(data) {
  const totalAnual = document.getElementById('totalAnual').getContext('2d');
        
  new Chart(totalAnual, {
    type: 'bar',
    options: {
      animation: false,
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          enabled: false
        }
      }
    },
    data: {
      labels: data.map(row => row.Campo),
      datasets: [{
        label: 'Total anual',
        data: data.map(row => row.Valor)
      }]
    }
  });
}