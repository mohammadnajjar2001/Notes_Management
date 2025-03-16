<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all(); // جلب جميع التصنيفات

        $title = $request->get('title', '');
        $content = $request->get('content', '');
        $is_favorite = $request->get('is_favorite', null);
        $category_id = $request->get('category_id', null); // استقبال category_id من الطلب

        // جلب فقط الملاحظات الخاصة بالمستخدم المسجل دخوله
        $notes = Note::where('user_id', Auth::id())
            ->where('title', 'like', "%$title%")
            ->where('content', 'like', "%$content%");

        // تطبيق الفلترة حسب الحالة (مفضلة أو غير مفضلة)
        if (!is_null($is_favorite)) {
            $notes->where('is_favorite', $is_favorite);
        }

        // تطبيق الفلترة حسب التصنيف إذا تم تحديده
        if (!is_null($category_id)) {
            $notes->where('category_id', $category_id);
        }

        $notes = $notes->get();

        return view('notes.index', compact('notes', 'title', 'content', 'is_favorite', 'categories', 'category_id'));
    }



    public function toggleFavorite(Note $note)
    {
        // تأكد من أن المستخدم لديه الحق في تغيير حالة المفضلة
        $note->update(['is_favorite' => !$note->is_favorite]);
        return redirect()->back()->with('success', 'تم تحديث حالة المفضلة بنجاح!');
    }

    public function create()
    {
        $user = Auth::user();
        $categories = Category::where('user_id', $user->id)->get();
        return view('notes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        // إذا اختار المستخدم إضافة صنف جديد
        if ($request->has('new_category') && $request->new_category) {
            $category = Category::create([
                'name' => $request->new_category,
                'user_id'=> $user->id,
            ]);
            $category_id = $category->id; // الحصول على ID الصنف الجديد
        } else {
            // إذا تم اختيار صنف موجود
            $category_id = $request->category_id;
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'new_category' => 'nullable|string|max:255', // التأكد من أن اسم الصنف الجديد ليس فارغًا
        ]);


        // إضافة الملاحظة مع التصنيف
        Note::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $category_id,
            'user_id' => Auth::id(), // ربط الملاحظة بالمستخدم الحالي
        ]);

        return redirect()->route('notes.index')->with('add', 'تمت إضافة الملاحظة بنجاح!');
    }



    // عرض ملاحظة معينة
    public function show(Note $note)
    {
        // تأكد من أن الملاحظة لها تصنيف
        return view('notes.show', compact('note'));
    }

    // عرض نموذج تعديل ملاحظة
    public function edit(Note $note)
    {
        // تمرير التصنيفات للمستخدم عند التعديل
        $categories = Category::all();
        return view('notes.edit', compact('note', 'categories'));
    }

    // تحديث ملاحظة
    public function update(Request $request, Note $note)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id', // إضافة تحقق من التصنيف
        ]);

        // تحديث الملاحظة مع التصنيف
        $note->update($request->only('title', 'content', 'category_id'));

        return redirect()->route('notes.index')->with('update', 'تم تعديل الملاحظة بنجاح!');
    }

    // حذف ملاحظة
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('notes.index')->with('delete', 'تم حذف الملاحظة بنجاح!');
    }
}
