<?php  
  
namespace Database\Seeders;  
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;  
use Illuminate\Database\Seeder;  
use Illuminate\Support\Facades\Hash;  
use Illuminate\Support\Str;  
use Illuminate\Support\Facades\DB;  
use Carbon\Carbon;  
  
class UserSeeder extends Seeder  
{  
    /**  
     * Run the database seeds.  
     */  
    public function run(): void  
    {  
        DB::table('users')->insert([  
            [  
                'name' => 'Damar Syahada',  
                'email' => 'kasir@kastar.com',  
                'email_verified_at' => Carbon::now(),  
                'password' => Hash::make('123'),  
                'level' => '0',  
                'created_at' => Carbon::now(),  
                'updated_at' => Carbon::now(),  
            ],  
            [  
                'name' => 'Damar Syahada',  
                'email' => 'admin@kastar.com',
                'email_verified_at' => Carbon::now(),  
                'password' => Hash::make('123'),  
                'level' => '1',  
                'created_at' => Carbon::now(),  
                'updated_at' => Carbon::now(),  
            ],  
            [  
                'name' => 'Damar Syahada',  
                'email' => 'super@kastar.com',
                'email_verified_at' => Carbon::now(),  
                'password' => Hash::make('123'),  
                'level' => '2',  
                'created_at' => Carbon::now(),  
                'updated_at' => Carbon::now(),  
            ],  
        ]);  
    }  
}  
  
// Cara menjalankan seeder di terminal : php artisan db:seed --class=UserSeeder