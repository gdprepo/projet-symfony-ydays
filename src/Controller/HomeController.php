<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */

    public function index(): Response
    {
        $slider = "";
        $pronos = "";
        $vip = "";

        return $this->render('home/index.html.twig', [
            'controller_name' => "HOME",
            'sliders' => $slider,
        ]);
    }

    /**
     * @Route("/vip", name="vip_show")
     */

    public function vipShow(): Response
    {
        $slider = "";
        $pronos = "";
        $vip = "";

        return $this->render('home/vip/show.html.twig', [
            'controller_name' => "HOME",
            'sliders' => $slider,
        ]);
    }

        /**
     * @Route("/pronos", name="prono_show")
     */

    public function pronoShow(): Response
    {
        $slider = "";
        $pronos = "";
        $vip = "";

        return $this->render('home/pronos/show.html.twig', [
            'controller_name' => "HOME",
            'sliders' => $slider,
        ]);
    }
}
