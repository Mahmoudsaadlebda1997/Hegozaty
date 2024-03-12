<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class SiteTypeEmail implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the email belongs to user_type 'ADMIN' or 'DOCTOR'
        return DB::table('users')->where('email', $value)->where('role', 'user')->exists();
    }

    public function message()
    {
        return 'لا يمكن دخول الا المستخدمين  فقط.';
    }
}
