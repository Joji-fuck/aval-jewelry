<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RingModel;

class RingModelSeeder extends Seeder
{
    public function run(): void
    {
        RingModel::updateOrCreate(
            ['type' => 'Обручальное'],
            [
                'name' => 'Классическое обручальное',
                'model_path' => 'ring-models/wedding.glb',
                'thumbnail' => null,
            ]
        );

        RingModel::updateOrCreate(
            ['type' => 'Помолвочное'],
            [
                'name' => 'Классическое помолвочное',
                'model_path' => 'ring-models/engagement.glb',
                'thumbnail' => null,
            ]
        );

        RingModel::updateOrCreate(
            ['type' => 'Бесконечность'],
            [
                'name' => 'Классическое бесконечность',
                'model_path' => 'ring-models/infinity.glb',
                'thumbnail' => null,
            ]
        );
    }
}
