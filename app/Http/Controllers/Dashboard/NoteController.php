<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->get('title', '');
        $content = $request->get('content', '');

        $notes = Note::where('title', 'like', "%$title%")
                    ->where('content', 'like', "%$content%")
                    ->get();

        return view('notes.index', compact('notes', 'title', 'content'));
    }

    public function create()
    {
        return view('notes.create');
    }
    // تخزين ملاحظة جديدة
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'sometimes|max:255', // العنوان اختياري
            'content' => 'required|string',
        ]);

        Auth::user()->notes()->create([
            'title' => $request->title ?? "No title", // إذا لم يُرسل العنوان، سيتم استخدام القيمة الافتراضية
            'content' => $request->content,
        ]);

        return redirect()->route('notes.index')->with('add', 'تمت إضافة الملاحظة بنجاح!');
    }

    // عرض ملاحظة معينة
    public function show(Note $note)
    {
        // $this->authorize('view', $note); // التأكد من ملكية الملاحظة
        return view('notes.show', compact('note'));
    }
    // عرض نموذج تعديل ملاحظة
    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }
    // تحديث ملاحظة
    public function update(Request $request, Note $note)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        $note->update($request->only('title', 'content'));
        return redirect()->route('notes.index')->with('update', 'تم تعديل الملاحظة بنجاح!');
    }
    // حذف ملاحظة
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('notes.index')->with('delete', 'تم حذف الملاحظة بنجاح!');
    }
}
