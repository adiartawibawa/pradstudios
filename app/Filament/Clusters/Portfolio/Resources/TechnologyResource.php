<?php

namespace App\Filament\Clusters\Portfolio\Resources;

use App\Filament\Clusters\Portfolio;
use App\Filament\Clusters\Portfolio\Resources\TechnologyResource\Pages;
use App\Filament\Clusters\Portfolio\Resources\TechnologyResource\RelationManagers;
use App\Models\Technology;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TechnologyResource extends Resource
{
    protected static ?string $model = Technology::class;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    protected static ?string $navigationLabel = 'Technologies';

    protected static ?int $navigationSort = 2;

    protected static ?string $cluster = Portfolio::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\FileUpload::make('icon')
                    ->image()
                    ->directory('technologies'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('icon')
                    ->label('Icon'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('projects_count')
                    ->counts('projects')
                    ->label('Projects'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTechnologies::route('/'),
        ];
    }
}
