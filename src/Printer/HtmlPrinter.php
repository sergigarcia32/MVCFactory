<?php
// src/Printer/HtmlPrinter.php
namespace App\Printer;

class HtmlPrinter implements PrinterInterface
{
    public function supports(): string
    {
        return 'html';
    }

    public function print(string $content): string
    {
        return "
<html>

<body>
    <h1>HTML Printer</h1>
    <p>{$content}</p>
</body>

</html>
";
    }
}
