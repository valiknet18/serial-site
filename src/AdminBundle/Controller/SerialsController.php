<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\Type\SerialType;
use AppBundle\Entity\Serial;
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

        return [
            'pagination' => $serials
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

        $serial = new Serial();

        $form = $this->createForm(new SerialType(), $serial);
        $form->handleRequest($request);

        if ($form->isValid()) {
            foreach ($serial->getActors() as $actor) {
                $actor->addActorSerial($serial);
            }

            foreach ($serial->getDirectors() as $director) {
                $director->addDirectorSerial($serial);
            }

            foreach ($serial->getGenres() as $genre) {
                $genre->addSerial($serial);
            }

            $em->persist($serial);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_root'));
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

        $serial = $em->getRepository('AppBundle:Serial')->findOneBySlug($slug);

        $prevCollectionActors = $serial->getActors();
        $prevCollectionDirectors = $serial->getDirectors();
        $prevCollectionGenres = $serial->getGenres();

        $form = $this->createForm(new SerialType(), $serial);
        $form->handleRequest($request);

        if ($form->isValid()) {
            foreach ($prevCollectionActors as $actor) {
                $actor->removeActorSerial($serial);
            }

            foreach ($prevCollectionDirectors as $director) {
                $director->removeDirectorSerial($serial);
            }

            foreach ($prevCollectionGenres as $genre) {
                $genre->removeSerial($serial);
            }

            foreach ($serial->getActors() as $actor) {
                $actor->addActorSerial($serial);
            }

            foreach ($serial->getDirectors() as $director) {
                $director->addDirectorSerial($serial);
            }

            foreach ($serial->getGenres() as $genre) {
                $genre->addSerial($serial);
            }

            $em->flush();

            return $this->redirect($this->generateUrl('admin_root'));
        }

        return [
            'slug' => $slug,
            'form' => $form->createView()
        ];
    }
}
