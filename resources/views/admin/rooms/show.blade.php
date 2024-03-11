@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"> الرئيسية - تفاصيل الغرفة</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/dashboard">الرئيسية</a></li>
                            <li class="breadcrumb-item active">تفاصيل الغرفة</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <!-- You can replace 'room' with the appropriate variable containing room details -->
                        <div class="row">
                            @foreach($room->media as $index => $media)
                                <div class="col-md-2 mb-3">
                                    @if($media->type === 'image')
                                        <a data-toggle="modal" data-target="#mediaModal{{ $index }}">
                                            <img src="{{ asset('storage/' . $media->image) }}" class="img-fluid" alt="{{ $room->name }} - Image {{ $index + 1 }}" style="width: 150px; height: 100px; object-fit: cover;">
                                        </a>
                                    @elseif($media->type === 'video')
                                        <a data-toggle="modal" data-target="#mediaModal{{ $index }}">
                                            <img src="{{ asset('path-to-video-thumbnail.jpg') }}" class="img-fluid" alt="{{ $room->name }} - Video {{ $index + 1 }}" style="width: 150px; height: 100px; object-fit: cover;">
                                            <i class="fas fa-play video-icon"></i>
                                        </a>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Modals for each media item -->
                        @foreach($room->media as $index => $media)
                            <div class="modal fade" id="mediaModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="mediaModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            @if($media->type === 'image')
                                                <img src="{{ asset('storage/' . $media->image) }}" class="img-fluid" alt="{{ $room->name }} - Image {{ $index + 1 }}">
                                            @elseif($media->type === 'video')
                                            <!-- Use a video player here -->
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
                            <h2>{{ $room->name }}</h2>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>الوصف</strong><br>{{ $room->description }}</li>
                                <li class="list-group-item"><strong>السعر</strong><br>{{ $room->price }}</li>
                                <li class="list-group-item"><strong>السعة</strong><br>{{ $room->capacity }}</li>
                                <li class="list-group-item"><strong>العدد المتاح</strong><br>{{ $room->available_count }}</li>
                                <li class="list-group-item"><strong>مساحة الغرفة</strong><br>{{ $room->area }}</li>
                                <li class="list-group-item"><strong>الفندق</strong><br>{{ $room->hotel->name }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
