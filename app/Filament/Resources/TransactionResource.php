<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationLabel = 'تراکنش ها';
    protected static ?string $modelLabel = 'تراکنش';
    protected static ?string $pluralLabel = 'تراکنش ها';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('amount')->label('فی'),
                TextColumn::make('fee')->label('مالیات'),
                TextColumn::make('description')->label('توضیحات'),
                TextColumn::make('type')->label('نوع'),
                TextColumn::make('from')->label('از حساب'),
                TextColumn::make('to')->label('به حساب'),
                TextColumn::make('tags.name')->label('برچسب ها'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
