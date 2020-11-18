<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnterpriseCreateRequest;
use App\Http\Requests\EnterpriseEditRequest;
use App\Models\Enterprise;
use Illuminate\Http\Request;

class BackendEnterpriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $enterprises = Enterprise::all();
        /*$query = $request->get('query');
        echo $query;
        $query = $request->query('query');
        echo $query;*/
        //$response = ['op' => 'create', 'r' => 1, 'id' => 1];
        //$request->session()->flash('op', 'create');
        //$request->session()->flash('id', '1');
        return view('backend.enterprise.index', ['enterprises' => $enterprises]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.enterprise.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EnterpriseCreateRequest $request)
    {
        /*$name1 = $request->input('name');
        $name2 = $request->name;
        $name3 = $request->input('name', 'Kekas');
        $all = $request->all();
        $input = $request->input();*/

        //1
        //$enterprise = new Enterprise($request->all());
        //$result = $enterprise->save();
        //$result - número de registros guardados, $enterprise->id
        //2
        //$enterprise = Enterprise::create($request->all());
        //$enterprise->id

        // $enterprise = new Enterprise($request->all());
        
        $enterprise = new Enterprise($request->validated());
        // $enterprise->name = mb_strtoupper($enterprise->name);
        try {
            $result = $enterprise->save();
        } catch(\Exception $e) {
            $result = 0;
        }
        if($enterprise->id > 0) {
            $response = ['op' => 'create', 'r' => $result, 'id' => $enterprise->id];
            return redirect('backend/enterprise')->with($response);
        } else {
            return back()->withInput()->withErrors(['name' => 'El nombre de la empresa ya existe.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function show(Enterprise $enterprise)
    {
        //$enterprise = Enterprise::find($id);
        $path = public_path('logo'); // /var/www/html/laraveles/thirdApplication/public/logo
        $files = \File::files($path);
        $logo = 'logo.png';
        foreach($files as $file) {
            $filename = pathinfo($file, PATHINFO_FILENAME);
            if($filename == $enterprise->id) {
                $logo = $file->getFileName();
                break;
            }
        }
        
        return view('backend.enterprise.show', ['enterprise' => $enterprise, 'logo' => $logo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function edit(Enterprise $enterprise)
    {
        return view('backend.enterprise.edit', ['enterprise' => $enterprise]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
     
    public function update(EnterpriseEditRequest $request, Enterprise $enterprise)
    {
        // 1º Request (reglas simples)
        // 2º Reglas programar
        // 3º Reglas SQL ->
        $this->uploadFile($request, $enterprise->id);
        try {
            $result = $enterprise->update($request->validated());
        } catch (\Exception $e) {
            $result = 0;
        }
        /*$enterprise->fill($request->all());
        $result = $enterprise->save();*/
        if($result) {
            $response = ['op' => 'update', 'r' => $result, 'id' => $enterprise->id];
            return redirect('backend/enterprise')->with($response);
        } else {
            return back()->withInput()->with(['error' => 'algo ha fallado']);
        }
    }
    
    private function uploadFile(Request $request, $id) {
        if($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $file = $request->file('logo'); // $request->logo
            $target = 'logo';
            
            // $fileName = $file->getClientOriginalName();
            // $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION); // 1ra forma
            
            $fileExtension = \File::extension($file->getClientOriginalName());
            
            $name = $id . "." . $fileExtension; // date('YmdHis') . $file->getClientOriginalName();
            $file->move($target, $name);
        }

    }
    
    private function uploadPrivateFile(Request $request, $id) {
        if($request->hasFile('privada') && $request->file('privada')->isValid()) {
            $file = $request->file('privada'); // $request->logo
            $target = '/var/www/privada/';
            
            // $fileName = $file->getClientOriginalName();
            // $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION); // 1ra forma
            
            $fileExtension = \File::extension($file->getClientOriginalName());
            
            $name = $id . "." . $fileExtension; // date('YmdHis') . $file->getClientOriginalName();
            $file->move($target, $name);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enterprise $enterprise)
    {
        $id = $enterprise->id;
        try {
            $result = $enterprise->delete();
        } catch(\Exception $e) {
            $result = 0;
        }
        //$result = Enterprise::destroy($enterprise->id);
        $response = ['op' => 'destroy', 'r' => $result, 'id' => $id];
        return redirect('backend/enterprise')->with($response);
    }
}
