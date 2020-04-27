<?php declare(strict_types=1);

namespace EET\Bridges\Nette;

use EET\CertificateFactory;
use EET\ClientFactory;
use EET\Dispatcher;
use EET\ReceiptFactory;
use Nette\DI\CompilerExtension;


/**
 * Class Extension
 *
 * Hard copy rewrite to component NETTE 2.5
 *
 * @see https://github.com/contributte/eet
 *
 * @author  geniv
 * @package EET\Bridges\Nette
 */
class Extension extends CompilerExtension
{
    /** @var array default values */
    private $defaults = [
        'certificate' => [
            'file'     => '',
            'password' => '',
        ],
        'dispatcher'  => [
            'service'  => Dispatcher::PLAYGROUND_SERVICE,
            'validate' => true,
        ],
        'receipt'     => [],
    ];


    /**
     * Load configuration.
     */
    public function loadConfiguration()
    {
        $builder = $this->getContainerBuilder();
        $config = $this->validateConfig($this->defaults);

        // certificate factory
        $builder->addDefinition($this->prefix('certificateFactory'))
            ->setFactory(CertificateFactory::class, [
                $config['certificate']['file'],
                $config['certificate']['password'],
            ]);

        // client factory
        $builder->addDefinition($this->prefix('clientFactory'))
            ->setFactory(ClientFactory::class, [
                $this->prefix('@certificateFactory'),
                $config['dispatcher']['service'],
                $config['dispatcher']['validate'],
            ]);

        // receipt factory
        $builder->addDefinition($this->prefix('receiptFactory'))
            ->setFactory(ReceiptFactory::class, [
                $config['receipt'],
            ]);
    }
}
