<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Employees';
    protected static ?string $navigationGroup = 'Employees Group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Person al info')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('name')->required(),
                        Forms\Components\TextInput::make('email')->required(),
                        Forms\Components\TextInput::make('password')->password()->required(),
                    ]),
                
                Section::make('Address info')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('address'),
                        Forms\Components\TextInput::make('numero'),
                        Forms\Components\TextInput::make('cp'),
                        Forms\Components\Select::make('country_id')
                            ->relationship(name : 'country',titleAttribute:'name')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->required(),
                        Forms\Components\Select::make('state_id')
                            ->relationship(name : 'state',titleAttribute:'name')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->required(),
                        Forms\Components\Select::make('city_id')
                            ->relationship(name : 'city',titleAttribute:'name')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->required(),
                        
                    ]),
                

                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('numero'),
                Tables\Columns\TextColumn::make('cp'),
                Tables\Columns\TextColumn::make('country.name'),
                Tables\Columns\TextColumn::make('state.name'),
                Tables\Columns\TextColumn::make('city.name'),

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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
