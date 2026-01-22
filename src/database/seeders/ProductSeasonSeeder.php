<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Season;


class ProductSeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kiwi = Product::where('name', 'キウイ')->first();
        $autumn = Season::where('name','秋')->first();
         $winter = Season::where('name','冬')->first();

        $kiwi->seasons()->attach([$autumn->id, $winter->id]);

        $strawberry = Product::where('name', 'ストロベリー')->first();
        $spring = Season::where('name','春')->first();

        $strawberry->seasons()->attach($spring->id);

        $orange = Product::where('name', 'オレンジ')->first();
        $winter = Season::where('name','冬')->first();

        $orange->seasons()->attach($winter->id);

        $watermelon = Product::where('name', 'スイカ')->first();
        $summer = Season::where('name','夏')->first();

        $watermelon->seasons()->attach($summer->id);

        $peach = Product::where('name', 'ピーチ')->first();
        $summer = Season::where('name','夏')->first();

        $peach->seasons()->attach($summer->id);

        $muscat = Product::where('name', 'シャインマスカット')->first();
        $summer = Season::where('name','夏')->first();
         $autumn = Season::where('name','秋')->first();

         $muscat->seasons()->attach([$summer->id, $autumn->id]);

         $pineapple = Product::where('name', 'パイナップル')->first();
        $spring = Season::where('name','春')->first();
         $summer = Season::where('name','夏')->first();

         $pineapple->seasons()->attach([$spring->id, $summer->id]);

         $grapes = Product::where('name', 'ブドウ')->first();
        $summer = Season::where('name','夏')->first();
         $autumn = Season::where('name','秋')->first();

         $grapes->seasons()->attach([$summer->id, $autumn->id]);

          $banana = Product::where('name', 'バナナ')->first();
        $summer = Season::where('name','夏')->first();

        $banana->seasons()->attach($summer->id);

        $melon = Product::where('name', 'メロン')->first();
        $spring = Season::where('name','春')->first();
         $summer = Season::where('name','夏')->first();

         $melon->seasons()->attach([$spring->id, $summer->id]);
    }
}
