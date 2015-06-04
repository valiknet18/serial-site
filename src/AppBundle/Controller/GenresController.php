<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Component\HttpFoundation\Request;

class GenresController extends Controller
{
    /**
     * @Template
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $genres = $em->getRepository('AppBundle:Genre')->findAll();

        $paginator  = $this->get('knp_paginator');
        $genres = $paginator->paginate(
            $genres,
            $request->query->getInt('page', 1),
            12
        );

        return [
            'genres' => $genres
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

        $genre = $em->getRepository('AppBundle:Genre')->findOneBySlug($slug);

        return [
            'genre' => $genre
        ];
    }
}
