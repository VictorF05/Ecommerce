<?php
	$path = $_SERVER['DOCUMENT_ROOT'].'/ecommerce';
	include_once($path.'/conexao.php');

	class Carrinho {
		private $id;
		private $quantidade;
		private $usuarioId;
		private $produtoId;

		public function getId() {
			return $this->$id;
		}

		public function getQuantidade() {
			return $this->quantidade;
		}

		public function getUsuarioId() {
			return $this->usuarioId;
		}

		public function getProdutoId() {
			return $this->produtoId;
		}

		public function setId($id) {
			return $this->id = $id;
		}

		public function setQuantidade($quantidade) {
			return $this->quantidade = $quantidade;
		}

		public function setUsuarioId($usuarioId) {
			return $this->usuarioId = $usuarioId;
		}

		public function setProdutoId($produtoId) {
			return $this->produtoId = $produtoId;
		}

		public function Adicionar() {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();

			$sql = "INSERT INTO Carrinhos (Quantidade, Usuario_id, Produto_id) VALUES ('$this->quantidade', '$this->usuarioId', '$this->produtoId')";

			if (mysqli_query($conexao, $sql)) {
				mysqli_close($conexao);
				return "Sucesso";
			} else {
				mysqli_close($conexao);
				return "Erro";
			}
		}

		public function Listar($usuarioId) {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();

			$arrayProdutosCarrinho = [];

			$sql = "SELECT C.ID, P.Descricao, P.Valor, C.Quantidade, C.Produto_id
					FROM Carrinhos C 
					JOIN Produtos P ON C.Produto_id = P.ID
					WHERE C.Usuario_id = $usuarioId";

			$resposta = mysqli_query($conexao, $sql);

			while($produtoCarrinho = mysqli_fetch_assoc($resposta)) {
				array_push($arrayProdutosCarrinho, $produtoCarrinho);
			}

			mysqli_close($conexao);

			return $arrayProdutosCarrinho;
		}

		public function Remover($produtoCarrinhoId) {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();

			$sql = "DELETE FROM Carrinhos WHERE ID = $produtoCarrinhoId";

			if (mysqli_query($conexao, $sql)) {
				mysqli_close($conexao);
				return "Sucesso";
			} else {
				mysqli_close($conexao);
				return "Erro";
			}
		}

		public function RemoverTodos($usuarioId) {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();

			$sql = "DELETE FROM Carrinhos WHERE Usuario_id = $usuarioId";

			if (mysqli_query($conexao, $sql)) {
				mysqli_close($conexao);
				return "Sucesso";
			} else {
				mysqli_close($conexao);
				return "Erro";
			}
		}

		public function ListarPorUsuarioProdutoId($usuarioId, $produtoId) {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();

			$sql = "SELECT * FROM Carrinhos WHERE Usuario_id = $usuarioId AND Produto_id = $produtoId";

			$resposta = $conexao->query($sql);
			$carrinho = $resposta->fetch_assoc();

			if (!$carrinho) {
				mysqli_close($conexao);
				return null;
			} else {
				mysqli_close($conexao);
				return $carrinho;
			}
		}

		public function AtualizarQuantidade ($carrinhoQuantidade, $carrinhoId) {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();

			$quantidadeAtual = $carrinhoQuantidade + 1;

			$sql = "UPDATE Carrinhos SET Quantidade = $quantidadeAtual WHERE ID = $carrinhoId";

			if (mysqli_query($conexao, $sql)) {
				mysqli_close($conexao);
				return "Sucesso";
			} else {
				mysqli_close($conexao);
				return "Erro";
			}
		}
	}
?>