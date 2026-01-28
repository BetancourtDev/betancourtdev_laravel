<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    private const STATUSES = ['new', 'contacted', 'qualified', 'closed', 'spam'];

    public function index(Request $request)
    {
        $query = Lead::query()->latest();

        // search
        if ($q = trim((string) $request->get('q'))) {
            $query->where(function ($w) use ($q) {
                $w->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('message', 'like', "%{$q}%");
            });
        }

        // filters
        if ($status = $request->get('status')) {
            if (in_array($status, self::STATUSES, true)) {
                $query->where('status', $status);
            }
        }

        if ($source = trim((string) $request->get('source'))) {
            $query->where('source', $source);
        }

        // date range (opcional)
        if ($from = $request->get('from')) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to = $request->get('to')) {
            $query->whereDate('created_at', '<=', $to);
        }

        $leads = $query->paginate(20)->withQueryString();

        return view('admin.leads.index', [
            'leads' => $leads,
            'statuses' => self::STATUSES,
        ]);
    }

    public function show(Lead $lead)
    {
        return view('admin.leads.show', [
            'lead' => $lead,
            'statuses' => self::STATUSES,
        ]);
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        $data = $request->validate([
            'status' => ['required', 'in:' . implode(',', self::STATUSES)],
        ]);

        $lead->update(['status' => $data['status']]);

        // si pasa a contacted y no tiene contacted_at
        if ($data['status'] === 'contacted' && !$lead->contacted_at) {
            $lead->update(['contacted_at' => now()]);
        }

        return back()->with('ok', 'Estado actualizado ✅');
    }

    public function markContacted(Lead $lead)
    {
        $lead->update([
            'status' => $lead->status === 'spam' ? 'spam' : 'contacted',
            'contacted_at' => now(),
        ]);

        return back()->with('ok', 'Marcado como contactado ✅');
    }
}
