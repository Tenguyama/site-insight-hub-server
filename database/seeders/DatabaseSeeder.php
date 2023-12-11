<?php

namespace Database\Seeders;

use App\Models\Site;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Використовувалось для "користувацького списку сайтів"
        //тобто вивід списку\видалення елементу з списку,
        //до того як було реалізовано додавання

//        for ($i = 0; $i <10; $i++){
//            Site::query()->create([
//                'name' => $i,
//                'url_page' => $i. '/examplepage.html',
//                'user_id' => 1
//            ]);
//        }
    }
}
