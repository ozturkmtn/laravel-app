<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPayments extends Model
{
    use HasFactory;

    protected $fillable = ['company_packages', 'hash', 'is_paid'];

    public function companyPackages()
    {
        return $this->hasMany(CompanyPackages::class);
    }
}
