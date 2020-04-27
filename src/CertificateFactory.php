<?php declare(strict_types=1);

namespace EET;

use FilipSedivy;
use FilipSedivy\EET\Certificate;


/**
 * Class CertificateFactory
 *
 * @author  geniv
 * @package FilipSedivy\EET
 */
class CertificateFactory
{
    /** @var string */
    private $file;
    /** @var string */
    private $password;


    /**
     * CertificateFactory constructor.
     *
     * @param string $file
     * @param string $password
     */
    public function __construct(string $file, string $password)
    {
        $this->file = $file;
        $this->password = $password;
    }


    /**
     * Create.
     *
     * @return Certificate
     */
    public function create(): Certificate
    {
        return new Certificate($this->file, $this->password);
    }
}
