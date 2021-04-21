<?php

namespace App\Controller;

use DateTime;
use App\Entity\Vip;
use App\Entity\Prono;
use App\Entity\Slider;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class HomeController extends AbstractController
{
    public function __construct(Security $security)
    {
        $this->user = $security->getUser();

        if ($this->user ) {
            $date = new DateTime('now');

            if ($this->user->getdateSub()) {
                if ($this->user->getdateSub()->format('Y-m-d') == $date->format('Y-m-d')) {
                    $this->user->setRoles([]);
                    $this->user->setDateSub(null);
                }
            }
        }

    }

    /**
     * @Route("/home", name="home")
     */

    public function index(): Response
    {
        $pronosRepo = $this->getDoctrine()->getRepository(Prono::class);

        $sliderRepo = $this->getDoctrine()->getRepository(Slider::class);
        $slider = $sliderRepo->find(1);

        return $this->render('home/index.html.twig', [
            'controller_name' => "HOME",
            'pronos' => $pronosRepo->findAll(),
            'slider' => $slider
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
        $sliderRepo = $this->getDoctrine()->getRepository(Slider::class);
        $slider = $sliderRepo->find(1);

        return $this->render('home/vip/show.html.twig', [
            'controller_name' => "HOME",
            'sliders' => $slider,
            'sub' => $sub->findAll(),
            'slider' => $slider

        ]);
    }

        /**
     * @Route("/pronos", name="prono_all")
     */

    public function pronoAll(): Response
    {
        $slider = "";
        $pronosRepo = $this->getDoctrine()->getRepository(Prono::class);
        $sliderRepo = $this->getDoctrine()->getRepository(Slider::class);
        $slider = $sliderRepo->find(1);

        return $this->render('home/pronos/all.html.twig', [
            'controller_name' => "HOME",
            'pronos' => $pronosRepo->findAll(array('date'=>'asc')),
            'slider' => $slider,
            'now' => new Datetime('now')
        ]);
    }

            /**
     * @Route("/prono/{id}", name="prono_show")
     */

    public function pronoFind($id): Response
    {
        $slider = "";
        $pronosRepo = $this->getDoctrine()->getRepository(Prono::class);
        $sliderRepo = $this->getDoctrine()->getRepository(Slider::class);
        $slider = $sliderRepo->find(1);

        return $this->render('home/pronos/show.html.twig', [
            'controller_name' => "HOME",
            'prono' => $pronosRepo->find($id),
            'slider' => $slider
        ]);
    }
}
