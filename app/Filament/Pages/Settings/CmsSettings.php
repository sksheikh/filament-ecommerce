<?php

namespace App\Filament\Pages\Settings;

use App\Models\Setting;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class CmsSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-photo';

    protected string $view = 'filament.pages.settings.cms-settings';

    protected static string | \UnitEnum | null $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'CMS / Homepage';

    protected static ?string $title = 'CMS & Homepage Content';

    protected static ?int $navigationSort = 101;

    public ?array $data = [];

    public function mount(): void
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('🦸 Hero Section')
                    ->description('Controls the main banner on the homepage.')
                    ->components([
                        TextInput::make('hero_badge')
                            ->label('Badge Text')
                            ->placeholder('e.g. New Arrivals 2024')
                            ->columnSpan(1),

                        TextInput::make('hero_title')
                            ->label('Headline')
                            ->placeholder('e.g. Elevate Your Digital Life')
                            ->columnSpan(1),

                        TextInput::make('hero_highlight')
                            ->label('Highlighted Word(s) in Headline')
                            ->placeholder('e.g. Digital Life')
                            ->helperText('This part will be gradient-colored in the title.')
                            ->columnSpan(1),

                        Textarea::make('hero_subtitle')
                            ->label('Subtitle / Description')
                            ->rows(3)
                            ->columnSpanFull(),

                        TextInput::make('hero_btn_primary_text')
                            ->label('Primary Button Text')
                            ->placeholder('Shop Collection')
                            ->columnSpan(1),

                        TextInput::make('hero_btn_primary_url')
                            ->label('Primary Button URL')
                            ->placeholder('/products')
                            ->columnSpan(1),

                        TextInput::make('hero_btn_secondary_text')
                            ->label('Secondary Button Text')
                            ->placeholder('Learn More')
                            ->columnSpan(1),

                        TextInput::make('hero_btn_secondary_url')
                            ->label('Secondary Button URL')
                            ->placeholder('/contact')
                            ->columnSpan(1),

                        TextInput::make('hero_image_url')
                            ->label('Hero Image URL')
                            ->placeholder('https://...')
                            ->helperText('Paste an external image URL for the hero section.')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('✅ Trust Factors')
                    ->description('The 4 feature highlights shown below the hero section.')
                    ->components([
                        TextInput::make('trust_1_title')->label('Feature 1 Title')->placeholder('Free Shipping'),
                        TextInput::make('trust_1_subtitle')->label('Feature 1 Subtitle')->placeholder('On all orders over ৳5000'),
                        TextInput::make('trust_2_title')->label('Feature 2 Title')->placeholder('100% Secure'),
                        TextInput::make('trust_2_subtitle')->label('Feature 2 Subtitle')->placeholder('Encrypted payment gateway'),
                        TextInput::make('trust_3_title')->label('Feature 3 Title')->placeholder('Easy Returns'),
                        TextInput::make('trust_3_subtitle')->label('Feature 3 Subtitle')->placeholder('7-day replacement policy'),
                        TextInput::make('trust_4_title')->label('Feature 4 Title')->placeholder('24/7 Support'),
                        TextInput::make('trust_4_subtitle')->label('Feature 4 Subtitle')->placeholder('Dedicated help center'),
                    ])->columns(2),

                Section::make('🎁 Offer / Newsletter Banner')
                    ->description('The dark promotional banner in the middle of the homepage.')
                    ->components([
                        TextInput::make('offer_title')
                            ->label('Offer Headline')
                            ->placeholder('Join the Tech Revolution.')
                            ->columnSpanFull(),

                        TextInput::make('offer_subtitle')
                            ->label('Offer Subtitle')
                            ->placeholder('Get ৳500 Off Your First Order!')
                            ->columnSpan(1),

                        Textarea::make('offer_description')
                            ->label('Offer Description')
                            ->rows(2)
                            ->columnSpanFull(),

                        TextInput::make('offer_btn_text')
                            ->label('Button Text')
                            ->placeholder('Keep Me Updated')
                            ->columnSpan(1),
                    ])->columns(2),

                Section::make('🆘 Support Banner')
                    ->description('The blue support CTA banner at the bottom of the product detail page.')
                    ->components([
                        TextInput::make('support_title')
                            ->label('Support Title')
                            ->placeholder('Need Support With This Purchase?')
                            ->columnSpanFull(),

                        Textarea::make('support_description')
                            ->label('Support Description')
                            ->rows(2)
                            ->columnSpanFull(),

                        TextInput::make('support_btn_chat_text')
                            ->label('Chat Button Text')
                            ->placeholder('Chat with an Agent')
                            ->columnSpan(1),

                        TextInput::make('support_btn_chat_url')
                            ->label('Chat Button URL')
                            ->placeholder('/contact')
                            ->columnSpan(1),

                        TextInput::make('support_phone')
                            ->label('Support Phone Number')
                            ->placeholder('+880123456789')
                            ->columnSpan(1),

                        TextInput::make('support_btn_call_text')
                            ->label('Call Button Text')
                            ->placeholder('Call Support')
                            ->columnSpan(1),
                    ])->columns(2),

                Section::make('📖 About Page — Hero')
                    ->description('Top hero banner on the About Us page.')
                    ->components([
                        TextInput::make('about_hero_title')
                            ->label('Hero Title')
                            ->placeholder('Our Journey Towards Excellence')
                            ->columnSpan(1),

                        TextInput::make('about_hero_highlight')
                            ->label('Highlighted Word(s)')
                            ->placeholder('Excellence')
                            ->helperText('This part will be gradient-colored in the title.')
                            ->columnSpan(1),

                        Textarea::make('about_hero_subtitle')
                            ->label('Hero Subtitle')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('📖 About Page — Our Story')
                    ->description('The story section with image, text, and stats.')
                    ->components([
                        TextInput::make('about_story_badge')
                            ->label('Badge Text')
                            ->placeholder('The Beginning')
                            ->columnSpan(1),

                        TextInput::make('about_story_title')
                            ->label('Story Title')
                            ->placeholder('Empowering Innovation Since 2020')
                            ->columnSpan(1),

                        Textarea::make('about_story_p1')
                            ->label('Story Paragraph 1')
                            ->rows(3)
                            ->columnSpanFull(),

                        Textarea::make('about_story_p2')
                            ->label('Story Paragraph 2')
                            ->rows(3)
                            ->columnSpanFull(),

                        TextInput::make('about_story_image_url')
                            ->label('Story Image URL')
                            ->placeholder('https://...')
                            ->columnSpanFull(),

                        TextInput::make('about_stat1_value')->label('Stat 1 Value')->placeholder('15k+')->columnSpan(1),
                        TextInput::make('about_stat1_label')->label('Stat 1 Label')->placeholder('Happy Customers')->columnSpan(1),
                        TextInput::make('about_stat2_value')->label('Stat 2 Value')->placeholder('500+')->columnSpan(1),
                        TextInput::make('about_stat2_label')->label('Stat 2 Label')->placeholder('Genuine Products')->columnSpan(1),
                    ])->columns(2),

                Section::make('📖 About Page — Core Values')
                    ->description('The 3 value cards section.')
                    ->components([
                        TextInput::make('about_values_title')
                            ->label('Section Title')
                            ->placeholder('What Drives Us')
                            ->columnSpan(1),

                        Textarea::make('about_values_subtitle')
                            ->label('Section Subtitle')
                            ->rows(2)
                            ->columnSpanFull(),

                        TextInput::make('about_value1_title')->label('Value 1 Title')->placeholder('Authenticity Guaranteed')->columnSpan(1),
                        Textarea::make('about_value1_text')->label('Value 1 Text')->rows(2)->columnSpan(1),
                        TextInput::make('about_value2_title')->label('Value 2 Title')->placeholder('Customer First')->columnSpan(1),
                        Textarea::make('about_value2_text')->label('Value 2 Text')->rows(2)->columnSpan(1),
                        TextInput::make('about_value3_title')->label('Value 3 Title')->placeholder('Innovation Focused')->columnSpan(1),
                        Textarea::make('about_value3_text')->label('Value 3 Text')->rows(2)->columnSpan(1),
                    ])->columns(2),

                Section::make('📖 About Page — CTA Banner')
                    ->description('The bottom call-to-action banner on the About page.')
                    ->components([
                        TextInput::make('about_cta_title')
                            ->label('CTA Title')
                            ->placeholder('Ready to experience the future of technology?')
                            ->columnSpanFull(),

                        TextInput::make('about_cta_btn_text')
                            ->label('CTA Button Text')
                            ->placeholder('Start Shopping Now')
                            ->columnSpan(1),

                        TextInput::make('about_cta_btn_url')
                            ->label('CTA Button URL')
                            ->placeholder('/products')
                            ->columnSpan(1),
                    ])->columns(2),

            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save CMS Settings')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            foreach ($data as $key => $value) {
                Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            }

            \App\Helpers\CmsHelper::clearCache();

            Notification::make()
                ->title('CMS settings saved successfully!')
                ->success()
                ->send();
        } catch (\Exception $exception) {
            Notification::make()
                ->title('Error saving CMS settings')
                ->danger()
                ->body($exception->getMessage())
                ->send();
        }
    }
}
