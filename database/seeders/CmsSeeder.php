<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cms = [
            // ── Hero Section ──────────────────────────────────────────────
            'hero_badge'               => 'New Arrivals 2024',
            'hero_title'               => 'Elevate Your Digital Life',
            'hero_highlight'           => 'Digital Life',
            'hero_subtitle'            => 'Discover a curated selection of premium electronics, from the latest smartphones to high-performance laptops. Innovation at your fingertips.',
            'hero_btn_primary_text'    => 'Shop Collection',
            'hero_btn_primary_url'     => '/products',
            'hero_btn_secondary_text'  => 'Learn More',
            'hero_btn_secondary_url'   => '/contact',
            'hero_image_url'           => 'https://images.unsplash.com/photo-1491933382434-500287f9b54b?q=80&w=1000&auto=format&fit=crop',

            // ── Trust Factors ─────────────────────────────────────────────
            'trust_1_title'    => 'Free Shipping',
            'trust_1_subtitle' => 'On all orders over ৳5000',
            'trust_2_title'    => '100% Secure',
            'trust_2_subtitle' => 'Encrypted payment gateway',
            'trust_3_title'    => 'Easy Returns',
            'trust_3_subtitle' => '7-day replacement policy',
            'trust_4_title'    => '24/7 Support',
            'trust_4_subtitle' => 'Dedicated help center',

            // ── Offer / Newsletter Banner ─────────────────────────────────
            'offer_title'       => 'Join the Tech Revolution.',
            'offer_subtitle'    => 'Get ৳500 Off Your First Order!',
            'offer_description' => 'Subscribe to our newsletter for the latest tech news, exclusive deals, and early access to new releases.',
            'offer_btn_text'    => 'Keep Me Updated',

            // ── Support Banner (Product Detail Page) ──────────────────────
            'support_title'         => 'Need Support With This Purchase?',
            'support_description'   => 'Our tech experts are here to help you make the best decision for your lifestyle. Contact us 24/7.',
            'support_btn_chat_text' => 'Chat with an Agent',
            'support_btn_chat_url'  => '/contact',
            'support_phone'         => '+880123456789',
            'support_btn_call_text' => 'Call Support',

            // ── About Page — Hero ──────────────────────────────────────────
            'about_hero_title'     => 'Our Journey Towards Excellence',
            'about_hero_highlight' => 'Excellence',
            'about_hero_subtitle'  => 'Founded with a vision to redefine the digital experience, Nafisa Mart has grown into a trusted destination for premium electronics.',

            // ── About Page — Story ────────────────────────────────────────
            'about_story_badge'     => 'The Beginning',
            'about_story_title'     => 'Empowering Innovation Since 2020',
            'about_story_p1'        => 'Nafisa Mart started as a small passion project in Dhaka, driven by the desire to bring genuine, high-quality international tech brands to the doorstep of every technology enthusiast in Bangladesh.',
            'about_story_p2'        => 'Today, we serve thousands of customers monthly, providing not just products, but a commitment to quality, reliability, and unparalleled after-sales support. We believe that technology should be accessible, and more importantly, it should come with trust.',
            'about_story_image_url' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1000&auto=format&fit=crop',
            'about_stat1_value'     => '15k+',
            'about_stat1_label'     => 'Happy Customers',
            'about_stat2_value'     => '500+',
            'about_stat2_label'     => 'Genuine Products',

            // ── About Page — Values ───────────────────────────────────────
            'about_values_title'    => 'What Drives Us',
            'about_values_subtitle' => 'Our core values are the foundation of everything we do at Nafisa Mart.',
            'about_value1_title'    => 'Authenticity Guaranteed',
            'about_value1_text'     => 'Every product we sell is 100% genuine and sourced directly from authorized global distributors.',
            'about_value2_title'    => 'Customer First',
            'about_value2_text'     => 'Our support team works tirelessly to ensure your experience after purchase is as smooth as your shopping journey.',
            'about_value3_title'    => 'Innovation Focused',
            'about_value3_text'     => 'We are constantly updating our inventory with the latest global trends in IoT and modern living.',

            // ── About Page — CTA ──────────────────────────────────────────
            'about_cta_title'    => 'Ready to experience the future of technology?',
            'about_cta_btn_text' => 'Start Shopping Now',
            'about_cta_btn_url'  => '/products',
        ];

        foreach ($cms as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
