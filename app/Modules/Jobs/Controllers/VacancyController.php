<?php

namespace App\Modules\Jobs\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use App\Modules\Jobs\Requests\VacancyRequest;
use App\Modules\Jobs\Resources\VacancyResource;

class VacancyController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $vacancies = auth()->user()->company->vacancies()->paginate(10);
        return $this->paginatedCollection('Vacancies retrieved', $vacancies);
    }

    public function show($id)
    {
        $vacancy = auth()->user()->company->vacancies()->find($id);
        if (!$vacancy) return $this->notFoundResponse();
        return $this->successResponse('Vacancy retrieved', new VacancyResource($vacancy));
    }

    public function store(VacancyRequest $request)
    {
        $vacancy = auth()->user()->company->vacancies()->create($request->validated());
        return $this->createdResponse('Vacancy created', new VacancyResource($vacancy));
    }

    public function update(VacancyRequest $request, $id)
    {
        $vacancy = auth()->user()->company->vacancies()->find($id);
        if (!$vacancy) return $this->notFoundResponse();
        $vacancy->update($request->validated());
        return $this->successResponse('Vacancy updated', new VacancyResource($vacancy));
    }

    public function destroy($id)
    {
        $vacancy = auth()->user()->company->vacancies()->find($id);
        if (!$vacancy) return $this->notFoundResponse();
        $vacancy->delete();
        return $this->successMessageResponse('Vacancy deleted');
    }

    public function toggle($id)
    {
        $vacancy = auth()->user()->company->vacancies()->find($id);
        if (!$vacancy) return $this->notFoundResponse();
        $vacancy->is_active = !$vacancy->is_active;
        $vacancy->save();
        return $this->successResponse('Vacancy status updated', new VacancyResource($vacancy));
    }
}
