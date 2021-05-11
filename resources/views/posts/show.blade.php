<!DOCTYPE html>
<html lang="en">
  <head>
    <title>cms laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

     <link rel="stylesheet" href="{{asset('css/animate.css')}}">

    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('css/aos.css')}}">

 
    <link rel="stylesheet" href="{{asset('css/flaticon.css')}}">
     <link rel="stylesheet" href="{{asset('css/style.css')}}">
  </head>
  <body>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm"  text-dark navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item dropdown">
                              <a class="nav-link  " href="{{route('posts.index')}}">posts</a>
                             </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


   
    <!-- END nav -->

  <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{asset('storage/'.$post->image)}}');" data-stellar-background-ratio="0.5">
       <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate pb-5 text-center">
          <h2 class="mb-3 bread text-dark">{{$post->title}}</h2>
          <p class="text-dark">{{$post->description}}</p>
           </div>
        </div>
      </div>
    </section>

   <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 ftco-animate">
          <div>category : {{ $post->category->name }}</div>

            content : {!! $post->content !!}
            <div class="tag-widget post-tag-container mb-5 mt-5">
              <div class="tagcloud">tags : 
                @foreach ($post->tags as $tag)
                <a href="#" class="tag-cloud-link">{{ $tag->name }}</a>
                @endforeach
              </div>
            </div>

            <div class="about-author d-flex p-4 bg-light">
              <div class="bio mr-5">
                <img src="{{ $user->hasPicture() ? asset('storage/'.$user->getPicture()) : $user->getGravatar() }}" alt="Image placeholder"   width="300px" height="300px" style="border-radius: 50%" class="img-fluid mb-4">
              </div>
              <div class="desc">
              <h3>auther : {{ $user->name }}</h3>
              <p>about auther : {{ $profile->about }}</p>
              </div>
            </div>


            <div class="pt-5 mt-5">
              <h3 class="mb-5">{{$comments->count()}} Comments</h3>
              <ul class="comment-list">
               
               @foreach($comments as $comment)

               <li class="comment">
                  <div class="vcard bio">
                    <img src="{{ $comment->user->hasPicture() ? asset('storage/'.$comment->user->getPicture()) : $comment->user->getGravatar() }}"  >
                  </div>
                  <div class="comment-body">
                    <h3>{{$comment->user->name}}</h3>
                    <div class="meta mb-3">{{$comment->created_at}}</div>
                    <p>{{$comment->content}}</p>
                   </div>
                </li>

               @endforeach
              </ul>
              <!-- END comment-list -->

             @if(Auth::check())
             <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Leave a comment</h3>
                <form action="{{route('comments.store')}}" method="post" class="p-5 bg-light">
                   @csrf
                      <input type="hidden" name="id_post" value="{{$post->id}}">
                  <div class="form-group">
                    <label for="message">comment</label>
                    <textarea name="comment"  cols="25" rows="8" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Post Comment" class="btn py-3 px-4 btn-primary">
                  </div>

                </form>
              </div>
              @endif
            </div>
            

          </div> <!-- .col-md-8 -->
          <div class="col-lg-4 sidebar pl-lg-5 ftco-animate">
             
            <div class="sidebar-box ftco-animate">
              <div class="categories">
                <h3> our Categories</h3>
                @foreach ($categories as $category)
                  <li>{{$category->name}} <span class="ion-ios-arrow-forward"></span></li>
                @endforeach
              </div>
            </div>
 
            <div class="sidebar-box ftco-animate">
              <h3>our tags </h3>
              <div class="tagcloud">  
                 @foreach($tags as $tag) 
                      <a  class="tag-cloud-link">{{$tag->name}}</a> 
                  @endforeach 
              </div>
            </div>

            <div class="sidebar-box ftco-animate">
              <h3>Paragraph</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
            </div>
          </div>

        </div>
      </div>
    </section>
    
    
    

    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">

            <div class="ftco-footer-widget mb-4">
              <h2 class="logo"><a href="/">cms<span>larvel</span>.</a></h2>
              <p>we can build any website for you</p>
               
            </div>
          </div>

            

          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Information</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>facebook</a></li>
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>instgram</a></li>
                <li><a href="#" class="py-1 d-block"><span class="ion-ios-arrow-forward mr-3"></span>whatsapp</a></li>
               </ul>
            </div>
          </div>

          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">cairo egypt </span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">01100795161</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">fouadmohamedfouad67@gmail.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          
        </div>
      </div>
    </footer>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{asset('js/popper.min.js')}}"></script>
   <script src="{{asset('js/jquery.easing.1.3.js')}}"></script>
  <script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('js/jquery.stellar.min.js')}}"></script>
  <script src="{{asset('js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{asset('js/aos.js')}}"></script>
  <script src="{{asset('js/jquery.animateNumber.min.js')}}"></script>
  <script src="{{asset('js/scrollax.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>

  </body>
</html>
