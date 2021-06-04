<?php

namespace edgewizz\ltw\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Edgewizz\Edgecontent\Models\ProblemSetQues;
use Edgewizz\Ltw\Models\LtwQues;
use Illuminate\Http\Request;

class LtwController extends Controller
{
    public function store(Request $request){
        // dd($request->all());
        $find_id = $request->question_id;
        if($find_id){
            $q = LtwQues::findOrFail($find_id);
        }else{
            $q = new LtwQues();
        }
        // dd($q);
        $q->word          = $request->word;
        /* word_image */
        if($request->word_image){
            $word_image       = new Media();
            $request->word_image->storeAs('public/ltw', time().$request->word_image->getClientOriginalName());
            $word_image->url  = 'ltw/'.time().$request->word_image->getClientOriginalName();
            $word_image->save();
            $q->word_image_media_id          = $word_image->id;
        }
        /* //word_image */
        /* word_audio */
        if($request->word_audio){
            $word_audio       = new Media();
            $request->word_audio->storeAs('public/ltw', time().$request->word_audio->getClientOriginalName());
            $word_audio->url  = 'ltw/'.time().$request->word_audio->getClientOriginalName();
            $word_audio->save();
            $q->word_audio_media_id          = $word_audio->id;
        }
        /* //word_audio */
        $q->word_trans        = $request->word_trans;
        $q->word_meaning      = $request->word_meaning;

        $q->word_1              = $request->word_1;
        $q->word_1_eng          = $request->word_1_eng;
        $q->word_1_eng_mean     = $request->word_1_eng_mean;

        $q->word_2              = $request->word_2;
        $q->word_2_eng          = $request->word_2_eng;
        $q->word_2_eng_mean     = $request->word_2_eng_mean;

        $q->sentence            = $request->sentence;

        /* sentence_audio */
        if($request->sentence_audio){
            $sentence_audio       = new Media();
            $request->sentence_audio->storeAs('public/ltw', time().$request->sentence_audio->getClientOriginalName());
            $sentence_audio->url  = 'ltw/'.time().$request->sentence_audio->getClientOriginalName();
            $sentence_audio->save();
            $q->sentence_audio_media_id          = $sentence_audio->id;
        }
        /* //word_image */
        $q->gender_1            = $request->gender_1;
        $q->gender_2            = $request->gender_2;
        $q->gender_3            = $request->gender_3;

        $q->r_word_1            = $request->r_word_1;
        $q->r_word_2            = $request->r_word_2;
        $q->r_word_3            = $request->r_word_3;

        $q->difficulty_level_id     = $request->difficulty_level_id;
        $q->format_title            = $request->format_title;
        $q->save();

        if($find_id){
            return back()->with('success', 'updated succesfully');
        }else{
            if($request->problem_set_id && $request->format_type_id){
                $pbq = new ProblemSetQues();
                $pbq->problem_set_id    = $request->problem_set_id;
                $pbq->question_id       = $q->id;
                $pbq->format_type_id    = $request->format_type_id;
                $pbq->save();
            }
            return back()->with('success', 'added succesfully');
        }
    }
    /* public function inactive($id){
        $f = LtwQues::where('id', $id)->first();
        $f->active = '0';
        $f->save();
        return back();
    }
    public function active($id){
        $f = LtwQues::where('id', $id)->first();
        $f->active = '1';
        $f->save();
        return back();
    } */

    public function imagecsv($question_image, $images){
        foreach($images as $valueImage){
            $uploadImage = explode(".", $valueImage->getClientOriginalName());
            if($uploadImage[0] == $question_image){
                // dd($valueImage);
                $media = new Media();
                $valueImage->storeAs('public/question_images', time() . $valueImage->getClientOriginalName());
                $media->url = 'question_images/' . time() . $valueImage->getClientOriginalName();
                $media->save();
                return $media->id;
            }
        }
    }

