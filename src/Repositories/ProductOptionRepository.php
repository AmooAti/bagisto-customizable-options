<?php

namespace AmooAti\CustomizableOptions\Repositories;

use AmooAti\CustomizableOptions\Contracts\ProductOption;
use Webkul\Core\Eloquent\Repository;
use Webkul\Core\Repositories\LocaleRepository;

class ProductOptionRepository extends Repository
{
    public function model()
    {
        return ProductOption::class;
    }

    public function create(array $data)
    {
        $model = app()->make($this->model());

        foreach (core()->getAllLocales() as $locale) {
            foreach ($model->translatedAttributes as $attribute) {
                if (isset($data[$attribute])) {
                    $data[$locale->code][$attribute] = $data[$attribute];
                    $data[$locale->code]['locale_id'] = $locale->id;
                }
            }
        }

        return $this->model->create($data);
    }

    public function update(array $attributes, $id)
    {
        $model = app()->make($this->model());

        $locale = $this->app->make(LocaleRepository::class)->findOneByField('code', request()->input('locale'));

        foreach ($model->translatedAttributes as $attribute) {
            if (isset($attributes[$attribute])) {
                $attributes[$locale->code][$attribute] = $attributes[$attribute];
                $attributes[$locale->code]['locale_id'] = $locale->id;
            }
            unset($attributes[$attribute]);
        }

        return parent::update($attributes, $id);
    }
}