<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Ramsey\Uuid\Uuid;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        $notes = [
            [
                'id' => Uuid::uuid4()->toString(),
                'user_id' => 1, // Note! Hard-code
                'title' => 'Tell How Lovely You Are',
                'body' => 'Just want to tell you that you are lovely.',
                'send_date' => Carbon::now()->addDays(1),
                'recipient' => 'reboxzy@gmail.com',
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'user_id' => 1, // Note! Hard-code
                'title' => 'Tell How Smart You Are',
                'body' => 'Just want to tell you that you are very smart.',
                'send_date' => Carbon::now()->addDays(2),
                'recipient' => 'reboxzy@gmail.com',
            ],  
        ];

        foreach($notes as $note) {
            Note::insert($note);
        }
        */
        
        User::all()->each(function (User $user) {
            Note::factory()->count(10)->create([
                'user_id' => $user->id,
            ]);
        });

    }
}
