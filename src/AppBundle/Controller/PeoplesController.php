<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Component\HttpFoundation\Request;

class PeoplesController extends Controller
{
    /**
     * @Template
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $peoples = $em->getRepository('AppBundle:People')->findAll();

        $paginator  = $this->get('knp_paginator');
        $peoples = $paginator->paginate(
            $peoples,
            $request->query->getInt('page', 1),
            12
        );

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
