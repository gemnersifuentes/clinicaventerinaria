
<?php


use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClienteAuthController extends Controller
{
    public function mostrarRegistro()
    {
        // Si el cliente ya está autenticado, redirigir al inicio
        if (Auth::guard('cliente')->check()) {
            return redirect()->route('scoobydoo.productos.index');
        }

        return view('scoobydoo.cliente.registro');
    }

    public function registrar(Request $request)
    {
        // Validación de datos de registro
        $validado = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clientes,email',
            'password' => 'required|string|min:8|confirmed',
            'telefono' => 'nullable|string|max:20',
            'terminos' => 'accepted' // Añadir validación de términos y condiciones
        ], [
            // Mensajes de error personalizados
            'nombre.required' => 'El nombre es obligatorio',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.unique' => 'Este correo electrónico ya está registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'terminos.accepted' => 'Debes aceptar los términos y condiciones'
        ]);

        try {
            // Crear nuevo cliente
            $cliente = Cliente::create([
                'nombre' => $validado['nombre'],
                'email' => $validado['email'],
                'password' => Hash::make($validado['password']),
                'telefono' => $validado['telefono'] ?? null
            ]);

            // Iniciar sesión automáticamente después del registro
            Auth::guard('cliente')->login($cliente);

            // Redirigir con mensaje de éxito
            return redirect()->route('scoobydoo.productos.index')
                ->with('success', '¡Registro exitoso! Bienvenido a ScoobyDoo Store.');
        } catch (\Exception $e) {
            // Manejo de errores inesperados
            return back()->withErrors([
                'registro' => 'Hubo un problema al crear tu cuenta. Por favor, intenta de nuevo.'
            ])->withInput($request->except('password'));
        }
    }

    public function mostrarInicioSesion()
    {
        // Si el cliente ya está autenticado, redirigir al inicio
        if (Auth::guard('cliente')->check()) {
            return redirect()->route('scoobydoo.productos.index');
        }

        return view('scoobydoo.cliente.login');
    }
    public function logout(Request $request)
    {
        // Verifica si el cliente está autenticado
        if (Auth::guard('cliente')->check()) {
            // Cierra la sesión del cliente
            Auth::guard('cliente')->logout();

            // Invalida la sesión y regenera el token CSRF
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Redirige al inicio o a la página de inicio de sesión
            return redirect()->route('scoobydoo.cliente.login')
                ->with('success', 'Has cerrado sesión correctamente.');
        }

        return redirect()->route('scoobydoo.cliente.login');
    }

    public function iniciarSesion(Request $request)
    {
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticar al cliente
        if (Auth::guard('cliente')->attempt($credenciales, $request->filled('remember'))) {
            // Regenerar la sesión para prevenir fijación de sesión
            $request->session()->regenerate();

            // Redirigir al dashboard o página de productos
            return redirect()->route('scoobydoo.productos.index')
                ->with('success', '¡Bienvenido! Has iniciado sesión correctamente.');
        }

        // Si la autenticación falla, regresar con errores
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->withInput($request->only('email'));
    }
    public function miCuenta()
    {
        // Verificar si el cliente está autenticado
        if (!Auth::guard('cliente')->check()) {
            return redirect()->route('scoobydoo.cliente.login')
                ->withErrors(['login' => 'Debes iniciar sesión para acceder a tu cuenta.']);
        }

        // Obtener el cliente autenticado
        $cliente = Auth::guard('cliente')->user();

        // Retornar la vista con los datos del cliente
        return view('scoobydoo.cliente.mi_cuenta', compact('cliente'));
    }
    public function editarCuenta()
    {
        if (!Auth::guard('cliente')->check()) {
            return redirect()->route('scoobydoo.cliente.login')
                ->withErrors(['login' => 'Debes iniciar sesión para editar tu cuenta.']);
        }

        $cliente = Auth::guard('cliente')->user();
        return view('scoobydoo.cliente.editar', compact('cliente'));
    }

    public function actualizarCuenta(Request $request) {}
}
