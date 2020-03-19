<?php

namespace Tests\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class PhoneControllerTest extends TestCase
{
    /**
     * Test Network type rersponse.
     *
     * @return void
     */
    public function testNetworkType()
    {
        $number = [ 'phone' => "09354209109"];
        $response = $this->post('/api/network-type', $number);
        $response->assertStatus(200)
                ->assertSeeText('MTN', $escaped = true);

        $number = [ 'phone' => "09127671827"];
        $response = $this->post('/api/network-type', $number);
        $response->assertStatus(200)
                ->assertSeeText('IMI', $escaped = true);
    }

    /**
     * Test Network Type validations.
     *
     * @return void
     */
    public function testNetworkTypeValidation()
    {
        $number = [ 'phone' => ""];
        $this->json('POST', '/api/network-type', $number)
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'phone' => ["The phone field is required."],
                ]
            ]);

        $number = [ 'phone' => "09835412"];
        $this->json('POST', '/api/network-type', $number)
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'phone' => ["The phone format is invalid."],
                ]
            ]);
    }
}
