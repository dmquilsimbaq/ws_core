<?php

namespace App\Controller;

use App\Entity\JugadoresDestacados;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JugadoresDestacadosController extends AbstractController
{
    #[Route('/jugadores_destacados/', name: 'crearJugadoresDestacados', methods: ['POST'])]
    public function crearJugadoresDestacados(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        if (isset($data['id'])) {
            $jugadores_destacados = $entityManager->getRepository(JugadoresDestacados::class)->find($data['id']);
            if (!$jugadores_destacados) {
                return $this->json(['error' => 'La escuela con el ID proporcionado no existe'], Response::HTTP_NOT_FOUND);
            }
        } else {
            $jugadores_destacados = new JugadoresDestacados();
        }
        if (isset($data['jugador']) && $data['jugador'] !== '') {
            $jugadores_destacados->setJugador($data['jugador']);
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo jugador']);
        }
        if (isset($data['posicion']) && $data['posicion'] !== '') {
            $jugadores_destacados->setPosicion($data['posicion']);
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo posicion']);
        }
        if (isset($data['habilidades']) && $data['habilidades'] !== '') {
            $jugadores_destacados->setHabilidades($data['habilidades']);
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo habilidades']);
        }
        $entityManager->persist($jugadores_destacados);
        $entityManager->flush();
        if (isset($data['id'])) {
            return $this->json(['error' => 0, 'mensaje' => 'Jugador Destacado actualizada correctamente', 'datos' => [$jugadores_destacados]]);
        } else {
            return $this->json(['error' => 0, 'mensaje' => 'Jugador Destacado ingresado correctamente', 'datos' => [$jugadores_destacados]]);
        }
    }

    #[Route('/jugadores_destacados/{id<\d+>?}', name: 'consultarJugadoresDestacados', methods: ['GET'])]
    public function consultarJugadoresDestacados(?int $id, EntityManagerInterface $entityManager): Response
    {
        if ($id === null) {
            $jugadores_destacados = $entityManager->getRepository(JugadoresDestacados::class)->findAll();
            return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $jugadores_destacados]);
        }
        $jugadores_destacados[0] = $entityManager->getRepository(JugadoresDestacados::class)->find($id);
        if (!$jugadores_destacados) {
            return $this->json(['error' => 0, 'mensaje' => 'El Jugador Destacado con el ID proporcionado no existe']);
        }
        if ($jugadores_destacados[0] == null)
            return $this->json(
                ['error' => 9999, 'mensaje' => 'No cuenta con datos']
            );
        return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $jugadores_destacados]);
    }
}