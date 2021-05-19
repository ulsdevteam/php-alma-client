<?php

namespace Scriptotek\Alma\Users;

use Scriptotek\Alma\Client;
use Scriptotek\Alma\Model\Model;

/**
 * Iterable collection of statistics resources.
 */
class UserStatistics extends Model
{
    /**
     * Get the user's statistics.
     *
     * @return Statistic
     */
    public function getStatistics()
    {
        $stats = array();
        foreach ($this->data as $statistic) {
                array_push($stats,$statistic);
        }
        return $stats;
    }

    /**
    * Get Stats By Type Code.
    *
    * @return Array of Statistics.
    */
    public function getStatsByTypeCode($typeCode)
    {
        $stats = array();
        foreach ($this->data as $statistic) {
            $statcat_type    = $statistic->category_type;
            $statcat_cat     = $statistic->statistic_category;
            $statcat_note    = $statistic->statistic_note;
            $segment_type    = $statistic->segment_type;

            $type_code       = $statcat_type->value;
            $type_desc       = $statcat_type->desc;
            $category_code   = $statcat_cat->value;
            $category_desc   = $statcat_cat->desc;

            if ($type_code == $typeCode) {
                array_push($stats,$statistic);
            }
        }
        return $stats;
    } 

    /**
    * Get Stats by Type Desc.
    *
    * @return Array of statistics.
    */
    public function getStatsByTypeDesc($typeDesc)
    {
        $stats = array();
        foreach ($this->data as $statistic) {
            $statcat_type    = $statistic->category_type;
            $statcat_cat     = $statistic->statistic_category;
            $statcat_note    = $statistic->statistic_note;
            $segment_type    = $statistic->segment_type;

            $type_code       = $statcat_type->value;
            $type_desc       = $statcat_type->desc;
            $category_code   = $statcat_cat->value;
            $category_desc   = $statcat_cat->desc;

            if ($type_desc == $typeDesc) {
                array_push($stats,$statistic);
            }
        }
        return $stats;
    }

    /**
    * Get Stats by Category Code.
    *
    * @return Array of Statistics.
    */
    public function getStatsByCategoryCode($categoryCode)
    {
        $stats = array();
        foreach ($this->data as $statistic) {
            $statcat_type    = $statistic->category_type;
            $statcat_cat     = $statistic->statistic_category;
            $statcat_note    = $statistic->statistic_note;
            $segment_type    = $statistic->segment_type;

            $type_code       = $statcat_type->value;
            $type_desc       = $statcat_type->desc;
            $category_code   = $statcat_cat->value;
            $category_desc   = $statcat_cat->desc;

            if ($category_code == $categoryCode) {
                array_push($stats,$statistic);
            }
        }
        return $stats;
    }

    /**
    * Get Stats by Category Desc.
    *
    * @return Array of Statistics.
    */
    public function getStatsByCategoryDesc($categoryDesc)
    {
        $stats = array();
        foreach ($this->data as $statistic) {
            $statcat_type    = $statistic->category_type;
            $statcat_cat     = $statistic->statistic_category;
            $statcat_note    = $statistic->statistic_note;
            $segment_type    = $statistic->segment_type;

            $type_code       = $statcat_type->value;
            $type_desc       = $statcat_type->desc;
            $category_code   = $statcat_cat->value;
            $category_desc   = $statcat_cat->desc;

            if ($category_desc == $categoryDesc) {
                array_push($stats,$statistic);
            }
        }
        return $stats;
    }

    /**
    * Get Stats by Segment Type.
    *
    * @return Array of Statistics.
    */
    public function getStatsBySegmentType($segmentType)
    {
        $stats = array();
        foreach ($this->data as $statistic) {
            $statcat_type    = $statistic->category_type;
            $statcat_cat     = $statistic->statistic_category;
            $statcat_note    = $statistic->statistic_note;
            $segment_type    = $statistic->segment_type;

            $type_code       = $statcat_type->value;
            $type_desc       = $statcat_type->desc;
            $category_code   = $statcat_cat->value;
            $category_desc   = $statcat_cat->desc;

            if ($segment_type == $segmentType) {
                array_push($stats,$statistic);
            }
        }
        return $stats;
    }  

