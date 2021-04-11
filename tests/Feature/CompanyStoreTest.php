<?php

namespace Tests\Feature;

use App\Models\Company;
use Database\Seeders\CompaniesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyStoreTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCompanyStore()
    {
        $company = Company::factory()
            ->create();

        $dbCompany = Company::first();

        $this->assertNotNull($dbCompany);
        $this->assertTrue($dbCompany->id == $company->id);

    }
}
