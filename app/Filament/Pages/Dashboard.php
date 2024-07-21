<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BasePage;

class Dashboard extends BasePage
{
    protected function getSubheading(): string| null|\Illuminate\Contracts\Support\Htmlable
    {
        return 'NEW DASHBOARD';
    }
    protected function getWidgets(): array
    {
        return parent::getWidgets();
    }
}
