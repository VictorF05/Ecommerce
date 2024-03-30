<?php
	$path = $_SERVER['DOCUMENT_ROOT'].'/ecommerce';
	include_once($path.'/conexao.php');

	class Produto {
		private $id;
		private $descricao;
		private $valor;
		private $categoria;
		private $quantidade;

		// getters

		public function getId() {
			return $this->id;
		}

		public function getDescricao() {
			return $this->descricao;
		}

		public function getValor() {
			return $this->valor;
		}

		public function getCategoria() {
			return $this->categoria;
		}

		public function getQuantidade() {
			return $this->quantidade;
		}


		// setters

		public function setId($id) {
			return $this->id = $id;
		}

		public function setDescricao($descricao) {
			return $this->descricao = $descricao;
		}

		public function setValor($valor) {
			return $this->valor = $valor;
		}

		public function setCategoria($categoria) {
			return $this->categoria = $categoria;
		}

		public function setQuantidade($quantidade) {
			return $this->quantidade = $quantidade;
		}

		public function Cadastrar() {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();

			$sql = "INSERT INTO Produtos (Descricao, Valor, Categoria, Quantidade) VALUES ('$this->descricao', '$this->valor', '$this->categoria', '$this->quantidade')";

			if (mysqli_query($conexao, $sql)) {
				mysqli_close($conexao);
				return "Sucesso";
			} else {
				mysqli_close($conexao);
				return "Erro";
			}
		}

		public function Listar() {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();
			
			$arrayProdutos = [];
			$sql = "SELECT * FROM Produtos WHERE Quantidade > 0";

			$resposta = mysqli_query($conexao, $sql);

			while($produto = mysqli_fetch_assoc($resposta)) {
				array_push($arrayProdutos, $produto);
			}

			mysqli_close($conexao);

			return $arrayProdutos;
		}

		public function ListarPorId($produtoId) {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();

			$sql = "SELECT * FROM Produtos WHERE ID = $produtoId";

			$resposta = $conexao->query($sql);
			$produto = $resposta->fetch_assoc();

			if (!$produto) {
				mysqli_close($conexao);
				return "Erro";
			} else {
				mysqli_close($conexao);
				return $produto;
			}
		}

		public function AtualizarEstoque ($produtoId, $quantidadeAtual) {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();

			$sql = "UPDATE Produtos SET Quantidade = $quantidadeAtual WHERE ID = $produtoId";

			if (mysqli_query($conexao, $sql)) {
				mysqli_close($conexao);
				return "Sucesso";
			} else {
				mysqli_close($conexao);
				return "Erro";
			}
		}

		public function Editar($produtoId) {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();

			$sql = "UPDATE Produtos SET Descricao = '$this->descricao',
				Valor = '$this->valor',
				Categoria = '$this->categoria',
				Quantidade = '$this->quantidade' 
				WHERE ID = $produtoId";

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