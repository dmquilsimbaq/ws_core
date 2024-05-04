<?php

namespace App\Entity;

use App\Repository\JugadoresDestacadosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JugadoresDestacadosRepository::class)]
class JugadoresDestacados
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $jugador = null;

    #[ORM\Column(length: 100)]
    private ?string $posicion = null;

    #[ORM\Column(length: 100)]
    private ?string $habilidades = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJugador(): ?int
    {
        return $this->jugador;
    }

    public function setJugador(int $jugador): static
    {
        $this->jugador = $jugador;

        return $this;
    }

    public function getPosicion(): ?string
    {
        return $this->posicion;
    }

    public function setPosicion(string $posicion): static
    {
        $this->posicion = $posicion;

        return $this;
    }

    public function getHabilidades(): ?string
    {
        return $this->habilidades;
    }

    public function setHabilidades(string $habilidades): static
    {
        $this->habilidades = $habilidades;

        return $this;
    }
}
