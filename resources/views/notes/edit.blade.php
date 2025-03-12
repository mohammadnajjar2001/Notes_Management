<!-- resources/views/notes/edit.blade.php -->
@extends('layout.app')

@section('content')
<div class="container mt-5">

    <!-- عنوان الصفحة -->
    <div class="text-center mb-4">
        <h1 class="text-primary">✏️ تعديل الملاحظة</h1>
    </div>

    <!-- عرض الأخطاء -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- نموذج تعديل الملاحظة -->
    <div class="card shadow-lg rounded-4">
        <div class="card-body">

            <form action="{{ route('notes.update', $note->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- حقل العنوان -->
                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">العنوان:</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $note->title) }}" required placeholder="أدخل عنوان الملاحظة">
                </div>

                <!-- حقل المحتوى -->
                <div class="mb-4">
                    <label for="content" class="form-label fw-bold">المحتوى:</label>
                    <textarea name="content" id="content" class="form-control" rows="5" required placeholder="أدخل محتوى الملاحظة">{{ old('content', $note->content) }}</textarea>
                </div>

                <!-- أزرار الحفظ والعودة -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('notes.index') }}" class="btn btn-outline-secondary">⬅️ العودة إلى القائمة</a>
                    <button type="submit" class="btn btn-primary">💾 تحديث الملاحظة</button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
