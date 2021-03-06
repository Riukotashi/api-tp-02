<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


abstract class EntityCreated
{

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }
}