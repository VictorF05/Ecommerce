<?php
	$path = $_SERVER['DOCUMENT_ROOT'].'/ecommerce';
	include_once($path.'/Controllers/usuario_controller.php');

	session_start();
	$controllerUsuario = new UsuarioController();

	$controllerUsuario->verificaLogin();

	$usuario = $controllerUsuario->getUsuario($_SESSION["usuario_id"]);
?>

<html>
<body>
	<h1>Ecommerce - edição de usuário</h1>

	<form action="" method="post">
		Nome: <input type="text" name="nome" value="<?php echo $usuario['Nome']?>"> <br>
		Email: <input type="text" name="email" value="<?php echo $usuario['Email']?>"> <br>
		Senha: <input type="text" name="senha" value="<?php echo $usuario['Senha']?>"> <br>
		Endereço: <input type="text" name="endereco" value="<?php echo $usuario['Endereco']?>"> <br>
		<button type="submit" name="editar">Editar</button>
		<a href="../Produto/listagem_produtos.php">Voltar</a>
	</form>
</body>
</html>

<?php
	if (isset($_POST['editar'])) {
		$objUsuario = new Usuario();
		$objUsuario->setNome($_POST['nome']);
		$objUsuario->setEmail($_POST['email']);
		$objUsuario->setSenha($_POST['senha']);
		$objUsuario->setEndereco($_POST['endereco']);

		$resposta = $controllerUsuario->editaUsuario($usuario['ID'], $objUsuario);

		if ($resposta == "Sucesso") {
			$usuario = $controllerUsuario->getUsuario($_SESSION["usuario_id"]);
			echo "Conta salva com sucesso";	
		} else {
			echo $resposta;
		}
	}
?>