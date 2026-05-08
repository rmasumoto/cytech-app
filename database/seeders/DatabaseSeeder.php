<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('products');

        $dataCompanies = Company::factory(5)->create();

        $dataUser = User::factory()->create([
            'name'       => 'testuser',
            'name_kanji' => '山田太郎',
            'name_kana'  => 'ヤマダタロウ',
            'email'      => 'test@example.com',
            'password'   => Hash::make('password'),
            'company_id' => $dataCompanies->first()->id,
        ]);

        $dataProductsData = Product::factory(100)->make([
            'user_id'    => $dataUser->id,
            'company_id' => $dataCompanies->random()->id,
        ]);

        foreach ($dataProductsData as $dataProduct) {
            $dataProduct->img_path = $this->generatePlaceholderImage();
            $dataProduct->save();
        }
    }

    private function generatePlaceholderImage(): string
    {
        $width  = 400;
        $height = 300;
        $image  = imagecreatetruecolor($width, $height);

        $bgColor = imagecolorallocate($image, rand(60, 200), rand(60, 200), rand(60, 200));
        imagefill($image, 0, 0, $bgColor);

        $white = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image, 30, 80, 370, 220, $white);

        $gray = imagecolorallocate($image, 180, 180, 180);
        imageline($image, 30, 80, 370, 220, $gray);
        imageline($image, 370, 80, 30, 220, $gray);
        imagerectangle($image, 30, 80, 370, 220, $gray);

        $filename = 'products/' . uniqid('img_', true) . '.png';
        $path     = storage_path('app/public/' . $filename);

        imagepng($image, $path);
        imagedestroy($image);

        return $filename;
    }
}
