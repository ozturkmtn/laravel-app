<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPackages extends Model
{
    use HasFactory;

    protected $fillable = ['company', 'packages', 'start_date', 'end_date', 'status', 'payment_try'];

    public function company()
    {
        return $this->hasMany(Company::class);
    }

    public function packages()
    {
        return $this->hasMany(Packages::class);
    }
}
