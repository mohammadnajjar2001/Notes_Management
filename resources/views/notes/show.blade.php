@extends('layout.app')

@section('title', 'تفاصيل الملاحظة')

@section('content')
    <div class="container mt-5">
        <!-- بطاقة الملاحظة -->
        <div class="card shadow-lg rounded-4">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">تفاصيل الملاحظة</h3>
            </div>
            <div class="card-body">
                <!-- العنوان -->
                <h2 class="card-title text-dark">{{ $note->title ?? 'لا يوجد عنوان' }}</h2>

                <!-- المحتوى -->
                <p class="card-text">{{ $note->content }}</p>

                <hr>

                <!-- تواريخ الإنشاء والتعديل -->
                <div class="d-flex justify-content-between">
                    <small class="text-muted"><strong>تم الإنشاء في:</strong> {{ $note->created_at->format('Y-m-d H:i') }}</small>
                    <small class="text-muted"><strong>آخر تحديث:</strong> {{ $note->updated_at->format('Y-m-d H:i') }}</small>
                </div>

                <!-- أزرار الرجوع والتعديل -->
                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('notes.index') }}" class="btn btn-outline-primary btn-lg">⬅️ العودة للقائمة</a>
                    <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-warning btn-lg">✏️ تعديل</a>
                </div>
            </div>
        </div>
    </div>
@endsection
