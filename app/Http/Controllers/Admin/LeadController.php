<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LeadIndexRequest;
use App\Models\Lead;
use Illuminate\Contracts\View\View;

class LeadController extends Controller
{
    public const STATUSES = ['new', 'contacted', 'qualified', 'closed', 'spam'];

    public function index(LeadIndexRequest $request): View
    {
        $filters = $request->validated();

        $base = Lead::query();

        $leads = (clone $base)
            ->filter($filters)      // scope en el modelo
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $counts = (clone $base)
            ->filter($filters, ignoreStatus: true) // mismo filtro pero sin status (para que KPIs reflejen el resto)
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->all();

        // normalizamos faltantes
        foreach (self::STATUSES as $st) {
            $counts[$st] = $counts[$st] ?? 0;
        }

        return view('admin.leads.index', [
            'leads' => $leads,
            'statuses' => self::STATUSES,
            'counts' => $counts,
        ]);
    }

    public function show(Lead $lead): View
    {
        return view('admin.leads.show', [
            'lead' => $lead,
            'statuses' => self::STATUSES,
        ]);
    }
}
