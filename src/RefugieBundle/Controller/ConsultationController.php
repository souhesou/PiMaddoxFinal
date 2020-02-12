<?php

namespace RefugieBundle\Controller;

use RefugieBundle\Entity\RefConsult;
use RefugieBundle\Entity\Refugie;
use RefugieBundle\Form\RefConsultType;
use RefugieBundle\Form\RefugieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ConsultationController extends Controller
{
    public function ajoutAction(Request $request)
    {
        /*$c=$this->getDoctrine()->getManager();
        if($request->isMethod('POST')) {
            $sujet = $request->get('sujet');
            $contenu= $request->get('contenu');
            $duree= $request->get('duree');
            $date= new \DateTime();
            $conslt=new RefConsult($sujet,$contenu,$date,$duree);
            $c->persist($conslt);
            $c->flush();
            return $this->redirectToRoute('affiche_Consultation');
        }return $this->render("@Refugie/Consultation/ajout.html.twig");*/



        $refugie= new RefConsult();
        $form=$this->createForm(RefConsultType::class,$refugie);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($refugie);
            $em->flush();
            return $this->redirectToRoute('affiche_Consultation');
        }
        return $this->render('@Refugie/Consultation/ajout.html.twig', array('form' => $form->createView()));





    }

    public function afficheAction(Request $request)
    {
        $consultation=$this->getDoctrine()->getRepository(RefConsult::class)->findAll();
        return $this->render("@Refugie/Consultation/listeConsultation.html.twig",array('consultation'=>$consultation));
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
        if($form->isSubmitted()) {
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('affiche_Consultation');
        }
        return $this->render('@Refugie/Consultation/modifier.html.twig', array('form' => $form->createView()));
    }



}
