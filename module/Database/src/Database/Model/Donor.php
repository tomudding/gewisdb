<?php

namespace Database\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Donor model.
 *
 * @ORM\Entity
 */
class Donor
{

    /**
     * The donor id.
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * Member.
     *
     * @ORM\ManyToOne(targetEntity="Database\Model\Member")
     * @ORM\JoinColumn(name="lidnr", referencedColumnName="lidnr")
     */
    protected $member;

    /**
     * Donor's last name.
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $lastName;

    /**
     * Middle name.
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $middleName;

    /**
     * Initials.
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $initials;

    /**
     * First name.
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $firstName;

    /**
     * Country.
     *
     * By default, netherlands.
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $country;

    /**
     * Street.
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $street;

    /**
     * House number (+ suffix)
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $number;

    /**
     * Postal code.
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $postalCode;

    /**
     * City.
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $city;

    /**
     * If the donor receives a 'supremum'
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $supremum;

    /**
     * Get the ID.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the ID.
     *
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}