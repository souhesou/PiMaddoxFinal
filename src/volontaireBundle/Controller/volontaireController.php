<?php

namespace volontaireBundle\Controller;


use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Dompdf\Dompdf;
use Dompdf\Options;
use volontaireBundle\Entity\event;
use volontaireBundle\Entity\volontaire;

use volontaireBundle\Form\volontaireType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class volontaireController extends Controller
{



    public function ajoutvolontaireAction(Request $request)
    {
        $volontaire = new volontaire();
        $form =$this->createForm(volontaireType::class,$volontaire);
        $form->handleRequest($request);
        // $candidat->setSujet(null);
        if($form->isSubmitted() &&  $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($volontaire);
            $em->flush();
            return $this->redirectToRoute('volontaireaffichevolontaire');
        }
        return $this->render("@volontaire/volontaire/addv.html.twig",array("form"=>$form->createView()));
    }



    public   function  affichevolontaireAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager() ;
        $volontaire =  $em->getRepository(volontaire::class)->findAll();
        if($request->isMethod("POST"))
        {
            $nom =$request->get("nom");
            $volontaire  = $em->getRepository("volontaireBundle:volontaire")->findBy(array("nom"=>$nom));

        }


        //   var_dump($candidat);
        return $this->render("@volontaire/volontaire/affichev.html.twig",array("volontaire"=>$volontaire));

    }

    public function supprimervololentaireAction($cin)
    {
        $em = $this->getDoctrine()->getManager() ;
        $volontaire = $em->getRepository(volontaire::class)->find($cin) ;
        $em->remove($volontaire);
        $em->flush();
        return $this->redirectToRoute('volontaireaffichevolontaire');

    }


    public function updatevolontaireAction(Request $request , $cin)
    {
        $volontaire = $this->getDoctrine()->getRepository(volontaire::class)->find($cin);
        $form = $this->createForm(volontaireType::class , $volontaire) ;
        $form = $form->handleRequest($request);

        if($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager() ;
            $em->persist($volontaire);
            $em->flush();
            return $this->redirectToRoute('volontaireaffichevolontaire');
        }
        return $this->render('@volontaire/volontaire/updatev.html.twig' , array('form'=>$form->createView())) ;

    }

    public function RechercheAction(Request $request)
    {
        /*  $em = $this->getDoctrine()->getManager() ;
          $volontaire =  $em->getRepository(volontaire::class)->findAll();
          if($request->isMethod("POST"))
          {
              $recherche =$request->get('recherche');
              $volontaire  = $em->getRepository("volontaireBundle:volontaire")->findBy(array("recherche"=>$recherche));

          }
          return $this->render("@volontaire/volontaire/affichev.html.twig",array("volontaire"=>$volontaire));*/
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('rechercher');
        $volontaire =  $em->getRepository('volontaireBundle:volontaire')->find($requestString);
        if(!$volontaire) {
            $result['volontaire']['error'] = "Post Not found :( ";
        } else {
            $result['cin'] = $volontaire->getCin();
            $result['nom'] = $volontaire->getNom();
            $result['prenom'] = $volontaire->getPrenom();
            //   $result['age'] = $volontaire->getage();

        }
        return new Response(json_encode($result));




    }


    public   function  calAction()
    {

        return $this->render("@ADesignsCalendar/Calendar.html.twig");

    }



    public   function  pdfvAction(Request $request)
    {

        $pdfOptions =new Options();
        $pdfOptions->set('default','Arial');

        $dompdf = new Dompdf($pdfOptions);

        $em =  $this->getDoctrine()->getManager() ;
        $volontaire =  $em->getRepository(volontaire::class)->findAll();
        //    return $this->render("@volontaire/event/pdf.html.twig",array("event"=>$event));

        $html =$this->renderView('@volontaire/volontaire/pdf.html.twig',array("volontaire"=>$volontaire));


        $dompdf->loadHtml($html);


        $dompdf->setPaper('A4','portrait');

        $dompdf->render();

        $dompdf->stream("pdf.html.twig",["Attachment"=>true]);
        $dompdf->output();
        return $this->render("@volontaire/event/affichee.html.twig",array("volontaire"=>$volontaire));
    }



    public function StatistiquevAction(Request $request)
    {
        /*   $pieChart = new PieChart();
           $em= $this->getDoctrine();
           $Asso = $em->getRepository(volontaire::class)->findAll();
           $data= array();
           $stat=['volontaire', 'role'];
           $nb=0;
           array_push($data,$stat);
           foreach($Asso as $classe) {
               $stat=array();
               array_push($stat,$classe->getTitre(),$classe->getRole());
               $nb=($classe->getPrix());
               $stat=[$classe->getLieu(),$nb];
               array_push($data,$stat);
           }
           $pieChart->getData()->setArrayToDataTable(
               $data
           );
           $pieChart->getOptions()->setTitle('lieu / Event');
           $pieChart->getOptions()->setHeight(500);
           $pieChart->getOptions()->setWidth(900);
           $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
           $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
           $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
           $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
           $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
           return $this->render('@volontaire\event\statevent.html.twig', array('piechart' => $pieChart));*/
    }






}
