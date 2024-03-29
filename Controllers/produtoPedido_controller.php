<?php
	$path = $_SERVER['DOCUMENT_ROOT'].'/ecommerce';
	include_once($path.'/Models/ProdutoPedido.php');

    class ProdutoPedidoController {
        public function criaRelacao($valorProduto, $produtoId, $pedidoId, $quantidadeProduto) {
            $objProdutoPedido = new ProdutoPedido();

            $objProdutoPedido->setValor($valorProduto);
            $objProdutoPedido->setProdutoId($produtoId);
            $objProdutoPedido->setPedidoId($pedidoId);
            $objProdutoPedido->setQuantidade($quantidadeProduto);

            return $objProdutoPedido->Criar();
        }

        public function listarProdutosPedido ($pedidoId) {
            $objProdutoPedido = new ProdutoPedido();

			return $objProdutoPedido->Listar($pedidoId);
		}
    }
?>