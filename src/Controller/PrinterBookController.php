<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Printer\PrinterFactory;

final class PrinterBookController extends AbstractController
{
    // Inyección de dependencias del PrinterFactory
    private PrinterFactory $factory;
    public function __construct(PrinterFactory $factory)
    {
        $this->factory = $factory;
    }

    #[Route('/')]
    public function index(): Response
    {
        return $this->render('printer_book/index.html.twig', [
            'controller_name' => 'PrinterBookController',
            'output' => null,
        ]);
    }

    #[Route('/print/{type}/{message}', name: "print")]
    public function print(string $type, string $message): Response
    {
        try {
            $printer = $this->factory->create($type);

            $output = $printer->print($message);
            return $this->render('printer_book/index.html.twig', [
                'controller_name' => 'PrinterBookController',
                'output' => $output,

            ]);
        } //capturar el error de tipo de impresora no existente
        catch (\InvalidArgumentException $e) {
            return new Response($e->getMessage(), 400);
        }
    }
}
