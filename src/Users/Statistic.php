<?php

namespace Scriptotek\Alma\Users;

use Scriptotek\Alma\Model\SettableModel;

class Statistic extends SettableModel
{

    /** 
    * Statistic Object 
    * See: https://developers.exlibrisgroup.com/alma/apis/docs/xsd/rest_user.xsd/?tags=GET#user_statistic
    *
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
    */

    /**
    * Update a user statistic segment_type.
    *
    * @param string $segmentType ("Internal" or "External")
    * @return object Statistic
    */
    public function setSegmentType($segment_type)
    {
        $this->data->segment_type = $segment_type;
        return($this->data);
    }

    /**
    * Update a user statistic note.
    *
    * @param string $note
    * @return object Statistic
    */
    public function setNote($note)
    {
        $this->data->statistic_note = $note;
        return($this->data);
    }

    /**
    * Validate a user statistic against the existing code tables.
    *
    * @return boolean
    */
    public function isValid()
    {
        # Obtain info on this statistic.
        $typeCode = "";
        if ($this->data->category_type->value) {
            $typeCode = $this->data->category_type->value;
        }

        $categoryCode = "";
        if ($this->data->statistic_category->value) {
            $categoryCode = $this->data->statistic_category->value;
        }

        $typeDesc = "";
        if ($this->data->category_type->desc) {
            $typeDesc = $this->data->category_type->desc;
        }

        $categoryDesc = "";
        if ($this->data->statistic_category->desc) {
            $categoryDesc = $this->data->statistic_category->desc;
        }
        
        # Get the Type and Category Descriptions for the codes from the code tables.
        $StatTypeDesc = "";
        $StatTypeCode = "";

        $StatType = $this->client->conf->codetables->get('UserStatisticalTypes')->getRowByCode($typeCode);
        if ($StatType) {
            $StatTypeDesc = $StatType[0]->description;
            $StatTypeCode = $StatType[0]->code;
        } 

        $StatCategoryDesc = "";
        $StatCategoryCode = "";

        $StatCategory = $this->client->conf->codetables->get('UserStatCategories')->getRowByCode($categoryCode);
        if ($StatCategory) {
            $StatCategoryDesc = $StatCategory[0]->description;
            $StatCategoryCode = $StatCategory[0]->code;
        } 

        # Compare if the statistics values match with the code table.  
        if (($typeCode == $StatTypeCode) && ($categoryCode == $StatCategoryCode) && 
            ($typeDesc == $StatTypeDesc) && ($categoryDesc == $StatCategoryDesc)) {
            return(true);
        } else {
            return(false);
        }
    }


}
