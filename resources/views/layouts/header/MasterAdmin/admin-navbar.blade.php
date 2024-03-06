<ul class="nav digishiksha-navbar-header nav-line tx-12" id="myTab5" role="tablist">
    @foreach(navbar($navbarid) as $key=>$value)
        @php
            $subnav=0;
            if(is_array($value)&&(count($value)>0)){
             $subnav=1;
            }
        @endphp
        <li class="nav-item">
            <a class="nav-link" href="{{navlink($key)}}" @if($subnav) data-toggle="dropdown" @endif><i class="{{getlinkicon($key)}}"></i> {{ucwords(str_replace('.',' ',$key))}} @if($subnav) <i class="fa fa-angle-down"></i> @endif</a>
            @if($subnav && is_array($value))
                <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
                    @foreach($value as $subkey=>$value)
                        <a href="{{navlink($subkey)}}" class="dropdown-item">{{ucwords(str_replace('.',' ',$subkey))}}</a>
                    @endforeach
                </div>
            @endif
        </li>
    @endforeach
</ul>
