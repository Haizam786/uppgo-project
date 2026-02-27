<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisationDetail extends Model
{
    use HasFactory;

    protected $table = 'organisation_details';

    protected $fillable = [
        'name',
        'email',
        'address',
        'telephone',
        'logo',
        'account_no',
        'bank_name',
        'swift_code',
        'country',
        'active',
        'deleted'
    ];
}
