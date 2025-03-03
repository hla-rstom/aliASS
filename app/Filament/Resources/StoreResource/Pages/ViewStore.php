<?php

namespace App\Filament\Resources\StoreResource\Pages;

use App\Filament\Resources\StoreResource;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid as InfolistGrid;
use Filament\Infolists\Components\Section as InfolistSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ViewStore extends ViewRecord
{
    protected static string $resource = StoreResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistSection::make('Store Information')
                    ->schema([
                        InfolistGrid::make(2)
                            ->schema([
                                TextEntry::make('name')->label('Store Name'),
                                TextEntry::make('address')->label('Address'),
                                TextEntry::make('city')->label('City'),
                                TextEntry::make('state')->label('State'),
                                TextEntry::make('zipcode')->label('Zip Code'),
                                TextEntry::make('town')->label('Town'),
                                TextEntry::make('region')->label('Region')
                                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                                TextEntry::make('address_type')->label('Address Type'),
                            ]),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Racks')
            ->description('Manage racks for this store')
            ->relationship(fn () => $this->record->racks())
            ->columns([
                TextColumn::make('name')->label('Name')->searchable()->sortable(),
                TextColumn::make('width')->label('Width')->sortable(),
                TextColumn::make('length')->label('Length')->sortable(),
                TextColumn::make('capacity')->label('Capacity')->sortable(),
                TextColumn::make('price_per_day')->label('Price Per Day')->money('USD')->sortable(),
                ImageColumn::make('photo')->label('Photo'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Add Rack') // ✅ Button Label
                    ->form(fn (Form $form): Form => $this->getRackForm($form)), // ✅ Ensure Form
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->form(fn (Form $form): Form => $this->getRackForm($form)), // ✅ Ensure Edit Form
                Tables\Actions\DeleteAction::make(),
            ]);
    }


    protected function getRackForm(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make('Rack Information')->schema([
                    TextInput::make('store_id')
                        ->hidden() // ✅ Hidden field for linking store
                        ->default($this->record->id), // ✅ Automatically set store_id

                    TextInput::make('name')->label('Name')->required(),
                    TextInput::make('width')->label('Width')->numeric()->required(),
                    TextInput::make('length')->label('Length')->numeric()->required(),
                    TextInput::make('capacity')->label('Capacity')->numeric()->required(),
                    TextInput::make('price_per_day')->label('Price Per Day')->numeric()->required(),
                    TextInput::make('price_per_week')->label('Price Per Week')->numeric()->required(),
                    TextInput::make('price_per_month')->label('Price Per Month')->numeric()->required(),
                    FileUpload::make('photo')
                        ->label('Photo')
                        ->image()
                        ->directory('rack-photos')
                        ->visibility('public')
                        ->maxSize(5120),
                ])->columns(2),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
