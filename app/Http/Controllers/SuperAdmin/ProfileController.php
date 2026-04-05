<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\BaseProfileController;

class ProfileController extends BaseProfileController
{
    protected string $rolePrefix   = 'super_admin';
    protected string $profileView  = 'shared.profile';        // ✅
    protected string $passwordView = 'shared.change_password'; // ✅
}