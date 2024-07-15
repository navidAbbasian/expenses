<?php

namespace App\Filament\Resources\BankResource\Pages;

use App\Filament\Resources\BankResource;
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
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('account_number')->required(),
                TextInput::make('account_owner')->required(),
            ]);
    }
}
