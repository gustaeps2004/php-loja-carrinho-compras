function abrirModalEntrega(pedidoID) {
  conectarWebSocket(pedidoID)
}

function conectarWebSocket(pedidoID) {
  const socket = new WebSocket("ws://localhost:3333");

  socket.onopen = (event) => {
    setInterval(() => {
      if (socket.readyState === WebSocket.OPEN) 
        socket.send(pedidoID); 
    }, 1000);
  };

  socket.onmessage = (event) => {
    console.log("Mensagem recebida do servidor:", event.data);
  };
}