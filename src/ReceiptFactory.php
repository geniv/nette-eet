<?php declare(strict_types=1);

namespace EET;


/**
 * Class ReceiptFactory
 *
 * @author  geniv
 * @package EET
 */
class ReceiptFactory
{
    /** @var array */
    private $params;


    /**
     * ReceiptFactory constructor.
     *
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }


    /**
     * Create.
     *
     * @return Receipt
     */
    public function create(): Receipt
    {
        $receipt = new Receipt();

        foreach ($this->params as $property => $value) {
            if ($value !== null && is_string($property) && property_exists($receipt, $property)) {
                $receipt->{$property} = $value;
            }
        }
        return $receipt;
    }
}
