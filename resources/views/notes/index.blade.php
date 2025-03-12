<!-- resources/views/notes/index.blade.php -->
@extends('layout.app')

@section('content')
<div class="container mt-5">

    <!-- عنوان الصفحة -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">📋 قائمة الملاحظات</h1>
        <a href="{{ route('notes.create') }}" class="btn btn-success">➕ إضافة ملاحظة جديدة</a>
    </div>
    @if (@session('add'))
        <div class="alert alert-success">
            {{ session('add') }}
        </div>
    @endif
    @if (session('update'))
        <div class="alert alert-info">
            {{ session('update') }}
        </div>
    @endif
    @if (session('delete'))
        <div class="alert alert-danger">
            {{ session('delete') }}
        </div>
    @endif

    <button id="toggleFilter" class="btn btn-warning mb-3"><i class="fa fa-search search-icon" id="toggleFilterForm"></i>
        بحث
    </button>

    <div id="filterTable" style="display: none;">
        <table class="form-control d-flex justify-content">
            <tr>
                <td colspan="6">
                    <center>
                        <h1><i><code>ابحث حسب العنوان او المحتوى او كليهما</code></h1></i>
                    </center>
                </td>
            </tr>
            <tr>
                <th style="padding-left: 10px;">العنوان</th>
                <th style="padding-left: 10px;">المحتوى</th>
            </tr>

            <tr>
                <form action="{{ URL::current() }}" class="form-control d-flex justify-content" method="GET">
                    <!-- فلترة العنوان -->
                    <td><input type="text" name="title" class="form-control mx-2" value="{{ $title }}"></td>

                    <!-- فلترة المحتوى -->
                    <td><input type="text" name="content" class="form-control mx-2" value="{{ $content }}"></td>
                </tr>

                <!-- أزرار الفلترة والتنظيف أسفل المدخلات -->
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <button class="btn btn-primary mx-2" style="margin: 5px 0px;" type="submit">ابحث</button>
                        <a href="{{ URL::current() }}"><button class="btn btn-info mx-2" style="margin: 5px 0px;" type="button">مسح نتيجة البحث</button></a>
                    </td>
                </tr>
                </form>
            </table>
        </div>





    <!-- عرض الملاحظات -->
    @if ($notes->isNotEmpty())
        <div class="row">
            @foreach ($notes as $note)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm rounded-4">
                    <div class="card-body">

                        <!-- العنوان والمحتوى -->
                        <h5 class="card-title fw-bold">{{ $note->title }}</h5>
                        <p class="card-text">{{ $note->content }}</p>

                        <!-- وقت الإنشاء ووقت آخر تعديل -->
                        <p class="text-muted small">
                            🕒 أُنشئت: {{ $note->created_at->format('Y-m-d H:i') }} | ✍️ آخر تعديل: {{ $note->updated_at->format('Y-m-d H:i') }}
                        </p>

                        <div class="d-flex justify-content-between">
                            <!-- زر عرض التفاصيل -->
                            <a href="{{ route('notes.show', $note->id) }}" class="btn btn-info btn-sm">👁️ عرض</a>

                            <!-- زر تعديل -->
                            <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-warning btn-sm">✏️ تعديل</a>

                            <!-- نموذج الحذف -->
                            <form action="{{ route('notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه الملاحظة؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">🗑️ حذف</button>
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
        document.getElementById('toggleFilter').addEventListener('click', function() {
            const filterTable = document.getElementById('filterTable');
            if (filterTable.style.display === 'none') {
                filterTable.style.display = 'block';
            } else {
                filterTable.style.display = 'none';
            }
        });
    </script>
@endpush
