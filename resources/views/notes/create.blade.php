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

                        <!-- حقل التصنيف -->
                        <div class="mb-3">
                            <label for="category" class="form-label fw-bold">التصنيف:</label>
                            <select name="category_id" id="category" class="form-control" required>
                                <option value="">اختر التصنيف</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                                <option value="new_category">إضافة صنف جديد</option> <!-- خيار لإضافة صنف جديد -->
                            </select>
                        </div>

                        <!-- حقل إضافة صنف جديد يظهر فقط إذا تم اختيار "إضافة صنف جديد" -->
                        <div id="newCategoryField" class="mb-3" style="display: none;">
                            <label for="new_category" class="form-label fw-bold">اسم الصنف الجديد:</label>
                            <input type="text" name="new_category" id="new_category" class="form-control" placeholder="أدخل اسم الصنف الجديد">
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
@push('scripts')
<script>
    // التبديل بين حقل الصنف الجديد واختيار التصنيف
    document.getElementById('category').addEventListener('change', function() {
        var newCategoryField = document.getElementById('newCategoryField');
        if (this.value === 'new_category') {
            newCategoryField.style.display = 'block'; // إظهار حقل إضافة الصنف
        } else {
            newCategoryField.style.display = 'none'; // إخفاء حقل إضافة الصنف
        }
    });
</script>
@endpush
