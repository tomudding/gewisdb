<?php

namespace Database\Service;

use Application\Service\AbstractService;
use Database\Model\Donor as DonorModel;

class Donor extends AbstractService
{

    /**
     * Search for a member.
     *
     * @param string $query
     */
    public function search($query)
    {
        return $this->getDonorMapper()->search($query);
    }

    /**
     * Get member info.
     *
     * @param int $id
     *
     * @return DonorModel
     */
    public function getDonor($id)
    {
        return $this->getDonorMapper()->find($id);
    }

    /**
     * Get the donor mapper.
     *
     * @return \Database\Mapper\Donor
     */
    public function getDonorMapper()
    {
        return $this->getServiceManager()->get('database_mapper_donor');
    }
}