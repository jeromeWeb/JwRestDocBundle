<?php

namespace Jw\RestDocBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DocController extends Controller
{
    /**
     * @Route("/", name="JwRestDoc_homepage")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        return array('name' => "noname");
    }
}
