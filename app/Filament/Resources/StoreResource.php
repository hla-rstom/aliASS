<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoreResource\Pages;
use App\Filament\Resources\StoreResource\RelationManagers\RacksRelationManager;
use App\Models\Store;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Hidden;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\View;

class StoreResource extends Resource
{
    protected static ?string $model = Store::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Store Information')->schema([
                    TextInput::make('user_id')
                        ->label('User ID')
                        ->default(fn() => Auth::id())
                        ->required()
                        ->hidden(),

                    TextInput::make('name')
                        ->label('Name')
                        ->required(),
                    TextInput::make('phone')
                        ->label('Phone')
                        ->required(),
                    TextInput::make('address')
                        ->label('Address')
                        ->required(),
                    TextInput::make('city')
                        ->label('City')
                        ->required(),
                    TextInput::make('state')
                        ->label('State')
                        ->required(),
                    TextInput::make('zipcode')
                        ->label('Zip Code')
                        ->required(),
                    TextInput::make('town')
                        ->label('Town')
                        ->required(),
                    Select::make('region')
                        ->label('Region')
                        ->options([
                            'north' => 'North',
                            'south' => 'South',
                            'east' => 'East',
                            'west' => 'West',
                            'central' => 'Central',
                        ])
                        ->required(),
                    Select::make('address_type')
                        ->label('Address Type')
                        ->options([
                            'commercial' => 'Commercial',
                            'residential' => 'Residential',
                            'industrial' => 'Industrial',
                        ])
                        ->required(),
                ])->columns(2),

                Section::make('Location on Map')
                    ->schema([
                        View::make('filament.forms.components.google-maps')
                            ->columnSpan('full'),

                        Hidden::make('latitude'),
                        Hidden::make('longitude'),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('address')
                    ->label('Address')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('city')
                    ->label('City')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('state')
                    ->label('State')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('zipcode')
                    ->label('Zip Code')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl(function ($record) {
                return Pages\ViewStore::getUrl([$record->id]);
            });
    }

    public static function getRelations(): array
    {
        return [
            RacksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStores::route('/'),
            'create' => Pages\CreateStore::route('/create'),
            'view' => Pages\ViewStore::route('/{record}'),
            'edit' => Pages\EditStore::route('/{record}/edit'),
        ];
    }
}
