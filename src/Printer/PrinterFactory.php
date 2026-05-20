<?php
// src/Printer/PrinterFactory.php
namespace App\Printer;

use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

class PrinterFactory
{
    /**
     * @param iterable<PrinterInterface> $printers
     */
    public function __construct(
        #[TaggedIterator('app.printer')]
        private iterable $printers
    ) {}

    public function create(string $type): PrinterInterface
    {
        foreach ($this->printers as $printer) {
            if ($printer->supports() === $type) {
                return $printer;
            }
        }

        throw new \InvalidArgumentException("Printer '$type' no existe");
    }
}
