<?php

namespace App\Tests;

use App\Factory\SurveyFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Browser\Test\HasBrowser;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class SurveyResourceTest extends KernelTestCase
{
    use HasBrowser;
    use ResetDatabase;
    use Factories;

    public function testGetCollectionOfSurveys(): void
    {
        SurveyFactory::createMany(5);

        $this->browser()
            ->get('api/surveys')
            //->dump()
            ->assertJson()
            ->assertJsonMatches('keys(member[0])', [
                '@id',
                '@type',
                'id',
                'name',
                'description',
                'createdAt',
                'isPublished',
            ]);
    }

    public function testSomething(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        // $routerService = static::getContainer()->get('router');
        // $myCustomService = static::getContainer()->get(CustomService::class);
    }
}
