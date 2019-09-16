<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Data;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DataTest extends TestCase
{
    public function can_create_data()
    {
        $data = '[{"first_name":"ladee","last_name":"linter","age":99,"email":"lindaladee@causelabs.com","secret":"asdfasdf","name":"ladee linter"},{"first_name":"cody","last_name":"duder","age":38,"email":"codyduder@causelabs.com","secret":"asdflj","name":"cody duder"}]';

        $this->post(route('data.store'), $data)
            ->assertStatus(201);
    }

    public function can_show_data()
    {
        $data = factory(Data::class)->create();

        $this->get(route('data.fetch'))
            ->assertStatus(200);
    }

    public function can_delete_data()
    {
        $data = factory(Data::class)->create();

        $this->delete(route('data.delete', $data->id))
            ->assertStatus(204);
    }
}
