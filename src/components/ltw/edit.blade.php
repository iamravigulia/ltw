<!--
  Tailwind UI components require Tailwind CSS v1.8 and the @tailwindcss/ui plugin.
  Read the documentation to get started: https://tailwindui.com/documentation
-->
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
@php $que = DB::table('fmt_ltw_ques')->where('id', $message)->first(); @endphp
<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="modalLTW{{$que->id}}">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!--
        Background overlay, show/hide based on modal state.
  
        Entering: "ease-out duration-300"
          From: "opacity-0"
          To: "opacity-100"
        Leaving: "ease-in duration-200"
          From: "opacity-100"
          To: "opacity-0"
      -->
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
        <!--
        Modal panel, show/hide based on modal state.
  
        Entering: "ease-out duration-300"
          From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          To: "opacity-100 translate-y-0 sm:scale-100"
        Leaving: "ease-in duration-200"
          From: "opacity-100 translate-y-0 sm:scale-100"
          To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      -->
      <style>
          .fmt_label{
              font-weight: 600;
              margin: 10px 0 0 0;
          }
          .fm_box{
            border: 1px solid #303030; border-radius:4px; padding:2px 4px; width:100%;
          }
      </style>
        <div class="inline-block align-bottom bg-white rounded-lg text-xs text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full relative -mx-8" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <a onclick="closeModalLTW({{$message}})" style="z-index: 999999999999999999999999; position: relative;" class="p-2w-8 h-8 bg-gray-600 text-white rounded-full absolute right-0 -top-10 -mr-2 -mt-2 z-40" href="javascript:void(0);">x</a>
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <form action="{{route('fmt.ltw.store')}}" method="post" enctype="multipart/form-data">
                    @if ($errors ?? '')
                        <div class="my-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    @csrf
                    <input type="text" name="question_id" value="{{$que->id}}" hidden>
                    <div class="text-xl">Edit Learn the Word Question</div>
                    <div style="background: #303030; color:#fff; display:inline; cursor:pointer;" onclick="closeModalLTW({{$message}})">Close Model</div>
                    <div class="flex flex-wrap -mx-4 my-2">{{-- flex-wrap --}}
                    <div class="w-full px-2">{{-- w-1/3 --}}
                        <div class="my-2">
                            <label class="bloc" for="">Format Title</label>
                            <textarea class="fm_box" name="format_title" id="" cols="30" rows="2" placeholder="Question">{{$que->format_title}}</textarea>
                        </div>
                    </div>{{-- //w-1/3 --}}
                    {{-- LEARN THE WORD --}}
                    {{-- word --}}
                    <div class="w-full px-2">
                        <label class="block fmt_label" for="">word</label>
                        <input class="fmt_input fm_box" type="text" name="word" value="{{$que->word}}" placeholder="word" style="width: 100%;" required>
                    </div>
                    {{-- word_image --}}
                    <div class="w-full px-2">
                        @php $word_image = DB::table('media')->where('id', $que->word_image_media_id)->first() @endphp
                        @if($word_image)
                            <label for="bloc">exists image</label>
                            <img src="{{url('/')}}/storage/{{$word_image->url}}" style="width:40px; height:30px; object-fit:cover;"></li>
                        @endif
                    </div>
                    <div class="w-full px-2">
                        <label class="block fmt_label" for="">word Image</label>
                        <input class="fmt_input fm_box" type="file" accept="image/*" name="word_image" placeholder="word image">
                    </div>
                    {{-- // word_image --}}
                    {{-- word_audio --}}
                    <div class="w-full px-2">
                        @php $word_audio = DB::table('media')->where('id', $que->word_audio_media_id)->first() @endphp
                        @if($word_audio)
                            <audio controls="controls" src="{{url('/')}}/storage/{{$word_audio->url}}"></audio>
                        @endif
                    </div>
                    <div class="w-full px-2">
                        <label class="block fmt_label" for="">word audio</label>
                        <input class="fmt_input fm_box" type="file" accept="audio/*" name="word_audio" placeholder="word audio">
                    </div>
                    {{-- // word_audio --}}
                    <div class="w-full px-2">
                        <label class="block fmt_label" for="">word Transliteration</label>
                        <input class="fmt_input fm_box" type="text" name="word_trans" value="{{$que->word_trans}}" placeholder="word Transliteration" style="width: 100%;">
                    </div>
                    <div class="w-full px-2">
                        <label class="block fmt_label" for="">word Meaning</label>
                        <input class="fmt_input fm_box" type="text" name="word_meaning" value="{{$que->word_meaning}}" placeholder="word Meaning" style="width: 100%;">
                    </div>
                    {{-- // word --}}
                    {{-- word --}}
                    <div class="w-full px-2">
                        <label class="block fmt_label" for="">word 1</label>
                        <input class="fmt_input fm_box" type="text" name="word_1" value="{{$que->word_1}}" placeholder="word 1" style="width: 100%;">
                    </div>
                    <div class="w-full px-2">
                        <label class="block fmt_label" for="">word 1 eng</label>
                        <input class="fmt_input fm_box" type="text" name="word_1_eng" value="{{$que->word_1_eng}}" placeholder="word 1 eng" style="width: 100%;">
                    </div>
                    <div class="w-full px-2">
                        <label class="block fmt_label" for="">word 1 eng mean</label>
                        <input class="fmt_input fm_box" type="text" name="word_1_eng_mean" value="{{$que->word_1_eng_mean}}" placeholder="word 1 eng mean" style="width: 100%;">
                    </div>
                    {{-- // word --}}
                    {{-- word 2--}}
                    <div class="w-full px-2">
                        <label class="block fmt_label" for="">word 2</label>
                        <input class="fmt_input fm_box" type="text" name="word_2" value="{{$que->word_2}}" placeholder="word 2" style="width: 100%;">
                    </div>
                    <div class="w-full px-2">
                        <label class="block fmt_label" for="">word 2 eng</label>
                        <input class="fmt_input fm_box" type="text" name="word_2_eng" value="{{$que->word_2_eng}}" placeholder="word 2 eng" style="width: 100%;">
                    </div>
                    <div class="w-full px-2">
                        <label class="block fmt_label" for="">word 2 eng mean</label>
                        <input class="fmt_input fm_box" type="text" name="word_2_eng_mean" value="{{$que->word_2_eng_mean}}" placeholder="word 2 eng mean" style="width: 100%;">
                    </div>
                    {{-- // word 2--}}
                    {{-- sentence --}}
                    <div class="w-full px-2">
                        <label class="block fmt_label" for="">sentence</label>
                        <input class="fmt_input fm_box" type="text" name="sentence" value="{{$que->sentence}}" placeholder="sentence" style="width: 100%;">
                    </div>
                    {{-- word_audio --}}
                    <div class="w-full px-2">
                        @php $sentence_audio = DB::table('media')->where('id', $que->sentence_audio_media_id)->first() @endphp
                        @if($sentence_audio)
                            <audio controls="controls" src="{{url('/')}}/storage/{{$sentence_audio->url}}"></audio>
                        @endif
                    </div>
                    <div class="w-full px-2">
                        <label class="block fmt_label" for="">sentence audio</label>
                        <input class="fmt_input fm_box" style="padding: 0;" type="file" accept="audio/*" name="sentence_audio" placeholder="sentence audio" >
                    </div>
                    {{-- // word_audio --}}
                    {{-- // sentence --}}
                    {{-- gender--}}
                    <div class="w-full px-2">
                        <label class="block fmt_label" for="">gender 1</label>
                        <input class="fmt_input fm_box" type="text" name="gender_1" value="{{$que->gender_1}}" placeholder="gender_1" style="width: 100%;">
                    </div>
                    <div class="w-full px-2">
                        <label class="block fmt_label" for="">gender 2</label>
                        <input class="fmt_input fm_box" type="text" name="gender_2" value="{{$que->gender_2}}" placeholder="gender_2" style="width: 100%;">
                    </div>
                    <div class="w-full px-2">
                        <label class="block fmt_label" for="">gender 3</label>
                        <input class="fmt_input fm_box" type="text" name="gender_3" value="{{$que->gender_3}}"" placeholder="gender_3" style="width: 100%;">
                    </div>
                    {{-- // gender--}}
                    {{-- r_word--}}
                    <div class="w-full px-2">
                        <label class="block fmt_label" for="">related word 1</label>
                        <input class="fmt_input fm_box" type="text" name="r_word_1" value="{{$que->r_word_1}}" placeholder="related word 1" style="width: 100%;">
                    </div>
                    <div class="w-full px-2">
                        <label class="block fmt_label" for="">related word 2</label>
                        <input class="fmt_input fm_box" type="text" name="r_word_2" value="{{$que->r_word_2}}" placeholder="related word 2" style="width: 100%;">
                    </div>
                    <div class="w-full px-2">
                        <label class="block fmt_label" for="">related word 3</label>
                        <input class="fmt_input fm_box" type="text" name="r_word_3" value="{{$que->r_word_3}}" placeholder="related word 3" style="width: 100%;">
                    </div>
                    {{-- // r_word--}}
                    <div class="my-2 w-full px-2">
                        <label class="bloc" for="">Difficulty Level</label>
                        @php $d_levels = DB::table('difficulty_levels')->get(); @endphp
                        <select name="difficulty_level_id" id="" class="w-full my-2 px-2 py-2 border border-gray-500 rounded-lg">
                            @if ($que->difficulty_level_id)
                                @php $mylevel = DB::table('difficulty_levels')->where('id', $que->difficulty_level_id)->first(); @endphp
                                    <option value="{{$mylevel->id}}">{{$mylevel->name}}</option>
                                @foreach ($d_levels as $level)
                                    @if ($level->id == $mylevel->id)
                    
                                    @else
                                        <option value="{{$level->id}}">{{$level->name}}</option>
                                    @endif
                                @endforeach
                            @else
                                @foreach ($d_levels as $level)
                                    <option value="{{$level->id}}">{{$level->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <button class="w-full my-2 py-1 px-2 bg-blue-600 text-white rounded-lg" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
