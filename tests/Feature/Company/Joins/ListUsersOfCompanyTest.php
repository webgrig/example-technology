<?php

namespace Tests\Feature\Company\Joins;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ListUsersOfCompanyTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testListUsersOfCompany(){

        $company = Company::factory()
            ->create();

        DB::table('sectoryables')->insert([
            ['sector_id' => 1, 'sectoryables_id' => $company->id, 'sectoryables_type' => 'App\\Models\\Company']
        ]);

        $users = User::factory()
            ->count(200)
            ->create();
        foreach ($users as $user){
            DB::table('usersectoryables')->insert([
                ['sector_id' => 1, 'usersectoryables_id' => $user->id, 'usersectoryables_type' => 'App\\Models\\User']
            ]);
        }
        foreach ($users as $key => $user){
            $this->assertEquals($user->name, $company->listUsersOfCompany()[$key]->name);
        }
    }
}
