<?php
	$path = $_SERVER['DOCUMENT_ROOT'].'/ecommerce';
	include_once($path.'/Controllers/pedido_controller.php');

	session_start();
		
	$objPedido = new Pedido();
	$controllerPedido = new PedidoController();
		
	$pedidos = $controllerPedido->listarPedidosUsuario($objPedido, $_SESSION['usuario_id']);
?>

<html>
<body>
	<h1>Ecommerce - listagem de pedidos</h1>
	<a href="../Produto/listagem_produtos.php">Voltar</a>

	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Valor</th>
				<th>Status</th>
				<th>Cancelar</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if(!empty($pedidos)) {
					foreach($pedidos as $pedido) {
						echo "<tr>";
							echo "<td>";
								echo $pedido['ID'];
							echo "</td>";
							echo "<td>";
								echo $pedido['Valor'];
							echo "</td>";
							echo "<td>";
								echo $pedido['Status'];
							echo "</td>";
							echo "<td>";
								echo "<form action='' method='post'>";
									echo "<input type='hidden' name='pedido_id' value='".$pedido['ID']."'>";
									echo "<button type='submit' name='cancelar'>";
										echo "x";
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
	if (isset($_POST['cancelar'])) {	
		$resposta = $controllerPedido->cancelarPedido($objPedido, $_POST['pedido_id']);
	
		if ($resposta == "Sucesso") {	
			header("Location: http://localhost/ecommerce/Views/Pedido/listagem_pedidos.php?mensagem=Pedido+cancelado+com+sucesso");
		} else {
			echo $resposta;
		}
	}

	if (isset($_GET['mensagem'])) {
		echo $_GET['mensagem'];
	}
?>