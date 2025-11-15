<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    use ResponseTrait;

    public function __invoke(): JsonResponse
    {
        $user = User::with([
            'candidate' => [
                'resumes',
                'experiences',
                'educations',
                'skills',
            ]
        ])->find(auth()->user()->id);
        return $this->successResponse('Profile retrieved', new UserResource($user));
    }
}
