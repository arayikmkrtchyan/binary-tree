<?php

namespace Calculation\Document;

use JsonException;

final class GetDocument
{
	private string $documentPath;

	public function __construct()
	{
		$this->documentPath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'docs'
			. DIRECTORY_SEPARATOR . "documents.json";
	}

	/**
	 * @throws JsonException
	 */
	public function getData(): array
	{
		$documentDataEncoded = file_get_contents($this->documentPath);

		return json_decode($documentDataEncoded, true, 512, JSON_THROW_ON_ERROR);
	}
}