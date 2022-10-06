<?php

declare(strict_types=1);

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
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [

            Menu::make('Аккаунт')
                ->icon('note')
                ->route('account'),

            Menu::make('АльфаСРМ')
                ->icon('grid')
                ->title('Интеграции')
                ->list([
                    Menu::make('Настройки')
                        ->icon('settings')
                        ->route('alfacrm.settings'),

                    Menu::make('События')
                        ->icon('clock')
                        ->route('alfacrm.transactions'),
                ]),

            Menu::make('Бизон365')
                ->icon('grid')
                ->list([
                    Menu::make('Настройки')
                        ->icon('settings')
                        ->route('bizon.settings'),

                    Menu::make('События')->icon('list')
                        ->icon('clock')
                        ->route('bizon.webinars'),
                ]),

            Menu::make('Геткурс')
                ->icon('grid')
                ->list([
                    Menu::make('Настройки')
                        ->icon('settings')
                        ->route('getcourse.settings'),

                    Menu::make('Заказы')
                        ->icon('list')
                        ->icon('clock')
                        ->route('getcourse.orders'),

                    Menu::make('Платежи')
                        ->icon('list')
                        ->icon('clock')
                        ->route('getcourse.payments'),

                    Menu::make('Регистрации')
                        ->icon('list')
                        ->icon('clock')
                        ->route('getcourse.forms'),
                ]),

            Menu::make('Документация')
                ->title('Дополнительно')
                ->icon('docs')
                ->url(''),//TODO

            Menu::make('Лог изменений')
                ->icon('shuffle')
//                ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
                ->target('_blank')
                ->badge(function () {
                    return config('app.version');
                }, Color::DARK()),

            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
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
}
