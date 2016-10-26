<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SentinelRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
		
		Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Management',
            'slug' => 'management',
        ]);
		
		Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Admins',
            'slug' => 'admins',
        ]);
		
		Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Faculty',
            'slug' => 'faculty',
        ]);
		
		Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Student',
            'slug' => 'student',
        ]);
		
		Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Parent',
            'slug' => 'parent',
        ]);
		
		Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'PTA',
            'slug' => 'pta',
        ]);
		
		Sentinel::getRoleRepository()->createModel()->create([
		    'name' => 'Alumni',
			'slug' => 'alumni',
		]);
       
        $this->command->info('Roles seeded!');
    }
}
