<?php

declare(strict_types=1);

namespace Samfelgar\BrazilianDocumentValidator\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Samfelgar\BrazilianDocumentValidator\Cnpj;
use PHPUnit\Framework\TestCase;

#[CoversClass(Cnpj::class)]
class CnpjTest extends TestCase
{
    #[Test]
    #[DataProvider('itCanValidateACnpjProvider')]
    public function itCanValidateACnpj(string $value, bool $valid): void
    {
        $this->assertEquals($valid, (new Cnpj($value))->isValid());
    }

    public static function itCanValidateACnpjProvider(): array
    {
        return [
            ['11111111111111', false],
            ['22222222222222', false],
            ['33333333333333', false],
            ['44444444444444', false],
            ['55555555555555', false],
            ['66666666666666', false],
            ['77777777777777', false],
            ['88888888888888', false],
            ['99999999999999', false],
            ['00000000000000', false],
            ['14215', false],
            ['14215118', false],
            ['14215118000141', true],
            ['76332736000129', true],
            ['86623398000138', true],
            ['75735856000104', true],
            ['14.215.118/0001-41', true],
            ['76.332.736/0001-29', true],
            ['86.623.398/0001-38', true],
            ['75.735.856/0001-04', true],
            ['75735856000114', false],
            ['75735856000105', false],
        ];
    }

    #[Test]
    #[DataProvider('validCnpjs')]
    public function itCanFormatACnpj(string $value, string $expected): void
    {
        $cnpj = new Cnpj($value);
        $this->assertEquals($expected, $cnpj->format());
    }

    #[Test]
    #[DataProvider('validCnpjs')]
    public function itCanCastToAString(string $value, string $expected): void
    {
        $cnpj = new Cnpj($value);
        $this->assertEquals($expected, (string)$cnpj);
    }

    public static function validCnpjs(): array
    {
        return [
            ['26942261000114', '26.942.261/0001-14'],
            ['93382661000100', '93.382.661/0001-00'],
            ['31008392000169', '31.008.392/0001-69'],
            ['14181565000127', '14.181.565/0001-27'],
            ['27881942000182', '27.881.942/0001-82'],
            ['41438569000110', '41.438.569/0001-10'],
            ['15955886000102', '15.955.886/0001-02'],
        ];
    }
}
