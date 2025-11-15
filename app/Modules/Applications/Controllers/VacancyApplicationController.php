<?php

namespace App\Modules\Applications\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use App\Models\VacancyApplication;
use Illuminate\Http\Request;
use App\Modules\Applications\Resources\VacancyApplicationResource;

class VacancyApplicationController extends Controller
{
    use ResponseTrait;

    public function index($jobId)
    {
        $applications = auth()->user()->company->vacancies()->find($jobId)
            ->applications()->paginate(10);

        return $this->paginatedCollection('Applications retrieved', $applications);
    }

    public function show($jobId, $applicationId)
    {
        $application = auth()->user()->company->vacancies()->find($jobId)
            ->applications()->find($applicationId);

        if (!$application) return $this->notFoundResponse();
        return $this->successResponse('Application retrieved', new VacancyApplicationResource($application));
    }

    public function updateStatus(Request $request, $id)
    {
        $application = VacancyApplication::find($id);
        if (!$application) return $this->notFoundResponse();

        $application->status = $request->status;
        $application->save();

        return $this->successResponse('Application status updated', new VacancyApplicationResource($application));
    }

    public function reject(Request $request, $id)
    {
        $application = VacancyApplication::find($id);
        if (!$application) return $this->notFoundResponse();

        $application->status = 'rejected';
        $application->rejection_note = $request->note ?? null;
        $application->save();

        return $this->successResponse('Application rejected', new VacancyApplicationResource($application));
    }

    public function sendOffer(Request $request, $id)
    {
        $application = VacancyApplication::find($id);
        if (!$application) return $this->notFoundResponse();

        $application->status = 'offered';
        $application->offer_letter = $request->offer_letter ?? null;
        $application->save();

        return $this->successResponse('Offer letter sent', new VacancyApplicationResource($application));
    }
}
