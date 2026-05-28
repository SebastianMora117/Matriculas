<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\InfAlumno;
use App\Models\HisAcademico;
use App\Models\RespAlumno;

class MatriculasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('matriculas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jornada' => 'required|string|max:10',
            'sede' => 'required|string|max:2',
            'tipo_identi' => 'required|string|max:20',
            'num_identi' => 'required|string|max:12',
            'fecha_nacimiento' => 'required|date',
            'grado' => 'required|string|max:15',
            'grupo' => 'required|string|max:10',
            'ciudad' => 'required|string|max:10',
            'departamento' => 'required|string|max:12',
            'primer_apellido' => 'required|string|max:20',
            'segundo_apellido' => 'required|string|max:20',
            'primer_nombre' => 'required|string|max:20',
            'segundo_nombre' => 'required|string|max:20',
            'genero' => 'required|string|max:10',
            'edad' => 'required|integer|min:1|max:99',
            'grupo_sanguineo' => 'required|string|max:1',
            'rh' => 'required|string|max:8',
            'puntaje_sisben' => 'required|numeric',
            'nivel_sisben' => 'required|string|max:9',
            'eps' => 'required|string|max:15',
            'email' => 'required|email|max:30',
            'ars_ips' => 'nullable|string|max:20',
            'localidad' => 'required|string|max:20',
            'estrato' => 'required|integer|min:1|max:9',
            'barrio' => 'required|string|max:15',
            'direccion' => 'required|string|max:33',
            'telefono' => 'required|string|max:15',
            'celular' => 'required|string|max:15',
            'VDCA' => 'required|string|in:Sí,No',
            'ESDD' => 'required|string|in:Sí,No',
            'HDDDGA' => 'required|string|in:Sí,No',
            'municipio_expulsor' => 'required|string|max:22',
            'departamento_expulsor' => 'required|string|max:28',
            'limitaciones' => 'nullable|string|max:200',
            'ha_año' => 'nullable|string|max:4',
            'ha_grado' => 'nullable|string|max:10',
            'ha_institucion' => 'nullable|string|max:33',
            'ha_localidad' => 'nullable|string|max:20',
            'ha_categoria' => 'nullable|string|max:10',
            'ha_año1' => 'nullable|string|max:4',
            'ha_grado1' => 'nullable|string|max:10',
            'ha_institucion1' => 'nullable|string|max:33',
            'ha_localidad1' => 'nullable|string|max:20',
            'ha_categoria1' => 'nullable|string|max:10',
            'ha_año2' => 'nullable|string|max:4',
            'ha_grado2' => 'nullable|string|max:10',
            'ha_institucion2' => 'nullable|string|max:33',
            'ha_localidad2' => 'nullable|string|max:20',
            'ha_categoria2' => 'nullable|string|max:10',
            'ha_año3' => 'nullable|string|max:4',
            'ha_grado3' => 'nullable|string|max:10',
            'ha_institucion3' => 'nullable|string|max:33',
            'ha_localidad3' => 'nullable|string|max:20',
            'ha_categoria3' => 'nullable|string|max:10',
            'nombre_padre' => 'required|string|max:40',
            'cedula_padre' => 'required|string|max:10',
            'lugar_expedicionp' => 'required|string|max:20',
            'telefono_padre' => 'required|string|max:15',
            'correo_padre' => 'required|email|max:30',
            'nombre_madre' => 'required|string|max:40',
            'cedula_madre' => 'required|string|max:10',
            'lugar_expedicionm' => 'required|string|max:20',
            'telefono_madre' => 'required|string|max:15',
            'correo_madre' => 'required|email|max:30',
            'nombre_acudiente' => 'required|string|max:40',
            'cedula_acudiente' => 'required|string|max:10',
            'lugar_expediciona' => 'required|string|max:20',
            'telefono_acudiente' => 'required|string|max:15',
            'correo_acudiente' => 'required|email|max:30',
        ]);

        $infData = [
            'jornada' => $validated['jornada'],
            'sede' => $validated['sede'],
            'tipo_identi' => $validated['tipo_identi'],
            'num_identi' => $validated['num_identi'],
            'fecha_nacimiento' => $validated['fecha_nacimiento'],
            'grado' => $validated['grado'],
            'grupo' => $validated['grupo'],
            'ciudad' => $validated['ciudad'],
            'departamento' => $validated['departamento'],
            'primer_apellido' => $validated['primer_apellido'],
            'segundo_apellido' => $validated['segundo_apellido'],
            'primer_nombre' => $validated['primer_nombre'],
            'segundo_nombre' => $validated['segundo_nombre'],
            'genero' => $validated['genero'],
            'edad' => $validated['edad'],
            'grupo_sanguineo' => $validated['grupo_sanguineo'],
            'rh' => $validated['rh'],
            'puntaje_sisben' => $validated['puntaje_sisben'],
            'nivel_sisben' => $validated['nivel_sisben'],
            'eps' => $validated['eps'],
            'email' => $validated['email'],
            'ars_ips' => $validated['ars_ips'] ?? null,
            'localidad' => $validated['localidad'],
            'estrato' => $validated['estrato'],
            'barrio' => $validated['barrio'],
            'direccion' => $validated['direccion'],
            'telefono' => $validated['telefono'],
            'celular' => $validated['celular'],
            'VDCA' => $validated['VDCA'] === 'Sí' ? 1 : 0,
            'ESDD' => $validated['ESDD'] === 'Sí' ? 1 : 0,
            'HDDDGA' => $validated['HDDDGA'] === 'Sí' ? 1 : 0,
            'municipio_expulsor' => $validated['municipio_expulsor'],
            'departamento_expulsor' => $validated['departamento_expulsor'],
            'limitaciones' => $validated['limitaciones'] ?? null,
        ];

        $hisData = [
            'ha_año' => $validated['ha_año'] ?? null,
            'ha_grado' => $validated['ha_grado'] ?? null,
            'ha_institucion' => $validated['ha_institucion'] ?? null,
            'ha_localidad' => $validated['ha_localidad'] ?? null,
            'ha_categoria' => $validated['ha_categoria'] ?? null,
            'ha_año1' => $validated['ha_año1'] ?? null,
            'ha_grado1' => $validated['ha_grado1'] ?? null,
            'ha_institucion1' => $validated['ha_institucion1'] ?? null,
            'ha_localidad1' => $validated['ha_localidad1'] ?? null,
            'ha_categoria1' => $validated['ha_categoria1'] ?? null,
            'ha_año2' => $validated['ha_año2'] ?? null,
            'ha_grado2' => $validated['ha_grado2'] ?? null,
            'ha_institucion2' => $validated['ha_institucion2'] ?? null,
            'ha_localidad2' => $validated['ha_localidad2'] ?? null,
            'ha_categoria2' => $validated['ha_categoria2'] ?? null,
            'ha_año3' => $validated['ha_año3'] ?? null,
            'ha_grado3' => $validated['ha_grado3'] ?? null,
            'ha_institucion3' => $validated['ha_institucion3'] ?? null,
            'ha_localidad3' => $validated['ha_localidad3'] ?? null,
            'ha_categoria3' => $validated['ha_categoria3'] ?? null,
            'num_identi' => $validated['num_identi'],
        ];

        $respData = [
            'nombre_padre' => $validated['nombre_padre'],
            'cedula_padre' => $validated['cedula_padre'],
            'lugar_expedicionp' => $validated['lugar_expedicionp'],
            'telefono_padre' => $validated['telefono_padre'],
            'correo_padre' => $validated['correo_padre'],
            'nombre_madre' => $validated['nombre_madre'],
            'cedula_madre' => $validated['cedula_madre'],
            'lugar_expedicionm' => $validated['lugar_expedicionm'],
            'telefono_madre' => $validated['telefono_madre'],
            'correo_madre' => $validated['correo_madre'],
            'nombre_acudiente' => $validated['nombre_acudiente'],
            'cedula_acudiente' => $validated['cedula_acudiente'],
            'lugar_expediciona' => $validated['lugar_expediciona'],
            'telefono_acudiente' => $validated['telefono_acudiente'],
            'correo_acudiente' => $validated['correo_acudiente'],
            'num_identi' => $validated['num_identi'],
        ];

        DB::transaction(function () use ($infData, $hisData, $respData) {
            InfAlumno::updateOrCreate(['num_identi' => $infData['num_identi']], $infData);
            HisAcademico::updateOrCreate(['num_identi' => $hisData['num_identi']], $hisData);
            RespAlumno::updateOrCreate(['num_identi' => $respData['num_identi']], $respData);
        });

        return redirect()->route('matriculas.index')->with('success', 'Matrícula guardada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alumno = InfAlumno::with('responsable', 'historialAcademico')->findOrFail($id);
        return view('matriculas.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'jornada' => 'required|string|max:10',
            'sede' => 'required|string|max:2',
            'tipo_identi' => 'required|string|max:20',
            'fecha_nacimiento' => 'required|date',
            'grado' => 'required|string|max:15',
            'grupo' => 'required|string|max:10',
            'ciudad' => 'required|string|max:10',
            'departamento' => 'required|string|max:12',
            'primer_apellido' => 'required|string|max:20',
            'segundo_apellido' => 'required|string|max:20',
            'primer_nombre' => 'required|string|max:20',
            'segundo_nombre' => 'required|string|max:20',
            'genero' => 'required|string|max:10',
            'edad' => 'required|integer|min:1|max:99',
            'grupo_sanguineo' => 'required|string|max:1',
            'rh' => 'required|string|max:8',
            'puntaje_sisben' => 'required|numeric',
            'nivel_sisben' => 'required|string|max:9',
            'eps' => 'required|string|max:15',
            'email' => 'required|email|max:30',
            'ars_ips' => 'nullable|string|max:20',
            'localidad' => 'required|string|max:20',
            'estrato' => 'required|integer|min:1|max:9',
            'barrio' => 'required|string|max:15',
            'direccion' => 'required|string|max:33',
            'telefono' => 'required|string|max:15',
            'celular' => 'required|string|max:15',
            'VDCA' => 'required|string|in:Sí,No,1,0',
            'ESDD' => 'required|string|in:Sí,No,1,0',
            'HDDDGA' => 'required|string|in:Sí,No,1,0',
            'municipio_expulsor' => 'required|string|max:22',
            'departamento_expulsor' => 'required|string|max:28',
            'limitaciones' => 'nullable|string|max:200',
            'ha_año' => 'nullable|string|max:4',
            'ha_grado' => 'nullable|string|max:10',
            'ha_institucion' => 'nullable|string|max:33',
            'ha_localidad' => 'nullable|string|max:20',
            'ha_categoria' => 'nullable|string|max:10',
            'ha_año1' => 'nullable|string|max:4',
            'ha_grado1' => 'nullable|string|max:10',
            'ha_institucion1' => 'nullable|string|max:33',
            'ha_localidad1' => 'nullable|string|max:20',
            'ha_categoria1' => 'nullable|string|max:10',
            'ha_año2' => 'nullable|string|max:4',
            'ha_grado2' => 'nullable|string|max:10',
            'ha_institucion2' => 'nullable|string|max:33',
            'ha_localidad2' => 'nullable|string|max:20',
            'ha_categoria2' => 'nullable|string|max:10',
            'ha_año3' => 'nullable|string|max:4',
            'ha_grado3' => 'nullable|string|max:10',
            'ha_institucion3' => 'nullable|string|max:33',
            'ha_localidad3' => 'nullable|string|max:20',
            'ha_categoria3' => 'nullable|string|max:10',
            'nombre_padre' => 'required|string|max:40',
            'cedula_padre' => 'required|string|max:10',
            'lugar_expedicionp' => 'required|string|max:20',
            'telefono_padre' => 'required|string|max:15',
            'correo_padre' => 'required|email|max:30',
            'nombre_madre' => 'required|string|max:40',
            'cedula_madre' => 'required|string|max:10',
            'lugar_expedicionm' => 'required|string|max:20',
            'telefono_madre' => 'required|string|max:15',
            'correo_madre' => 'required|email|max:30',
            'nombre_acudiente' => 'required|string|max:40',
            'cedula_acudiente' => 'required|string|max:10',
            'lugar_expediciona' => 'required|string|max:20',
            'telefono_acudiente' => 'required|string|max:15',
            'correo_acudiente' => 'required|email|max:30',
        ]);

        $infData = [
            'jornada' => $validated['jornada'],
            'sede' => $validated['sede'],
            'tipo_identi' => $validated['tipo_identi'],
            'fecha_nacimiento' => $validated['fecha_nacimiento'],
            'grado' => $validated['grado'],
            'grupo' => $validated['grupo'],
            'ciudad' => $validated['ciudad'],
            'departamento' => $validated['departamento'],
            'primer_apellido' => $validated['primer_apellido'],
            'segundo_apellido' => $validated['segundo_apellido'],
            'primer_nombre' => $validated['primer_nombre'],
            'segundo_nombre' => $validated['segundo_nombre'],
            'genero' => $validated['genero'],
            'edad' => $validated['edad'],
            'grupo_sanguineo' => $validated['grupo_sanguineo'],
            'rh' => $validated['rh'],
            'puntaje_sisben' => $validated['puntaje_sisben'],
            'nivel_sisben' => $validated['nivel_sisben'],
            'eps' => $validated['eps'],
            'email' => $validated['email'],
            'ars_ips' => $validated['ars_ips'] ?? null,
            'localidad' => $validated['localidad'],
            'estrato' => $validated['estrato'],
            'barrio' => $validated['barrio'],
            'direccion' => $validated['direccion'],
            'telefono' => $validated['telefono'],
            'celular' => $validated['celular'],
            'VDCA' => in_array($validated['VDCA'], ['Sí', '1']) ? 1 : 0,
            'ESDD' => in_array($validated['ESDD'], ['Sí', '1']) ? 1 : 0,
            'HDDDGA' => in_array($validated['HDDDGA'], ['Sí', '1']) ? 1 : 0,
            'municipio_expulsor' => $validated['municipio_expulsor'],
            'departamento_expulsor' => $validated['departamento_expulsor'],
            'limitaciones' => $validated['limitaciones'] ?? null,
        ];

        $hisData = [
            'ha_año' => $validated['ha_año'] ?? null,
            'ha_grado' => $validated['ha_grado'] ?? null,
            'ha_institucion' => $validated['ha_institucion'] ?? null,
            'ha_localidad' => $validated['ha_localidad'] ?? null,
            'ha_categoria' => $validated['ha_categoria'] ?? null,
            'ha_año1' => $validated['ha_año1'] ?? null,
            'ha_grado1' => $validated['ha_grado1'] ?? null,
            'ha_institucion1' => $validated['ha_institucion1'] ?? null,
            'ha_localidad1' => $validated['ha_localidad1'] ?? null,
            'ha_categoria1' => $validated['ha_categoria1'] ?? null,
            'ha_año2' => $validated['ha_año2'] ?? null,
            'ha_grado2' => $validated['ha_grado2'] ?? null,
            'ha_institucion2' => $validated['ha_institucion2'] ?? null,
            'ha_localidad2' => $validated['ha_localidad2'] ?? null,
            'ha_categoria2' => $validated['ha_categoria2'] ?? null,
            'ha_año3' => $validated['ha_año3'] ?? null,
            'ha_grado3' => $validated['ha_grado3'] ?? null,
            'ha_institucion3' => $validated['ha_institucion3'] ?? null,
            'ha_localidad3' => $validated['ha_localidad3'] ?? null,
            'ha_categoria3' => $validated['ha_categoria3'] ?? null,
        ];

        $respData = [
            'nombre_padre' => $validated['nombre_padre'],
            'cedula_padre' => $validated['cedula_padre'],
            'lugar_expedicionp' => $validated['lugar_expedicionp'],
            'telefono_padre' => $validated['telefono_padre'],
            'correo_padre' => $validated['correo_padre'],
            'nombre_madre' => $validated['nombre_madre'],
            'cedula_madre' => $validated['cedula_madre'],
            'lugar_expedicionm' => $validated['lugar_expedicionm'],
            'telefono_madre' => $validated['telefono_madre'],
            'correo_madre' => $validated['correo_madre'],
            'nombre_acudiente' => $validated['nombre_acudiente'],
            'cedula_acudiente' => $validated['cedula_acudiente'],
            'lugar_expediciona' => $validated['lugar_expediciona'],
            'telefono_acudiente' => $validated['telefono_acudiente'],
            'correo_acudiente' => $validated['correo_acudiente'],
        ];

        DB::transaction(function () use ($id, $infData, $hisData, $respData) {
            InfAlumno::where('num_identi', $id)->update($infData);
            HisAcademico::updateOrCreate(['num_identi' => $id], $hisData);
            RespAlumno::updateOrCreate(['num_identi' => $id], $respData);
        });

        return redirect()->route('home')->with('success', 'Datos del estudiante actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
