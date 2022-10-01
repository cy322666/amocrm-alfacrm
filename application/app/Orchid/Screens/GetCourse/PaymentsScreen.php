<?php

namespace App\Orchid\Screens\GetCourse;

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
            'payments' => Auth::user()
                ->getcourseSetting
                ->payments()
                ->orderBy('created_at', 'desc')
                ->paginate(),
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
        return [];
    }
}
