<?php

namespace App\Controller\Admin;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\BiensRepository;
use App\Entity\Biens;
use App\Form\BienType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;




class AdminBiensController extends AbstractController

{
    /**
     * @var @BienRepository
     */
    private $repository;

    public function __construct(BiensRepository $repository,  ObjectManager $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
      
    }

    /**
     * @Route("/admin", name="admin.bien.index")
     */
    public function index(BiensRepository $repository)
    {
        $bien = $repository->findAll();
        return $this->render('admin/biens/index.html.twig', [
            'biens' => $bien
        ]) ;
    }

     /**
     * @Route("/admin/create", name="admin.bien.create")
     */
    public function new(Request $request){

        $bien = new Biens();
        $this->setCreatedAt = new \DateTime();

        $form = $this->createForm(BienType::class, $bien);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->manager->persist($bien);
            $this->manager->flush();
            $this->addFlash('success', 'Votre bien a bien été ajouter');
            return $this->redirectToRoute('admin.bien.index');
        }
        return $this->render('admin/biens/new.html.twig', [
            'bien' => $bien,
            'form' => $form->createView()

        ]);


    }

    /**
     * @Route("/admin/{id}", name="admin.bien.edit", methods="GET|POST")
     */
    public function edit(Biens $bien, Request $request){
        $form = $this->createForm(BienType::class, $bien);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->manager->flush();
            $this->addFlash('success', 'Votre bien a bien été modifier');
            return $this->redirectToRoute('admin.bien.index');
        }
        return $this->render('admin/biens/edit.html.twig', [
            'bien' => $bien,
            'form' => $form->createView()

        ]);

    }

     /**
     * @Route("/admin/{id}", name="admin.bien.delete", methods="DELETE")
     */
    public function delete(Biens $bien, Request $request){

        if($this->isCsrfTokenValid('delete' . $bien->getId(), $request->get('_token')) ){
            $this->manager->remove($bien);
            $this->manager->flush();
            $this->addFlash('success', 'Votre bien a bien été supprimer');
        }
        return $this->redirectToRoute('admin.bien.index');


    }
}


?> 