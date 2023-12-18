<?php

namespace Calculation\FieldIndex\Store;

use Calculation\FieldIndex\BinaryNode;
use RuntimeException;

final class SaveFieldIndex extends FieldIndexAbstract
{
	public function save(string $name, ?BinaryNode $index): void
	{
		if (is_null($index)) {
			throw new RuntimeException("Name by '$name' not found in document");
		}

		$encodedData = serialize($index);
		file_put_contents($this->getFieldIndexPath($name), $encodedData);
	}
}