<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\Type\EpisodeType;
use AppBundle\Entity\Episode;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class EpisodesController extends Controller
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

        $episodes = $em->getRepository('AppBundle:Episode')->findAll();

        $paginator  = $this->get('knp_paginator');
        $episodes = $paginator->paginate(
            $episodes,
            $request->query->getInt('page', 1),
            12
        );

        return [
            'episodes' => $episodes
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

        $episode = new Episode();

        $form = $this->createForm(new EpisodeType(), $episode);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($episode);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_episode_list_path'));
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

        $episode = $em->getRepository('AppBundle:Episode')->findOneById($id);

        $form = $this->createForm(new EpisodeType(), $episode);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_episode_list_path'));
        }

        return [
            'id' => $id,
            'form' => $form->createView()
        ];
    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $episode = $em->getRepository('AppBundle:Episode')->findOneById($id);

        $em->remove($episode);
        $em->flush();

        return new JsonResponse();
    }
}
