<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Resources\Vacancy\VacancyResource;
use App\Models\Vacancy;
use App\Traits\ResponseTrait;
use App\Modules\Jobs\Requests\VacancyRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    use ResponseTrait;

    public function index(Request $request): JsonResponse
    {
        $vacancies = Vacancy::withCompanyBasic()->active()->filterVacancies($request)->paginate(10);
        return $this->paginatedCollection('Vacancies retrieved', VacancyResource::collection($vacancies));
    }

    public function show($slug): JsonResponse
    {
        $candidate = auth()->user()->candidate;
        $vacancy = Vacancy::with([
            'company',
            'application' => fn($query) => $query->where('candidate_id', $candidate->id)
        ])
        ->active()
        ->whereSlug($slug)
        ->first();

        if (!$vacancy) return $this->notFoundResponse("Vacancy not found");

        return $this->successResponse('Vacancy retrieved', new VacancyResource($vacancy));
    }
}
