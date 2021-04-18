<?php


namespace Madsis\Core\Generators;

use Madsis\Sales\Models\Order;

class OrderNumberIdSequencer implements Sequencer
{
    /**
     * @inheritDoc
     */
    public static function generate(): string
    {
        $lastOrder = Order::query()->orderBy('ORDID', 'desc')->limit(1)->first();
        $lastId = $lastOrder ? $lastOrder->ORDNUMERO : 0;
        $invoiceNumber = $lastId + 1;
        return $invoiceNumber;
    }
}