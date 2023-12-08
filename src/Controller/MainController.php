<?php

namespace App\Controller;
use App\Entity\Planning;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PlanningRepository;


class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(PlanningRepository $planning): Response
    {  $events = $planning->findAll();
        $rdv = [];
        
        foreach($events as $event){
            $rdv[] =[
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i:s'),
                'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                'title' => $event->getCours()->getTitle(),
                'description' => $event->getCours()->getDescription(),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBorderColor(),
                'textColor' => $event->getTextColor(),
                'allDay' => $event->isAllDay(),
            ]; 
        }

        $data = json_encode($rdv);
        return $this->render('main/index.html.twig', compact('data'));
    }
}
