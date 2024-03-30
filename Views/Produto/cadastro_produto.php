<html>
<body>
	<h1>Ecommerce - cadastro de produtos</h1>

	<form action="" method="post">
		Descricao: <input type="text" name="descricao" value=""> <br>
		Valor: <input type="number" name="valor" value=""> <br>
		Categoria: <input type="text" name="categoria" value=""> <br>
		Quantidade: <input type="number" name="quantidade" value=""> <br>
		<button type="submit" name="cadastrar">Cadastrar</button>
		<a href="./listagem_produtos.php">Voltar</a>
	</form>
</body>
</html>
<?php
	$path = $_SERVER['DOCUMENT_ROOT'].'/ecommerce';
	include_once($path.'/Controllers/produto_controller.php');

	if (isset($_POST['cadastrar'])) {
		$objProduto = new Produto();
		$objProduto->setDescricao($_POST['descricao']);
		$objProduto->setValor($_POST['valor']);
		$objProduto->setCategoria($_POST['categoria']);
		$objProduto->setQuantidade($_POST['quantidade']);

		$controllerProduto = new ProdutoController();

		$resposta = $controllerProduto->cadastraProduto($objProduto);

		if ($resposta == "Sucesso") {
			header("Location: http://localhost/ecommerce/Views/Produto/listagem_produtos.php");
		} else {
			echo $resposta;
		}
	}
?>