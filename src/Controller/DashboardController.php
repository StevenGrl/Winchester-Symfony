<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index()
    {
        return $this->render('dashboard/index.html.twig', [
            'themes' => [
                'Artistique' => [0 => 'palette', 1 => 'Bibliothèque de document artistiques !', 2 => 'home'],
                'Journalisme' => [0 => 'newspaper', 1 => 'Pleins de nouveaux articles régulièrement !', 2 => 'home'],
                'Administratif' => [0 => 'coffee', 1 => 'Gestion de l\'administration et recrutement !', 2 => 'home'],
                'E-Sport' => [0 => 'gamepad', 1 => 'Venez découvrir les équipes E-Sport et voir leurs games', 2 => 'home'],
                'Evenementiel' => [0 => 'calendar-alt', 1 => 'Venez vous renseigner sur tous les événements', 2 => 'home']
            ],
        ]);
    }
}
