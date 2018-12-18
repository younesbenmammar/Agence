<?php

namespace App\Controller;
use App\Entity\BienRecherche;
use App\Entity\Contact;
use App\Form\BienRechercheType;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
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
     *
     */
    private $repository;

    public function __construct(BiensRepository $repository, ObjectManager $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * @Route("/biens", name="bien.index");
     *
     * @return Response
     */
    public function index(PaginatorInterface $paginatior, Request $request):Response {

        $recherche = new BienRecherche();
        $form = $this->createForm(BienRechercheType::class, $recherche);
        $form->handleRequest($request);

        $biens = $paginatior->paginate
        ($this->repository->findAllVisibleQuery($recherche),
         $request->query->getInt('page', 1),
        12
    );

        return $this->render('biens/index.html.twig', [
            'biens' => $biens,
            'form' => $form->createView()
        ]);

    }

     /**
     * @Route("/biens/{slug}-{id}", name="bien.show", requirements={"slug": "[a-z0-9/-]*"});
     * @return Response
     */
    public function show(Biens $bien, string $slug, Request $request, ContactNotification $notification) :Response {



        if ($bien->getSlug() !== $slug){
            return $this->redirectToRoute('bien.show', [
                'id' => $bien->getId(),
                'slug' =>$bien->getSlug()
            ],301);
                
        }

        $contact = new Contact();
        $contact->setBiens($bien);
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $notification->notify($contact);
            $this->addFlash('success', 'Votre Email a bien été envoyer ');
            return $this->redirectToRoute('bien.show', [
                'id' => $bien->getId(),
                'slug' =>$bien->getSlug()
            ]);

        }

        return $this->render('biens/show.html.twig', [
            'bien' => $bien,
            'form' => $form->createView()


        ]);
    }

}