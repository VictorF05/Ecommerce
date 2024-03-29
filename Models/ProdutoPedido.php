<?php
    $path = $_SERVER['DOCUMENT_ROOT'].'/ecommerce';
    include_once($path.'/conexao.php');
    
    class ProdutoPedido {
		private $id;
		private $produtoId;
		private $pedidoId;
		private $valor;
		private $quantidade;

        public function getId() {
			return $this->$id;
		}

        public function getProdutoId() {
			return $this->produtoId;
		}

        public function getPedidoId() {
			return $this->pedidoId;
		}

        public function getValor() {
			return $this->valor;
		}

		public function getQuantidade() {
			return $this->quantidade;
		}

        public function setId($id) {
			return $this->id = $id;
		}

        public function setProdutoId($produtoId) {
			return $this->produtoId = $produtoId;
		}

        public function setPedidoId($pedidoId) {
			return $this->pedidoId = $pedidoId;
		}

        public function setValor($valor) {
			return $this->valor = $valor;
		}


		public function setQuantidade($quantidade) {
			return $this->quantidade = $quantidade;
		}

		public function Criar() {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();

			$sql = "INSERT INTO Produtos_Pedidos (Valor, Produto_id, Pedido_id, Quantidade) VALUES ('$this->valor', '$this->produtoId', '$this->pedidoId', '$this->quantidade')";

			if (mysqli_query($conexao, $sql)) {
				mysqli_close($conexao);
				return "Sucesso";
			} else {
				mysqli_close($conexao);
				return "Erro";
			}
		}

		public function Listar($pedidoId) {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();

			$arrayProdutosPedido = [];

			$sql = "SELECT * FROM Produtos_Pedidos WHERE Pedido_id = $pedidoId";

			$resposta = mysqli_query($conexao, $sql);

			while($produtoPedido = mysqli_fetch_assoc($resposta)) {
				array_push($arrayProdutosPedido, $produtoPedido);
			}

			mysqli_close($conexao);

			return $arrayProdutosPedido;
		}
    }
?>