<?php

namespace Calculation;

use Calculation\Document\GetDocument;
use Calculation\FieldIndex\AddToBinaryTree;
use Calculation\FieldIndex\Store\SaveFieldIndex;
use Exception;
use JetBrains\PhpStorm\Pure;

class GenerateDocumentFieldIndex
{
	private GetDocument $getDocument;
	private AddToBinaryTree $addToBinaryTree;
	private SaveFieldIndex $saveFieldIndex;

	#[Pure]
	public function __construct()
	{
		$this->getDocument = new GetDocument();
		$this->addToBinaryTree = new AddToBinaryTree();
		$this->saveFieldIndex = new SaveFieldIndex();
	}

	public function generate(string $name): void
	{
		try {
			$documentDataList = $this->getDocument->getData();

			foreach ($documentDataList as $dataKey => $data) {
				if (!array_key_exists($name, $data) || !is_string($data[$name])) {
					continue;
				}

				$this->addToBinaryTree->add($data[$name], $dataKey);
			}

			$this->saveFieldIndex->save($name, $this->addToBinaryTree->getRoot());
		} catch (Exception $e) {
			echo $e->getMessage();
			die();
		}
	}
}