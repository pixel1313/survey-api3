<?php

namespace App\State;

use ApiPlatform\Doctrine\Common\State\PersistProcessor;
use ApiPlatform\Doctrine\Common\State\RemoveProcessor;
use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\ApiResource\SurveyApi;
use App\Entity\Survey;
use App\Repository\SurveyRepository;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class EntityClassDtoStateProcessor implements ProcessorInterface
{
    public function __construct(
        private SurveyRepository $surveyRepository,
        #[Autowire(service: PersistProcessor::class)] private ProcessorInterface $persistProcessor,
        #[Autowire(service: RemoveProcessor::class)] private ProcessorInterface $removeProcessor,
    )
    {

    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        assert($data instanceof SurveyApi);

        $entity = $this->mapDtoToEntity($data);

        if($operation instanceof DeleteOperationInterface) {
            $this->removeProcessor->process($entity, $operation, $uriVariables, $context);

            return null;
        }

        $this->persistProcessor->process($entity, $operation, $uriVariables, $context);
        $data->id = $entity->getId();

        return $data;
    }

    private function mapDtoToEntity(object $dto): object
    {
        assert($dto instanceof SurveyApi);

        if($dto->id) {
            $entity = $this->surveyRepository->find($dto->id);

            if(!$entity) {
                throw new \Exception(sprintf('Entity %d not found', $dto->id));
            }
        } else {
            $entity = new Survey();
        }

        $entity->setName($dto->name);
        $entity->setDescription($dto->description);
        $entity->setCreatedAt($dto->createdAt);
        $entity->setIsPublished($dto->isPublished);

        return $entity;
    }
}
