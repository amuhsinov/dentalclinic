<?php

use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Anul Muhsinov',
            'email' => 'amuhsinov@gmail.com',
            'password' => Hash::make('12345678')
        ]);
        DB::table('users')->insert([
            'name' => 'Dimi Dimi',
            'email' => 'dimi@gmail.com',
            'password' => Hash::make('12345678')
        ]);
        DB::table('users')->insert([
            'name' => 'Koko Koko',
            'email' => 'koko@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        DB::table('schedules')->insert([
            'user_id' => 1,
            'date' => '2020-10-25',
            'time' => '13:30',
            'patient_name' => 'Anna',
            'patient_phone_number' => '08989898989',
            'patient_email' => 'anna@gmail.com',
        ]);
        DB::table('schedules')->insert([
            'user_id' => 1,
            'date' => '2020-10-24',
            'time' => '14:30',
            'patient_name' => 'George',
            'patient_phone_number' => '08989825989',
            'patient_email' => 'geo@gmail.com',
        ]);
        DB::table('schedules')->insert([
            'user_id' => 2,
            'date' => '2020-10-28',
            'time' => '11:30',
            'patient_name' => 'Kane',
            'patient_phone_number' => '08986162989',
            'patient_email' => 'kane@gmail.com',
        ]);

        DB::table('working_days')->insert([
            'user_id' => 2,
            'day_id' => 1,
            'time_from' => '11:30',
            'time_to' => '14:30',
        ]);
        DB::table('working_days')->insert([
            'user_id' => 2,
            'day_id' => 1,
            'time_from' => '17:30',
            'time_to' => '18:30',
        ]);
        DB::table('working_days')->insert([
            'user_id' => 1,
            'day_id' => 2,
            'time_from' => '9:30',
            'time_to' => '11:30',
        ]);
        DB::table('working_days')->insert([
            'user_id' => 1,
            'day_id' => 4,
            'time_from' => '14:30',
            'time_to' => '16:30',
        ]);

        DB::table('days')->insert([
            'day_id' => 0,
            'day' => 'Sunday',
        ]);
        DB::table('days')->insert([
            'day_id' => 1,
            'day' => 'Monday',
        ]);
        DB::table('days')->insert([
            'day_id' => 2,
            'day' => 'Tuesday',
        ]);
        DB::table('days')->insert([
            'day_id' => 3,
            'day' => 'Wednesday',
        ]);
        DB::table('days')->insert([
            'day_id' => 4,
            'day' => 'Thursday',
        ]);
        DB::table('days')->insert([
            'day_id' => 5,
            'day' => 'Friday',
        ]);
        DB::table('days')->insert([
            'day_id' => 6,
            'day' => 'Saturday',
        ]);
    }
}
