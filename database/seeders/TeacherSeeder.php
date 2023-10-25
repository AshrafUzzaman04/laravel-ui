<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Database\Factories\TeacherFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Teacher::factory()->count(10)->create();
        // DB::table('teachers')->insert([
        //     'name' => Str::random(10),
        //     'email' => Str::random(10) . '@gmail.com',
        //     'phone' => 0 . rand(1111111111, 9999999999),
        // ]);
        // $data = array([
        //     "name" => str::random(10),
        //     "email" => str::random(10),
        //     "phone" => 0 . rand(1111111111, 9999999999),
        // ], [
        //     "name" => str::random(10),
        //     "email" => str::random(10),
        //     "phone" => 0 . rand(1111111111, 9999999999),
        // ], [
        //     "name" => str::random(10),
        //     "email" => str::random(10),
        //     "phone" => 0 . rand(1111111111, 9999999999),
        // ], [
        //     "name" => str::random(10),
        //     "email" => str::random(10),
        //     "phone" => 0 . rand(1111111111, 9999999999),
        // ], [
        //     "name" => str::random(10),
        //     "email" => str::random(10),
        //     "phone" => 0 . rand(1111111111, 9999999999),
        // ]);

        // DB::table("teachers")->insert($data);
    }
}
