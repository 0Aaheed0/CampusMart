<?php

namespace App\Http\Controllers;

use App\Models\HelpBoard;
use Illuminate\Http\Request;

class HelpBoardController extends Controller
{
    public function index()
    {
        $helpBoards = HelpBoard::all();
        return view('helpboard.index', compact('helpBoards'));
    }

    // Admin: Show all FAQs for management
    public function adminIndex()
    {
        $faqs = HelpBoard::latest()->paginate(10);
        return view('admin.faq_index', compact('faqs'));
    }

    // Admin: Show create FAQ form
    public function adminCreate()
    {
        return view('admin.faq_create');
    }

    // Admin: Store new FAQ
    public function adminStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'answer' => 'required|string|min:10',
        ], [
            'title.required' => 'FAQ title is required',
            'title.max' => 'Title cannot exceed 255 characters',
            'answer.required' => 'Answer is required',
            'answer.min' => 'Answer must be at least 10 characters',
        ]);

        HelpBoard::create($validated);

        return redirect()->route('admin.faq')->with('success', '✅ FAQ created successfully!');
    }

    // Admin: Show edit FAQ form
    public function adminEdit(HelpBoard $faq)
    {
        return view('admin.faq_edit', compact('faq'));
    }

    // Admin: Update FAQ
    public function adminUpdate(Request $request, HelpBoard $faq)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'answer' => 'required|string|min:10',
        ], [
            'title.required' => 'FAQ title is required',
            'title.max' => 'Title cannot exceed 255 characters',
            'answer.required' => 'Answer is required',
            'answer.min' => 'Answer must be at least 10 characters',
        ]);

        $faq->update($validated);

        return redirect()->route('admin.faq')->with('success', '✅ FAQ updated successfully!');
    }

    // Admin: Delete FAQ
    public function adminDestroy(HelpBoard $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faq')->with('success', '✅ FAQ deleted successfully!');
    }
}
