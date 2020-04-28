<?php declare(strict_types=1);

namespace EET;


/**
 * Class ClientFactory
 *
 * @author  geniv
 * @package EET
 */
class ClientFactory
{
    /** @var CertificateFactory */
    private $certificateFactory;
    /** @var string */
    private $service;
    /** @var bool */
    private $validate;


    /**
     * ClientFactory constructor.
     *
     * @param CertificateFactory $certificateFactory
     * @param string             $service
     * @param bool               $validate
     */
    public function __construct(CertificateFactory $certificateFactory, string $service, bool $validate)
    {
        $this->certificateFactory = $certificateFactory;
        $this->service = $service;
        $this->validate = $validate;
    }


    /**
     * Create.
     *
     * @return Dispatcher
     */
    public function create(): Dispatcher
    {
        $certificate = $this->certificateFactory->create();
        return new Dispatcher($certificate, $this->service, $this->validate);
    }


    /**
     * Create by certificate.
     *
     * @param CertificateFactory $certificateFactory for manual certificate factory
     * @return Dispatcher
     */
    public function createByCertificate(CertificateFactory $certificateFactory): Dispatcher
    {
        $certificate = $certificateFactory->create();
        return new Dispatcher($certificate, $this->service, $this->validate);
    }
}
