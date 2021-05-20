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
    * Get a statistic.
    *
    * @return Statistic.
    */
    public function getStatistic($typeCode,$categoryCode)
    {
        $stats = array();
        foreach ($this->data as $statistic) {
            if (($statistic->category_type->value == $typeCode) && 
                ($statistic->statistic_category->value == $categoryCode)) {
                array_push($stats,$statistic);
            }
        }
        return $stats;
    }

    /**
    * Add a user statistic.
    *
    */
    public function addStatistic($typeCode,$typeDesc,$categoryCode,$categoryDesc,$note,$segment_type)
    {
        # Create the new statistic object
        $stat_obj = (object) [
            'statistic_category' => [(object) [
                'value' => $categoryCode,
                'desc'  => $categoryDesc,
            ]],
            'category_type' => [(object) [
                'value' => $typeCode,
                'desc'  => $typeDesc,
            ]],
            'statistic_note' => $note,
            'segment_type'   => $segment_type,
        ];

        # Add the object to the user
        $this->data->user_statistic[] = $stat_obj;
    }

    /**
    * Delete a user statistic.
    *
    */
    public function removeStatistic($typeCode,$categoryCode)
    {
    }

    /**
    * Update a user statistic.
    *
    */
    public function updateStatistic($fromTypeCode,$fromCategoryCode,$toTypeCode,$toCategoryCode)
    {
        $this->removeStatistic($fromTypeCode,$categoryCode);
        $this->addStatistic($toTypeCode,$toCategoryCode);
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
            if ($statistic->category_type->value == $typeCode) {
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
            if ($statistic->category_type->desc == $typeDesc) {
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
            if ($statistic->statistic_category->value == $categoryCode) {
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
            if ($statistic->statistic_category->desc == $categoryDesc) {
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
            if ($statistic->segment_type == $segmentType) {
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
            if (preg_match("/$note/i", $statistic->statistic_note)) {
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
            if (preg_match("/$typeCode/i", $statistic->category_type->value)) {
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
            if (preg_match("/$typeDesc/i", $statistic->category_type->desc)) {
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
            if (preg_match("/$categoryCode/i", $statistic->statistic_category->value)) {
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
            if (preg_match("/$categoryDesc/i", $statistic->statistic_category->desc)) {
                array_push($stats,$statistic);
            }
        }
        return $stats;
    }

}
