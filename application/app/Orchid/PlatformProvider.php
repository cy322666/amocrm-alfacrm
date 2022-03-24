<?php

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            Menu::make('Аккаунт')
                ->icon('monitor')
                ->route('account.index'),

            Menu::make('Бизон 365')
                ->icon('code')
                ->title(__('Интеграции'))
                ->list([
                    Menu::make('Подключение')->icon('bag')->route('bizon.connect.index'),
                    Menu::make('Настройки')->icon('heart')->route('bizon.setting.index'),
                    Menu::make('Вебинары')->icon('list')->route('bizon.orders.webinars'),
                    //Menu::make('Посетители')->icon('list')->route('bizon.orders.viewers'),
                    Menu::make('Аналитика')->icon('bar-chart')->route('bizon.analytics.index'),
                ]),

            Menu::make('Геткурс')
                ->icon('code')
//                ->list([
//                    Menu::make('Подключение')->icon('bag')->route('bizon.connect.index'),
//                    Menu::make('Настройки')->icon('heart')->route('bizon.setting.index'),
//                    Menu::make('Вебинары')->icon('list')->route('bizon.orders.webinars'),
//                    //Menu::make('Посетители')->icon('list')->route('bizon.orders.viewers'),
//                    Menu::make('Аналитика')->icon('bar-chart')->route('bizon.analytics.index'),
            //  ])
            ,

            Menu::make('Тариф и оплата')
                ->title('Менеджмент')
                ->icon('note')
                ->route('account.pay'),

//            Menu::make('Обратная связь')
//                ->icon('briefcase')
//                ->route('platform.example.advanced'),

//            Menu::make('Overview layouts')
//                ->title('Layouts')
//                ->icon('layers')
//                ->route('platform.example.layouts'),

//            Menu::make('Chart tools')
//                ->icon('bar-chart')
//                ->route('platform.example.charts'),
//
//            Menu::make('Cards')
//                ->icon('grid')
//                ->route('platform.example.cards')
//                ->divider(),

//            Menu::make('Documentation')
//                ->title('Docs')
//                ->icon('docs')
//                ->url('https://orchid.software/en/docs'),

            Menu::make('Логи')
                ->icon('shuffle')
                ->list([
                    Menu::make('amoCRM')->icon('bag')->route('logs.amocrm.index'),
                    Menu::make('Ошибки')->icon('heart')->route('logs.errors.index'),
                ]),


//            Menu::make('Changelog')
//                ->icon('shuffle')
//                ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
//                ->target('_blank')
//                ->badge(function () {
//                    return Dashboard::version();
//                }, Color::DARK()),

            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('ROOT')),//->permission('all'),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('users.roles')
                ->permission('platform.systems.roles'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Профиль')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }

    /**
     * @return string[]
     */
    public function registerSearchModels(): array
    {
        return [
            // ...Models
            //\App\Models\User::class
        ];
    }
}
