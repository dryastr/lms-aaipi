<?php

use App\Mixins\Financial\MultiCurrency;
use Illuminate\Support\Facades\Cookie;
use Intervention\Image\Facades\Image;

function getTemplate()
{
    /*$template = cache()->remember('view.template', 7 * 24 * 60 * 60, function () {
        return \App\Models\ViewTemplate::where('status', true)->first();
    });*/
    if (! empty($template) and $template->count() > 0) {
        return 'web.'.$template->folder;
    }

    return 'web.default';
}

function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2).' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2).' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2).' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes.' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes.' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
}

/**
 * @param  string  $format
 *
 * // Use this format everywhere : j:day , M:month, Y:year, H:hour, i:minute => {j M Y} or {j M Y H:i}
 * */
function dateTimeFormat($timestamp, $format = 'H:i', $useAdminSetting = true, $applyTimezone = true, $timezone = 'UTC')
{
    if ($applyTimezone) {
        $timezone = getTimezone();
    }

    if ($useAdminSetting) {
        $format = handleDateAndTimeFormat($format);
    }

    if (empty($timezone)) {
        $timezone = 'UTC';
    }

    $carbon = (new Carbon\Carbon())
        ->setTimezone($timezone)
        ->setTimestamp($timestamp);

    return $useAdminSetting ? $carbon->translatedFormat($format) : $carbon->format($format);
}

function dateTimeFormatForHumans($timestamp, $applyTimezone = true, $timezone = 'UTC', $parts = 3)
{
    if ($applyTimezone) {
        $timezone = getTimezone();
    }

    if (empty($timezone)) {
        $timezone = 'UTC';
    }

    $carbon = (new Carbon\Carbon())
        ->setTimezone($timezone)
        ->setTimestamp($timestamp);

    return $carbon->diffForHumans(null, null, false, $parts);
}

function getTimezone()
{
    $timezone = getGeneralSettings('default_time_zone');

    if (auth()->check()) {
        $user = auth()->user();

        if (! empty($user) and ! empty($user->timezone)) {
            $timezone = $user->timezone;
        }
    }

    return $timezone;
}

function handleDateAndTimeFormat($format)
{
    $dateFormat = getGeneralSettings('date_format') ?? 'textual';
    $timeFormat = getGeneralSettings('time_format') ?? '24_hours';

    if ($dateFormat == 'numerical') {
        $format = str_replace('M', 'm', $format);
        $format = str_replace('j ', 'j/', $format);
        $format = str_replace('m ', 'm/', $format);
    } else {
        $format = str_replace('m', 'M', $format);
    }

    if ($timeFormat == '12_hours') {
        $format = str_replace('H', 'h', $format);

        if (strpos($format, 'h')) {
            $format .= ' a';
        }
    } else {
        $format = str_replace('h', 'H', $format);
        $format = str_replace('a', '', $format);
    }

    return $format;
}

function diffTimestampDay($firstTime, $lastTime)
{
    return ($firstTime - $lastTime) / (24 * 60 * 60);
}

function convertMinutesToHourAndMinute($minutes)
{
    return intdiv($minutes, 60).':'.(str_pad($minutes % 60, 2, 0, STR_PAD_LEFT));
}

function getListOfTimezones()
{
    return DateTimeZone::listIdentifiers();
}

function toGmtOffset($timezone): string
{
    $userTimeZone = new DateTimeZone($timezone);
    $offset = $userTimeZone->getOffset(new DateTime('now', new DateTimeZone('GMT'))); // Offset in seconds
    $seconds = abs($offset);
    $sign = $offset > 0 ? '+' : '-';
    $hours = floor($seconds / 3600);
    $mins = floor($seconds / 60 % 60);
    $secs = floor($seconds % 60);

    return sprintf("GMT $sign%02d:%02d", $hours, $mins, $secs);
}

//this function convert string to UTC time zone
function convertTimeToUTCzone($str, $userTimezone, $format = false)
{
    if (empty($userTimezone)) {
        $userTimezone = getTimezone();
    }

    $new_str = new DateTime($str, new DateTimeZone($userTimezone));

    $new_str->setTimeZone(new DateTimeZone('UTC'));

    if ($format) {
        return $new_str->format('Y-m-d H:i');
    }

    return $new_str;
}

function x_week_range()
{
    $start = strtotime(date('Y-m-d', strtotime('last Saturday')));

    return [
        $start,
        strtotime(date('Y-m-d', strtotime('next Friday', $start))),
    ];
}

function getTimeByDay($title)
{
    $start = date('Y-m-d', strtotime('last Saturday'));
    $time = 0;
    switch ($title) {
        case 'saturday':
            $time = strtotime(date('Y-m-d', strtotime($start)));
            break;
        case 'sunday':
            $time = strtotime(date('Y-m-d', strtotime($start.'+1 days')));
            break;
        case 'monday':
            $time = strtotime(date('Y-m-d', strtotime($start.'+2 days')));
            break;
        case 'tuesday':
            $time = strtotime(date('Y-m-d', strtotime($start.'+3 days')));
            break;
        case 'wednesday':
            $time = strtotime(date('Y-m-d', strtotime($start.'+4 days')));
            break;
        case 'thursday':
            $time = strtotime(date('Y-m-d', strtotime($start.'+5 days')));
            break;
        case 'friday':
            $time = strtotime(date('Y-m-d', strtotime($start.'+6 days')));
            break;
    }

    return $time;
}

function convertDayToNumber($times)
{
    $numbers = [
        'sunday' => 1,
        'monday' => 2,
        'tuesday' => 3,
        'wednesday' => 4,
        'thursday' => 5,
        'friday' => 6,
        'saturday' => 7,
    ];

    $numberDay = [];

    foreach ($times as $day => $time) {
        $numberDay[] = $numbers[$day];
    }

    return $numberDay;
}

function getBindedSQL($query)
{
    $fullQuery = $query->toSql();
    $replaces = $query->getBindings();
    foreach ($replaces as $replace) {
        $fullQuery = Str::replaceFirst('?', $replace, $fullQuery);
    }

    return $fullQuery;
}

