<div>
    <style>
        .fmt_box{
            margin: 10px 20px;
            padding: 10px 20px;
            border: 4px solid #eeeeee;
            background: #fff;
            box-shadow: 2px 4px 8px #b1b1b1;
        }
        .fmt_headline{
            font-size: 20px;
            margin:10px 0;
        }
        .fmt_label{
            font-size: 14px;
        }
        .fmt_input{
            padding:4px 10px;
            margin: 0 20px 0 0;
            border:1px solid #707070;
            border-radius: 4px;
            display: block;
            font-size: 16px;
        }
        .fmt_sub_btn{
            padding:6px 20px;
            margin:10px 0;
            border-radius: 8px;
            background:#0047d4;
            color:#fff;
            border:none;
            letter-spacing: 1px;
            cursor: pointer;
        }
        .fmt_checkbox{
            /* margin-left: 10px; */
            width: 34px;
            height: 34px;
            display: block;
        }
        .fmt_flex{
            display: flex;
            margin: 10px 0;
        }
        #addOption{
            padding: 6px 20px;
            background: #049e04;
            color: #fff;
            cursor: pointer;
        }
    </style>
    <form action="{{route('fmt.ltw.store')}}" method="post" class="fmt_box" enctype="multipart/form-data">
        <input type="integer" name="problem_set_id" value="{{$pbs72 ?? ''}}" hidden style="border:1px solid #000000;">
        <input type="integer" name="format_type_id" value="{{$fmt72 ?? ''}}" hidden style="border:1px solid #000000;">
        <div class="fmt_headline">Add a Learn the word</div>
        <div>
            <label class="fmt_label" for="">Format Title</label>
            <input class="fmt_input" type="text" name="format_title" placeholder="format_title" style="width: 100%;">
        </div>
        {{-- word --}}
        <div>
            <label class="fmt_label" for="">word</label>
            <input class="fmt_input" type="text" name="word" placeholder="word" style="width: 100%;" required>
        </div>
        <div>
            <label class="fmt_label" for="">word Image</label>
            <input class="fmt_input" style="padding: 0;" type="file" accept="image/*" name="word_image" placeholder="word image">
        </div>
        <div>
            <label class="fmt_label" for="">word audio</label>
            <input class="fmt_input" style="padding: 0;" type="file" accept="audio/*" name="word_audio" placeholder="word audio" >
        </div>
        <div>
            <label class="fmt_label" for="">word Transliteration</label>
            <input class="fmt_input" type="text" name="word_trans" placeholder="word Transliteration" style="width: 100%;">
        </div>
        <div>
            <label class="fmt_label" for="">word Meaning</label>
            <input class="fmt_input" type="text" name="word_meaning" placeholder="word Meaning" style="width: 100%;">
        </div>
        {{-- // word --}}
        {{-- word --}}
        <div>
            <label class="fmt_label" for="">word 1</label>
            <input class="fmt_input" type="text" name="word_1" placeholder="word" style="width: 100%;">
        </div>
        <div>
            <label class="fmt_label" for="">word 1 eng</label>
            <input class="fmt_input" type="text" name="word_1_eng" placeholder="word 1 eng" style="width: 100%;">
        </div>
        <div>
            <label class="fmt_label" for="">word 1 eng mean</label>
            <input class="fmt_input" type="text" name="word_1_eng_mean" placeholder="word 1 eng mean" style="width: 100%;">
        </div>
        {{-- // word --}}
        {{-- word 2--}}
        <div>
            <label class="fmt_label" for="">word 2</label>
            <input class="fmt_input" type="text" name="word_2" placeholder="word" style="width: 100%;">
        </div>
        <div>
            <label class="fmt_label" for="">word 2 eng</label>
            <input class="fmt_input" type="text" name="word_2_eng" placeholder="word 2 eng" style="width: 100%;">
        </div>
        <div>
            <label class="fmt_label" for="">word 2 eng mean</label>
            <input class="fmt_input" type="text" name="word_2_eng_mean" placeholder="word 2 eng mean" style="width: 100%;">
        </div>
        {{-- // word 2--}}
        {{-- sentence --}}
        <div>
            <label class="fmt_label" for="">sentence</label>
            <input class="fmt_input" type="text" name="sentence" placeholder="sentence" style="width: 100%;">
        </div>
        <div>
            <label class="fmt_label" for="">sentence audio</label>
            <input class="fmt_input" style="padding: 0;" type="file" accept="audio/*" name="sentence_audio" placeholder="sentence audio" >
        </div>
        {{-- // sentence --}}
        {{-- gender--}}
        <div>
            <label class="fmt_label" for="">gender 1</label>
            <input class="fmt_input" type="text" name="gender_1" placeholder="gender_1" style="width: 100%;">
        </div>
        <div>
            <label class="fmt_label" for="">gender 2</label>
            <input class="fmt_input" type="text" name="gender_2" placeholder="gender_2" style="width: 100%;">
        </div>
        <div>
            <label class="fmt_label" for="">gender 3</label>
            <input class="fmt_input" type="text" name="gender_3" placeholder="gender_3" style="width: 100%;">
        </div>
        {{-- // gender--}}
        {{-- r_word--}}
        <div>
            <label class="fmt_label" for="">related word 1</label>
            <input class="fmt_input" type="text" name="r_word_1" placeholder="related word 1" style="width: 100%;">
        </div>
        <div>
            <label class="fmt_label" for="">related word 2</label>
            <input class="fmt_input" type="text" name="r_word_2" placeholder="related word 2" style="width: 100%;">
        </div>
        <div>
            <label class="fmt_label" for="">related word 3</label>
            <input class="fmt_input" type="text" name="r_word_3" placeholder="related word 3" style="width: 100%;">
        </div>
        {{-- // r_word--}}

        <div class="my-2" style="margin: 20px 0;">
            <label class="bloc" for="">Difficulty Level</label>
            <select name="difficulty_level_id" id="" class="w-full my-2 px-2 py-2 border border-gray-500 rounded-lg">
                <option value="1">Easy</option>
                <option value="2">Medium</option>
                <option value="3">Hard</option>
            </select>
        </div>
        <hr>
        
        <div>
            <input type="submit" class="fmt_sub_btn" value="Submit">
        </div>
    </form>
    {{-- <button id="addOption">Add option</button> --}}
    {{--  --}}
    <form action="{{route('fmt.ltw.csv')}}" method="POST" enctype='multipart/form-data' style="margin:20px 40px;">
        @csrf
        <input type="integer" name="problem_set_id" value="{{$pbs72 ?? ''}}" hidden style="border:1px solid #000000;">
        <input type="integer" name="format_type_id" value="{{$fmt72 ?? ''}}" hidden style="border:1px solid #000000;">
        <div style="display:block; padding:10px;">
            <label style="font-size:12px;">Format Title</label>
            <input class="fmt_input" type="text" name="format_title" placeholder="format_title">
        </div>
        <div style="display:block; padding:10px;">
            <div style="font-size:12px;">CSV</div>
            <input style="display:block;" type="file" name="file" >
        </div>
        <div style="display:block; padding:10px;">
            <div style="font-size:12px;">Images</div>
            <input style="display:block;" type="file" name="images[]" multiple accept="image/*" placeholder="image" required>
        </div>
        <div style="display:block; padding:10px;">
            <div style="font-size:12px;">Audio</div>
            <input style="display:block;" type="file" name="audio[]" multiple accept="audio/*" placeholder="audio" required>
        </div>
        <button type="submit" style="display: inline-block; margin:10px; padding:4px 20px; background:green; color:#fff; text-transform:uppercase; border-radius:4px;">submit</button>
    </form>
    {{--  --}}
</div>
{{-- <script>
    var addOption = document.getElementById('addOption');

</script> --}}
