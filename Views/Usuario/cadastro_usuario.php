<html>
<body>
	<h1>Ecommerce - cadastro de usuários</h1>

	<a href="../../index.php">Voltar</a>

	<form action="" method="post">
		Nome: <input type="text" name="nome" value=""> <br>
		Email: <input type="text" name="email" value=""> <br>
		Senha: <input type="password" name="senha" value=""> <br>
		Endereco: <input type="text" name="endereco" value=""> <br>
		<button type="submit" name="cadastrar">Cadastrar</button>
	</form>
</body>
</html>
<?php
	$path = $_SERVER['DOCUMENT_ROOT'].'/ecommerce';
	include_once($path.'/Controllers/usuario_controller.php');

	if (isset($_POST['cadastrar'])) {
		$objUsuario = new Usuario();
		$objUsuario->setNome($_POST['nome']);
		$objUsuario->setEmail($_POST['email']);
		$objUsuario->setSenha($_POST['senha']);
		$objUsuario->setEndereco($_POST['endereco']);

		$controllerUsuario = new UsuarioController();

		$resposta = $controllerUsuario->cadastraUsuario($objUsuario);

		if ($resposta == "Sucesso") {
			header("Location: http://localhost/ecommerce/Views/Produto/listagem_produtos.php");
		} else {
			echo $resposta;
		}
	}
?>