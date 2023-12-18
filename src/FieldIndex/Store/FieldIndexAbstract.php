<?php

namespace Calculation\FieldIndex\Store;

abstract class FieldIndexAbstract
{
	private string $indexPath;

	public function __construct()
	{
		$this->indexPath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'storage'
			. DIRECTORY_SEPARATOR . 'indexes' . DIRECTORY_SEPARATOR;
	}

	protected function getFieldIndexPath(string $fieldName): string
	{
		return $this->indexPath . $fieldName;
	}
}