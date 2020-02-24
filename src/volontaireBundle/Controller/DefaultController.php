<?php

namespace volontaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use volontaireBundle\Entity\event;
use volontaireBundle\Form\eventType;
use volontaireBundle\Entity\comment;
class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@volontaire/Default/index.html.twig');
    }

    public function eventsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager() ;
        $event =  $em->getRepository(event::class)->findAll();
        if($request->isMethod("POST"))
        {
            $nom =$request->get("nom");
            $event  = $em->getRepository("volontaire:event")->findBy(array("nom"=>$nom));

        }

        return $this->render("@volontaire/event/events.html.twig",array("event"=>$event));


    }

    public function frontAction()
    {
        return $this->render('@volontaire/Default/index2.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('@volontaire/Default/about.html.twig');
    }


    public function singleeventsAction($id , Request $request)
    {
        $em=$this->getDoctrine()->getManager();

        $h=$this->getDoctrine()->getManager()->getRepository("volontaireBundle:event")->find($id);

        //var_dump($affcomt);

        if($request->isMethod('post')){
            $comment=new comment();
            $em=$this->getDoctrine()->getManager();

            $comment->setDate(new \DateTime());
            $comment->setComment($request->get('cmntr'));
            $comment->setEvent($h);
            $comment->setVolontaire(null);
            $em->persist($comment);
            $em->flush();//juste fi blaset l'image athika tnajem t7ot image mta3 user connecté tji ta7founa :p ey tawa na3amlha sinon merci 2r1 ;)
        }
        $affcomt= $em->getRepository(comment::class)->findBy(array('event'=>$id));
        $event = new event();
        // $Reservation->setHotel($h);
        $form =$this->createForm(eventType::class,$event);
        // $form =$this->createForm(reservetionType::class,$Reservetion);
        $form->handleRequest($request);
        // $candidat->setSujet(null);
        if($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            //   return $this->redirectToRoute('theseaffichecandidat');
        }
        return $this->render("@volontaire/event/Singleevents.html.twig",array("form"=>$form->createView(),'event'=>$h
        ,'thecomments'=>$affcomt
        ));



    }

    public function jeuAction()
    {
        return $this->render('@volontaire/Default/jeu.html.twig');
    }

}
