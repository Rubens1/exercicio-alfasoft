<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'contact',
        'email'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($contact) {
            // Ensure email is unique (case insensitive)
            $existingContact = static::where('email', 'LIKE', $contact->email)
                ->where('id', '!=', $contact->id)
                ->first();

            if ($existingContact) {
                throw new \Exception('This email is already registered.');
            }
        });
    }

    public static function rules($id = null)
    {
        return [
            'name' => 'required|min:5',
            'contact' => 'required|digits:9|unique:contacts,contact,' . $id,
            'email' => 'required|email|unique:contacts,email,' . $id
        ];
    }
}
