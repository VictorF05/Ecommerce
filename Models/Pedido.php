<?php
    $path = $_SERVER['DOCUMENT_ROOT'].'/ecommerce';
    include_once($path.'/conexao.php');

    class Pedido {
        private $id;
		private $valor;
		private $status;
		private $usuarioId;

		// getters

		public function getId() {
			return $this->id;
		}

		public function getValor() {
			return $this->valor;
		}

		public function getStatus() {
			return $this->status;
		}

		public function getUsuarioId() {
			return $this->usuarioId;
		}


		// setters

		public function setId($id) {
			return $this->id = $id;
		}

		public function setValor($valor) {
			return $this->valor = $valor;
		}

		public function setStatus($status) {
			return $this->status = $status;
		}

		public function setUsuarioId($usuarioId) {
			return $this->usuarioId = $usuarioId;
		}

		public function Criar() {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();

			$sql = "INSERT INTO Pedidos (Valor, Status, Usuario_id) VALUES ('$this->valor', '$this->status', '$this->usuarioId')";

			if (mysqli_query($conexao, $sql)) {
				$pedidoId = mysqli_insert_id($conexao);

				mysqli_close($conexao);
				return $pedidoId;
			} else {
				mysqli_close($conexao);
				return false;
			}
		}

		public function Listar($usuarioId) {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();

			$arrayPedidosUsuario= [];

			$sql = "SELECT * FROM Pedidos WHERE Usuario_id = $usuarioId";

			$resposta = mysqli_query($conexao, $sql);

			while($pedidoUsuario = mysqli_fetch_assoc($resposta)) {
				array_push($arrayPedidosUsuario, $pedidoUsuario);
			}

			mysqli_close($conexao);

			return $arrayPedidosUsuario;
		}

		public function ListarPorId($pedidoId) {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();

			$sql = "SELECT * FROM Pedidos WHERE id = $pedidoId";

			$resposta = $conexao->query($sql);
			$pedido = $resposta->fetch_assoc();

			if (!$pedido) {
				mysqli_close($conexao);
				return "Erro";
			} else {
				mysqli_close($conexao);
				return $pedido;
			}
		}

		public function Cancelar($pedidoId) {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();

			$sql = "UPDATE Pedidos SET Status = 'Pedido cancelado' WHERE ID = $pedidoId";

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