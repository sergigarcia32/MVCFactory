<?php
// src/Printer/TextPrinter.php
namespace App\Printer;

class TextPrinter implements PrinterInterface
{
public function supports(): string
{
return 'text';
}

public function print(string $content): string
{
return $content;
}
}