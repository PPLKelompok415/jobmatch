<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Applicant;
use App\Services\JobMatchingService;

class JobMatchingComponent extends Component
{
    public $applicantId;
    public $matchedJobs = [];

    public function mount($applicantId)
    {
        $this->applicantId = $applicantId;
    }

    public function match()
    {
        $applicant = Applicant::findOrFail($this->applicantId);
        $service = app(JobMatchingService::class);
        $this->matchedJobs = $service->match($applicant);
    }

    public function render()
    {
        return view('livewire.job-matching-component');
    }
}
