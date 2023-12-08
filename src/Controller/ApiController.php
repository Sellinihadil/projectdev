<?php
namespace App\Controller;
use App\Entity\Planning;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use DateTime;
class ApiController extends AbstractController
{
    #[Route('/api', name: 'app_api')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }



    #[Route('/api/{id}/edit', name:'api_event_edit', methods: ['PUT'])]
public function majEvent(?Planning $planning, Request $request)
{
    //on recupere les donnees 
    $donnees = json_decode($request->getContent());
    if(
    isset($donnees->title) && !empty($donnees->title) &&
    isset($donnees->start) && !empty($donnees->start) &&
    isset($donnees->description) && !empty($donnees->description) &&
    isset($donnees->backgroundColor) && !empty($donnees->backgroundColor) &&
    isset($donnees->borderColor) && !empty($donnees->borderColor) &&
    isset($donnees->textColor) && !empty($donnees->textColor)
){
//les donnees sont completes
    $code =200;
    if(!$planning){
    $planning= new Planning;
    $code= 201;}
    $planning->setTitle($donnees->title);
    $planning->setDescription($donnees->description);
    $planning->setStart(new DateTime($donnees->start));
    if($donnees->allDay){
    $planning->setEnd(new DateTime($donnees->start));}
    else{
    $planning->setEnd(new DateTime($donnees->end));}
    $planning->setAllDay($donnees->allDay);
    $planning->setBackgroundColor($donnees->backgroundColor);
    $planning->setBorderColor($donnees->borderColor);
    $planning->setTextColor($donnees->textColor);

    $em = $this->getDoctrine()->getManager();
    $em->persist($planning);
    $em->flush();

    return new Response('ok', $code);}
    else{
    //les donnees sont incompletes
    return new Response('donnees incompletes',404);}

    return $this->render('api/index.html.twig', [
    'controller_name' => 'ApiController',]);
 }

}
