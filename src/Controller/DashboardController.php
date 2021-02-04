<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Prono;
use App\Form\PronoFormType;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/dashboard/users", name="dashboard_users")
     */
    public function users()
    {
        $usersRepo = $this->getDoctrine()->getRepository(User::class);

        return $this->render('dashboard/users/list.html.twig', [
            'users' => $usersRepo->findbyroles(),
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

        // $pronosRepo = $this->getDoctrine()->getRepository(Prono::class);
        $prono = new Prono;

        $pronoForm = $this->createForm(PronoFormType::class, $prono);

        $pronoForm->handleRequest($request);

        if ($pronoForm->isSubmitted() && $pronoForm->isValid()) {

            $em->persist($prono);
            $em->flush();

            $this->addFlash(
                'remove',
                'Le pronostic a été créé !'
            );
            return $this->redirectToRoute('dashboard_pronos');
        }

        return $this->render('dashboard/pronos/pronoAdd.html.twig', [
            'prono_form' => $pronoForm->createView()

        ]);
    }

    /**
     * @Route("/dashboard/prono/edit/{id<\d+>}", name="prono_edit")
     */
    public function pronoEdit(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

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
            'prono_form' => $pronoForm->createView()

        ]);
    }
}
