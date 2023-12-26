<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $list = [
            [
                'created_by' => 1,
                'title' => 'Birthday',
                'description' => 'Birthday Parties are the best',
            ],
            [
                'created_by' => 1,
                'title' => 'Marriage',
                'description' => 'Marriage is the key to happiness',
            ],
            [
                'created_by' => 1,
                'title' => 'Ceremony',
                'description' => 'Ceremony best celebrates the occasion',
            ],
            [
                'created_by' => 1,
                'title' => 'Interview',
                'description' => 'Interviews are the best way to get a job',
            ],
            [
                'created_by' => 1,
                'title' => 'Dinner',
                'description' => 'Dinner with friends is the best way to spend time',
            ],
            [
                'created_by' => 1,
                'title' => 'Party',
                'description' => 'Party is the best way to celebrate',
            ],
        ];

        foreach ($list as $item) {
            Event::create($item);
        }
    }
}
