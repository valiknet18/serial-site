<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;

class GenresController extends Controller
{
    /**
     * @Template
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $genres = $em->getRepository('AppBundle:Genre')->findAll();

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
