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
        $died = 0;
        $dying = 0;

        foreach ($animals as $animal) {
            if ($animal->title == 'elephant' && $animal->health < 0.7) {
                $animal->state = 'dead';
                $died++;
            } else {
                $animal->health -= (rand(0, 20) / 100);

                if ($animal->title == 'elephant' && $animal->health < 0.7) {
                    $animal->state = 'cannot_walk';
                    $dying++;
                } else if ($animal->title == 'monkey' && $animal->health < 0.3) {
                    $animal->state = 'dead';
                    $died++;
                } else if ($animal->title == 'giraffe' && $animal->health < 0.5) {
                    $animal->state = 'dead';
                    $died++;
                } else {
                    $dying++;
                }
            }

            $animal->save();
        }

        return response()->json([
            'died' => $died,
            'dying' => $dying
        ]);
    }

    /**
     * Revive all animals, reset health and state
     *
     * @return Response
     */
    public function revive() {
        $animals = Animal::all();
        $revived = 0;

        foreach ($animals as $animal) {
            if ($animal->state == 'dead') {
                $revived++;
            }

            $animal->state = 'can_walk';
            $animal->health = 1.0;
            $animal->save();
        }

        return response()->json([
            'revived' => $revived,
            'total' => sizeof($animals)
        ]);
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
        $fed = 0;
        $full = 0;

        foreach ($animals as $animal) {
            $animal->health += (rand(10, 25) / 100);

            if ($animal->health > 1.0) {
                $animal->health = 1.0;
            }

            if ($animal->health == 1.0) {
                $full++;
            }

            $fed++;
            $animal->save();
        }

        return response()->json([
            'fed' => $fed,
            'full' => $full
        ]);
    }
}
