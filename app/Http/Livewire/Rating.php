<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Rating extends Component
{
    public $rating;
    public $avgRating;
    public $book;

    public function mount($book) {
        $this->book = $book;
        $userRating = $this->book->users()
            ->where('user_id', auth()->user()->id)->first();

        if (!$userRating) {
            $this->rating = 0;
        } else {
            $this->rating = $userRating->pivot->rating;
        }

        $this->calculateAverageRating();
    }

    private function calculateAverageRating() {
        $this->avgRating = round($this->book->users()->avg('rating'), 1);
    }

    public function render()
    {
        return view('livewire.rating');
    }

    public function setRating($val)
    {
        if ($this->rating == $val) {    // user can click on the same rating to reset the value
            $this->rating = 0;
        } else {
            $this->rating = $val;
        }

        $userId = auth()->user()->id;
        $userRating = $this->book->users()->where('user_id', $userId)->first();

        if (!$userRating) {
            $userRating = $this->book->users()->attach($userId, [
                'rating' => $val
            ]);
        } else {
            $this->book->users()->updateExistingPivot($userId, [
                'rating' => $val
            ], false);
        }

        $this->calculateAverageRating();
    }
}

