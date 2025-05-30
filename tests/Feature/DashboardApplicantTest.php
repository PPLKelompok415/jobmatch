<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardApplicantTest extends TestCase
{
    use RefreshDatabase;

    
    public function applicant_can_access_dashboard_and_see_matching_and_non_matching_jobs()
    {
        
        $user = User::factory()->create();
        $company = Company::factory()->create();

        
        $job1 = Job::factory()->create([
            'company_id' => $company->id,
            'match_score' => 85, 
        ]);

        $job2 = Job::factory()->create([
            'company_id' => $company->id,
            'match_score' => 70, 
        ]);

        
        $response = $this->actingAs($user)->get('/applicant/dashboard');

        
        $response->assertStatus(200);

        
        $response->assertSee((string) $job1->match_score);
        $response->assertSee((string) $job2->match_score);
    }

   
    public function guest_cannot_access_applicant_dashboard()
    {
        $response = $this->get('/applicant/dashboard');
        $response->assertRedirect('/login');
    }
}
