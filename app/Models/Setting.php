<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model implements TranslatableContract
{
    use Translatable;

    //TODO:: To use the site settings, please use the functions of the helper.php file.
    // If you have created new settings, please use the same structure to optimize
    // the number of requests to the database, because this system does not use cache.

    protected $table = 'settings';

    public $timestamps = false;

    protected $guarded = ['id'];

    public $translatedAttributes = ['value'];

    public function getValueAttribute()
    {
        return getTranslateAttributeValue($this, 'value');
    }

    // The result is stored in these variables
    // If you use each function more than once per page, the database will be requested only once.
    public static $seoMetas;

    public static $socials;

    public static $footer;

    public static $general;

    public static $url_member_area;

    public static $homeSections;

    public static $features;

    public static $financial;

    public static $offlineBanks;

    public static $referral;

    public static $currencySettings;

    public static $homeHero;

    public static $homeHero2;

    public static $homeVideoOrImage;

    public static $pageBackground;

    public static $customCssJs;

    public static $reportReasons;

    public static $notificationTemplates;

    public static $contactPage;

    public static $Error404Page;

    public static $navbarLink;

    public static $panelSidebar;

    public static $findInstructors;

    public static $rewardProgram;

    public static $rewardsSettings;

    public static $storeSettings;

    public static $registrationPackagesGeneral;

    public static $registrationPackagesInstructors;

    public static $registrationPackagesOrganizations;

    public static $becomeInstructorSection;

    public static $themeColors;

    public static $themeFonts;

    public static $forumHomeSection;

    public static $cookieSettings;

    public static $mobileAppSettings;

    public static $remindersSettings;

    public static $generalSecuritySettings;

    public static $advertisingModal;

    public static $othersPersonalization;

    public static $installmentsSettings;

    public static $installmentsTermsSettings;

    public static $registrationBonusSettings;

    public static $registrationBonusTermsSettings;

    public static $statisticsSettings;

    public static $maintenanceSettings;

    public static $generalOptions;

    public static $giftsGeneralSettings;

    // settings name , Using these keys, values are taken from the settings table
    public static $seoMetasName = 'seo_metas';

    public static $socialsName = 'socials';

    public static $footerName = 'footer';

    public static $generalName = 'general';

    public static $UrlMemberName = 'url_member_area';

    public static $featuresName = 'features';

    public static $homeSectionsName = 'home_sections';

    public static $financialName = 'financial';

    public static $offlineBanksName = 'offline_banks';

    public static $referralName = 'referral';

    public static $currencySettingsName = 'currency_settings';

    public static $homeHeroName = 'home_hero';

    public static $homeHeroName2 = 'home_hero2';

    public static $homeVideoOrImageName = 'home_video_or_image_box';

    public static $pageBackgroundName = 'page_background';

    public static $customCssJsName = 'custom_css_js';

    public static $reportReasonsName = 'report_reasons';

    public static $notificationTemplatesName = 'notifications';

    public static $contactPageName = 'contact_us';

    public static $Error404PageName = '404';

    public static $navbarLinkName = 'navbar_links';

    public static $panelSidebarName = 'panel_sidebar';

    public static $findInstructorsName = 'find_instructors';

    public static $rewardProgramName = 'reward_program';

    public static $rewardsSettingsName = 'rewards_settings';

    public static $storeSettingsName = 'store_settings';

    public static $registrationPackagesGeneralName = 'registration_packages_general';

    public static $registrationPackagesInstructorsName = 'registration_packages_instructors';

    public static $registrationPackagesOrganizationsName = 'registration_packages_organizations';

    public static $becomeInstructorSectionName = 'become_instructor_section';

    public static $themeColorsName = 'theme_colors';

    public static $themeFontsName = 'theme_fonts';

    public static $forumHomeSectionName = 'forums_section';

    public static $cookieSettingsName = 'cookie_settings';

    public static $mobileAppSettingsName = 'mobile_app';

    public static $remindersSettingsName = 'reminders';

    public static $generalSecuritySettingsName = 'security';

    public static $advertisingModalName = 'advertising_modal';

    public static $othersPersonalizationName = 'others_personalization';

    public static $installmentsSettingsName = 'installments_settings';

    public static $installmentsTermsSettingsName = 'installments_terms_settings';

    public static $registrationBonusSettingsName = 'registration_bonus_settings';

    public static $registrationBonusTermsSettingsName = 'registration_bonus_terms_settings';

    public static $statisticsSettingsName = 'statistics';

    public static $maintenanceSettingsName = 'maintenance_settings';

    public static $generalOptionsName = 'general_options';

    public static $giftsGeneralSettingsName = 'gifts_general_settings';

    //statics
    public static $pagesSeoMetas = ['home', 'search', 'categories', 'classes', 'login', 'register', 'contact', 'blog', 'certificate_validation',
        'instructors', 'organizations', 'instructor_finder_wizard', 'instructor_finder', 'reward_courses', 'products_lists', 'reward_products',
        'forum', 'upcoming_courses_lists',
    ];

    public static $mainSettingSections = ['general', 'financial', 'payment', 'home_hero', 'home_hero2', 'page_background', 'home_video_or_image_box'];

    public static $mainSettingPages = ['general', 'financial', 'personalization', 'notifications', 'seo', 'customization', 'other'];

    public static $defaultSettingsLocale = 'id'; // Because the settings table uses translation and some settings do not need to be translated, so we save them with a default locale

    public static $rootColors = ['primary', 'primary-border', 'primary-hover', 'primary-border-hover',
        'primary-btn-shadow', 'primary-btn-shadow-hover', 'primary-btn-color', 'primary-btn-color-hover',
        'secondary', 'secondary-border', 'secondary-hover', 'secondary-border-hover', 'secondary-btn-shadow', 'secondary-btn-shadow-hover',
        'secondary-btn-color', 'secondary-btn-color-hover'];

    public static $rootAdminColors = ['primary'];

    public static function getSettingsWithDefaultLocal(): mixed
    {
        return [
            self::$seoMetasName,
            self::$socialsName,
            self::$generalName,
            self::$UrlMemberName,
            self::$financialName,
            self::$offlineBanksName,
            self::$referralName,
            self::$pageBackgroundName,
            self::$homeSectionsName,
            self::$notificationTemplatesName,
            self::$customCssJsName,
            self::$Error404PageName,
            self::$contactPageName,
        ];
    }

    // functions
    public static function getSetting(&$static, $name, $key = null)
    {
        if (! isset($static)) {
            $static = cache()->remember('settings.'.$name, 24 * 60 * 60, function () use ($name) {
                return self::where('name', $name)->first();
            });
        }

        $value = [];

        if (! empty($static) and ! empty($static->value) and isset($static->value)) {
            $value = json_decode($static->value, true);
        }

        if (! empty($value) and ! empty($key)) {
            if (isset($value[$key])) {
                return $value[$key];
            } else {
                return null;
            }
        }

        if (! empty($key) and (empty($value) or count($value) < 1)) {
            return '';
        }

        return $value;
    }

    /**
     * @param  null  $page  => home, search, categories, login, register, about, contact
     * @return mixed
     */
    public static function getSeoMetas($page = null)
    {
        return self::getSetting(self::$seoMetas, self::$seoMetasName, $page);
    }

    /**
     * @return mixed
     */
    public static function getSocials()
    {
        return self::getSetting(self::$socials, self::$socialsName);
    }

    /**
     * @return mixed
     */
    public static function getFooterColumns()
    {
        return self::getSetting(self::$footer, self::$footerName);
    }

    /**
     * @return mixed
     */
    public static function getGeneralSettings($key = null)
    {
        return self::getSetting(self::$general, self::$generalName, $key);
    }

    public static function getMemberUrl($key = null)
    {
        return self::getSetting(self::$url_member_area, self::$UrlMemberName, $key);
    }

    /**
     * @return mixed
     */
    public static function getFeaturesSettings($key = null)
    {
        return self::getSetting(self::$features, self::$featuresName, $key);
    }

    /**
     * @return mixed
     */
    public static function getCookieSettings($key = null)
    {
        return self::getSetting(self::$cookieSettings, self::$cookieSettingsName, $key);
    }

    /**
     * @return array|[commission, tax, minimum_payout, currency]
     */
    public static function getFinancialSettings($key = null)
    {
        return self::getSetting(self::$financial, self::$financialName, $key);
    }

    /**
     * @return array|string
     */
    public static function getFinancialCurrencySettings($key = null)
    {
        return self::getSetting(self::$currencySettings, self::$currencySettingsName, $key);
    }

    /**
     * @param  string  $section
     * @return array|[title, description, hero_background]
     */
    public static function getHomeHeroSettings($section = '1')
    {
        if ($section == '2') {
            return self::getSetting(self::$homeHero2, self::$homeHeroName2);
        }

        return self::getSetting(self::$homeHero, self::$homeHeroName);
    }

    /**
     * @return array|[title, description, background]
     */
    public static function getHomeVideoOrImageBoxSettings()
    {
        return self::getSetting(self::$homeVideoOrImage, self::$homeVideoOrImageName);
    }

    /**
     * @param  null  $page  => login, register, remember_pass, search, categories, become_instructor, blog, instructors, user_avatar, user_cover
     * @return string|array => [all pages]
     */
    public static function getPageBackgroundSettings($page = null)
    {
        return self::getSetting(self::$pageBackground, self::$pageBackgroundName, $page);
    }

    /**
     * @param  null  $key  => css, js
     * @return string|array => {css, js}
     */
    public static function getCustomCssAndJs($key = null)
    {
        return self::getSetting(self::$customCssJs, self::$customCssJsName, $key);
    }

    /**
     * @return array
     */
    public static function getReportReasons()
    {
        return self::getSetting(self::$reportReasons, self::$reportReasonsName);
    }

    /**
     * @param  $template  {String|nullable}
     * @return array
     */
    public static function getNotificationTemplates($template = null)
    {
        return self::getSetting(self::$notificationTemplates, self::$notificationTemplatesName, $template);
    }

    /**
     * @return array
     */
    public static function getOfflineBankSettings($key = null)
    {
        return self::getSetting(self::$offlineBanks, self::$offlineBanksName, $key);
    }

    /**
     * @return array
     */
    public static function getReferralSettings()
    {
        return self::getSetting(self::$referral, self::$referralName);
    }

    /**
     * @return array
     */
    public static function getContactPageSettings($key = null)
    {
        return self::getSetting(self::$contactPage, self::$contactPageName, $key);
    }

    /**
     * @return array
     */
    public static function get404ErrorPageSettings($key = null)
    {
        return self::getSetting(self::$Error404Page, self::$Error404PageName, $key);
    }

    /**
     * @return array
     */
    public static function getHomeSectionsSettings($key = null)
    {
        return self::getSetting(self::$homeSections, self::$homeSectionsName, $key);
    }

    /**
     * @return array
     */
    public static function getNavbarLinksSettings($key = null)
    {
        return self::getSetting(self::$navbarLink, self::$navbarLinkName, $key);
    }

    /**
     * @return array
     */
    public static function getPanelSidebarSettings()
    {
        return self::getSetting(self::$panelSidebar, self::$panelSidebarName);
    }

    /**
     * @return array
     */
    public static function getFindInstructorsSettings()
    {
        return self::getSetting(self::$findInstructors, self::$findInstructorsName);
    }

    /**
     * @return array
     */
    public static function getRewardProgramSettings()
    {
        return self::getSetting(self::$rewardProgram, self::$rewardProgramName);
    }

    /**
     * @return array
     */
    public static function getRewardsSettings()
    {
        return self::getSetting(self::$rewardsSettings, self::$rewardsSettingsName);
    }

    /**
     * @return array
     */
    public static function getStoreSettings($key = null)
    {
        return self::getSetting(self::$storeSettings, self::$storeSettingsName, $key);
    }

    public static function getBecomeInstructorSectionSettings()
    {
        return self::getSetting(self::$becomeInstructorSection, self::$becomeInstructorSectionName);
    }

    public static function getForumSectionSettings()
    {
        return self::getSetting(self::$forumHomeSection, self::$forumHomeSectionName);
    }

    public static function getRegistrationPackagesGeneralSettings($key = null)
    {
        return self::getSetting(self::$registrationPackagesGeneral, self::$registrationPackagesGeneralName, $key);
    }

    public static function getRegistrationPackagesInstructorsSettings($key = null)
    {
        return self::getSetting(self::$registrationPackagesInstructors, self::$registrationPackagesInstructorsName, $key);
    }

    public static function getRegistrationPackagesOrganizationsSettings($key = null)
    {
        return self::getSetting(self::$registrationPackagesOrganizations, self::$registrationPackagesOrganizationsName, $key);
    }

    public static function getThemeColorsSettings()
    {
        return self::getSetting(self::$themeColors, self::$themeColorsName);
    }

    public static function getThemeFontsSettings()
    {
        return self::getSetting(self::$themeFonts, self::$themeFontsName);
    }

    public static function getMobileAppSettings($key = null)
    {
        return self::getSetting(self::$mobileAppSettings, self::$mobileAppSettingsName, $key);
    }

    public static function getRemindersSettings($key = null)
    {
        return self::getSetting(self::$remindersSettings, self::$remindersSettingsName, $key);
    }

    public static function getGeneralSecuritySettings($key = null)
    {
        return self::getSetting(self::$generalSecuritySettings, self::$generalSecuritySettingsName, $key);
    }

    public static function getAdvertisingModalSettings($key = null)
    {
        return self::getSetting(self::$advertisingModal, self::$advertisingModalName, $key);
    }

    public static function getOthersPersonalizationSettings($key = null)
    {
        return self::getSetting(self::$othersPersonalization, self::$othersPersonalizationName, $key);
    }

    public static function getInstallmentsSettings($key = null)
    {
        return self::getSetting(self::$installmentsSettings, self::$installmentsSettingsName, $key);
    }

    public static function getInstallmentsTermsSettings($key = null)
    {
        return self::getSetting(self::$installmentsTermsSettings, self::$installmentsTermsSettingsName, $key);
    }

    public static function getRegistrationBonusSettings($key = null)
    {
        return self::getSetting(self::$registrationBonusSettings, self::$registrationBonusSettingsName, $key);
    }

    public static function getRegistrationBonusTermsSettings($key = null)
    {
        return self::getSetting(self::$registrationBonusTermsSettings, self::$registrationBonusTermsSettingsName, $key);
    }

    public static function getStatisticsSettings($key = null)
    {
        return self::getSetting(self::$statisticsSettings, self::$statisticsSettingsName, $key);
    }

    public static function getMaintenanceSettings($key = null)
    {
        return self::getSetting(self::$maintenanceSettings, self::$maintenanceSettingsName, $key);
    }

    public static function getGeneralOptionsSettings($key = null)
    {
        return self::getSetting(self::$generalOptions, self::$generalOptionsName, $key);
    }

    public static function getGiftsGeneralSettings($key = null)
    {
        return self::getSetting(self::$giftsGeneralSettings, self::$giftsGeneralSettingsName, $key);
    }
}
