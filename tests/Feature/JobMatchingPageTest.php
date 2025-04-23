<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Applicant;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;

class JobMatchingPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function job_matching_page_can_be_accessed()
{
    // Buat user dummy terlebih dahulu
    $user = User::factory()->create();

    // Buat applicant dan hubungkan dengan user tersebut
    $applicant = Applicant::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->get('/match-jobs/' . $applicant->id);

    $response->assertStatus(200);
}
}
