<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Advert;
use AppBundle\Entity\Category;
use AppBundle\Form\AdvertType;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdvertController extends Controller
{
    /**
     * @Get(
     *     path = "/adverts/show/{advert}",
     *     name = "app_advert_show",
     *     requirements = {"id"="\d+"}
     * )
     * @View
     * @param Advert $advert
     * @return Advert
     */
    public function showAction(Advert $advert)
    {
        return $advert;
    }

    /**
     * @Rest\Post(
     *    path = "/adverts/create",
     *    name = "app_adverts_create"
     * )
     * @Rest\View(Response::HTTP_CREATED)
     *
     * @param Request $request
     * @return Advert|\Symfony\Component\Form\FormInterface
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if($idAdvert = $request->request->get('id', null)) { // edit existing advert
            $advert = $em->getRepository(Advert::class)->find($idAdvert);
            $request->request->remove('id');

        } else { // create new advert
            $advert = new Advert();
        }

        $category = $request->request->get('category', null);
        if($category) {
            $category = $em->getRepository(Category::class)->findOneByName($category);
            $advert->setCategory($category);
            // unset category
            $request->request->remove('category');
        }

        $form = $this->createForm(AdvertType::class, $advert);
        $form->submit($request->request->all()); // Validation

        if ($form->isValid()) {
            $em->persist($advert);
            // event pre flush to check coherence (checkCoherence function in Advert entity)
            $em->flush();
            return $advert;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\Delete(
     *    path = "/adverts/delete/{advert}",
     *    name = "app_adverts_delete"
     * )
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     *
     * @param Advert $advert
     */
    public function deleteAction(Advert $advert)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($advert);
        $em->flush();
    }
}
