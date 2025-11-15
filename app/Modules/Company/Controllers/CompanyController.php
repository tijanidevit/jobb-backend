<?php

namespace App\Modules\Company\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use App\Modules\Company\Requests\UpdateProfileRequest;
use App\Modules\Company\Requests\UploadLogoRequest;
use App\Modules\Company\Requests\UploadVerificationRequest;
use App\Modules\Company\Resources\CompanyResource;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    use ResponseTrait;

    public function dashboard()
    {
        $company = auth()->user()->company;

        $jobsCount = $company->vacancies()->count();
        $applicationsCount = $company->vacancies()->withCount('applications')->get()->sum('applications_count');

        return $this->successResponse('Company dashboard', [
            'jobs_count' => $jobsCount,
            'applications_count' => $applicationsCount,
        ]);
    }

    public function profile()
    {
        $company = auth()->user()->company;
        return $this->successResponse('Company profile retrieved', new CompanyResource($company));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $company = auth()->user()->company;
        $company->update($request->validated());

        return $this->successResponse('Company profile updated', new CompanyResource($company));
    }

    public function uploadLogo(UploadLogoRequest $request)
    {
        $company = auth()->user()->company;
        $path = $request->file('logo')->store('company/logos', 'public');
        $company->logo = $path;
        $company->save();

        return $this->successResponse('Logo uploaded successfully', new CompanyResource($company));
    }

    public function uploadVerification(UploadVerificationRequest $request)
    {
        $company = auth()->user()->company;
        $path = $request->file('document')->store('company/verifications', 'public');
        $company->verification_document = $path;
        $company->save();

        return $this->successResponse('Verification document uploaded', new CompanyResource($company));
    }
}
