<?php

namespace App\Services;

use App\Models\Applicant;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Support\Collection;

class JobMatchingService
{
    public static function makeMatches(Applicant $applicant): Collection
    {
        $weights = [
            'hard_skill'    => 0.40,
            'soft_skill'    => 0.15,
            'location'      => 0.15,
            'type_of_work'  => 0.15,
            'position'      => 0.10, // bobot tambahan untuk posisi (desired_position)
            'salary'        => 0.05, // bobot tambahan untuk gaji
        ];

        // Ambil semua job dengan relasi yang diperlukan
        $jobs = Job::with(['company', 'hardSkills', 'softSkills'])->get();

        $appHardSkills = $applicant->hardSkills->pluck('name')->toArray();
        $appSoftSkills = $applicant->softSkills->pluck('name')->toArray();
        $appLocation   = strtolower($applicant->location ?? '');
        $appJobTypes   = is_array($applicant->type_of_work)
            ? $applicant->type_of_work
            : explode(',', $applicant->type_of_work ?? '');
        $appDesiredPosition = strtolower($applicant->desired_position ?? '');
        $appSalaryMin = $applicant->salary_min ?? 0;
        $appSalaryMax = $applicant->salary_max ?? PHP_INT_MAX;

        // Ambil semua job_id yang sudah dilamar oleh pelamar ini
        $appliedJobIds = JobApplication::where('applicant_id', $applicant->id)
            ->pluck('job_id')
            ->toArray();

        return $jobs->map(function (Job $job) use (
            $appHardSkills, $appSoftSkills, $appLocation, $appJobTypes,
            $appDesiredPosition, $appSalaryMin, $appSalaryMax,
            $weights, $appliedJobIds
        ) {
            $requiredHard = $job->hardSkills->pluck('name')->toArray();
            $requiredSoft = $job->softSkills->pluck('name')->toArray();

            $hardRatio = count($requiredHard)
                ? count(array_intersect($appHardSkills, $requiredHard)) / count($requiredHard)
                : 1;

            $softRatio = count($requiredSoft)
                ? count(array_intersect($appSoftSkills, $requiredSoft)) / count($requiredSoft)
                : 1;

            $locationMatch = strtolower($job->location) === $appLocation ? 1 : 0;
            $typeMatch     = in_array($job->type_of_work, $appJobTypes) ? 1 : 0;

            // Cek posisi: apakah desired_position ada dalam job title (case-insensitive)
            $positionMatch = $appDesiredPosition && stripos($job->title, $appDesiredPosition) !== false ? 1 : 0;

            // Cek gaji apakah sesuai range pelamar
            // Asumsi gaji_min dan gaji_max di job tersimpan sebagai integer
            $salaryMatch = (
                $job->gaji_min >= $appSalaryMin &&
                $job->gaji_max <= $appSalaryMax
            ) ? 1 : 0;

            $score = (
                $hardRatio     * $weights['hard_skill'] +
                $softRatio     * $weights['soft_skill'] +
                $locationMatch * $weights['location'] +
                $typeMatch     * $weights['type_of_work'] +
                $positionMatch * $weights['position'] +
                $salaryMatch   * $weights['salary']
            );

            $job->match_score = (int) round($score * 100);

            // Tandai apakah user sudah melamar
            $job->applied = in_array($job->id, $appliedJobIds);

            return $job;
        })
        ->sortByDesc('match_score')
        ->take(4) // Ambil 4 job teratas
        ->values();
    }
}
