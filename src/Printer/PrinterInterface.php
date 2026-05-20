<?php

namespace App\Printer;

interface PrinterInterface
{
    public function supports(): string;
    public function print(string $content): string;
}
