<?php
	$path = $_SERVER['DOCUMENT_ROOT'].'/ecommerce';
	include_once($path.'/Models/Produto.php');

	class ProdutoController {
		public function cadastraProduto ($objProduto) {
			if (
				$this->validaDescricao($objProduto->getDescricao()) && 
				$this->validaValor($objProduto->getValor()) && 
				$this->validaCategoria($objProduto->getCategoria()) && 
				$this->validaQuantidade($objProduto->getQuantidade())
				){
				return $objProduto->Cadastrar();
			}
		}

		public function editarProduto ($produtoId, $objProduto) {
			if (
				$this->validaDescricao($objProduto->getDescricao()) && 
				$this->validaValor($objProduto->getValor()) && 
				$this->validaCategoria($objProduto->getCategoria()) && 
				$this->validaQuantidade($objProduto->getQuantidade())
				){
				return $objProduto->Editar($produtoId);
			}
		}

		public function listarProdutos ($objProduto) {
			return $objProduto->Listar();
		}

		public function getProduto ($produtoId) {
			$objproduto = new Produto();

			return $objproduto->ListarPorId($produtoId);
		}

		public function atualizaEstoque ($produtoId, $quantidade, $operacao) {
			$produto = $this->getProduto($produtoId);

			if (!$produto) {
				return "Falha ao recuperar o produto";
			}

			if ($operacao == "soma") {
				$quantidadeAtual = $produto['Quantidade'] + $quantidade;
			} elseif ($operacao == "subtrai") {
				$quantidadeAtual = $produto['Quantidade'] - $quantidade;
			} else {
				return "Operação inválida";
			}

			$objProduto = new Produto();

			return $objProduto->AtualizarEstoque($produtoId, $quantidadeAtual);
		}

		public function validaDescricao ($descricao) {
			if ($descricao == null) {
				echo "A descrição é obrigatória";
				return false;
			} elseif (strlen($descricao) > 250) {
				echo "A descrição deve conter no máximo 250 caracteres";
				return false;
			}

			return true;
		}

		public function validaValor ($valor) {
			if ($valor == null) {
				echo "O valor é obrigatório";
				return false;
			} elseif (!is_numeric($valor)) {
				echo "Apenas números são permitidos para o valor";
				return false;
			} elseif ($valor < 0) {
				echo "O valor não pode ser menor que zero (0)";
				return false;
			}

			return true;
		}

		public function validaCategoria ($categoria) {
			if ($categoria == null) {
				echo "A categoria é obrigatória";
				return false;
			} elseif (strlen($categoria) > 100) {
				echo "A categoria deve conter no máximo 100 caracteres";
				return false;
			}

			return true;
		}

		public function validaQuantidade ($quantidade) {
			if ($quantidade == null) {
				echo "A quantidade é obrigatória";
				return false;
			} elseif (!is_numeric($quantidade)) {
				echo "Apenas números são permitidos para a quantidade";
				return false;
			} elseif ($quantidade < 0) {
				echo "A quantidade não pode ser menor que zero (0)";
				return false;
			}

			return true;
		}
	}
?>