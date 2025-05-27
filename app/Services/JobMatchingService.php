<?php

namespace App\Services;

use App\Models\Applicant;
use App\Models\Job;
use Illuminate\Support\Collection;

class JobMatchingService
{
    public static function makeMatches(Applicant $applicant): Collection
    {
        // Bobot penilaian
        $weights = [
            'hard_skill'    => 0.50,
            'soft_skill'    => 0.20,
            'location'      => 0.15,
            'type_of_work'  => 0.15,
        ];

        // Ambil semua pekerjaan dengan relasi skill
        $jobs = Job::with(['hardSkills', 'softSkills'])->get();

        // Data profil applicant
        $appHardSkills = $applicant->hardSkills->pluck('name')->toArray();
        $appSoftSkills = $applicant->softSkills->pluck('name')->toArray();
        $appLocation   = strtolower($applicant->location ?? '');
        
        // Pecah jika berupa string
        $appJobTypes = is_array($applicant->type_of_work)
            ? $applicant->type_of_work
            : explode(',', $applicant->type_of_work ?? '');

        return $jobs->map(function (Job $job) use ($appHardSkills, $appSoftSkills, $appLocation, $appJobTypes, $weights) {

            $requiredHard = $job->hardSkills->pluck('name')->toArray();
            $requiredSoft = $job->softSkills->pluck('name')->toArray();

            $hardRatio = count($requiredHard)
                ? count(array_intersect($appHardSkills, $requiredHard)) / count($requiredHard)
                : 1;

            $softRatio = count($requiredSoft)
                ? count(array_intersect($appSoftSkills, $requiredSoft)) / count($requiredSoft)
                : 1;

            $locationMatch = strtolower($job->location) === $appLocation ? 1 : 0;

            $typeMatch = in_array($job->type_of_work, $appJobTypes) ? 1 : 0;

            $score = (
                $hardRatio     * $weights['hard_skill'] +
                $softRatio     * $weights['soft_skill'] +
                $locationMatch * $weights['location'] +
                $typeMatch     * $weights['type_of_work']
            );

            $job->match_score = (int) round($score * 100);

            return $job;
        })
        ->sortByDesc('match_score')
        ->values();
    }
}
