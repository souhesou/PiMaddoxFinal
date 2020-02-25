<?php

namespace volontaireBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use DocDocDoc\NexmoBundle\Message\Simple;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use volontaireBundle\Entity\don;
use volontaireBundle\Entity\event;
use volontaireBundle\Form\donType;
use volontaireBundle\Entity\partenaire;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;

class donController extends Controller
{

    public function ajoutdonAction(Request $request)
    {
        $don = new don();
        $form =$this->createForm(donType::class,$don);
        $form->handleRequest($request);
        // $candidat->setSujet(null);
        if($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            //   $don->uploadProfilePicture() ;
            $em->persist($don);
            $em->flush();
            $message = new Simple("Heart2Hold", "21623334418", "Bonjour Mr. le responsable ! A cet instant un don s'est affecté à votre camp ");
            $nexmoResponse = $this->container->get('doc_doc_doc_nexmo')->send($message);
            // return $this->redirectToRoute('volontaireaffichedon');
        }
        return $this->render("@volontaire/don/ajoutd.html.twig",array("form"=>$form->createView()));
    }

    public   function  affichedonAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager() ;
        $don=  $em->getRepository(don::class)->findAll();
        if($request->isMethod("POST"))
        {
            $nom =$request->get("nom");
            $event  = $em->getRepository("volontaire:don")->findBy(array("nom"=>$nom));

        }

        return $this->render("@volontaire/don/affiched.html.twig",array("don"=>$don));

    }



    public function supprimerdonAction($id)
    {

        $em = $this->getDoctrine()->getManager() ;
        $don = $em->getRepository(don::class)->find($id) ;
        $em->remove($don);
        $em->flush();
        return $this->redirectToRoute('volontaireaffichedon');

    }


    public function updatedonAction(Request $request , $id)
    {
        $don = $this->getDoctrine()->getRepository(don::class)->find($id);
        $form = $this->createForm(donType::class , $don) ;
        $form = $form->handleRequest($request);

        if($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager() ;
            $em->persist($don);
            $em->flush();
            return $this->redirectToRoute('volontaireaffichedon');
        }
        return $this->render('@volontaire/don/updated.html.twig' , array('form'=>$form->createView())) ;
    }


    /* public function StatistiqueAction(Request $request)
     {
         $JsonResponse = null;
         $em = $this->getDoctrine()->getManager();
         $don = $em->getRepository("volontaireBundle:don")->findAll();
         foreach ($don as $club) {
             $don = $em->getRepository("volontaireBundle:don")->findBy(array('club' => $club));
             $countdon = count($don);
             if ($countdon == 0) {
             } else {
                 $JsonResponse["Stat"] [] = [
                     "count" => $countdon,
                     "objet" => $don->getObjet()

                 ];
             }
         }
         return new JsonResponse($JsonResponse);
     }*/



    public function StatistiquedonAction(Request $request)
    {
        $pieChart = new PieChart();
        $em= $this->getDoctrine();
        $Asso = $em->getRepository(don::class)->findAll();
        $data= array();
        $stat=['description', 'objet'];
        $nb=0;
        array_push($data,$stat);
        foreach($Asso as $classe) {
            $stat=array();
            array_push($stat,$classe->getDescription(),$classe->getObjet());
            $nb=($classe->getObjet());
            $stat=[$classe->getDescription(),$nb];
            array_push($data,$stat);
        }
        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('description/objet');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('@volontaire\don\statdon.html.twig', array('piechart' => $pieChart));



    }




}
