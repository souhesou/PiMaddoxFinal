<?php

namespace RefugieBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use GcampBundle\Entity\Camp;
use RefugieBundle\Entity\Refugie;
use RefugieBundle\Form\RefugieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function BackAction()
    {

        return $this->render('@Refugie/indexBack.html.twig');
    }



    public function FrontAction()
    {

        return $this->render('@Refugie/index.html.twig');
    }

    public function aboutAction()
    {

        return $this->render('@Refugie/about.html.twig');
    }


}
