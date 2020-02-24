<?php

namespace GcampBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Gcamp/Default/index.html.twig');
    }

    public function frontAction()
    {
        return $this->render('@Gcamp/Default/index2.html.twig');
    }

}



