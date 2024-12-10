<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Create a manager
        $manager1 = User::create([
            'first_name' => 'Manager',
            'last_name' => 'Admin',
            'email' => 'manager@org.com',
            'password' => Hash::make('password123'), // Secure password
            'role' => 'manager', // Add 'role' column to distinguish roles
            'salary'=>5000,
            'phone'=>'012580057',
        ]);


        // Create a manager
        $manager2 = User::create([
            'first_name' => 'Manager2',
            'last_name' => 'Admin',
            'email' => 'manager2@org.com',
            'password' => Hash::make('password123'), // Secure password
            'role' => 'manager', // Add 'role' column to distinguish roles
            'salary'=>1000,
            'phone'=>'0125800587',
        ]);



        $department1 = Department::create([
            'name' => 'IT Department',
            'manager_id' => $manager1->id,
        ]);

        $department2 = Department::create([
            'name' => 'HR Department',
            'manager_id' => $manager2->id,
        ]);



        // Create employees and assign them to departments
        User::create([
            'first_name' => 'Emp1',
            'last_name' => 'Test',
            'email' => 'employee1@org.com',
            'password' => Hash::make('password123'),
            'role' => 'employee',
            'department_id' => $department1->id,
            'salary'=>2000,
            'phone'=>'01258005847',

        ]);

        User::create([
            'first_name' => 'Emp2',
            'last_name' => 'Test',
            'email' => 'employee2@org.com',
            'password' => Hash::make('password123'),
            'role' => 'employee',
            'department_id' => $department2->id,
            'salary'=>3000,
            'phone'=>'01258010587',

        ]);


    }
}
