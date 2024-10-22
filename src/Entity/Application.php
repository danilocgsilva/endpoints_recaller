<?php

namespace App\Entity;

use App\Repository\ApplicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicationRepository::class)]
class Application
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $application = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    /**
     * @var Collection<int, Endpoint>
     */
    #[ORM\ManyToMany(targetEntity: Endpoint::class, mappedBy: 'application')]
    private Collection $endpoints;

    public function __construct()
    {
        $this->endpoints = new ArrayCollection();
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
     * @return Collection<int, Endpoint>
     */
    public function getEndpoints(): Collection
    {
        return $this->endpoints;
    }

    public function addEndpoint(Endpoint $endpoint): static
    {
        if (!$this->endpoints->contains($endpoint)) {
            $this->endpoints->add($endpoint);
            $endpoint->addApplication($this);
        }

        return $this;
    }

    public function removeEndpoint(Endpoint $endpoint): static
    {
        if ($this->endpoints->removeElement($endpoint)) {
            $endpoint->removeApplication($this);
        }

        return $this;
    }
}
