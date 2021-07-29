@extends('larnr::layouts.master')

@section('title', $article->title)
@section('keywords', $article->keywords)
@section('description', $article->description)
@section('og_type', 'article')
@section('og_url', url('article/'. $article->slug))
@section('og_image', $article->image_path? url('storage/'.$article->image_path) : null)
@section('og_video', $article->video_path? url('storage/'.$article->video_path) : null)
@section('author', ($article->user)? $article->user->fname .' '. $article->user->lname : null)
@section('canonical', $article->canonical)

@section('content')
<div class="container">
    <div class="row mx-0 mx-md-none">
        <div class="col-md-9 p-0 py-sm-2">
            <div class="card mx-0 mt-2 m-md-2 mx-md-none">
                @if(isset($article->video_path))
                    <x-video poster="{{ url('storage/'.$article->image_path) }}" src="{{$article->video_path}}" type="video/youtube" />

                @else
                    <div class="mt-0" style="height:fit-content; max-height: 350px; overflow: hidden; margin-top: -100px">
                        <img width="100%" src="{{ ($article->image_path)? url('storage/'.$article->image_path) : url('images/image-upload.jpg') }}" alt="{{$article->title}}" />
                    </div>
                @endif
                <div class="card-header my-auto">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="my-auto">{{$article->title}}</h5>
                            <small class="my-1 card-text text-muted">
                                <span class="d-none d-sm-inline">Category: </span>{{ $category ?? 'Skill Learning Tutorials' }}
                            </small>

                        </div>
                        <div class="col-md-4 text-md-right">
                            <div class="row">
                                <div class="col-md-12 col-6"><small class="my-1 card-text text-muted">{{$author ?? 'Larnr Education'}} <span class="d-none d-sm-inline"> | </span> {{$article->views}}views </small></div>
                                <div class="col-md-12 col-6 text-right"><button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#subscribeModal">Subscribe</button></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- <h6>Details</h6> --}}
                    {!! $article->details !!}
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-4">
                        <div class="p-2 px-md-2 text-center text-md-left m-0">
                            <button id="like" onclick="like({{$article->id}})" class="btn btn-outline-secondary btn-sm"><i class="fa fa-thumbs-o-up fa-lg" aria-hidden="true"></i> <span id="likeDisp">{{$article->likes}}Likes</span></button>
                            <button id="dislike" onclick="dislike({{$article->id}})" class="btn btn-outline-secondary btn-sm"><i class="fa fa-thumbs-o-down fa-lg" aria-hidden="true"></i> <span id="dislikeDisp">{{$article->dislikes}}Dislikes</span></button>
                        </div>
                    </div>
                    <div class="col-md-8 text-center">
                        <div class="p-2 px-md-2 text-center m-0">
                            <div onclick="share({{$article->id}})" class="addthis_inline_share_toolbox"></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{url('article/comment')}}" method="POST">
                        @csrf
                        <input type="hidden" name="aid" value="{{base64_encode($article->id)}}" />
                        <textarea class="form-control" name="message" placeholder="Enter Your Comment"></textarea>
                        <button type="submit" class="btn btn-primary">Comment Now</button>
                    </form>
                </div>
                <x-comments :messages="$article->comments" />
            </div>
        </div>
        <div class="col-md-3 p-0 py-sm-2">
            <div class="row">
                @foreach ($articles as $article)
                <div class="col-6 col-md-12 my-2">
                    <div class="card box my-0 pb-0 h-100 h-sm-none">
                        <a style="text-decoration: none" href="{{ url('article/'.$article->slug) }}">
                            <div style="height:fit-content; max-height: 350px; overflow: hidden;">
                                <img src="{{($article->image_path)? url('storage/'.$article->image_path) : url('images/image-upload.jpg') }}" class="card-img-top" alt="{{$article->title}}">
                            </div>
                            <div class="card-body p-1 p-sm-3">
                                <h6 class="card-title my-1">{{ Str::substr($article->title, 0, 35) }}...</h6>
                                <small class="d-none d-md-inline card-text text-dark">{{ Str::substr($article->description, 0, 60)}}...</small><br class="d-none d-md-inline">
                                <small class="my-1 card-text text-muted">{{ ($article->user)? $article->user->fname .' '. $article->user->lname : 'Larnr Education' }} <span class="d-none d-sm-inline"> | </span> {{$article->views}}views</small>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6101207219bceae7"></script>
<script>
function like(id){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.post('/article/like',{_token: CSRF_TOKEN, id: id}).then(res=>{
        $('#likeDisp').html(res.count+'Likes');
        $('#like').attr('disabled', true);
        $('#dislike').attr('disabled', true);
    });
}
function dislike(id){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.post('/article/dislike',{_token: CSRF_TOKEN, id: id}).then(res=>{
        $('#dislikeDisp').html(res.count+'Dislikes');
        $('#like').attr('disabled', true);
        $('#dislike').attr('disabled', true);
    });
}
function share(id){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.post('/article/share',{_token: CSRF_TOKEN, id: id}).then(res=>{
        // console.log(res);
        // $('#dislikeDisp').html(res.count+'Shares');
    });
}
function subscribe(id){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.post('/article/share',{_token: CSRF_TOKEN, id: id}).then(res=>{
        // console.log(res);
        // $('#dislikeDisp').html(res.count+'Shares');
    });
}
</script>
@include('larnr::articles.subscribe')
@endsection