function getUserLanguagesLists()
{
    $generalSettings = getGeneralSettings();
    $userLanguages = ($generalSettings and ! empty($generalSettings['user_languages'])) ? $generalSettings['user_languages'] : null;

    if (! empty($userLanguages) and is_array($userLanguages)) {
        $userLanguages = getLanguages($userLanguages);
    } else {
        $userLanguages = [];
    }

    if (count($userLanguages) > 0) {
        foreach ($userLanguages as $locale => $language) {
            if (mb_strtolower($locale) == mb_strtolower(app()->getLocale())) {
                $firstKey = array_key_first($userLanguages);

                if ($firstKey != $locale) {
                    $firstValue = $userLanguages[$firstKey];

                    unset($userLanguages[$locale]);
                    unset($userLanguages[$firstKey]);

                    $userLanguages = array_merge([
                        $locale => $language,
                        $firstKey => $firstValue,
                    ], $userLanguages);
                }
            }
        }
    }

    return $userLanguages;
}

function getLanguages($lang = null)
{
    $languages = [
        'AA' => 'Afar',
        'AF' => 'Afrikanns',
        'SQ' => 'Albanian',
        'AM' => 'Amharic',
        'AR' => 'Arabic',
        'HY' => 'Armenian',
        'AY' => 'Aymara',
        'AZ' => 'Azerbaijani',
        'EU' => 'Basque',
        'DZ' => 'Bhutani',
        'BH' => 'Bihari',
        'BI' => 'Bislama',
        'BR' => 'Breton',
        'BG' => 'Bulgarian',
        'MY' => 'Burmese',
        'BE' => 'Byelorussian',
        'BN' => 'Bangla',
        'KM' => 'Cambodian',
        'CA' => 'Catalan',
        'ZH' => 'Chinese',
        'HR' => 'Croation',
        'CS' => 'Czech',
        'DA' => 'Danish',
        'NL' => 'Dutch',
        'EN' => 'English',
        'ET' => 'Estonian',
        'FO' => 'Faeroese',
        'FJ' => 'Fiji',
        'FI' => 'Finnish',
        'FR' => 'French',
        'KA' => 'Georgian',
        'DE' => 'German',
        'EL' => 'Greek',
        'KL' => 'Greenlandic',
        'GN' => 'Guarani',
        'HI' => 'Hindi',
        'HU' => 'Hungarian',
        'IS' => 'Icelandic',
        'ID' => 'Indonesian',
        'IT' => 'Italian',
        'JA' => 'Japanese',
        'KK' => 'Kazakh',
        'RW' => 'Kinyarwanda',
        'KY' => 'Kirghiz',
        'KO' => 'Korean',
        'KU' => 'Kurdish',
        'LO' => 'Laothian',
        'LA' => 'Latin',
        'LV' => 'Latvian',
        'LT' => 'Lithuanian',
        'MK' => 'Macedonian',
        'MG' => 'Malagasy',
        'MS' => 'Malay',
        'MT' => 'Maltese',
        'MI' => 'Maori',
        'MN' => 'Mongolian',
        'NA' => 'Nauru',
        'NE' => 'Nepali',
        'NO' => 'Norwegian',
        'OM' => 'Oromo',
        'PS' => 'Pashto',
        'FA' => 'Persian',
        'PL' => 'Polish',
        'PT' => 'Portuguese',
        'QU' => 'Quechua',
        'RM' => 'Rhaeto',
        'RO' => 'Romanian',
        'RU' => 'Russian',
        'SM' => 'Samoan',
        'SG' => 'Sangro',
        'SR' => 'Serbian',
        'TN' => 'Setswana',
        'SN' => 'Shona',
        'SI' => 'Singhalese',
        'SS' => 'Siswati',
        'SK' => 'Slovak',
        'SL' => 'Slovenian',
        'SO' => 'Somali',
        'ES' => 'Spanish',
        'SV' => 'Swedish',
        'TL' => 'Tagalog',
        'TG' => 'Tajik',
        'TA' => 'Tamil',
        'TH' => 'Thai',
        'TI' => 'Tigrinya',
        'TR' => 'Turkish',
        'TK' => 'Turkmen',
        'TW' => 'Twi',
        'UK' => 'Ukranian',
        'UR' => 'Urdu',
        'UZ' => 'Uzbek',
        'VI' => 'Vietnamese',
        'XH' => 'Xhosa',
    ];

    if (! empty($lang) and is_array($lang)) {
        return array_flip(array_intersect(array_flip($languages), $lang));
    } elseif (! empty($lang)) {
        return $languages[$lang];
    }

    return $languages;
}

function localeToCountryCode($code, $revers = false)
{
    $languages = [
        'AA' => 'DJ', // language code => country code
        'AF' => 'ZA',
        'SQ' => 'AL',
        'AM' => 'ET',
        'AR' => 'IQ',
        'HY' => 'AM',
        'AY' => 'BO',
        'AZ' => 'AZ',
        'EU' => 'ES',
        'BN' => 'BD',
        'DZ' => 'BT',
        'BI' => 'VU',
        'BG' => 'BG',
        'MY' => 'MM',
        'BE' => 'BY',
        'KM' => 'KH',
        'CA' => 'ES',
        'ZH' => 'CN',
        'HR' => 'HR',
        'CS' => 'CZ',
        'DA' => 'DK',
        'NL' => 'NL',
        'EN' => 'US',
        'ET' => 'EE',
        'FO' => 'FO',
        'FJ' => 'FJ',
        'FI' => 'FI',
        'FR' => 'FR',
        'KA' => 'GE',
        'DE' => 'DE',
        'EL' => 'GR',
        'KL' => 'GL',
        'GN' => 'GN',
        'HI' => 'IN',
        'HU' => 'HU',
        'IS' => 'IS',
        'ID' => 'ID',
        'IT' => 'IT',
        'JA' => 'JP',
        'KK' => 'KZ',
        'RW' => 'RW',
        'KY' => 'KG',
        'KO' => 'KR',
        'LO' => 'LA',
        'LA' => 'RS',
        'LV' => 'LV',
        'LT' => 'LT',
        'MK' => 'MK',
        'MG' => 'MG',
        'MS' => 'MS',
        'MT' => 'MT',
        'MI' => 'NZ',
        'MN' => 'MN',
        'NA' => 'NR',
        'NE' => 'NP',
        'NO' => 'NO',
        'OM' => 'ET',
        'PS' => 'AF',
        'FA' => 'IR',
        'PL' => 'PL',
        'PT' => 'PT',
        'QU' => 'BO',
        'RM' => 'CH',
        'RO' => 'RO',
        'RU' => 'RU',
        'SM' => 'WS',
        'SG' => 'CG',
        'SR' => 'SR',
        'TN' => 'BW',
        'SN' => 'ZW',
        'SI' => 'LK',
        'SS' => 'SZ',
        'SK' => 'SK',
        'SL' => 'SI',
        'SO' => 'SO',
        'ES' => 'ES',
        'SV' => 'SE',
        'TL' => 'PH',
        'TG' => 'TJ',
        'TA' => 'LK',
        'TH' => 'TH',
        'TI' => 'ER',
        'TR' => 'TR',
        'TK' => 'TM',
        'TW' => 'TW',
        'UK' => 'UA',
        'UR' => 'PK',
        'UZ' => 'UZ',
        'VI' => 'VN',
        'XH' => 'ZA',
        'KU' => 'KU',
    ];

    if ($revers) {
        $languages = array_flip($languages);

        return ! empty($languages[$code]) ? $languages[$code] : '';
    }

    return ! empty($languages[$code]) ? $languages[$code] : '';
}

