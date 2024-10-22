<?php

namespace App\Entity;

use App\Repository\ApplicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicationRepository::class)]
#[ORM\Table(name:"applications")]
class Application
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $application = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, Dns>
     */
    #[ORM\OneToMany(targetEntity: Dns::class, mappedBy: 'application')]
    private Collection $dns;

    public function __construct()
    {
        $this->endpoints = new ArrayCollection();
        $this->dns = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApplication(): ?string
    {
        return $this->application;
    }

    public function setApplication(string $application): static
    {
        $this->application = $application;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Dns>
     */
    public function getDns(): Collection
    {
        return $this->dns;
    }

    public function addDn(Dns $dn): static
    {
        if (!$this->dns->contains($dn)) {
            $this->dns->add($dn);
            $dn->setApplication($this);
        }

        return $this;
    }

    public function removeDn(Dns $dn): static
    {
        if ($this->dns->removeElement($dn)) {
            // set the owning side to null (unless already changed)
            if ($dn->getApplication() === $this) {
                $dn->setApplication(null);
            }
        }

        return $this;
    }
}
