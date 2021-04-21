<?php

namespace App\Controller;

use App\Entity\Vip;
use App\Entity\User;
use App\Entity\Prono;
use App\Entity\Slider;
use App\Form\VipFormType;
use App\Form\PronoFormType;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    public function __construct(Security $security)
    {
        $this->user = $security->getUser();


    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index()
    {
        $sliderRepo = $this->getDoctrine()->getRepository(Slider::class);
        $slider = $sliderRepo->find(1);

        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'slider' => $slider
        ]);
    }

        /**
     * @Route("/dashboard/users", name="dashboard_users")
     */
    public function users()
    {
        $usersRepo = $this->getDoctrine()->getRepository(User::class);
        $sliderRepo = $this->getDoctrine()->getRepository(Slider::class);
        $slider = $sliderRepo->find(1);

        return $this->render('dashboard/users/list.html.twig', [
            'users' => $usersRepo->findbyroles(),
            'slider' => $slider
        ]);
    }

    /**
     * @Route("/dashboard/params", name="dashboard_params")
     */
    public function params(Request $request)
    {
        // $usersRepo = $this->getDoctrine()->getRepository(User::class);
        // $app['paypal'] = null;
        // $app['stripe'] = null;
        $session = new Session();
        $sliderRepo = $this->getDoctrine()->getRepository(Slider::class);
        $slider = $sliderRepo->find(1);

        if ($request->isMethod('POST')) {
            $session = new Session();
            $em = $this->getDoctrine()->getManager();


            if ($request->get('paypal')) {
                $session->set('paypal',$request->get('paypal'));
         

            }
            if ($request->get('stripe')) {
                $session->set('stripe',$request->get('stripe'));
           
            }

            if ($request->get('logo')) {
                if ($slider) {
                    $slider->setLogo($request->get('logo'));

                    $em->persist($slider);
                    $em->flush();
                } else {
                    $slider = new Slider();

                    $slider->setLogo($request->get('logo'));

                    $em->persist($slider);
                    $em->flush();
                }
            }

            if ($request->get('sld')) {
                if ($slider) {
                    $slider->setSld($request->get('sld'));

                    $em->persist($slider);
                    $em->flush();
                } else {
                    $slider = new Slider();

                    $slider->setSld($request->get('sld'));

                    $em->persist($slider);
                    $em->flush();
                }
            }


            return $this->redirectToRoute('home');
        
        }

        return $this->render('dashboard/params.html.twig', [
            'user' => $this->getUser(),
            'paypal' => $session->get('paypal'),
            'stripe' => $session->get('stripe'),
            'slider' => $slider
        ]);
    }

        /**
     * @Route("/dashboard/vip", name="dashboard_vip")
     */
    public function vip()
    {
        $vipRepo = $this->getDoctrine()->getRepository(Vip::class);
        $sliderRepo = $this->getDoctrine()->getRepository(Slider::class);
        $slider = $sliderRepo->find(1);

        return $this->render('dashboard/vip/list.html.twig', [
            'vips' => $vipRepo->findAll(),
            'slider' => $slider
        ]);
    }

        /**
     * @Route("/dashboard/vip/delete/{id<\d+>}", name="vip_delete")
     */
    public function vipDelete(Request $request, $id)
    {
        $vipsRepo = $this->getDoctrine()->getRepository(Vip::class);
        $vip = $vipsRepo->find($id);

        if (!$vip) {
            throw $this->createNotFoundException('No guest found');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($vip);
        $em->flush();


        $this->addFlash(
            'remove',
            'Le vip est supprimé !'
        );

        return $this->redirectToRoute('dashboard_vip');
    }

        /**
     * @Route("/dashboard/vip/add", name="vip_add")
     */
    public function vipAdd(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        // $vipsRepo = $this->getDoctrine()->getRepository(Vip::class);
        $vip = new Vip;
        $sliderRepo = $this->getDoctrine()->getRepository(Slider::class);
        $slider = $sliderRepo->find(1);

        // $vipForm = $this->createForm(VipFormType::class, $vip);

        // $vipForm->handleRequest($request);

        if ($request->isMethod('post')) {
            $vip->setTitle($request->get('title'));
            $vip->setDuree($request->get('duree'));
            $vip->setPrice($request->get('price'));
            $vip->setList($request->get('list'));
            $em->persist($vip);
            $em->flush();

            $this->addFlash(
                'remove',
                'Le vip est modifié !'
            );
            return $this->redirectToRoute('dashboard_vip');
        }

        return $this->render('dashboard/vip/vipAdd.html.twig', [
            'slider' => $slider
        ]);
    }

    /**
     * @Route("/dashboard/vip/edit/{id<\d+>}", name="vip_edit")
     */
    public function vipEdit(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $vipsRepo = $this->getDoctrine()->getRepository(Vip::class);
        $vip = $vipsRepo->find($id);
        $sliderRepo = $this->getDoctrine()->getRepository(Slider::class);
        $slider = $sliderRepo->find(1);

        // $vipForm = $this->createForm(VipFormType::class, $vip);

        // $vipForm->handleRequest($request);

        if ($request->isMethod('post')) {
            if ($request->get('title')) {
                $vip->setTitle($request->get('title'));
            }
            if ($request->get('duree')) {
                $vip->setDuree($request->get('duree'));
            }
            if ($request->get('price')) {
                $vip->setPrice($request->get('price'));
            }
            if ($request->get('list')) {
                $vip->setList([]);
                $vip->setList($request->get('list'));

            }

            $em->persist($vip);
            $em->flush();

            $this->addFlash(
                'remove',
                'Le vip est modifié !'
            );
            return $this->redirectToRoute('dashboard_vip');
        }

        return $this->render('dashboard/vip/vipEdit.html.twig', [
            'id' => $id,
            'slider' => $slider
        ]);
    }

    /**
     * @Route("/dashboard/pronos", name="dashboard_pronos")
     */
    public function pronos()
    {
        $pronosRepo = $this->getDoctrine()->getRepository(Prono::class);
        $sliderRepo = $this->getDoctrine()->getRepository(Slider::class);
        $slider = $sliderRepo->find(1);

        return $this->render('dashboard/pronos/list.html.twig', [
            'pronos' => $pronosRepo->findAll(),
            'slider' => $slider
        ]);
    }

    /**
     * @Route("/dashboard/prono/delete/{id<\d+>}", name="prono_delete")
     */
    public function pronoDelete(Request $request, $id)
    {
        $pronosRepo = $this->getDoctrine()->getRepository(Prono::class);
        $prono = $pronosRepo->find($id);

        if (!$prono) {
            throw $this->createNotFoundException('No guest found');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($prono);
        $em->flush();


        $this->addFlash(
            'remove',
            'Le pronostic est supprimé !'
        );

        return $this->redirectToRoute('dashboard_pronos');
    }

        /**
     * @Route("/dashboard/prono/add", name="prono_add")
     */
    public function pronoAdd(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $sliderRepo = $this->getDoctrine()->getRepository(Slider::class);
        $slider = $sliderRepo->find(1);

        // $pronosRepo = $this->getDoctrine()->getRepository(Prono::class);
        $prono = new Prono;


        $pronoForm = $this->createForm(PronoFormType::class, $prono);

        $pronoForm->handleRequest($request);

        if ($pronoForm->isSubmitted() && $pronoForm->isValid()) {
            $prono->setCreatedAt(new DateTime());
            $em->persist($prono);
            $em->flush();

            $this->addFlash(
                'remove',
                'Le pronostic a été créé !'
            );
            return $this->redirectToRoute('dashboard_pronos');
        }

        return $this->render('dashboard/pronos/pronoAdd.html.twig', [
            'prono_form' => $pronoForm->createView(),
            'slider' => $slider
        ]);
    }

    /**
     * @Route("/dashboard/prono/edit/{id<\d+>}", name="prono_edit")
     */
    public function pronoEdit(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $sliderRepo = $this->getDoctrine()->getRepository(Slider::class);
        $slider = $sliderRepo->find(1);

        $pronosRepo = $this->getDoctrine()->getRepository(Prono::class);
        $prono = $pronosRepo->find($id);

        $pronoForm = $this->createForm(PronoFormType::class, $prono);

        $pronoForm->handleRequest($request);

        if ($pronoForm->isSubmitted() && $pronoForm->isValid()) {
            $em->persist($prono);
            $em->flush();

            $this->addFlash(
                'remove',
                'Le pronostic est modifié !'
            );
            return $this->redirectToRoute('dashboard_pronos');
        }

        return $this->render('dashboard/pronos/pronoEdit.html.twig', [
            'prono_form' => $pronoForm->createView(),
            'slider' => $slider
        ]);
    }
}
