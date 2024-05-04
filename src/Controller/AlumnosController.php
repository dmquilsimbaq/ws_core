<?php

namespace App\Controller;

use App\Entity\Alumnos;
use App\Entity\Escuelas;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlumnosController extends AbstractController
{
    #[Route('/alumno/', name: 'crearAlumno', methods: ['POST'])]
    public function crearAlumno(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        if (isset($data['id'])) {
            $alumno = $entityManager->getRepository(Alumnos::class)->find($data['id']);
            if (!$alumno) {
                return $this->json(['error' => 'El Alumno con el ID proporcionado no existe'], Response::HTTP_NOT_FOUND);
            }
        } else {
            $alumno = new Alumnos();
        }
        if (isset($data['escuela']) && $data['escuela'] !== '') {
            $alumno->setEscuela($data['escuela']);
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo escuela']);
        }
        if (isset($data['categoria']) && $data['categoria'] !== '') {
            $alumno->setCategoria($data['categoria']);
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo categoria']);
        }
        if (isset($data['cedula']) && $data['cedula'] !== '') {
            $alumno->setCedula($data['cedula']);
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo cedula']);
        }
        if (isset($data['nombres']) && $data['nombres'] !== '') {
            $alumno->setNombres($data['nombres']);
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo nombres']);
        }
        if (isset($data['apellidos']) && $data['apellidos'] !== '') {
            $alumno->setApellidos($data['apellidos']);
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo apellidos']);
        }
        if (isset($data['genero']) && $data['genero'] !== '') {
            $alumno->setGenero($data['genero']);
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo genero']);
        }
        if (isset($data['estatura']) && $data['estatura'] !== '') {
            $alumno->setEstatura($data['estatura']);
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo estatura']);
        }
        if (isset($data['peso']) && $data['peso'] !== '') {
            $alumno->setPeso($data['peso']);
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo peso']);
        }
        if (isset($data['edad']) && $data['edad'] !== '') {
            $alumno->setEdad($data['edad']);
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo edad']);
        }
        $entityManager->persist($alumno);
        $entityManager->flush();
        if (isset($data['id'])) {
            return $this->consultarAlumnoPorId($data['id'], $entityManager);
        } else {
            return $this->json(['error' => 0,'mensaje' =>'Alumno ingresado correctamente', 'datos' => [$alumno]]);
        }
    }

    #[Route('/alumno/{id<\d+>?}', name: 'consultarAlumno', methods: ['GET'])]
    public function consultarAlumnoPorId(?int $id, EntityManagerInterface $entityManager): Response
    {
        $w_alumnos = [];
        if ($id === null) {
            $alumnos = $entityManager->getRepository(Alumnos::class)->findAll();
            foreach ($alumnos as $key => $value) {
                $w_escuelas = $entityManager->getRepository(Escuelas::class)->find($value->getEscuela());
                $w_aux = [
                    "id" =>  $value->getId(),
                    "escuela" => $value->getEscuela(),
                    "cedula" => $value->getCedula(),
                    "nombres" => $value->getNombres(),
                    "apellidos" => $value->getApellidos(),
                    "genero" => $value->getGenero(),
                    "estatura" => $value->getEstatura(),
                    "peso" => $value->getPeso(),
                    "edad" => $value->getEdad(),
                    "escuela_nombre" => $w_escuelas->getNombre(),
                ];
                array_push($w_alumnos, $w_aux);
            }
            return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $w_alumnos]);
        }
        $alumno[0] = $entityManager->getRepository(Alumnos::class)->find($id);
        if (!$alumno) {
            return $this->json(['error' => 0, 'mensaje' => 'La Alumno con el ID proporcionado no existe']);
        }
        if ($alumno[0] == null)
            return $this->json(
                ['error' => 9999, 'mensaje' => 'No cuenta con datos' ]
            );
            $w_escuelas = $entityManager->getRepository(Escuelas::class)->find($alumno[0]->getEscuela());
                    $w_aux = [
                    "id" => $alumno[0]->getId(),
                    "escuela" => $alumno[0]->getEscuela(),
                    "cedula" => $alumno[0]->getCedula(),
                    "nombres" => $alumno[0]->getNombres(),
                    "apellidos" => $alumno[0]->getApellidos(),
                    "genero" => $alumno[0]->getGenero(),
                    "estatura" => $alumno[0]->getEstatura(),
                    "peso" => $alumno[0]->getPeso(),
                    "edad" => $alumno[0]->getEdad(),
                    "escuela_nombre" => $w_escuelas->getNombre(),
                ];
                array_push($w_alumnos, $w_aux);
        return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $w_alumnos]);
    }
}