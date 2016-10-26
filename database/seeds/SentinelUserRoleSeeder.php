<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SentinelUserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_users')->delete();

        $management = Sentinel::findByCredentials(['login' => 'management@management.com']);
        $adminUser = Sentinel::findByCredentials(['login' => 'admin@admin.com']);
        $faculty = Sentinel::findByCredentials(['login' => 'faculty@faculty.com']);
		$student = Sentinel::findByCredentials(['login' => 'student@student.com']);
		$parent = Sentinel::findByCredentials(['login' => 'parent@parent.com']);
		$pta = Sentinel::findByCredentials(['login' => 'pta@pta.com']);
		$alumni = Sentinel::findByCredentials(['login' => 'alumni@alumni.com']);
        
        $managementRole = Sentinel::findRoleByName('Management');
        $adminRole = Sentinel::findRoleByName('Admins');
        $facultyRole = Sentinel::findRoleByName('Faculty');
		$studentRole = Sentinel::findRoleByName('Student');
		$parentRole = Sentinel::findRoleByName('Parent');
		$ptaRole = Sentinel::findRoleByName('PTA');
		$alumniRole = Sentinel::findRoleByName('Alumni');

        // Assign the roles to the users
        $managementRole->users()->attach($management);
        $adminRole->users()->attach($adminUser);
        $facultyRole->users()->attach($faculty);
		$studentRole->users()->attach($student);
		$parentRole->users()->attach($parent);
		$ptaRole->users()->attach($pta);
		$alumniRole->users()->attach($alumni);

        $this->command->info('Users assigned to roles seeded!');
    }
}
