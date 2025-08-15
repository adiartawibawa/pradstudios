<?php

namespace App\Filament\Clusters\Portfolio\Resources;

use App\Filament\Clusters\Portfolio;
use App\Filament\Clusters\Portfolio\Resources\ProjectResource\Pages;
use App\Filament\Clusters\Portfolio\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationLabel = 'Projects';

    protected static ?int $navigationSort = 1;

    protected static ?string $cluster = Portfolio::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->readOnly(),
                        Forms\Components\TextInput::make('subtitle')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image_url')
                            ->image()
                            ->directory('projects')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Project Details')
                    ->schema([
                        Forms\Components\TextInput::make('category')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('client_name')
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('project_date'),
                        Forms\Components\TextInput::make('project_url')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('case_study_url')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('app_store_url')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('play_store_url')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('video_url')
                            ->url()
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Select::make('technologies')
                            ->relationship('technologies', 'name')
                            ->multiple()
                            ->preload(),
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_featured'),
                        Forms\Components\Toggle::make('is_published'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Thumbnail'),
                Tables\Columns\TextColumn::make('title')
                    ->description(fn(Project $record): string => $record->slug)
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean(),
                Tables\Columns\TextColumn::make('project_date')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('featured')
                    ->query(fn(Builder $query): Builder => $query->where('is_featured', true))
                    ->label('Only Featured'),
                Tables\Filters\Filter::make('published')
                    ->query(fn(Builder $query): Builder => $query->where('is_published', true))
                    ->label('Only Published'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            // Relations\TestimonialsRelationManager::class,
            // Relations\InsightsRelationManager::class,
            // Relations\ClientsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
