<?php

namespace RefugieBundle\Controller;

use DocDocDoc\NexmoBundle\Message\Simple;
use RefugieBundle\Entity\RefConsult;
use RefugieBundle\Entity\Refugie;
use RefugieBundle\Form\RefConsultType;
use RefugieBundle\Form\RefugieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

class ConsultationController extends Controller
{
    public function ajoutAction(Request $request)
    {
        if ($this->isGranted("ROLE_DOCTEUR")) {

            $refugie = new RefConsult();
            $form = $this->createForm(RefConsultType::class, $refugie);
            $form->handleRequest($request);
            $refugie->setDate(new \DateTime('now'));
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $em->persist($refugie);
                $em->flush();
                $message = new Simple("Hand2Hold", "21623334418", "Bonjour Mr. le responsable camps! A cet instant une consultation s'est déroulé dans le camp .. ");
                $nexmoResponse = $this->container->get('doc_doc_doc_nexmo')->send($message);
                return $this->redirectToRoute('affiche_Consultation');
            }
            return $this->render('@Refugie/Consultation/ajout.html.twig', array('form' => $form->createView()));
        }else return $this->render('@Refugie/index.html.twig');


    }

    public function afficheAction(Request $request)
    {
        if ($this->isGranted("ROLE_DOCTEUR")) {
        $consultation=$this->getDoctrine()->getRepository(RefConsult::class)->findAll();
        return $this->render("@Refugie/Consultation/listeConsultation.html.twig",array('consultation'=>$consultation));
        }else return $this->render('@Refugie/index.html.twig');
    }

    public function afficheBAction(Request $request)
    {
        $consultation=$this->getDoctrine()->getRepository(RefConsult::class)->findAll();
        return $this->render("@Refugie/Consultation/listeConsultationBack.html.twig",array('consultation'=>$consultation));
    }



    public function supprimerAction($id)
    {
        $c=$this->getDoctrine()->getManager();
        $supp=$this->getDoctrine()->getRepository(RefConsult::class)->find($id);
        $c->remove($supp);
        $c->flush();
        return  $this->redirectToRoute("affiche_Consultation");
    }


    public function modifierAction($id,Request $request){

        $cours= new RefConsult();
        $em=$this->getDoctrine()->getManager();
        $cours=$em->getRepository(RefConsult::class)->find($id);
        $form=$this->createForm(RefConsultType::class,$cours);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('affiche_Consultation');
        }
        return $this->render('@Refugie/Consultation/modifier.html.twig', array('form' => $form->createView()));
    }



}
