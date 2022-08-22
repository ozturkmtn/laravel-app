<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['site_url', 'name', 'lastname', 'company_name', 'email', 'password', 'status', 'token'];


    public function packages()
    {
        return $this->hasMany(Packages::class)??null;
    }
}
