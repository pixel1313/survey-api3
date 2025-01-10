<?php

namespace App\Mapper;

use App\ApiResource\SurveyApi;
use App\Entity\Survey;
use App\Repository\SurveyRepository;
use Exception;

class SurveyApiToEntityMapper implements MapperInterface
{
    public function __construct(
        private readonly SurveyRepository $surveyRepository
    )
    {
    }

    /**
     * @throws Exception
     */
    public function map(object $from): object
    {
        assert($from instanceof SurveyApi);

        $surveyEntity = $from->id ? $this->surveyRepository->find($from->id) : new Survey();
        if(!$surveyEntity) {
            throw new Exception('Survey not found');
        }

        $surveyEntity->setName($from->name);
        $surveyEntity->setDescription($from->description);
        $surveyEntity->setIsPublished($from->isPublished);
        $surveyEntity->setCreatedAt($from->createdAt);

        return $surveyEntity;
    }
}