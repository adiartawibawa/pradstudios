<?php

namespace App\Filament\Clusters\Contact\Resources;

use App\Filament\Clusters\Contact;
use App\Filament\Clusters\Contact\Resources\ContactSubmissionResource\Pages;
use App\Filament\Clusters\Contact\Resources\ContactSubmissionResource\RelationManagers;
use App\Models\ContactSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactSubmissionResource extends Resource
{
    protected static ?string $model = ContactSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope-open';

    protected static ?string $navigationGroup = 'Contact Submissions';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'subject';

    protected static ?string $cluster = Contact::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Submission Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('subject')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('message')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('ip_address')
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Response')
                    ->schema([
                        Forms\Components\Toggle::make('is_read'),
                        Forms\Components\DateTimePicker::make('read_at'),
                        Forms\Components\Textarea::make('response')
                            ->columnSpanFull(),
                        Forms\Components\DateTimePicker::make('responded_at'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_read')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('unread')
                    ->query(fn(Builder $query): Builder => $query->where('is_read', false))
                    ->label('Only Unread'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageContactSubmissions::route('/'),
        ];
    }
}
