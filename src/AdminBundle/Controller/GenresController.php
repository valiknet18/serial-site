<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\Type\GenreType;
use AdminBundle\Form\Type\PeopleType;
use AppBundle\Entity\Genre;
use AppBundle\Entity\People;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Component\HttpFoundation\Request;

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
     * @param Request $request
     * @return array
     *
     * @Template
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $genre = new Genre();

        $form = $this->createForm(new GenreType(), $genre);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($genre);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_genre_list_path'));
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @param Request $request
     * @param $slug
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Template
     */
    public function editAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        $genre = $em->getRepository('AppBundle:Genre')->findOneBySlug($slug);

        $form = $this->createForm(new GenreType(), $genre);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_genre_list_path'));
        }

        return [
            'slug' => $slug,
            'form' => $form->createView()
        ];
    }
}
