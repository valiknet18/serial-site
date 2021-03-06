<?php

namespace AppBundle\Controller;

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

        $paginator  = $this->get('knp_paginator');
        $serials = $paginator->paginate(
            $serials,
            $request->query->getInt('page', 1),
            12
        );

        return [
            'pagination' => $serials
        ];
    }

    /**
     * @param $slug
     * @return mixed
     *
     * @Template
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $serial = $em->getRepository('AppBundle:Serial')->findOneBySlug($slug);

        return [
            'serial' => $serial
        ];
    }
}
