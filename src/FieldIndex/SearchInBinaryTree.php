<?php

namespace Calculation\FieldIndex;

use Calculation\CountTrait;
use RuntimeException;

class SearchInBinaryTree
{
	use CountTrait;

	public function search(string $value, ?BinaryNode $subtree): ?BinaryNode
	{
		if (is_null($subtree)) {
			return null;
		}

		$this->count++;
		if ($subtree->value > $value) {
			return $this->search($value, $subtree->left);
		}

		if ($subtree->value < $value) {
			return $this->search($value, $subtree->right);
		}

		return $subtree;
	}
}