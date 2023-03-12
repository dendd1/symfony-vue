<?php

namespace App\Controller;

use App\Entity\Education;
use App\Entity\Resume;
use App\Repository\EducationRepository;
use App\Repository\ResumeRepository;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class HomeController extends AbstractController
{
    private Serializer $serializer;

    public function __construct()
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $this->serializer = new Serializer([new DateTimeNormalizer(), $normalizer]);
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }

    #[Route('/api/cv/add', name: 'post_resume', methods: ['POST'])]
    public function postResume(Request $request, ResumeRepository $resumeRepository, EducationRepository $educationRepository): JsonResponse
    {
        $parameters = json_decode($request->getContent(), true);


        $resume = new Resume();
        $resume = $resumeRepository->createResume($parameters, $resume);
        $resumeRepository->save($resume, true);

        foreach ($parameters['education'] as $params) {
            $education = new Education();
            $education = $educationRepository->createEducationOption($params, $resume, $education);
            $educationRepository->save($education, true);

        }


        return new JsonResponse([
            'result' => $resume->getId(),
        ]);
    }

    #[Route('/api/cv', name: 'get_resume_list', methods: ['GET'])]
    public function getResumeList(ResumeRepository $resumeRepository, EducationRepository $optionRepository): JsonResponse
    {
        $resumeList = $resumeRepository->findAll();

        $allResume = [];
        foreach ($resumeList as $resumeFromList) {
            $resume = array(
                'profession' => $resumeFromList->getProfession(),
                'photo' => $resumeFromList->getPhoto(),
                'surname' => $resumeFromList->getSurname(),
                'name' => $resumeFromList->getName(),
                'patronymic' => $resumeFromList->getPatronymic(),
                'status' => $resumeFromList->getStatus(),
                'bDate' => $resumeFromList->getBDate(),
                'id' => $resumeFromList->getId(),
            );
            $allResume[] = $resume;
        }

        return new JsonResponse([
            'result' => $allResume,
        ]);
    }

    #[Route('/api/cv/{id}', name: 'get_resume', methods: ['GET'])]
    public function getResume(int $id, ResumeRepository $resumeRepository, EducationRepository $optionRepository): JsonResponse
    {
        $resume = $resumeRepository->find($id);
        if ($resume->getId()) {
            $educations = [];
            foreach ($resume->getEducation() as $educationFromDB) {
                $education = array(
                    'id' => $educationFromDB->getId(),
                    'type' => $educationFromDB->getType(),
                    'institution' => $educationFromDB->getInstitution(),
                    'faculty' => $educationFromDB->getFaculty(),
                    'specialization' => $educationFromDB->getSpecialization(),
                    'Year_ending' => $educationFromDB->getEnding(),
                );
                $educations[] = $education;
            }

            $resumeArr = array(
                'profession' => $resume->getProfession(),
                'city' => $resume->getCity(),
                'photo' => $resume->getPhoto(),
                'surname' => $resume->getSurname(),
                'name' => $resume->getName(),
                'patronymic' => $resume->getPatronymic(),
                'phone' => $resume->getPhone(),
                'mail' => $resume->getMail(),
                'bDate' => $resume->getBDate(),
                'education' => $educations,
                'money' => $resume->getMoney(),
                'skills' => $resume->getSkills(),
                'about' => $resume->getAbout(),
                'status' => $resume->getStatus(),
                'id' => $resume->getId(),
            );
            return new JsonResponse([
                'result' => $resumeArr
            ]);
        } else {
            return new JsonResponse([
                'result' => 0
            ]);
        }
    }

    #[Route('/api/cv/{id}/edit', name: 'edit_resume', methods: ['POST'])]
    public function editResume(int $id, Request $request, ResumeRepository $resumeRepository, EducationRepository $educationRepository): JsonResponse
    {
        $parameters = json_decode($request->getContent(), true);

        $resume = $resumeRepository->find($id);
        if($resume->getId()){
            $resume = $resumeRepository->createResume($parameters, $resume);
            $resumeRepository->save($resume, true);



            $educationOptions = $educationRepository->findBy(['idResume' => $resume->getId()]);

            foreach ($educationOptions as $educationOption) {
                $educationRepository->remove($educationOption, true);
            }



            foreach ($parameters['education'] as $params) {
                $education = new Education();
                $education = $educationRepository->createEducationOption($params, $resume, $education);
                $educationRepository->save($education, true);

            }



        }

        return new JsonResponse([
            'result' => $resume->getId(),
        ]);



    }
    #[Route('/api/cv/{id}/status/update', name: 'edit_resume_status', methods: ['POST'])]
    public function editResumeStatus(int $id, Request $request, ResumeRepository $resumeRepository): JsonResponse
    {
        $parameters = json_decode($request->getContent(), true);

        $resume = $resumeRepository->find($id);

        $resume->setStatus($parameters['status']);

        $resumeRepository->save($resume, true);

        return new JsonResponse([
            'result' => $resume->getId(),
        ]);
    }
}
