<?php

namespace Database\Mapper;

use Database\Model\Donor as DonorModel;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\UnitOfWork;

class Donor
{

    /**
     * Doctrine entity manager.
     *
     * @var EntityManager
     */
    protected $em;


    /**
     * Constructor
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Search for a member.
     *
     * @param string $query
     *
     * @return DonorModel
     */
    public function search($query)
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('d')
            ->from('Database\Model\Donor', 'd')
            ->where("CONCAT(LOWER(d.firstName), ' ', LOWER(d.lastName)) LIKE :name")
            ->orWhere("CONCAT(LOWER(d.firstName), ' ', LOWER(d.middleName), ' ', LOWER(d.lastName)) LIKE :name")
            ->setMaxResults(32)
            ->orderBy('d.id', 'DESC')
            ->setFirstResult(0);

        $qb->setParameter(':name', '%' . strtolower($query) . '%');

        // also allow searching for donor or member numbers
        if (is_numeric($query)) {
            $qb->orWhere('d.id = :id')
                ->orWhere('d.lidnr = :lidnr');
            $qb->setParameter(':id', $query)
                ->setParameter(':lidnr', $query);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * Find all members.
     *
     * @return array of members
     */
    public function findAll()
    {
        return $this->getRepository()->findAll();
    }

    /**
     * Find a donor (by their id).
     *
     * @param int $id
     *
     * @return DonorModel
     */
    public function find($id)
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('d')
            ->from('Database\Model\Donor', 'd')
            ->where('d.id = :id');

        $qb->setParameter(':id', $id);

        return $qb->getQuery()->getSingleResult();
    }

    /**
     * Persist a donor model.
     *
     * @param DonorModel $donor Donor to persist.
     */
    public function persist(DonorModel $donor)
    {
        $this->em->persist($donor);
        $this->em->flush();
    }

    /**
     * Remove a member.
     *
     * @param DonorModel $donor Member to remove
     */
    public function remove(DonorModel $donor)
    {
        $this->em->remove($donor);
        $this->em->flush();
    }

    /**
     * Get the repository for this mapper.
     *
     * @return Doctrine\ORM\EntityRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository('Database\Model\Donor');
    }

}
