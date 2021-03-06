<?php

namespace NT\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Command
 *
 * @ORM\Table(name="command")
 * @ORM\Entity(repositoryClass="NT\PlatformBundle\Repository\CommandRepository")
 */
class Command
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="resa_code", type="string", length=255, unique=true)
     */
    private $resaCode;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="resa_date", type="datetime")
     */
    private $resaDate;
    
    /**
    * @ORM\OneToMany(targetEntity="NT\PlatformBundle\Entity\Ticket", mappedBy="command", cascade={"persist"})
    * @ORM\JoinColumn(nullable=false)
    */
    private $tickets; // Notez le « s », une commande est liée à plusieurs billets
    
    /**
    * @var int
    *
    * @ORM\Column(name="total_price", type="integer", nullable=true)
    */
    private $totalPrice;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set resaCode
     *
     * @param integer $resaCode
     *
     * @return Command
     */
    public function setResaCode($resaCode)
    {
        $this->resaCode = $resaCode;

        return $this;
    }

    /**
     * Get resaCode
     *
     * @return int
     */
    public function getResaCode()
    {
        return $this->resaCode;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Command
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set resaDate
     *
     * @param \DateTime $resaDate
     *
     * @return Command
     */
    public function setResaDate($resaDate)
    {
        $this->resaDate = $resaDate;

        return $this;
    }

    /**
     * Get resaDate
     *
     * @return \DateTime
     */
    public function getResaDate()
    {
        return $this->resaDate;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tickets = new \Doctrine\Common\Collections\ArrayCollection();
        $this->resaDate = new \DateTime('Europe/Paris');
        $this->resaCode = uniqid();
    }

    /**
     * Add ticket
     *
     * @param \NT\PlatformBundle\Entity\Ticket $ticket
     *
     * @return Command
     */
    public function addTicket(\NT\PlatformBundle\Entity\Ticket $ticket)
    {
        $this->tickets[] = $ticket;
        $ticket->setCommand($this);
        return $this;
    }

    /**
     * Remove ticket
     *
     * @param \NT\PlatformBundle\Entity\Ticket $ticket
     */
    public function removeTicket(\NT\PlatformBundle\Entity\Ticket $ticket)
    {
        $this->tickets->removeElement($ticket);
    }

    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTickets()
    {
        return $this->tickets;
    }
    
//        public function __toString()
//    {
//        return $this->getId();
//    }
   


    /**
     * Set totalPrice
     *
     * @param integer $totalPrice
     *
     * @return Command
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get totalPrice
     *
     * @return integer
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }
}
