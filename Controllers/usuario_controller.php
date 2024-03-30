<?php
	$path = $_SERVER['DOCUMENT_ROOT'].'/ecommerce';
	include_once($path.'/Models/Usuario.php');

	class UsuarioController {
		public function getUsuario ($usuarioId) {
			$objUsuario = new Usuario();

			return $objUsuario->ListarPorId($usuarioId);
		}

		public function cadastraUsuario ($objUsuario) {
			if (
				$this->validaNome($objUsuario->getNome()) && 
				$this->validaEmail($objUsuario->getEmail()) && 
				$this->validaSenha($objUsuario->getSenha()) && 
				$this->validaEndereco($objUsuario->getEndereco())
				){
				return $objUsuario->Cadastrar();
			}
		}

		public function editaUsuario ($usuarioId, $objUsuario) {
			if (
				$this->validaNome($objUsuario->getNome()) && 
				$this->validaEmail($objUsuario->getEmail()) && 
				$this->validaSenha($objUsuario->getSenha()) && 
				$this->validaEndereco($objUsuario->getEndereco())
				){
				return $objUsuario->Editar($usuarioId);
			}
		}

		public function excluirUsuario ($usuarioId) {
			$objUsuario = new Usuario();

			return $objUsuario->Excluir($usuarioId);
		}

		public function validaUsuario ($objUsuario) {
			if (
				$this->validaEmail($objUsuario->getEmail()) && 
				$this->validaSenha($objUsuario->getSenha())
				){
				return $objUsuario->Login();
			}
		}

		public function validaNome ($nome) {
			if ($nome == null) {
				echo "O nome é obrigatório";
				return false;
			} elseif (strlen($nome) > 100) {
				echo "O nome deve conter no máximo 100 caracteres";
				return false;
			}

			return true;
		}

		public function validaEmail ($email) {
			if ($email == null) {
				echo "O e-mail é obrigatório";
				return false;
			} elseif (strlen($email) > 100) {
				echo "O e-mail deve conter no máximo 100 caracteres";
				return false;
			}

			return true;
		}

		public function validaSenha ($senha) {
			if ($senha == null) {
				echo "A senha é obrigatória";
				return false;
			} elseif (strlen($senha) > 100) {
				echo "A senha deve conter no máximo 100 caracteres";
				return false;
			}

			return true;
		}

		public function validaEndereco ($endereco) {
			if ($endereco == null) {
				echo "O endereço é obrigatório";
				return false;
			} elseif (strlen($endereco) > 100) {
				echo "O endereço deve conter no máximo 100 caracteres";
				return false;
			}

			return true;
		}
	}
?>