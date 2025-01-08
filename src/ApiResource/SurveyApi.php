<?php

namespace App\ApiResource;

use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\Survey;
use App\State\EntityToDtoStateProvider;

#[ApiResource(
    shortName: 'Survey',
    provider: EntityToDtoStateProvider::class,
    stateOptions: new Options(entityClass: Survey::class)
)]
class SurveyApi
{
    public ?int $id = null;
    public ?string $name = null;
    public ?string $description = null;
    public ?\DateTimeImmutable $createdAt = null;
    public ?bool $isPublished = null;
}