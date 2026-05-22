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
        $output = null;
        $error = null;

        try {
            $printer = $this->factory->create($type);
            $output = $printer->print($message);
        } catch (\InvalidArgumentException $e) {
            $error = $e->getMessage();
        }

        return $this->render('printer_book/index.html.twig', [
            'controller_name' => 'PrinterBookController',
            'output' => $output,
            'error' => $error,
        ]);
    }
}
