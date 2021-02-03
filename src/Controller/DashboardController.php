<?php

namespace App\Controller;

use App\Entity\Prono;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index()
    {
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    /**
     * @Route("/dashboard/pronos", name="dashboard_pronos")
     */
    public function pronos()
    {
        $pronosRepo = $this->getDoctrine()->getRepository(Prono::class);

        return $this->render('dashboard/pronos/list.html.twig', [
            'pronos' => $pronosRepo->findAll(),
        ]);
    }
}
