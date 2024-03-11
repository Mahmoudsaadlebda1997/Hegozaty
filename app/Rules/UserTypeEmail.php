<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UserTypeEmail implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the email belongs to user_type 'ADMIN' or 'DOCTOR'
        return DB::table('users')->where('email', $value)->where('role', 'admin')->exists();
    }

    public function message()
    {
        return 'لا يمكن دخول الا للادمن  فقط.';
    }
}
