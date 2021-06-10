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
     * User Statistics Object.
     *
     * See: https://developers.exlibrisgroup.com/alma/apis/docs/xsd/rest_user.xsd/?tags=GET#user_statistics
     */

    /**
     * Get all user's statistics.
     * 
     * @return array of statistics.
     */
    public function allStatistics()
    {
        $stats = [];
        if ($this->data->user_statistic) {
            foreach ($this->data->user_statistic as $statistic) {
                $stats[] = Statistic::make($this->client, $statistic);
            }
        }
        return $stats;
    }

    /**
    * Get a particular statistic.
    *
    * @param $typeCode code of the category type.
    * @param $categoryCode code of the statistical category.
    *
    * @return array Statistic.
    */
    public function get($typeCode,$categoryCode)
    {
        $stats = [];
        if ($this->data->user_statistic) {
            foreach ($this->data->user_statistic as $statistic) {
                if (($statistic->category_type->value == $typeCode) && 
                    ($statistic->statistic_category->value == $categoryCode)) {
                    $stats[] = Statistic::make($this->client, $statistic);
                }
            }
        }
        return $stats;
    }

    /**
    * Add a user statistic.
    *
    * @param object Statistic
    * @return object Statistic
    */
    public function addStatistic($StatisticObj)
    {
        $this->data->user_statistic[] = $StatisticObj;
        return Statistic::make($this->client, $StatisticObj);
    }

    /**
    * Delete a user statistic.
    *
    * @param string $typeCode code of the category type.
    * @param string $categoryCode code of the statistical category.
    */
    public function removeStatistic($typeCode,$categoryCode)
    {
        if ($this->data->user_statistic) {
            foreach($this->data->user_statistic as $key => $row) {
                if (($row->category_type->value == $typeCode) && ($row->statistic_category->value == $categoryCode)) {
                    array_splice($this->data->user_statistic, $key, 1);
                }
            }
        }
        return;
    }

    /**
    * Delete all user statistics.
    */
    public function removeAllStatistics()
    {
        $this->data->user_statistic = [];
        return;
    }


}
