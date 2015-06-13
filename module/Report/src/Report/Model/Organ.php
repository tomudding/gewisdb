<?php

namespace Report\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Organ entity.
 *
 * Note that this entity is derived from the decisions themself.
 *
 * @ORM\Entity
 */
class Organ
{

    const ORGAN_TYPE_COMMITTEE = 'committee';
    const ORGAN_TYPE_AV_COMMITTEE = 'avc';
    const ORGAN_TYPE_FRATERNITY = 'fraternity';

    /**
     * Id.
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * Abbreviation (only for when organs are created)
     *
     * @ORM\Column(type="string")
     */
    protected $abbr;

    /**
     * Name (only for when organs are created)
     *
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * Type of the organ.
     *
     * @ORM\Column(type="string")
     */
    protected $type;

    /**
     * Reference to foundation of organ.
     *
     * @ORM\OneToOne(targetEntity="Report\Model\SubDecision\Foundation",inversedBy="organ")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="r_meeting_type", referencedColumnName="meeting_type"),
     *  @ORM\JoinColumn(name="r_meeting_number", referencedColumnName="meeting_number"),
     *  @ORM\JoinColumn(name="r_decision_point", referencedColumnName="decision_point"),
     *  @ORM\JoinColumn(name="r_decision_number", referencedColumnName="decision_number"),
     *  @ORM\JoinColumn(name="r_number", referencedColumnName="number")
     * })
     */
    protected $foundation;

    /**
     * Foundation date.
     *
     * @ORM\Column(type="date")
     */
    protected $foundationDate;

    /**
     * Abrogation date.
     *
     * @ORM\Column(type="date", nullable=true)
     */
    protected $abrogationDate;

    /**
     * Reference to members.
     *
     * @ORM\OneToMany(targetEntity="OrganMember",mappedBy="organ")
     */
    protected $members;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->members = new ArrayCollection();
    }

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

    /**
     * Get the abbreviation.
     *
     * @return string
     */
    public function getAbbr()
    {
        return $this->abbr;
    }

    /**
     * Set the abbreviation.
     *
     * @param string $abbr
     */
    public function setAbbr($abbr)
    {
        $this->abbr = $abbr;
    }

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the name.
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get the type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the type.
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get the foundation.
     *
     * @return Report\Model\SubDecision\Foundation
     */
    public function getFoundation()
    {
        return $this->foundation;
    }

    /**
     * Set the foundation.
     *
     * @param Report\Model\SubDecision\Foundation $foundation
     */
    public function setFoundation($foundation)
    {
        $this->foundation = $foundation;
    }

    /**
     * Get the foundation date.
     *
     * @return DateTime
     */
    public function getFoundationDate()
    {
        return $this->foundationDate;
    }

    /**
     * Set the foundation date.
     *
     * @param DateTime $foundationDate
     */
    public function setFoundationDate(\DateTime $foundationDate)
    {
        $this->foundationDate = $foundationDate;
    }

    /**
     * Get the abrogation date.
     *
     * @return DateTime
     */
    public function getAbrogationDate()
    {
        return $this->abrogationDate;
    }

    /**
     * Set the abrogation date.
     *
     * @param DateTime $abrogationDate
     */
    public function setAbrogationDate(\DateTime $abrogationDate)
    {
        $this->abrogationDate = $abrogationDate;
    }

    /**
     * Get the members.
     *
     * @return OrganMember
     */
    public function getMembers()
    {
        return $this->members;
    }
}
