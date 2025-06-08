<?php

declare(strict_types=1);

namespace Samfelgar\BrazilianDocumentValidator\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Samfelgar\BrazilianDocumentValidator\Cpf;
use PHPUnit\Framework\TestCase;

#[CoversClass(Cpf::class)]
class CpfTest extends TestCase
{
    #[Test]
    #[DataProvider('itCanValidateACpfProvider')]
    public function itCanValidateACpf(string $value, bool $valid): void
    {
        $cpf = new Cpf($value);
        $this->assertEquals($valid, $cpf->isValid());
    }

    public static function itCanValidateACpfProvider(): array
    {
        return [
            ['11111111111', false],
            ['22222222222', false],
            ['33333333333', false],
            ['44444444444', false],
            ['55555555555', false],
            ['66666666666', false],
            ['77777777777', false],
            ['88888888888', false],
            ['99999999999', false],
            ['00000000000', false],
            ['000', false],
            ['037014', false],
            ['78367532554', true],
            ['50686455754', true],
            ['65982354805', true],
            ['783.675.325-54', true],
            ['506.864.557-54', true],
            ['659.823.548-05', true],
            ['65982354815', false],
            ['65982354806', false],
        ];
    }

    #[Test]
    #[DataProvider('validCpfProvider')]
    public function itCanFormatACpf(string $value, string $expected): void
    {
        $cpf = new Cpf($value);
        $this->assertEquals($expected, $cpf->format());
    }

    #[Test]
    #[DataProvider('validCpfProvider')]
    public function itCanCastToAString(string $value, string $expected): void
    {
        $cpf = new Cpf($value);
        $this->assertEquals($expected, (string)$cpf);
    }

    public static function validCpfProvider(): array
    {
        return [
            ['78367532554', '783.675.325-54'],
            ['50686455754', '506.864.557-54'],
            ['65982354805', '659.823.548-05'],
            ['39055724009', '390.557.240-09'],
            ['70494259582', '704.942.595-82'],
            ['13607684324', '136.076.843-24'],
        ];
    }

    #[Test]
    #[DataProvider('itCanReturnTheNormalizedValueProvider')]
    public function itCanReturnTheNormalizedValue(string $value, string $expected): void
    {
        $cpf = new Cpf($value);
        $this->assertEquals($expected, $cpf->getValue());
    }

    public static function itCanReturnTheNormalizedValueProvider(): array
    {
        return [
            ['78367532554', '78367532554'],
            ['50686455754', '50686455754'],
            ['65982354805', '65982354805'],
            ['39055724009', '39055724009'],
            ['70494259582', '70494259582'],
            ['13607684324', '13607684324'],

            ['783.675.325-54', '78367532554'],
            ['506.864.557-54', '50686455754'],
            ['659.823.548-05', '65982354805'],
            ['390.557.240-09', '39055724009'],
            ['704.942.595-82', '70494259582'],
            ['136.076.843-24', '13607684324'],
        ];
    }
}
