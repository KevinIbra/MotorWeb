<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\Motor;
use App\Models\MotorImage;
use App\Models\MotorModel;
use App\Models\MotorType;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        {
    $this->call([
        AdminSeeder::class,
        // ...existing seeders...
    ]);
}
        // tipe motor
        // [
        //     'Trail',
        //     'Matic',
        //     'Sport',
        //     'Atv',
        // ];
        MotorType::factory()
        ->sequence(
            ['name' => 'Trail'],
            ['name' => 'Matic'],
            ['name' => 'Sport'],
            ['name' => 'ATV'],
        )
        ->count(4)
        ->create();
      
        // // tipe bensin
        // ['Pertalite', 'Pertamax', 'Solar'];
        FuelType::factory()
        ->sequence(
            ['name' => 'Pertalite'],
            ['name' => 'Pertamax'],
            ['name' => 'Solar'],
        )
        ->count(3)
        ->create();

        // provinsi dengan kota
        $states = [
            'Jawa Barat' => ['Bandung', 'Tasikmalaya',],
            'Jawa Timur' => ['Surabaya', 'Malang',],
        ];
        foreach ($states as $state => $cities) {
            State::factory()
            ->state(['name' => $state])
            ->has(
                City::factory()
                ->count(count($cities))
                ->sequence(...array_map(fn($city) => ['name' => $city], $cities))
            )
            ->create();
        }

        // brand sama dengan tipe motor
        $makers = [
            'Yamaha' => ['NMAX', 'Aerox', 'Fazzio', 'Yamaha R25', 'XSR155', 'Jupiter Z1', 'MX King 150', 'WR155R', 'Yamaha E01'],
            'Kawasaki' => ['Ninja 250', 'Ninja ZX-25R', 'ZX-6R', 'KLX 150', 'KLX 250', 'KLX 230', 'D-Tracker 150', 'Ninja H2', 'Ninja 400', 'Z125 Pro'],
            'Honda' => ['Beat', 'Vario 125/160', 'Scoopy', 'PCX160', 'Supra X125', 'Sonic 150r', 'CBR150R', 'CBR250RR', 'CRF150L', 'CRF250Rally'],
            'Ducati' => ['Panigale V2', 'Panigale V4', 'Panigale SP 2', 'Multistrada V2', 'Multistrada V4', 'Streetfighter V2', 'Streetfighter V4', 'Scramble Icon', 'Scramble Nightshift', 'Scramble Full Throttle', 'Scramble 1100 Sport Pro', 'Ducati Diavel V4d'],
        ];

        foreach ($makers as $makerName => $models) {
            $maker = Maker::factory()->create(['name' => $makerName]);

            foreach ($models as $modelName) {
                MotorModel::factory()->create([
                    'name' => $modelName,
                    'maker_id' => $maker->id,
                ]);
            }
        }

        User::factory()
            ->count(3)
            ->create();

        User::factory()
            ->count(2)
            ->has(
                Motor::factory()
                    ->count(50)
                    ->has(
                        MotorImage::factory()
                            ->count(5)
                            ->sequence(fn(Sequence $sequence) => 
                            ['position' => $sequence->index % 5 + 1]),
                        'images'
                    )
                    ->hasFeatures(),
                'favouriteMotors'
            )
            ->create();

        User::factory()
            ->count(2)
            ->has(
                Motor::factory()
                    ->count(50)
                    ->state(fn (array $attributes, User $user) => [
                        'user_id' => $user->id,
                        'maker_id' => Maker::inRandomOrder()->first()->id,
                        'model_id' => MotorModel::inRandomOrder()->first()->id,
                        'city_id' => City::inRandomOrder()->first()->id,
                        'motor_type_id' => MotorType::inRandomOrder()->first()->id,
                        'fuel_type_id' => FuelType::inRandomOrder()->first()->id,
                    ])
                    ->has(
                        MotorImage::factory()
                            ->count(5)
                            ->sequence(fn (Sequence $sequence) => ['position' => $sequence->index % 5 + 1]),
                        'images'
                    ),
                'favouriteMotors'
            )
            ->create();

            
    }

    
}

