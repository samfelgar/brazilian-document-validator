# Brazilian Document Validator

## Installation

```bash
composer require samfelgar/brazilian-document-validator
```

## Usage

For CPF's:

```php
<?php

use \Samfelgar\BrazilianDocumentValidator\Cpf; 

$cpf = new Cpf('78367532554'); // or new Cpf('783.675.325-54')

if ($cpf->isValid()) {
    echo 'valid';
} else {
    echo 'invalid';
}

echo $cpf->format(); // prints 783.675.325-54
echo (string)$cpf; // also prints 783.675.325-54
```

For CNPJ's:

```php
<?php

use \Samfelgar\BrazilianDocumentValidator\Cnpj; 

$cnpj = new Cnpj('26942261000114'); // or new Cnpj('26.942.261/0001-14')

if ($cnpj->isValid()) {
    echo 'valid';
} else {
    echo 'invalid';
}

echo $cnpj->format(); // prints 26.942.261/0001-14
echo (string)$cnpj; // also prints 26.942.261/0001-14
```