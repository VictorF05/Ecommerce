<?php
	$path = $_SERVER['DOCUMENT_ROOT'].'/ecommerce';
	include_once($path.'/Controllers/carrinho_controller.php');
	include_once($path.'/Controllers/pedido_controller.php');
	include_once($path.'/Controllers/usuario_controller.php');

	$controllerUsuario = new UsuarioController();

	$controllerUsuario->verificaLogin();

	session_start();
		
	$objCarrinho = new Carrinho();
	$controllerCarrinho = new CarrinhoController();
		
	$produtosCarrinho = $controllerCarrinho->listarProdutosCarrinho($objCarrinho, $_SESSION['usuario_id']);
?>

<html>
<body>
	<h1>Ecommerce - carrinho</h1>

	<a href="../Produto/listagem_produtos.php">Voltar</a>

	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Descrição</th>
				<th>Valor</th>
				<th>Quantidade</th>
				<th>Remover do carrinho</th>
			</tr>
		</thead>
		<tbody>
			<?php  
				if(!empty($produtosCarrinho)) {
					foreach($produtosCarrinho as $produtoCarrinho) {
						echo "<tr>";
							echo "<td>";
								echo $produtoCarrinho['ID'];
							echo "</td>";
							echo "<td>";
								echo $produtoCarrinho['Descricao'];
							echo "</td>";
							echo "<td>";
								echo $produtoCarrinho['Valor'];
							echo "</td>";
							echo "<td>";
								echo $produtoCarrinho['Quantidade'];
							echo "</td>";
							echo "<td>";
								echo "<form action='' method='post'>";
									echo "<input type='hidden' name='produtoCarrinho_id' value='".$produtoCarrinho['ID']."'>";
									echo "<button type='submit' name='remover'>";
										echo "-";
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
	<?php
		if (!empty($produtosCarrinho)) {
			$valorTotal = $controllerCarrinho->somaValorTotal($produtosCarrinho);

			echo "<p>";
				echo "Valor total: ".$valorTotal;
			echo "</p>";
			
			echo "<form action='' method='post'>";
				echo "<button type='submit' name='comprar'>";
					echo "Comprar";
				echo "</button>";
			echo "</form>";
		} 
	?>
</body>
</html>

<?php
	if (isset($_POST['remover'])) {	
		$resposta = $controllerCarrinho->removeProduto($objCarrinho, $_POST['produtoCarrinho_id']);
	
		if ($resposta == "Sucesso") {	
			header("Location: http://localhost/ecommerce/Views/Carrinho/listagem_produtos_carrinho.php?mensagem=Produto+removido+com+sucesso");
		} else {
			echo $resposta;
		}
	}

	if (isset($_GET['mensagem'])) {
		echo $_GET['mensagem'];
	}

	if (isset($_POST['comprar'])) {
		$objPedido = new Pedido();
		$objPedido->setUsuarioId($_SESSION['usuario_id']);

		$controllerPedido = new PedidoController();

		$resposta = $controllerPedido->criaPedido($objPedido);

		if ($resposta == "Sucesso") {
			header("Location: http://localhost/ecommerce/Views/Pedido/listagem_pedidos.php");
		} else {
			echo $resposta;
		}
	}
?>