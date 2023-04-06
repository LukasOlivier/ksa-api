<?php

namespace App\Modules\Services;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Model;

class ServicesLanguages extends Service
{
    protected Model $model;
    protected array $_rulesTranslations = [];

    public function __construct(Announcement $model)
    {
        parent::__construct($model);
    }

    protected function PresentWithTranslations($data, $language)
    {
        if (!isset($data['translations']))
            return $data;
        $translations = [];
        foreach ($data['translations'] as $translation) {
            $translations[$translation['language']] = $translation;
        }
        $data['translations'] = $translations;
        if ($language) {
            $data['translations'] = returnCorrespondingTranslation($language, $data);
        }
        return $data;
    }
}

function returnCorrespondingTranslation($language, $data)
{
    if (!isset($data['translations'][$language])) {
        foreach ($data['translations'] as $translationField) {
            foreach ($translationField as $key => $value) {
                $translation[$key] = $language;
                if ($key != 'language'){
                    $translation[$key] = 'Translation not found';
                }
            }
            $data['translations'][$language] = $translation;
        }
    }
    return $data['translations'][$language];
}

