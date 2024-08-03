@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">الرئيسية - تفاصيل المنتج</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                            <li class="breadcrumb-item active">تفاصيل المنتج</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <!-- Media Display -->
                        <div class="row">
                            @foreach($product->media as $index => $media)
                                <div class="col-md-2 mb-3">
                                    @if($media->type === 'image')
                                        <a data-toggle="modal" data-target="#mediaModal{{ $index }}">
                                            <img src="{{ asset('storage/' . $media->image) }}" class="img-fluid" alt="{{ $product->name }} - Image {{ $index + 1 }}" style="width: 150px; height: 100px; object-fit: cover;">
                                        </a>
                                    @elseif($media->type === 'video')
                                        <a data-toggle="modal" data-target="#mediaModal{{ $index }}">
                                            <img src="{{ asset('path-to-video-thumbnail.jpg') }}" class="img-fluid" alt="{{ $product->name }} - Video {{ $index + 1 }}" style="width: 150px; height: 100px; object-fit: cover;">
                                            <i class="fas fa-play video-icon"></i>
                                        </a>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Modals for each media item -->
                        @foreach($product->media as $index => $media)
                            <div class="modal fade" id="mediaModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="mediaModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            @if($media->type === 'image')
                                                <img src="{{ asset('storage/' . $media->image) }}" class="img-fluid" alt="{{ $product->name }} - Image {{ $index + 1 }}">
                                            @elseif($media->type === 'video')
                                                <video controls width="100%" height="auto">
                                                    <source src="{{ asset('storage/' . $media->image) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="card-body text-center">
                            <h2>{{ $product->name }}</h2>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>الوصف</strong><br>{{ $product->description }}</li>
                                <li class="list-group-item"><strong>السعر</strong><br>{{ $product->price }}</li>
                                <li class="list-group-item"><strong>الكود</strong><br>{{ $product->code }}</li>
                                <li class="list-group-item"><strong>الحالة</strong><br>{{ $product->status == 'Available' ? 'متوفر' : 'غير متوفر' }}</li>
                                <li class="list-group-item"><strong>القسم</strong><br>{{ $product->category->name }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
