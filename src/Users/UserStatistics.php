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
     * @return Array of Statistics.
     */
    public function getStatistics()
    {
        $stats = array();
        foreach ($this->data->user_statistic as $statistic) {
            $stats[] = $statistic;
        }
        return $stats;
    }

    /**
     * Get the user's statistics.
     * 
     * @return array of statistics.
     */
    public function get()
    {
        $stats = array();
        foreach ($this->data->user_statistic as $statistic) {
            $stats[] = $statistic;
        }
        return $stats;
    }

    /**
    * Get a statistic.
    *
    * @param $typeCode code of the category type.
    * @param $categoryCode code of the statistical category.
    *
    * @return Statistic.
    */
    public function getStatistic($typeCode,$categoryCode)
    {
        $stats = array();
        foreach ($this->data->user_statistic as $statistic) {
            if (($statistic->category_type->value == $typeCode) && 
                ($statistic->statistic_category->value == $categoryCode)) {
                $stats[] = $statistic;
            }
        }
        return $stats;
    }

    /**
    * Add a user statistic with no regard to existing Types and Categories.
    *
    * @param string $typeCode code of the category type.
    * @param string $typeDesc description of the category type.
    * @param string $categoryCode code of the statistical category.
    * @param string $categoryDesc description of the statistical category.
    * @param string $note free text description of the statistic.
    * @param string $segment_type (Internal|External)
    *
    * @return Statistic
    */
    public function addStatisticRaw($typeCode,$typeDesc,$categoryCode,$categoryDesc,$segment_type,$note)
    {
        # Create the new statistic object
        $stat_obj = (object) [
            'statistic_category' => (object) [
                'value' => $categoryCode,
                'desc'  => $categoryDesc,
            ],
            'category_type' => (object) [
                'value' => $typeCode,
                'desc'  => $typeDesc,
            ],
            'statistic_note' => $note,
            'segment_type'   => $segment_type,
        ];

        # Add the object to the user
        $this->data->user_statistic[] = $stat_obj;
    }

    /**
    * Add a user statistic based upon existing Types and Categories.
    *
    * @param string $typeCode code of the category type.
    * @param string $categoryCode code of the statistical category.
    * @param string $segmentType
    * @param string $note
    */
    public function addStatistic($typeCode,$categoryCode,$segmentType,$note)
    {
        //* TODO HERE *//

        /* Logic: */
        /* Lookup both $typeCode and $categoryCode in codetable */
        /* Obtain information (code/description) from both code tables. */
        /* If found and ok, add the statistic to the user */

        /* Code Tables used:
            Code Table; UserStatisticalTypes
            Code Table: UserStatCategories
        */

        # Note need some error checking etc. here.

        # Get the Type and Category Descriptions for the codes from the code tables.
        $stat = $this->client->conf->codetables->get('UserStatisticalTypes')->getRowByCode($typeCode);
        $typeDesc = $stat[0]->description;

        $stat = $this->client->conf->codetables->get('UserStatCategories')->getRowByCode($categoryCode);
        $categoryDesc = $stat[0]->description;
        
        # Add the statistic:
        $this->addStatisticRaw($typeCode,$typeDesc,$categoryCode,$categoryDesc,$segmentType,$note);

        return;
    }

    /**
    * Delete a user statistic.
    *
    * @param string $typeCode code of the category type.
    * @param string $categoryCode code of the statistical category.
    */
    public function removeStatistic($typeCode,$categoryCode)
    {
        foreach($this->data->user_statistic as $key => $row) {
            if (($row->category_type->value == $typeCode) && ($row->statistic_category->value == $categoryCode)) {
                array_splice($this->data->user_statistic, $key, 1);
            }
        }
        return;
    }

    /**
    * Update a user statistic.
    *
    * @param string $fromTypeCode 
    * @param string $fromCategoryCode
    * @param string $toTypeCode
    * @param string $toCategoryCode
    * @param string $segmentType
    * @param string $note
    */
    public function updateStatistic($fromTypeCode,$fromCategoryCode,$toTypeCode,$toCategoryCode,$segmentType,$note)
    {
        /* Remove "from" statistic, then add "to" statistic */
        $this->removeStatistic($fromTypeCode,$fromCategoryCode);
        $this->addStatistic($toTypeCode,$toCategoryCode,$segmentType,$note);
        return;
    }

    /**
    * Get Stats By Type Code.
    *
    * @return Array of Statistics.
    */
    public function getStatsByTypeCode($typeCode)
    {
        $stats = array();
        foreach ($this->data->user_statistic as $statistic) {
            if ($statistic->category_type->value == $typeCode) {
                $stats[] = $statistic;
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
        foreach ($this->data->user_statistic as $statistic) {
            if ($statistic->category_type->desc == $typeDesc) {
                $stats[] = $statistic;
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
        foreach ($this->data->user_statistic as $statistic) {
            if ($statistic->statistic_category->value == $categoryCode) {
                $stats[] = $statistic;
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
        foreach ($this->data->user_statistic as $statistic) {
            if ($statistic->statistic_category->desc == $categoryDesc) {
                $stats[] = $statistic;
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
        foreach ($this->data->user_statistic as $statistic) {
            if ($statistic->segment_type == $segmentType) {
                $stats[] = $statistic;
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
        foreach ($this->data->user_statistic as $statistic) {
            if (preg_match("/$note/i", $statistic->statistic_note)) {
                $stats[] = $statistic;
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
        foreach ($this->data->user_statistic as $statistic) {
            if (preg_match("/$typeCode/i", $statistic->category_type->value)) {
                $stats[] = $statistic;
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
        foreach ($this->data->user_statistic as $statistic) {
            if (preg_match("/$typeDesc/i", $statistic->category_type->desc)) {
                $stats[] = $statistic;
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
        foreach ($this->data->user_statistic as $statistic) {
            if (preg_match("/$categoryCode/i", $statistic->statistic_category->value)) {
                $stats[] = $statistic;
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
        foreach ($this->data->user_statistic as $statistic) {
            if (preg_match("/$categoryDesc/i", $statistic->statistic_category->desc)) {
                $stats[] = $statistic;
            }
        }
        return $stats;
    }

}
