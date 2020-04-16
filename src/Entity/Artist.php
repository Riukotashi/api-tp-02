<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Dto\ArtistOutput;

/**
 * @ApiResource(
 *  output=ArtistOutput::class,
 *  normalizationContext={"groups"={"artist_read"}}
 * )
 * 
 * @ApiFilter(SearchFilter::class, properties={"name": "ipartial", "styles.name": "ipartial"})
 * @ORM\Entity(repositoryClass="App\Repository\ArtistRepository")
 */
class Artist extends EntityCreated
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"album_read", "user_read"})
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"album_read", "user_read"})
     */
    private $startYear;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Album", mappedBy="artist", orphanRemoval=true)
     */
    private $albums;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Style", mappedBy="artists")
     */
    private $styles;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="artists")
     */
    private $users;

    public function __construct()
    {
        $this->albums = new ArrayCollection();
        $this->styles = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStartYear(): ?int
    {
        return $this->startYear;
    }

    public function setStartYear(int $startYear): self
    {
        $this->startYear = $startYear;

        return $this;
    }

    /**
     * @return Collection|Album[]
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    public function addAlbum(Album $album): self
    {
        if (!$this->albums->contains($album)) {
            $this->albums[] = $album;
            $album->setArtist($this);
        }

        return $this;
    }

    public function removeAlbum(Album $album): self
    {
        if ($this->albums->contains($album)) {
            $this->albums->removeElement($album);
            // set the owning side to null (unless already changed)
            if ($album->getArtist() === $this) {
                $album->setArtist(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Style[]
     */
    public function getStyles(): Collection
    {
        return $this->styles;
    }

    public function addStyle(Style $style): self
    {
        if (!$this->styles->contains($style)) {
            $this->styles[] = $style;
            $style->addArtist($this);
        }

        return $this;
    }

    public function removeStyle(Style $style): self
    {
        if ($this->styles->contains($style)) {
            $this->styles->removeElement($style);
            $style->removeArtist($this);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addArtist($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeArtist($this);
        }

        return $this;
    }
}
