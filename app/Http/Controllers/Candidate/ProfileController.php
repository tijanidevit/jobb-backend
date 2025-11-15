<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Candidate\Profile\UpdateProfileRequest;
use App\Http\Resources\User\UserResource;
use App\Models\Candidate;
use App\Models\CandidateEducation;
use App\Models\CandidateExperience;
use App\Models\CandidateResume;
use App\Models\CandidateSkill;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    use ResponseTrait;

    public function index()
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

    public function updateProfile(UpdateProfileRequest $request)
    {
        return DB::transaction(function () use($request) {
            $user = auth()->user();
            $candidate = Candidate::updateOrCreate(
                ['user_id' => $user->id],
                $request->profile
            );

            $this->saveSkills($candidate, $request->skills ?? []);
            $this->saveResumes($candidate, $request->resumes ?? []);
            $this->saveExperiences($candidate, $request->experiences ?? []);
            $this->saveEducations($candidate, $request->educations ?? []);

            return $this->successMessageResponse('User profile updated');
        });
    }

    protected function saveSkills(Candidate $candidate, array $skills)
    {
        if (empty($skills)) return;

        $candidate->skills()->delete();

        $now = now();
        $data = array_map(fn($skill) => array_merge($skill, [
            'candidate_id' => $candidate->id,
            'id' => Str::uuid(),
            'created_at' => $now,
            'updated_at' => $now,
        ]), $skills);

        CandidateSkill::insert($data);
    }

    protected function saveResumes(Candidate $candidate, array $resumes)
    {
        if (empty($resumes)) return;

        $candidate->resumes()->delete();

        $now = now();
        $data = array_map(fn($resume) => array_merge($resume, [
            'candidate_id' => $candidate->id,
            'id' => Str::uuid(),
            'created_at' => $now,
            'updated_at' => $now,
        ]), $resumes);

        CandidateResume::insert($data);
    }

    protected function saveExperiences(Candidate $candidate, array $experiences)
    {
        if (empty($experiences)) return;

        $candidate->experiences()->delete();

        $now = now();
        $data = array_map(fn($exp) => array_merge($exp, [
            'candidate_id' => $candidate->id,
            'id' => Str::uuid(),
            'created_at' => $now,
            'updated_at' => $now,
        ]), $experiences);

        CandidateExperience::insert($data);
    }

    protected function saveEducations(Candidate $candidate, array $educations)
    {
        if (empty($educations)) return;

        $candidate->educations()->delete();

        $now = now();
        $data = array_map(fn($edu) => array_merge($edu, [
            'candidate_id' => $candidate->id,
            'id' => Str::uuid(),
            'created_at' => $now,
            'updated_at' => $now,
        ]), $educations);

        CandidateEducation::insert($data);
    }
}
