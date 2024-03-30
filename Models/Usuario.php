<?php
	$path = $_SERVER['DOCUMENT_ROOT'].'/ecommerce';
	include_once($path.'/conexao.php');

	class Usuario{
		private $id;
		private $nome;
		private $email;
		private $senha;
		private $endereco;
		private $isactive;

		// getters

		public function getId() {
			return $this->id;
		}

		public function getNome() {
			return $this->nome;
		}

		public function getEmail() {
			return $this->email;
		}

		public function getSenha() {
			return $this->senha;
		}

		public function getEndereco() {
			return $this->endereco;
		}

		public function getIsActive() {
			return $this->isactive;
		}

		// setters

		public function setId($id) {
			return $this->id = $id;
		}

		public function setNome($nome) {
			return $this->nome = $nome;
		}

		public function setEmail($email) {
			return $this->email = $email;
		}

		public function setSenha($senha) {
			return $this->senha = $senha;
		}

		public function setEndereco($endereco) {
			return $this->endereco = $endereco;
		}

		public function setIsActive($isactive) {
			return $this->isactive = $isactive;
		}

		// métodos

		public function Login() {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();

			$sql = "SELECT * FROM Usuarios WHERE Email = '" . $this->getEmail() . "' AND isActive = 1";

			$resposta = $conexao->query($sql);
			$usuario = $resposta->fetch_assoc();

			if (!$usuario) {
				echo "Email não cadastrado ou usuário inativo";
			} elseif ($usuario['Senha'] != $this->getSenha()) {
				echo "Senha incorreta";
			} else {
				$this->setId($usuario['ID']);
				return "Sucesso";
			}
		}

		public function Cadastrar() {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();

			$sql = "INSERT INTO Usuarios (Nome, Email, Senha, Endereco) VALUES ('$this->nome', '$this->email', '$this->senha', '$this->endereco')";

			if (mysqli_query($conexao, $sql)) {
				mysqli_close($conexao);
				return "Sucesso";
			} else {
				mysqli_close($conexao);
				return "Erro";
			}
		}

		public function ListarPorId($usuarioId) {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();

			$sql = "SELECT * FROM Usuarios WHERE id = $usuarioId AND isActive = 1";

			$resposta = $conexao->query($sql);
			$usuario = $resposta->fetch_assoc();

			if (!$usuario) {
				mysqli_close($conexao);
				return "Erro";
			} else {
				mysqli_close($conexao);
				return $usuario;
			}
		}

		public function Editar($usuarioId) {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();

			$sql = "UPDATE Usuarios SET Nome = '$this->nome',
				Email = '$this->email',
				Senha = '$this->senha',
				Endereco = '$this->endereco' 
				WHERE id = $usuarioId AND isActive = 1";

			if (mysqli_query($conexao, $sql)) {
				mysqli_close($conexao);
				return "Sucesso";
			} else {
				mysqli_close($conexao);
				return "Erro";
			}
		}

		public function Excluir($usuarioId) {
			$objConexao = new Conexao();
			$conexao = $objConexao->getConexao();

			$sql = "UPDATE Usuarios SET isActive = 0 WHERE id = $usuarioId AND isActive = 1";

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