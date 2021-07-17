<?php
namespace App\Controller;

use App\Entity\CodePostal;
use App\Entity\Dirigeant;
use App\Entity\Society;
use App\Entity\TypeSociety;
use App\Entity\Ville;
use App\Form\CodePostalType;
use App\Repository\CodePostalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController{

    private $objectManager;

    public function __construct(EntityManagerInterface $em)
    {

        $this->objectManager = $em;

    }
    /**
     * @Route ( "/",name="home")
    */
    public function societe() : Response{
        $repository =   $this->getDoctrine()->getRepository(Society::class);
        $societys = $repository->findAll();

        $repository =   $this->getDoctrine()->getRepository(TypeSociety::class);
        $type_societes = $repository->findAll();

        $repository =   $this->getDoctrine()->getRepository(CodePostal::class);
        $code_postals = $repository->findAll();

        return  $this->render('pages/societe.html.twig',compact('societys','type_societes','code_postals'));
    }
    /**
     * @Route ( "/society/store",name="society.store")
    */
    public function societe_store(Request $request) : Response{
      
        $socety = new Society();

        $socety->setName($request->get("name"));
        $socety->setDescription($request->get("description"));

        $repository =   $this->getDoctrine()->getRepository(CodePostal::class);
        $code_postal = $repository->find($request->get("code_postal"));
        $socety->setCodePostal($code_postal);

        $repository =   $this->getDoctrine()->getRepository(Ville::class);
        $ville = $repository->find($request->get("ville"));
        $socety->setVille($ville);
        
        //$type_societes = [];
        foreach($request->get("type_society") as $type_society){
            $repository =   $this->getDoctrine()->getRepository(TypeSociety::class);

            $type_societe = $repository->find($type_society);

            $socety->addTypeSociety($type_societe);
        }
        

        $this->objectManager->persist($socety);
        $this->objectManager->flush();
        
        return  $this->redirectToRoute("home");
    }

    /**
     * @Route ( "/society/destroy",name="society.destroy")
    */
    public function societe_destroy(Request $request) : Response{

        $repository =   $this->getDoctrine()->getRepository(Society::class);
        $society = $repository->find($request->get("society_id"));
        $this->objectManager->remove($society);
        $this->objectManager->flush();
        
        return  $this->redirectToRoute("home");
    }

    /**
     * @Route ( "/dirigeant",name="dirigeant")
    */
    public function dirigeant() : Response{
        $repository =   $this->getDoctrine()->getRepository(Dirigeant::class);
        $dirigeants = $repository->findAll();

        $repository =   $this->getDoctrine()->getRepository(Society::class);
        $societys = $repository->findAll();

        return  $this->render('pages/dirigeant.html.twig',compact('dirigeants','societys'));
    }

    /**
     * @Route ( "/dirigeant/store",name="dirigeant.store")
    */
    public function dirigeant_store(Request $request) : Response{
      
        $dirigeant  = new dirigeant();
        
        $dirigeant->setName($request->get("name"));
        $dirigeant->setLastname($request->get("lastname"));
        $dirigeant->setSexe($request->get("sexe"));
        $dirigeant->setEmail($request->get("email"));

        $repository =   $this->getDoctrine()->getRepository(Society::class);
        $society = $repository->find($request->get("society"));
        $dirigeant->setSociety($society);

        $this->objectManager->persist($dirigeant);
        $this->objectManager->flush();

        return $this->redirectToRoute("dirigeant");
    }

    /**
     * @Route ( "/dirigeant/destroy",name="dirigeant.destroy")
    */
    public function dirigeant_destroy(Request $request): Response {

        $repository =   $this->getDoctrine()->getRepository(Dirigeant::class);

        $dirigeant = $repository->find($request->get("dirigeant_id"));
        $this->objectManager->remove($dirigeant);
        $this->objectManager->flush();
        
        return  $this->redirectToRoute("dirigeant");
    }
    /**
     * @Route ( "/code_postal",name="code_postal")
    */

    public function code_postal() : Response{
        $repository =   $this->getDoctrine()->getRepository(CodePostal::class);
        $code_postals = $repository->findAll();

        return  $this->render('pages/code_postal.html.twig',compact('code_postals'));
    }

    /**
     * @Route ( "/code_postal/store",name="code_postal.store")
    */
    public function code_postal_add(Request $request): Response {
        $code_postal = new CodePostal();
        
        $code_postal->setName($request->get("name"));
        
        $this->objectManager->persist($code_postal);
        $this->objectManager->flush();
        
        return  $this->redirectToRoute("code_postal");
    }

    /**
     * @Route ( "/code_postal/update",name="code_postal.update")
    */
    public function code_postal_update(Request $request): Response {

        $repository =   $this->getDoctrine()->getRepository(CodePostal::class);

        $code_postal = $repository->find($request->get("code_postal_id"));
        $code_postal->setName($request->get("name"));
        $this->objectManager->persist($code_postal);
        $this->objectManager->flush();
        
        return  $this->redirectToRoute("code_postal");
    }

    /**
     * @Route ( "/code_postal/destroy",name="code_postal.destroy")
    */
    public function code_postal_destroy(Request $request): Response {

        $repository =   $this->getDoctrine()->getRepository(CodePostal::class);

        $code_postal = $repository->find($request->get("code_postal_id"));
        $this->objectManager->remove($code_postal);
        $this->objectManager->flush();
        
        return  $this->redirectToRoute("code_postal");
    }

    /**
     * @Route ( "/ville",name="ville")
    */
    public function ville() : Response{
        $repository =   $this->getDoctrine()->getRepository(Ville::class);
        $villes = $repository->findAll();
        $repository =   $this->getDoctrine()->getRepository(CodePostal::class);
        $code_postals = $repository->findAll();
       
        return  $this->render('pages/ville.html.twig',compact('villes','code_postals'));
    }

    /**
     * @Route ( "/ville/store",name="ville.store")
    */
    public function ville_store(Request $request) : Response{

        $ville = new Ville();
        
        $ville->setName($request->get("name"));

        $repository =   $this->getDoctrine()->getRepository(CodePostal::class);
        $code_postal = $repository->find($request->get("code_postal_id"));
        $ville->setCodePostal($code_postal);
        
        
        $this->objectManager->persist($ville);
        $this->objectManager->flush();
        
        return  $this->redirectToRoute("ville");
       
    }

    /**
     * @Route ( "/ville/update",name="ville.update")
    */
    public function ville_update(Request $request) : Response{

        $repository =   $this->getDoctrine()->getRepository(Ville::class);
        $ville = $repository->find($request->get("ville_id"));

        $ville->setName($request->get("name"));
        $repository =   $this->getDoctrine()->getRepository(CodePostal::class);
        $code_postal = $repository->find($request->get("code_postal_id"));
        $ville->setCodePostal($code_postal);

        $this->objectManager->persist($ville);
        $this->objectManager->flush();
        
        return  $this->redirectToRoute("ville");
    }

    /**
     * @Route ( "/ville/destroy",name="ville.destroy")
    */
    public function ville_destroy(Request $request) : Response{

        $repository =   $this->getDoctrine()->getRepository(Ville::class);

        $ville = $repository->find($request->get("ville_id"));
        $this->objectManager->remove($ville);
        $this->objectManager->flush();
        
        return  $this->redirectToRoute("ville");
    }
    

    /**
     * @Route ( "/type_societe",name="type_societe")
    */
    public function type_societe() : Response{
        $repository =   $this->getDoctrine()->getRepository(TypeSociety::class);
        $type_societes = $repository->findAll();
        return  $this->render('pages/type_societe.html.twig',compact('type_societes'));
    }

    /**
     * @Route ( "/type_societe/store",name="type_societe.store")
    */
    public function type_societe_store(Request $request) : Response{
        $type_societe = new TypeSociety();
        
        $type_societe->setName($request->get("name"));
        
        $this->objectManager->persist($type_societe);
        $this->objectManager->flush();
        
        return  $this->redirectToRoute("type_societe");
    }

    /**
     * @Route ( "/type_societe/update",name="type_societe.update")
    */
    public function type_societe_update(Request $request) : Response{
        $repository =   $this->getDoctrine()->getRepository(TypeSociety::class);

        $type_societe = $repository->find($request->get("type_societe_id"));
        $type_societe->setName($request->get("name"));
        $this->objectManager->persist($type_societe);
        $this->objectManager->flush();
        
        return  $this->redirectToRoute("type_societe");
    }

    /**
     * @Route ( "/type_societe/destroy",name="type_societe.destroy")
    */
    public function type_societe_destroy(Request $request) : Response{
        
        $repository =   $this->getDoctrine()->getRepository(TypeSociety::class);

        $type_societe = $repository->find($request->get("type_societe_id"));
        $this->objectManager->remove($type_societe);
        $this->objectManager->flush();
        
        return  $this->redirectToRoute("type_societe");
    }

    
    /**
     * @Route ( "/ville/api/{id}",name="ville.api")
    */
    public function getAllVilleWithID($id) : JsonResponse{
        $repository =   $this->getDoctrine()->getRepository(Ville::class);
        $villes = $repository->findBy(["code_postal" => $id]);
        $data = [];

        foreach ($villes as $ville) {
            $data[] = [
                'id' => $ville->getId(),
                'name' => $ville->getName(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }
    
    /**
     * @Route ( "/society/api/{id}",name="society.api")
    */
    
}
?>
