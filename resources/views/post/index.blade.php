@extends('layouts.app')
@section('title', 'News-ku')

@section('content')



<div>
    <h1>Selamat Datang {{ Auth::user()->username }}</h1>
    <a href="{{ route('create')}}" class="btn btn-primary">Create</a>
</div>

@foreach ($post as $p)

<div class="card my-4">
    <div class="card-body">
        <h5 class="card-title">{{$p->title}}</h5>
        <i class="card-text">{!! substr($p->content, 0, 50) !!}</i>
        <p class="muted">Created At {{date('d M Y, H:i', strtotime($p->created_at)) }}</p>
        <p>Created By {{ Auth::user()->username }}</p>
    
        <a href="{{ route('show', $p->slug) }}" class="btn btn-secondary">Selengkapnya</a>
        <a href="{{ route('edit', $p->slug) }}" class="btn btn-warning">Edit</a>
    </div>
</div>
@endforeach



@endsection

