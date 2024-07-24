<?php

namespace App\Filament\Resources\BankResource\Pages;

use App\Filament\Resources\BankResource;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions;
use Filament\Resources\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Tables\Columns\TextColumn;

class CreateBank extends CreateRecord
{
    protected static string $resource = BankResource::class;

    public function form(Form $form): Form
    {
        $users = User::pluck('name','id' );

        return $form
            ->schema([
                TextInput::make('name')->required()->label('نام'),
                TextInput::make('account_number')->required()->label('شماره حساب'),
                Select::make('account_owner')->options($users)->required()->label('صاحب حساب'),
            ]);
    }
}
