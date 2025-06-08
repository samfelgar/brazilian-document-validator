<?php

declare(strict_types=1);

namespace Samfelgar\BrazilianDocumentValidator;

class Cpf implements DocumentInterface
{
    private readonly string $value;

    public function __construct(
        string $value,
    ) {
        $this->value = \preg_replace('/\D/', '', $value);
    }

    public function isValid(): bool
    {
        $value = $this->value;
        if (\strlen($value) !== 11 || \preg_match('/(\d)\1{10}/', $value) !== 0) {
            return false;
        }

        $valueWithoutDigits = \substr($value, 0, 9);
        $firstDigit = $this->calculateDigit($valueWithoutDigits);
        $secondDigit = $this->calculateDigit($valueWithoutDigits . $firstDigit);

        if ($value[9] !== (string)$firstDigit || $value[10] !== (string)$secondDigit) {
            return false;
        }

        return true;
    }

    private function calculateDigit(string $value): int
    {
        $sum = 0;
        for ($i = \strlen($value) - 1, $j = 2; $i >= 0; $i--, $j++) {
            $sum += (int)$value[$i] * $j;
        }
        $module = $sum % 11;
        return $module < 2 ? 0 : 11 - $module;
    }

    public function format(): string
    {
        return \preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $this->value);
    }

    public function __toString(): string
    {
        return $this->format();
    }
}
