<?php


namespace App\Orchid\Layouts;


use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\TD;
use Orchid\Support\Color;

class BizonConnectEndpoint extends Rows
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'account';
    
    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [];
    }
    
    protected function fields(): array
    {
        $account = Auth::user()->account;
    
        return [
            Label::make('static')
                ->title('Ссылка для интеграции')
                ->value(env('APP_URL').$account->endpoint),//TODO config
                //->popover('Для вставки Webhook'),
            
            Link::make('Инструкция')
                ->type(Color::LINK())
                ->icon('book-open')
                ->href(env('APP_URL'))
        ];
    }
}