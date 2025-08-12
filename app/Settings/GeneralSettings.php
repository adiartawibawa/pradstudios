<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;
    public ?string $site_tagline;
    public ?string $logo;
    public ?string $favicon;
    public ?string $email;
    public ?string $phone;
    public ?string $address;
    public ?string $footer_text;
    public array $social_links;

    public static function group(): string
    {
        return 'general';
    }

    public static function defaults(): array
    {
        return [
            'site_name' => 'PRADStudio',
            'site_tagline' => 'Your Trusted Creative Digital Solutions Partner',
            'logo' => null,
            'favicon' => null,
            'email' => 'surat.buat.adi@gmail.com',
            'phone' => '+62819-1617-5060',
            'address' => 'Bali, Indonesia',
            'footer_text' => '© 2025 PRADStudio. All rights reserved.',
            'social_links' => [
                [
                    'platform' => 'Facebook',
                    'url' => 'https://facebook.com/pradstudio'
                ],
                [
                    'platform' => 'Instagram',
                    'url' => 'https://instagram.com/pradstudios'
                ],
                [
                    'platform' => 'LinkedIn',
                    'url' => 'https://linkedin.com/company/pradstudio'
                ]
            ],
        ];
    }
}
