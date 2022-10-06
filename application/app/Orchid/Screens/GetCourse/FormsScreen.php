<?php

namespace App\Orchid\Screens\GetCourse;

use App\Models\GetCourse\Form;
use App\Orchid\Layouts\GetCourse\FormTableLayout;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Action;
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
        return 'Заявки';
    }
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'forms' => Form::query()
                ->where('user_id', Auth::user()->id)
                ->orderBy('created_at', 'desc')
                ->paginate(15),
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return iterable
     */
    public function layout(): iterable
    {
        return [
            FormTableLayout::class,
        ];
    }
}
