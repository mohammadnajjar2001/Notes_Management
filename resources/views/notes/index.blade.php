<!-- resources/views/notes/index.blade.php -->
@extends('layout.app')

@section('content')
<div class="container mt-5">

    <!-- عنوان الصفحة -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">📋 قائمة الملاحظات</h1>
        <a href="{{ route('notes.create') }}" class="btn btn-success">➕ إضافة ملاحظة جديدة</a>
    </div>

    <!-- إشعارات العمليات -->
    @if (session('add'))
        <div class="alert alert-success">{{ session('add') }}</div>
    @endif
    @if (session('update'))
        <div class="alert alert-info">{{ session('update') }}</div>
    @endif
    @if (session('delete'))
        <div class="alert alert-danger">{{ session('delete') }}</div>
    @endif

    <!-- زر إظهار/إخفاء البحث -->
    <button id="toggleFilter" class="btn btn-warning mb-3">
        <i class="fa fa-search search-icon"></i> بحث
    </button>

    <!-- نموذج البحث -->
    <div id="filterTable" style="display: none;">
        <form action="{{ URL::current() }}" method="GET" class="form-control p-3">
            <h3 class="text-center">🔍 البحث في الملاحظات</h3>
            <div class="row mb-3">
                <!-- فلترة العنوان -->
                <div class="col-md-4">
                    <label for="title">العنوان:</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ request('title') }}">
                </div>

                <!-- فلترة المحتوى -->
                <div class="col-md-4">
                    <label for="content">المحتوى:</label>
                    <input type="text" name="content" id="content" class="form-control" value="{{ request('content') }}">
                </div>

                <!-- فلترة حسب المفضلة -->
                <div class="col-md-4">
                    <label for="is_favorite">الحالة:</label>
                    <select name="is_favorite" id="is_favorite" class="form-control">
                        <option value="">الكل</option>
                        <option value="1" {{ request('is_favorite') == '1' ? 'selected' : '' }}>⭐️ مفضلة</option>
                        <option value="0" {{ request('is_favorite') == '0' ? 'selected' : '' }}>☆ غير مفضلة</option>
                    </select>
                </div>

                <!-- فلترة التصنيف -->
                <div class="col-md-4">
                    <label for="category_id">التصنيف:</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">الكل</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- أزرار البحث والتصفية -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary mx-2">🔎 ابحث</button>
                <a href="{{ URL::current() }}" class="btn btn-info mx-2">🧹 مسح الفلترة</a>
            </div>
        </form>
    </div>

    <!-- عرض الملاحظات -->
    @if ($notes->isNotEmpty())
        <div class="row">
            @foreach ($notes as $note)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm rounded-4">
                        <div class="card-body">

                            <!-- العنوان والمحتوى -->
                            <h5 class="card-title fw-bold">
                                @if($note->is_favorite)
                                    ⭐️
                                @endif
                                {{ $note->title }}
                            </h5>
                            <p class="card-text">{{ $note->content }}</p>

                            <!-- التصنيف -->
                            <p class="text-muted small">
                                📂 التصنيف: {{ $note->category ? $note->category->name : 'غير محدد' }}
                            </p>

                            <!-- وقت الإنشاء ووقت التعديل -->
                            <p class="text-muted small">
                                🕒 أُنشئت: {{ $note->created_at->format('Y-m-d H:i') }} | ✍️ آخر تعديل: {{ $note->updated_at->format('Y-m-d H:i') }}
                            </p>

                            <!-- الأزرار: عرض - تعديل - حذف - مفضلة -->
                            <div class="d-flex justify-content-between">
                                <!-- عرض التفاصيل -->
                                <a href="{{ route('notes.show', $note->id) }}" class="btn btn-info btn-sm">👁️ عرض</a>

                                <!-- تعديل الملاحظة -->
                                <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-warning btn-sm">✏️ تعديل</a>

                                <!-- حذف الملاحظة -->
                                <form action="{{ route('notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه الملاحظة؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">🗑️ حذف</button>
                                </form>

                                <!-- زر تحديد كمفضلة -->
                                <form action="{{ route('notes.favorite', $note->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn {{ $note->is_favorite ? 'btn-success' : 'btn-outline-secondary' }} btn-sm">
                                        {{ $note->is_favorite ? '⭐️ مفضلة' : '☆ إضافة للمفضلة' }}
                                    </button>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    @else
        <div class="alert alert-info text-center">
            📌 لا توجد ملاحظات حتى الآن.
            <a href="{{ route('notes.create') }}" class="alert-link">أضف أول ملاحظة الآن!</a>
        </div>
    @endif

</div>
@endsection

@push('scripts')
<script>
    // إظهار/إخفاء جدول البحث
    document.getElementById('toggleFilter').addEventListener('click', function() {
        const filterTable = document.getElementById('filterTable');
        filterTable.style.display = (filterTable.style.display === 'none') ? 'block' : 'none';
    });
</script>
@endpush
