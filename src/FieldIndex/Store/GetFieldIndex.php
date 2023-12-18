<?php

namespace Calculation\FieldIndex\Store;

use Calculation\FieldIndex\BinaryNode;
use RuntimeException;

final class GetFieldIndex extends FieldIndexAbstract
{
	public function get(string $name): BinaryNode
	{
		if(!file_exists($this->getFieldIndexPath($name))) {
			throw new RuntimeException("Index not generated for '$name' field");
		}

		$indexTreeEncoded = file_get_contents($this->getFieldIndexPath($name));
		return unserialize($indexTreeEncoded);
	}
}