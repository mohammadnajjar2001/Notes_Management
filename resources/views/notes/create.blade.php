<!-- resources/views/notes/create.blade.php -->
@extends('layout.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-primary text-white text-center fs-4">
                    إضافة ملاحظة جديدة
                </div>
                <div class="card-body">

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

                    <!-- نموذج إضافة ملاحظة -->
                    <form action="{{ route('notes.store') }}" method="POST">
                        @csrf

                        <!-- حقل العنوان -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">العنوان:</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" placeholder="أدخل عنوان الملاحظة">
                        </div>

                        <!-- حقل المحتوى -->
                        <div class="mb-3">
                            <label for="content" class="form-label fw-bold">المحتوى:</label>
                            <textarea name="content" id="content" class="form-control" rows="5" required placeholder="أدخل محتوى الملاحظة">{{ old('content') }}</textarea>
                        </div>

                        <!-- أزرار الإرسال والعودة -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('notes.index') }}" class="btn btn-outline-secondary">العودة إلى القائمة</a>
                            <button type="submit" class="btn btn-primary">إضافة الملاحظة</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
