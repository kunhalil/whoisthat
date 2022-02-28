<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\ApiTestCase;

class CompanyTest extends ApiTestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Test to retrieve all companies.
     *
     * @return void
     */
    public function test_user_can_request_company_list()
    {
        $attributes = Company::factory()->raw();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->token,
        ])
        ->json('GET', 'api/v1/companies')
        ->assertJsonStructure([
            'data' => [
                '*' => array_keys($attributes)
            ]
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test to retrieve all contacts for a company.
     *
     * @return void
     */
    public function test_user_can_request_all_contacts_for_a_company()
    {
        // $this->withoutExceptionHandling();

        $showCompanyId = 1;
        $contactAttributes = Contact::factory()->raw();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->token,
        ])
        ->json('GET', 'api/v1/companies/' .$showCompanyId. '/contacts')
        ->assertJsonStructure([
            'data' => [
                'contacts' => [
                    '*' => array_keys($contactAttributes)
                ]
            ]
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Save multiple contacts for a company.
     *
     * @return void
     */
    public function test_user_can_save_multiple_contacts_for_a_company()
    {
        $showCompanyId = 1;
        $contactAttributes = Contact::factory()->raw();

        $contactsArray = [];
        $numberOfContactsToCreate = 2;

        for ($i=0; $i < $numberOfContactsToCreate; $i++) {
            $contactsArray[] = Contact::factory()->raw();
        }

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->token,
        ])
        ->json('PUT', 'api/v1/companies/' .$showCompanyId. '/contacts', [
            'contacts' => $contactsArray
        ])
        ->assertJsonStructure([
            'data' => [
                'contacts' => [
                    '*' => array_keys($contactAttributes)
                ],
            ]
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }
}
