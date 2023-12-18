<?php

namespace Calculation;

use Calculation\Document\GetDocument;
use Calculation\FieldIndex\SearchInBinaryTree;
use Calculation\FieldIndex\Store\GetFieldIndex;
use Exception;
use JetBrains\PhpStorm\Pure;

class FindByIndex implements FindInterface
{
	use CountTrait;

	private GetDocument $getDocument;
	private GetFieldIndex $getFieldIndex;
	private SearchInBinaryTree $searchInBinaryTree;

	#[Pure]
	public function __construct()
	{
		$this->getDocument = new GetDocument();
		$this->searchInBinaryTree = new SearchInBinaryTree();
		$this->getFieldIndex = new GetFieldIndex();
	}

	public function find(string $name, string $value): ?array
	{
		$resultList = null;
		try {
			$indexTree = $this->getFieldIndex->get($name);
			$indexNode = $this->searchInBinaryTree->search($value, $indexTree);

			$this->count = $this->searchInBinaryTree->getCount();

			if (!is_null($indexNode)) {
				$dataKeyList = $indexNode->getDataKeyList();
				$documentDataList = $this->getDocument->getData();

				foreach($dataKeyList as $dataKey) {
					if(array_key_exists($dataKey, $documentDataList)) {
						$resultList[] = $documentDataList[$dataKey];
					}
				}
			}
		} catch (Exception $e) {
			echo $e->getMessage();
			die();
		}

		return $resultList;
	}
}