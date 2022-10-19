<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Advice;
use App\Models\CharacterTrait;
use App\Models\CharacterTraitChild;
use App\Models\CharacterTraitLifeEvent;
use App\Models\Child;
use App\Models\LifeEvent;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=> 'admin',
            'email'=> 'sebastien.thome@telenet.be',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'password' => bcrypt('admin'),
            'is_admin' => true
        ]);

        $numberOfUsers = 3;
        $numberOfAdvices = 10;
        $numberOfCharTraits = 5;
        $numberOfChildren = 7;
        $numberOfReviews = 10;
        $numberOfLifeEvents = 10;

        $users = User::factory()->count($numberOfUsers)->create();
        $advices = Advice::factory()->count($numberOfAdvices)->create();
        $reviews = Review::factory()->count($numberOfReviews)->create();
        $children = Child::factory()->count($numberOfChildren)->create();
        $charTraits = CharacterTrait::factory($numberOfCharTraits)->create();
        $lifeEvents = LifeEvent::factory($numberOfLifeEvents)->create();

        //Pivot CharacterTrait_Event
//        $events = LifeEvent::all();
        $this->attachCharTraitsToModels($lifeEvents, $charTraits);
        $charTraitLifeEvents = CharacterTraitLifeEvent::all();
        $this->setTraitLevelOnPivotModel($charTraitLifeEvents);

        //Pivot CharacterTrait_Child
        $this->attachCharTraitsToModels($children, $charTraits);
        $charTraitChildren = CharacterTraitChild::all();
        $this->setTraitLevelOnPivotModel($charTraitChildren);

        //Pivot Child_Event
//        $events = LifeEvent::all();
        $this->attachLifeEventsToModels($lifeEvents, $children);

        //Pivot Advice_Event
//        $events = LifeEvent::all();
        $this->attachLifeEventsToModels($lifeEvents, $advices);

        //Pivot Child_User
        foreach ($children as $child) {
            $userId = 0;
            for ($i = rand(1, 2); $i > 0; $i--) {
                $user = $users[rand(0, count($users) - 1)];
                if ($userId != $user->id) {
                    $user->children()->attach($child);
                    $userId = $user->id;
                }
            }
        }

        //Attach users to reviews
//        $reviews = Review::all();
        foreach ($reviews as $review) {
            $review->user_id = rand(1, count($users));
            $review->save();
        }
    }


    /**
     * @param mixed $models
     * @param $charTraits
     * @return void
     */
    private function attachCharTraitsToModels(mixed $models, mixed $charTraits): void
    {
        $index = count($charTraits) - 1;
        foreach ($models as $model) {
            for ($i = rand(0, $index); $i > 0; $i--) {
                $model->characterTraits()->attach($charTraits[rand(0, $index)]);
            }
        }
    }

    /**
     * @param Collection $pivotModels
     * @return void
     */
    private function setTraitLevelOnPivotModel(Collection $pivotModels): void
    {
        foreach ($pivotModels as $x) {
            $x->traitLevel = rand(0, 2);
            $x->save();
        }
    }

    private function attachLifeEventsToModels(mixed $lifeEvents, mixed $models)
    {
        $index = count($lifeEvents) - 1;

        foreach ($models as $model) {
            for ($i = rand(0, $index); $i > 0; $i--) {
                $model->lifeEvents()->attach($lifeEvents[rand(0, $index)]);
            }
        }
    }
}
