<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $product = new \App\Product([
          'imagePath' => 'http://www.eljardindeflora.com.mx/wp-content/uploads/2014/09/gerberas.jpg',
          'title' => 'Gerberas',
          'description' => ' Flores muy elegantes para conquistar a todas las chicas.',
          'price' => 250,
          'type' => 'Sol',
          'filter' => 'Minerales'
        ]);
        $product->save();

        $product = new \App\Product([
          'imagePath' => 'http://www.almanac.com/sites/default/files/images/petunias.jpg',
          'title' => 'Petunias',
          'description' => ' Flores para toda ocasion.',
          'price' => 335.5,
          'type' => 'Sol',
          'filter' => 'Otro'
        ]);
        $product->save();

        $product = new \App\Product([
          'imagePath' => 'http://img.jardineriaon.com/wp-content/uploads/2014/07/rosas-2.jpg',
          'title' => 'Rosas',
          'description' => ' Flor perfecta para esa chica ideal.',
          'price' => 120,
          'type' => 'Sol',
          'filter' => 'Minerales'
        ]);
        $product->save();
    }

}
