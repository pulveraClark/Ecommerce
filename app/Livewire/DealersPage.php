<?php

namespace App\Livewire;

use App\Models\Brand;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dealers')]
class DealersPage extends Component
{
    public function render()
    {
        $brands = Brand::query()
            ->where('is_active', true)
            ->with([
                'products' => function ($query) {
                    $query->where('is_active', true)
                          ->where('in_stock', true)
                          ->orderBy('name');
                }
            ])
            ->orderBy('name')
            ->get();

        return view('livewire.dealers-page', [
            'brands' => $brands,
        ]);
    }
}
