<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    private static array $companyNames = [
        'TNG株式会社', 'サイテック工業', 'アルファ商事', 'ベータシステムズ',
        'ガンマテクノロジー', 'デルタコーポレーション', 'イプシロン販売',
    ];

    public function definition(): array
    {
        return [
            'company_name' => $this->faker->unique()->randomElement(self::$companyNames),
        ];
    }
}
