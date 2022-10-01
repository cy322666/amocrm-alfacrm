<?php

namespace App\Orchid\Screens\GetCourse;

use App\Models\GetCourse\Form;
use App\Orchid\Layouts\GetCourse\FormTableLayout;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Screen;

class FormsScreen extends Screen
{

    public string $description = 'Список заявок с форм на Геткурс';

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Регистрации на сайтах';
    }
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'forms' => Auth::user()
                ->getcourseSetting
                ->forms()
                ->orderBy('created_at', 'desc')
                ->paginate(),
        ];
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
            FormTableLayout::class,
        ];
    }
}
