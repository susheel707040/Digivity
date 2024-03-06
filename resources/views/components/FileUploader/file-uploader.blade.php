<link href="{{url('assets/lib/fileuploader/css/jquery.dm-uploader.css')}}"  rel="stylesheet">
<link href="{{url('assets/lib/fileuploader/styles.css')}}" rel="stylesheet">
<div class="row m-0">
    <div class="col-md-12 col-sm-12">
        <!-- Our markup, the important part here! -->
        <div id="drag-and-drop-zone" class="dm-uploader p-4">
            <h4 class="mb-1 mt-1 text-muted">Drag &amp; drop files here</h4>
            <div class="btn btn-primary btn-block mb-1">
                <span>Open the file Browser</span>
                <input type="file" name="file_name" class="fileuploader" path="@hasSection('filepath')@yield('filepath')@else{{"storage/document/"}}@endif" token="{{csrf_token()}}" title='Click to add Files' />
            </div>
        </div><!-- /uploader -->
    </div>
    <div class="col-md-12 col-sm-12">
            <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
                <li class="text-muted text-center empty">No files uploaded.</li>
            </ul>
        <ul id="file_input" class="file_input_ul mb-0"></ul>
    </div>
</div>
<script src="{{url('assets/lib/fileuploader/js/jquery.dm-uploader.js')}}" ></script>
<script src="{{url('assets/lib/fileuploader/demo-ui.js')}}" ></script>
<script src="{{url('assets/lib/fileuploader/demo-config.js')}}" ></script>
<!-- File item template -->
<script type="text/html" id="files-template">
    <li class="media">
        <div class="media-body mb-1">
            <p class="mb-2">
                <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
                <input type="hidden" class="file_url" name="file_url[]">
                <input type="hidden" class="file_name" name="file_name[]">
                <button type="button" id="%%id%%" class="float-right FileRemove text-danger" style="background:none; border:0;  "><i class="fa fa-trash"></i> Remove</button>
            </p>
            <div class="progress mb-2">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                     role="progressbar"
                     style="width: 0%"
                     aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
            <hr class="mt-1 mb-1" />
        </div>
    </li>
</script>
<!-- Debug item template -->
<script type="text/html" id="debug-template">
    <li class="list-group-item text-%%color%%"><strong>%%date%%</strong>: %%message%%</li>
</script>
