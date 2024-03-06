@php
    if(!isset($search)){
      $search=[];
    }
$languagelist=[ "af"=>"afrikaans","sq"=>"albanian","ar"=>"arabic","hy"=>"armenian","eu"=>"basque",
"bn"=>"bengali","bg"=>"bulgarian","ca"=>"catalan","km"=>"cambodian","zh"=>"chinese (mandarin)",
"hr"=>"croatian","cs"=>"czech","da"=>"danish","nl"=>"dutch","en"=>"english","et"=>"estonian",
"fj"=>"fiji","fi"=>"finnish","fr"=>"french","ka"=>"georgian","de"=>"german",
"el"=>"greek","gu"=>"gujarati","he"=>"hebrew","hi"=>"hindi","hu"=>"hungarian",
"is"=>"icelandic","id"=>"indonesian","ga"=>"irish","it"=>"italian","ja"=>"japanese",
"jw"=>"javanese","ko"=>"korean","la"=>"latin","lv"=>"latvian","lt"=>"lithuanian",
"mk"=>"macedonian","ms"=>"malay","ml"=>"malayalam","mt"=>"maltese",
"mi"=>"maori","mr"=>"marathi","mn"=>"mongolian","ne"=>"nepali",
"no"=>"norwegian","fa"=>"persian","pl"=>"polish","pt"=>"portuguese","pa"=>"punjabi",
"qu"=>"quechua","ro"=>"romanian","ru"=>"russian","sm"=>"samoan","sr"=>"serbian",
"sk"=>"slovak","sl"=>"slovenian","es"=>"spanish","sw"=>"swahili","sv"=>"swedish ",
"ta"=>"tamil","tt"=>"tatar","te"=>"telugu","th"=>"thai","bo"=>"tibetan","to"=>"tonga",
"tr"=>"turkish","uk"=>"ukrainian","ur"=>"urdu","uz"=>"uzbek","vi"=>"vietnamese",
"cy"=>"welsh","xh"=>"xhosa"];
@endphp
<select @if(isset($id)) id="{{$id}}" @else id="language" @endif @if(isset($class)) class="{{$class}}" @else class="form-control input-sm" @endif
@if(isset($required)){{$required}}@endif @if(isset($name)) name="{{$name}}" @else name="language" @endif >
    <option value="">---Select---</option>
    @foreach($languagelist as $key=>$value)
     <option value="{{$key}}" @if(isset($selectid)&&($key==$selectid)) selected @endif>{{ucwords($value)}}</option>
    @endforeach
</select>
