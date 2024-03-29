<?php
	class Conexao {
		public function getConexao() {
			$host = 'localhost';
			$bd = 'ecommerce';
			$usuariobd = 'root';
			$senhabd = '';

			$conexao = new mysqli($host, $usuariobd, $senhabd, $bd);

			if (!$conexao) {
				die ("Erro de conexão com localhost, o sequinte erro ocorreu -> " . mysqli_connect_error());
			}

			return $conexao;
		}
	}
?>