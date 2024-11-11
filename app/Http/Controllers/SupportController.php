<?php

namespace App\Http\Controllers;

use App\Models\Support;
use App\Http\Requests\StoreSupportRequest;
use App\Http\Requests\UpdateSupportRequest;
use App\Http\Resources\SupportResource;

class SupportController extends Controller
{

    public function index()
    {
        $supports = Support::with('user')->orderBy('id','desc')->get();
        $supports = SupportResource::collection($supports);
        return view('support.index', compact('supports'));
    }

    public function store(StoreSupportRequest $request)
    {
        $validData = $request->validated();
        $validData['user_id'] = $request->user()->id;
        $support = Support::create($validData);
        return $this->apiResponse($support, 'created');
    }

    public function show(Support $support)
    {
        $support->load('user');
        return view('support.show', compact('support'));
    }
    public function updateStatus(Support $support, $status)
    {
        $support->update([
            'status' => $status
        ]);
        return to_route('support.show', ['support' => $support->id]);
    }
}
