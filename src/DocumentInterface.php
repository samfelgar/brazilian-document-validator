<?php

declare(strict_types=1);

namespace Samfelgar\BrazilianDocumentValidator;

interface DocumentInterface extends \Stringable
{
    public function isValid(): bool;

    public function format(): string;
}
