<?php

namespace App\Controller;
use App\Repository\AlumnosRepository;
use App\Entity\Alumnos;
use App\Entity\Escuelas;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlumnosController extends AbstractController
{
    private $alumnosRepository;

    public function __construct(AlumnosRepository $alumnosRepository)
    {
        $this->alumnosRepository = $alumnosRepository;
    }

    #[Route('/alumnoNuevo', name: 'crearAlumno', methods: ['POST'])]
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
            $alumno->setEscuela($entityManager->getRepository(Escuelas::class)->find($data['escuela']));
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
        if ($id !== null) {
            $alumnos = $this->alumnosRepository->findAlumnosCompleto($id);
            if ($alumnos) {
                return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $alumnos]);
            }
            return $this->json(['error' => 9999, 'mensaje' => 'No cuenta con datos']);
        }else{
            $alumnos = $this->alumnosRepository->findTodosAlumnosCompleto();
            if ($alumnos) {
                return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $alumnos]);
            }
            return $this->json(['error' => 9999, 'mensaje' => 'No cuenta con datos']);
        }
        // return $this->json(['error' => 9998, 'mensaje' => 'ID no proporcionado']);
    }
    #[Route('/alumnoEliminar/{id<\d+>?}', name: 'eliminarAlumno', methods: ['GET'])]
    public function eliminarAlumno(?int $id, EntityManagerInterface $entityManager): Response
    {
        $alumno = $entityManager->getRepository(Alumnos::class)->find($id);
        if (!$alumno) {
            return $this->json(['error' => 0, 'mensaje' => 'El alumno con el ID proporcionado no existe']);
        }
        $entityManager->remove($alumno);
        $entityManager->flush();
        return $this->json(['error' => 0, 'mensaje' => 'Eliminado correctamente']);
    }
    // 

    #[Route('/alumno_escuela/{id<\d+>?}', name: 'consultarAlumnoPorEscuela', methods: ['GET'])]
    public function consultarAlumnoPorEscuela(?int $id, EntityManagerInterface $entityManager): Response
    {
        if ($id !== null) {
            $alumnos = $this->alumnosRepository->findAlumnosByEscuelaId($id);
            if ($alumnos) {
                return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $alumnos]);
            }
            return $this->json(['error' => 9999, 'mensaje' => 'No cuenta con datos']);
        }
        return $this->json(['error' => 9998, 'mensaje' => 'ID no proporcionado']);
    }
}