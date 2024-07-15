<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Models\Bank;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions;
use Filament\Resources\Form;
use Filament\Resources\Pages\EditRecord;

class EditTransaction extends EditRecord
{
    protected static string $resource = TransactionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        $banks = Bank::pluck('name', 'id');

        return $form
            ->schema([
                TextInput::make('amount')->required(),
                TextInput::make('fee')->required(),
                TextInput::make('description'),
                TextInput::make('type')->required(),
                Select::make('from')->options($banks),
                Select::make('to')->options($banks),
            ]);
    }
}
