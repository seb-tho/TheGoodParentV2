<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Advice;
use App\Models\CharacterTrait;
use App\Models\CharacterTraitChild;
use App\Models\CharacterTraitEvent;
use App\Models\Child;
use App\Models\Review;
use App\Models\Event;
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
        $numberOfUsers = 3;
        $numberOfAdvices = 10;
        $numberOfCharTraits = 5;
        $numberOfChildren = 6;
        $numberOfReviews = 10;

        $users = User::factory()->count($numberOfUsers)->create();
        $advices = Advice::factory()->count($numberOfAdvices)->create();
        $reviews = Review::factory()->count($numberOfReviews)->create();
        $children = Child::factory()->count($numberOfChildren)->create();
        $charTraits = CharacterTrait::factory($numberOfCharTraits)->create();

        //Pivot CharacterTrait_Event
        $events = Event::all();
        $this->attachCharTraitsToModels($events, $charTraits);
        $charTraitEvents = CharacterTraitEvent::all();
        $this->setTraitLevelOnPivotModel($charTraitEvents);

        //Pivot CharacterTrait_Child
        $this->attachCharTraitsToModels($children, $charTraits);
        $charTraitChildren = CharacterTraitChild::all();
        $this->setTraitLevelOnPivotModel($charTraitChildren);

        //Pivot Child_User
        foreach ($users as $user) {
            for ($i = rand(1, 2); $i > 0; $i--) {
                if (count($children) > 0) {
                    $child = $children[count($children)-1];
                    $user->children()->attach($child);
                    $children->forget($child->id);
                }
            }
        }

        //Attach users to reviews
        $reviews = Review::all();
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
    public function attachCharTraitsToModels(mixed $models, $charTraits): void
    {
        foreach ($models as $model) {
            for ($i = rand(0, 4); $i > 0; $i--) {
                $model->characterTraits()->attach($charTraits[rand(0, count($charTraits) - 1)]);
            }
        }
    }

    /**
     * @param Collection $pivotModels
     * @return void
     */
    public function setTraitLevelOnPivotModel(Collection $pivotModels): void
    {
        foreach ($pivotModels as $x) {
            $x->traitLevel = rand(0, 2);
            $x->save();
        }
    }
}