function getMoneyUnits($unit = null)
{
    $units = [
        'IDR' => 'Indonesia Rupiah',
    ];

    if (! empty($unit)) {
        return $units[$unit];
    }

    return $units;
}

function currenciesLists($sing = null)
{
    $lists = [
        'IDR' => 'Indonesia Rupiah',
    ];

    if (! empty($sing)) {
        return $lists[$sing] ?? 'Indonesia Rupiah';
    }

    return $lists;
}

function currency($user = null)
{
    if (empty($user)) {
        $user = auth()->user();
    }

    if (! empty($user) and ! empty($user->currency)) {
        return $user->currency;
    } elseif (empty($user)) {
        $checkCookie = Cookie::get('user_currency');

        if (! empty($checkCookie)) {
            return $checkCookie;
        }
    }

    return getDefaultCurrency();
}

function getDefaultCurrency()
{
    return getFinancialCurrencySettings('currency') ?? 'USD';
}

function currencySign($currency = null)
{
    if (empty($currency)) {
        $currency = currency();
    }

    switch ($currency) {
        case 'IDR':
            return 'Rp';
            break;
        default:
            return 'Rp';
    }

    return '$';
}

function getCountriesMobileCode()
{
    return [
        'Indonesia (+62)' => '+62',
    ];
}

// Truncate a string only at a whitespace
function truncate($text, $length, $withTail = true)
{
    $length = abs((int) $length);
    if (strlen($text) > $length) {
        $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", ($withTail ? '\\1 ...' : '\\1'), $text);
    }

    return $text;
}

/**
 * @param  null  $page  => Setting::$pagesSeoMetas
 * @return array [title, description]
 */
function getSeoMetas($page = null)
{
    return App\Models\Setting::getSeoMetas($page);
}

/**
 * @return array [title, image, link]
 */
function getSocials()
{
    return App\Models\Setting::getSocials();
}

/**
 * @return array [title, items => [title, link]]
 */
function getFooterColumns()
{
    return App\Models\Setting::getFooterColumns();
}

/*
 * @return array [site_name, site_email, site_phone, site_language, register_method, user_languages, rtl_languages, fav_icon, locale, logo, footer_logo, rtl_layout, home hero1 is active, home hero2 is active, content_translate, default_time_zone, date_format, time_format]
 */
function getGeneralSettings($key = null)
{
    return App\Models\Setting::getGeneralSettings($key);
}
function getMemberUrl($key = null)
{
    return App\Models\Setting::getMemberUrl($key);
}

/**
 * @param  null  $key
 *                     $key => "agora_resolution" | "agora_max_bitrate" | "agora_min_bitrate" | "agora_frame_rate" | "agora_live_streaming" | "agora_chat" | "agora_cloud_rec" | "agora_in_free_courses"
 *                     "new_interactive_file" | "timezone_in_register" | "timezone_in_create_webinar"
 *                     "sequence_content_status" | "webinar_assignment_status" | "webinar_private_content_status" | "disable_view_content_after_user_register"
 *                     "direct_classes_payment_button_status" | "mobile_app_status" | "cookie_settings_status" | "show_other_register_method" | "show_certificate_additional_in_register"
 * */
function getFeaturesSettings($key = null)
{
    return App\Models\Setting::getFeaturesSettings($key);
}

/**
 * @param  null  $key
 *                     $key => cookie_settings_modal_message | cookie_settings_modal_items
 * */
function getCookieSettings($key = null)
{
    return App\Models\Setting::getCookieSettings($key);
}

/**
 * @return array|[commission, tax, minimum_payout, currency, currency_position, price_display]
 */
function getFinancialSettings($key = null)
{
    return App\Models\Setting::getFinancialSettings($key);
}

function getFinancialCurrencySettings($key = null)
{
    return App\Models\Setting::getFinancialCurrencySettings($key);
}

/**
 * @param  string  $section  => 2 for hero section 2
 * @return array|[title, description, hero_background]
 */
function getHomeHeroSettings($section = '1')
{
    return App\Models\Setting::getHomeHeroSettings($section);
}

/**
 * @return array|[title, description, background]
 */
function getHomeVideoOrImageBoxSettings()
{
    return App\Models\Setting::getHomeVideoOrImageBoxSettings();
}

/**
 * @param  null  $page  => admin_login, admin_dashboard, login, register, remember_pass, search, categories,
 *                      become_instructor, certificate_validation, blog, instructors
 *                      ,dashboard, panel_sidebar, user_avatar, user_cover, instructor_finder_wizard, products_lists
 * @return string|array => [all pages]
 */
function getPageBackgroundSettings($page = null)
{
    return App\Models\Setting::getPageBackgroundSettings($page);
}

/**
 * @param  null  $key  => css, js
 * @return string|array => {css, js}
 */
function getCustomCssAndJs($key = null)
{
    return App\Models\Setting::getCustomCssAndJs($key);
}

/**
 * @return array
 */
function getOfflineBankSettings($key = null)
{
    return App\Models\Setting::getOfflineBankSettings($key);
}

/**
 * @return array [status, users_affiliate_status, affiliate_user_commission, affiliate_user_amount, referred_user_amount, referral_description]
 */
