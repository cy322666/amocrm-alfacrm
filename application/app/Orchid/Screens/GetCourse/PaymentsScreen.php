<?php

namespace App\Orchid\Screens\GetCourse;

use App\Models\GetCourse\Payment;
use App\Orchid\Layouts\GetCourse\PaymentTableLayout;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Screen;

class PaymentsScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'payments' => Payment::query()
                ->where('user_id', Auth::user()->id)
                ->orderBy('created_at', 'desc')
                ->paginate(15),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Оплаты';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            PaymentTableLayout::class,
        ];
    }
}
