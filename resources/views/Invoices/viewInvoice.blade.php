@extends('Admin.layouts.Admin.filelisting')
@section('content')
<div class="container">
<h1>View PDF</h1>
<div style="width: 100%; height: 600px;">
    <iframe src="{{ $pdfUrl }}" frameborder="0" style="width: 100%; height: 100%;" allowfullscreen></iframe>
</div>
</div>
@endsection
