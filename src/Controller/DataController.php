<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DataController extends AbstractController
{
    #[Route('showValue', name: 'SHOW_VALUE')]
    public function showValue(): Response
    {
        $maxValue = $this->getMaxValue();

        return $this->render('data.html.twig', [
            'max_value' => $maxValue,
        ]);
    }

    #[Route('/data')]
    public function getDataFromFile(): array
    {
        $file = file_get_contents('/home/noa/PhpstormProjects/AdventsOfCode/Day1/src/data.txt');

        return explode("\n\n", $file);
    }

    #[Route('/modifyData')]
    public function getMaxValue(): int
    {
        $file = $this->getDataFromFile();

        $array = [];
        $sum = [];

        foreach ($file as $key => $data) {
            $array[$key] = preg_split("/\s/", $data);
            $sum[$key] = array_sum($array[$key]);
        }
        return max($sum);
    }
}