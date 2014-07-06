<?php

namespace Extranet\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AppController extends Controller
{

	public function indexAction()
    {
        return $this->render('ExtranetAppBundle:App:index.html.twig', array());

    }

    public function loginAction()
    {
    	return $this->render('ExtranetAppBundle:App:login.html.twig');
    }
}