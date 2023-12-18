<?php

namespace Calculation;

use Calculation\Document\GetDocument;
use Exception;
use JetBrains\PhpStorm\Pure;

class FindByConsistent implements FindInterface
{
	use CountTrait;

	private GetDocument $getDocument;

	#[Pure]
	public function __construct()
	{
		$this->getDocument = new GetDocument();
	}

	public function find(string $name, string $value): ?array
	{
		$resultList = null;
		try {
			$documentDataList = $this->getDocument->getData();

			foreach ($documentDataList as $data) {
				if (!array_key_exists($name, $data)) {
					continue;
				}

				$this->count++;
				if ($data[$name] === $value) {
					$resultList[] = $data;
				}
			}
		} catch (Exception $e) {
			echo $e->getMessage();
			die();
		}

		return $resultList;
	}
}