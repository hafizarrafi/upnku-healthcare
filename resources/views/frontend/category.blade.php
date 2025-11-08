@extends('layouts.customer')

@section('title')
    Category
@endsection

@section('content')
<style>
    /* efek zoom */
    .zoom {
        position: relative;
        overflow: hidden;
    }

    .zoom img {
        transition: transform 0.5s ease, filter 0.5s ease;
        filter: brightness(60%); /* gambar gelap default */
    }

    .zoom:hover img {
        transform: scale(1.1);
        filter: brightness(40%); /* makin gelap saat hover */
    }
</style>

<div class="py-5 my-5">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-12">
                <h2 class="fw-semibold">All Categories</h2>
            </div>
        </div>

        <div class="row g-4">
            @foreach ($category as $cate)
                <div class="col-md-4">
                    <a href="{{ url('view-category/'.$cate->slug) }}" class="text-decoration-none">
                        <div class="zoom rounded shadow-sm">
                            <img src="{{ asset('upload/category/'.$cate->image) }}"
                                 class="w-100 rounded"
                                 style="height:200px; object-fit:cover;"
                                 alt="{{ $cate->name }}">
                            <div class="position-absolute top-50 start-50 translate-middle text-light text-center">
                                <h5 class="m-0 text-uppercase fw-semibold" style="letter-spacing:2px;">
                                    {{ $cate->name }}
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
