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
    atualizarGrafico("totalAnual", "TOTAL ANUAL", data.mensagem.TotalAnual)
    atualizarGrafico("totalMensal", "TOTAL MENSAL", data.mensagem.TotalMensal)
  });
});

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
        data: data.map(row => row.Valor)
      }]
    }
  });
}