<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\Type\SeasonType;
use AppBundle\Entity\Season;
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

        $paginator  = $this->get('knp_paginator');
        $seasons = $paginator->paginate(
            $seasons,
            $request->query->getInt('page', 1),
            12
        );

        return [
            'seasons' => $seasons
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

        $season = new Season();

        $form = $this->createForm(new SeasonType(), $season);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($season);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_season_list_path'));
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
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $season = $em->getRepository('AppBundle:Season')->findOneById($id);

        $form = $this->createForm(new SeasonType(), $season);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_season_list_path'));
        }

        return [
            'id' => $id,
            'form' => $form->createView()
        ];
    }
}
