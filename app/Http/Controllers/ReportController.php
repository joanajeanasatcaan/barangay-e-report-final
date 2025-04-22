<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|max:2048', // Limit to 2MB
        ]);

        $report = new Report();
        $report->user_id = Auth::id();
        $report->title = $request->title;
        $report->description = $request->description;
        $report->status = 'Pending';

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('reports', 'public');
            $report->photo_path = $path;
        }

        $report->save();

        return redirect()->route('dashboard')->with('success', 'Report submitted successfully.');
    }

    public function userDashboard()
    {
        $reports = Auth::user()->reports; // Fetch reports submitted by the authenticated user
        return view('dashboard', compact('reports'));
    }

    public function adminDashboard()
    {
        $reports = Report::all(); // Fetch all reports for admin
        return view('admin.dashboard', compact('reports'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,On Progress,Resolved',
        ]);

        $report = Report::findOrFail($id);
        $report->status = $request->status;
        $report->save();

        return redirect()->back()->with('success', 'Report status updated successfully.');
    }

    public function index()
{
    $reports = Auth::user()->reports; // Fetch reports submitted by the authenticated user
    return view('reports.index', compact('reports')); // Pass $reports to the view
}

public function edit($id)
{
    $report = Report::findOrFail($id);
    if ($report->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }
    return view('reports.edit', compact('report'));
}

public function update(Request $request, $id)
{
    $report = Report::findOrFail($id);
    if ($report->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'photo' => 'nullable|image|max:2048', // Optional new photo
    ]);

    $report->title = $request->title;
    $report->description = $request->description;

    if ($request->hasFile('photo')) {
        // Delete old photo if it exists
        if ($report->photo_path) {
            Storage::disk('public')->delete($report->photo_path);
        }
        $path = $request->file('photo')->store('reports', 'public');
        $report->photo_path = $path;
    }

    $report->save();

    return redirect()->route('reports.index')->with('success', 'Report updated successfully.');
}

public function destroy($id)
{
    $report = Report::findOrFail($id);
    if ($report->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    if ($report->photo_path) {
        Storage::disk('public')->delete($report->photo_path);
    }

    $report->delete();

    return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
}

public function show($id)
{
    $report = Report::findOrFail($id);
    if ($report->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }
    return view('reports.show', compact('report'));
}

public function adminIndex()
{
    $reports = Report::all();
    return view('admin.index', compact('reports'));
}


}
