<?php

namespace App\Filament\Pages;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static string | \BackedEnum | null $navigationIcon = 'bx-home';

    protected static string | \BackedEnum | null $activeNavigationIcon = 'bxs-home';
}
