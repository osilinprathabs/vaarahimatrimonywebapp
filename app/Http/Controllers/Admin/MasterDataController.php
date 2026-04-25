<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Caste;
use App\Models\Subcaste;
use App\Models\Religion;
use App\Models\Raasi;
use App\Models\Star;
use App\Models\Education;
use App\Models\Occupation;

class MasterDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($type)
    {
        $data = $this->getDataForType($type);
        return view('admin.master.index', [
            'type' => $type,
            'items' => $data['items'],
            'label' => $data['label']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $type)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|integer', // e.g. religion_id for caste
        ]);

        $this->getModelForType($type)->create($this->mapFields($type, $validated));

        return back()->with('success', ucfirst($type) . ' added successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $type, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|integer',
        ]);

        $item = $this->getModelForType($type)->findOrFail($id);
        $item->update($this->mapFields($type, $validated));

        return back()->with('success', ucfirst($type) . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($type, $id)
    {
        $this->getModelForType($type)->findOrFail($id)->delete();
        return back()->with('success', ucfirst($type) . ' deleted successfully.');
    }

    private function getDataForType($type)
    {
        if ($type == 'gothram') $type = 'gotharam';
        switch ($type) {
            case 'religion': return ['items' => Religion::all(), 'label' => 'Religion'];
            case 'caste': return ['items' => Caste::all(), 'label' => 'Caste'];
            case 'subcaste': return ['items' => Subcaste::all(), 'label' => 'Sub Caste'];
            case 'raasi': return ['items' => Raasi::all(), 'label' => 'Raasi'];
            case 'star': return ['items' => Star::all(), 'label' => 'Star'];
            case 'education': return ['items' => Education::all(), 'label' => 'Education'];
            case 'occupation': return ['items' => Occupation::all(), 'label' => 'Occupation'];
            case 'gotharam': return ['items' => \App\Models\Gothram::all(), 'label' => 'Gotharam'];
            default: abort(404);
        }
    }

    private function getModelForType($type)
    {
        if ($type == 'gothram') $type = 'gotharam';
        switch ($type) {
            case 'religion': return new Religion;
            case 'caste': return new Caste;
            case 'subcaste': return new Subcaste;
            case 'raasi': return new Raasi;
            case 'star': return new Star;
            case 'education': return new Education;
            case 'occupation': return new Occupation;
            case 'gotharam': return new \App\Models\Gothram;
            default: abort(404);
        }
    }

    private function mapFields($type, $validated)
    {
        if ($type == 'gothram') $type = 'gotharam';
        $nameField = $type; // Most tables have same name as type (e.g. caste, religion)
        if ($type == 'subcaste') $nameField = 'subcaste';
        if ($type == 'raasi' || $type == 'star') $nameField = 'name';
        
        $fields = [$nameField => $validated['name']];
        
        if (isset($validated['parent_id'])) {
            if ($type == 'caste') $fields['religion'] = $validated['parent_id'];
            if ($type == 'subcaste') $fields['caste'] = $validated['parent_id'];
        }
        
        return $fields;
    }
}
