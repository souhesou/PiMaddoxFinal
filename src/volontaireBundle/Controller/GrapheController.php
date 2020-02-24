<?php

namespace volontaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use volontaireBundle\Entity\partenaire;
use volontaireBundle\Entity\event;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;

class GrapheController extends Controller
{

    public function chartPieAction()
    {
        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['Task', 'Hours per Day'],
                ['Work',     11],
                ['Eat',      2],
                ['Commute',  2],
                ['Watch TV', 2],
                ['Sleep',    7]
            ]
        );
        $pieChart->getOptions()->setTitle('My Daily Activities');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('@volontaire/event/statevent.html.twig', array('piechart' => $pieChart));


    }


}
