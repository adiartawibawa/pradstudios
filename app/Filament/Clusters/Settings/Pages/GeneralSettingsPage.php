<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Filament\Clusters\Settings;
use App\Settings\GeneralSettings;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class GeneralSettingsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'General Settings';

    protected static ?string $navigationGroup = 'Site Settings';

    protected static ?int $navigationSort = 1;

    protected static ?string $cluster = Settings::class;

    protected static string $view = 'filament.clusters.settings.pages.general-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(app(GeneralSettings::class)->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('GeneralSettingsTabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Branding')
                            ->icon('heroicon-o-flag')
                            ->schema([
                                Forms\Components\TextInput::make('site_name')
                                    ->label('Site Name')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('site_tagline')
                                    ->label('Site Tagline')
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                Forms\Components\FileUpload::make('logo')
                                    ->label('Logo')
                                    ->image()
                                    ->directory('settings/general')
                                    ->disk('public')
                                    ->preserveFilenames()
                                    ->maxSize(2048)
                                    ->imagePreviewHeight(100)
                                    ->panelAspectRatio('2:1')
                                    ->helperText('Recommended size: 200x50px, Max 2MB')
                                    ->downloadable()
                                    ->openable(),

                                Forms\Components\FileUpload::make('favicon')
                                    ->label('Favicon')
                                    ->image()
                                    ->directory('settings/general')
                                    ->disk('public')
                                    ->preserveFilenames()
                                    ->maxSize(512)
                                    ->imagePreviewHeight(50)
                                    ->helperText('Recommended size: 32x32px, Max 512KB')
                                    ->downloadable()
                                    ->openable(),
                            ])
                            ->columns(2),

                        Forms\Components\Tabs\Tab::make('Contact')
                            ->icon('heroicon-o-envelope')
                            ->schema([
                                Forms\Components\TextInput::make('email')
                                    ->label('Email Address')
                                    ->email()
                                    ->maxLength(255)
                                    ->rule('email:rfc,dns'),

                                Forms\Components\TextInput::make('phone')
                                    ->label('Phone Number')
                                    ->tel()
                                    ->maxLength(20),

                                Forms\Components\Textarea::make('address')
                                    ->label('Physical Address')
                                    ->maxLength(500)
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),

                        Forms\Components\Tabs\Tab::make('Footer & Social')
                            ->icon('heroicon-o-share')
                            ->schema([
                                Forms\Components\Textarea::make('footer_text')
                                    ->label('Footer Copyright Text')
                                    ->maxLength(500)
                                    ->helperText('Supports basic HTML tags')
                                    ->columnSpanFull(),

                                Forms\Components\Repeater::make('social_links')
                                    ->label('Social Media Links')
                                    ->schema([
                                        Forms\Components\Select::make('platform')
                                            ->options([
                                                'facebook' => 'Facebook',
                                                'twitter' => 'Twitter/X',
                                                'instagram' => 'Instagram',
                                                'youtube' => 'YouTube',
                                                'linkedin' => 'LinkedIn',
                                                'tiktok' => 'TikTok',
                                                'whatsapp' => 'WhatsApp',
                                            ])
                                            ->required()
                                            ->native(false),

                                        Forms\Components\TextInput::make('url')
                                            ->label('Profile URL')
                                            ->required()
                                            ->url()
                                            ->maxLength(255)
                                            ->prefix('https://'),
                                    ])
                                    ->defaultItems(1)
                                    ->addActionLabel('Add Social Media')
                                    ->collapsible()
                                    ->cloneable()
                                    ->itemLabel(fn(array $state): ?string => $state['platform'] ?? null)
                                    ->columns(2),
                            ]),
                    ])
                    ->persistTabInQueryString()
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('save')
                ->label('Save Settings')
                ->action('save')
                ->color('primary')
                ->icon('heroicon-o-check'),
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            // Handle file uploads
            $data['logo'] = $this->normalizeFilePath($data['logo'] ?? null);
            $data['favicon'] = $this->normalizeFilePath($data['favicon'] ?? null);

            // Save settings
            $settings = app(GeneralSettings::class);
            $settings->fill($data);
            $settings->save();

            // Clear cache
            \Illuminate\Support\Facades\Artisan::call('cache:clear');

            // Notification
            Notification::make()
                ->title('Settings saved successfully')
                ->success()
                ->send();
        } catch (\Throwable $e) {
            Notification::make()
                ->title('Error saving settings')
                ->body($e->getMessage())
                ->danger()
                ->send();

            report($e);
        }
    }

    protected function normalizeFilePath($file): ?string
    {
        if (blank($file)) {
            return null;
        }

        if (is_array($file)) {
            return Storage::disk('public')->url($file[0]);
        }

        return $file;
    }
}
