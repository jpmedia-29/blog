<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>@yield('title')</title>
  </head>
  <body>
    
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">Blog</a>
        @if (Auth::check())
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
        @else
            <a class="btn btn-outline-primary" href="{{ route('register') }}">Register</a>
        @endif
  </nav>

  <div class="container mt-5">
    @yield('content')
  </div>
  

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#like-btn').click(function() {
                var blogId = $(this).data('blog-id');
                var button = $(this);
                var icon = $('#like-icon'); 
                var likeCount = $('#like-count'); 
                $.ajax({
                    url: '/blog/' + blogId + '/like',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        likeCount.text(response.like_count);
                        if (response.status === 'liked') {
                            icon.removeClass('fa-regular fa-thumbs-up').addClass('fa-solid fa-thumbs-up');
                        } else if (response.status === 'unliked') {
                            icon.removeClass('fa-solid fa-thumbs-up').addClass('fa-regular fa-thumbs-up');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('Anda harus login terlebih dahulu');
                        window.location.href = '/login'; 
                    }
                });
            });
        });

        $('form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var data = form.serialize();

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(response) {
                    if (response.status === 'success') {
                        location.reload(); 
                    } else {
                        alert('Ada masalah. Coba lagi!');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('Anda harus login terlebih dahulu');
                    window.location.href = '/login'; 

                }
            });
        });
    </script>    
  </body>
</html>
