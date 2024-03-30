<html>
<body>
	<h1>Ecommerce - início</h1>

	<form action="" method="post">
		Email: <input type="text" name="email" value=""> <br>
		Senha: <input type="password" name="senha" value=""> <br>
		<button type="submit" name="logar">Entrar</button>
		<a href="./Views/Usuario/cadastro_usuario.php">Cadastrar</a>
	</form>
</body>
</html>
<?php

	$path = $_SERVER['DOCUMENT_ROOT'].'/ecommerce';
	include_once($path.'/Controllers/usuario_controller.php');

	if (isset($_POST['logar'])) {

		$objUsuario = new Usuario();
		$objUsuario->setEmail($_POST['email']);
		$objUsuario->setSenha($_POST['senha']);

		$controllerUsuario = new UsuarioController();

		$resposta = $controllerUsuario->validaUsuario($objUsuario);

		if ($resposta == "Sucesso") {
			session_start();
			$_SESSION["usuario_id"] = $objUsuario->getId();
			header("Location: http://localhost/ecommerce/Views/Produto/listagem_produtos.php");
		}
	}
?>