<?php
namespace Edgewizz\Ltw\Models;

use Illuminate\Database\Eloquent\Model;

class LtwQues extends Model{
    /* public function answers(){
        return $this->hasMany('Edgewizz\Mcqanpt\Models\McqanptAns', 'question_id');
    } */
    protected $table = 'fmt_ltw_ques';
}