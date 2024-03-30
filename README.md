# Ecommerce

Usuários
  - Cadastro
      - Validação dos campos de acordo com banco de dados
      - Email é único, não permite cadastro de email repetido
  - Edição
      - Validação dos campos de acordo com banco de dados
      - Email é único, não permite cadastro de email repetido
  - Exclusão
      - Não executa "DELETE" no banco de dados, apenas "set" como inativo no banco
  - Login
      - Valida email e senha apenas de usuários que constam como ativos no banco de dados
  - Logout
      - Encerra a sessão e redireciona para a página de login

Produtos
  - Cadastro
      - Validação dos campos de acordo com banco de dados
  - Listagem
      - Lista todos os produtos com estoque maior que zero
  - Edição
      - Validação dos campos de acordo com banco de dados
  - Exclusão
      - Não deleta realmente, apenas "set" quantidade como zero para não ser listado

Carrinho
  - Adicionar
    - Permite adicionar itens da listagem de produtos ao carrinho
  - Remover
    - Remover produtos do carrinho
  - Listagem
    - Lista todos os itens que pertencem ao carrinho do usuário

Pedidos
  - Criar
     - Ao comprar os itens do carrinho é criado um pedido com status de "pedido efetuado"
  - Cancelar
     - Ao cancelar um pedido, o mesmo tem o status alterado para "pedido cancelado" e o estoque dos produtos é reestabelecido
  - Listagem
     - Lista todos os pedidos feitos pelo usuário

As únicas páginas que são acessíveis sem autenticação de login são:
  - paǵina de login
  - página de cadastro de usuário

Todas as outras páginas são restritas, não permitindo o acesso sem autenticação.
  
