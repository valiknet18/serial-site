<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Component\HttpFoundation\Request;

class SerialsController extends Controller
{
    /**
     * @Template
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $serials = $em->getRepository('AppBundle:Serial')->findAll();

        return [
            'pagination' => $serials
        ];
    }
}
