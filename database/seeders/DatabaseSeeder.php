<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->importCountries();

        $role = Role::firstOrCreate(array(
            'name' => 'Super Admin',
        ));
        if ($role) {
            $isAdmin = User::select('id')->where(array(
                'email' => 'super.admin@gmail.com',
            ))->first();

            if (!$isAdmin) {
                $user = User::create(array(
                    'name' => 'Super Admin',
                    'role_id' => $role->name,
                    'email' => 'super.admin@gmail.com',
                    'email_verified_at' => date('Y-m-d h:i:s'),
                    'password' => bcrypt('Admin@123'),
                ));
                $user->assignRole($role);
            }
        }

        Role::firstOrCreate(['name' => 'Brand']);
        Role::firstOrCreate(['name' => 'Influencer']);
    }

    private function importCountries(): void
    {
        countryCount::insert();
        $countryCount = DB::table('countries')->count();
        if ( $countryCount ) {
            DB::table('countries')->truncate();
            $file_path = database_path('seeders/sql/countries.sql');
            DB::unprepared(
                file_get_contents($file_path)
            );
        }
    }
}
