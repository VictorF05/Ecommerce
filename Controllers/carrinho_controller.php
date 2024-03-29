<?php
	$path = $_SERVER['DOCUMENT_ROOT'].'/ecommerce';
	include_once($path.'/Models/Carrinho.php');
	include_once($path.'/Controllers/produto_controller.php');

	class CarrinhoController {
		public function adicionaProduto($objCarrinho) {
			$carrinho = $this->verificaSeJaExiste($objCarrinho);

			if ($carrinho) {
				$controllerProduto = new ProdutoController();

				$produto = $controllerProduto->getProduto($objCarrinho->getProdutoId());

				if ($this->verificaQuantidade($carrinho['Quantidade'], $produto['Quantidade'])){
					return $objCarrinho->AtualizarQuantidade($carrinho['Quantidade'], $carrinho['ID']);
				}
			} else {
				return $objCarrinho->Adicionar();
			}	
		}

		public function listarProdutosCarrinho ($objCarrinho, $usuarioId) {
			return $objCarrinho->Listar($usuarioId);
		}

		public function removeProduto($objCarrinho, $produtoCarrinhoId) {
			return $objCarrinho->Remover($produtoCarrinhoId);
		}

		public function removeTodosProdutos($objCarrinho, $usuarioId) {
			return $objCarrinho->RemoverTodos($usuarioId);
		}

		public function verificaSeJaExiste($objCarrinho) {
			return $objCarrinho->ListarPorUsuarioProdutoId($objCarrinho->getUsuarioId(), $objCarrinho->getProdutoId());
		}

		public function verificaQuantidade($quantidadeCarrinho, $quantidadeEstoque) {
			if ($quantidadeEstoque > $quantidadeCarrinho) {
				return true;
			} else {
				echo "Ops! Parece que você está tentando adicionar mais itens do que temos em estoque. Por favor, reveja a quantidade de itens no carrinho.";
				return false;
			}
		}

		public function somaValorTotal($produtosCarrinho) {
			$valorTotal = 0;

			foreach ($produtosCarrinho as $produtoCarrinho) {
				$valorTotal += $produtoCarrinho['Valor'] * $produtoCarrinho['Quantidade'];
			}

			return $valorTotal;
		}
	}
?>