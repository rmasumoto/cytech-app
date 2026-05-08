<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    private static array $productNames = [
        'ノートPC', 'タブレット', 'スマートフォン', 'イヤホン', 'ヘッドフォン',
        'キーボード', 'マウス', 'モニター', 'USBハブ', 'Webカメラ',
        'プリンター', 'スキャナー', 'スピーカー', 'マイク', '充電器',
        'モバイルバッテリー', 'SDカード', 'SSD', 'HDD', 'ルーター',
        '鉛筆', 'ボールペン', 'ノート', '付箋', 'ステープラー',
        'ファイル', 'バインダー', 'はさみ', 'テープ', '電卓',
        'デスク', 'チェア', 'ラック', '収納ボックス', 'ホワイトボード',
        'コーヒーメーカー', '電気ケトル', '電子レンジ', '冷蔵庫', '掃除機',
        'ハンドクリーム', 'マスク', '消毒液', 'サプリメント', '栄養ドリンク',
        'バッグ', 'ポーチ', '財布', '名刺入れ', 'カードケース',
    ];

    public function definition(): array
    {
        $productName = $this->faker->randomElement(self::$productNames);

        return [
            'user_id'      => User::factory(),
            'company_id'   => Company::factory(),
            'product_name' => $productName,
            'price'        => $this->faker->randomElement([100, 200, 500, 1000, 1500, 2000, 3000, 5000, 10000, 25000, 30000, 50000]),
            'stock'        => $this->faker->numberBetween(0, 500),
            'description'  => $this->faker->realTextBetween(20, 80),
            'img_path'     => null,
        ];
    }
}
