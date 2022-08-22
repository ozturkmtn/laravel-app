<?php

namespace Database\Factories;

use App\Models\Packages;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $company = $this->faker->company();
        $firstname = $this->faker->firstName();
        $domain = $this->faker->domainName();

        return [
            'site_url' => 'http://www.' . $domain ,
            'name' => $firstname,
            'lastname' => $this->faker->lastName(),
            'company_name' => $company,
            'email' => $firstname .'@'. $domain,
            'password' => $this->faker->password(minLength: 8, maxLength: 12),
            'status' => 1,
            'token' => Str::random(60),
            'packages' => $this->faker->numberBetween(1,5),
        ];
    }
}