function getReferralSettings()
{
    $settings = App\Models\Setting::getReferralSettings();

    if (empty($settings['status'])) {
        $settings['status'] = false;
    } else {
        $settings['status'] = true;
    }

    if (empty($settings['users_affiliate_status'])) {
        $settings['users_affiliate_status'] = false;
    } else {
        $settings['users_affiliate_status'] = true;
    }

    if (empty($settings['affiliate_user_commission'])) {
        $settings['affiliate_user_commission'] = 0;
    }

    if (empty($settings['affiliate_user_amount'])) {
        $settings['affiliate_user_amount'] = 0;
    }

    if (empty($settings['referred_user_amount'])) {
        $settings['referred_user_amount'] = 0;
    }

    if (empty($settings['referral_description'])) {
        $settings['referral_description'] = '';
    }

    return $settings;
}

/**
 * @return array
 */
function getOfflineBanksTitle()
{
    $titles = [];

    $banks = getOfflineBankSettings();

    if (! empty($banks) and count($banks)) {
        foreach ($banks as $bank) {
            // $titles[] = $bank->title;
        }
    }

    return $titles;
}

/**
 * @return array
 */
function getReportReasons()
{
    return App\Models\Setting::getReportReasons();
}

/**
 * @param  $template  {String|nullable}
 * @return array
 */
function getNotificationTemplates($template = null)
{
    return App\Models\Setting::getNotificationTemplates($template);
}

/**
 * @return array
 */
function getContactPageSettings($key = null)
{
    return App\Models\Setting::getContactPageSettings($key);
}

/**
 * @return array
 */
function get404ErrorPageSettings($key = null)
{
    return App\Models\Setting::get404ErrorPageSettings($key);
}

/**
 * @return array
 */
function getHomeSectionsSettings($key = null)
{
    return App\Models\Setting::getHomeSectionsSettings($key);
}

/**
 * @param  $key
 * @return array
 */
function getNavbarLinks()
{
    $links = App\Models\Setting::getNavbarLinksSettings();

    if (! empty($links)) {
        usort($links, function ($item1, $item2) {
            return $item1['order'] <=> $item2['order'];
        });
    }

    return $links;
}

/**
 * @return array
 */
function getPanelSidebarSettings()
{
    return App\Models\Setting::getPanelSidebarSettings();
}

/**
 * @return array
 */
function getFindInstructorsSettings()
{
    return App\Models\Setting::getFindInstructorsSettings();
}

/**
 * @return array
 */
function getRewardProgramSettings()
{
    return App\Models\Setting::getRewardProgramSettings();
}

/**
 * @return array
 */
function getRewardsSettings()
{
    return App\Models\Setting::getRewardsSettings();
}

/**
 * @param  $kay  => [status, virtual_product_commission, physical_product_commission, store_tax,
 *              possibility_create_virtual_product, possibility_create_physical_product,
 *              shipping_tracking_url, activate_comments
 *              ]
 */
function getStoreSettings($key = null)
{
    return App\Models\Setting::getStoreSettings($key);
}

function getBecomeInstructorSectionSettings()
{
    return App\Models\Setting::getBecomeInstructorSectionSettings();
}

function getForumSectionSettings()
{
    return App\Models\Setting::getForumSectionSettings();
}

function getRegistrationPackagesGeneralSettings($key = null)
{
    return App\Models\Setting::getRegistrationPackagesGeneralSettings($key);
}

function getRegistrationPackagesInstructorsSettings($key = null)
{
    return App\Models\Setting::getRegistrationPackagesInstructorsSettings($key);
}

function getRegistrationPackagesOrganizationsSettings($key = null)
{
    return App\Models\Setting::getRegistrationPackagesOrganizationsSettings($key);
}

function getMobileAppSettings($key = null)
{
    return App\Models\Setting::getMobileAppSettings($key);
}

function getMaintenanceSettings($key = null)
{
    return App\Models\Setting::getMaintenanceSettings($key);
}

function getGeneralOptionsSettings($key = null)
{
    return App\Models\Setting::getGeneralOptionsSettings($key);
}

function getGiftsGeneralSettings($key = null)
{
    return App\Models\Setting::getGiftsGeneralSettings($key);
}

function getRemindersSettings($key = null)
{
    return App\Models\Setting::getRemindersSettings($key);
}

function getGeneralSecuritySettings($key = null)
{
    return App\Models\Setting::getGeneralSecuritySettings($key);
}

function getAdminPanelUrlPrefix()
{
    $prefix = getGeneralSecuritySettings('admin_panel_url');

    return ! empty($prefix) ? $prefix : 'admin';
}

function getAdminPanelUrl($url = null, $withFirstSlash = true)
{
    return ($withFirstSlash ? '/' : '').getAdminPanelUrlPrefix().($url ?? '');
}

function getAdvertisingModalSettings()
{
    $cookieKey = 'show_advertise_modal';
    $settings = App\Models\Setting::getAdvertisingModalSettings();

    $show = false;

    if (! empty($settings) and ! empty($settings['status']) and $settings['status'] == 1) {
        $checkCookie = Cookie::get($cookieKey);

        if (empty($checkCookie)) {
            $show = true;

            Cookie::queue($cookieKey, 1, 30 * 24 * 60);
        }
    }

    return $show ? $settings : null;
}

function getOthersPersonalizationSettings($key = null)
{
    return \App\Models\Setting::getOthersPersonalizationSettings($key);
}

function getInstallmentsSettings($key = null)
{
    return \App\Models\Setting::getInstallmentsSettings($key);
}

function getInstallmentsTermsSettings($key = null)
{
    return \App\Models\Setting::getInstallmentsTermsSettings($key);
}

function getRegistrationBonusSettings($key = null)
{
    return \App\Models\Setting::getRegistrationBonusSettings($key);
}

function getRegistrationBonusTermsSettings($key = null)
{
    return \App\Models\Setting::getRegistrationBonusTermsSettings($key);
}

function getStatisticsSettings($key = null)
{
    return \App\Models\Setting::getStatisticsSettings($key);
}

/**
 * @return string ("primary_color"|"secondary_color") || null
 * */
