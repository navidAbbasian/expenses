<?php

namespace App\Filament\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Pages\Page;

class userDetail extends Page
{
    protected static string $resource = UserResource::class;
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'پروفایل';

    protected static string $view = 'filament.pages.user-detail';

    public $user;

    public function mount(): void
    {
        $this->user = auth()->user();
    }
}

