<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Full Stack Developer Dome</title>
</head>
<body>
<div class="container py-4 px-3 mx-auto">
    <div class="row my-4">
        <div class="col"><b class="fs-1">Full Stack Developer Dome</b></div>
    </div>
    <form class="row g-3">
        <div class="row">
            <div class="col-5">
                <label for="name" class="visually-hidden">Movie name</label>
                <input type="text" class="form-control" id="name" placeholder="Please enter a movie name">
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary mb-3" onclick="store()">Submit</button>
            </div>
        </div>
    </form>

</div>

<div class="container py-4 px-3 mx-auto">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Datetime</th>
            <th scope="col">Name</th>
            <th scope="col">Operation</th>
        </tr>
        </thead>
        <tbody class="table-group-divider" id="tbody">
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTitle">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBody">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function (){
        movies();
    })
    function trHtml(item){
        return '<tr id="tr_'+item.id+'"><td>'+item.id+'</td>' +
            '<td>'+item.created_at+'</td>' +
            '<td>' + item.name+'</td>' +
            '<td><button type="button" class="btn btn-danger btn-sm" onclick="del('+item.id+')">Delete</button>' + '</td>' +
            '</tr>'
    }
    function del(id){
        $.ajax({
            url: '/api/movies/'+id,
            type: 'DELETE',
            success: function() {
                $('#tr_'+id).remove();
            }
        });
    }
    function movies() {
        $.get('/api/movies', function (data) {
            console.log('get /api/movies success, data=>', data.data);
            $.each(data.data, function (key, item) {
                const tr = trHtml(item);
                $('#tbody').append(tr)
            })
        })
    }
    function store(){
        $.ajax({
            url: '/api/movies', // URL to the server-side script
            type: 'POST',             // GET or POST
            dataType: 'json',        // Expected data type from the server
            data: {name: $('#name').val()},
            success: function(data) {
                // Assuming data is an array of items
                $('#name').val('');
                console.log('ajax success=>', data);
                const tr = '<tr><td>'+data.data.id+'</td><td>'+data.data.created_at+'</td><td>' +
                    data.data.name+'</td><td><button type="button" class="btn btn-danger btn-sm" onclick="del('+data.data.id+')">Delete</button></td></tr>'
                $('#tbody').append(tr)
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle errors here
                console.log('AJAX error jqXHR', jqXHR);
                console.log('AJAX error jqXHR', jqXHR.responseJSON);
                console.log('AJAX error textStatus', textStatus);
                console.log('AJAX error errorThrown', errorThrown);
                const myModal = new bootstrap.Modal('#modal', {
                    keyboard: false, backdrop: true
                })
                $('#modalTitle').html('Error');
                $('#modalBody').html(jqXHR.responseJSON.message);
                myModal.show();
            }
        });
    }
</script>
</body>
</html>