    /**
    * Search Stats by Note.
    *
    * @return Array of Statistics.
    */
    public function searchStatsByNote($note)
    {
        $stats = array();
        foreach ($this->data as $statistic) {
            $statcat_type    = $statistic->category_type;
            $statcat_cat     = $statistic->statistic_category;
            $statcat_note    = $statistic->statistic_note;
            $segment_type    = $statistic->segment_type;

            $type_code       = $statcat_type->value;
            $type_desc       = $statcat_type->desc;
            $category_code   = $statcat_cat->value;
            $category_desc   = $statcat_cat->desc;

            if (preg_match("/$note/i", $statcat_note)) {
                array_push($stats,$statistic);
            }
        }
        return $stats;
    }

    /** 
    * Search Stats by Type Code.
    *
    * @return Array of Statistics.
    */
    public function searchStatsByTypeCode($typeCode)
    {
        $stats = array();
        foreach ($this->data as $statistic) {
            $statcat_type    = $statistic->category_type;
            $statcat_cat     = $statistic->statistic_category;
            $statcat_note    = $statistic->statistic_note;
            $segment_type    = $statistic->segment_type;

            $type_code       = $statcat_type->value;
            $type_desc       = $statcat_type->desc;
            $category_code   = $statcat_cat->value;
            $category_desc   = $statcat_cat->desc;

            if (preg_match("/$typeCode/i", $type_code)) {
                array_push($stats,$statistic);
            }
        }
        return $stats;
    }

    /**
    * Search Stats by Type Code.
    *
    * @return Array of Statistics.
    */
    public function searchStatsByTypeDesc($typeDesc)
    {
        $stats = array();
        foreach ($this->data as $statistic) {
            $statcat_type    = $statistic->category_type;
            $statcat_cat     = $statistic->statistic_category;
            $statcat_note    = $statistic->statistic_note;
            $segment_type    = $statistic->segment_type;

            $type_code       = $statcat_type->value;
            $type_desc       = $statcat_type->desc;
            $category_code   = $statcat_cat->value;
            $category_desc   = $statcat_cat->desc;

            if (preg_match("/$typeDesc/i", $type_desc)) {
                array_push($stats,$statistic);
            }
        }
        return $stats;
    }

    /**
    * Search Stats by Type Code.
    *
    * @return Array of Statistics.
    */
    public function searchStatsByCategoryCode($categoryCode)
    {
        $stats = array();
        foreach ($this->data as $statistic) {
            $statcat_type    = $statistic->category_type;
            $statcat_cat     = $statistic->statistic_category;
            $statcat_note    = $statistic->statistic_note;
            $segment_type    = $statistic->segment_type;

            $type_code       = $statcat_type->value;
            $type_desc       = $statcat_type->desc;
            $category_code   = $statcat_cat->value;
            $category_desc   = $statcat_cat->desc;

            if (preg_match("/$categoryCode/i", $category_code)) {
                array_push($stats,$statistic);
            }
        }
        return $stats;
    }

    /**
    * Search Stats by Type Code.
    *
    * @return Array of Statistics.
    */
    public function searchStatsByCategoryDesc($categoryDesc)
    {
        $stats = array();
        foreach ($this->data as $statistic) {
            $statcat_type    = $statistic->category_type;
            $statcat_cat     = $statistic->statistic_category;
            $statcat_note    = $statistic->statistic_note;
            $segment_type    = $statistic->segment_type;

            $type_code       = $statcat_type->value;
            $type_desc       = $statcat_type->desc;
            $category_code   = $statcat_cat->value;
            $category_desc   = $statcat_cat->desc;

            if (preg_match("/$categoryDesc/i", $category_desc)) {
                array_push($stats,$statistic);
            }
        }
        return $stats;
    }



    /*
    public function all($status = 'ACTIVE')
    {
        $ids = [$this->data->primary_id];
        foreach ($this->data->user_identifier as $identifier) {
            if (is_null($status) || $identifier->status == $status) {
                $ids[] = $identifier->value;
            }
        }

        return $ids;
    }
    */

}
