<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * A user can create a project
     *
     * @return void
     */
    public function testUserCanCreateProject()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];
        $this->post(route('projects.store', $attributes))->assertRedirect(route('projects.index'));

        $this->assertDatabaseHas('projects', $attributes);

        $this->get(route('projects.index'))->assertSee($attributes['title']);
    }

    public function testUserCanViewProject(){
        $this->withoutExceptionHandling();

        $project = factory(Project::class)->create();

        // Pass the primary key of the Project model to the 'project' route parameter
        $this->get(route('projects.show', compact('project')))
            ->assertSee($project->description);
    }

    public function testProjectRequiresTitle(){
        $attributes = factory(Project::class)->raw(['title' => '']);
        $this->post(route('projects.store'), $attributes)->assertSessionHasErrors('title');
    }

    public function testProjectRequiresDescription(){
        $attributes = factory(Project::class)->raw(['description' => '']);
        $this->post(route('projects.store'), $attributes)->assertSessionHasErrors('description');
    }
}
