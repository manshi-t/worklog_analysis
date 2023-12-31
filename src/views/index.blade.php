<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Website Analytics</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="row">
        <div class="col-6 m-5">
            <select class="form-select p-2" aria-label="Default select example" id="moduleData" onchange="clearData()">
                <option value="">Select Module</option>
                @foreach ($folderNames as $module)
                    <option value="{{ $module }}">{{ $module }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-5 mt-5">
            <button type="button" class="btn btn-primary p-2 col-3" onclick="showData()">
                Search
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-6 ms-5">
            <ul id="fileData"></ul>
        </div>
        <div class="pagination ms-5">

        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>

                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="setUrl()" id="full-page">View Full
                        Page</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    //clear data of last selected option
    function clearData() {
        $('#fileData').children().remove();
        $('.pagination').children().remove();
    }

    //get file name and content of selected directory
    function showData(page) {
        var dir = $('#moduleData').val();
        var base_path = "{{ url('/') }}/";
        //ajax call for getting file name
        $.ajax({
            type: "post",
            url: (page) ? "getdata/" + dir + page : "getdata/" + dir,
            data: {},
            dataType: 'json',
            success: function(res) {
                if (res['data'] == "") {
                    $('#fileData').append(
                        '<p>This Folder is empty.</p>'
                    );
                } else {
                    if (res['data'].length > 1) {
                        res['data'].forEach(function(name) {
                            $('#fileData').append(
                                '<li class="log-file" data-bs-toggle="modal" data-bs-target="#exampleModal" id="' +
                                name + '">' + name + '</li>'
                            );
                        });
                        res['links'].forEach(function(link) {
                            if (link['url'] == null) {
                                $('.pagination').append(
                                    '<button type="button" class="btn btn-primary ms-2" data-url="'+link['url']+'" disabled>'+link['label']+'</button>'
                                );
                            } else {
                                $('.pagination').append(
                                    '<button type="button" class="btn btn-primary ms-2 paginate-button" data-url="'+link['url']+'">'+link['label']+'</button>'
                                );
                            }
                        });
                    } else {
                        data = Object.entries(res['data']);
                        $('#fileData').append(
                            '<li class="log-file" data-bs-toggle="modal" data-bs-target="#exampleModal" id="' +
                            data[0][1] + '">' + data[0][1] + '</li>'
                        );
                        res['links'].forEach(function(link) {
                            if (link['url'] == null) {
                                $('.pagination').append(
                                    '<button type="button" class="btn btn-primary ms-2" data-url="'+link['url']+'" disabled>'+link['label']+'</button>'
                                );
                            } else {
                                $('.pagination').append(
                                    '<button type="button" class="btn btn-primary ms-2 paginate-button" data-url="'+link['url']+'">'+link['label']+'</button>'
                                );
                            }
                        });
                    }
                    
                    $('.paginate-button').on('click', function() {
                        var url = $(this).attr('data-url');
                        var page = url.replace('/','');
                        $('#fileData').children().remove();
                        $('.pagination').children().remove();
                        showData(page);
                    });
                    $(".log-file").on('click', function() {
                        var name = $(this).attr('id');
                        var dir = $('#moduleData').val();
                        var base_path = "{{ url('/') }}/";
                        //ajax call for getting content of file
                        $.ajax({
                            type: "post",
                            url: "log/" + dir + '/' + name,
                            data: {},
                            dataType: 'json',
                            success: function(res) {
                                if (res == "") {
                                    $('#exampleModal').find('.modal-title').text(name)
                                    .end()
                                    .find('.modal-body p').text('File is empty.')
                                    .end()
                                    .modal('show');
                                    $('#full-page').attr('disabled', 'disabled');
                                } else {
                                    $('#exampleModal').find('.modal-title').text(name)
                                    .end()
                                    .find('.modal-body p').text(res).end()
                                    .modal('show');
                                }
                            }
                        });
                    });
                }
            }
        });
    }

    //get content of file on click of view full page button
    function setUrl() {
        var data = $('#exampleModal').find('.modal-title').text();
        var dir = $('#moduleData').val();
        var base_path = "{{ url('/') }}/";
        $.ajax({
            type: "post",
            url: "log/" + dir + '/' + data,
            data: {},
            dataType: 'json',
            success: function(res) {
                localStorage.setItem('data', res);
                window.open("{{ route('log') }}", "_blank");
            }
        });
    }
</script>