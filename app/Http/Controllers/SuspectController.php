<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Suspect;
use App\Models\User;
use App\Models\Device;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\TemporaryPasswordMail;

class SuspectController extends Controller
{
    
    public function index(Request $request)
    {
        $states = State::all();
        $cities = City::all();
        $devices = Device::all();
    
        $query = Suspect::with(['device']);
    
        if ($request->has('query') && $request->input('query') != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('query') . '%')
                  ->orWhere('identification', 'like', '%' . $request->input('query') . '%');
            });
        }
    
        if ($request->has('state') && $request->input('state') != '') {
            $query->where('state', $request->input('state'));
        }
    
        if ($request->has('city') && $request->input('city') != '') {
            $query->where('city', $request->input('city'));
        }
    
        $suspects = $query->paginate(10);
    
        if ($request->ajax()) {
            return response()->json([
                'html' => view('partials.suspects_table', compact('suspects'))->render(),
                'total' => $suspects->total()
            ]);
        }
    
        return view('admin.device_assignment', compact('suspects','states', 'cities', 'devices'));
    }
    



    public function create()
    {
        $users = User::all();
        $devices = Device::all();
        return view('suspects.create', compact('users', 'devices'));
    }

    public function store(Request $request)
{
 /*    $request->validate([
        'name' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:suspects',
        // Agrega otras reglas de validación necesarias aquí
    ]); */

    // Procesa la carga de la imagen
    if ($request->hasFile('photo')) {
        $imagePath = $request->file('photo')->store('photos', 'public');
    } else {
        $imagePath = null;
    }

    // Genera una contraseña temporal
    $temporaryPassword = Str::random(8);

    // Crea un nuevo sospechoso con los datos del formulario
    $suspect = new Suspect([
        'user_id' => Auth::id(),
        'name' => $request->name,
        'lastname' => $request->lastname,
        'identification' => $request->identification,
        'date_dirth' => $request->date_dirth,
        'state' => $request->state,
        'city' => $request->city,
        'state_id' => $request->state,
        'city_id' => $request->city,
        'address' => $request->address,
        'phone' => $request->phone,
        'mobile' => $request->mobile,
        'email' => $request->email,
        'password' => Hash::make($temporaryPassword),
        'photo' => $imagePath, // Guarda la ruta de la imagen
    ]);

    $suspect->save();

    // Envía la contraseña temporal por correo electrónico
    Mail::to($suspect->email)->send(new TemporaryPasswordMail($temporaryPassword));

    return redirect()->route('suspects.index')->with('success', 'Suspect created successfully.');
}


    public function edit($id)
    {
        $suspect = Suspect::findOrFail($id);
        $states = State::all();
        $cities = City::where('state_id', $suspect->state_id)->get(); 
        $devices = Device::all();
        return view('edit_suspect_modal', compact('suspect', 'states', 'cities', 'devices'));
    }

    public function update(Request $request, Suspect $suspect)
    {
       /*  $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'identification' => 'required|integer',
            'date_dirth' => 'required|date',
            'state' => 'required|integer|exists:states,id',
            'city' => 'required|integer|exists:cities,id',
            'state_id' => 'required|integer|exists:states,id',
            'city_id' => 'required|integer|exists:cities,id',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'mobile' => 'nullable|string|max:15',
            'email' => 'required|string|email|max:255',
           // 'device_id' => 'required|integer|exists:devices,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]); */

        $data = $request->all();
        $data['state'] = $data['editState'];
        $data['city'] = $data['editCity'];
        $data['name'] = $data['editName'];
        $data['identification'] = $data['editIdentification'];
        $data['date_dirth'] = $data['editDateDirth'];
        $data['address'] = $data['editAddress'];
        $data['phone'] = $data['editPhone'];
        $data['mobile'] = $data['editMobile'];
        $data['email'] = $data['editEmail'];

        

        if ($request->hasFile('editPhoto')) {
            if ($suspect->photo) {
                Storage::disk('public')->delete($suspect->photo);
            }
            $data['photo'] = $request->file('editPhoto')->store('photos', 'public');
        }

        $suspect->update($data);

        return redirect()->route('suspects.index')->with('success', 'Suspect updated successfully.');
    }

    public function destroy($id)
    {
        Suspect::findOrFail($id)->delete();
        return redirect()->route('suspects.index')->with('success', 'Suspect deleted successfully.');
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $suspect = Suspect::where('email', $credentials['email'])->first();

        if (!$suspect || !Hash::check($credentials['password'], $suspect->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $suspect->createToken('authToken')->plainTextToken;

        return response()->json(['token' => $token, 'suspect' => $suspect]);
    }

    // Método para obtener el sospechoso autenticado
    public function suspect()
    {
        return response()->json(Auth::guard('sanctum')->user());
    }

    public function resetPassword(Request $request)
    {
       
        $request->validate([
            'email' => 'required|string|email|max:255',
            'identification' => 'required|string',
        ]);

       
        $suspect = Suspect::where('email', $request->email)
                          ->where('identification', $request->identification)
                          ->first();

        if (!$suspect) {
            return response()->json(['message' => 'Suspect not found'], 404);
        }

        
        $temporaryPassword = Str::random(8);

        // Actualizar la contraseña del suspect
        $suspect->password = Hash::make($temporaryPassword);
        $suspect->save();

        
        Mail::to($suspect->email)->send(new TemporaryPasswordMail($temporaryPassword));

        return response()->json(['message' => 'Password reset successfully. A new password has been sent to the email.']);
    }

    public function getCities($state_id)
    {
        $cities = City::where('state_id', $state_id)->get();
        return response()->json($cities);
    }

}
