<?php

namespace App\Entity;

use App\Repository\EndpointRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EndpointRepository::class)]
class Endpoint
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $path = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, Application>
     */
    #[ORM\ManyToMany(targetEntity: Application::class, inversedBy: 'endpoints')]
    private Collection $application;

    public function __construct()
    {
        $this->application = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): static
    {
        $this->path = $path;

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
     * @return Collection<int, Application>
     */
    public function getApplication(): Collection
    {
        return $this->application;
    }

    public function addApplication(Application $application): static
    {
        if (!$this->application->contains($application)) {
            $this->application->add($application);
        }

        return $this;
    }

    public function removeApplication(Application $application): static
    {
        $this->application->removeElement($application);

        return $this;
    }
}
