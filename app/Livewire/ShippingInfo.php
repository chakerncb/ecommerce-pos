<?php

namespace App\Livewire;

use Livewire\Component;

class ShippingInfo extends Component
{

    protected $listeners = ['cartUpdated' => 'render'];
    public $selectedWilaya;
    public $selectedMunicipality;
    public $municipalities = [];

    public $postalCode = '';

    public function render()
    {
        $wilayas = json_decode(file_get_contents(public_path('algeria_cities.json')));

        $uniqueWilayas = collect($wilayas)
             ->unique('wilaya_name_ascii')
             ->values()
             ->all();        

        $wilayas = json_decode(json_encode($uniqueWilayas));

        $municipalities = $this->municipalities;
        return view('livewire.shipping-info', compact('wilayas'));
    }

    public function updateMunicipalities()
    {
        $wilayas = json_decode(file_get_contents(public_path('algeria_cities.json')));
        $this->municipalities = collect($wilayas)
                ->where('wilaya_name_ascii', $this->selectedWilaya)
                ->pluck('commune_name_ascii')
                ->unique()
                ->values()
                ->all();
    }

    public function getZipCode(){
        $wilayas = json_decode(file_get_contents(public_path('algeria_cities.json')));
        
        $municipality = collect($wilayas)
                  ->where('wilaya_name_ascii', $this->selectedWilaya)
                  ->where('commune_name_ascii', $this->selectedMunicipality)
                  ->first();

        $this->postalCode = $municipality->post_code;
    }
}
