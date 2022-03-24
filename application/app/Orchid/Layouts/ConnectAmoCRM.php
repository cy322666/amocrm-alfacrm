<?php

namespace App\Orchid\Layouts;

use App\Services\amoCRM\Client;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Support\Color;

class ConnectAmoCRM extends Rows
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
    
        //$check = (new Client())->check($account);
        
        //TODO
        $check = false;
        
        if($check) {
            
            $array = [
                Label::make('label')
                    ->title('Статус подключения : Подключена'),
                
                Button::make('Отключить ')
                    ->method('disconnect')
                    ->type(Color::DANGER()),
            ];
            
        } else {
    
            $status = 'Отключена';
    
            $array = [
                Label::make('label')
                    ->title('Статус подключения : '.$status),
        
                Link::make('Подключить')
                    //->href((new Client())->getUrlCode($account))
                    ->style(Color::SUCCESS()),//TODO style
            ];
        }
        
        return $array;
    }
    
    public function connect()
    {
        redirect((new Client())->getUrlCode());
    }
    
    public function disconnect()
    {
        $account = Auth::user()->account;
        
        $account->access_token = null;
        $account->client_secret = null;
        $account->expires_in = null;
        $account->code = null;
        $account->save();
    }
}
