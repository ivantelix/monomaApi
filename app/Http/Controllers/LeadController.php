<?php

namespace App\Http\Controllers;

use App\Actions\CreateLeadAction;
use App\Actions\GetLeadAction;
use App\Actions\ListLeadAction;
use App\Http\Requests\Lead\CreateLeadRequest;
use Illuminate\Auth\Access\AuthorizationException;
use App\Models\Lead;
use Illuminate\Http\JsonResponse;

class LeadController extends Controller
{
    public function index(ListLeadAction $action): JsonResponse
    {
        $res = $action->handle();

        if (isset($res)) {
            return response()->json($res, 200);
        } else {
            return response()->json('Bad Request', 400);
        }
    }

    /**
     * @throws AuthorizationException
     */
    public function create(CreateLeadRequest $request, CreateLeadAction $actioin): JsonResponse
    {
        $this->authorize('create', Lead::class);
        $res = $actioin->handle($request->validated());

        if (isset($res)) {
            return response()->json($res, 201);
        } else {
            return response()->json('Bad Request', 400);
        }
    }

    public function get($lead, GetLeadAction $action): JsonResponse
    {
        $lead = $action->handle($lead);

        if (isset($lead)) {
            return response()->json($lead, 200);
        } else {
            return response()->json('Bad Request', 400);
        }
    }
}
