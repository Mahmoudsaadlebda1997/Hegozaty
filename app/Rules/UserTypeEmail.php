<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UserTypeEmail implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the email belongs to role 'ADMIN' or 'SuperAdmin'
        return DB::table('users')->where('email', $value)->whereIn('role', ['superAdmin', 'admin'])->exists();
    }

    public function message()
    {
        return 'لا يمكن دخول الا للادمن  فقط.';
    }
}
