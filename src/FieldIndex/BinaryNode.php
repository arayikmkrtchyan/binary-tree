<?php

namespace Calculation\FieldIndex;

class BinaryNode
{
	public ?string $value;
	public array $dataKeyList = [];
	public ?BinaryNode $left = null;
	public ?BinaryNode $right = null;

	public function __construct(?string $value)
	{
		$this->value = $value;
	}

	public function addDataKey(int $dataKey): void
	{
		$this->dataKeyList[] = $dataKey;
	}

	public function getDataKeyList(): array
	{
		return $this->dataKeyList;
	}

	public function __wakeup()
	{
		foreach (get_object_vars($this) as $k => $v) {
			$this->{$k} = $v;
		}
	}
}