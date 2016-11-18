<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SentinelUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        Sentinel::registerAndActivate([
            'email'    => 'management@management.com',
            'password' => 'sentinelmanagement',
            'first_name' => 'ManagementFirstName',
            'last_name' => 'ManagementLastName',
        ]);

        Sentinel::registerAndActivate([
            'email'    => 'administrator@administrator.com',
            'password' => 'sentineladministrator',
            'first_name' => 'AdministratorFirstName',
            'last_name' => 'AdministratorLastName',
        ]);

        Sentinel::registerAndActivate([
            'email'    => 'admin@admin.com',
            'password' => 'sentineladmin',
            'first_name' => 'AdminFirstName',
            'last_name' => 'AdminLastName',
        ]);
        
        Sentinel::registerAndActivate([
            'email'    => 'faculty@faculty.com',
            'password' => 'sentinelfaculty',
            'first_name' => 'FacultyFirstName',
            'last_name' => 'FacultyLastName',
        ]);
		
		Sentinel::registerAndActivate([
            'email'    => 'student@student.com',
            'password' => 'sentinelstudent',
            'first_name' => 'StudentFirstName',
            'last_name' => 'StudentLastName',
        ]);
		
		Sentinel::registerAndActivate([
            'email'    => 'parent@parent.com',
            'password' => 'sentinelparent',
            'first_name' => 'ParentFirstName',
            'last_name' => 'ParentLastName',
        ]);
		
		Sentinel::registerAndActivate([
            'email'    => 'pta@pta.com',
            'password' => 'sentinelpta',
            'first_name' => 'PTAFirstName',
            'last_name' => 'PTALastName',
        ]);
		
		Sentinel::registerAndActivate([
            'email'    => 'alumni@alumni.com',
            'password' => 'sentinelalumni',
            'first_name' => 'AlumniFirstName',
            'last_name' => 'AlumniLastName',
        ]);
		
		Sentinel::registerAndActivate([
            'email'    => 'siteadmin@siteadmin.com',
            'password' => 'sentinelsiteadmin',
            'first_name' => 'sentinaladminFirstName',
            'last_name' => 'sentineladminLastName',
        ]);

        $this->command->info('Users seeded!');

    }
}
