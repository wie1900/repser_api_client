@extends('layouts.client')

@section('client_content')
    <h3>Repser Client</h3>
    <div>

        <form action="/" method="POST">
            @csrf
            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-12">
                    <div class="text-start fw-bold my-2">
                        Source text:
                    </div>
                    <textarea class="form-control field" id="source" name="source" rows="5" cols="5" required>@isset($source_text){{ $source_text }}@endisset</textarea>
                </div>
            </div>

            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-12">
                    <div class="text-start fw-bold my-2">
                        Glossary:
                    </div>
                    <textarea class="form-control field" id="glossary" name="glossary" rows="5" cols="5">@isset($glossary){{ $glossary }}@endisset</textarea>
                </div>
            </div>

            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-12 d-flex justify-content-end">
                    <div class="btn btn-success btn-sm text-light" type="button" onclick="clearFields()">Clear fields</div>
                    <div id="ajax" class="btn btn-primary btn-sm text-light ms-2 me-3" type="button">Send It to process</div>
                </div>
            </div>

            <div class="row mt-3 mb-2">
                <div class="col-12 col-md-12">
                <div class="row">
                        <div class="col-4">
                            <div id="status" class="h5 text-start field">..</div>
                        </div>
                        <div class="col-8">
                            <div id="statusVal" class="h5 text-start field">..</div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="row mt-3 mb-2">
            <div class="col-12 col-md-3 d-flex justify-content-start">
                <a class="btn btn-danger text-light" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                </form>
            </div>
            <div class="col-12 col-md-9 d-flex justify-content-end">
                <form action="/getfile" method="POST">
                    @csrf
                    <input id="glossarfilettx" type="hidden" class="form-control" name="glossarfile" value="xxx">
                    <input id="filetype" type="hidden" class="form-control" name="filetype" value="ttx">
                    <button id="saveglossarttx" class="btn btn-secondary btn-sm text-light me-1" target="_blank">Save Glossar As TTX-File</button>
                </form>
                <form action="/getfile" method="POST">
                    @csrf
                    <input id="glossarfilexliff" type="hidden" class="form-control" name="glossarfile" value="xxx">
                    <input id="filetype" type="hidden" class="form-control" name="filetype" value="xliff">
                    <button id="saveglossarxliff" type="submit" class="btn btn-secondary btn-sm text-light me-1" target="_blank">Save Glossar As XLIFF-File</button>
                </form>
            </div>
        </div>

    </div>


<script>

$( document ).ready(function() {
    
    $("#saveglossarttx").click(function(event) {
            $('#glossarfilettx').val($("#glossary").val());
        });

    $("#saveglossarxliff").click(function(event) {
            $('#glossarfilexliff').val($("#glossary").val());
        });

    $('#ajax').click(function(){

        $('#glossary').val('');

        let source = new Source($('#source'));
        let glossary = new Glossary($('#glossary'));
        let statusWorker = new StatusWorker($('#status'), $('#statusVal'));

        postMan = new Postman(source, glossary, statusWorker);
        postMan.sendPackage();

    });

});

</script>
@endsection


