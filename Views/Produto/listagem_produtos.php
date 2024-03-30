<html>
	<body>
		<h1>Ecommerce - listagem de produtos</h1>

		<a href="../Usuario/editar_usuario.php">Editar usuário</a>
		<a href="./cadastro_produto.php">Cadastrar produto</a>
		<a href="../Carrinho/listagem_produtos_carrinho.php">Ver carrinho</a>
		<a href="../Pedido/listagem_pedidos.php">Ver pedidos</a>

		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Descrição</th>
					<th>Valor</th>
					<th>Categoria</th>
					<th>Quantidade</th>
					<th>Adicionar<br>ao carrinho</th>
					<th>Editar</th>
					<th>Excluir</th>
				</tr>
			</thead>
			<tbody>
				<?php  
					$path = $_SERVER['DOCUMENT_ROOT'].'/ecommerce';
					include_once($path.'/Controllers/produto_controller.php');

					session_start();
						
					$objProduto = new Produto();
					$controllerProduto = new ProdutoController();
						
					$produtos = $controllerProduto->listarProdutos($objProduto);

					if(sizeof($produtos) > 0) {
						foreach($produtos as $produto) {
							echo "<tr>";
								echo "<td>";
									echo $produto['ID'];
								echo "</td>";
								echo "<td>";
									echo $produto['Descricao'];
								echo "</td>";
								echo "<td>";
									echo $produto['Valor'];
								echo "</td>";
								echo "<td>";
									echo $produto['Categoria'];
								echo "</td>";
								echo "<td>";
									echo $produto['Quantidade'];
								echo "</td>";
								echo "<td>";
									echo "<form action='' method='post'>";
										echo "<input type='hidden' name='usuario_id' value='".$_SESSION['usuario_id']."'>";
										echo "<input type='hidden' name='produto_id' value='".$produto['ID']."'>";
										echo "<input type='hidden' name='quantidadeEstoque' value='".$produto['Quantidade']."'>";
										echo "<button type='submit' name='adicionar'>";
											echo "+";
										echo "</button>";
									echo "</form>";
								echo "</td>";
								echo "<td>";
								echo "<form action='' method='post'>";
									echo "<input type='hidden' name='produto_id' value='".$produto['ID']."'>";
									echo "<button type='submit' name='editar'>";
										echo "✏️";
									echo "</button>";
								echo "</form>";
							echo "</td>";
							echo "<td>";
							echo "<form action='' method='post'>";
								echo "<input type='hidden' name='produto_id' value='".$produto['ID']."'>";
								echo "<button type='submit' name='excluir'>";
									echo "❌";
								echo "</button>";
							echo "</form>";
						echo "</td>";
							echo "</tr>";
						}
					} else {
						echo "Lista Vazia";
					}
				?>
			</tbody>
		</table>
	</body>
</html>

<?php
	include_once($path.'/Controllers/carrinho_controller.php');

	if (isset($_POST['adicionar'])) {
		$objCarrinho = new Carrinho();
		$objCarrinho->setQuantidade(1);
		$objCarrinho->setUsuarioId($_POST['usuario_id']);
		$objCarrinho->setProdutoId($_POST['produto_id']);
	
		$controllerCarrinho = new CarrinhoController();
	
		$resposta = $controllerCarrinho->adicionaProduto($objCarrinho);
	
		if ($resposta == "Sucesso") {
			echo "Produto adicionado com sucesso";	
		} else {
			echo $resposta;
		}
	}

	if (isset($_POST['editar'])) {
		header("Location: http://localhost/ecommerce/Views/Produto/editar_produto.php?id={$_POST['produto_id']}");
	}

	if (isset($_POST['excluir'])) {	
		$resposta = $controllerProduto->excluirProduto($objProduto, $_POST['produto_id']);
	
		if ($resposta == "Sucesso") {	
			header("Location: http://localhost/ecommerce/Views/Produto/listagem_produtos.php?mensagem=Produto+excluído+com+sucesso");
		} else {
			echo $resposta;
		}
	}

	if (isset($_GET['mensagem'])) {
		echo $_GET['mensagem'];
	}
?>