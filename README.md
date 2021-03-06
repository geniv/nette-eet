EET
===

via:
- https://github.com/contributte/eet
- https://www.etrzby.cz/cs/technicka-specifikace (Formát a struktura údajů o evidované tržbě a popis datového rozhraní pro příjem datových zpráv evidovaných tržeb)

Installation
------------
```sh
$ composer require geniv/nette-eet
```
or
```json
"geniv/nette-eet": "^1.0"
```

require:
```json
"php": ">=7.0",
"nette/di": ">=2.4",
"filipsedivy/php-eet": ">=4.2"
```

Include in application
----------------------
neon configure:
```neon
extensions:
    eet: EET\Bridges\Nette\Extension
```

neon configure extension:
```neon
eet:
  certificate:
    file: %appDir%/../eet.p12
    password: my-password

  dispatcher:
    # Dispatcher setting
    service: production / playground
    validate: true / false

  receipt:
    # Set default receipt values
    id_pokl: 19903
    dic_popl: CZ00000019
    id_provoz: 11
```

usage:
```php
use EET;
use FilipSedivy;
use Nette;

final class SomePresenter extends Nette\Application\UI\Presenter
{
    /** @var EET\Dispatcher */
    private $client;

    /** @var EET\ReceiptFactory */
    private $receiptFactory;

    public function processPayment()
    {
        $receipt = $this->receiptFactory->create();
        $receipt->porad_cis = '1';
        $receipt->celk_trzba = 500;

        try {
            $client = $this->client->create();
            //$client = $this->client->createByCertificate( new CertificateFactory(__DIR__ . '/../../vendor/filipsedivy/php-eet/tests/data/EET_CA1_Playground-CZ00000019.p12', 'eet'));
            $client->send($receipt);

            $this->payment->eet->save_success($client->getFik(), $client->getPkp());

        } catch (FilipSedivy\EET\Exceptions\EET\ClientException $clientException) {
            $this->payment->eet->save_error($clientException->getPkp(), $clientException->getBkp());

        }  catch (FilipSedivy\EET\Exceptions\EET\ErrorException $errorException) {
            echo '(' . $errorException->getCode() . ') ' . $errorException->getMessage();

        } catch(FilipSedivy\EET\Exceptions\Receipt\ConstraintViolationException $constraintViolationException){
            echo implode('<br>', $constraintViolationException->getErrors());
        }
    }
}
```
