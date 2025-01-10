<?php

namespace App\Service;

use App\ApiResource\SurveyApi;
use App\Mapper\MapperInterface;
use App\Mapper\SurveyApiToEntityMapper;
use Psr\Log\LoggerInterface;

class MapperService
{
    private array $mappers = [];

    public function __construct(
        SurveyApiToEntityMapper $surveyApiToEntityMapper,
    )
    {
        $this->mappers[SurveyApi::class] = $surveyApiToEntityMapper;
    }

    public function map(object $from): object
    {
        return $this->mappers[get_class($from)]->map($from);
    }

    public function addMapper(MapperInterface $mapper) {
        $this->mappers[] = $mapper;
    }
}