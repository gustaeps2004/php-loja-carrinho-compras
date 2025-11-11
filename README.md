Este projeto é um sistema de e-commerce completo desenvolvido como trabalho final da disciplina Programação Orientada a Objetos. 
Ele simula uma loja virtual com recursos essenciais como autenticação de usuários, 
gerenciamento de produtos e pedidos, envio de e-mail, além de um sistema de rastreamento de entregas em tempo real.

O foco deste projeto foi o aprendizado da sintaxe PHP, priorizando a linguagem em detrimento de segurança e boas práticas. 
Estou ciente de que existem pontos de melhoria significativos, principalmente no que tange ao uso de variáveis de ambiente e ao tratamento da superglobal $_SESSION.

<br>
<br>
✨ Tecnologias Utilizadas
<br>
<br>
O projeto foi construído utilizando um conjunto robusto de tecnologias para garantir funcionalidade completa, segurança e recursos de tempo real:
<br>

- PHP: Utilizado para a lógica de negócio, rotas e comunicação com o banco de dados.
- MySQL: Para o armazenamento persistente de dados de usuários, produtos, pedidos, etc..
- Ratchet: Biblioteca de WebSockets para PHP, implementando a atualização em tempo real do status das entregas.
- Firebase: Banco de dados não relacional para armazenamento das entregas.
- PHPMailer: Utilizado para o envio de email.
<br>

🚀 Funcionalidades Principais
<br>
<br>
O sistema oferece diversas funcionalidades organizadas em diferentes níveis de acesso:
<br>

- Administrador e Usuário Comum
- Catálogo de Produtos: Visualização e busca de produtos disponíveis.
- Sistema de Carrinho: Adição, remoção e gestão de itens antes da finalização da compra.
- Checkout e Pagamento: Processo de finalização de pedido e simulação de pagamento.
- Seção "Fale Conosco": Formulário para contato direto com a administração.
- Rastreamento e Entrega
    - Atualização em Tempo Real: O principal diferencial do projeto. Utilizando Ratchet e Firebase, o status da entrega (ex: "Em preparo", "Saiu para entrega", "Entregue") é atualizado instantaneamente para o usuário.
 
<br>

👤 Autoria
<br>
<br>
Desenvolvedor: Gustavo Do Espirito Santo<br>
Disciplina: Programação Orientada a Objetos<br>
Data: Novembro de 2025
