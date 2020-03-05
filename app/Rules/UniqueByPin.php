<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\ATG;

class UniqueByPin implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $pincode;
    public function __construct($pincode)
    {
        $this->pincode=$pincode;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $users=ATG::where("email",$value)->get();
        if (count($users)) {
            $pins=$users->pluck('pincode')->toArray();
            if (!in_array($this->pincode, $pins)) {
                return true;
            }
        }else{
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The email has already been taken.';
    }
}
