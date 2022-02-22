<?php

namespace App\Http\Livewire;

use App\Models\PhasePowerData;
use Livewire\Component;

class OrderSubmission extends Component
{
    public PhasePowerData $ppd;

    public function onSave(){
        $this->ppd->update();
    }

    public function onReady(){
        $this->ppd->update(['ready_for_adjudication' => true]);
    }

    public function render()
    {
        return view('livewire.order-submission');
    }
}
