<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Models\Bank;
use App\Models\Tag;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    public function form(Form $form): Form
    {
        $tags = Tag::pluck('name', 'id');
        $banks = Bank::pluck('name', 'id');

        return $form
            ->schema([
                TextInput::make('amount')->required(),
                TextInput::make('fee')->required(),
                TextInput::make('description'),
                Select::make('type')->options([
                    'income' => 'income',
                    'cost' => 'cost'
                ])->required(),
                Select::make('from')->options($banks),
                Select::make('to')->options($banks),
                Select::make('tags')->multiple()->options($tags)
            ]);

    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $tags = $data['tags'] ?? [];
        unset($data['tags']);

        $this->data['tags'] = $tags;

        return $data;
    }

    protected function afterCreate(): void
    {
        $this->record->tags()->attach($this->data['tags']);


        // change bank balance

        if ($this->record->type == 'income') {
            $bank = Bank::query()->find($this->record->to);

            $bank->balance += $this->record->amount;
            $bank->save();
        }

        if ($this->record->type == 'cost') {
            $bank = Bank::query()->find($this->record->from);
            if ($this->record->amount <= $bank->balance) {
                $bank->balance -= ($this->record->amount + $this->record->fee);
                $bank->save();
            } else {
                throw ValidationException::withMessages(
                    [
                        'amount' => 'از سقف زدی بالا'
                    ]);
            }
        }
    }
}
