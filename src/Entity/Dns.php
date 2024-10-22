<?php

namespace App\Entity;

use App\Repository\DnsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DnsRepository::class)]
class Dns
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $dns = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, Endpoint>
     */
    #[ORM\OneToMany(targetEntity: Endpoint::class, mappedBy: 'dns')]
    private Collection $endpoints;

    #[ORM\ManyToOne(inversedBy: 'dns')]
    private ?Application $application = null;

    public function __construct()
    {
        $this->endpoints = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDns(): ?string
    {
        return $this->dns;
    }

    public function setDns(string $dns): static
    {
        $this->dns = $dns;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
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
            $endpoint->setDns($this);
        }

        return $this;
    }

    public function removeEndpoint(Endpoint $endpoint): static
    {
        if ($this->endpoints->removeElement($endpoint)) {
            // set the owning side to null (unless already changed)
            if ($endpoint->getDns() === $this) {
                $endpoint->setDns(null);
            }
        }

        return $this;
    }

    public function getApplication(): ?Application
    {
        return $this->application;
    }

    public function setApplication(?Application $application): static
    {
        $this->application = $application;

        return $this;
    }
}
