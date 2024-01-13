<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Material::create([
            'name'=>'Algoritma dan Pemrograman',
            'content'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Eu lobortis elementum nibh tellus. Feugiat pretium nibh ipsum consequat nisl vel pretium lectus. Mauris pellentesque pulvinar pellentesque habitant morbi tristique. Pharetra diam sit amet nisl. Pellentesque habitant morbi tristique senectus et netus et. Lobortis mattis aliquam faucibus purus in. Leo duis ut diam quam nulla porttitor massa id. Non tellus orci ac auctor augue mauris augue. Non blandit massa enim nec dui nunc mattis enim.',
            'sequence'=>1,
            'idSubject'=>1
        ]);
        Material::create([
            'name'=>'Dampak Sosial Informatika',
            'content'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Eu lobortis elementum nibh tellus. Feugiat pretium nibh ipsum consequat nisl vel pretium lectus. Mauris pellentesque pulvinar pellentesque habitant morbi tristique. Pharetra diam sit amet nisl. Pellentesque habitant morbi tristique senectus et netus et. Lobortis mattis aliquam faucibus purus in. Leo duis ut diam quam nulla porttitor massa id. Non tellus orci ac auctor augue mauris augue. Non blandit massa enim nec dui nunc mattis enim.',
            'sequence'=>2,
            'idSubject'=>1
        ]);

    }
}
