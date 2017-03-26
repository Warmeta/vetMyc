<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $setting = $this->findSetting('title');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Site Title',
                'value'        => 'vetMyc',
                'details'      => '',
                'type'         => 'text',
                'order'        => 1,
            ])->save();
        }

        $setting = $this->findSetting('description');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Site Description',
                'value'        => 'ULPGC Veterinary Microbiology Mycology Laboratory',
                'details'      => '',
                'type'         => 'text',
                'order'        => 2,
            ])->save();
        }

        $setting = $this->findSetting('logo');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Site Logo',
                'value'        => 'settings/March2017/bUewZ5pn8X6hM1xB90AT.png',
                'details'      => '',
                'type'         => 'image',
                'order'        => 3,
            ])->save();
        }

        $setting = $this->findSetting('admin_bg_image');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Admin Background Image',
                'value'        => 'settings/March2017/67mb2LgJOqRDeZsun0KB.jpg',
                'details'      => '',
                'type'         => 'image',
                'order'        => 9,
            ])->save();
        }

        $setting = $this->findSetting('admin_title');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Admin Title',
                'value'        => 'vetMyc',
                'details'      => '',
                'type'         => 'text',
                'order'        => 4,
            ])->save();
        }

        $setting = $this->findSetting('admin_description');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Admin Description',
                'value'        => 'Welcome to vetMyc Admin',
                'details'      => '',
                'type'         => 'text',
                'order'        => 5,
            ])->save();
        }

        $setting = $this->findSetting('admin_loader');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Admin Loader',
                'value'        => 'settings/March2017/gutyW5oIupMkF7hmn65f.png',
                'details'      => '',
                'type'         => 'image',
                'order'        => 6,
            ])->save();
        }

        $setting = $this->findSetting('admin_icon_image');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Admin Icon Image',
                'value'        => 'settings/March2017/EEjyLa1Sf7kVEFMjYiLv.png',
                'details'      => '',
                'type'         => 'image',
                'order'        => 7,
            ])->save();
        }

        $setting = $this->findSetting('google_analytics_client_id');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Google Analytics Client ID',
                'value'        => 'UA-96230405-1',
                'details'      => '',
                'type'         => 'text',
                'order'        => 9,
            ])->save();
        }
    }

    /**
     * [setting description].
     *
     * @param [type] $key [description]
     *
     * @return [type] [description]
     */
    protected function findSetting($key)
    {
        return Setting::firstOrNew(['key' => $key]);
    }
}
