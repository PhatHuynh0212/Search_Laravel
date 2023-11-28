<!DOCTYPE html>
<html>
<head>
    <title>Laravel Search</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
    <body>
        <div class="container">
            <h2 class="title my-4 text-center">Laravel Search</h2><br />
            <div class="row">
            <h2>Total Film : <span id="total_records"></span></h2>
            <div class="col-12">
                <div class="form-group">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search ..." style="background: transparent; border-radius: 90px; border-color: black;"/>
                </div>
                <div class="film-list row mt-4">
                </div>
            </div>    
            </div>
        </div>
        <script>
        $(document).ready(function(){
        
            fetch_customer_data();
        
            function fetch_customer_data(query = '')
            {
                $.ajax({
                    url:"{{ route('action') }}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function(data)
                    {
                        $('.film-list').html(data.table_data);
                        $('#total_records').text(data.total_data);
                    }
                })
            }
        
            $(document).on('keyup', '#search', function(){
                var query = $(this).val();
                fetch_customer_data(query);
            });
        });
        </script>
    </body>
</html>