<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role' => 'Διαχειριστής',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('roles')->insert([
            'role' => 'Καθηγητής',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('configs')->insert([
          'key' => 'allowRegister',
          'value' => null,
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('configs')->insert([
          'key' => 'hoursUnlocked',
          'value' => null,
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('configs')->insert([
          'key' => 'letTeachersUnlockHours',
          'value' => null,
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('configs')->insert([
          'key' => 'showFutureHours',
          'value' => null,
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('configs')->insert([
          'key' => 'timeZone',
          'value' => 'Europe/Athens',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('programs')->insert([
          'id' => 1,
          'start' => 815,
          'stop' => 905,
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('programs')->insert([
          'id' => 2,
          'start' => 905,
          'stop' => 955,
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('programs')->insert([
          'id' => 3,
          'start' => 1000,
          'stop' => 1050,
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('programs')->insert([
          'id' => 4,
          'start' => 1055,
          'stop' => 1145,
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('programs')->insert([
          'id' => 5,
          'start' => 1150,
          'stop' => 1240,
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('programs')->insert([
          'id' => 6,
          'start' => 1240,
          'stop' => 1330,
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('programs')->insert([
          'id' => 7,
          'start' => 1330,
          'stop' => 1415,
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        // $this->call(UserSeeder::class);
    }
}
