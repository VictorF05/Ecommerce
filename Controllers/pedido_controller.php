<?php
	$path = $_SERVER['DOCUMENT_ROOT'].'/ecommerce';
	include_once($path.'/Models/Pedido.php');
    include_once($path.'/Controllers/carrinho_controller.php');
    include_once($path.'/Controllers/produtoPedido_controller.php');
    include_once($path.'/Controllers/produto_controller.php');

    class PedidoController {
        public function criaPedido($objPedido) {
            $objCarrinho = new Carrinho();
            $controllerCarrinho = new CarrinhoController();
                
            $produtosCarrinho = $controllerCarrinho->listarProdutosCarrinho($objCarrinho, $objPedido->getUsuarioId());

            if(empty($produtosCarrinho)) {
                return "Erro: o carrinho está vazio";
            }

            $valorTotal = $controllerCarrinho->somaValorTotal($produtosCarrinho);

            $objPedido->setValor($valorTotal);
            $objPedido->setStatus("Pedido efetuado");

            $pedidoId = $objPedido->Criar();

            if (!$pedidoId) {
                return "Erro ao criar o pedido";
            }

            $controllerProdutoPedido = new ProdutoPedidoController();

            foreach ($produtosCarrinho as $produtoCarrinho) {
                $resposta = $controllerProdutoPedido->criaRelacao($produtoCarrinho['Valor'], $produtoCarrinho['Produto_id'], $pedidoId, $produtoCarrinho['Quantidade']);

                if($resposta == "Erro" || !$resposta) {
                    return "Erro ao criar a relação entre produto e pedido";
                }
            }

            $resposta = $controllerCarrinho->removeTodosProdutos($objCarrinho, $objPedido->getUsuarioId());

            if ($resposta == "Erro" || !$resposta) {
                return "Erro ao remover item do carrinho";
            }

            $controllerProduto = new ProdutoController();

            foreach ($produtosCarrinho as $produtoCarrinho) {
                $resposta = $controllerProduto->atualizaEstoque($produtoCarrinho['Produto_id'], $produtoCarrinho['Quantidade'], "subtrai");

                if($resposta == "Erro" || !$resposta) {
                    return "Erro ao atualizar estoque do produto";
                }
            }

            return "Sucesso";
        }

        public function listarPedidosUsuario ($objPedido, $usuarioId) {
			return $objPedido->Listar($usuarioId);
		}

		public function getPedido ($pedidoId) {
			$objPedido = new Pedido();

			return $objPedido->ListarPorId($pedidoId);
		}

        public function cancelarPedido($objPedido, $pedidoId) {
            $pedido = $this->getPedido($pedidoId);

            if ($pedido['Status'] == "Pedido cancelado") {
                return "Erro: o pedido já foi cancelado!";
            }

			$resposta = $objPedido->Cancelar($pedidoId);

            if ($resposta == "Erro" || !$resposta) {
                return "Erro ao cancelar pedido";
            }

            $controllerProdutoPedido = new ProdutoPedidoController();

            $produtosPedido = $controllerProdutoPedido->listarProdutosPedido($pedidoId);

            if(empty($produtosPedido)) {
                return "Erro: o pedido está vazio";
            }

            $controllerProduto = new ProdutoController();

            foreach ($produtosPedido as $produtoPedido) {
                $resposta = $controllerProduto->atualizaEstoque($produtoPedido['Produto_id'], $produtoPedido['Quantidade'], "soma");

                if($resposta == "Erro" || !$resposta) {
                    return "Erro ao atualizar estoque do produto";
                }
            }

            return "Sucesso";
		}
    }
?>