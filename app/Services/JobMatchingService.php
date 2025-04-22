<?php

namespace App\Services;

use App\Models\Applicant;
use App\Models\Job;

class JobMatchingService
{
    public function match(Applicant $applicant)
    {
        // Ambil hard dan soft skill applicant
        $hardSkills = $applicant->hardSkills()->pluck('skills.id')->toArray();
        $softSkills = $applicant->softSkills()->pluck('skills.id')->toArray();

        // Ambil semua jobs dan relasi skill-nya
        $jobs = Job::with('skills')->get();

        $matchedJobs = $jobs->map(function ($job) use ($applicant, $hardSkills, $softSkills) {
            $score = 0;

            // Matching by basic criteria
            if ($job->location === $applicant->location) $score += 10;
            if ($job->type_of_work === $applicant->type_of_work) $score += 10;
            if (stripos($job->title, $applicant->desired_position) !== false) $score += 5;

            if (
                $job->gaji_min >= $applicant->salary_min &&
                $job->gaji_max <= $applicant->salary_max
            ) {
                $score += 5;
            }

            // Matching skill
            $jobSkillIds = $job->skills->pluck('id')->toArray();
            $hardMatch = count(array_intersect($jobSkillIds, $hardSkills));
            $softMatch = count(array_intersect($jobSkillIds, $softSkills));

            $score += ($hardMatch * 3) + ($softMatch * 1);
            $job->match_score = $score;

            return $job;
        });

        return $matchedJobs->sortByDesc('match_score')->values();
    }
}
