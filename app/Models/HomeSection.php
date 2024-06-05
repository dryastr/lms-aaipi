<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $table = 'home_sections';

    public $timestamps = false;

    protected $guarded = ['id'];

    public static $names = [
        'featured_classes',
        'latest_bundles',
        'latest_classes',
        'best_rates',
        'trend_categories',
        'full_advertising_banner',
        'best_sellers',
        'discount_classes',
        'free_classes',
        'store_products',
        'testimonials',
        'subscribes',
        'find_instructors',
        'reward_program',
        'become_instructor',
        'forum_section',
        'video_or_image_section',
        'instructors',
        'half_advertising_banner',
        'organizations',
        'blog',
        'upcoming_courses',
        'iklan_banner',
    ];

    public static $featured_classes = 'featured_classes';

    public static $latest_bundles = 'latest_bundles';

    public static $latest_classes = 'latest_classes';

    public static $best_rates = 'best_rates';

    public static $trend_categories = 'trend_categories';

    public static $full_advertising_banner = 'full_advertising_banner';

    public static $best_sellers = 'best_sellers';

    public static $discount_classes = 'discount_classes';

    public static $free_classes = 'free_classes';

    public static $store_products = 'store_products';

    public static $testimonials = 'testimonials';

    public static $subscribes = 'subscribes';

    public static $find_instructors = 'find_instructors';

    public static $reward_program = 'reward_program';

    public static $become_instructor = 'become_instructor';

    public static $forum_section = 'forum_section';

    public static $video_or_image_section = 'video_or_image_section';

    public static $instructors = 'instructors';

    public static $half_advertising_banner = 'half_advertising_banner';

    public static $organizations = 'organizations';

    public static $blog = 'blog';

    public static $upcoming_courses = 'upcoming_courses';

    public static $iklan_banner = 'iklan_banner';
}
