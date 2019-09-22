<?php


namespace AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;

class AdvertService
{
    /** @var EntityManagerInterface $em */
    protected $entityManager;

    /**
     * AdvertService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function factoryFunction($title, $content, $salary = null, $contract = null, $fuel = null, $price = null, $area = null)
    {
    }
}