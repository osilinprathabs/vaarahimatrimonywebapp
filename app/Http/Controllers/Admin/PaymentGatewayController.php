<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentGateway;

class PaymentGatewayController extends Controller
{
    public function index()
    {
        $gateways = PaymentGateway::all();
        return view('admin.settings.payment_gateways_list', compact('gateways'), ['title' => 'Payment Gateways']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:payment_gateways,name',
        ]);

        PaymentGateway::create([
            'name' => $request->name,
            'config' => [],
            'is_active' => false,
        ]);

        return back()->with('success', 'New payment gateway added successfully.');
    }

    public function edit($id)
    {
        $gateway = PaymentGateway::findOrFail($id);
        return view('admin.settings.payment_gateway_edit', compact('gateway'), ['title' => 'Edit ' . $gateway->name]);
    }

    public function update(Request $request, $id)
    {
        $gateway = PaymentGateway::findOrFail($id);
        
        $data = [
            'secret_key' => $request->secret_key,
            'publishable_key' => $request->publishable_key,
            'webhook_secret' => $request->webhook_secret,
            'webhook_url' => $request->webhook_url,
            'status' => $request->status,
            'environment' => $request->environment,
            'is_active' => $request->has('is_active'),
            'config' => $request->input('config', []),
        ];
        
        $gateway->update($data);

        return redirect()->route('admin.settings.payment_gateway')->with('success', $gateway->name . ' settings updated successfully.');
    }

    public function toggleStatus($id)
    {
        $gateway = PaymentGateway::findOrFail($id);
        $gateway->update(['is_active' => !$gateway->is_active]);

        return back()->with('success', 'Gateway status toggled.');
    }

    public function destroy($id)
    {
        $gateway = PaymentGateway::findOrFail($id);
        $gateway->delete();

        return back()->with('success', 'Payment gateway deleted successfully.');
    }
}