function getThemeColorsSettings($admin = false)
{
    $settings = App\Models\Setting::getThemeColorsSettings();

    $result = '';

    if (! empty($settings) and count($settings)) {
        $result = ':root{'.PHP_EOL;

        if ($admin) {
            foreach (\App\Models\Setting::$rootAdminColors as $color) {
                if (! empty($settings['admin_'.$color])) {
                    $result .= "--$color:".$settings['admin_'.$color].';'.PHP_EOL;
                }
            }
        } else {
            foreach (\App\Models\Setting::$rootColors as $color) {
                if (! empty($settings[$color])) {
                    $result .= "--$color:".$settings[$color].';'.PHP_EOL;
                }
            }
        }

        $result .= '}'.PHP_EOL;
    }

    return $result;
}

/**
 * @return string ("primary_color"|"secondary_color") || null
 * */
function getThemeFontsSettings()
{
    $settings = App\Models\Setting::getThemeFontsSettings();

    $result = '';

    if (! empty($settings) and count($settings)) {

        foreach ($settings as $type => $setting) {

            if (! empty($settings[$type]['regular'])) {
                $result .= "@font-face {
                      font-family: '$type-font-family';
                      font-style: normal;
                      font-weight: 400;
                      font-display: swap;
                      src: url({$settings[$type]['regular']}) format('woff2');
                    }";
            }

            if (! empty($settings[$type]['bold'])) {
                $result .= "@font-face {
                      font-family: '$type-font-family';
                      font-style: normal;
                      font-weight: bold;
                      font-display: swap;
                      src: url({$settings[$type]['bold']}) format('woff2');
                    }";
            }

            if (! empty($settings[$type]['medium'])) {
                $result .= "@font-face {
                      font-family: '$type-font-family';
                      font-style: normal;
                      font-weight: 500;
                      font-display: swap;
                      src: url({$settings[$type]['medium']}) format('woff2');
                    }";
            }

        }
    }

    return $result;
}

/**
 * @param  $page  => home, search, classes, categories, login, register, contact, blog, certificate_validation, 'instructors', 'organizations'
 * @return string
 * */
function getPageRobot($page)
{
    $seoSettings = getSeoMetas($page);

    return (empty($seoSettings['robot']) or $seoSettings['robot'] != 'noindex') ? 'index, follow, all' : 'NOODP, nofollow, noindex';
}

function getPageRobotNoIndex()
{
    return 'NOODP, nofollow, noindex';
}

function getDefaultLocale()
{
    $key = 'site_language';
    $name = \App\Models\Setting::$generalName;

    /// I did not use the helper method because the Setting model uses translation and may get stuck in the loop.

    $setting = cache()->remember('settings.getDefaultLocale', 24 * 60 * 60, function () use ($name) {
        $setting = \Illuminate\Support\Facades\DB::table('settings')
            ->where('page', $name)
            ->where('name', $name)
            ->join('setting_translations', 'settings.id', '=', 'setting_translations.setting_id')
            ->select('settings.*', 'setting_translations.value')
            ->first();

        $value = [];

        if (! empty($setting) and ! empty($setting->value) and isset($setting->value)) {
            $value = json_decode($setting->value, true);
        }

        return $value;
    });

    $siteLanguage = 'EN';

    if (! empty($setting)) {
        if (! empty($setting[$key])) {
            $siteLanguage = $setting[$key];
        }
    }

    return $siteLanguage;
}

function deepClone($object)
{
    $cloned = clone $object;
    foreach ($cloned as $key => $val) {
        if (is_object($val) || (is_array($val))) {
            $cloned->{$key} = unserialize(serialize($val));
        }
    }

    return $cloned;
}

function sendNotification($template, $options, $user_id = null, $group_id = null, $sender = 'system', $type = 'single')
{
    $templateId = getNotificationTemplates($template);
    $notificationTemplate = \App\Models\NotificationTemplate::where('id', $templateId)->first();

    if (! empty($notificationTemplate)) {
        $title = str_replace(array_keys($options), array_values($options), $notificationTemplate->title);
        $message = str_replace(array_keys($options), array_values($options), $notificationTemplate->template);

        $check = \App\Models\Notification::where('user_id', $user_id)
            ->where('group_id', $group_id)
            ->where('title', $title)
            ->where('message', $message)
            ->where('sender', $sender)
            ->where('type', $type)
            ->first();

        $ignoreDuplicateTemplates = ['new_badge', 'registration_package_expired'];

        if (empty($check) or ! in_array($template, $ignoreDuplicateTemplates)) {
            \App\Models\Notification::create([
                'user_id' => $user_id,
                'group_id' => $group_id,
                'title' => $title,
                'message' => $message,
                'sender' => $sender,
                'type' => $type,
                'created_at' => time(),
            ]);

            if (env('APP_ENV') == 'production') {
                $user = \App\User::where('id', $user_id)->first();
                if (! empty($user) and ! empty($user->email)) {
                    \App\Jobs\SendEmail::dispatch($user->email, ['title' => $title, 'message' => $message]);
                    // try {
                    //     \Mail::to($user->email)->send(new \App\Mail\SendNotifications(['title' => $title, 'message' => $message]));
                    // } catch (Exception $exception) {
                    //     // dd($exception)
                    // }
                }
            }
        }

        return true;
    }

    return false;
}

function sendNotificationToEmail($template, $options, $email)
{
    $templateId = getNotificationTemplates($template);
    $notificationTemplate = \App\Models\NotificationTemplate::where('id', $templateId)->first();

    if (! empty($notificationTemplate)) {
        $title = str_replace(array_keys($options), array_values($options), $notificationTemplate->title);
        $message = str_replace(array_keys($options), array_values($options), $notificationTemplate->template);

        if (env('APP_ENV') == 'production') {
            \App\Jobs\SendEmail::dispatch($email, ['title' => $title, 'message' => $message]);
            // try {
            //     \Mail::to($email)->send(new \App\Mail\SendNotifications(['title' => $title, 'message' => $message]));
            // } catch (Exception $exception) {
            //     // dd($exception)
            // }
        }

        return true;
    }

    return false;
}

function time2string($time)
{
    $_d = 0;
    $_h = 0;
    $_m = 0;
    $_s = 1;

    if ($time > 0) {
        $d = floor($time / 86400);
        $_d = ($d < 10 ? '0' : '').$d;

        $h = floor(($time - $d * 86400) / 3600);
        $_h = ($h < 10 ? '0' : '').$h;

        $m = floor(($time - ($d * 86400 + $h * 3600)) / 60);
        $_m = ($m < 10 ? '0' : '').$m;

        $s = $time - ($d * 86400 + $h * 3600 + $m * 60);
        $_s = ($s < 10 ? '0' : '').$s;
    }

    return [
        'day' => $_d,
        'hour' => $_h,
        'minute' => $_m,
        'second' => $_s,
    ];
}

