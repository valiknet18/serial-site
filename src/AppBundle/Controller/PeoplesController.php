<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;

class PeoplesController extends Controller
{
    /**
     * @Template
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $peoples = $em->getRepository('AppBundle:People')->findAll();

        return [
            'peoples' => $peoples
        ];
    }

    /**
     * @param $slug
     * @return array
     *
     * @Template
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $people = $em->getRepository('AppBundle:People')->findOneBySlug($slug);

        return [
            'people' => $people
        ];
    }
}