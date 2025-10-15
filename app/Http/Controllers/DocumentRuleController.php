<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DocumentRule;

class DocumentRuleController extends Controller
{
   public function index()
    {
        $rules = DocumentRule::all();
        return view('admin.document_rules.index', compact('rules'));
    }

    public function create()
    {
        $formats = ['jpg', 'png', 'pdf','docx', 'xlsx','pptx','txt','zip','csv']; // Hardcoded
        return view('admin.document_rules.create', compact('formats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'formats' => 'required|array',
            'max_size' => 'required|integer|min:1',
        ]);

        DocumentRule::create([
            'name' => $request->name,
            'formats' => implode(',', $request->formats),
            'max_size' => $request->max_size,
        ]);

        return redirect()->route('admin.document-rules.index')->with('success', 'Rule created successfully.');
    }

    // Edit
    public function edit(DocumentRule $documentRule)
    {
   

       $formats = ['jpg', 'png', 'pdf','docx', 'xlsx','pptx','txt','zip','csv']; // Hardcoded
        $selectedFormats = explode(',', $documentRule->formats);
        return view('admin.document_rules.edit', compact('documentRule', 'formats', 'selectedFormats'));
    }
    public function update(Request $request, DocumentRule $documentRule)
    {
        $request->validate([
            'name' => 'required|string',
            'formats' => 'required|array',
            'max_size' => 'required|integer|min:1',
        ]);

        $documentRule->update([
            'name' => $request->name,
            'formats' => implode(',', $request->formats),
            'max_size' => $request->max_size,
        ]);

        return redirect()->route('admin.document-rules.index')->with('success', 'Rule updated successfully.');
    }

    public function destroy(DocumentRule $documentRule)
    {
        $documentRule->delete();
        return redirect()->route('admin.document-rules.index')->with('success', 'Rule deleted successfully.');
    }

}
