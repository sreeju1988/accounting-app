<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\DocumentRule;
use App\Models\ServiceDocument;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('documents.documentRule')->latest()->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $documentRules = DocumentRule::all();
        return view('admin.services.create', compact('documentRules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'short_description' => 'nullable',
            'deadline' => 'nullable|date',
            'document_rules' => 'array'
        ]);

        $service = Service::create($request->only(['name', 'short_description', 'description', 'deadline']));

        if ($request->has('document_rules')) {
            foreach ($request->document_rules as $ruleId) {
                ServiceDocument::create([
                    'service_id' => $service->id,
                    'document_rule_id' => $ruleId,
                ]);
            }
        }

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        $documentRules = DocumentRule::all();
        $selectedRules = $service->documents->pluck('document_rule_id')->toArray();
        return view('admin.services.edit', compact('service', 'documentRules', 'selectedRules'));
    }

    

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required',
            'deadline' => 'nullable|date',
        ]);

        $service->update($request->only(['name', 'short_description', 'status', 'description', 'deadline']));

        ServiceDocument::where('service_id', $service->id)->delete();
        if ($request->has('document_rules')) {
            foreach ($request->document_rules as $ruleId) {
                ServiceDocument::create([
                    'service_id' => $service->id,
                    'document_rule_id' => $ruleId,
                ]);
            }
        }

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
