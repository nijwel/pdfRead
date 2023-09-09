<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="container">
        <div class="mt-5">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                  <strong>{{ $message }}</strong>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <form action="{{ route('pdf.upload') }}" method="Post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="formFile" class="form-label">Upload PDF</label>
                      <input class="form-control" name="file" type="file" id="formFile">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                    </div>
                </form>
            </div>
            <hr>
                <form action="{{ route('pdf.read') }}" method="get" id="readPdf" >
                    <div class="row">
                        <div class="col-xl-10" >
                            <input type="text" class="form-control pdf_extract" name="pdf_extract">
                        </div>
                        <div class="col-xl-2" >
                            <input type="submit" class="btn btn-sm btn-warning" value="Read with specific">
                        </div>
                    </div>
                </form>
            <hr>
            <div class="pdf_read">
                
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

        <script>
            $(document).ready(function(){
                read()
            });

            $("#readPdf").on('submit',function(e){
                event.preventDefault(e);
                read();
            });

            function read()
            {
                var url = '{{ route("pdf.read") }}';
                $.ajax({
                    url:url,
                    data: {
                        text : $('.pdf_extract').val(),
                    },
                    type:'get',
                    success:function(data){
                        $('.pdf_read').html(data);
                    }
                });
            }
        </script>
    </body>
</html>
