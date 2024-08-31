<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\User_rol;
use Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
  
class AuthController extends Controller
{
    /**
     * Vista de login 
     * 
     */
    public function index(): View
    {
        return view('auth.login');
    }  
      
    /**
     * Vista de creacion de usuario en la plataforma
     *
     */
    public function registration(): View
    {
        return view('auth.registration');
    }
      
    /**
     * Login en plataforma
     */
    public function postLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('home')
                        ->withSuccess('Bienvenid@!!');
        }
  
        return redirect("/")->withError('Datos erroneos!');
    }

      
    /**
     * Captura de datos para el registro de un usuario nuevo
     *
     */
    public function postRegistration(Request $request): RedirectResponse
    {  
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|min:6|same:password',
                'rol' => 'required'
            ],
            [
                'email.unique'=> 'El correo ya se encuentra registrado, intente con otro',
                'password.required'=> 'La contraseña es obligatoria',
                'password.min'=> 'La contraseña debe ser de minimo 6 caracteres',
                'password_confirmation.same'=> 'La contraseña no coincide, intente de nuevo',
                'rol.required'=> 'El rol es obligatorio'
            ]
        );
           
        $data = $request->all();
        $user = $this->create($data);

        $user_rol = new User_rol();
        $user_rol->user_id = $user->id;
        $user_rol->rol_id = $data['rol'];
        $user_rol->created_at = date('Y-m-d H:i:s');
        $user_rol->updated_at = date('Y-m-d H:i:s');
        $user_rol->save();

        Auth::login($user); 

        return redirect("home")->withSuccess('Registro exitoso en la plataforma');
    }

    /**
     * Creacion de usuarios
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Cerrar sesion
     */
    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();
  
        return Redirect('/');
    }
}