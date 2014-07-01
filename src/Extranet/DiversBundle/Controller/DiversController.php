<?php

namespace Extranet\DiversBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DiversController extends Controller
{

	public function indexAction()
    {
        return $this->render('ExtranetDiversBundle:Divers:index.html.twig', array());

    }
}