$months = [
    1 => 'Jan.',
    2 => 'Feb.',
    3 => 'Mar.',
    4 => 'Apr.',
    5 => 'May',
    6 => 'Jun.',
    7 => 'Jul.',
    8 => 'Aug.',
    9 => 'Sep.',
    10 => 'Oct.',
    11 => 'Nov.',
    12 => 'Dec.',
];

function fromAndToDateFilter($from, $to, $query, $column = 'created_at', $strToTime = true)
{
    if (! empty($from) and ! empty($to)) {
        $from = $strToTime ? strtotime($from) : $from;
        $to = $strToTime ? strtotime($to) : $to;

        $query->whereBetween($column, [$from, $to]);
    } else {
        if (! empty($from)) {
            $from = $strToTime ? strtotime($from) : $from;

            $query->where($column, '>=', $from);
        }

        if (! empty($to)) {
            $to = $strToTime ? strtotime($to) : $to;

            $query->where($column, '<', $to);
        }
    }

    return $query;
}

function random_str($length, $includeNumeric = true, $includeChar = true)
{
    $keyspace = ($includeNumeric ? '0123456789' : '').($includeChar ? 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' : '');
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;

    for ($i = 0; $i < $length; $i++) {
        $str .= $keyspace[rand(0, $max)];
    }

    return ($includeNumeric and ! $includeChar) ? (int) $str : $str;
}

function checkCourseForSale($course, $user)
{
    if (! $course->canSale()) {
        $toastData = [
            'title' => trans('public.request_failed'),
            'msg' => trans('cart.course_not_capacity'),
            'status' => 'error',
        ];

        return back()->with(['toast' => $toastData]);
    }

    if ($course->checkUserHasBought($user)) {
        $toastData = [
            'title' => trans('cart.fail_purchase'),
            'msg' => trans('site.you_bought_webinar'),
            'status' => 'error',
        ];

        return back()->with(['toast' => $toastData]);
    }

    if ($course->creator_id == $user->id or $course->teacher_id == $user->id) {
        $toastData = [
            'title' => trans('public.request_failed'),
            'msg' => trans('cart.cant_purchase_your_course'),
            'status' => 'error',
        ];

        return back()->with(['toast' => $toastData]);
    }

    $isRequiredPrerequisite = false;
    if (! empty($course->prerequisites)) {
        $prerequisites = $course->prerequisites;
        if (count($prerequisites)) {
            foreach ($prerequisites as $prerequisite) {
                $prerequisiteWebinar = $prerequisite->prerequisiteWebinar;

                if ($prerequisite->required and ! empty($prerequisiteWebinar) and ! $prerequisiteWebinar->checkUserHasBought()) {
                    $isRequiredPrerequisite = true;
                }
            }
        }
    }

    if ($isRequiredPrerequisite) {
        $toastData = [
            'title' => trans('public.request_failed'),
            'msg' => trans('cart.this_course_has_required_prerequisite'),
            'status' => 'error',
        ];

        return back()->with(['toast' => $toastData]);
    }

    return 'ok';
}

function checkProductForSale($product, $user)
{
    if ($product->getAvailability() < 1) {
        $toastData = [
            'title' => trans('public.request_failed'),
            'msg' => trans('update.product_not_availability'),
            'status' => 'error',
        ];

        return back()->with(['toast' => $toastData]);
    }

    if ($product->creator_id == $user->id) {
        $toastData = [
            'title' => trans('public.request_failed'),
            'msg' => trans('update.cant_purchase_your_product'),
            'status' => 'error',
        ];

        return back()->with(['toast' => $toastData]);
    }

    return 'ok';
}

function isAdminUrl($url = null)
{
    if (empty($url)) {
        $url = request()->getPathInfo();
    }

    return strpos($url, 'admin') === 1;
}

function getTranslateAttributeValue($model, $key, $loca = null)
{
    $isAdminUrl = isAdminUrl();

    $locale = app()->getLocale();
    $contentLocale = $isAdminUrl ? getContentLocale() : null; // for admin edit contents

    $isEditModel = ($isAdminUrl and ! empty($contentLocale) and is_array($contentLocale) and $contentLocale['table'] == $model->getTable() and $contentLocale['item_id'] == $model->id);

    if ($isAdminUrl and
        ! empty($contentLocale) and
        is_array($contentLocale) and
        (
            ($contentLocale['table'] == $model->getTable() and $contentLocale['item_id'] == $model->id) or
            (
                (! empty($model->parent_id) and $contentLocale['item_id'] == $model->parent_id) or // for category edit page
                (! empty($model->filter_id) and $contentLocale['item_id'] == $model->filter_id) // for filter edit page
            )
        )
    ) {
        $locale = $contentLocale['locale']; // for admin edit contents
    }

    try {
        $locale = ! empty($loca) ? $loca : $locale;

        if ($model->getTable() === 'settings' and in_array($model->name, \App\Models\Setting::getSettingsWithDefaultLocal())) {
            $locale = \App\Models\Setting::$defaultSettingsLocale;
        }

        $model->locale = $locale;

        return $model->translate(mb_strtolower($locale))->{$key};
    } catch (\Exception $e) {
        // this conditions get client side

        if (empty($contentLocale) and empty($loca)) { //  first get translate by site default language
            $defaultLocale = getDefaultLocale();

            return getTranslateAttributeValue($model, $key, $defaultLocale);
        } elseif ((! empty($loca) or ! $isEditModel) and $loca != 'en' and ! empty($model->translations) and count($model->translations)) { // if not translate by site default language get translate by English language
            return getTranslateAttributeValue($model, $key, 'en');
        } elseif ((! empty($loca) or ! $isEditModel) and ! empty($model->translations) and count($model->translations)) { // if not default and English get translate by first locale
            $translations = $model->translations->first();

            return getTranslateAttributeValue($model, $key, $translations->locale);
        }

        return '';
    }
}

function getContentLocale()
{
    return session()->get('edit_content_locale', null);
}

function storeContentLocale($locale, $table, $item_id)
{
    removeContentLocale();

    $data = [
        'locale' => $locale,
        'table' => $table,
        'item_id' => $item_id,
    ];

    session()->put('edit_content_locale', $data);
}

function removeContentLocale()
{
    session()->remove('edit_content_locale');
}

function getAgoraResolutions(): array
{
    return [
        '160_120', '120_120', '320_180', '180_180', '240_180', '320_240', '240_240', '424_240', '640_360', '360_360',
        '640_360', '360_360', '480_360', '480_360', '640_480', '480_480', '640_480', '480_480', '848_480', '848_480',
        '640_480', '1280_720', '1280_720', '960_720', '960_720', '1920_1080', '1920_1080', '1920_1080',
    ];
}

function getUserCurrencyItem($user = null, $userCurrency = null)
{
    $multiCurrency = new MultiCurrency();
    $currencies = $multiCurrency->getCurrencies();

    if (empty($userCurrency)) {
        $userCurrency = currency($user);
    }

    foreach ($currencies as $currencyItem) {
        if ($currencyItem->currency == $userCurrency) {
            return $currencyItem;
        }
    }

    return $multiCurrency->getDefaultCurrency();
}

function curformat($amount)
{
    // (A1) SPLIT WHOLE & DECIMALS
    $amount = explode('.', $amount);
    $whole = $amount[0];
    $decimal = isset($amount[1]) ? $amount[1] : '';

    // (A2) ADD THOUSAND SEPARATORS
    if (strlen($whole) > 3) {
        $temp = '';
        $j = 0;
        for ($i = strlen($whole) - 1; $i >= 0; $i--) {
            $temp = $whole[$i].$temp;
            $j++;
            if ($j % 3 == 0 && $i != 0) {
                $temp = ','.$temp;
            }
        }
        $whole = $temp;
    }

    // (A3) RESULT
    return "\$$whole.$decimal";
}

function handlePriceFormat($price, $decimals = 0, $decimal_separator = '.', $thousands_separator = '')
{
    if (is_numeric($price) and $price > 0) {
        $format = number_format($price, $decimals, $decimal_separator, $thousands_separator);

        $str = "{$decimal_separator}";
        $i = 0;
        while ($i < $decimals) {
            $i += 1;
            $str .= '0';
        }

        return str_replace($str, '', $format);
    } elseif (is_array($price)) {
        return implode(', ', $price);
    }

    return $price;
}

function handlePrice($price, $showCurrency = true, $format = true, $coursePagePrice = false, $user = null, $showTaxInPrice = false, $taxType = 'general')
{
    $userCurrencyItem = getUserCurrencyItem($user);
    $priceDisplay = getFinancialSettings('price_display') ?? 'only_price';

    $decimal = $userCurrencyItem->currency_decimal ?? 1;
    $decimalSeparator = $userCurrencyItem->currency_separator == 'dot' ? '.' : ',';
    $thousandsSeparator = $userCurrencyItem->currency_separator == 'dot' ? ',' : '.';

    $price = convertPriceToUserCurrency($price, $userCurrencyItem);

    if ($priceDisplay != 'only_price') {
        $tax = getFinancialSettings('tax') ?? 0;

        if ($taxType == 'store') {
            $storeTax = getStoreSettings('store_tax');

            if (isset($storeTax) and is_numeric($storeTax)) {
                $tax = $storeTax;
            }
        }

        $tax = convertPriceToUserCurrency($tax, $userCurrencyItem);

        if ($tax > 0) {
            $taxPrice = $price * $tax / 100;

            if ($priceDisplay == 'total_price') {

                if ($showTaxInPrice) {
                    $price = $price + $taxPrice;
                }

                if ($format) {
                    $price = handlePriceFormat($price, $decimal, $decimalSeparator, $thousandsSeparator);
                }
            } elseif ($priceDisplay == 'price_and_tax') {
                if ($coursePagePrice) {
                    return [
                        'price' => $price,
                        'tax' => $taxPrice,
                    ];
                }

                if ($format) {
                    $price = handlePriceFormat($price, $decimal, $decimalSeparator, $thousandsSeparator);
                    $taxPrice = handlePriceFormat($taxPrice, $decimal, $decimalSeparator, $thousandsSeparator);
                }

                if ($showCurrency) {
                    $price = addCurrencyToPrice($price, $userCurrencyItem);
                    $taxPrice = addCurrencyToPrice($taxPrice, $userCurrencyItem);
                }

                $price = $price.($showTaxInPrice ? ('+'.$taxPrice.' '.trans('cart.tax')) : '');
            }
        }
    } elseif ($format) {
        $price = handlePriceFormat($price, $decimal, $decimalSeparator, $thousandsSeparator);
    }

    if ($coursePagePrice) {
        return [
            'price' => $price,
            'tax' => 0,
        ];
    }

    if ($showCurrency and $priceDisplay != 'price_and_tax') {
        $price = addCurrencyToPrice($price, $userCurrencyItem);
    }

    return $price;
}

function handlePriceGuest($priceGuest , $showCurrency = true, $format = true, $coursePagePrice = false, $user = null, $showTaxInPrice = false, $taxType = 'general')
{
    $userCurrencyItem = getUserCurrencyItem($user);
    $priceDisplay = getFinancialSettings('price_display') ?? 'only_price';

    $decimal = $userCurrencyItem->currency_decimal ?? 1;
    $decimalSeparator = $userCurrencyItem->currency_separator == 'dot' ? '.' : ',';
    $thousandsSeparator = $userCurrencyItem->currency_separator == 'dot' ? ',' : '.';

    $priceGuest = convertPriceToUserCurrency($priceGuest, $userCurrencyItem);

    if ($priceDisplay != 'only_price') {
        $tax = getFinancialSettings('tax') ?? 0;

        if ($taxType == 'store') {
            $storeTax = getStoreSettings('store_tax');

            if (isset($storeTax) and is_numeric($storeTax)) {
                $tax = $storeTax;
            }
        }

        $tax = convertPriceToUserCurrency($tax, $userCurrencyItem);

        if ($tax > 0) {
            $taxPrice = $priceGuest * $tax / 100;

            if ($priceDisplay == 'total_price') {

                if ($showTaxInPrice) {
                    $priceGuest = $priceGuest + $taxPrice;
                }

                if ($format) {
                    $priceGuest = handlePriceFormat($priceGuest, $decimal, $decimalSeparator, $thousandsSeparator);
                }
            } elseif ($priceDisplay == 'price_and_tax') {
                if ($coursePagePrice) {
                    return [
                        'price' => $priceGuest,
                        'tax' => $taxPrice,
                    ];
                }

                if ($format) {
                    $priceGuest = handlePriceFormat($priceGuest, $decimal, $decimalSeparator, $thousandsSeparator);
                    $taxPrice = handlePriceFormat($taxPrice, $decimal, $decimalSeparator, $thousandsSeparator);
                }

                if ($showCurrency) {
                    $priceGuest = addCurrencyToPrice($priceGuest, $userCurrencyItem);
                    $taxPrice = addCurrencyToPrice($taxPrice, $userCurrencyItem);
                }

                $priceGuest = $priceGuest.($showTaxInPrice ? ('+'.$taxPrice.' '.trans('cart.tax')) : '');
            }
        }
    } elseif ($format) {
        $priceGuest = handlePriceFormat($priceGuest, $decimal, $decimalSeparator, $thousandsSeparator);
    }

    if ($coursePagePrice) {
        return [
            'price_guest' => $priceGuest,
            'tax' => 0,
        ];
    }

    if ($showCurrency and $priceDisplay != 'price_and_tax') {
        $priceGuest = addCurrencyToPrice($priceGuest, $userCurrencyItem);
    }

    return $priceGuest;
}

function convertPriceToUserCurrency($price, $userCurrencyItem = null)
{
    if (empty($userCurrencyItem)) {
        $userCurrencyItem = getUserCurrencyItem();
    }

    $exchangeRate = (! empty($userCurrencyItem) and $userCurrencyItem->exchange_rate) ? $userCurrencyItem->exchange_rate : 0;

    if ($exchangeRate > 0) {
        return $price * $exchangeRate;
    }

    return $price;
}

function convertPriceToDefaultCurrency($price, $userCurrencyItem = null)
{
    if (empty($userCurrencyItem)) {
        $userCurrencyItem = getUserCurrencyItem();
    }

    $exchangeRate = (! empty($userCurrencyItem) and $userCurrencyItem->exchange_rate) ? $userCurrencyItem->exchange_rate : 0;

    if ($exchangeRate > 0) {
        return $price / $exchangeRate;
    }

    return $price;
}

function addCurrencyToPrice($price, $userCurrencyItem = null)
{
    if (empty($userCurrencyItem)) {
        $userCurrencyItem = getUserCurrencyItem();
    }

    if (! empty($price)) {
        $currency = currencySign($userCurrencyItem->currency);
        $currencyPosition = $userCurrencyItem->currency_position;

        switch ($currencyPosition) {
            case 'left':
                $price = $currency.$price;
                break;

            case 'left_with_space':
                $price = $currency.' '.$price;
                break;

            case 'right':
                $price = $price.$currency;
                break;

            case 'right_with_space':
                $price = $price.' '.$currency;
                break;

            default:
                $price = $currency.$price;
        }
    }

    return $price;
}
function addCurrencyToPriceGuest($priceGuest, $userCurrencyItem = null)
{
    if (empty($userCurrencyItem)) {
        $userCurrencyItem = getUserCurrencyItem();
    }

    if (! empty($priceGuest)) {
        $currency = currencySign($userCurrencyItem->currency);
        $currencyPosition = $userCurrencyItem->currency_position;

        switch ($currencyPosition) {
            case 'left':
                $priceGuest = $currency.$priceGuest;
                break;

            case 'left_with_space':
                $priceGuest = $currency.' '.$priceGuest;
                break;

            case 'right':
                $priceGuest = $priceGuest.$currency;
                break;

            case 'right_with_space':
                $priceGuest = $priceGuest.' '.$currency;
                break;

            default:
                $priceGuest = $currency.$priceGuest;
        }
    }

    return $priceGuest;
}

/**
 * This text is for the course details page only and should not be used elsewhere. Use the "handlePrice" method for other places.
 * */
function handleCoursePagePrice($price)
{
    $result = handlePrice($price, true, true, true);

    $price = addCurrencyToPrice($result['price']);

    $tax = ! empty($result['tax']) ? addCurrencyToPrice($result['tax']) : 0;

    return [
        'price' => $price,
        'tax' => $tax,
    ];
}
function handleCoursePagePriceGuest($priceGuest)
{
    $result = handlePriceGuest($priceGuest, true, true, true);

    $priceGuest = addCurrencyToPriceGuest($result['price_guest']);

    $tax = ! empty($result['tax']) ? addCurrencyToPriceGuest($result['tax']) : 0;

    return [
        'price_guest' => $priceGuest,
        'tax' => $tax,
    ];
}

function checkShowCookieSecurityDialog()
{
    $show = false;

    if (getFeaturesSettings('cookie_settings_status')) {

        if (auth()->check()) {
            $checkDB = \App\Models\UserCookieSecurity::where('user_id', auth()->id())
                ->first();

            $show = empty($checkDB);
        } else {
            $checkCookie = Cookie::get('cookie-security');

            $show = empty($checkCookie);
        }
    }

    return $show;
}

function getNavbarButton($roleId = null, $forGuest = false)
{
    return \App\Models\NavbarButton::where('role_id', $roleId)
        ->where('for_guest', $forGuest)
        ->first();
}

function getLeafletApiPath()
{
    return 'https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png';
    //return 'https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
}

function convertToMB($size, $unit = 'B')
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $index = array_search($unit, $units);
    $bytes = $size * pow(1024, $index);

    $mb_size = $bytes / pow(1024, 2);

    return round($mb_size, 2);
}

function createImageTitle($title = '')
{
    $width = 600;
    $height = 300;
    $center_x = $width / 2;
    $center_y = $height / 2;
    $max_len = 100;
    $font_size = 30;
    $font_height = 10;

    $text = $title;

    $lines = explode("\n", wordwrap($text, $max_len));
    $y = $center_y - ((count($lines) - 1) * $font_height);
    $img = Image::canvas($width, $height);

    foreach ($lines as $line) {
        $img->text($line, $center_x, $y, function ($font) use ($font_size) {
            $font->size($font_size);
            $font->align('center');
            $font->valign('center');
        });

        $y += $font_height * 2;
    }

    return $img->encode('data-url')->encoded;
}
