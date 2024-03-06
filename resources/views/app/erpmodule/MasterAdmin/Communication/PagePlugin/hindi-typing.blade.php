<div class="col-lg-12 p-0 tx-13 m-0">
    <div class="col-lg-12 pd-t-10 pd-b-5">
        <table>
            <tr>
                <td><input type="radio" name="copy-unicode" class="copy-unicode" value="0"></td><td class="pd-l-5"><b>English</b></td>
                <td class="pd-l-15"><input type="radio" name="copy-unicode" class="copy-unicode" value="1" checked></td><td class="pd-l-5"><b>Unicode</b> (Hindi,Marathi,Urdu,Sanskirt etc.)</td>
            </tr>
        </table>
    </div>
    <div class="col-lg-12 pd-t-0">
        <label class="pd-b-5"><b>Message :</b></label>
        <textarea placeholder="Enter message here" id="copy-message-template" class="form-control" style="height:150px; "></textarea>
    </div>
</div>
<div class="modal-footer pd-x-20 mg-t-15 pd-y-15">
    <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
    <button type="submit" class="btn copy-message btn-primary float-right"> <i class="fa fa-copy"></i> Copy Message</button>
</div>
<script type="text/javascript">
    $(".copy-message").click(function (){
        $("#text_message").val($("#copy-message-template").val());
        $("#CustomModels").modal('hide');
    });
</script>
