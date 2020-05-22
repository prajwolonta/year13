<?php

namespace App\Http\Controllers;

use App\Contracts\OccupationParser;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OccupationsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $occparser;

    public function __construct(OccupationParser $parser)
    {
        $this->occparser = $parser;
    }

    public function index()
    {
        return $this->occparser->list();
    }

    public function compare(Request $request)
    {

        $this->occparser->setScope('skills');
        $occupation_1_code = $request->get('occupation_1');
        $occupation_2_code = $request->get('occupation_2');

        $occupations_1 = $this->occparser->get($occupation_1_code);
        $occupations_2 = $this->occparser->get($occupation_2_code);

        /** IMPLEMENT COMPARISON **/
        $match = 0;
        if((is_array($occupations_1) && count($occupations_1) > 0 ) &&
            (is_array($occupations_2) && count($occupations_2) > 0)){

            // get total number of combined occupation
            $total_occ = count($occupations_1) + count($occupations_2);

            // get all intersecting occupations
            $intersecting_val = $this->getIntersectingVal($occupations_1, $occupations_2);

            // multiply intersecting count by 2 (intersect is a pair)
            $intersecting_occ = count($intersecting_val) * 2;

            if($intersecting_occ > 0){

                // get intersecting occupation percentage
                $intersecting_occ_pc = ($intersecting_occ / $total_occ) * 100;

                //get percentage based on value from intersecting occupation
                $avg_intersecting_pc = $this->getIntersectingAvgPc($intersecting_val);

                // calculate percentage
                $match = ($intersecting_occ_pc * $avg_intersecting_pc) / 100;
            }
        }
        /** IMPLEMENT COMPARISON **/

        return [
            'occupation_1' => $this->getOccupationByCode($occupation_1_code),
            'occupation_2' => $this->getOccupationByCode($occupation_2_code),
            'occupations_1' => $occupations_1,
            'occupations_2'=>$occupations_2,
            'match' => number_format($match, 2)
        ];
    }

    private function getOccupationByCode($code){
        $occupations = $this->occparser->list();
        $occupation_title = '';
        array_filter($occupations, function($occupation) use ($code, &$occupation_title){
            if($occupation['code'] == $code){
                $occupation_title = $occupation['title'];
            }
        });
        return $occupation_title;

    }

    private function getIntersectingVal($arr1, $arr2){
        $intersecting_val = [];
        foreach($arr1 as $arrVal1){
            foreach($arr2 as $arrVal2){
                if($arrVal1['label'] == $arrVal2['label']){
                    array_push($intersecting_val, [
                        'label' => $arrVal1['label'],
                        'value1' => $arrVal1['value'],
                        'value2' => $arrVal2['value']
                    ]);
                }
            }
        }
        return $intersecting_val;
    }

    private function getIntersectingAvgPc($arr){
        $avgPc = 0;
        foreach($arr as $arrVal){
            $avgPc += (min($arrVal['value1'], $arrVal['value2']) / max($arrVal['value1'], $arrVal['value2'])) * 100;
        }
        return $avgPc/count($arr);
    }
}



