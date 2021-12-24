<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use App\Models\Admin\PaymentNumber;
use Illuminate\Support\Facades\DB;

class PaymentsNumber extends Component
{
    public $bkash;
    public $nogod;
    public $rocket;

    protected $rules = [
        'nogod' => ['nullable', 'min:11', 'max:11'],
        'bkash' => ['nullable', 'min:11', 'max:11'],
        'rocket' => ['nullable', 'min:11', 'max:11']
    ];

    public function savePaymentsNumber()
    {
        $data = $this->validate();
        // dd($data);
        // $paymentsNumber = new PaymentNumber();
        // $paymentsNumber->bkash = $this->data['bkash'];
        // $paymentsNumber->nogod = $this->data['nogod'];
        // $paymentsNumber->rocket = $this->data['rocket'];
        // $save = $paymentsNumber->save();

        $save = DB::table('payment_numbers')->updateOrInsert(
            ['id' => 1],
            [
                'bkash' => $data['bkash'],
                'nogod' => $data['nogod'],
                'rocket' => $data['rocket'],
            ]
        );

        if ($save) {
            session()->flash('status', 'Payment Number added sucessfully');
            return redirect()->route('admin.settings');
        } else {
            session()->flash('failed', 'Failed!');
            return redirect()->route('admin.settings');
        }
    }

    public function mount()
    {
        $paymentsNumber = PaymentNumber::find(1);
        if ($paymentsNumber) {
            $this->bkash = $paymentsNumber->bkash;
            $this->nogod = $paymentsNumber->nogod;
            $this->rocket = $paymentsNumber->rocket;
        }
    }

    public function render()
    {
        return view('livewire.settings.payments-number');
    }
}
