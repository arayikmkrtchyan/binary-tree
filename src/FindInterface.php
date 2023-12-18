<?php

namespace Calculation;

interface FindInterface
{
	public function find(string $name, string $value): ?array;
}