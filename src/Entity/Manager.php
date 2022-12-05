<?php

namespace App\Entity;

use App\Repository\ManagerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ManagerRepository::class)]
class Manager extends User
{
    #[ORM\OneToMany(mappedBy: 'manager', targetEntity: Pub::class, orphanRemoval: true)]
    private Collection $pubs;

    public function __construct()
    {
        $this->pubs = new ArrayCollection();
    }

    /**
     * @return Collection<int, Pub>
     */
    public function getPubs(): Collection
    {
        return $this->pubs;
    }

    public function addPub(Pub $pub): self
    {
        if (!$this->pubs->contains($pub)) {
            $this->pubs->add($pub);
            $pub->setManager($this);
        }

        return $this;
    }

    public function removePub(Pub $pub): self
    {
        if ($this->pubs->removeElement($pub)) {
            // set the owning side to null (unless already changed)
            if ($pub->getManager() === $this) {
                $pub->setManager(null);
            }
        }

        return $this;
    }
}
