<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use App\Models\Company;
use App\Models\Vacancy;
use App\Models\VacancyApplication;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use ResponseTrait;

    public function dashboard()
    {
        $totalCompanies = Company::count();
        $totalVacancies = Vacancy::count();
        $totalApplications = VacancyApplication::count();
        $totalHired = VacancyApplication::hired()->count();

        $data = [
            'total_companies' => $totalCompanies,
            'total_vacancies' => $totalVacancies,
            'total_applications' => $totalApplications,
            'total_hired' => $totalHired,
        ];

        return $this->successResponse('Admin dashboard metrics', $data);
    }

    public function companies()
    {
        $companies = Company::with('creator')->paginate(10);

        return $this->paginatedCollection('Companies retrieved successfully', $companies);
    }

    public function verifyCompany(Request $request, $id)
    {
        $company = Company::find($id);

        if (!$company) {
            return $this->notFoundResponse('Company not found');
        }

        $company->is_verified = true;
        $company->save();

        return $this->successResponse('Company verified successfully', $company);
    }

    public function jobs()
    {
        $jobs = Vacancy::with('company')->paginate(10);
        return $this->paginatedCollection('Jobs retrieved successfully', $jobs);
    }

    public function applicants()
    {
        $applications = VacancyApplication::with(['vacancy', 'creator'])->paginate(10);
        return $this->paginatedCollection('Applicants retrieved successfully', $applications);
    }
}
