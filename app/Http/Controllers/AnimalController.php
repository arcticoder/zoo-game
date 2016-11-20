<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animal;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return Animal::all();
    }

    /**
     * Increment hunger for all animals
     *
     * @return Response
     */
    public function incrementHunger() {
        $animals = Animal::where('state', '!=', 'dead')->get();

        foreach ($animals as $animal) {
            if ($animal->title == 'elephant' && $animal->health < 0.7) {
                $animal->state = 'dead';
            } else {
                $animal->health -= (rand(0, 20) / 100);

                if ($animal->title == 'elephant' && $animal->health < 0.7) {
                    $animal->state = 'cannot_walk';
                } else if ($animal->title == 'monkey' && $animal->health < 0.3) {
                    $animal->state = 'dead';
                } else if ($animal->title == 'giraffe' && $animal->health < 0.5) {
                    $animal->state = 'dead';
                }
            }

            $animal->save();
        }
    }

    /**
     * Revive all animals, reset health and state
     *
     * @return Response
     */
    public function revive() {
        $animals = Animal::all();

        foreach ($animals as $animal) {
            $animal->state = 'can_walk';
            $animal->health = 1.0;
            $animal->save();
        }
    }

    /**
     * Feed all living animals whose health is below 100
     *
     * @return Response
     */
    public function feed() {
        $animals = Animal::where('state', '!=', 'dead')
            ->where('health', '<', 1.0)
            ->get();

        foreach ($animals as $animal) {
            $animal->health += (rand(10, 25) / 100);

            if ($animal->health > 1.0) {
                $animal->health = 1.0;
            }

            $animal->save();
        }
    }
}
