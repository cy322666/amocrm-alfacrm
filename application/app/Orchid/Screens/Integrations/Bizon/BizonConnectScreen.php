<?php

namespace App\Orchid\Screens\Integrations\Bizon;

use App\Orchid\Layouts\ConnectAmoCRM;
use App\Orchid\Layouts\BizonConnectEndpoint;
use App\Orchid\Layouts\BizonConnectInfo;
use App\Orchid\Layouts\BizonConnectToken;
use App\View\Components\Hello;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class BizonConnectScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Подключение';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Подключите системы к платформе';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }
    
    /**
     * Views.
     *
     * @return array
     */
    public function layout(): array
    {
        return [
            Layout::block(BizonConnectEndpoint::class)
                ->title('Шаг 1')
                ->description('Добавьте webhook в кабинете Бизон 365'),
            
            Layout::block(BizonConnectToken::class)
                ->title('Шаг 2')
                ->description('Скопируйте токен в поле'),//TODO под ним кнопка с инструкцией
    
            Layout::block(BizonConnectInfo::class)
                ->title('Шаг 3')
                ->description('Произведите настройку интеграции'),
        ];
    }
    
    public function save(Request $request)
    {
        try {
        
            $account = Auth::user()->account;
            
            $account->token_bizon = $request->post('token');
            
            if($account->save())
                Toast::success($request->get('toast', 'Успешно'));
        
            } catch (\Exception $exception) {
    
                Toast::error($request->get('toast', $exception->getMessage()));
        }
    }
}
