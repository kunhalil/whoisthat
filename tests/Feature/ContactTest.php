<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\ApiTestCase;

class ContactTest extends ApiTestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Test to retrieve all contacts - paginated.
     *
     * @return void
     */
    public function test_get_paginated_contacts()
    {
        // $this->withoutExceptionHandling();

        $attributes = Contact::factory()->raw();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->token,
        ])
        ->json('GET', '/api/v1/contacts/collection?page=')
        ->assertJsonStructure([
            'data' => [
                '*' => array_keys($attributes)
            ]
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test to create new user.
     *
     * @return void
     */
    public function test_create_a_contact()
    {
        $attributes = Contact::factory()->raw();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->token,
        ])
        ->json('POST', 'api/v1/contacts', $attributes)
        ->assertJsonStructure([
            'data' => array_keys($attributes)
        ]);

        $this->assertDatabaseHas('contacts', $attributes);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    /**
     * Test to retrieve a single user.
     *
     * @return void
     */
    public function test_get_a_single_contact()
    {
        $showContactId = 1;
        $contact = Contact::find($showContactId);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->token,
        ])
        ->json('GET', '/api/v1/contacts/' . $contact->id)
        ->assertExactJson([
            'data' => [
                'id' => $contact->id,
                'first_name' => $contact->first_name,
                'last_name' => $contact->last_name,
                'email' => $contact->email,
                'phone' => $contact->phone,
                'address' => $contact->address,
                'town_city' => $contact->town_city,
                'region_county' => $contact->region_county,
                'country_code' => $contact->country_code,
                'post_code' => $contact->post_code,
                'notes' => $contact->notes,
            ]
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test to edit a user.
     *
     * @return void
     */
    public function test_edit_a_contact()
    {
        $editContactId = 1;

        $attributes = Contact::factory()->raw();
        $contact = Contact::find($editContactId);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->token,
        ])
        ->json('PUT', 'api/v1/contacts/' . $contact->id, $attributes)
        ->assertExactJson([
            'data' => array_merge([
                'id' => $contact->id,
                // 'created_at' => (string)$contact->created_at,
            ], $attributes)
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test to retrieve contacts by matching contact first or last names with given string.
     *
     * @return void
     */
    public function test_find_contact_by_name()
    {
        $attributes = Contact::factory()->raw();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->token,
        ])
        ->json('GET', '/api/v1/contacts?name=Laura')
        ->assertJsonStructure([
            'data' => [
                '*' => array_keys($attributes)
            ]
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test to retrieve contacts by matching company names with given string.
     *
     * @return void
     */
    public function test_find_contact_by_company_name()
    {
        $attributes = Contact::factory()->raw();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->token,
        ])
        ->json('GET', '/api/v1/contacts?company=Schroeder')
        ->assertJsonStructure([
            'data' => [
                '*' => array_keys($attributes)
            ]
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test to create note for a user.
     *
     * @return void
     */
    public function test_create_note_for_a_contact()
    {
        $contactId = 1;
        $attributes = [
            'note' => $this->faker->sentence(),
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->token,
        ])
        ->json('PUT', 'api/v1/contacts/1/note', $attributes)
        ->assertJsonStructure([
            'data' => [
                'notes' => [
                    '*' => ['note']
                ],
            ]
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }
}
