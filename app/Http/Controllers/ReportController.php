<?php
namespace App\Http\Controllers;
use App\Models\Report;
use Illuminate\Http\Request;
class ReportController extends Controller {
    //List of reportable things
    private array $allowedTypes = ['question' => \App\Models\Question::class, 'answer'=> \App\Models\Answer::class,'experience' => \App\Models\Experience::class, 'message'=> \App\Models\Message::class];
    public function store(Request $request, string $type, int $id) {

        // Reject unknown content type just in case
        abort_unless(array_key_exists($type, $this->allowedTypes), 404);
        $request->validate(['reason'=> 'required|string|max:500']);
        $modelClass = $this->allowedTypes[$type];

        //Check if the content exists in the first place for reporting
        $modelClass::findOrFail($id);

        //an user can't report something more than once
        $alreadyReported = Report::where('reporter_id', auth()->id())
            ->where('reportable_type', $modelClass)
            ->where('reportable_id', $id)
            ->exists();
        if ($alreadyReported) return back()->with('report_error', 'You have already reported this content.');
        Report::create(['reporter_id' => auth()->id(),'reportable_type' => $modelClass,'reportable_id'=> $id,'reason'=> $request->reason,'status'=> 'pending']);
        return back()->with('success', 'Report submitted. Our team will review it.');
    }
}
