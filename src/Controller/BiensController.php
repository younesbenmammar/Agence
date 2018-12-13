<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Biens;
use Symfony\Component\Validator\Constraints\DateTime;
use App\Repository\BiensRepository;
use Doctrine\Common\Persistence\ObjectManager;



class BiensController extends AbstractController{

    /**
     * @var @BienRepository
     */
    private $repository;

    public function __construct(BiensRepository $repository, ObjectManager $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * @Route("/biens", name="bien.index");
     * @return Response
     */
    public function index():Response {
        
        return $this->render('biens/index.html.twig');

    }

     /**
     * @Route("/biens/{slug}-{id}", name="bien.show", requirements={"slug": "[a-z0-9/-]*"});
     * @return Response
     */
    public function show(Biens $bien, string $slug) :Response {
        
        if ($bien->getSlug() !== $slug){
            return $this->redirectToRoute('bien.show', [
                'id' => $bien->getId(),
                'slug' =>$bien->getSlug()
            ],301);
                
        }
        return $this->render('biens/show.html.twig', [
            'bien' => $bien 

        ]);
    }

}