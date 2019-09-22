<?php

namespace AppBundle\Form;

use AppBundle\Entity\Advert;
use AppBundle\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('contractType')
            ->add('salary')
            ->add('fuel')
            ->add('price')
            ->add('area')
        ;

        $builder->addEventListener(FormEvents::POST_SUBMIT, [$this, 'onPostSubmit']);

    }

    /**
     * @param FormEvent $event
     */
    public function onPostSubmit(FormEvent $event)
    {
        /** @var Advert $advert */
        $advert = $event->getData();
        $form = $event->getForm();

        if(is_null($advert->getCategory())) {
            $form->addError(new FormError('Category should not be null !'));

        } else {
            switch ($advert->getCategory()->getName()) {
                case 'Automobile':
                    if(is_null($form->get('fuel')->getData())) {
                        $form->get('fuel')->addError(new FormError('fuel should not be null !'));
                    }
                    if(is_null($form->get('price')->getData())) {
                        $form->get('price')->addError(new FormError('price should not be null !'));
                    }
                    break;
                case 'Emploi':
                    if(is_null($form->get('contractType')->getData())) {
                        $form->get('contractType')->addError(new FormError('contractType should not be null !'));
                    }
                    if(is_null($form->get('salary')->getData())) {
                        $form->get('salary')->addError(new FormError('salary should not be null !'));
                    }
                    break;
                case 'Immobilier':
                    if(is_null($form->get('area')->getData())) {
                        $form->get('area')->addError(new FormError('area should not be null !'));
                    }
                    if(is_null($form->get('price')->getData())) {
                        $form->get('price')->addError(new FormError('price should not be null !'));
                    }
                    break;
            }
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Advert::class,
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_advert_type';
    }
}
