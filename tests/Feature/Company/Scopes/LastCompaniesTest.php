<?php

namespace Tests\Feature\Company\Scopes;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LastCompaniesTest extends TestCase{
    use RefreshDatabase;
    public function testLastCompanies(){
        $companies = Company::factory()
            ->count(120)
            ->create();
        $dbCompanies = Company::lastCompanies(12);
        $this->assertEquals($companies->last()->id, $dbCompanies->first()->id);

        $companies = Company::factory()
            ->count(1)
            ->create();
        $dbCompanies = Company::lastCompanies(12);
        $this->assertEquals($companies->last()->id, $dbCompanies->first()->id);

        $companies = Company::factory()
            ->count(120)
            ->create();
        $dbCompanies = Company::lastCompanies(120);
        $this->assertCount(120, $dbCompanies->get());
    }
}
