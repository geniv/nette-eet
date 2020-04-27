<?php declare(strict_types=1);

namespace EET;

use Exception;
use FilipSedivy;
use Nette\Utils\DateTime;
use Ramsey\Uuid\Uuid;


/**
 * Class Receipt
 *
 * @author  geniv
 * @package EET
 */
class Receipt extends FilipSedivy\EET\Receipt
{
    /**
     * Receipt constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->uuid_zpravy = Uuid::uuid4()->toString();
        $this->dat_trzby = new DateTime();
    }
}
