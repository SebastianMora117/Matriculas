<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Archivo;
use Illuminate\Support\Facades\Storage;
 
class GestionArchivosController extends Controller
{
    // ── Mostrar vista principal ──
    public function index()
    {
        $archivos = Archivo::latest()->paginate(10);
        return view('gestionArchivos.index', compact('archivos'));
    }
 
    // ── Subir archivo ──
    public function store(Request $request)
    {
        $request->validate([
            'tipo_archivo' => 'required|string',
            'cedula'       => 'required|digits_between:5,15',
            'archivo'      => 'required|file|mimes:pdf|max:10240', // max 10 MB
        ], [
            'tipo_archivo.required' => 'Seleccione el tipo de documento.',
            'cedula.required'       => 'El número de cédula es obligatorio.',
            'cedula.digits_between' => 'La cédula debe tener entre 5 y 15 dígitos.',
            'archivo.required'      => 'Debe seleccionar un archivo PDF.',
            'archivo.mimes'         => 'Solo se permiten archivos PDF.',
            'archivo.max'           => 'El archivo no puede superar 10 MB.',
        ]);
 
        // Guardar en storage/app/public/archivos
        $path          = $request->file('archivo')->store('archivos', 'public');
        $nombreOriginal = $request->file('archivo')->getClientOriginalName();
 
        Archivo::create([
            'tipo_archivo'    => $request->tipo_archivo,
            'cedula'          => $request->cedula,
            'ruta'            => $path,
            'nombre_original' => $nombreOriginal,
        ]);
 
        return redirect()->route('gestionArchivos.index')
                         ->with('success', 'Archivo subido correctamente.');
    }
 
    // ── Ver PDF en el navegador ──
    public function ver($id)
    {
        $archivo = Archivo::findOrFail($id);
        $path    = storage_path('app/public/' . $archivo->ruta);
 
        if (!file_exists($path)) {
            abort(404, 'Archivo no encontrado.');
        }
 
        return response()->file($path, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $archivo->nombre_original . '"',
        ]);
    }
 
    // ── Descargar PDF ──
    public function descargar($id)
    {
        $archivo = Archivo::findOrFail($id);
        $path    = storage_path('app/public/' . $archivo->ruta);
 
        if (!file_exists($path)) {
            abort(404, 'Archivo no encontrado.');
        }
 
        return response()->download($path, $archivo->nombre_original);
    }
 
    // ── Eliminar archivo ──
    public function destroy($id)
    {
        $archivo = Archivo::findOrFail($id);
 
        // Eliminar físicamente del storage
        Storage::disk('public')->delete($archivo->ruta);
 
        $archivo->delete();
 
        return redirect()->route('gestionArchivos.index')
                         ->with('success', 'Archivo eliminado correctamente.');
    }
}