<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //admin seeder
        $admin = User::create([
            'name'              => 'John Doe',
            'email'             => 'admin@example.com',
            'phone'             => '1772997503',
            'username'          => 'admin',
            'email_verified_at' => now(),
            'password'          => bcrypt('123456'),
            'status'            => 5,
            'country_code'      => '+880',
            'is_guest'          => 10
        ]);
        $admin->assignRole(1);

        //walking customer seeder
        $customer = User::create([
            'name'              => 'Walking Customer',
            'email'             => 'walkingcustomer@example.com',
            'phone'             => '1773674158',
            'username'          => 'default-customer',
            'email_verified_at' => now(),
            'password'          => bcrypt('123456'),
            'status'            => 5,
            'country_code'      => '+880',
            'is_guest'          => 10
        ]);
        $customer->assignRole(2);

        //customer one seder
        $customerOne = User::create([
            'name'              => 'Will Smith',
            'email'             => 'customer@example.com',
            'phone'             => '125333344',
            'username'          => 'will-smith',
            'email_verified_at' => now(),
            'password'          => bcrypt('123456'),
            'status'            => 5,
            'country_code'      => '+880',
            'is_guest'          => 10
        ]);
        $customerOne->assignRole(2);

        //employee one
        $employeeOne = User::create([
            'name'              => 'Kiron Khan',
            'email'             => 'manager@example.com',
            'phone'             => '1275333453',
            'username'          => 'kiron-khan',
            'email_verified_at' => now(),
            'password'          => bcrypt('123456'),
            'status'            => 5,
            'country_code'      => '+880',
            'is_guest'          => 10
        ]);
        $employeeOne->assignRole(3);

        //employee two
        $employeeTwo = User::create([
            'name'              => 'Shohag Ali',
            'email'             => 'shohag@example.com',
            'phone'             => '1257654433',
            'username'          => 'shohag-ali',
            'email_verified_at' => now(),
            'password'          => bcrypt('123456'),
            'status'            => 5,
            'country_code'      => '+880',
            'is_guest'          => 10
        ]);
        $employeeTwo->assignRole(3);


        //pos operator one
        $posOperatorOne = User::create([
            'name'              => 'Farha Israt ',
            'email'             => 'posoperator@example.com',
            'phone'             => '156873641',
            'username'          => 'farha-israt',
            'email_verified_at' => now(),
            'password'          => bcrypt('123456'),
            'status'            => 5,
            'country_code'      => '+880',
            'is_guest'          => 10
        ]);
        $posOperatorOne->assignRole(4);


        //stuff one
        $stuffOne = User::create([
            'name'              => 'Rohim Miya',
            'email'             => 'stuff@example.com',
            'phone'             => '1222224443',
            'username'          => 'rohim-miya',
            'email_verified_at' => now(),
            'password'          => bcrypt('123456'),
            'status'            => 5,
            'country_code'      => '+880',
            'is_guest'          => 10
        ]);
        $stuffOne->assignRole(5);
    }
}
