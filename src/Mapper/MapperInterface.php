<?php

namespace App\Mapper;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag]
interface MapperInterface
{
    public function map(object $from): object;
}