@extends('welcome')



@section('content')


@include('header')


<section class="viewUserListing">
    <div class="container card-view b-30">


        @if($isAdmin)
        <div class="row">
            <div class="col-sm-12 text-right">
                <a class="btn btn-danger btn-lg" href="{{ route('userBlock',['userId' => $userPoster->getId()]) }}">Block user</a>
            </div>
        </div>
        @endif





        @if($isAdmin)
        <div class="row">
            <div class="col-sm-12 text-right">
                <a class="btn btn-danger btn-lg" href="{{ route('postBlock',['postId' => $post->getId()]) }}">Block post</a>
            </div>
        </div>
        @endif



<!-- чужой код  -->



</section>

@include('../footer')




@endsection
