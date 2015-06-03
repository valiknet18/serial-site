<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
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
    public function showAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $episode = $em->getRepository('AppBundle:Episode')->findOneById($id);

        return [
            'episode' => $episode
        ];
    }
}
