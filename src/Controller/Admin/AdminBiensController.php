<?php

namespace App\Controller\Admin;

use App\Entity\Biens;
use App\Form\BienType;
use App\Repository\BiensRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminBiensController extends AbstractController
{

    /**
     * @var BiensRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(BiensRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin", name="admin.biens.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $biens = $this->repository->findAll();
        return $this->render('admin/biens/index.html.twig', compact('biens'));
    }

    /**
     * @Route("/admin/biens/create", name="admin.biens.new")
     */
    public function new(Request $request)
    {
        $biens = new Biens();
        $form = $this->createForm(BienType::class, $biens);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($biens);
            $this->em->flush();
            $this->addFlash('success', 'Bien créé avec succès');
            return $this->redirectToRoute('admin.biens.index');
        }

        return $this->render('admin/biens/new.html.twig', [
            'biens' => $biens,
            'form'     => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/biens/{id}", name="admin.biens.edit", methods="GET|POST")
     * @param Biens $biens
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Biens $biens, Request $request)
    {
        $form = $this->createForm(BienType::class, $biens);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succès');
            return $this->redirectToRoute('admin.biens.index');
        }

        return $this->render('admin/biens/edit.html.twig', [
            'biens' => $biens,
            'form'     => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/biens/{id}", name="admin.biens.delete", methods="DELETE")
     * @param Biens $biens
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Biens $biens, Request $request) {
        if ($this->isCsrfTokenValid('delete' . $biens->getId(), $request->get('_token'))) {
            $this->em->remove($biens);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succès');
        }
        return $this->redirectToRoute('admin.biens.index');
    }

}
