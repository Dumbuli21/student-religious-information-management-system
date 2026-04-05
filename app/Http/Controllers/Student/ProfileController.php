<?php
namespace App\Http\Controllers\Student;
use App\Http\Controllers\BaseProfileController;

class ProfileController extends BaseProfileController
{
    protected string $rolePrefix   = 'student';
    protected string $profileView  = 'shared.profile';        // ✅
    protected string $passwordView = 'shared.change_password'; // ✅
}