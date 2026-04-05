<?php
namespace App\Http\Controllers\SubAdmin;
use App\Http\Controllers\BaseProfileController;

class ProfileController extends BaseProfileController
{
    protected string $rolePrefix   = 'sub_admin';
    protected string $profileView  = 'shared.profile';        // ✅
    protected string $passwordView = 'shared.change_password'; // ✅
}