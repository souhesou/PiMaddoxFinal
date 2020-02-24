<?php

namespace RefugieBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use GcampBundle\Entity\Camp;
use RefugieBundle\Entity\Refugie;
use RefugieBundle\Form\RefugieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StatistiqueController extends Controller implements \JsonSerializable

{

    public function indexAction()
    {
        $idr=[];
        $age=[];
        $i=0;
        $refugees=$this->getDoctrine()->getRepository(Refugie::class)->findAll();
        foreach ($refugees as $refugee){
            $ids[$i]=json_decode($refugee->getId());
            $age[$i]=json_decode($refugee->getAge());
            $i++;
        }
        $camps=$this->getDoctrine()->getRepository(Camp::class)->findAll();
        $idc=[];
        $lieu=[];
        $j=0;
        foreach ($camps as $camp){
            $idf[$j]=json_decode($camp->getId());
            $refugee=$this->getDoctrine()->getRepository(Camp::class)->findBy(['idcamp'=>$camp->getid()]);


        }
        return $this->render('',['ids'=>$ids,'refugee'=>$refugee,'lieu'=>$lieu,'idc'=>$idc]);


    }



    public function jsonSerialize()
    {
        return get_object_vars($this);
    }


}
