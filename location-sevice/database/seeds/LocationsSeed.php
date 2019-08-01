<?php


use Phinx\Seed\AbstractSeed;

class LocationsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'id' => \Ramsey\Uuid\Uuid::uuid4(),
                'name' => 'home.pl',
                'street' => 'Zbożowa',
                'postal_code' => '70-653',
                'suite_number' => 4,
                'city' => 'Szczecin',
                'longitude' => 14.563517,
                'latitude' => 53.422573
            ],
            [
                'id' => \Ramsey\Uuid\Uuid::uuid4(),
                'name' => 'Ukraineczka',
                'street' => 'Panieńska',
                'postal_code' => '70-535',
                'suite_number' => 19,
                'city' => 'Szczecin',
                'longitude' => 14.561219,
                'latitude' => 53.425576
            ],
            [
                'id' => \Ramsey\Uuid\Uuid::uuid4(),
                'name' => 'Port Lotniczy Szczecin-Goleniów im. NSZZ Solidarność',
                'street' => '',
                'postal_code' => '72-100',
                'suite_number' => '1a',
                'city' => 'Goleniów',
                'longitude' => 14.902760,
                'latitude' => 53.585960
            ],
            [
                'id' => \Ramsey\Uuid\Uuid::uuid4(),
                'name' => 'Kino Goleniów',
                'street' => 'Konstytucji 3 Maja',
                'postal_code' => '72-100',
                'suite_number' => '16',
                'city' => 'Goleniów',
                'longitude' => 14.832019,
                'latitude' => 53.562076
            ],
            [
                'id' => \Ramsey\Uuid\Uuid::uuid4(),
                'name' => 'Police Zakłady Chemiczne 12',
                'street' => '',
                'postal_code' => '72-010',
                'suite_number' => 12,
                'city' => 'Police',
                'longitude' => 14.550800,
                'latitude' => 53.570881
            ]
        ];

        $location = $this->table('location');
        $location->insert($data)->save();
    }
}
