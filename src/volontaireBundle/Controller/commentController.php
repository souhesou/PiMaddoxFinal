<?php

namespace volontaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use volontaireBundle\Entity\comment;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class commentController extends Controller
{


    public function commentAction($tit,request $request,$id,$cin)
    {
       //$user = $this->container->get('security.token_storage')->getToken()->getUser();

        $em=$this->getDoctrine()->getManager();
        //   echo $tit;what :p

        $user=$em->getRepository('volontaireBundle:volontaire')->find($cin);
        $B=$em->getRepository('volontaireBundle:event')->findTitreParameter($tit);
        $C=$em->getRepository('volontaireBundle:comment')->fiii($id);
        $j=$em->getRepository('volontaireBundle:event')->find($id);
        if ($request->isMethod('POST')) {
            $comm = $request->get('comment');


            //    echo $idd;
            //  echo '^^';
            //echo $id;
            $date = new \DateTime();
            //    echo $date->format('y-m-d');
            //  $date = $request->get('datte');
            $cm=new Comment();
            $cm->setComment($comm);
            $cm->setEvent($j);
            $cm->setVolontaire($user);
            $cm->setDate($date);
            $em = $this->getDoctrine()->getManager();
            $em->persist($cm);
            $em->flush();



        }

        return $this->render('@Loisir/Default/alone.html.twig',array(
            'Bri'=>$B,
                'com'=>$C,

        ));
    }



}
