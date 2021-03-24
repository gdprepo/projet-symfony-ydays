<?php

namespace App\Controller;

use App\Entity\Vip;
use App\Entity\Prono;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */

    public function index(): Response
    {
        $slider = "";
        $pronosRepo = $this->getDoctrine()->getRepository(Prono::class);
        $vip = "";

        return $this->render('home/index.html.twig', [
            'controller_name' => "HOME",
            'pronos' => $pronosRepo->findAll(),
        ]);
    }

    /**
     * @Route("/vip", name="vip_show")
     */

    public function vipShow(): Response
    {
        $slider = "";
        $pronos = "";
        $sub = $this->getDoctrine()->getRepository(Vip::class);

        return $this->render('home/vip/show.html.twig', [
            'controller_name' => "HOME",
            'sliders' => $slider,
            'sub' => $sub->findAll(),
        ]);
    }

        /**
     * @Route("/pronos", name="prono_all")
     */

    public function pronoAll(): Response
    {
        $slider = "";
        $pronosRepo = $this->getDoctrine()->getRepository(Prono::class);

        $vip = "";

        return $this->render('home/pronos/all.html.twig', [
            'controller_name' => "HOME",
            'pronos' => $pronosRepo->findAll(),
        ]);
    }

            /**
     * @Route("/prono/{id}", name="prono_show")
     */

    public function pronoFind($id): Response
    {
        $slider = "";
        $pronosRepo = $this->getDoctrine()->getRepository(Prono::class);

        $vip = "";

        return $this->render('home/pronos/show.html.twig', [
            'controller_name' => "HOME",
            'prono' => $pronosRepo->find($id),
        ]);
    }
}
