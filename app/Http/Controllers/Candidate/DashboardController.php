<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    use ResponseTrait;

    public function __invoke(): JsonResponse
    {
        $candidate = auth()->user()->candidate;

        $data = [
            'applications_count' => $candidate->vacanciesApplied()->count(),
            'saved_vacancies_count' => $candidate->savedVacancies()->count(),
            'interview_vacancies_count' => $candidate->vacanciesApplied()->interview()->count(),
            'hired_vacancies_count' => $candidate->vacanciesApplied()->hired()->count(),

            'recent_saved_jobs'   => $this->recentSavedJobs($candidate),
            'recent_applied_jobs' => $this->recentAppliedJobs($candidate),
        ];
        return $this->successResponse('Dashboard retrieved', $data);
    }

    private function recentSavedJobs($candidate)
    {
        return $candidate->savedVacancies()
            ->with(['vacancy' => fn($q) => $q->withCompanyBasic()])
            ->latest()
            ->take(5)
            ->get();
    }

    private function recentAppliedJobs($candidate)
    {
        return $candidate->vacanciesApplied()
            ->with(['vacancy' => fn($q) => $q->withCompanyBasic()])
            ->latest()
            ->take(5)
            ->get();
    }


}
