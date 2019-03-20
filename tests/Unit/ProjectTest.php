<?php

namespace Tests\Unit;

use App\Http\Controllers\ProjectsController;
use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testHasPath()
    {
        $project = factory(Project::class)->create();
        $this->assertEquals(
            "/projects/{$project->id}",
            action(
                [ProjectsController::class, 'show'],
                $project->id,
                false
            )
        );
    }
}
