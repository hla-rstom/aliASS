<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RackResource\Pages;
use App\Models\Rack;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RackResource extends Resource
{
    protected static ?string $model = Rack::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('store_id')
                    ->relationship('store', 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('volume')->required()->numeric(),
                Forms\Components\TextInput::make('length')->required()->numeric(),
                Forms\Components\TextInput::make('width')->required()->numeric(),
                Forms\Components\TextInput::make('capacity')->required()->numeric(),
                Forms\Components\FileUpload::make('photo')->image(),
                Forms\Components\TextInput::make('price_per_day')->required()->numeric(),
                Forms\Components\TextInput::make('price_per_week')->required()->numeric(),
                Forms\Components\TextInput::make('price_per_month')->required()->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('store.name')->label('Store')->sortable(),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('volume')->sortable(),
                Tables\Columns\TextColumn::make('length')->sortable(),
                Tables\Columns\TextColumn::make('width')->sortable(),
                Tables\Columns\TextColumn::make('capacity')->sortable(),
                Tables\Columns\ImageColumn::make('photo'),
                Tables\Columns\TextColumn::make('price_per_day')->sortable(),
                Tables\Columns\TextColumn::make('price_per_week')->sortable(),
                Tables\Columns\TextColumn::make('price_per_month')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListRacks::route('/'),
            'create' => Pages\CreateRack::route('/create'),
            'edit' => Pages\EditRack::route('/{record}/edit'),
        ];
    }
}
