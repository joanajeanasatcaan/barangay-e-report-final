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
            'location' => 'required|string|max:255',
            'category' => 'required|in:Vandalism,Illegal Gambling,Littering/Garbage Issue,Neighborhood Dispute',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $report = new Report();
        $report->title = $request->title;
        $report->description = $request->description;
        $report->location = $request->location;
        $report->category = $request->category;
        $report->user_id = Auth::id();
        $report->status = 'Pending';

        if ($request->hasFile('photos')) {
            $path = $request->file('photos')->store('reports', 'public');
            $report->photo_path = $path;
        }

        $report->save();

        return redirect()->route('reports.index')->with('success', 'Report submitted successfully.');
    }
    public function userDashboard()
    {
        $reports = Auth::user()->reports;
        return view('dashboard', compact('reports'));
    }

    public function adminDashboard()
    {
        $pendingCount = Report::where('status', 'Pending')->count();
        $onProgressCount = Report::where('status', 'On Progress')->count();
        $resolvedCount = Report::where('status', 'Resolved')->count();

        return view('admin.dashboard', compact('pendingCount', 'onProgressCount', 'resolvedCount'));
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
        $reports = Report::where('user_id', Auth::id())->get();
        return view('reports.index', compact('reports'));
    }

    public function edit($id)
    {
        $report = Report::findOrFail($id);
        if ($report->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('reports.edit', compact('report'));
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

    public function showAdmin($id)
    {
        $report = Report::findOrFail($id);

        return view('admin.show', compact('report'));
    }

    public function adminIndex(Request $request)
    {
        $query = Report::query();

        $reports = $query->orderBy('created_at', 'desc')->paginate(9);
        $totalReports = Report::count();

        return view('admin.index', compact('reports', 'totalReports'));
    }
}
