<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;

class SeasonsController extends Controller
{
    /**
     * @param  Request $request
     * @param $id
     * @return array
     *
     * @Template
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $seasons = $em->getRepository('AppBundle:Season')->findAll();

        return [
            'seasons' => $seasons
        ];
    }
}
