<form action="/upload" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="thing">
    <button type="submit">Upload</button>

</form>
