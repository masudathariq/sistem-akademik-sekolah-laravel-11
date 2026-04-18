<?php

namespace Database\Factories;

use App\Models\AbsensiGuru;
use App\Models\Guru;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class AbsensiGuruFactory extends Factory
{
    protected $model = AbsensiGuru::class;

    public function definition()
    {
        return [
            'guru_id' => Guru::inRandomOrder()->first()->id,
            'tanggal' => Carbon::now()->subDays(rand(0, 90))->format('Y-m-d'),
            'jam_masuk' => $this->faker->time('H:i:s'),
            'jam_pulang' => $this->faker->time('H:i:s'),
            'status' => $this->faker->randomElement(['hadir','izin','sakit']),
            'keterangan' => $this->faker->optional()->sentence(),
            'latitude' => $this->faker->optional()->latitude(),
            'longitude' => $this->faker->optional()->longitude(),
            'lokasi' => $this->faker->optional()->city(),
            'foto' => null,
        ];
    }
}
