<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Report;

class ReportController extends Controller{
    //List of pending reports
    public function index() {
        $reports = Report::with(['reporter', 'reportable'])
            ->pending()
            ->latest()
            ->paginate(20);
        return view('admin.reports.index', compact('reports'));
    }

    // Admin's action of approving the reported thing
    public function approve(Report $report) {
        abort_if($report->status !== 'pending', 409, 'Report has already been actioned.');
        $report->update(['status' => 'approved']);
        return back()->with('success', 'Report approved — content has been kept.');
    }

    //Admin's action of removiing what is accused
    public function remove(Report $report) {
        abort_if($report->status !== 'pending', 409, 'Report has already been actioned.');

        // SPRINT NOTE: Delete the actual reported content via the polymorphic relation
        $report->reportable?->delete();
        $report->update(['status' => 'removed']);
        return back()->with('success', 'Content removed and report closed.');
    }
}