    public function csv_upload(Request $request){
        $file = $request->file('file');
        $images = $request->file('images');
        $audio = $request->file('audio');
        // dd($file);
        // File Details
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();
        // Valid File Extensions
        $valid_extension = array("csv");
        // 2MB in Bytes
        $maxFileSize = 2097152;
        // Check file extension
        if (in_array(strtolower($extension), $valid_extension)) {
            // Check file size
            if ($fileSize <= $maxFileSize) {
                // File upload location
                $location = 'uploads';
                // Upload file
                $file->move($location, $filename);
                // Import CSV to Database
                $filepath = public_path($location . "/" . $filename);
                // Reading file
                $file = fopen($filepath, "r");
                $importData_arr = array();
                $i = 0;
                while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
                    $num = count($filedata);
                    // Skip first row (Remove below comment if you want to skip the first row)
                    if ($i == 0) {
                        $i++;
                        continue;
                    }
                    for ($c = 0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata[$c];
                    }
                    $i++;
                }
                fclose($file);
                // Insert to MySQL database
                foreach ($importData_arr as $importData) {
                    $insertData = array(
                        "word"          => $importData[1],
                        "word_image"    => $importData[2],
                        "word_audio"    => $importData[3],
                        "word_trans"    => $importData[4],
                        "word_meaning"  => $importData[5],

                        "word_1"          => $importData[6],
                        "word_1_eng"      => $importData[7],
                        "word_1_eng_mean" => $importData[8],

                        "word_2"          => $importData[9],
                        "word_2_eng"      => $importData[10],
                        "word_2_eng_mean" => $importData[11],

                        "sentence"        => $importData[12],
                        "sentence_audio"  => $importData[13],

                        "gender_1"        => $importData[14],
                        "gender_2"        => $importData[15],
                        "gender_3"        => $importData[16],

                        "r_word_1"        => $importData[17],
                        "r_word_2"        => $importData[18],
                        "r_word_3"        => $importData[19],

                    );
                    // var_dump($insertData['answer1']);
                    /*  */
                    if ($insertData['word']) {
                        $fill_Q                 = new LtwQues();
                        $fill_Q->format_title   = $request->format_title;
                        if(!empty($insertData['level'])){
                            if($insertData['level'] == 'easy'){
                                $fill_Q->difficulty_level_id = 1;
                            }else if($insertData['level'] == 'medium'){
                                $fill_Q->difficulty_level_id = 2;
                            }else if($insertData['level'] == 'hard'){
                                $fill_Q->difficulty_level_id = 3;
                            }
                        }
                        if (!empty($insertData['word']) && $insertData['word'] != '') {
                            $fill_Q->word             = $insertData['word'];
                        }
                        if (!empty($insertData['word_image']) && $insertData['word_image'] != '') {
                            $word_image = $this->imagecsv($insertData['word_image'], $images);
                            $fill_Q->word_image_media_id = $word_image;
                        }
                        if (!empty($insertData['word_audio']) && $insertData['word_audio'] != '') {
                            $word_audio = $this->imagecsv($insertData['word_audio'], $audio);
                            $fill_Q->word_audio_media_id = $word_audio;
                        }

                        if (!empty($insertData['word_trans']) && $insertData['word_trans'] != '') {
                            $fill_Q->word_trans       = $insertData['word_trans'];
                        }
                        if (!empty($insertData['word_meaning']) && $insertData['word_meaning'] != '') {
                            $fill_Q->word_meaning               = $insertData['word_meaning'];
                        }

                        if (!empty($insertData['word_1']) && $insertData['word_1'] != '') {
                            $fill_Q->word_1         = $insertData['word_1'];
                        }
                        if (!empty($insertData['word_1_eng']) && $insertData['word_1_eng'] != '') {
                            $fill_Q->word_1_eng         = $insertData['word_1_eng'];
                        }
                        if (!empty($insertData['word_1_eng_mean']) && $insertData['word_1_eng_mean'] != '') {
                            $fill_Q->word_1_eng_mean         = $insertData['word_1_eng_mean'];
                        }
                        if (!empty($insertData['word_2']) && $insertData['word_2'] != '') {
                            $fill_Q->word_2         = $insertData['word_2'];
                        }
                        if (!empty($insertData['word_2_eng']) && $insertData['word_2_eng'] != '') {
                            $fill_Q->word_2_eng         = $insertData['word_2_eng'];
                        }
                        if (!empty($insertData['word_2_eng_mean']) && $insertData['word_2_eng_mean'] != '') {
                            $fill_Q->word_2_eng_mean         = $insertData['word_2_eng_mean'];
                        }

                        if (!empty($insertData['sentence']) && $insertData['sentence'] != '') {
                            $fill_Q->sentence         = $insertData['sentence'];
                        }
                        if (!empty($insertData['sentence_audio']) && $insertData['sentence_audio'] != '') {
                            $sentence_audio = $this->imagecsv($insertData['sentence_audio'], $images);
                            $fill_Q->sentence_audio_media_id = $sentence_audio;
                        }
                        
                        if (!empty($insertData['gender_1']) && $insertData['gender_1'] != '') {
                            $fill_Q->gender_1         = $insertData['gender_1'];
                        }
                        if (!empty($insertData['gender_2']) && $insertData['gender_2'] != '') {
                            $fill_Q->gender_2         = $insertData['gender_2'];
                        }
                        if (!empty($insertData['gender_3']) && $insertData['gender_3'] != '') {
                            $fill_Q->gender_3         = $insertData['gender_3'];
                        }

                        if (!empty($insertData['r_word_1']) && $insertData['r_word_1'] != '') {
                            $fill_Q->r_word_1         = $insertData['r_word_1'];
                        }
                        if (!empty($insertData['r_word_1']) && $insertData['r_word_1'] != '') {
                            $fill_Q->r_word_1         = $insertData['r_word_1'];
                        }
                        if (!empty($insertData['r_word_2']) && $insertData['r_word_2'] != '') {
                            $fill_Q->r_word_2         = $insertData['r_word_2'];
                        }
                        if (!empty($insertData['r_word_2']) && $insertData['r_word_2'] != '') {
                            $fill_Q->r_word_2         = $insertData['r_word_2'];
                        }

                        $fill_Q->save();
                        
                        if($request->problem_set_id && $request->format_type_id){
                            $pbq = new ProblemSetQues();
                            $pbq->problem_set_id = $request->problem_set_id;
                            $pbq->question_id = $fill_Q->id;
                            $pbq->format_type_id = $request->format_type_id;
                            $pbq->save();
                        }
                    }
                    /*  */
                }
                // Session::flash('message', 'Import Successful.');
            } else {
                // Session::flash('message', 'File too large. File must be less than 2MB.');
            }
        } else {
            // Session::flash('message', 'Invalid File Extension.');
        }
        return back();
    }
}
