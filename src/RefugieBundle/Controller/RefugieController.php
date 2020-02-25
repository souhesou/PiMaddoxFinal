<?php

namespace RefugieBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use DocDocDoc\NexmoBundle\Message\Simple;

use GcampBundle\Entity\Camp;
use RefugieBundle\Entity\RefConsult;
use RefugieBundle\Entity\Refugee;
use RefugieBundle\Entity\Refugie;
use RefugieBundle\Form\RefugieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use volontaireBundle\Entity\event;

class RefugieController extends Controller
{
    public function ajoutAction(Request $request)
    {
        if ($this->isGranted("ROLE_RESPCAMP")){

        $refugie= new Refugie();
        $form=$this->createForm(RefugieType::class,$refugie);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($refugie);
            $em->flush();
            return $this->redirectToRoute('affiche_Refugie');
        }
        return $this->render('@Refugie/Refugie/ajout.html.twig', array('form' => $form->createView()));
    }else return $this->render('@Refugie/index.html.twig');

    }


    public function ajoutBAction(Request $request)
    {
        $refugie= new Refugie();
        $form=$this->createForm(RefugieType::class,$refugie);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($refugie);
            $em->flush();
            return $this->redirectToRoute('affiche_BRefugie');
        }
        return $this->render('@Refugie/Refugie/ajoutBack.html.twig', array('form' => $form->createView()));
    }



    public function afficheAction(Request $request)
    {

        if ($this->isGranted("ROLE_RESPCAMP")){

        $refugie=$this->getDoctrine()->getRepository(Refugie::class)->findAll();
        return $this->render("@Refugie/Refugie/listeRefugie.html.twig",array('refugie'=>$refugie));
        }else return $this->render('@Refugie/index.html.twig');


    }


    public function afficheBackAction(Request $request)
    {
        $refugie=$this->getDoctrine()->getRepository(Refugie::class)->findAll();
        return $this->render("@Refugie/Refugie/listeRefugieBack.html.twig",array('refugie'=>$refugie));
    }


    public function modifierAction($id,Request $request)
{
    $cours= new Refugie();
    $em=$this->getDoctrine()->getManager();
    $cours=$em->getRepository(Refugie::class)->find($id);
    $form=$this->createForm(RefugieType::class,$cours);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
        $em=$this->getDoctrine()->getManager();
        $em->flush();
        return $this->redirectToRoute('affiche_Refugie');
    }
    return $this->render('@Refugie/Refugie/modifier.html.twig', array('form' => $form->createView()));
}




    public function modifierBackAction($id,Request $request)
    {
        $cours= new Refugie();
        $em=$this->getDoctrine()->getManager();
        $cours=$em->getRepository(Refugie::class)->find($id);
        $form=$this->createForm(RefugieType::class,$cours);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('affiche_BRefugie');
        }
        return $this->render('@Refugie/Refugie/modifierBack.html.twig', array('form' => $form->createView()));
    }


    public function supprimerAction($id)
    {
        $c=$this->getDoctrine()->getManager();
        $supp=$this->getDoctrine()->getRepository(Refugie::class)->find($id);
        $c->remove($supp);
        $c->flush();
        return  $this->redirectToRoute("affiche_Refugie");
    }


    public function supprimerBackAction($id)
    {
        $c=$this->getDoctrine()->getManager();
        $refconsul=$this->getDoctrine()->getRepository(RefConsult::class)->findBy(['idref'=>$id]);
        foreach ($refconsul as $ref){
            $c->remove($ref);
        }
        $supp=$this->getDoctrine()->getRepository(Refugie::class)->find($id);
        $c->remove($supp);
        $c->flush();
        return  $this->redirectToRoute("affiche_BRefugie");
    }


    public function trieListeRefugieAction()
    {
        $repository=$this->getDoctrine()->getManager()->getRepository(Refugie::class);
        $refug=$repository->trieListe();
        return ($this->render('@Refugie/Refugie/trieListeRefugie.html.twig', array('refugie'=>$refug)));
    }





    public function StatRefAction(Request $request)
    {
        $pieChart = new PieChart();
        $em= $this->getDoctrine();
        $Asso = $em->getRepository(Refugie::class)->findAll();
        $data= array();
        $stat=['Refugie', 'Origine'];
        $nb=0;
        array_push($data,$stat);
        foreach($Asso as $classe) {
            $stat=array();
            array_push($stat,$classe->getNom(),$classe->getOrigine());
            $nb=100;
            $stat=[$classe->getOrigine(),$nb];
            array_push($data,$stat);
        }
        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle(' Refugiés par Origine');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(500);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#E9967A');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('@Refugie/Refugie/stat.html.twig', array('piechart' => $pieChart));
    }



}
