<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CustomList;
use App\Models\Report;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function create(Request $request)
    {
        return view('reports.create', [
            'type' => $request->get('type'),
            'id' => $request->integer('id'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => ['required', 'in:user,review,comment,list'],
            'id' => ['required', 'integer'],
            'reason' => ['required', 'in:spam,harassment,hate,inappropriate,spoilers_not_marked,impersonation,other'],
            'details' => ['nullable', 'string', 'max:1200'],
        ]);

        $class = match ($data['type']) {
            'user' => User::class,
            'review' => Review::class,
            'comment' => Comment::class,
            'list' => CustomList::class,
        };

        abort_unless($class::query()->whereKey($data['id'])->exists(), 404);

        Report::firstOrCreate(
            [
                'reporter_user_id' => $request->user()->id,
                'reportable_type' => $class,
                'reportable_id' => $data['id'],
                'reason' => $data['reason'],
            ],
            ['details' => $data['details'], 'status' => 'open'],
        );

        return redirect()->route('reports.thanks')->with('status', 'Report submitted.');
    }

    public function thanks()
    {
        return view('reports.thanks');
    }
}
