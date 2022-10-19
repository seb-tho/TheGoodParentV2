<?php

namespace App\Services;

use App\Models\CharacterTrait;
use App\Models\Child;
use App\Models\LifeEvent;
use Illuminate\Support\Collection;

class LifeEventCouplingService
{
    private Collection $events;

    public function __construct(Collection $events)
    {
        $this->events = $events;
    }

    public function couple()
    {
        foreach ($this->events as $event) {
            $traits = $event->characterTraits;
            $traitsWithFirstDegree = $this->getTraitsWithTraitlevel($traits, 1);
            $traitsWithSecondDegree = $this->getTraitsWithTraitlevel($traits, 2);

            switch (true) {
                case (count($traitsWithFirstDegree) == 1):
                    $this->oneTraitInFirstDegree($event, $traitsWithFirstDegree);
                    break;
                case (count($traitsWithFirstDegree) >= 2 && count($traitsWithSecondDegree) >= 1):
                    $this->twoTraitsInFirstDegreeAndAtLeastOneInSecondDegree($event, $traitsWithFirstDegree, $traitsWithSecondDegree);
                    break;
                case (count($traitsWithFirstDegree) >= 2):
                    $this->twoTraitsInFirstDegree($event, $traitsWithFirstDegree);
                    break;
            }
        }
    }

    private function getTraitsWithTraitlevel(Collection $traits, int $traitLevel): Collection
    {
        return $traits->filter(function (CharacterTrait $trait) use ($traitLevel) {
            return $trait->traitLevel == $traitLevel;
        });
    }

    private function oneTraitInFirstDegree(LifeEvent $event, Collection $traits)
    {
        //kinderen zoeken die betreffende trait hebben in de eerste degree
        $children = Child::with('characterTraits')->whereHas('characterTraits', function ($q) use ($traits) {
            $q->find($traits[0]->id)->where('traitLevel', '=', 1);
        });

        foreach ($children as $child) {
            $child->attach($event);
        }
    }

    private function twoTraitsInFirstDegreeAndAtLeastOneInSecondDegree(LifeEvent $event, Collection $traitsWithFirstDegree, Collection $traitsWithSecondDegree)
    {
        //kinderen zoeken die minstens 2 betreffende traits hebben in de eerste degree OF minstens 1 van die 1ste degree en minstens 2 van die 2de degree
        $traitIdsFirstDegree = $traitsWithFirstDegree->map(function ($trait) {
            return $trait->id;
        });
        $traitIdsSecondDegree = $traitsWithSecondDegree->map(function ($trait) {
            return $trait->id;
        });

        $childrenWithFirstDegrees = Child::with('characterTraits')->whereHas('characterTraits', function ($q) use ($traitIdsFirstDegree) {
            $q->where('id', $traitIdsFirstDegree);
        });

        $childrenWithSecondDegrees = Child::with('characterTraits')->whereHas('characterTraits', function ($q) use ($traitIdsSecondDegree) {
            $q->where('id', $traitIdsSecondDegree);
        });

        $totalChildren = new Collection();

        foreach ($childrenWithFirstDegrees as $child) {
            if ($child->charachtertraits->where('traitlevel', '=', 1) >= 2) {
                $totalChildren->add($child);
            }
        }

        foreach ($childrenWithSecondDegrees as $child) {
            if ($child->charachtertraits->where('traitlevel', '=', 1) == 2 && $child->charachtertraits->where('traitlevel', '=', 2) >= 2) {
                $totalChildren->add($child);
            }
        }


        foreach ($totalChildren->unique('id') as $child) {
            $child->attach($event);
        }
    }

    private function twoTraitsInFirstDegree(LifeEvent $event, Collection $traits)
    {
        //kinderen zoeken die minstens 2 betreffende traits hebben in de eerste degree
        $traitIds = $traits->map(function ($trait) {
            return $trait->id;
        });
        $children = Child::with('characterTraits')->whereHas('characterTraits', function ($q) use ($traitIds) {
            $q->where('id', $traitIds)->where('traitLevel', '=', 1);
        });

        foreach ($children as $child) {
            $child->attach($event);
        }

    }


}

