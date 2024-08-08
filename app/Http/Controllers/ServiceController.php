<?php

namespace App\Http\Controllers;

use App\Models\ServiceModel;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(){
        $services = ServiceModel::all();
        return view('admin.project_services',['services'=>$services]);
    }

    public function submit_data(Request $request)
    {
        $request->validate([
            'service' => 'required|string|max:255,unique:tb_project_services,service',
        ]);

        $data = $request->only(['service']);
        ServiceModel::create($data);
        return redirect()->route('admin.project_services')->with('success', 'Service added successfully!');
    }

    public function edit($id)
    {
        $services = ServiceModel::findOrFail($id);

        return view('admin.project_services_edit', compact('services'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'service' => 'required|string|max:255',
        ]);

        $services = ServiceModel::findOrFail($id);
        $services->update([
            'service' => $request->input('service'),
        ]);

        return redirect()->route('admin.project_services')->with('success', 'Service updated successfully.');
    }

    public function toggleStatus($id)
    {
        $services = ServiceModel::findOrFail($id);
        $services->status = $services->status == 1 ? 0 : 1;
        $services->save();
        return redirect()->route('admin.project_services')->with('success', 'Service status updated successfully.');
    }
}
