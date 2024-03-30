<?php
	$path = $_SERVER['DOCUMENT_ROOT'].'/ecommerce';
	include_once($path.'/Controllers/produto_controller.php');
	include_once($path.'/Controllers/usuario_controller.php');

	$controllerUsuario = new UsuarioController();
	
	$controllerUsuario->verificaLogin();

    $controllerProduto = new ProdutoController();

    $produto = $controllerProduto->getProduto($_GET['id']);
?>

<html>
<body>
	<h1>Ecommerce - edição de produtos</h1>

	<form action="" method="post">
		Descricao: <input type="text" name="descricao" value="<?php echo $produto['Descricao']?>"> <br>
		Valor: <input type="number" name="valor" value="<?php echo $produto['Valor']?>"> <br>
		Categoria: <input type="text" name="categoria" value="<?php echo $produto['Categoria']?>"> <br>
		Quantidade: <input type="number" name="quantidade" value="<?php echo $produto['Quantidade']?>"> <br>
		<button type="submit" name="editar">Editar</button>
        <a href="./listagem_produtos.php">Voltar</a>
	</form>
</body>
</html>

<?php
	if (isset($_POST['editar'])) {
		$objProduto = new Produto();
		$objProduto->setDescricao($_POST['descricao']);
		$objProduto->setValor($_POST['valor']);
		$objProduto->setCategoria($_POST['categoria']);
		$objProduto->setQuantidade($_POST['quantidade']);

		$resposta = $controllerProduto->editarProduto($produto['ID'], $objProduto);

		if ($resposta == "Sucesso") {
			header("Location: http://localhost/ecommerce/Views/Produto/editar_produto.php?id={$produto['ID']}&mensagem=Alteração+salva+com+sucesso");
		} else {
			echo $resposta;
		}
	}

	if (isset($_GET['mensagem'])) {
		echo $_GET['mensagem'];
	}
?>