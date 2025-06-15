<?php

namespace App\Application\Helpers;


class AttributeHelper
{

    public function getAttributeValue($model_id, $model_type)
    {
        $model = $model_type::query()->where('id', $model_id)->first();
        if ($model) {
            return $model->name_ar;
        }
        return $model_id;
    }

//    public function generateAttributeFilterQuery($attrs, $records)
//    {
//
//
//        if ($attrs != null) {
//            $array = json_decode(base64_decode($attrs));
//
//            $records->whereHas('attributes', function ($query) use ($array) {
//                if (is_array($array)) {
//                    foreach ($array as $item) {
//                        switch ($item->filter_type) {
//                            case FilterType::MULTI_VALUES:
//                                $query->where(function ($q) use ($item) {
//                                    $q->where('attribute_id', $item->id)
//                                        ->whereIn('value', $item->values);
//                                });
//                                break;
//                            case FilterType::RANGE_FILTER:
//                                $query->where(function ($q) use ($item) {
//                                    $q->where('attribute_id', $item->id)
//                                        ->whereBetween('value', $item->values);
//                                });
//                                break;
//                        }
//                    }
//                }
//            });
//        }
//        return $records;
//    }
}
