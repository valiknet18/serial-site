<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\Type\PeopleType;
use AppBundle\Entity\People;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Symfony\Component\HttpFoundation\Request;

class PeoplesController extends Controller
{
    /**
     * @return array
     *
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
     * @param Request $request
     * @return array
     *
     * @Template
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $people = new People();

        $form = $this->createForm(new PeopleType(), $people);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($people);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_people_list_path'));
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

        $people = $em->getRepository('AppBundle:People')->findOneBySlug($slug);

        $form = $this->createForm(new PeopleType(), $people);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_people_list_path'));
        }

        return [
            'slug' => $slug,
            'form' => $form->createView()
        ];
    }
}