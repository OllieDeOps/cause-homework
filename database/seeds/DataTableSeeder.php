<?php

use Illuminate\Database\Seeder;

class DataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = '[{"first_name":"ladee","last_name":"linter","age":99,"email":"lindaladee@causelabs.com","secret":"VXNlIHRoaXMgc2VjcmV0IHBocmFzZSBzb21ld2hlcmUgaW4geW91ciBjb2RlJ3MgY29tbWVudMHJ","name":"ladee linter"},{"first_name":"cody","last_name":"duder","age":38,"email":"codyduder@causelabs.com","secret":"VXNlIHRoaXMgc2VjcmV0IHBocmFzZSBzb21ld2hlcmUgaW4geW91ciBjb2RlJ3MgY29tbWVudHM=","name":"cody duder"}]';
        $emails = '["codyduder@causelabs.com","lindaladee@causelabs.com"]';
        DB::table('data')->insert([
            'data' => $json,
            'emails' => $emails
        ]);
    }
}

