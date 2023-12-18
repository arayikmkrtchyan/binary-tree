<?php

namespace Calculation\FieldIndex;

class AddToBinaryTree
{
	protected ?BinaryNode $root = null;

	public function add(?string $value, int $dataKey): void
	{
		if (is_null($value)) {
			return;
		}

		$node = new BinaryNode($value);
		$this->addNode($node, $dataKey, $this->root);
	}

	private function addNode(BinaryNode $node, int $dataKey, ?BinaryNode &$subtree): void
	{
		if (is_null($subtree)) {
			$subtree = $node;
			$subtree->addDataKey($dataKey);
		} else {
			if ($node->value < $subtree->value) {
				$this->addNode($node, $dataKey, $subtree->left);
			} elseif ($node->value > $subtree->value) {
				$this->addNode($node, $dataKey, $subtree->right);
			}else {
				$subtree->addDataKey($dataKey);
			}
		}
	}

	public function getRoot(): ?BinaryNode
	{
		return $this->root;
	}
}