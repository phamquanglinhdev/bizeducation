<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            "name"=>'Phạm Quang Linh',
            "email"=>"phamquanglinhdev@gmail.com",
            "phone"=>"0904800240",
            "role"=>0,
            "password"=>Hash::make("Linhz123@"),
        ];
        $teacher = [
            "name"=>'Nguyễn Thị Như Hiền',
            "email"=>"hien.teach@gmail.com",
            "phone"=>"0904800231",
            "role"=>1,
            "password"=>Hash::make("Linhz123@"),
        ];
        $student = [
            "name"=>'Trần Thị Mỹ Linh',
            "email"=>"mylinh.biz@gmail.com",
            "phone"=>"0898644221",
            "role"=>2,
            "password"=>Hash::make("Linhz123@"),
        ];
        User::create($admin);
        User::create($teacher);
        User::create($student);
    }
}
